<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserEmployee extends AdminModel
{
    use HasFactory, Notifiable;
    protected $table = 'user_employee';
    public $custom_fields = [
        'name',
        'phone',
        'website',
        'address',
        'image',
        'user_id',
    ];
    protected $fillable = [
        'name',
        'phone',
        'website',
        'address',
        'image',
        'user_id',
    ];
    public function getImageFmAttribute()
    {
        if ( $this->image != null) {
            if( strpos($this->image,'http') !== false ){
                return $this->image;
            }
            return asset('storage/images/'.$this->image);
        }
        return "/website-assets/images/favicon.png";
    }

    public function getBackgroundFmAttribute()
    {
        if ( $this->background != null) {
            if( strpos($this->background,'http') !== false ){
                return $this->background;
            }
            return asset('storage/images/'.$this->background);
        }
        return "/website-assets/images/backgroudemploy.jpg";
    }
}
