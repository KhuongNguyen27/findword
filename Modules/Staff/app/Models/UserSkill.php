<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\UserSkillFactory;

class UserSkill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'numerical',
        'special_skill',
        'skill_level',
        'description',
        'user_id',
        'cv_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userCv()
    {
        return $this->belongsTo(UserCv::class, 'cv_id');
    }
    public function cvsExample()
    {
        return $this->belongsTo(CvsExample::class, 'cv_id');
    }
}