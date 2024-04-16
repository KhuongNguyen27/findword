<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\JobFactory;
use Illuminate\Support\Facades\Auth;
class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
    public function wage()
    {
        return $this->belongsTo(Wage::class, 'wage_id');
    }
    public function formWork()
    {
        return $this->belongsTo(FormWork::class, 'formwork_id');
    }
        public function userJobFavorites()
    {
        return $this->hasMany(UserJobFavorite::class);
    }
    public function userJobApplied()
    {
        return $this->hasMany(UserJobAplied::class, 'job_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_job_favorites', 'job_id', 'user_id')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userEmployee()
    {
        return $this->belongsTo(UserEmployee::class,'user_id','user_id');
    }
    function getTimeCreateAttribute(){
        return $this->created_at->diffForHumans();
    }
  //is_added_whitlist
    function getIsAddedWhitlistAttribute(){
        $user = Auth::user();
        if($user){
            return UserJobFavorite::where('job_id',$this->id)->where('user', $user)->exists();
        }
        return false;
    } 
    function getStatusFmAttribute(){
        if($this->status == self::INACTIVE){
            return '<span>In Active</span>';
        }else{
            return '<span>Active</span>';
        }
    }
    public function getImage()
    {
        $userEmployee = $this->userEmployee->first();
        if ($userEmployee && $userEmployee->image !== null) {
            return asset($userEmployee->image);
        }
        return "/website-assets/images/favicon.png";
    }

    // public function getImageFmAttribute(){
    //     $user_id = $this->user_id;
    //     $userEmployee = UserEmployee::where('user_id',$user_id)->get();
    //     if ($userEmployee && $userEmployee->image != null) {
    //         return $userEmployee->image;
    //     }
    //     return "/website-assets/images/favicon.png";
    // }
}