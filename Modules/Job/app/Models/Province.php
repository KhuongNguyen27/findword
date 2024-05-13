<?php

namespace Modules\Job\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Job\Database\factories\ProvinceFactory;

class Province extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'provinces';
    protected $fillable = [];
    const ALL_LOCATIONS = -1;
    public function job(){
        return $this->hasMany(Job::class);
    }

    protected static function newFactory(): ProvinceFactory
    {
        //return ProvinceFactory::new();
    }
}