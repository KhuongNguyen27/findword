<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Employee\app\Models\Job;

class Career extends AdminModel
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status',
        'position'
    ];
    
    
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    const DRAFT     = -1;

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
    public function getImageFmAttribute()
    {
        if ( $this->image != null) {
            if( strpos($this->image,'http') !== false ){
                return $this->image;
            }
            return asset('storage/images/'.$this->image);
        }
        return "/website-assets/images/favicon.png";
    }

    public function job()
    {
        return $this->belongsToMany(Job::class, 'carrer_job', 'carrer_id', 'job_id');
    }
}
