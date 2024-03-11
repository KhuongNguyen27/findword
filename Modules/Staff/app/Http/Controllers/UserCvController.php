<?php

namespace Modules\Staff\app\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Staff\app\Http\Requests\StoreUserCvRequest;
use Modules\Staff\app\Http\Requests\UpdateUserCvRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Staff\app\Models\UserCv;
use Modules\Staff\app\Models\UserExperience;
use Modules\Staff\app\Models\UserEducation;
use Modules\Staff\app\Models\UserSkill;
use Illuminate\Support\Facades\Auth;
use Modules\Staff\app\Models\UserStaff;
use Modules\Staff\app\Models\Rank;
use Modules\Staff\app\Models\Wage;
use Modules\Staff\app\Models\Career;
use Modules\Staff\app\Models\FormWork;
use Illuminate\Support\Facades\Log;
class UserCvController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function index()
    // {
    //     $user = Auth::user();
    //     $item = UserCv::where('user_id', $user->id)->first(); 
    //     // dd($item);
    //     $params = [
    //         'user' => $user,
    //         'item' => $item,
    //     ];
    //     return view('staff::cv.information', $params);
    // }

    public function index()
    {
        $user = Auth::user();
        $items = UserCv::where('user_id', $user->id)->get(); 
        // dd($item);
        $params = [
            'user' => $user,
            'items' => $items,
        ];
        return view('staff::cv.index', $params);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user   = Auth::user();
        $saved = UserCv::create([
            'user_id' => $user->id
        ]);
        return redirect()->route('staff.cv.edit',$saved->id)->with('success', 'Bắt đầu tạo mới hồ sơ');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = UserCv::findOrFail($id);
        $educations = UserEducation::where('cv_id', $id)->get();
        $userExperiences = UserExperience::where('cv_id',$id)->get();
        $userSkills = UserSkill::where('cv_id',$id)->get();
        // dd($educations);
        
        $params = [
            'item' => $item,
            'educations' => $educations,
            'userExperiences' => $userExperiences,
            'userSkills' => $userSkills,
        ];
    
        return view('staff::cv.show', $params);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $user       = Auth::user();
        $tab        = $request->tab ? $request->tab : 'personal-information';
        $item       = UserCv::findOrFail($id);
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
        return view('staff::cv.edit', $params);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserCvRequest $request, $id)
    {
        $cv_id = $id;
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $tab  = $request->tab ? $request->tab : 'personal-information';
        switch ($tab) {
            case 'personal-information':
                $saved = UserCv::savePersonalInformation($request,$cv_id);
                return redirect()->route('staff.cv.edit', ['cv' => $id, 'tab' => 'job-information']) ->with('success', 'Thông tin cá nhân được cập nhật thành công.');;
                break;
            case 'job-information':
                $saved = UserCv::saveJobInformation($request,$cv_id);
                return redirect()->route('staff.cv.edit', ['cv' => $id, 'tab' => 'experience'])  ->with('success', 'Thông tin công việc được cập nhật thành công.');;
                break;
            default:
                return redirect()->route('staff.cv.edit',$id,['id'=>$id,'tab'=>'personal-information'])  ->with('success', 'Hồ sơ được cập nhật thành công.');;
                break;
        }
    }
    /**
     * Remove the specified resource from storage.
     */
  /**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    $userCv = UserCv::findOrFail($id);
    // dd($userCv);
    $userCv->delete();

    return redirect()->route('staff.cv.index')->with('success', 'Đã xóa hồ sơ thành công');
}

}