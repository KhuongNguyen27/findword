<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\FormWorkFactory;

class FormWork extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    public function jobs()
    {
        return $this->hasMany(Job::class, 'formwork_id');
    }
    public function userCvs()
    {
        return $this->hasMany(UserCv::class,'form_work_id');
    }
    public function cvsExamples()
    {
        return $this->hasMany(CvsExample::class,'form_work_id');
    }
}