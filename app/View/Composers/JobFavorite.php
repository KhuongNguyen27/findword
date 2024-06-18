<?php
 
namespace App\View\Composers;
 
use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Staff\app\Models\UserJobFavorite;
 
class JobFavorite
{
    /**
     * Create a new profile composer.
     */
    public function __construct() {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $items = [];
        if( Auth::user() ){
            $items = UserJobFavorite::where( 'user_id', Auth::id())->pluck('job_id')->toArray();
        }
        $banners = Banner::where('group_banner', 'Top Banner')->orderBy('position')->get();
		$sidebarBanners = Banner::where('group_banner', 'Sidebar Banner')->orderBy('position')->get();
		$bottomBanners = Banner::where('group_banner', 'Bottom Banner')->orderBy('position')->get();

        //share vairiable for common
        $view->with('cr_user_favorites', $items);
        $view->with('sidebarBanners', $sidebarBanners);
        $view->with('bottomBanners', $bottomBanners);
        $view->with('banners', $banners);
        
    }
}