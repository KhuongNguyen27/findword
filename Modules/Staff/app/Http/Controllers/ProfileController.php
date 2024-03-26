<?php

namespace Modules\Staff\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Modules\Staff\app\Http\Requests\UpdateUserStaffRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Staff\app\Models\UserStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Ward;
use Modules\Staff\app\Http\Requests\ChangepasswordRequest;
use Modules\Staff\app\Models\UserJobAplied;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $item = UserStaff::where('user_id', $user->id)->with('user')->first();
        $provinces = \DB::table('provinces')->get();
        $districts = District::get();
        $wards = Ward::get();
        
        $params = [
            'item' => $item,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards'=> $wards,
        ];

        return view('staff::index', $params);
    }

    public function districts(Request $request)
    {
        $provinceId = $request->input('province_id');
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }
    
    public function wards(Request $request)
    {
        $districtId = $request->input('district_id');
        $wards = Ward::where('district_id', $districtId)->get();
        return response()->json($wards);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('staff::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('staff::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserStaffRequest $request, $id)
    {
        // dd(123);
        // dd($request->all());
        $staff = UserStaff::findOrFail($id);
        $user = $staff->user;
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);


        $data = [
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'experience_years' => $request->input('experience_years'),
            'gender' => $request->input('gender'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'outstanding_achievements' => $request->input('outstanding_achievements'),
           'province_id'=>$request->input('province_id'),
           'district_id'=>$request->input('district_id'),
           'ward_id'=>$request->input('ward_id'),

        ];
        if ($request->hasFile('image')) {
            $imagePath = UserStaff::uploadFile($request->file('image'), 'images');
            $data['image'] = $imagePath;
        }
        $staff->update($data);
        return back()->with('success', 'Thông tin đã được cập nhật thành công.');
    }
    public function dashboard()
    {
        $user = auth()->user();
        $userJobApplies = UserJobAplied::where('user_id', $user->id)->get();
        $params = [
            'userJobApplies' => $userJobApplies,
        ];
        return view('staff::profile.dashboard', $params);
    }

    public function editpassword()
    {
        $user = Auth::user();
        return view('staff::change-password.edit', compact(['user']));
    }
    public function changePassword(ChangepasswordRequest $request, $userId)
    {
       
        $user = User::findOrFail($userId);
        // dd($user);
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with(['error' => 'Mật khẩu hiện tại không chính xác.']);
        }
        $user->password = Hash::make($request->newpassword);
        $user->save();
        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}