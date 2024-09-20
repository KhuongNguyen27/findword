<?php

namespace Modules\AdminUser\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountJobPackage;
use App\Models\CodeEmail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminUser\app\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\AdminUser\app\Http\Requests\StoreAdminUserRequest;
use Modules\AdminUser\app\Http\Requests\UpdateAdminUserRequest;
use Illuminate\Support\Facades\DB; // Sử dụng DB facade
use Modules\Account\app\Models\UserAccount;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Modules\Account\app\Models\UserJobPackage;

class AdminUserController extends Controller
{
    protected $view_path = 'adminuser::';
    protected $route_prefix = 'adminuser.';
    protected $model = AdminUser::class;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Auth::user());

        $type = $request->type ?? '';
        $items = $this->model::getItems($request);

        // Lấy giá trị của cột status từ bảng code_emails
        $emailStatuses = DB::table('code_emails')
            ->whereIn('email', $items->pluck('email'))
            ->pluck('status', 'email');

        // Lấy giá trị của cột is_allowed_abroad từ bảng user_employee dựa trên user_id
        $userEmployees = DB::table('user_employee')
            ->whereIn('user_id', $items->pluck('id')) // Sử dụng user_id thay vì email
            ->pluck('is_allowed_abroad', 'user_id');

        // Lấy tổng số lượng CV của mỗi user từ bảng user_cv
        $userCvCounts = DB::table('user_cvs')
            ->select('user_id', DB::raw('count(*) as total_cv'))
            ->whereIn('user_id', $items->pluck('id'))
            ->groupBy('user_id')
            ->pluck('total_cv', 'user_id');

        // Lấy tổng số lượng công việc đã nộp của mỗi user từ bảng user_job_applies
        $jobApplicationCounts = DB::table('user_job_applies')
            ->select('user_id', DB::raw('count(*) as total_jobs_applied'))
            ->whereIn('user_id', $items->pluck('id'))
            ->groupBy('user_id')
            ->pluck('total_jobs_applied', 'user_id');
        // dd ($userEmployees);
        // Thêm giá trị email_status vào mỗi item
        foreach ($items as $item) {
            $item->email_status = $emailStatuses[$item->email] ?? null;
            $item->is_allowed_abroad = $userEmployees[$item->id] ?? null;
            $item->total_cv = $userCvCounts[$item->id] ?? 0;
            $item->total_jobs_applied = $jobApplicationCounts[$item->id] ?? 0;
        }
        $params = [
            'route_prefix' => $this->route_prefix,
            'model' => $this->model,
            'items' => $items
        ];
        // dd($params);
        if ($type) {
            return view($this->view_path . 'types.' . $type . '.index', $params);
        }
        return view($this->view_path . 'index', $params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create',Auth::user());
        $type = $request->type ?? '';
        $params = [
            'route_prefix' => $this->route_prefix,
            'model' => $this->model
        ];
        if ($type) {
            return view($this->view_path . 'types.' . $type . '.create', $params);
        }
        return view($this->view_path . 'create', $params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminUserRequest $request)
    {
        $type = $request->type;
        // Chưa có tách type cho admin
        try {
            $this->model::saveItem($request, $type);
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.item_not_found'));
        }
    }


    /**
     * Show the specified resource.
     */
    public function showCVs(Request $request)
    {
        $type = $request->type;
        try {
            $item = $this->model::findOrFail($request->id);
            $params = [
                'route_prefix' => $this->route_prefix,
                'model' => $this->model,
                'item' => $item
            ];
            if ($type == 'staff') {
                return view($this->view_path . 'showStaff', $params);
            }
            if ($type == 'employee') {
                return view($this->view_path . 'showEmployee', $params);
            }
        } catch (QueryException $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.get_items_error'));
        }
    }
    public function showCV(Request $request)
    {
        $type = $request->type;
        try {
            $item = $this->model::showCV($request, $type);
            $params = [
                'route_prefix' => $this->route_prefix,
                'model' => $this->model,
                'item' => $item
            ];
            return view($this->view_path . 'showCV', $params);
        } catch (QueryException $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.get_items_error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',Auth::user());
        try {
            $type = request()->type;
            $item = $this->model::findOrFail($id);
            // dd($item->employee->background_fm);
            $params = [
                'item' => $item,
                'model' => $this->model
            ];
            if ($type) {
                return view($this->view_path . 'types.' . $type . '.edit', $params);
            }
            return view($this->view_path . 'edit', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.item_not_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminUserRequest $request, $id)
    {

        $type = $request->type;
        try {

            $user = $this->model::findOrFail($id);

              // Lưu giá trị cũ của cột verify
            $oldVerifyStatus = $user->verify;
            $this->model::updateItem($id, $request, $type);

            if ($request->verify == $this->model::ACTIVE && $oldVerifyStatus != $this->model::ACTIVE) {

                if (!UserAccount::where('user_id', $id)->exists()) {
                    $register_date = new \DateTime();
                    $expiration_date = (clone $register_date)->add(new \DateInterval('P30D'));

                    $userAccount = UserAccount::create([
                        'user_id' => $id,
                        'account_id' => 1,  
                        'duration_id' => 1,
                        'is_current' => 1,
                        'register_date' => $register_date->format('Y-m-d H:i:s'),
                        'expiration_date' => $expiration_date->format('Y-m-d H:i:s'),
                    ]);
                }

                $countPackages = AccountJobPackage::where('account_id',1)->get();
                foreach ($countPackages as $countPackage) {
                    UserJobPackage::create([
                        'user_id' => $id,
                        'job_package_id' => $countPackage->job_package_id,  
                        'amount' => $countPackage->amount,  
                    ]);
                }

                // Gửi email thông báo
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                ];

                Notification::route('mail', $user->email)
                            ->notify(new Notifications('veryfi', $data));
            }
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error('Error in update method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.update_item_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $this->authorize('delete', Auth::user());

    $type = request()->type ?? '';
    try {
        // Tìm user theo ID
        $user = $this->model::findOrFail($id);
        $type = $user->type;

        // Xóa email trong bảng code_email nếu tồn tại
        $codeEmail = CodeEmail::where('email', $user->email)->first();
        if ($codeEmail) {
            $codeEmail->delete(); // Xóa record trong bảng code_email
        }

        // Xóa user
        $this->model::deleteItem($id);

        return redirect()->route($this->route_prefix . 'index', ['type' => $type])
            ->with('success', __('sys.destroy_item_success'));
    } catch (ModelNotFoundException $e) {
        Log::error('Item not found: ' . $e->getMessage());
        return redirect()->route($this->route_prefix . 'index', ['type' => $type])
            ->with('error', __('sys.item_not_found'));
    } catch (QueryException $e) {
        Log::error('Error in destroy method: ' . $e->getMessage());
        return redirect()->route($this->route_prefix . 'index', ['type' => $type])
            ->with('error', __('sys.destroy_item_error'));
    }
}

}
