<?php
 
namespace App\View\Composers;
 
use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Staff\app\Models\UserJobFavorite;
use Modules\Employee\app\Models\UserJobApply;

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

        $user_id = Auth::id();

        if ($user_id) {
            $appliedCount = UserJobApply::whereHas('job', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->count();

            $viewedCount = UserJobApply::whereHas('job', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->where('is_read', UserJobApply::ACTIVE)->count();

            $savedCount = UserJobApply::whereHas('job', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->where('favorites', true)->count();
        }

        $view->with('appliedCount', $appliedCount);
        $view->with('viewedCount', $viewedCount);
        $view->with('savedCount', $savedCount);
    }
}