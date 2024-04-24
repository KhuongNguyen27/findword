<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserStaff extends AdminModel
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'phone',
        'birthdate',
        'experience_years',
        'gender',
        'city',
        'address',
        'outstanding_achievements',
        'image',
    ];
    public $custom_fields = [
        'phone',
        'birthdate',
        'experience_years',
        'gender',
        'city',
        'address',
        'outstanding_achievements',
        'image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
