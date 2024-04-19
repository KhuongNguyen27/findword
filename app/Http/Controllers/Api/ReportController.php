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
                "soLuongTruyCap" => 0,
                "soNguoiBan" => 0,
                "soNguoiBanMoi" => 0,
                "tongSoSanPham" => 0,
                "soSanPhamMoi" => 0,
                "soLuongGiaoDich" => 0,
                "tongSoDonHangThanhCong" => 0,
                "tongSoDonHangKhongThanhCong" => 0,
                "tongGiaTriGiaoDich" => 0
            ];
            return response()->json($data);
        }
        else
        {
            return response()->json(['message'=>'Bạn chưa có quyền truy cập'],401);
        }
    }
}
