<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Country;
use App\Models\Job;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Province;
use App\Models\UserEmployee;
use App\Models\User;
use App\Models\JobPackage;
use App\Models\Level;
use App\Models\FormWork;
use App\Models\JobJobTag;
use App\Models\JobTag;
use Carbon\Carbon;
use App\Models\Banner;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Str;
class JobController extends Controller
{
    // Trong nước
    public function vnjobs(Request $request, $job_type = ''){
        // dd(123);
        $sidebarBanners = Banner::where('group_banner', 'Sidebar Banner')->orderBy('position')->get();
        $degrees = Level::where('status',Level::ACTIVE)->orderBy('position')->get();
        $formworks = FormWork::where('status',FormWork::ACTIVE)->orderBy('position')->get();
        $job_categories = Career::where('status', 1)->orderBy('position')->get()->chunk(9);
        $careers = Career::where('status', 1)->orderBy('position')->get();
        $wages = Wage::where('status', 1)->orderBy('position')->get();
        $countries = Country::get();
        $newWages = [];
        foreach($wages as $wage){
            $newWages[$wage->salaryMin. '-'. $wage->salaryMax] = $wage->name;
        }

        $ranks = Rank::where('status', 1)->orderBy('position')->get();
        $job_packages = JobPackage::whereIn('slug', ['tin-gap', 'tin-hot'])->get();
        $model = new Job;
        
        $normal_provinces = Province::whereNotIn('id',[1,50,32])->orderBy('name')->get();
        $provinces = Province::whereIn('id',[1,50,32])->orderByRaw("FIELD(id,1,50,32)")->get()->merge($normal_provinces);

        // Việc làm mới nhất trong nước
        // $imageUserEmployyee = UserEmployee::class;
        $query = Job::select('jobs.*')->where('jobs.status',1);
        $query->rightJoin('job_province', 'jobs.id', '=', 'job_province.job_id');
        $query->whereNotNull('job_province.province_id');
        // $query->where('country', 'VN');
        // dd($request->name);
        if($request->name){
            $query->where('jobs.name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->jobpackage_id) {
            $query->whereHas('job_package', function ($query) use ($request) {
                $query->where('jobpackage_id', $request->jobpackage_id);
            });
        }
        
        if( $request->career_id ){
            $query->whereHas('careers', function ($query) use($request) {
                $query->where('career_id', $request->career_id);
            });
        }
        if( $request->wage_id ){
            $wage_id = $request->wage_id;//'10-15'
            $wage = explode('-', $wage_id);
            if($wage[0] == 0){
                $query->where('salaryMin','<=', $wage[1]);
            }
            elseif($wage[1] == 0){
                $query->where('salaryMin','>=', $wage[0]);
            }
            else{
                $query->whereBetween('salaryMin',[ $wage[0], $wage[1] ]);
            }
        }
     
        if( $request->rank_id ){
            $query->where('rank_id', $request->rank_id);
        }
        if( $request->degree_id ){
            $query->where('degree_id', $request->degree_id);
        }
        if( $request->formwork_id ){
            $query->where('formwork_id', $request->formwork_id);
        }
        
        // if( $request->province_id ){
        //     if( $request->province_id == 'quoc_te' ){
        //         return redirect()->route('jobs.nnjobs',$request->all());
        //     }
        //     $query->where('province_id', $request->province_id);
        // }
        if ($request->province_id) {
            $province_id = $request->province_id;
			if ($province_id === "quoc_te") {
                return redirect()->route('jobs.nnjobs',$request->all());
			}else{
				$query->where('job_province.province_id',intval($province_id));
			}
		}
        $query->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
        $query->leftJoin("auto_post_job_packages", function (JoinClause $join) use( $job_type) {
            $join->on('auto_post_job_packages.job_package_id', '=', 'job_packages.id')
                ->where('auto_post_job_packages.area', '=', $job_type);
        });
        switch ($job_type) {
            case 'hap-dan':
                $title = 'Việc làm trong nước hấp dẫn';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Hot.VIP -> Gấp.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->where(function ($q) {
                    $q->where('jobs.salaryMax', '>=', 8000000)
                      ->orWhere('jobs.salaryMax', '');
                })
                ->where(function ($q) {
                    $q->where('job_packages.slug', "tin-gap-vip")
                      ->orWhere('job_packages.slug', "tin-hot-vip")
                      ->orWhere('job_packages.slug', "tin-vip");
                });
                
                $query->orderByRaw("CASE
                    WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                    WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                    WHEN job_packages.slug = 'tin-vip' THEN 3
                    WHEN job_packages.slug = 'tin-gap' THEN 4
                    WHEN job_packages.slug = 'tin-hot' THEN 5
                    WHEN job_packages.slug = 'tin-thuong' THEN 6
                    WHEN auto_post_job_packages.area is not null THEN 7
                    WHEN jobs.top_position is not null THEN jobs.top_position
					ELSE 8
                END")
                ->orderBy('jobs.id', 'desc');
                
                break;
            case 'moi-nhat':
                // dd(123);
                $title = 'Việc làm trong nước mới nhất';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
                        ELSE 8
                    END")                
                    ->orderBy('jobs.id', 'desc');
                    
                break;

            case 'tat-ca':
                $title = 'Việc làm trong nước';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
                        ELSE 8
                    END");
                break;
            case 'hot':
                // Việc làm Hot nhất	Toàn bộ các tin đăng	
                //Hot.VIP -> Hot -> Gấp.VIP -> VIP -> Gấp -> Tin thường
                        $query->where(function ($q) {
                            $q->where('job_packages.slug', "tin-gap-vip")
                            ->orWhere('job_packages.slug', "tin-hot-vip")
                            ->orWhere('job_packages.slug', "tin-hot");
                        })->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot' THEN 2
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 3
                        WHEN job_packages.slug = 'tin-vip' THEN 4
                        WHEN job_packages.slug = 'tin-gap' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END");
                $title = 'Việc làm trong nước hot nhất';
                break;
            case 'today':
                //Các tin đăng trong vòng 48h tính từ lúc user access của phiên đó	
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $startDate = Carbon::now()->subHours(72);
                $endDate = Carbon::now();
                // $query->whereBetween('jobs.created_at', [$startDate, $endDate]);
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                ->orderBy('jobs.created_at', 'desc');
                $title = 'Việc làm trong nước hôm nay';
                break;
            case 'urgent':
                $query->where('job_packages.slug', "like", "%tin-gap-vip%")
                ->orWhere('job_packages.slug', "like", "%tin-gap%")
                
                // Tuyển gấp	Toàn bộ các tin đăng	
                // Gấp.VIP -> Gấp -> Hop.VIP -> VIP -> Hot -> Tin thường
                // $query->where('jobpackage_id',JobPackage::GAP);
                ->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-gap' THEN 2
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 3
                        WHEN job_packages.slug = 'tin-vip' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                ->orderBy('jobs.created_at', 'desc');
                $title = 'Việc làm trong nước tuyển gấp';
                break;
            default:
                $title = 'Việc làm trong nước hôm nay';
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                ->orderBy('jobs.created_at', 'desc');
                $query->groupBy('jobs.id','jobs.user_id','job_province.job_id', 'auto_post_job_packages.area', 'job_packages.slug','jobs.top_position');
                $jobs = $query->limit(20)->get()->chunk(12);
                break;
        } 

        $sort = $request->sort;
        switch ($sort) {
            case 'salary-desc':
                $query->orderBy('wage_id','DESC');
                break;
            case 'date-desc':
                $query->orderBy('jobs.created_at','DESC');
                break;
            case 'date-asc':
                $query->orderBy('jobs.created_at','ASC');
                break;
            default:
                break;
        }

        $view_path = 'website.jobs.index';
        if($job_type){
            $view_path = 'website.jobs.sub-index';
            $query->groupBy('jobs.id','jobs.user_id','job_province.job_id', 'auto_post_job_packages.area', 'job_packages.slug','jobs.top_position');
            $jobs = $query->paginate(25);
        }

       // Việc làm hấp dẫn trong nước
       $hot_jobs = Job::select('jobs.*')
       ->where('jobs.status', 1)
       ->rightJoin('job_province', 'jobs.id', '=', 'job_province.job_id')
       ->whereNotNull('job_province.province_id')
       ->where(function ($query) {
           $query->where('jobs.salaryMax', '>=', 8000000)
               ->orWhere('jobs.salaryMax', '');
       })
       ->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
       ->where(function ($query) {
           $query->where('job_packages.slug', 'tin-gap-vip')
               ->orWhere('job_packages.slug', 'tin-hot-vip')
               ->orWhere('job_packages.slug', 'tin-vip');
       })
       // Thêm điều kiện sắp xếp
       ->orderByRaw("CASE
               WHEN job_packages.slug = 'tin-hot-vip' THEN 1
               WHEN job_packages.slug = 'tin-gap-vip' THEN 2
               WHEN job_packages.slug = 'tin-vip' THEN 3
               WHEN job_packages.slug = 'tin-gap' THEN 4
               WHEN job_packages.slug = 'tin-hot' THEN 5
               WHEN job_packages.slug = 'tin-thuong' THEN 6
               WHEN jobs.top_position IS NOT NULL THEN jobs.top_position
               ELSE 8
               END");
              
                    
        
      
        
        
        // $hot_jobs->where('jobs.country','VN');
        // if($request->province_id){
        //     $hot_jobs->where('province_id', $request->province_id);
        // }
        if ($request->province_id) {
			$province_id = $request->province_id;
			if ($province_id === "quoc_te") {
                return redirect()->route('jobs.nnjobs',$request->all());
			}else{
				$hot_jobs->where('job_province.province_id',intval($province_id));
			}
		}
        if($request->name){
            $hot_jobs->where('jobs.name', 'LIKE', '%'.$request->name.'%');
        }
        if( $request->rank_id ){
            $hot_jobs->where('rank_id', $request->rank_id);
        }
        if( $request->degree_id ){
            $hot_jobs->where('degree_id', $request->degree_id);
        }
        if( $request->formwork_id ){
            $hot_jobs->where('formwork_id', $request->formwork_id);
        }
        if( $request->wage_id ){
            
            switch ($request->wage_id) {
                case 'duoi_10tr':
                        $hot_jobs->where('salaryMax','<=', 10000000);
                    break;
                case '10-15':
                    $hot_jobs->whereBetween('salaryMax',[10000000,15000000]);
                    break;
                case '15-20':
                    $hot_jobs->whereBetween('salaryMax',[15000000,20000000]);
                    break;
                case '20-25':
                    $hot_jobs->whereBetween('salaryMax',[20000000,25000000]);

                    break;
                case '25-30':
                    $hot_jobs->whereBetween('salaryMax',[25000000,30000000]);
                    break;
                case '30-50':
                    $hot_jobs->whereBetween('salaryMax',[30000000,50000000,]);
                    break;
                case 'tren_50':
                    $hot_jobs->where('salaryMax','>=',[50000000,]);
                    break;
                case 'thoa_thuan':
                default:
                    $salaryMax = 0;
                    break;
            }
        }
        $hot_jobs->orderBy('jobs.id','DESC')->limit(20);
        $hot_jobs->groupBy('jobs.id','jobs.user_id','job_province.job_id');
        $hot_jobs= $hot_jobs->get()->chunk(10);

        $job_job_tags = count($jobs) ? JobJobTag::whereIn('job_id',$jobs->pluck('id')->toArray())->pluck('id')->toArray() : null;
        $job_tags = $job_job_tags ? JobTag::whereIn('id',$job_job_tags)->get() : [];
        $employees = UserEmployee::get();
        $top_employees = UserEmployee::orderBy('position')->limit(8)->get();

        $currentRoute = route::current()->getName();
        // dd($currentRoute);
        $params = [
            'route' => $currentRoute,
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'hot_jobs' => $hot_jobs,
            'wages' => $newWages,
            'provinces' => $provinces,
            'employees' => $employees,
            'top_employees' => $top_employees,
            'title' => $title,
            'degrees' => $degrees,
            'formworks' => $formworks,
            'job_type' => $job_type,
            'job_tags' => $job_tags,
            'job_packages'=> $job_packages,
            'countries'=>$countries,
            'special_employee_jobs'=>$this->_special_employee_jobs(),
            'sidebarBanners' => $sidebarBanners,

        ];
        return view($view_path,$params);
    }
    // Ngoài nước
    public function nnjobs (Request $request, $job_type = ''){
        $model = new Job;
        $careers = Career::where('status', 1)->get();
        $wages = [
            'duoi_10tr'=> 'Dưới 10 triệu',
            '10-15'=>'10 - 15 triệu',
            '15-20'=>'15 - 20 triệu',
            '20-25'=>'20 - 25 triệu',
            '25-30'=>'25 - 30 triệu',
            '30-50'=>'30 - 50 triệu',
            'tren_50'=>'Trên 50 triệu',
            'thoa_thuan'=>'Thỏa thuận'
        ];
        $sidebarBanners = Banner::where('group_banner', 'Sidebar Banner')->orderBy('position')->get();
        $ranks = Rank::where('status', 1)->orderBy('position')->get();
        $degrees = Level::where('status',Level::ACTIVE)->orderBy('position')->get();
        $formworks = FormWork::where('status',FormWork::ACTIVE)->orderBy('position')->get();
        $job_packages = JobPackage::whereIn('slug',['tin-gap','tin-hot'])->get();
        $provinces = Province::all();
        $countries = Country::all();
        // Việc làm mới nhất ngoài nước
        $query = Job::select('jobs.*')->where('jobs.status',1);
        // $query->where('country','!=', 'VN');
        $query->rightJoin('job_province', 'jobs.id', '=', 'job_province.job_id');
        $query->whereNull('job_province.province_id');  
        if( $request->career_id ){
            $query->whereHas('careers', function ($query) use($request) {
                $query->where('career_id', $request->career_id);
            });
        }
        if ($request->jobpackage_id) {
            $query->whereHas('job_package', function ($query) use ($request) {
                $query->where('jobpackage_id', $request->jobpackage_id);
            });
        }
        if($request->name){
            $query->where('jobs.name','LIKE','%' . $request->name. '%');
        }
        if( $request->wage_id ){
            
            switch ($request->wage_id) {
                case 'duoi_10tr':
                        $query->where('salaryMax','<=', 10000000);
                    break;
                case '10-15':
                    $query->whereBetween('salaryMax',[10000000,15000000]);
                    break;
                case '15-20':
                    $query->whereBetween('salaryMax',[15000000,20000000]);
                    break;
                case '20-25':
                    $query->whereBetween('salaryMax',[20000000,25000000]);

                    break;
                case '25-30':
                    $query->whereBetween('salaryMax',[25000000,30000000]);
                    break;
                case '30-50':
                    $query->whereBetween('salaryMax',[30000000,50000000,]);
                    break;
                case 'tren_50':
                    $query->where('salaryMax','>=',[50000000,]);
                    break;
                case 'thoa_thuan':
                default:
                    $salaryMax = 0;
                    break;
            }
        }
        if( $request->rank_id ){
            $query->where('rank_id', $request->rank_id);
        }
        // if( $request->province_id ){
        //     $query->where('province_id', $request->province_id);
        // }
        if ($request->province_id) {
			$province_id = $request->province_id;
			if ($province_id !== "quoc_te") {
				$query->where('job_province.country_id',intval($province_id));
			}
		}
        
        if( $request->degree_id ){
            $query->where('degree_id', $request->degree_id);
        }
        if( $request->formwork_id ){
            $query->where('formwork_id', $request->formwork_id);
        }
        $query->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
        $query->leftJoin("auto_post_job_packages", function (JoinClause $join) use( $job_type) {
            $join->on('auto_post_job_packages.job_package_id', '=', 'job_packages.id')
                ->where('auto_post_job_packages.area', '=', $job_type);
        });
        switch ($job_type) {
            case 'moi-nhat':
                $title = 'Việc làm ngoài nước mới nhất';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                break;   
            case 'tat-ca':
                $title = 'Việc làm ngoài nước';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
                        ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                break;   
            case 'hap-dan':
                $title = 'Việc làm ngoài nước hấp dẫn';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Hot.VIP -> Gấp.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->where(function ($q) {
                    $q->where('jobs.salaryMax', '>=', 8000000)
                      ->orWhere('jobs.salaryMax', '');
                })
                ->where('jobs.country', 'NN')
                ->where(function ($q) {
                    $q->where('job_packages.slug', 'tin-gap-vip')
                      ->orWhere('job_packages.slug', 'tin-hot-vip')
                      ->orWhere('job_packages.slug', 'tin-vip');
                })
                
                ->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
                        ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                break;
            case 'hot':
                $query->where(function ($q) {
                    $q->where('job_packages.slug', 'tin-hot-vip')
                      ->orWhere('job_packages.slug', 'tin-gap-vip')
                      ->orWhere('job_packages.slug', 'tin-vip');
                })
                // Việc làm Hot nhất	Toàn bộ các tin đăng	
                //Hot.VIP -> Hot -> Gấp.VIP -> VIP -> Gấp -> Tin thường
                ->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot' THEN 2
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 3
                        WHEN job_packages.slug = 'tin-vip' THEN 4
                        WHEN job_packages.slug = 'tin-gap' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                $title = 'Việc làm ngoài nước hot nhất';
                break;
            case 'today':
                //Các tin đăng trong vòng 48h tính từ lúc user access của phiên đó	
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $startDate = Carbon::now()->subHours(72);
                $endDate = Carbon::now();
                // $query->whereBetween('jobs.created_at', [$startDate, $endDate]);
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                $query->groupBy('jobs.id','jobs.user_id','job_province.job_id', 'auto_post_job_packages.area', 'job_packages.slug','jobs.top_position');
                $title = 'Việc làm ngoài nước hôm nay';
                break;
            case 'urgent':
                // Tuyển gấp	Toàn bộ các tin đăng	
                // Gấp.VIP -> Gấp -> Hop.VIP -> VIP -> Hot -> Tin thường
                // $query->where('jobpackage_id',JobPackage::GAP);
                $query->where(function ($q) {
                    $q->where('job_packages.slug', 'tin-gap-vip')
                      ->orWhere('job_packages.slug', 'tin-gap');
                })
                ->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-gap' THEN 2
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 3
                        WHEN job_packages.slug = 'tin-vip' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                $title = 'Việc làm ngoài nước tuyển gấp';
                break;
            default:
                $title = 'Việc làm ngoài nước hôm nay';
                $query->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                        WHEN job_packages.slug = 'tin-vip' THEN 3
                        WHEN job_packages.slug = 'tin-gap' THEN 4
                        WHEN job_packages.slug = 'tin-hot' THEN 5
                        WHEN job_packages.slug = 'tin-thuong' THEN 6
                        WHEN auto_post_job_packages.area is not null THEN 7
                        WHEN jobs.top_position is not null THEN jobs.top_position
					    ELSE 8
                    END")
                    ->orderBy('jobs.created_at', 'desc');
                $query->groupBy('jobs.id','jobs.user_id','job_province.job_id', 'auto_post_job_packages.area', 'job_packages.slug','jobs.top_position');
                $jobs = $query->limit(20)->get()->chunk(12);
                break;
        }
                $sort = $request->sort;
        switch ($sort) {
            case 'salary-desc':
                $query->orderBy('wage_id','DESC');
                break;
            case 'date-desc':
                $query->orderBy('jobs.created_at','DESC');
                break;
            case 'date-asc':
                $query->orderBy('jobs.created_at','ASC');
                break;
            default:
                $query->orderBy('jobs.created_at','DESC');
                break;
        }
        $view_path = 'website.jobs.index';
        if($job_type){
            $view_path = 'website.jobs.sub-index';
            $jobs = $query->paginate(10);
        }

        $job_job_tags = count($jobs) ? JobJobTag::whereIn('job_id',$jobs->pluck('id')->toArray())->pluck('id')->toArray() : null;
        $job_tags = $job_job_tags ? JobTag::whereIn('id',$job_job_tags)->get() : [];

        // Việc làm ngoài nước hấp dẫn home
        $hot_jobs = Job::select('jobs.*')
        ->where('jobs.status', 1)
        ->rightJoin('job_province', 'jobs.id', '=', 'job_province.job_id')
        ->whereNull('job_province.province_id')
        ->where(function ($query) {
            $query->where('jobs.salaryMax', '>=', 1)
                ->orWhere('jobs.salaryMax', '');
        })
        ->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
        ->leftJoin('auto_post_job_packages', function (JoinClause $join) use ($job_type) {
            $join->on('auto_post_job_packages.job_package_id', '=', 'job_packages.id')
                ->where('auto_post_job_packages.area', '=', $job_type);
        })
        ->where(function ($query) {
            $query->where('job_packages.slug', 'tin-gap-vip')
                ->orWhere('job_packages.slug', 'tin-hot-vip')
                ->orWhere('job_packages.slug', 'tin-vip');
        })->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
                WHEN auto_post_job_packages.area IS NOT NULL THEN 7
                ELSE 8
             END");
        // if($request->province_id){
        //     $hot_jobs->where('province_id', $request->province_id);
        // }
        if ($request->province_id) {
			$province_id = $request->province_id;
			if ($province_id !== "quoc_te") {
				$hot_jobs->where('job_province.country_id',intval($province_id));
			}
		}
        if($request->name){
            $hot_jobs->where('jobs.name', 'LIKE', '%'.$request->name.'%');
        }
        if( $request->rank_id ){
            $hot_jobs->where('rank_id', $request->rank_id);
        }
        if( $request->degree_id ){
            $hot_jobs->where('degree_id', $request->degree_id);
        }
        if( $request->formwork_id ){
            $hot_jobs->where('formwork_id', $request->formwork_id);
        }
        if( $request->wage_id ){
            switch ($request->wage_id) {
                case 'duoi_10tr':
                    $hot_jobs->where('salaryMax','<=', 10000000);
                    break;
                case '10-15':
                    $hot_jobs->whereBetween('salaryMax',[10000000,15000000]);
                    break;
                case '15-20':
                    $hot_jobs->whereBetween('salaryMax',[15000000,20000000]);
                    break;
                case '20-25':
                    $hot_jobs->whereBetween('salaryMax',[20000000,25000000]);

                    break;
                case '25-30':
                    $hot_jobs->whereBetween('salaryMax',[25000000,30000000]);
                    break;
                case '30-50':
                    $hot_jobs->whereBetween('salaryMax',[30000000,50000000,]);
                    break;
                case 'tren_50':
                    $hot_jobs->where('salaryMax','>=',[50000000,]);
                    break;
                case 'thoa_thuan':
                default:
                    $salaryMax = 0;
                    break;
            }
        }
        
        $hot_jobs->orderBy('jobs.id','DESC')->limit(20);
        $hot_jobs = $hot_jobs->get()->chunk(10);
        $employees = UserEmployee::get();
        $top_employees = UserEmployee::orderBy('position')->limit(8)->get();

        $params = [
            'careers' => $careers,
            'route' => 'jobs.nnjobs',
            'ranks' => $ranks,
            'jobs' => $jobs,
            'hot_jobs' => $hot_jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'top_employees' => $top_employees,
            'title' => $title,
            'degrees' => $degrees,
            'formworks' => $formworks,
            'job_type' => $job_type,
            'job_tags' => $job_tags,
            'job_packages' => $job_packages,
            'countries'=>$countries,
            'special_employee_jobs'=>$this->_special_employee_jobs(),
            'sidebarBanners' => $sidebarBanners,

        ];

        return view($view_path,$params);
    }

    private function _special_employee_jobs(){
        $employee_id = 373180;
        $employee = UserEmployee::where('user_id',$employee_id)->first();
        $jobs = Job::where('user_id',$employee_id)
        ->where('status',1)
        ->limit(10)->get();
        return [
            'employee' => $employee,
            'jobs' => $jobs,
        ];
    }
   
}