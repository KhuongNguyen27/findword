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
        return $this->belongsToMany(CareerJob::class, 'career_job', 'job_id', 'career_id');
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
    public function getImage($user_id)
    {
        $userEmployee = $this->userEmployee;

        if ($userEmployee && $userEmployee->image != null) {
            return $userEmployee->image;
        }
        return "/website-assets/images/favicon.png";
    }

    public function getJobfor_career_id ($career_id) {
        $careerJobs = CareerJob::where('career_id', $career_id)->get();
        $jobs = $careerJobs->map(function ($careerJob) {
            return $this::find($careerJob->job_id);
        });
        return $jobs;
    }
    public static function checkInfo(){
        // $user = Auth::
    }
}