<?php

namespace Modules\Staff\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Staff\app\Models\CvsExample;
use Modules\Staff\app\Models\UserEducation;
use Modules\Staff\app\Models\UserExperience;
use Modules\Staff\app\Models\UserSkill;
use Modules\Staff\app\Models\UserStaff;
use Modules\Staff\app\Models\Rank;
use Modules\Staff\app\Models\Wage;
use Modules\Staff\app\Models\Career;
use Modules\Staff\app\Models\FormWork;
use Modules\Staff\app\Models\UserCv;
use Illuminate\Support\Facades\Auth;


class CvsExampleController extends Controller
{
    public function index(Request $request)
    {
        $userCvs = CvsExample::all();
        $params = [
            'items' => $userCvs
        ];
        return view('website.dashboards.cv.index', $params);
    }
    public function show($id)
    {
        $item = CvsExample::findOrFail($id);
        $educations = UserEducation::where('cv_id', $id)->get();
        $userExperiences = UserExperience::where('cv_id',$id)->get();
        $userSkills = UserSkill::where('cv_id',$id)->get();
        $params = [
            'item' => $item,
            'educations' => $educations,
            'userExperiences' => $userExperiences,
            'userSkills' => $userSkills,
        ];
        return view('website.dashboards.cv.show', $params);
    }
    public function edit(Request $request,$id)
    {
        if (Auth::user()) {
            $user       = Auth::user();
            $item       = self::createCV(CvsExample::findOrfail($id));
            $tab        = $request->tab ? $request->tab : 'personal-information';
            $staff      = UserStaff::where('user_id', $user->id)->first();
            $userExperiences = UserExperience::where('user_id', $user->id)->where('cv_id',$id)->get();
            $userEducations = UserEducation::where('user_id', $user->id)->where('cv_id',$id)->get();
            $userSkills = UserSkill::where('user_id', $user->id)->where('cv_id',$id)->get();
            $ranks = Rank::all();
            $wages = Wage::all();
            $careers = Career::all();
            $formWorks = FormWork::all();
            $params = [
                'user'              => $user,
                'staff'             => $staff,
                'item'              => $item,
                'cv_id'             => $id,
                'tab'               => $tab,
                'userExperiences'   => $userExperiences,
                'userEducations'    => $userEducations,
                'userSkills'        => $userSkills,
                'ranks'             => $ranks,
                'wages'             => $wages,
                'formWorks'         => $formWorks,
                'careers'           => $careers,
            ];
            return view('staff::cv.edit', $params)->with('success', 'Bắt đầu tạo mới hồ sơ');
        }else{
            return back()->with('error' ,'Vui lòng đăng nhập trước khi tạo bản sao');
        }
    }
    public static function createCV($ex){
       $data = [
            "user_id" => Auth::id(),
            "cv_file" => $ex->cv_file,
            "name" => Auth::user()->name,
            "email" => Auth::user()->email,
            "phone" => $ex->phone,
            "birthdate" => $ex->birthdate,
            "gender" => $ex->gender,
            "city" => $ex->city,
            "address" => $ex->address,
            "outstanding_achievements" => $ex->outstanding_achievements,
            "desired_position" => $ex->desired_position,
            "rank_id" => $ex->rank_id,
            "form_work_id" => $ex->form_work_id,
            "career_id" => $ex->career_id,
            "desired_location" => $ex->desired_location,
            "wage_id" => $ex->wage_id,
            "experience_years" => $ex->experience_years,
            "career_objective" => $ex->career_objective,
            "status" => $ex->status
       ];
        return UserCv::create($data);
    }
}