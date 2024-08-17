<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\UploadFileTrait;


class UserEmployee extends AdminModel
{
    use HasFactory, Notifiable;
    protected $table = 'user_employee';
    use UploadFileTrait;
    public $custom_fields = [
        'name',
        'phone',
        'website',
        'address',
        'image',
        'user_id',
        'about',
        'background',
        'logo_trending',
    ];
    protected $fillable = [
        'name',
        'phone',
        'website',
        'address',
        'image',
        'user_id',
        'about',
        'background',
        'title_color',
        'background_company',
        'logo_trending',
    ];
    public function getImageFmAttribute()
    {
        if ( $this->image != null) {
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

    public function getLogoTrendingFmAttribute()
    {
        if ( $this->logo_trending != null) {
            if( strpos($this->logo_trending,'http') !== false ){
                return $this->logo_trending;
            }
            return asset($this->logo_trending);
        }
        return "/website-assets/images/logo2.png";
    }
}
