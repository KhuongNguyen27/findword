<?php

namespace Modules\AdminPost\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\AdminPost\app\Http\Requests\StoreAdminPostRequest;
use Illuminate\Http\Response;
use Modules\AdminPost\app\Models\AdminPost;
use Modules\AdminPost\app\Models\UserCV;
use Modules\AdminUser\app\Models\AdminUser;
use Modules\Staff\app\Models\UserExperience;
use Modules\Staff\app\Models\UserEducation;
use Modules\Staff\app\Models\UserSkill;
use Modules\Staff\app\Models\UserStaff;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;

class AdminPostController extends Controller
{
    protected $view_path = 'adminpost::';
    protected $route_prefix = 'adminpost.';
    protected $model = AdminPost::class;

    // public function index(Request $request)
    // {
    //     // $this->authorize('viewAny',$this->model);
    //     $type = $request->type;
    //     $items = $this->model::getItems($request,null,$type);
    //     // dd($items);
    //     $params = [
    //         'route_prefix'  => $this->route_prefix,
    //         'model'         => $this->model,
    //         'items'         => $items
    //     ];
    //     if ($type && view()->exists($this->view_path.'types.'.$type.'.index')) {
    //         return view($this->view_path.'types.'.$type.'.index', $params);
    //     }
    //     return view($this->view_path.'index', $params);
    // }
    /**
     * Show the form for creating a new resource.
     */

    public function index(Request $request)
    {
        // $this->authorize('viewAny',$this->model);
        $type = $request->type;
        if ($type === 'UserCV') {
            $uniqueUserIds = DB::table('user_cvs')
                ->distinct()
                ->pluck('user_id');
            $query = AdminUser::query();
            if ($request->name) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
            $query->whereIn('id', $uniqueUserIds)->withCount('userCVs');
            $items = $query->paginate(20);
        } else {
            $items = $this->model::getItems($request, null, $type);
        }
        $params = [
            'route_prefix' => $this->route_prefix,
            'model' => $this->model,
            'items' => $items
        ];
        if ($type && view()->exists($this->view_path . 'types.' . $type . '.index')) {
            return view($this->view_path . 'types.' . $type . '.index', $params);
        }
        return view($this->view_path . 'index', $params);
    }

