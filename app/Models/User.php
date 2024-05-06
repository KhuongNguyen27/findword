<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Account\app\Models\Account;
use Modules\Account\app\Models\UserAccount;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions;
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    const DRAFT     = -1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birthdate',
        'verify',
        'status',
        'google_id',
        'facebook_id',
        'type',
        'points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    function getImageFmAttribute(){
        return $this->image?$this->image:"/website-assets/images/favicon.png";
    }

    public function group()
    {
        return $this->belongsTo(\Modules\Permission\app\Models\Group::class);
    }
    public function job()
    {
        return $this->hasMany(Job::class);
    }
    public function accounts()
    {
        return $this->belongsToMany(\Modules\Account\app\Models\Account::class,'user_account');
    }
    public function account()
    {
        return $this->hasMany(\Modules\Account\app\Models\UserAccount::class);
    }
	  public function userStaff()
      {
          return $this->hasOne(UserStaff::class);
      }
    public function getAccountName(){
        if ($this->account->where('is_current',1)->first()) {
            return $this->account->where('is_current',1)->first()->account->accountname;
        }
        return null;
    }
    public function getJobCan(){
        if ($this->account->where('is_current',1)->first()) {
            $account_packages = $this->account->where('is_current',1)->first()->account->job_package;
            $job_avaible = [];
            foreach ($account_packages as $account_package) {
                $job_avaible[] = [
                    $account_package->job_package_id => $this->checkJob($account_package->job_package_id)
                ];
            };
            return $job_avaible;
        }   
        return null;
    }
    public function checkJob($job_package = 1){
        $account_current = $this->account->where('is_current',1)->first();
        $currentDate = now(); // Lấy ngày hiện tại
        $nextMonth = $currentDate->addMonth(); // Thêm 1 tháng
        if ($account_current && $account_current->account_id == $this::ACTIVE) {
            $expirationDate = $account_current->expiration_date;
            $expirationDate = Carbon::parse($expirationDate);
            $currentDate = Carbon::now();
            $daysRemaining = $currentDate->diffInDays($expirationDate);
            if($daysRemaining<0){
                $account_current->expiration_date = $nextMonth->format('Y-m-d H:i:s');
            }
        }
        if($this->verify == $this::ACTIVE && empty($account_current)){
            $account_current = UserAccount::firstOrCreate(
                [
                    'user_id' => $this->id,
                    'account_id' => 1,
                    'duration_id' => 1,
                ],
                [
                    'register_date' => $currentDate->format('Y-m-d H:i:s'),
                    'expiration_date' => $nextMonth->format('Y-m-d H:i:s'),
                    'is_current' => 1,
                ]
            );
        }
        if ($account_current) {
            $firstDayOfMonth = Carbon::now()->startOfMonth();
            $lastDayOfMonth = Carbon::now()->endOfMonth();
            $user_package = $account_current->account->job_package;
            $count_job_avaible = $user_package->where('job_package_id',$job_package)->first() !== null ? $user_package->where('job_package_id',$job_package)->first()->amount : 0; 
            $count_job_current = $this->job->where('jobpackage_id',$job_package)->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->count();
            return $count_job_avaible-$count_job_current > 0 ? $count_job_avaible-$count_job_current : 0 ;
        }
        return null;
    }
    public function checkDuration(){
        if ($this->account->where('is_current',1)->first()) {
            $package = $this->account->where('is_current',1)->first();
            $register_date = $package->register_date;
            $current_date = date('d-m-Y');
            $number_date = $package->duration->number_date;
            $register_date_timestamp = strtotime($register_date);
            $current_date_timestamp = strtotime($current_date);
            $days_diff = ($current_date_timestamp - $register_date_timestamp) / (60 * 60 * 24);
            if ($days_diff > $number_date) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }
}