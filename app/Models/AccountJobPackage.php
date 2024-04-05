<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountJobPackage extends Model
{
    use HasFactory;
    protected $table = 'account_job_package';
    protected $fillable = [
        'job_package_id',
        'account_id',
        'amount'
    ];
}
