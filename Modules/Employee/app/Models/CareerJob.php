<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\CareerJobFactory;
use Modules\Job\app\Models\Job;
class CareerJob extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'career_job';
    protected $fillable = [
        'career_id',
        'job_id'
    ];
    
    protected static function newFactory(): CareerJobFactory
    {
        //return CareerJobFactory::new();
    }

    public function jobs()
    {
        return $this->belongsTo(Job::class);
    }
}
