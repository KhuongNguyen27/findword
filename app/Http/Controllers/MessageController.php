<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\UserEmployee;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($user_id)
    {


        // Lấy thông tin người nhận (admin hoặc người dùng khác)
        $user = User::findOrFail($user_id);

        // Kiểm tra xem người nhận có phải là admin không
        $isAdmin = $user->type === 'user';

        // Lấy tất cả tin nhắn giữa người dùng hiện tại và người dùng khác
        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('user_sent_id', Auth::id())
                ->orWhere('user_id', Auth::id());
        })
            ->where(function ($query) use ($user_id) {
                $query->where('user_sent_id', $user_id)
                    ->orWhere('user_id', $user_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        // Cập nhật trạng thái tin nhắn thành đã đọc cho tin nhắn của người dùng hiện tại
        Message::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        // Tính số lượng tin nhắn chưa đọc từ người gửi hiện tại tới người nhận
        $unreadMessagesCount = Message::where('user_sent_id', $user_id)
            ->where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();
        return view('website.messages.index', compact('messages', 'user', 'isAdmin', 'unreadMessagesCount'));
    }

    public function staff($user_id)
    {
        // Lấy thông tin người nhận
        $user = User::findOrFail($user_id);
// Kiểm tra xem người nhận có phải là admin không
$isAdmin = $user->type === 'user';
        // Lấy tất cả tin nhắn giữa người dùng hiện tại và người dùng khác
        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('user_sent_id', Auth::id())
                ->orWhere('user_id', Auth::id());
        })
            ->where(function ($query) use ($user_id) {
                $query->where('user_sent_id', $user_id)
                    ->orWhere('user_id', $user_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Cập nhật trạng thái tin nhắn thành đã đọc
        Message::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Tính số lượng tin nhắn chưa đọc
        $unreadMessagesCount = Message::where('user_sent_id', $user_id)
            ->where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return view('website.messages.staff', compact('messages', 'user','isAdmin','unreadMessagesCount'));
    }


    // public function create()
    // {
    //     // Lấy thông tin admin
    //     $admin = User::where('type', 'user')->first();

    //     if (!$admin) {
    //         return redirect()->back()->with('error', 'Admin không tìm thấy.');
    //     }

    //     return view('website.messages.create', compact('admin'));
    // }



    public function store(Request $request, $user_id)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        // Kiểm tra người nhận có phải là admin không
        $user = User::findOrFail($user_id);
        $type_user = $user->type; // Lưu loại người dùng (admin hoặc user)

        // Tạo tin nhắn mới
        Message::create([
            'user_sent_id' => Auth::id(), // Người gửi là người dùng đang đăng nhập
            'user_id' => $user_id, // Người nhận là người dùng đích
            'message' => $request->message,
            'type_user' => $type_user, // Có thể là 'user' hoặc 'admin'
        ]);

        return redirect()->route('messages.index', $user_id)->with('success', 'Tin nhắn đã được gửi.');
    }

    public function adminMessages($user_id)
    {
        $search_name = request('search_name');
        $search_type = request('search_type');

        // Lấy tất cả các user ID đã gửi tin nhắn đến admin
        $userIds = Message::where(function ($query) {
            $query->where('user_sent_id', '!=', Auth::id())  // Loại bỏ tin nhắn của admin
                ->where('user_id', Auth::id());            // Admin nhận tin nhắn
        })
            ->pluck('user_sent_id')  // Lấy ID người gửi tin nhắn
            ->unique();  // Loại bỏ các ID trùng lặp

        // Lấy thông tin các người dùng dựa trên các ID lấy được và áp dụng bộ lọc tìm kiếm
        $usersQuery = User::whereIn('id', $userIds);

        if ($search_name) {
            $usersQuery->where('name', 'like', '%' . $search_name . '%');
        }

        if ($search_type) {
            $usersQuery->where('type', $search_type);
        }

        $users = $usersQuery->get();

        // Lấy tất cả tin nhắn giữa admin và người dùng
        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('user_sent_id', Auth::id())  // Admin gửi tin nhắn
                ->orWhere('user_id', Auth::id());    // Admin nhận tin nhắn
        })
            ->where(function ($query) use ($user_id) {
                $query->where('user_sent_id', $user_id)  // Người dùng gửi tin nhắn
                    ->orWhere('user_id', $user_id);   // Người dùng nhận tin nhắn
            })
            ->orderBy('created_at', 'asc')
            ->with(['sender', 'receiver']) // Nạp quan hệ
            ->get();

        return view('admin.messages.index', compact('messages', 'users', 'user_id'));
    }





    // Phản hồi tin nhắn từ admin
    public function reply(Request $request, $message_id)
    {

        $originalMessage = Message::findOrFail($message_id);
        $user_id = $originalMessage->user_sent_id;
        if ($originalMessage->type_user == 'admin') {
            $user_id = $originalMessage->user_id;
        }
        Message::create([
            'user_sent_id' => Auth::id(), // Admin gửi phản hồi
            'user_id' => $user_id, // Người gửi ban đầu
            'message' => $request->message,
            'type_user' => 'admin', // Admin trả lời
        ]);

        return redirect()->route('admin.messages.index', $originalMessage->user_sent_id)->with('success', 'Phản hồi đã được gửi.');
    }
    // Hiển thị form để tạo tin nhắn mới từ admin
    public function create($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('admin.messages.create', compact('user'));
    }
    // Lưu tin nhắn mới từ admin
    public function stores(Request $request, $user_id)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $user = User::findOrFail($user_id);

        Message::create([
            'user_sent_id' => Auth::id(), // Admin gửi tin nhắn
            'user_id' => $user_id, // Người nhận là staff hoặc employee
            'message' => $request->message,
            'type_user' => $user->type,
        ]);

        return redirect()->route('admin.messages.index', $user_id)->with('success', 'Tin nhắn đã được gửi.');
    }
    // app/Http/Controllers/MessageController.php
    public function messageDetails($user_id)
    {
        // Lấy tất cả tin nhắn giữa admin và người dùng
        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('user_sent_id', Auth::id())
                ->orWhere('user_id', Auth::id());
        })
            ->where(function ($query) use ($user_id) {
                $query->where('user_sent_id', $user_id)
                    ->orWhere('user_id', $user_id);
            })
            ->orderBy('created_at', 'asc')
            ->with(['sender', 'receiver']) // Nạp quan hệ
            ->get();

        $user = User::findOrFail($user_id);

        return view('admin.messages.details', compact('messages', 'user'));
    }
    public function compose()
    {
        // Lấy danh sách employees và staff từ bảng users, dựa vào cột 'type'
        $employees = User::where('type', 'employee')->get();
        $staffs = User::where('type', 'staff')->get();
        // $employees = User::where('type', 'employee')->paginate(20);
        // $staffs = User::where('type', 'staff')->paginate(20);

        // Truyền dữ liệu sang view recipients.blade.php
        return view('admin.messages.compose', compact('employees', 'staffs'));
    }

    public function send(Request $request)
    {
        $recipients = $request->input('recipients', []);
        $messageText = $request->input('message');
        if (!is_array($recipients) || empty($recipients)) {
            return redirect()->route('admin.messages.compose')
                ->with('error', 'Không có người nhận nào được chọn.');
        }

        foreach ($recipients as $recipientId) {
            Message::create([
                'user_sent_id' => Auth::id(),
                'user_id' => $recipientId,
                'message' => $messageText,
                'type_user' => 'admin',
            ]);
        }

        return redirect()->route('admin.messages.compose')
            ->with('success', 'Tin nhắn đã được gửi đến các người nhận.');
    }

    public function recipients(Request $request)
    {
        $search = $request->input('search');

        // Tìm kiếm Employee từ bảng userEmployee
        $employees = User::whereHas('userEmployee', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })->where('type', 'employee')->get();
        // Tìm kiếm Staff
        $staffs = User::where('type', 'staff')
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        return view('admin.messages.compose', compact('employees', 'staffs'));
    }
}
