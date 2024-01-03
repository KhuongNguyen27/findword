<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\UserEducationFactory;

class UserEducation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'user_educations';

    protected $fillable = [
        'numerical',
        'rank_id',
        'school_course',
        'graduation_date',
        'language',
        'major',
        'user_id',
        'cv_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userCv()
    {
        return $this->belongsTo(UserCv::class, 'cv_id');
    }
}
