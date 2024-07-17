<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\JobViewFactory;

class JobView extends Model
{
    use HasFactory;
    protected $table = 'job_views';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', 'job_id'
    ];
    
    protected static function newFactory(): JobViewFactory
    {
        //return JobViewFactory::new();
    }
}
