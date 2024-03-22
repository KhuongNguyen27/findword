<?php

namespace Modules\Job\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Job\Database\factories\CareerJobFactory;

class CareerJob extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "career_job";
    protected static function newFactory(): CareerJobFactory
    {
        //return CareerJobFactory::new();
    }
}