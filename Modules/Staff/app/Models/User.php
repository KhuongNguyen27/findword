<?php

namespace Modules\Staff\app\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
        
    ];
    // Trong mô hình User.php
    public function userJobFavorites()
    {
        return $this->hasMany(UserJobFavorite::class);
    }
    public function userExperiences()
    {
        return $this->hasMany(UserExperience::class);
    }
    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
    public function userEducations()
    {
        return $this->hasMany(UserEducation::class);
    }
    public function staffUser()
    {
        return $this->hasOne(StaffUser::class);
    }
    public function userStaff()
    {
        return $this->hasOne(UserStaff::class);
    }
    
    public function userCv()
    {
        return $this->hasOne(UserCv::class);
    }
    public function cvsExample()
    {
        return $this->hasOne(CvsExample::class);
    }
   // Trong User.php
   public function jobs()
   {
       return $this->belongsToMany(Job::class, 'user_job_favorites', 'user_id', 'job_id')->withTimestamps();
   }

}