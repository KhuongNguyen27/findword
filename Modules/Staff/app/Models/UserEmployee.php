<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\UserEmployeeFactory;

class UserEmployee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "user_employee";
    public function jobs()
    {
        return $this->hasMany(Job::class,'user_id','user_id');
    }
    
    protected static function newFactory(): UserEmployeeFactory
    {
        //return UserEmployeeFactory::new();
    }
    
}