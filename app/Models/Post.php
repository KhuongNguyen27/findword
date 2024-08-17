<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends AdminModel
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug',
        'short_description',
        'description',
        'metas',
        'image',
        'gallery',
        'status',
        'position',
        'user_id',
        'category',
    ];
    public function getImageFmAttribute()
    {
        if ( $this->image != null) {
            if( strpos($this->image,'http') !== false ){
                return $this->image;
            }
            return asset(''.$this->image);
        }
        return "/website-assets/images/favicon.png";
    }
    // public function getShortDescriptionAttribute()
    // {
    //     if ( empty($this->short_description) ) {
    //         return strip_tags( substr($this->description,0,100) );
    //     }
    //     return $this->short_description;
    // }
    public function getShortDescriptionAttribute()
    {
        if (empty($this->attributes['short_description'])) {
            // Loại bỏ các thẻ HTML trước khi cắt chuỗi
            $cleanDescription = strip_tags($this->description);
            // Sử dụng mb_strimwidth để cắt chuỗi sau khi loại bỏ thẻ HTML
            return mb_strimwidth($cleanDescription, 0, 85, '...');
        }
        
        return $this->attributes['short_description'];
    }
    

}
