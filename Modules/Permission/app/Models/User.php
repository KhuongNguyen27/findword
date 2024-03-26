<?php

namespace Modules\Permission\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Permission\Database\factories\UserFactory;
use App\Traits\HasPermissions;

class User extends Model
{
    use HasFactory, HasPermissions, Authenticatable;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = "users";
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
    protected static function newFactory(): UserFactory
    {
        //return UserFactory::new();
    }
}