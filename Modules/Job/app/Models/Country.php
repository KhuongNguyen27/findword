<?php

namespace Modules\Job\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Job\app\Models\Job;

class Country extends Model
{
    use HasFactory;
    protected $table = "countries";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): CountryFactory
    {
        //return CountryFactory::new();
    }
    public function job(){
        return $this->hasMany(Job::class,'id','country_id');
    }
}
