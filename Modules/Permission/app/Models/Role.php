<?php

namespace Modules\Permission\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Permission\Database\factories\RoleFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = "roles";
    protected $fillable = ['name'];
    
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_role', 'role_id', 'group_id');
    }
    
    protected static function newFactory(): RoleFactory
    {
        //return RoleFactory::new();
    }
}