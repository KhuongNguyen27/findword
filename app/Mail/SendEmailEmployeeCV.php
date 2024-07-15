<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Staff\app\Models\UserCv;

class SendEmailEmployeeCV extends Mailable
{
    use Queueable, SerializesModels;

    public $cv;
    public $action;

    /**
     * Create a new message instance.
     *
     * @param UserCv $cv
     * @param string $action
     */
    public function __construct(UserCv $cv, $action)
    {
        $this->cv = $cv;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cv.'.$this->action)
                    ->subject('Thông báo về hồ sơ ứng viên');
    }
}
