<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Province;
use App\Models\Wage;
use App\Models\Rank;

class CareerController extends Controller
{
    public function show($slug, Request $request){
        $item = Career::where('status', 1)->where('slug',$slug)->firstOrFail();
        $provinces = Province::all();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $careers = Career::where('status', 1)->get();

        $request->merge(['career_id'=>$item->id]);

        $items = [];
        $params = [
            'item' => $item,
            'items' => $items,
            'wages' => $wages,
            'provinces' => $provinces,
            'ranks' => $ranks,
            'careers' => $careers,
            'route' => 'jobs.vnjobs.today',
        ];
        return view('website.career.show',$params);
    }
}
