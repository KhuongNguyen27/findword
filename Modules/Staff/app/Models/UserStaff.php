<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UploadFileTrait;
class UserStaff extends Model
{
    use HasFactory;
    use UploadFileTrait;
    protected $table = 'user_staff'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'phone',
        'birthdate',
        'experience_years',
        'gender',
        'city',
        'address',
        'outstanding_achievements',
        'image',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function getImageFmAttribute()
    {  
        if ($this->image) {
            return asset($this->image);
            // return $this->image ? asset($this->image): asset('images/profile.jpg');
        } else {
            return asset('website-assets/images/default.jpg');
        }
    }
}