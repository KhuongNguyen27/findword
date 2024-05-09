<?php

namespace Modules\Account\app\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Account\app\Models\Account;
use Modules\Account\app\Models\Duration;
use Modules\Account\app\Models\JobPackage;
use Modules\Account\app\Models\UserAccount;
use DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $view_path    = 'account::website.';
    protected $route_prefix = 'website.account.';
    protected $model        = Account::class;
    public function index()
    {
        $items = $this->model::orderBy('position')->get();
        $package_current = UserAccount::whereUser_id(Auth::id())->whereIs_current(1)->whereDate('expiration_date', '>', date('Y-m-d H:i:s'))->first();
        $params = [
            'items' => $items,
            'package_current' => $package_current,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'index',$params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try{
            $user = Auth::user();
            $package = Account::findOrfail($request->package_id);
            $duration = Duration::findOrfail($request->duration_id);
            if ($user->points < $package->price*($duration->number_date/30)) {
                return redirect()->route($this->route_prefix.'index')->with('error','Bạn không đủ điểm tuyển dụng. Vui lòng nạp thêm!');
            }
            $user->points -= $package->price*($duration->number_date/30);
            $user->save();
            $package_current = UserAccount::whereUser_id($user->id)->whereIs_current($user::ACTIVE)->first();
            $package_current->is_current = $user::INACTIVE;
            $package_current->save();
            $is_current = 1;
            $register_date = date('Y-m-d H:i:s');
            $register_date = new \DateTime($register_date);
            $expiration_date = clone $register_date;
            $expiration_date->add(new \DateInterval('P'.$duration->number_date.'D'));
            $data = [
                'user_id' => Auth::id(),
                'account_id' => $package->id,
                'duration_id' => $duration->id,
                'register_date' => $register_date->format('Y-m-d H:i:s'),
                'expiration_date' => $expiration_date->format('Y-m-d H:i:s'),
                'is_current' => $is_current
            ];
            $userPackage = UserAccount::create($data);
            DB::commit();
            return redirect()->route($this->route_prefix.'index')->with('success','Thanh toán gói thành công');
        }catch(\Exception $e){
            DB::rollback();
            Log::error('Bug in :'.$e->getMessage());
            return redirect()->route($this->route_prefix.'index')->with('error','Thanh toán gói thất bại. Vui lòng thử lại!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $package_current = UserAccount::where('account_id', '<>', 1)
            ->where('user_id', Auth::id())
            ->where('is_current', 1)
            ->whereDate('expiration_date', '>', date('Y-m-d H:i:s'))
            ->first();
        if($package_current){
            return back()->with('error','Bạn đã mua Gói Tài khoản khác, vui lòng đợi hết thời gian sử dụng Gói Tài khoản cũ để mua thêm!');
        }
        $item = $this->model::findOrfail($id);
        $durations = Duration::all();
        $params = [
            'item' => $item,
            'durations' => $durations,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'show',$params);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('account::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}