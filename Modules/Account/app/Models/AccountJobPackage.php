<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\AccountJobPackageFactory;

class AccountJobPackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    
    protected $table = 'account_job_package';

    protected $fillable = [
        'job_package_id',
        'account_id',
        'amount',
    ];

    // Relationship
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function job_package()
    {
        return $this->belongsTo(JobPackage::class);
    }
    protected static function newFactory(): AccountJobPackageFactory
    {
        //return AccountJobPackageFactory::new();
    }
}