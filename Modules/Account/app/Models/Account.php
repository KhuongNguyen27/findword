<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\AccountFactory;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    const NORMAL    = 1;
    const PREMIUM  = 2;
    const VIP  = 3;
    protected $table = "accounts"; 
    protected $fillable = [
        'name',
        'description',
        'price',
        'position'
    ];
    
    // Relationship
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class,'user_account');
    }
    public function job_packages()
    {
        return $this->belongsToMany(JobPackage::class,'account_job_package','account_id','job_package_id');
    }
    public function job_package()
    {
        return $this->hasMany(AccountJobPackage::class);
    }
    public function user()
    {
        return $this->hasMany(UserAccount::class);
    }
    protected static function newFactory(): AccountFactory
    {
        //return AccountFactory::new();
    }
}
