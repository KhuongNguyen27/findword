<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifications extends Notification
{
    use Queueable;
    public $type = "";
    public $data = [];
    /**
     * Create a new notification instance.
     */
    public function __construct($type,$data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if($this->type === "forgotpassword"){
            // return (new MailMessage)->view('auth::mail',['data'=> $this->data]);
            return (new MailMessage)
            ->greeting("Xin chào, {$this->data['name']}")
            ->line("Bạn nhận được email này vì chúng tôi nhận được yêu cầu lấy lại mật khẩu cho tài khoản của bạn.")
            ->line("Nhấp vào liên kết để đặt lại mật khẩu")
            ->line("Email của bạn: {$this->data['email']}")
            ->line("Hãy nhớ liên kết chỉ hoạt động một lần khi nhấp chuột")
            ->action('Đặt lại mật khẩu', route('auth.getReset', $this->data['token']))
            ->line("Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.")
            ->line("Thanks,");
        } else if ($this->type === "register") {
            // return (new MailMessage)->view('staff::auth.mail-register',['data'=> $this->data]);
            return (new MailMessage)
            ->greeting("Xin chào,")
            ->line("Findwork vừa có thành viên mới")
            ->line("ID: {$this->data['id']}")
            ->line("Tên: {$this->data['name']}")
            ->line("Email: {$this->data['email']}")
            ->line("Loại tài khoản: {$this->data['type']}")
            ->line("Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.")
            ->line("Thanks,");          
        } else if ($this->type === "transfer") {
            // return (new MailMessage)->view('transaction::mail-transfer',['data'=> $this->data]);
            return (new MailMessage)
            ->greeting("Xin chào")
            ->line("Findwork vừa có giao dịch mới!")
            ->line("Mã giao dịch: {$this->data['id']}")
            ->line("ID Người giao dịch: {$this->data['user_id']}")
            ->line("Loại giao dịch: {$this->data['type']}")
            ->line("Số tiền giao dịch: {$this->data['amount']}")
            ->line("Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.")
            ->line("Thanks,");
        } else if ($this->type === "applied-job") {
            // return (new MailMessage)->view('employee::auth.mail-applied-job',['data'=> $this->data]);
            return (new MailMessage)
            ->greeting("Xin chào,")
            ->line("Bạn đã nhận được CV")
            ->line("Người nộp: {$this->data['name_applied']}")
            ->line("Email: {$this->data['email_applied']}")
            ->line("Công việc ứng tuyển: {$this->data['job']}")
            ->line("Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.")
            ->line("Thanks,");
        } else if ($this->type === "updated-job") {
            return (new MailMessage)
            ->greeting("Xin chào,{$this->data['name']}")
            ->line("CV của bạn đã được duyệt")
            ->line("Công việc ứng tuyển : {$this->data['job']}")
            ->line("Hãy chuẩn bị cho buổi phỏng vấn nhé !");
        } else if ($this->type === "refuse-job") {
            return (new MailMessage)
            ->greeting("Xin chào,{$this->data['name']}")
            ->line("Cv ứng tuyển công việc {$this->data['job']} của bạn đã không đáp ứng yêu cầu!")
            ->line('Hãy thử lại công việc khác nhé');
        } else if ($this->type === "read-cv") {
            return (new MailMessage)
            ->greeting("Xin chào,{$this->data['name']}")
            ->line("Nhà tuyển dụng đã đọc CV ứng tuyển công việc {$this->data['job']} của bạn!")
            ->line('Hãy chuẩn bị nhé');
        } else if ($this->type === 'active-job') {
            return (new MailMessage)
                ->greeting("Xin chào, {$this->data['name']}")
                ->line("Tin đăng của bạn đã được duyệt")
                ->line("Tiêu đề tin đăng: {$this->data['job_title']}")
                ->line("Chúc mừng bạn đã hoàn tất quá trình duyệt tin đăng!");
        } elseif ($this->type === 'rejected-job') {
            return (new MailMessage)
                ->greeting("Xin chào, {$this->data['name']}")
                ->line("Tin đăng với tiêu đề {$this->data['job_title']} của bạn đã bị từ chối.")
                ->line('Hãy thử tạo tin đăng khác hoặc liên hệ với chúng tôi nếu cần thêm thông tin.');
        } elseif ($this->type === 'veryfi') {
            return (new MailMessage)
            ->greeting("Xin chào, {$this->data['name']}")
            ->line("Tài khoản của bạn đã được xác thực.")
            ->line("Chúng tôi rất vui thông báo rằng tài khoản của bạn đã được xác thực thành công.")
            ->line("Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.")
            ->line("Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!");
    }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}