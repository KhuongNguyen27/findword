<?php

namespace Modules\Transaction\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Modules\Transaction\app\Models\Transaction;
use Modules\Transaction\app\Http\Requests\StoreTransactionRequest;
use Modules\Transaction\app\Resources\TransactionResource;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $view_path    = 'transaction::';
    protected $route_prefix = 'employee.transaction.';
    protected $model        = Transaction::class;
    public function index(Request $request){
        try {
            $items = $this->model::where("user_id",Auth::id())->orderBy('created_at','DESC')->paginate(5);
            $params = [
                'route_prefix'  => $this->route_prefix,
                'items'         => $items
            ];
            return view($this->view_path.'index', $params);
        } catch (QueryException $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return redirect()->back()->with('error',  __('sys.get_items_error'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $params = [
            'route_prefix'  => $this->route_prefix,
        ];
        return view('transaction::create',$params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        try {
            $data = $request->except('_token','_method');
            $data['user_id'] = Auth::id();
            $data['type'] = "Nạp tiền";
            $data['item_id'] = 0;
            $data['status'] = 0;
            $item = $this->model::create($data);
            $params = [
                'route_prefix'  => $this->route_prefix,
            ];
            Notification::route('mail', [
                env('ADMIN_EMAIL') => env('ADMIN_NAME')
            ])->notify(new Notifications("transfer",$item->toArray()));
            return redirect()->route($this->route_prefix.'index')->with('success',  'Nạp tiền thành công. Vui lòng chờ quản trị viên phê duyệt!');
        } catch (QueryException $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return redirect()->back()->with('error',  'Nạp tiền thất bại. Vui lòng liên hệ quản trị viên!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        $params = [
            'item' => $item,
            'route_prefix'  => $this->route_prefix,
            'model'         => $this->model
        ];
        return view('transaction::admin.edit',$params);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $item = $this->model::findOrFail($id);
            $item->delete();
            return back()->with('success','Xóa giao dịch thành công');
        } catch (\Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return back()->with('error',__('sys.get_items_error'));
        }

    }
}