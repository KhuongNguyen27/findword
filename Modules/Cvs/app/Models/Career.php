<?php

namespace Modules\Cvs\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cvs\Database\factories\CareerFactory;

class Career extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    protected $table = "careers";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status',
        'position'
    ];
    
    public function cvs(){
        return $this->belongsToMany(Cv::class,'cv_career');
    }
    public function cv_career(){
        return $this->hasMany(CvCareer::class);
    }
    
    protected static function newFactory(): CareerFactory
    {
        //return CareerFactory::new();
    }
}