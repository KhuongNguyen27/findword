<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'action', 'is_read', 'item_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
