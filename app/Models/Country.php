<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $fillable = [
        'name',
        'country_code',
        'description',
        'continent'
    ];
    // public function job(){
    //     return $this->hasMany(Job::class);
    // }
    public function countries()
    {
        return $this->belongsToMany(Job::class, 'job_province', 'country_id', 'job_id');
    }
}