<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\UserExperienceFactory;

class UserExperience extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
            'user_id',
            'is_current',
            'cv_id',
            'numerical',
            'position',
            'company',
            'rank_id',
            'start_date',
            'end_date',
            'job_description',
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
    protected $casts = [
        // 'start_date' => 'date',
        // 'end_date' => 'date',
    ];
}