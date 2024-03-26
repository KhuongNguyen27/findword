<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public function userCvs()
    {
        return $this->hasMany(UserCv::class);
    }
    public function cvsExamples()
    {
        return $this->hasMany(CvsExample::class);
    }
}