<?php 
namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class UnreadMessagesComposer
{
    /**
     * The unread messages count for the authenticated user.
     *
     * @var int
     */
    protected $unreadMessagesCount;

    /**
     * Create a new composer instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check()) {
            $this->unreadMessagesCount = Message::where('user_id', Auth::id())
                                                ->where('is_read', false)
                                                ->count();
        } else {
            $this->unreadMessagesCount = 0;
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('unreadMessagesCount', $this->unreadMessagesCount);
    }
}
