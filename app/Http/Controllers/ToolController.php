<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Job;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Province;
use App\Models\UserEmployee;
use App\Models\JobPackage;
use Carbon\Carbon;
use App\Models\Level;
use App\Models\FormWork;
use App\Models\User;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function importVNW(Request $request){
        $page = $request->page ?? 1;
        $file = asset('import/c_'.$page.'.txt');
        $data = @file_get_contents($file);
        if(!$data){
            die('DONE');
        }
        $data = json_decode($data);
        $items = $data->data;
        foreach( $items as $item ){
            $user = User::where('id',$item->companyId)->first();
            // Thêm vào bảng User
            if( !$user ){
                $user = new User;
            }
            $user->id = $item->companyId;
            $user->name = $item->companyNameCCP;
            $user->email = $item->companyId.'@gmail.com';
            $user->password = '$2y$12$pK.bA6rgjGcT5OlmIS3CC.7Gj5IjgRJAzdkytkO.hVgQvEMVZiznm';
            $user->type = 'employee';
            $user->status = 1;
            $user->verify = 1;
            $user->save();

            // Thêm vào bảng UserEmployee
            $userEmployee = UserEmployee::where('name',$user->name)->first();
            if(!$userEmployee){
                $userEmployee = new UserEmployee();
            }
            $userEmployee->name = $user->name;
            $userEmployee->image = $item->companyLogoUrlCCP;
            $userEmployee->about = $item->companyProfile;
            $userEmployee->address = $item->address;
            $userEmployee->website = $item->website;
            $userEmployee->background = $item->bannerDesktopUri;
            $userEmployee->user_id = $user->id;
            $userEmployee->slug = Str::slug($user->name);
            $userEmployee->is_top = 1;
            $userEmployee->save();

            // Thêm vào bảng Job
            $jobs = $item->jobs;
            foreach( $jobs as $job ){
                $newjob = Job::where('id',$job->jobId)->first();
                if(!$newjob){
                    $newjob = new Job();
                    $newjob->id = $job->jobId;     
                }
                $newjob->user_id = $user->id;                     
                $newjob->name = $job->jobTitle;
                $newjob->slug = Str::slug($job->jobTitle);                 
                $newjob->jobpackage_id      = rand(1,7);//Thường
                $newjob->country            = 'VN';
                $newjob->salaryMin          = $job->salaryMin;
                $newjob->salaryMax          = $job->salaryMax;
                $newjob->description        = $job->jobDescription;
                $newjob->requirements       = $job->jobRequirement;
                
                $rank = Rank::firstOrCreate([
                    'name' => $job->jobLevelVI,
                    'slug' => Str::slug($job->jobLevelVI)

                ]);
                $newjob->rank_id    = $rank->id;

                $wage = Wage::firstOrCreate([
                    'name' => $job->prettySalary,
                    'slug' => Str::slug($job->prettySalary)
                ]);
                $job->locationsVI = current( explode(',',$job->locationsVI) );

                $province_id = Province::where('name','LIKE','%'.$job->locationsVI.'%')->value('id');
                $newjob->wage_id        = $wage->id;
                $newjob->work_address   = $job->address;
                $newjob->status         = 1;
                $newjob->province_id    = $province_id ?? 1;
                $newjob->deadline       = date('Y-m-d',strtotime('+30 days'));
                $newjob->save();
            }
        }
        $page = $page + 1;
        echo '<script> window.location.href = "'.url()->current().'?page='.$page.'" </script>';
        die();
    }
}
