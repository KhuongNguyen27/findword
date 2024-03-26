<?php

namespace Modules\Cvs\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cvs\Database\factories\CvCareerFactory;

class CvCareer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    protected $table = "cv_career";
    protected $fillable = [
        'career_id',
        'cv_id'
    ];
    
    public function career(){
        return $this->belongsTo(Career::class);
    }

    public function cv(){
        return $this->belongsTo(Cv::class);
    }
    
    protected static function newFactory(): CvCareerFactory
    {
        //return CvCareerFactory::new();
    }
}