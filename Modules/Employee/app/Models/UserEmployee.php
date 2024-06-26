<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\UserEmployeeFactory;

class UserEmployee extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'user_employee';
    protected $fillable = [
        'name',
        'phone',
        'slug',
        'website',
        'address',
        'image',
        'user_id',
        'position',
        'tax_code',
        'is_hidden_phone',
        'is_hidden_email',
        'image_business_license',
        'is_allowed_abroad',
    ];
    
   

    /**
     * Get the user that owns the UserEmployee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'user_id', 'user_id');
    }
    // function getImageFmAttribute(){
    //     return $this->userEmployee && $this->userEmployee->image != null ? $this->userEmployee->image :"/website-assets/images/favicon.png";
    // }
    public function getImageFmAttribute()
    {
        if ( $this->image !== null) {
            if( strpos($this->image,'http') !== false ){
                return $this->image;
            }
            return asset($this->image);
        }
        return "/website-assets/images/favicon.png";
    }
    public function getBackgroundFmAttribute()
    {
        if ( $this->background != null) {
            if( strpos($this->background,'http') !== false ){
                return $this->background;
            }
            return asset($this->background);
        }
        return "/website-assets/images/backgroudemploy.jpg";
    }

    public function getImageBusinessLicenseFmAttribute()
    {
        if ( $this->image_business_license != null) {
            if( strpos($this->image_business_license,'http') !== false ){
                return $this->image_business_license;
            }
            return asset($this->image_business_license);
        }
        return "/website-assets/images/backgroudemploy.jpg";
    }
}
