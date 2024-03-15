<?php

namespace Modules\Staff\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Staff\app\Models\CvsExample;

class CvsExampleController extends Controller
{
    public function index(Request $request)
    {
        $userCvs = CvsExample::all();
        $params = [
            'items' => $userCvs
        ];
        return view('website.dashboards.cv.index', $params);
    }
}