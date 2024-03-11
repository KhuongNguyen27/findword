<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserStaff extends AdminModel
{
    use HasFactory, Notifiable;
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
}