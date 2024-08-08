<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Employee\Database\factories\EmployeeCvFactory;
use Modules\Staff\app\Models\UserCv;

class EmployeeCv extends Model
{
    use HasFactory;
    const STATUS_HIRED = 0;
    const STATUS_REJECTED = 1;
    const STATUS_VIEWED = 2;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'employee_cv';

    protected $fillable = [
        'user_id',
        'cv_id',
        'is_read',
        'is_checked',
        'favorites',
        'status',
    ];    
    protected static function newFactory(): EmployeeCvFactory
    {
        //return EmployeeCvFactory::new();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cv()
    {
        return $this->belongsTo(UserCv::class);
    }
    public function getStatusTextAttribute()
    {
        $statuses = [
            self::STATUS_HIRED => 'Hired',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_VIEWED => 'Interview',
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
