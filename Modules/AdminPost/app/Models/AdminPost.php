<?php

namespace Modules\AdminPost\app\Models;

use App\Models\AdminModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPost extends Model
{
    use HasFactory;

    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_description',
        'image',
        'gallery',
        'status',
        'position',
        'user_id',
        
    ];
    // Relationships
   
}