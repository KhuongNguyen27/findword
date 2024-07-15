<?php
 
namespace App\View\Composers;
 
use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\app\Models\EmployeeCv;
use Modules\Staff\app\Models\UserJobFavorite;
use Modules\Employee\app\Models\UserJobApply;
use Modules\Staff\app\Models\UserCv;

class AppliedJobCountComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct() {}
 
    /**
     * Bind data to the view.
     */
   public function compose(View $view)
    {
        $appliedCount = 0;
        $viewedCount = 0;
        $savedCount = 0;
        $referredCount = 0;

        $user_id = Auth::id();

        if ($user_id) {
            $appliedCount = UserJobApply::whereHas('job', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->count();

            $viewedCount = EmployeeCv::where('user_id', $user_id)
            ->where('is_read', 1)
            ->count();

        $savedCount = EmployeeCv::where('user_id', $user_id)
            ->where('favorites', true)
            ->count();


            $referredCount = UserCv::all()->count();

        }

        $view->with('appliedCount', $appliedCount);
        $view->with('viewedCount', $viewedCount);
        $view->with('savedCount', $savedCount);
        $view->with('referredCount', $referredCount);

    }
}