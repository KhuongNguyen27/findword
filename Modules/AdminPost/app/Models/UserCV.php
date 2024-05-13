<?php

namespace Modules\AdminPost\app\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\FormWork;
use App\Models\Career;
use App\Models\Rank;
use App\Models\Wage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminPost\Database\factories\UserCVFactory;

class UserCV extends Model
{
    use HasFactory;
    protected $table = 'user_cvs';
    protected $fillable = [
        'name',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formWork()
    {
        return $this->belongsTo(FormWork::class, 'form_work_id');
    }
    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }
    public function wage()
    {
        return $this->belongsTo(Wage::class, 'wage_id');
    }
    
}
