<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends AdminModel
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug',
        'status',
        'description',
        'short_description',
        'metas',
        'image',
        'position',
        'user_id',
        'gallery',
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = str::slug($model->name); 
        });
    }
}
