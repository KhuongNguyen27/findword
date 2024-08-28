<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\UserJobPackageFactory;

class UserJobPackage extends Model
{
    use HasFactory;
    protected $table = 'user_job_package';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'job_package_id',
        'amount',
    ];
}
