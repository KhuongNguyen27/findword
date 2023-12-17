<?php

namespace Modules\AdminTheme\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminTheme\Database\factories\ThemeFactory;

class Theme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): ThemeFactory
    {
        //return ThemeFactory::new();
    }
}
