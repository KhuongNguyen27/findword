<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Employee\app\Models\Job;

class Wage extends AdminModel
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status',
        'position',
        'salaryMin',
        'salaryMax',
    ];

    public function job()
    {
        return $this->belongsToMany(Job::class);
    }
}
