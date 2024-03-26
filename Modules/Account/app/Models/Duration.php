<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\DurationFactory;

class Duration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    protected $table = "durations";
    protected $fillable = [
        'name',
        'number_date',
    ];
    
    //Relationship
    public function user_account()
    {
        return $this->hasMany(UserAccount::class);
    }

    protected static function newFactory(): DurationFactory
    {
        //return DurationFactory::new();
    }
}