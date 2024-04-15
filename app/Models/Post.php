<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends AdminModel
{
    use HasFactory;
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
    public function getShortDescriptionAttribute()
    {
        if ( empty($this->short_description) ) {
            return strip_tags( substr($this->description,0,100) );
        }
        return $this->short_description;
    }
}
