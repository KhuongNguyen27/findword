<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobPackage;
use DateTime;

class Job extends AdminModel
{
    protected $table = "jobs";
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'description',
        'sort_description',
        'image',
        'gallery',
        'status',
        'position',
        'career_id',
        'formwork_id',
        'deadline',
        'experience',
        'wage_id',
        'gender',
        'work_address',
        'rank_id',
        'requirements',
        'jobpackage_id',
        'start_day',
        'end_day',
        'price',
        'start_hour',
        'end_hour'
    ];
    public function getImage()
    {
        if ($this->image != null) {
            return "/website-assets/images/".$this->image;
        }
        return "/website-assets/images/favicon.png";
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function job_package()
    {
        return $this->belongsTo(JobPackage::class,'jobpackage_id','id');
    }
    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_job','job_id','career_id');
    }
    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
    public function wage()
    {
        return $this->belongsTo(Wage::class, 'wage_id');
    }
    public function formWork()
    {
        return $this->belongsTo(FormWork::class, 'formwork_id');
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
    public function userEmployee()
    {
        return $this->belongsTo(UserEmployee::class, 'user_id', 'user_id');
    }
    function getTimeCreateAttribute(){
        return $this->created_at->diffForHumans();
    }
    // Custom methods
    public static function handleSearch($request,$query){
        if($request->jobpackage_id){
            $query->where('jobpackage_id',$request->jobpackage_id);
        }
        return $query;
    }

    const ACTIVE = 1;
    const UNACTIVE = 0;

    public function getJobforJobPackageAndTime () 
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobPackages = [
            JobPackage::VIP => 'job_vip',
            JobPackage::GAP => 'job_gap',
            JobPackage::UUTIEN => 'job_uu_tien',
            JobPackage::HOT => 'job_hot',
            JobPackage::THUONG => 'job_thuong'
        ];
        $jobs = [];

        foreach ($jobPackages as $jobPackage => $jobVariable) {
            $jobs[$jobVariable] = $this->where('status', $this::ACTIVE)
                ->where('jobpackage_id', $jobPackage)
                ->where('start_hour', '<=', $currentHour)
                ->where('end_hour', '>=', $currentHour)
                ->limit(12)
                ->get();
            }
        return $jobs;
    }

    public function getJobVn () {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobPackages = [
            JobPackage::VIP => 'job_vip',
            JobPackage::GAP => 'job_gap',
            JobPackage::UUTIEN => 'job_uu_tien',
            JobPackage::HOT => 'job_hot',
            JobPackage::THUONG => 'job_thuong'
        ];
        $jobs = [];
    
        foreach ($jobPackages as $jobPackage => $jobVariable) {
            $query = $this->where('status', $this::ACTIVE)
                ->where('jobpackage_id', $jobPackage)
                ->where('start_hour', '<=', $currentHour)
                ->where('end_hour', '>=', $currentHour)
                ->where('country', 'VN');
    
            $provinceId = request()->input('province_id');
            if ($provinceId != '') {
                $query->where('province_id', $provinceId);
            }
    
            $rankId = request()->input('rank_id');
            if ($rankId != '') {
                $query->where('rank_id', $rankId);
            }
    
            $wageId = request()->input('wage_id');
            if ($wageId != '') {
                $query->where('wage_id', $wageId);
            }
    
            $careerId = request()->input('career_id');
            if ($careerId != '') {
                $query->where('career_id', $careerId);
            }
    
            $jobs[$jobVariable] = $query->get();
        }
    
        return $jobs;
    }

    public function getJobVnHot () {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobs = [];
        $jobs['job_vip'] = [];
        $jobs['job_gap'] = [];
        $jobs['job_uu_tien'] = [];
        $jobs['job_thuong'] = [];
        $query = $this->where('status', $this::ACTIVE)
            ->where('jobpackage_id', JobPackage::HOT)
            ->where('start_hour', '<=', $currentHour)
            ->where('end_hour', '>=', $currentHour)
            ->where('country', 'VN');
        $provinceId = request()->input('province_id');
        if ($provinceId != '') {
            $query->where('province_id', $provinceId);
        }

        $rankId = request()->input('rank_id');
        if ($rankId != '') {
            $query->where('rank_id', $rankId);
        }

        $wageId = request()->input('wage_id');
        if ($wageId != '') {
            $query->where('wage_id', $wageId);
        }

        $careerId = request()->input('career_id');
        if ($careerId != '') {
            $query->where('career_id', $careerId);
        }

        $jobs['job_hot'] = $query->get();

        return $jobs;
    }

    public function getJobVnUrgent () {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobs = [];
        $jobs['job_vip'] = [];
        $jobs['job_hot'] = [];
        $jobs['job_uu_tien'] = [];
        $jobs['job_thuong'] = [];
        $query = $this->where('status', $this::ACTIVE)
            ->where('jobpackage_id', JobPackage::GAP)
            ->where('start_hour', '<=', $currentHour)
            ->where('end_hour', '>=', $currentHour)
            ->where('country', 'VN');
        $provinceId = request()->input('province_id');
        if ($provinceId != '') {
            $query->where('province_id', $provinceId);
        }

        $rankId = request()->input('rank_id');
        if ($rankId != '') {
            $query->where('rank_id', $rankId);
        }

        $wageId = request()->input('wage_id');
        if ($wageId != '') {
            $query->where('wage_id', $wageId);
        }

        $careerId = request()->input('career_id');
        if ($careerId != '') {
            $query->where('career_id', $careerId);
        }
        $jobs['job_gap']= $query->get();
        return $jobs;
    }

    public function getJobVnToday() {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $currentDay = $currentTime->format('Y-m-d'); // Lấy ngày hiện tại (không bao gồm giờ và phút)
    
        $jobPackages = [
            JobPackage::VIP => 'job_vip',
            JobPackage::GAP => 'job_gap',
            JobPackage::UUTIEN => 'job_uu_tien',
            JobPackage::HOT => 'job_hot',
            JobPackage::THUONG => 'job_thuong'
        ];
        $jobs = [];
    
        foreach ($jobPackages as $jobPackage => $jobVariable) {
            $query = $this->where('status', $this::ACTIVE)
                ->where('jobpackage_id', $jobPackage)
                ->where('start_hour', '<=', $currentHour)
                ->where('end_hour', '>=', $currentHour)
                ->whereDate('created_at', $currentDay) // Lọc theo ngày hiện tại
                ->where('country', 'VN');
            $provinceId = request()->input('province_id');
            if ($provinceId != '') {
                $query->where('province_id', $provinceId);
            }
    
            $rankId = request()->input('rank_id');
            if ($rankId != '') {
                $query->where('rank_id', $rankId);
            }
    
            $wageId = request()->input('wage_id');
            if ($wageId != '') {
                $query->where('wage_id', $wageId);
            }
    
            $careerId = request()->input('career_id');
            if ($careerId != '') {
                $query->where('career_id', $careerId);
            }
    
            $jobs[$jobVariable] = $query->get();
        }
        return $jobs;
    }

    // query nước ngoai

    public function getJobNn () {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobPackages = [
            JobPackage::VIP => 'job_vip',
            JobPackage::GAP => 'job_gap',
            JobPackage::UUTIEN => 'job_uu_tien',
            JobPackage::HOT => 'job_hot',
            JobPackage::THUONG => 'job_thuong'
        ];
        $jobs = [];

        foreach ($jobPackages as $jobPackage => $jobVariable) {
            $query = $this->where('status', $this::ACTIVE)
                ->where('jobpackage_id', $jobPackage)
                ->where('start_hour', '<=', $currentHour)
                ->where('end_hour', '>=', $currentHour)
                ->where('country', 'NN');
            $rankId = request()->input('rank_id');
            if ($rankId != '') {
                $query->where('rank_id', $rankId);
            }
    
            $wageId = request()->input('wage_id');
            if ($wageId != '') {
                $query->where('wage_id', $wageId);
            }
    
            $careerId = request()->input('career_id');
            if ($careerId != '') {
                $query->where('career_id', $careerId);
            }
    
            $jobs[$jobVariable] = $query->get();
        }
        return $jobs;
    }

    public function getJobNnHot () {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobs = [];
        $jobs['job_vip'] = [];
        $jobs['job_gap'] = [];
        $jobs['job_uu_tien'] = [];
        $jobs['job_thuong'] = [];
        $query = $this->where('status', $this::ACTIVE)
            ->where('jobpackage_id', JobPackage::HOT)
            ->where('start_hour', '<=', $currentHour)
            ->where('end_hour', '>=', $currentHour)
            ->where('country', 'NN');
        $rankId = request()->input('rank_id');
        if ($rankId != '') {
            $query->where('rank_id', $rankId);
        }

        $wageId = request()->input('wage_id');
        if ($wageId != '') {
            $query->where('wage_id', $wageId);
        }

        $careerId = request()->input('career_id');
        if ($careerId != '') {
            $query->where('career_id', $careerId);
        }

        $jobs['job_hot'] = $query->get();

        return $jobs;
    }

    public function getJobNnUrgent () {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $jobs = [];
        $jobs['job_vip'] = [];
        $jobs['job_hot'] = [];
        $jobs['job_uu_tien'] = [];
        $jobs['job_thuong'] = [];
        $query = $this->where('status', $this::ACTIVE)
            ->where('jobpackage_id', JobPackage::GAP)
            ->where('start_hour', '<=', $currentHour)
            ->where('end_hour', '>=', $currentHour)
            ->where('country', 'NN');
        $rankId = request()->input('rank_id');
        if ($rankId != '') {
            $query->where('rank_id', $rankId);
        }

        $wageId = request()->input('wage_id');
        if ($wageId != '') {
            $query->where('wage_id', $wageId);
        }

        $careerId = request()->input('career_id');
        if ($careerId != '') {
            $query->where('career_id', $careerId);
        }
        $jobs['job_gap']= $query->get();

        return $jobs;
    }

    public function getJobNnToday() {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $currentTime = new DateTime();
        $currentHour = intval($currentTime->format('H'));
        $currentDay = $currentTime->format('Y-m-d'); // Lấy ngày hiện tại (không bao gồm giờ và phút)
    
        $jobPackages = [
            JobPackage::VIP => 'job_vip',
            JobPackage::GAP => 'job_gap',
            JobPackage::UUTIEN => 'job_uu_tien',
            JobPackage::HOT => 'job_hot',
            JobPackage::THUONG => 'job_thuong'
        ];
        $jobs = [];
    
        foreach ($jobPackages as $jobPackage => $jobVariable) {
            $query = $this->where('status', $this::ACTIVE)
                ->where('jobpackage_id', $jobPackage)
                ->where('start_hour', '<=', $currentHour)
                ->where('end_hour', '>=', $currentHour)
                ->whereDate('created_at', $currentDay) // Lọc theo ngày hiện tại
                ->where('country', 'NN');
            $rankId = request()->input('rank_id');
            if ($rankId != '') {
                $query->where('rank_id', $rankId);
            }
    
            $wageId = request()->input('wage_id');
            if ($wageId != '') {
                $query->where('wage_id', $wageId);
            }
    
            $careerId = request()->input('career_id');
            if ($careerId != '') {
                $query->where('career_id', $careerId);
            }
    
            $jobs[$jobVariable] = $query->get();
        }
        
        return $jobs;
    }

}