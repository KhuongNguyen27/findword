<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\UserJobApplyFactory;
use Modules\Staff\app\Models\UserCv;
use Modules\Employee\app\Models\User;
class UserJobApply extends Model
{
    use HasFactory;
    
    const ACTIVE = 1;
    const INACTIVE = 0;
    const DRAFT = -1;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'user_job_applies';
    protected $fillable = [
        
    ];
    
    protected static function newFactory(): UserJobApplyFactory
    {
        //return UserJobApplyFactory::new();
    }

    public function cv()
    {
        return $this->belongsTo(UserCv::class, 'cv_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the job associated with the job application.
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}