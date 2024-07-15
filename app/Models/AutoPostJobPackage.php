<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoPostJobPackage extends Model
{
    use HasFactory;
    protected $table = 'auto_post_job_packages';
    protected $fillable = [
        'area',
        'daily',
        'auto_in_hour',
        'job_package_id',
        'hour'
    ];

}
