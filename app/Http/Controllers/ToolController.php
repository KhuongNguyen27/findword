<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function importVNW(Request $request){
        $page = $request->page ?? 1;
        $file = asset('import/c_'.$page.'.txt');
        $data = file_get_contents($file);
        $data = json_decode($data);
        $items = $data->data;
        foreach( $items as $item ){
            $checkCompany = User::where('id',$item->companyId)->first();
            if( !$checkCompany ){
                // Thêm vào bảng User
                $user = new User;
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
                    $userEmployee->name = $user->name;
                    $userEmployee->image = $item->companyLogoUrlCCP;
                    $userEmployee->about = $item->companyProfile;
                    $userEmployee->background = $item->bannerDesktopUri;
                    $userEmployee->user_id = $user->id;
                    $userEmployee->slug = Str::slug($user->name);
                    $userEmployee->is_top = 1;
                    $userEmployee->save();
                }

                // Thêm vào bảng Job
                $jobs = $item->jobs;
                foreach( $jobs as $job ){
                    $checkJob = Job::where('id',$job->jobId)->first();
                    if(!$checkJob){
                        $newjob = new Job();
                        $newjob->id = $job->jobId;                     
                        $newjob->user_id = $user->id;                     
                        $newjob->name = $job->jobTitle;
                        $newjob->slug = Str::slug($job->jobTitle);                 
                        // Cần code thêm
                        // $newjob->career_id  = rand(1,10);
                        // $newjob->wage_id    = rand(1,5);
                        // $newjob->work_address    = $job->short_cities;
                        // $newjob->status    = 1;
                        // $newjob->province_id    = 1;
                        // $newjob->deadline    = date('Y-m-d',strtotime($job->deadline));
                        // $newjob->save();
                    }
                }

            }
        }
    }
}
