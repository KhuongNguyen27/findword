<?php

// app/Http/Controllers/Admin/PopupController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePopupRequest;
use App\Http\Requests\UpdatePopupRequest;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PopupController extends Controller
{
    public function index()
    {
        $this->authorize('viewAnySystem', Auth::user());

        $popups = Popup::all();
        return view('admin.popups.index', compact('popups'));
    }

    public function create()
    {
        $this->authorize('createSystem', Auth::user());

        // Kiểm tra sự tồn tại của popup
        // $popup = Popup::first();
        // if ($popup) {
        //     // Nếu đã tồn tại, chuyển hướng đến trang chỉnh sửa
        //     return redirect()->route('popups.edit', $popup->id);
        // }

        return view('admin.popups.create');
    }

    public function store(StorePopupRequest $request)
    {
        // Kiểm tra sự tồn tại của popup
        // $popup = Popup::first();

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images/popups', 'public'); // Lưu ảnh vào thư mục 'images/popups' trong 'storage/app/public'
            $data['image'] = $imagePath;
        }

        // if ($popup) {
        //     // Nếu popup đã tồn tại, cập nhật nó
        //     $popup->update($data);
        // } else {
        //     // Nếu chưa tồn tại, tạo mới
        //     Popup::create($data);
        // }
            Popup::create($data);

        return redirect()->route('popups.index')->with('success', 'Popup đã được thêm hoặc cập nhật thành công!');
    }

    public function edit($id)
    {
        $this->authorize('updateSystem', Auth::user());

        $item = Popup::findOrFail($id);
        return view('admin.popups.edit', compact('item'));
    }

    public function update(UpdatePopupRequest $request, Popup $popup)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($popup->image && file_exists(storage_path('app/public/' . $popup->image))) {
                unlink(storage_path('app/public/' . $popup->image));
            }
            // Lưu ảnh mới
            $image = $request->file('image');
            $imagePath = $image->store('images/popups', 'public');
            $data['image'] = $imagePath;
        } else {
            // Giữ lại giá trị ảnh cũ nếu không có ảnh mới
            $data['image'] = $popup->image;
        }

        $popup->update($data);

        return redirect()->route('popups.index')->with('success', 'Popup updated successfully.');
    }

    public function destroy(Popup $popup)
    {
        $this->authorize('deleteSystem', Auth::user());

        $popup->delete();
        return redirect()->route('popups.index')->with('success', 'Popup deleted successfully.');
    }
}
