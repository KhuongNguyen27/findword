<?php

namespace Modules\AdminUser\app\Http\Controllers;

use App\Http\Controllers\Controller;
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
        // dd($request->type);
        $type = $request->type;
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
        // dd(123);
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
            if (!UserAccount::where('user_id', $id)->first() && $request->verify == $this->model::ACTIVE) {
                $register_date = date('Y-m-d H:i:s');
                $register_date = new \DateTime($register_date);
                $expiration_date = clone $register_date;
                $expiration_date->add(new \DateInterval('P30D'));
                UserAccount::create(
                    [
                        'user_id' => $id,
                        'account_id' => 1,
                        'duration_id' => 1,
                        'is_current' => 1,
                        'register_date' => $register_date->format('Y-m-d H:i:s'),
                        'expiration_date' => $expiration_date->format('Y-m-d H:i:s'),
                    ]
                );
            }
            $this->model::updateItem($id, $request, $type);
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
        $type = request()->type ?? '';
        try {
            $item = $this->model::findOrFail($id);
            $type = $item->type;
            $this->model::deleteItem($id);

            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error('Error in destroy method: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('error', __('sys.destroy_item_error'));
        }
    }
}
