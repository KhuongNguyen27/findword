<?php

namespace Modules\Staff\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Staff\Database\factories\UserJobFavoriteFactory;

class UserJobFavorite extends Model
{
    use HasFactory;
    protected $table = 'user_job_favorites';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    function getImageFmAttribute(){
        return $this->userEmployee && $this->userEmployee->image != null ? $this->userEmployee->image :"/website-assets/images/favicon.png";
    }
}
