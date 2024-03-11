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
            return (new MailMessage)->view('auth::mail',['data'=> $this->data]);
        } else if ($this->type === "register") {
            return (new MailMessage)->view('staff::auth.mail-register',['data'=> $this->data]);
        } else if ($this->type === "transfer") {
            return (new MailMessage)->view('transaction::mail-transfer',['data'=> $this->data]);
        } else if ($this->type === "applied-job") {
            return (new MailMessage)->view('employee::auth.mail-applied-job',['data'=> $this->data]);
        } else if ($this->type === "updated-job") {
            return (new MailMessage)->view('employee::auth.mail-updated-job',['data'=> $this->data]);
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