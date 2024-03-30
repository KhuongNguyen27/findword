<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\app\Models\JobApplication;
class UserCv extends Model
{
    use HasFactory;
    protected $table = 'user_cvs';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'cv_file',
        'name',
        'email',
        'phone',
        'birthdate',
        'experience_years',
        'gender',
        'city',
        'address',
        'outstanding_achievements',
        'desired_position',
        'rank_id',
        'form_work_id',
        'career_id',
        'desired_location',
        'wage_id',
        'career_objective',
        'file_path',
        'typeCV',
    ];
    public static function savePersonalInformation($request,$cv_id = 0){
        if($cv_id){
            $item = self::find($cv_id);
            if(!$item){
                $item = new self;
            }
        }else{
            $item = new self;
        }
        $item->name = $request->name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->birthdate = $request->birthdate;
        $item->gender = $request->gender;
        $item->experience_years = $request->experience_years;
        $item->city = $request->city;
        $item->address = $request->address;
        $item->outstanding_achievements = $request->outstanding_achievements;
        $item->user_id = $request->user_id;
        $item->save();
        return $item;
    }
    public static function saveJobInformation($request,$cv_id = 0){
        if($cv_id){
            $item = self::find($cv_id);
        }else{
            $item = new self;
        }
        $item->cv_file = $request->cv_file;
        $item->desired_position = $request->desired_position;
        $item->rank_id = $request->rank_id;
        $item->form_work_id = $request->form_work_id;
        $item->experience_years = $request->experience_years;
        $item->career_id = $request->career_id;
        $item->desired_location = $request->desired_location;
        $item->wage_id = $request->wage_id;
        $item->career_objective = $request->career_objective;
        $item->save();
        return $item;
    }
    public function userExperiences()
    {
        return $this->hasMany(UserExperience::class, 'cv_id');
    }
    public function userEducations()
    {
        return $this->hasMany(UserEducation::class, 'cv_id');
    }

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class, 'cv_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function jobApplications()
    // {
    //     return $this->hasMany(JobApplication::class, 'cv_id');
    // }
    public function userJobAplies()
    {
        return $this->hasMany(UserJobAplied::class, 'user_id');
    }
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }
    function getImageFmAttribute()
    {  
        if ($this->image) {
            return asset($this->image);
            // return $this->image ? asset($this->image): asset('images/profile.jpg');
        } else {
            return asset('website-assets/images/favicon.png');
        }
    }
    public function wage()
    {
        return $this->belongsTo(Wage::class);
    }
    public function formWork()
    {
        return $this->belongsTo(FormWork::class);
    }
    public function career()
    {
        return $this->belongsTo(Career::class);
    }
    function getTimeCreateAttribute(){
        return $this->created_at->diffForHumans();
    }
}