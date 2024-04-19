<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request){
        $userName = $request->input('username');
        $passWord = $request->input('password');
        if($userName === 'info@timviecsieunhanh.vn' && $passWord === 'GciTHdp.MS72'){
            $data = [
                "soLuongTruyCap" => 100,
                "soNguoiBan" => 20,
                "soNguoiBanMoi" => 5,
                "tongSoSanPham" => 20000,
                "soSanPhamMoi" => 1200,
                "soLuongGiaoDich" => 200,
                "tongSoDonHangThanhCong" => 150,
                "tongSoDonHangKhongThanhCong" => 50,
                "tongGiaTriGiaoDich" => 1500000000
            ];
            return response()->json($data);
        }
        else
        {
            return response()->json(['message'=>'Bạn chưa có quyền truy cập'],401);
        }
    }
}
