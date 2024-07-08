<?php

namespace Modules\Employee\app\Http\Controllers;
use Modules\Employee\app\Models\User;
use Modules\Employee\app\Models\UserJobApply;
use Modules\Employee\app\Models\UserEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Modules\Employee\app\Models\Job;
use Modules\Transaction\app\Models\Transaction; // Import Transaction model for logging transactions
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userEmployees = UserEmployee::whereHas('user', function ($query) {
            $query->where('status', UserEmployee::ACTIVE);
        })->paginate(2);
        $user = new User();
        $image = $user->getImage($userEmployees[0]->user_id);
        $params = [
            'userEmployees' => $userEmployees,
            'image' => $image,
        ];
        return view('employee::employers.index',$params);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $userEmployee = UserEmployee::where('slug',$slug)->firstOrFail();
            $jobs = Job::where('user_id',$userEmployee->user_id)->paginate(5);
            $count_jobs = Job::where('user_id',$userEmployee->user_id)->count();
            $user = new User();
            $image = $user->getImage($userEmployee->user_id);
            $params = [
                'count_jobs' => $count_jobs,
                'userEmployee' => $userEmployee,
                'jobs' => $jobs,
                'image' => $image
            ];
            return view('employee::employers.show', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route( 'home' )->with('error', __('sys.item_not_found'));
        }
    }

    public function checkContactInfo(Request $request){
        $check = $request->input('check');
        $applyId = $request->input('applyId');
        if(!empty($check) && !empty($applyId)){
            $applyJob = UserJobApply::findOrFail($applyId);
            if($applyJob->is_checked == 1){
                $staff = User::findOrFail($applyJob->user_id);
                $contactInfo = [
                    'email' => $staff->email,
                    'phone' => $staff->userStaff->phone,
                ];
                return response()->json([
                    'success' => true,
                    'data' => $contactInfo,
                ]);    
            }
        }
        return response()->json([
            'success' => false,
            'message' => '',
        ]); 
    }

    public function getContactInfo(Request $request)
    {
        // DB::beginTransaction();
        try {
            // Lấy thông tin từ request
            $employeeId = $request->input('employee_id');
            $staffId = $request->input('staff_id');
            $price = $request->input('amount');
            $applyId = $request->input('applyId');
            // Xử lý trừ tiền và ghi log
            if(!empty($employeeId)){
                $employee = User::findOrFail($employeeId);
                if($employee->points >= $price){
                    $employee->points -= $price;
                    $applyJob = UserJobApply::findOrFail($applyId);
                    $staff = User::findOrFail($applyJob->user_id);
                    if($applyJob){
                        $applyJob->is_checked = 1;
                        $applyJob->save();
                    }
                    $employee->save();
                    $contactInfo = [
                        'id' => $staff->id,
                        'email' => $staff->email,
                        'phone' => $staff->userStaff->phone,
                    ];
                    return response()->json([
                        'success' => true,
                        'data' => $contactInfo,
                    ]);
                }
                return response()->json([
                    'success' => false,
                    'message' => "Nhà tuyển dụng không đủ điểm thực hiện yêu cầu",
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => "Không tìm thấy người dùng phù hợp",
            ]);
            // DB::commit();
        } catch (ModelNotFoundException $e) {
            // DB::rollBack();
            Log::error('User not found: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'User not found']);
        } catch (\Exception $e) {
            // DB::rollBacks();
            Log::error('Error processing payment: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error processing payment']);
        }
    }

    /**
     * Xử lý thanh toán và trả về mã giao dịch.
     *
     * @param  int  $customerId
     * @param  float  $amount
     * @return string
     */
    private function processPayment($customerId, $amount)
    {
        // Giả định xử lý thanh toán và trả về một mã giao dịch giả định
        $transactionId = uniqid('transaction_');
        // Đoạn code xử lý thanh toán thực tế sẽ được thêm vào đây
        return $transactionId;
    }

    /**
     * Ghi log giao dịch vào cơ sở dữ liệu.
     *
     * @param  int  $employeeId
     * @param  int  $customerId
     * @param  float  $amount
     * @param  string  $transactionId
     * @return void
     */
    private function logTransaction($employeeId, $customerId, $amount, $transactionId)
    {
        // Giả định ghi log vào cơ sở dữ liệu
        Transaction::create([
            'employee_id' => $employeeId,
            'customer_id' => $customerId,
            'amount' => $amount,
            'transaction_id' => $transactionId,
        ]);
    }
}