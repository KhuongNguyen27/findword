<?php

namespace Modules\Transaction\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Transaction\app\Models\Transaction;
use Modules\Transaction\app\Resources\TransactionResource;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Modules\Transaction\app\Http\Requests\StoreTransactionsRequest;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $view_path    = 'transaction::admin.';
    protected $route_prefix = 'admin.transactions.';
    protected $model        = Transaction::class;   
    public function index()
    {
        try {
            $items = $this->model::orderBy('created_at','DESC')->paginate(5);
            $params = [
                'route_prefix'  => $this->route_prefix,
                'items'         => $items,
                'model'         => $this->model
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
        $employees = User::whereType('employee')->get();
        $params = [
            'route_prefix'  => $this->route_prefix,
            'employees' => $employees,
            'model'         => $this->model
        ];
        return view('transaction::admin.create',$params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionsRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token','_method');
            $data['item_id'] = 0;
            $item = $this->model::create($data);
            if($item->status == $item::ACTIVE){
                $userId = $item->user_id;
                $user = User::findOrfail($userId);
                $user->points += $item->amount;
                $user->save();
            }
            DB::commit();
            return redirect()->route($this->route_prefix.'index')->with('success','Tạo giao dịch thành công');
        } catch (\Exeption $e) {
            DB::rollback();
            Log::error('Bug error: '.$e->getMessage());
            return redirect()->route($this->route_prefix.'index')->with('success','Tạo giao dịch thất bại');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = $this->model::findOrFail($id);
        $item->user_id = $item->user->name;
        return new TransactionResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('transaction::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_method','_token');
            $item = $this->model::findOrFail($id);
            $item->update($data);
            if($item->status == $item::ACTIVE){
                $userId = $item->user_id;
                $user = User::findOrfail($userId);
                $user->points += $item->amount;
                $user->save();
            }
            DB::commit();
            return back()->with('success','Cập nhập trạng thái giao dịch thành công');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in index method: ' . $e->getMessage());
            return back()->with('error',__('sys.get_items_error'));
        }
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