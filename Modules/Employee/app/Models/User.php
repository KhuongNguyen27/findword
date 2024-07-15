<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\UserFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Employee\app\Models\UserEmployee;
use Modules\Staff\app\Models\UserCv;

use App\Models\UserStaff;
class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): UserFactory
    {
        //return UserFactory::new();
    }

    // Relationships
    public function userEmployee(): HasOne
    {
        return $this->hasOne(UserEmployee::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function getImage($user_id)
    {
        $userEmployee = UserEmployee::where('user_id', $user_id)->first();

        if ($userEmployee && $userEmployee->image != null) {
            return $userEmployee->image;
        }
        return "/website-assets/images/favicon.png";
    }
    public function userStaff(){
        return $this->hasOne(UserStaff::class);
    }

    public function cvs()
    {
        return $this->belongsToMany(UserCv::class, 'employee_cv', 'user_id', 'cv_id');
    }
  
}
