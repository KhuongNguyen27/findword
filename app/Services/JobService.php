<?php

namespace App\Services;
use Nwidart\Modules\Commands\PublishCommand;


class JobService 
{
    public static function switchCase($query, $job_type)
    {

        switch ($job_type) {
            case 'viec-lam-hom-nay':
                $title = 'Việc làm hôm nay';

                $query->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
				WHEN jobs.top_position is not null THEN jobs.top_position
                ELSE 7 END")->orderBy('jobs.id', 'DESC');
                break;

            case 'tat-ca-viec-lam':
                $title = 'Tất cả việc làm';

                $query->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 2
                WHEN job_packages.slug = 'tin-gap-vip' THEN 1
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
                WHEN jobs.top_position is not null THEN jobs.top_position
                ELSE 7 END")->orderBy('jobs.id', 'DESC');
                break;

                case 'hot':
                    $title = 'Việc làm hot';
                    $query->where(function ($q) {
                        $q->where('job_packages.slug', "tin-gap-vip")
                          ->orWhere('job_packages.slug', "tin-hot-vip")
                          ->orWhere('job_packages.slug', "tin-hot");
                    })->orderByRaw("CASE
                        WHEN job_packages.slug = 'tin-gap-vip' THEN 3
                        WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                        WHEN job_packages.slug = 'tin-hot' THEN 2
                        ELSE 7 END
                    ")->orderBy('jobs.id', 'DESC');
                    break;
            case 'urgent':
                $title = 'Việc làm tuyển gấp';
                $query->where('job_packages.slug', "like", "%tin-gap-vip%")
                ->orWhere('job_packages.slug', "like", "%tin-gap%")
                ->orderByRaw("CASE
					WHEN job_packages.slug = 'tin-gap-vip' THEN 1
					WHEN job_packages.slug = 'tin-gap' THEN 2
                    ELSE 7 END
					")->orderBy('jobs.id', 'DESC');
                break;
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
            case 'hap-dan':
                $title = 'Việc làm ngoài nước hấp dẫn';
                //Việc làm Mới nhất	Toàn bộ các tin đăng	
                //Hot.VIP -> Gấp.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->where('jobs.salaryMax', '>=', 8000000)
                    ->orWhere('jobs.salaryMax', '')
                    ->where('jobs.country', 'NN')
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
                $query->groupBy('jobs.id', 'jobs.user_id', 'job_province.job_id', 'auto_post_job_packages.area', 'job_packages.slug', 'jobs.top_position');
                $jobs = $query->limit(20)->get()->chunk(12);
                break;
        }

        return [
            'query' => $query,
            'title' => $title,
        ];
    }

    public static function searchHome($query, $request){
        if ($request->name) {
			$query->where('jobs.name', 'LIKE', '%' . $request->name . '%');
		}
		if ($request->province_id) {
			$query->where('province_id', $request->province_id);
		}
		if ($request->rank_id) {
			$query->where('rank_id', $request->rank_id);
		}
		if ($request->degree_id) {
			$query->where('degree_id', $request->degree_id);
		}
		if ($request->formwork_id) {
			$query->where('formwork_id', $request->formwork_id);
		}
        if ($request->wage_id) {
			$wage_id = $request->wage_id;//'10-15'
			$wage = explode('-', $wage_id);
			if ($wage[0] == 0) {
				$query->where('salaryMin', '<=', $wage[1]);
			} elseif ($wage[1] == 0) {
				$query->where('salaryMin', '>=', $wage[0]);
			} else {
				$query->whereBetween('salaryMin', [$wage[0], $wage[1]]);
			}
		}
        return $query;
    }

    
}
