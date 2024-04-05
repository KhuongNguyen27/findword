<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Employee\app\Models\Job;

class JobPackage extends AdminModel
{
    use HasFactory;
    protected $table = 'job_packages';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status',
        'position',
        'price',
        'job_small_logo_border_color',
        'job_small_title_color',
        'job_small_box_border_color',
        'job_detail_header_bg',
        'job_detail_company_bg',
        'job_detail_company_bg',
    ];

    const VIP = 1;
    const GAP = 2;
    const UUTIEN = 3;
    const HOT = 4;
    const THUONG = 5;

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
    public function getImageFmAttribute()
    {
        if ( $this->image != null) {
            if( strpos($this->image,'http') !== false ){
                return $this->image;
            }
            return asset($this->image);
        }
        return null;
    }
}
