<?php
 
namespace App\View\Composers;
 
use App\Models\Popup;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
 
class PopupComposer
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
        $popup = Popup::where('is_active', 1)->first(); // Lấy popup đang active
        $view->with('popup', $popup);
    }
}