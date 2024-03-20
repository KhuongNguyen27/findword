<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Employee\app\Models\Job;

class JobPackage extends AdminModel
{
    use HasFactory;
    protected $table = 'job_packages';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status',
        'position',
        'price'
    ];

    const VIP = 1;
    const GAP = 2;
    const UUTIEN = 3;
    const HOT = 4;
    const THUONG = 5;

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
