<?php

namespace Modules\Cvs\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cvs\Database\factories\CvFactory;

class Cv extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    protected $table = 'cvs';
    protected $fillable = [
        'name',
        'image',
        'language',
        'file_cv',
        'status',
    ];
    public function styles(){
        return $this->belongsToMany(Style::class,'cv_style');
    }

    public function careers(){
        return $this->belongsToMany(Career::class,'cv_career');
    }
    
    protected static function newFactory(): CvFactory
    {
        //return CvFactory::new();
    }
}