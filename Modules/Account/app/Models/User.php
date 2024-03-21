<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\UserFactory;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    const ACTIVE    = 1;
    const INACTIVE  = 0;

    protected $table = 'users';
    protected $fillable = [];
    
    // Relationship
    public function accounts()
    {
        return $this->belongsToMany(Account::class,'user_account');
    }
    public function account()
    {
        return $this->hasMany(UserAccount::class);
    }

    protected static function newFactory(): UserFactory
    {
        //return UserFactory::new();
    }
}