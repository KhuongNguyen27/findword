<?php

namespace Modules\Permission\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Permission\app\Models\Group;

class GroupController extends Controller
{
    // Hiển thị danh sách nhóm
    protected $view_path = 'permission::groups.';
    protected $route_prefix = 'groups.';
    protected $model = Group::class;
    public function index()
    {
        
        $groups = Group::all(); // Lấy tất cả nhóm
        $data = [
            'route_prefix' => $this->route_prefix,
            'groups' => $groups,
            'model' => $this->model,
        ];
        return view('permission::groups.index', $data);
    }

    // Hiển thị form tạo nhóm mới
    public function create()
    {
        return view('admin.groups.create');
    }

    // Lưu nhóm mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Group::create($request->only('name'));

        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    // Hiển thị form chỉnh sửa nhóm
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('admin.groups.edit', compact('group'));
    }

    // Cập nhật nhóm trong cơ sở dữ liệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = Group::findOrFail($id);
        $group->update($request->only('name'));

        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

    // Xóa nhóm
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
