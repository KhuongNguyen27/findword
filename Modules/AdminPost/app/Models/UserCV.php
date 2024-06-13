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
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    const DRAFT     = -1;
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
    public function getStatusFmAttribute(){
        switch ($this->status) {
            case self::DRAFT:
                return '<span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">'.__('sys.draf').'</span>';
                break;
            case self::ACTIVE:
                return '<span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">'.__('sys.active').'</span>';
                break;
            case self::INACTIVE:
                return '<span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">'.__('sys.inactive').'</span>';
                break;
        }
    }
    public function getCreatedAtFmAttribute(){
        return date('d-m-Y',strtotime($this->created_at));
    }
    public function getImageFmAttribute(){
        if( !$this->image ){
            return asset('admin-assets/images/default-image.png');
        }
        return asset($this->image);
    }
}
