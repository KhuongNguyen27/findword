<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{


    public function getNotification()
    {
        // Số lượng thông báo hiện tại trong bảng
        $notifications = Notification::where('user_id', Auth::id())->latest()->take(10)->get();
        $data = [];
        // Đếm số lượng thông báo chưa đọc
        $unreadCount = Notification::where('user_id', Auth::id())
            ->where('is_read', 0)
            ->count();
        foreach ($notifications as $notification) {
            // Xử lý tin nhắn
            $actionMessage = '';
            $title = '';
            $icon = '';

            switch ($notification->action) {
                case 'approved':
                    $actionMessage = 'Tin đăng của bạn đã được duyệt';
                    $title = 'Công việc được duyệt';
                    $icon = 'check_circle';
                    break;

                case 'rejected':
                    $actionMessage = 'Tin đăng của bạn đã bị từ chối';
                    $title = 'Công việc bị từ chối';
                    $icon = 'cancel';
                    break;

                case 'applied':
                    $actionMessage = 'nộp đơn';
                    $title = 'Ứng viên nộp đơn';
                    $icon = 'person_add';
                    break;

                case 'viewed':
                    $actionMessage = 'Xem hồ sơ';
                    $title = 'NTD đã xem hồ sơ';
                    $icon = 'visibility';
                    break;
                case 'hire':
                    $actionMessage = 'Phù hợp';
                    $title = 'Phù hợp';
                    $icon = 'check';
                    break;
            
                case 'reject':
                    $actionMessage = 'Chưa phù hợp';
                    $title = 'Chưa phù hợp';
                    $icon = 'close';
                    break;
                default:
                    $actionMessage = 'Thông báo mới';
                    $title = 'Thông báo';
                    $icon = 'notifications';
                    break;
            }

            $data[] = [
                'message' => $actionMessage,
                'time' => $notification->created_at->diffForHumans(),
                'icon' => $icon,
                'title' => $title,
                'type' => $notification->type
            ];
            // dd($data);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'unreadCount' => $unreadCount,
            'count' => $notifications->count()
        ]);
    }


    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Tất cả thông báo đã được đánh dấu là đã đọc.'
        ]);
    }


    // public function getNotification()
    // {
    //     // Số lượng thông báo hiện tại trong bảng
    //     $notifications = Notification::where('user_id', Auth::id())->latest()->take(10)->get();
    //     $data = [];
    //     $message = 'Tin đăng của bạn đã ';

    //     foreach ($notifications as $notification) {
    //         //xử lí messages
    //         $actionMessage = ($notification->action == 'rejected')
    //             ? $message . "bị từ chối"
    //             : $message . "thành công";

    //         // Xử lí title và icon
    //         $type = $notification->type;
    //         switch ($notification->type) {
    //             case 'job':
    //                 $title = "Công việc";
    //                 $icon = "forum";
    //                 break;
    //         }
    //         $data[] = [
    //             'message' => $actionMessage,
    //             'time' => $notification->created_at->diffForHumans(),
    //             'icon' => $icon,
    //             'title' => $title,
    //             'type' => $type
    //         ];
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data' => $data,
    //         'count' => $notifications->count()
    //     ]);
    // }
}
