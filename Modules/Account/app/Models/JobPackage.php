<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\JobPackageFactory;

class JobPackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    
    protected $table = 'job_packages';

    protected $fillable = [];
    
    // Relationship
    public function accounts()
    {
        return $this->belongsToMany(Account::class,'account_job_package','account_id','job_package_id');
    }
    public function account()
    {
        return $this->hasMany(AccountJobPackage::class,'id','job_package_id');
    }
    public function job(){
        return $this->hasMany(Job::class,'id','jobpackage_id');
    }
    protected static function newFactory(): JobPackageFactory
    {
        //return JobPackageFactory::new();
    }
}