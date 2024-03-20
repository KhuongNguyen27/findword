<?php

namespace Modules\Permission\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Permission\Database\factories\GroupRoleFactory;

class GroupRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = "group_role";
    protected $fillable = [];
    
    protected static function newFactory(): GroupRoleFactory
    {
        //return GroupRoleFactory::new();
    }
}