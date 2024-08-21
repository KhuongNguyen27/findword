<?php

namespace Modules\Permission\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminUser\app\Models\AdminUser as ModelsUser;
use Illuminate\Support\Facades\Hash;
use Modules\Permission\app\Models\Group;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $view_path = 'permission::users.';
    protected $route_prefix = 'users.';
    protected $model = ModelsUser::class;

    public function index()
    {
        $this->authorize('viewAnySystem',Auth::user());

        $items = ModelsUser::where('type','user')->where('status',1)->get();
        $data = [
            'view_path' => $this->view_path,
            'route_prefix' => $this->route_prefix,
            'model' => $this->model,
            'items' => $items,
        ];
        return view($this->view_path.'index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('createSystem',Auth::user());

        $groups = Group::all(); // Lấy tất cả nhóm
        return view('permission::users.create', compact('groups'));
    }

    public function store(Request $request): RedirectResponse
{
    // dd($request->all());
    ModelsUser::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'type' => 'user', // Giá trị mặc định cho type
        'status' => 1, // Giá trị mặc định cho status
        'position' => $request->position ?? 0,
        'group_id' => $request->group_id,
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}


    public function edit($id)
    {
        $this->authorize('updateSystem',Auth::user());

        $user = ModelsUser::findOrFail($id);
        $groups = Group::all(); // Lấy tất cả nhóm
        return view('permission::users.edit', compact('user', 'groups'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = ModelsUser::findOrFail($id);
    
        // Cập nhật dữ liệu mà không validate
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Chỉ mã hóa mật khẩu nếu có thay đổi
            'type' => 'user', // Giá trị mặc định cho type
            'status' => $request->status ?? 1, // Nếu không có giá trị nhập vào, mặc định là 1
            'position' => $request->position ?? 0,
            'group_id' => $request->group_id,
        ]);
    
        return redirect()->route($this->route_prefix . 'index')->with('success', 'User updated successfully.');
    }
    

    public function destroy($id)
    {
        $this->authorize('deleteSystem',Auth::user());

        $user = ModelsUser::findOrFail($id);
        $user->delete();

        return redirect()->route($this->route_prefix . 'index')->with('success', 'User deleted successfully.');
    }
    

}