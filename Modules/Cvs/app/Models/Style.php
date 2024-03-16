<?php

namespace Modules\Cvs\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cvs\Database\factories\StyleFactory;

class Style extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    protected $table = "styles";
    protected $fillable = [
        'name',
        'description',
        'image',
        'status'
    ];

    public function cvs(){
        return $this->belongsToMany(Cv::class,'cv_style');
    }
    
    protected static function newFactory(): StyleFactory
    {
        //return StyleFactory::new();
    }
}