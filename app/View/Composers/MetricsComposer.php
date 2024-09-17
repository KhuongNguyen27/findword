<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MetricsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'quantity_job_new_today' => $this->getMetricValue('Việc làm mới 24h gần nhất'),
            'quantity_job_new' => $this->getMetricValue('Việc làm mới nhất'),
            'quantity_job_recruitment' => $this->getMetricValue('Việc làm đang tuyển'),
            'quantity_company_recruitment' => $this->getMetricValue('Công ty đang tuyển'),
            'vi_tri_cho_ban_kham_pha' => $this->getMetricValue('Vị trí chờ bạn khám phá'),
        ]);
    }

    /**
     * Get the value from metrics table.
     *
     * @param string $name
     * @return mixed
     */
    private function getMetricValue(string $name)
    {
        return DB::table('metrics')->where('name', $name)->value('total');
    }
}
