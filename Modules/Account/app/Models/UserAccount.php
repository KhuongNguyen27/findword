<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\UserAccountFactory;

class UserAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    
    protected $table = 'user_account';
    protected $fillable = [
        'user_id',
        'account_id',
        'duration_id',
        'register_date',
    ];
    
    // Relationship
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }

    protected static function newFactory(): UserAccountFactory
    {
        //return UserAccountFactory::new();
    }
}