    public function show_detail_cv($user_id, Request $request)
    {
        // dd(234);
        $query = UserCV::query();
        $query->where('user_id', $user_id);
        if ($request->name) {
            $query->where('cv_file', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->status !== NULL) {
            $query->where('status', $request->status);
        }
        $query->orderBy('id', 'DESC');
        $items = $query->paginate(25);

        // Lấy thông tin ứng viên
        $user = User::find($user_id);
        // dd($user);

        $params = [
            'route_prefix' => $this->route_prefix,
            'model' => $this->model,
            'items' => $items,
            'user' => $user,
        ];
        return view('adminpost::types.UserCV.show_detail', $params);
    }
    public function create(Request $request)
    {
        // $this->authorize('create',$this->model);
        $type = $request->type;
        $params = [
            'route_prefix' => $this->route_prefix,
            'model' => $this->model,
            'type' => $request->type,
        ];
        if ($type && view()->exists($this->view_path . 'types.' . $type . '.create')) {
            return view($this->view_path . 'types.' . $type . '.create', $params);
        }
        return view($this->view_path . 'create', $params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminPostRequest $request, $type = ''): RedirectResponse
    {
        // dd($request->all());
        $type = $request->type;
        $request->merge(['province_id' => 1]);
        // dd($request);
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            $this->model::saveItem($request, $type);
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.update_item_error'));
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id, Request $request)
    {
        // $this->authorize('view',$this->model);
        $type = $request->type;
        try {
            $item = $this->model::findItem($id, $type);
            // dd($item);
            $params = [
                'route_prefix' => $this->route_prefix,
                'model' => $this->model,
                'item' => $item
            ];
            if ($type && view()->exists($this->view_path . 'types.' . $type . '.show')) {
                return view($this->view_path . 'types.' . $type . '.show', $params);
            }
            return view($this->view_path . 'show', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.item_not_found'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        // $this->authorize('update',$this->model);
        $type = $request->type;
        try {
            $item = $this->model::findItem($id, $type);
// dd($item);
            $params = [
                'route_prefix' => $this->route_prefix,
                'model' => $this->model,
                'item' => $item
            ];
            if ($type && view()->exists($this->view_path . 'types.' . $type . '.edit')) {
                return view($this->view_path . 'types.' . $type . '.edit', $params);
            }
            return view($this->view_path . 'edit', $params)->with('success', ('thanh cong'));
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.item_not_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAdminPostRequest $request, $id): RedirectResponse
    {
        // dd($request->all());
        $type = $request->type;
    
        try {
            $item = $this->model::findItem($id, $type);
            $previousStatus = $item->status;
    
            // Lấy trạng thái mới từ request, mặc định là trạng thái cũ
            $newStatus = $request->input('status', $previousStatus);
    
            // Cập nhật các thuộc tính khác của item
            $this->model::updateItem($id, $request, $type);
    
            // Nếu trạng thái thay đổi
            if ($previousStatus != $newStatus) {
                $item->updateStatus($newStatus);
    
                $data = [
                    'name' => $item->user->name,
                    'job_title' => $item->name
                ];
    
                // Xác định loại thông báo dựa vào trạng thái mới
                if ($newStatus == 1) { // 1 là trạng thái duyệt
                    $notificationType = 'active-job';
                } elseif ($newStatus == 2) { // 2 là trạng thái từ chối
                    $notificationType = 'rejected-job';
                } else {
                    return redirect()->route($this->route_prefix . 'index', ['type' => $type])
                        ->with('success', __('sys.update_item_success'));
                }
    
                // Tạo thông báo và gửi email
                Notification::route('mail', $item->user->email)
                    ->notify(new Notifications($notificationType, $data));
    
                // Lưu thông báo vào bảng notification
                \App\Models\Notification::create([
                    'user_id' => $item->user->id, // ID của nhà tuyển dụng
                    'type' => 'job', // Loại thông báo
                    'action' => $newStatus == 1 ? 'approved' : 'rejected', // Hành động
                    'is_read' => false,
                    'item_id' => $id, // ID của tin đăng
                ]);
            }
    
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])
                ->with('success', __('sys.update_item_success'));
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
    public function destroy(Request $request)
    {
        // $this->authorize('delete',$this->model);
        try {
            $id = request()->adminpost;
            $type = $request->type;
            $this->model::deleteItem($id, $type);
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            $type = $request->type;
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            $type = $request->type;
            Log::error('Error in destroy method: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('error', __('sys.destroy_item_error'));
        }
    }
    // public function showCV($id)
    // {
    //     try {
    //         $cv = 1;
    //         return view('adminpost::types.UserCV.show', compact('cv'));
    //     } catch (ModelNotFoundException $e) {
    //         Log::error('CV not found: ' . $e->getMessage());
    //         return redirect()->route('adminpost.index')->with('error', __('CV not found'));
    //     }
    // }
    public function showCV($id)
    {
        try {
            $item = UserCV::findOrFail($id);
            $userStaff = UserStaff::where('user_id', $item->user_id)->first();
            $userExperiences = UserExperience::where('cv_id', $id)->get();
            $userEducations = UserEducation::where('cv_id', $id)->get();
            $userSkills = UserSkill::where('cv_id', $id)->get();

            $params = [
                'item' => $item,
                'userExperiences' => $userExperiences,
                'userEducations' => $userEducations,
                'userSkills' => $userSkills,
                'userStaff' => $userStaff,
            ];
            // dd($userExperiences);
            return view('adminpost::types.UserCV.show', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('CV not found: ' . $e->getMessage());
            return redirect()->route('adminpost.index')->with('error', __('CV not found'));
        }
    }
}
