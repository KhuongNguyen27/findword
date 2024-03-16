<?php

namespace Modules\Cvs\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cvs\app\Models\Cv;
use Modules\Cvs\app\Models\Style;
use Modules\Cvs\app\Models\Career;
use Modules\Cvs\app\Http\Requests\StoreCvRequest;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Log;

class CvsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UploadFileTrait;
    protected $view_path    = 'cvs::';
    protected $route_prefix = 'admin.cvs.';
    protected $model        = Cv::class;
    public function index()
    {
        $items = $this->model::paginate(5);
        $param = [
            'items' => $items,
            'model' => $this->model,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'admin.index',$param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $styles = Style::whereStatus(Style::ACTIVE)->get();
        $careers = Career::whereStatus(Career::ACTIVE)->get();
        $param = [
            'styles' => $styles,
            'careers' => $careers,
            'model' => $this->model,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'admin.create',$param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCvRequest $request): RedirectResponse
    {
        
        try {
            $data = $request->except('_token','_method');
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'uploads/cv_image');
            }else {
                $data['image'] = 'assets/images/favicon.png';
            }
            if ($request->hasFile('file_cv')) {
                $data['file_cv'] = $this->uploadFile($request->file('file_cv'), 'uploads/cv_file');
            }else {
                $data['file_cv'] = 'assets/images/favicon.png';
            }
            $this->model::create($data);
            return redirect()->route($this->route_prefix.'index')->with('success','Tạo Cv mẫu thành công');
        } catch (\Exception $e) {
            Log::error('Bug in : '.$e->getMessage());
            return redirect()->back()->with('error','Tạo Cv mẫu thất bại');
        }
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