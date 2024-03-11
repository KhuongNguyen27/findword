<?php

namespace Modules\Staff\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Staff\app\Models\UserEducation;
use Modules\Staff\app\Http\Requests\StoreUserEducationRequest;

use Illuminate\Support\Facades\Auth;
use Modules\Staff\app\Http\Requests\UpdateUserEducationRequest;

class UserEducationController extends Controller
{
    
    public function store(StoreUserEducationRequest $request): RedirectResponse
    {
        // dd($request->all());    
        $user = Auth::user();
        $education = new UserEducation([
            'user_id' => $user->id,
            'cv_id' => $request->cv_id,
            'numerical' => $request->numerical,
            'rank_id' => $request->rank_id,
            'school_course' => $request->school_course,
            'graduation_date' => $request->graduation_date,
            'language' => $request->language,
            'major' => $request->major,
        ]);
        // dd($education);
        $education->save();
        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserEducationRequest $request, $id): RedirectResponse
    {
        $education = UserEducation::findOrFail($id);
        $education->update([
            'numerical' => $request->numerical,
            'rank_id' => $request->rank_id,
            'school_course' => $request->school_course,
            'graduation_date' => $request->graduation_date,
            'language' => $request->language,
            'major' => $request->major,
        ]);
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $education = UserEducation::findOrFail($id);
        // dd($education);
        $education->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
