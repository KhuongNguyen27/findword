<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\JobFactory;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'jobs';
    protected $fillable = [];
    
    public function job_package(){
        return $this->belongsTo(JobPackage::class,'id','jobpackage_id');
    }

    protected static function newFactory(): JobFactory
    {
        //return JobFactory::new();
    }
}