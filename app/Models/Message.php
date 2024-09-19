<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_sent_id', 'user_id', 'message', 'type_user'];

    // Định nghĩa mối quan hệ với người gửi (user_sent)
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_sent_id');
    }

    // Mối quan hệ với người nhận
    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
