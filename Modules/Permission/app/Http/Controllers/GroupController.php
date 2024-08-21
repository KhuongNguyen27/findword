<?php

namespace Modules\Permission\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Permission\app\Models\Group;
use Modules\Permission\app\Models\Role;

class GroupController extends Controller
{
    // Hiển thị danh sách nhóm
    protected $view_path = 'permission::groups.';
    protected $route_prefix = 'groups.';
    protected $model = Group::class;

    public function index()
    {
        $this->authorize('viewAnySystem',Auth::user());

        $items = Group::all(); // Lấy tất cả nhóm
        $data = [
            'route_prefix' => $this->route_prefix,
            'items' => $items,
            'model' => $this->model,
        ];
        return view('permission::groups.index', $data);
    }

     // Hiển thị form tạo nhóm mới
     public function create()
     {
        $this->authorize('createSystem',Auth::user());

        $this->authorize('create',Auth::user());
        return view($this->view_path . 'create');
     }
 
     // Lưu nhóm mới vào cơ sở dữ liệu
     public function store(Request $request)
     {
         Group::create($request->only('name'));
 
         return redirect()->route($this->route_prefix . 'index')->with('success', 'Thêm mới nhóm thành công.');
     }
 
     // Hiển thị form chỉnh sửa nhóm
     public function edit($id)
     {
        $this->authorize('updateSystem',Auth::user());

        $this->authorize('update',Auth::user());
        $group = Group::findOrFail($id);
         return view($this->view_path . 'edit', compact('group'));
     }
 
     // Cập nhật nhóm trong cơ sở dữ liệu
     public function update(Request $request, $id)
     {
         $group = Group::findOrFail($id);
         $group->update($request->only('name'));
 
         return redirect()->route($this->route_prefix . 'index')->with('success', 'Cập nhật nhóm thành công.');
     }
 
     // Xóa nhóm
     public function destroy($id)
     {
        $this->authorize('deleteSystem',Auth::user());

         $group = Group::findOrFail($id);
         $group->delete();
 
         return redirect()->route($this->route_prefix . 'index')->with('success', 'Xóa nhóm thành công.');
     }

    public function show($id)
    {
        
        $this->authorize('viewSystem',Auth::user());
        $group = Group::findOrFail($id);
        $permissions = Role::all(); // Lấy tất cả permissions (roles)
        $groupPermissions = $group->roles->pluck('id')->toArray(); // Lấy danh sách ID roles đã gán cho group
        // Truyền biến đến view
        return view('permission::groups.show', compact('group', 'permissions', 'groupPermissions'));
    }

     
     
    public function updateRoles(Request $request, $id)
    {
        // Tìm nhóm theo ID
        $group = Group::findOrFail($id);

        // Đồng bộ vai trò với nhóm
        $group->roles()->sync($request->roles);

        // Trả về thông báo thành công
        return redirect()->route($this->route_prefix . 'index')->with('success', 'Cập nhật quyền thành công.');
    }
}