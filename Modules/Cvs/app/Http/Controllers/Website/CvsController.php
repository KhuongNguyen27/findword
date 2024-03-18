<?php

namespace Modules\Cvs\app\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Log;
use DB;
use Modules\Cvs\app\Models\Cv;
use Modules\Cvs\app\Models\Style;
use Modules\Cvs\app\Models\Career;

class CvsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UploadFileTrait;
    protected $view_path    = 'cvs::website.';
    protected $route_prefix = 'cvs.';
    protected $model        = Cv::class;
    public function index(Request $request)
    {
        $cvs_query = $this->model::query()->whereStatus($this->model::ACTIVE);
        $careers_query = Career::query()->whereStatus(Career::ACTIVE);
        $styles_query = Style::query()->whereStatus(Career::ACTIVE);
        // Kiểm tra điều kiện
        if (request()->language) {
            $cvs_query->whereLanguage(request()->language);
        }
        $items = $cvs_query->paginate(4);
        $careers = $careers_query->get();
        $styles = $styles_query->get();
        $param = [
            'items' => $items,
            'careers' => $careers,
            'styles' => $styles,
            'view_path' => $this->view_path,
            'model' => $this->model,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'index',$param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cvs::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cvs::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('cvs::edit');
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