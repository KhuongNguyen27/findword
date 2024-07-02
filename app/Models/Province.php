<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gso_id'
    ];
    public function countries()
    {
        return $this->belongsToMany(Job::class, 'job_province', 'province_id', 'job_id');   
    }
}