<?php

namespace Modules\Cvs\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cvs\Database\factories\CvStyleFactory;

class CvStyle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    protected $table = "cv_style";
    protected $fillable = [
        'style_id',
        'cv_id'
    ];
    protected static function newFactory(): CvStyleFactory
    {
        //return CvStyleFactory::new();
    }
}