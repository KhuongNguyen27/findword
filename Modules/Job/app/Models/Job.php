<?php

namespace Modules\Job\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Employee\Database\factories\JobFactory;

use Modules\Employee\app\Models\User;
use Modules\Employee\app\Models\UserEmployee;
use Modules\Staff\app\Models\UserJobFavorite;
use Modules\Employee\app\Models\CareerJob;

use Carbon\Carbon;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = "jobs";
    protected $fillable = [
        'user_id ',
        'name ',
        'career_id ',
        'Work_address ',
        'Job_description',
        'Job_requirements ',
        'wage_id',
        'formwork_id',
    ];
    // Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function careers()
    {
        return $this->belongsToMany(Career::class);
    }
    public function wage()
    {
        return $this->belongsTo(Wage::class, 'wage_id');
    }
    public function formWork()
    {
        return $this->belongsTo(FormWork::class, 'formwork_id');
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
    public function userEmployee()
    {
        return $this->belongsTo(UserEmployee::class, 'user_id', 'user_id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class,'degree_id','id');
    }
    //Feature
    function getImageFmAttribute(){
        return $this->userEmployee && $this->userEmployee->image != null ? $this->userEmployee->image :"/website-assets/images/favicon.png";
    }
    function getWageFmAttribute(){
        return number_format($this->wage, 0, ',', '.');
    }
    function getTimeCreateAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function getImage()
    {
        if ($this->image != null) {
            return "/website-assets/images/".$this->image;
        }
        return "/website-assets/images/favicon.png";
    }

    public function getJobforCareerId ($career_id) {
        $careerJobs = CareerJob::where('career_id', $career_id)->get();
        $jobs = $careerJobs->map(function ($careerJob) {
            return $this::find($careerJob->job_id);
        });
        return $jobs;
    }


}