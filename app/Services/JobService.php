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

                $query->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                    ->orderBy('jobs.id', 'DESC');        // Sắp xếp theo ID nếu thời gian duyệt tin trống
                break;

            case 'tat-ca-viec-lam':
                $title = 'Tất cả việc làm';

                $query->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                    ->orderBy('jobs.id', 'DESC');        // Sắp xếp theo ID nếu thời gian duyệt tin trống
                break;

            case 'hot':
                $title = 'Việc làm Hot';
                $query->where(function ($q) {
                    $q->where('job_packages.slug', "tin-gap-vip")
                        ->orWhere('job_packages.slug', "tin-hot-vip")
                        ->orWhere('job_packages.slug', "tin-hot");
                })->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                    ->orderBy('jobs.id', 'DESC');        // Sắp xếp theo ID nếu thời gian duyệt tin trống
                break;

                case 'urgent':
                    $title = 'Việc làm tuyển gấp';
                    $query->where('jobs.status', 1)
                        ->where(function ($q) {
                            $q->where('job_packages.slug', "tin-gap-vip")
                                ->orWhere('job_packages.slug', "tin-gap");
                        })
                        // ->orderByRaw('CASE WHEN jobs.top_position IS NOT NULL THEN 0 ELSE 1 END, jobs.top_position ASC')
                        ->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                        ->orderBy('jobs.id', 'DESC');        // Sắp xếp theo ID nếu thời gian duyệt tin trống
                    break;

            case 'moi-nhat':
                $title = 'Việc làm ngoài nước mới nhất';
                //Việc làm Mới nhất	Toàn bộ các tin đăng
                //Gấp.VIP -> Hot.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                    ->orderBy('jobs.id', 'DESC');        // Sắp xếp theo ID nếu thời gian duyệt tin trống
                break;
            case 'hap-dan':
                $title = 'Việc làm ngoài nước hấp dẫn';
                //Việc làm Mới nhất	Toàn bộ các tin đăng
                //Hot.VIP -> Gấp.VIP -> VIP -> Gấp -> Hot -> Tin thường
                $query->where('jobs.salaryMax', '>=', 8000000)
                    ->orWhere('jobs.salaryMax', '')
                    ->where('jobs.country', 'NN')
                    ->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                    ->orderBy('jobs.id', 'DESC');        // Sắp xếp theo ID nếu thời gian duyệt tin trống
                break;
            default:
                $title = 'Việc làm ngoài nước hôm nay';
                $query->orderBy('jobs.approved_at', 'DESC') // Sắp xếp theo thời gian duyệt tin
                    ->orderBy('jobs.id', 'DESC');
                $query->groupBy('jobs.id', 'jobs.user_id', 'job_province.job_id', 'auto_post_job_packages.area', 'job_packages.slug', 'jobs.top_position');
                $jobs = $query->limit(20)->get()->chunk(12);
                break;
        }

        return [
            'query' => $query,
            'title' => $title,
        ];
    }

    public static function searchHome($query, $request)
    {
        
        if ($request->name) {
            $query->where('jobs.name', 'LIKE', '%' . $request->name . '%');
        }
        
        if ($request->province_id) {
            $query->where('job_province.province_id', $request->province_id);
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
            $wage_id = $request->wage_id; //'10-15'
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
