<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEmployee;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $query = UserEmployee::query(true);
        if( $request->name ){
            $query->where('name','LIKE',"%$request->name%");
        }
        $items = $query->orderBy('position')->paginate(9);
        $params = [
            'items' => $items
        ];
        return view('website.employees.index',$params);
    }
}
