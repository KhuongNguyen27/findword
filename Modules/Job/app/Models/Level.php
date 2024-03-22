<?php

namespace Modules\Job\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Job\Database\factories\LevelFactory;

class Level extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'levels';
    protected $fillable = [];
    
    public function job(){
        return $this->hasMany(Job::class,'degree_id','id');
    }
    protected static function newFactory(): LevelFactory
    {
        //return LevelFactory::new();
    }
}