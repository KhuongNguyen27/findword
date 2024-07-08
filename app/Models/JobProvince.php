<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobProvince extends AdminModel
{
    protected $table = "job_province";
    use HasFactory;
    protected $fillable = [
        'job_id',
        'province_id',
        'country_id'
    ];
}