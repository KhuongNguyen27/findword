<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\JobFactory;
use Modules\Employee\app\Models\User;
use Modules\Staff\app\Models\UserCv;
use Modules\Staff\app\Models\UserJobFavorite;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Career;
use App\Models\FormWork;
use App\Models\JobPackage;
use App\Models\Level;
use App\Models\Rank;
use App\Models\Wage;
use App\Models\JobProvince;
use App\Models\Province;
use App\Models\Country;
use App\Models\Job as MainJob;

class Job extends MainJob
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id ',
        'name ',
        'career ',
        'Work_address ',
        'Job_description',
        'Job_requirements ',
        'wage ',
        'type_work ',
    ];

    const ACTIVE    = 1;
    const INACTIVE  = 0;
    const DRAFT     = -1;
   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function viewedUsers()
    {
        return $this->belongsToMany(User::class, 'job_views');
    }
    public function jobViews()
    {
        return $this->hasMany(JobView::class);
    }
    public function userCvs()
    {
        return $this->hasMany(UserCv::class, 'rank_id', 'rank_id');
    }
    public function jobApplications()
    {
        return $this->hasMany(UserJobApply::class, 'job_id');
    }
    public function userEmployee()
    {
        return $this->belongsTo(UserEmployee::class, 'user_id', 'user_id');

    }
    
    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_job', 'job_id', 'career_id');
    }

    public function formwork()
    {
        return $this->belongsTo(FormWork::class);
    }

    public function jobPackage()
    {
        return $this->belongsToMany(JobPackage::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function wage()
    {
        return $this->belongsTo(Wage::class);
    }

    public function getImage($user_id = 0)
    {
        $userEmployee = $this->userEmployee;

        if ($userEmployee && $userEmployee->image != null) {
            return $userEmployee->image;
        }

        // You might want to provide a default image here
        return "/website-assets/images/favicon.png";
    }
    public function getShortNameAttribute()
    {
        return \Illuminate\Support\Str::limit($this->name, 30);
    }
}

