<?php

namespace Modules\Cvs\app\Http\Controllers\Admin;

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
use DB;
use Illuminate\Support\Facades\Auth;

class CvsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UploadFileTrait;
    protected $view_path    = 'cvs::admin.';
    protected $route_prefix = 'admin.cvs.';
    protected $model        = Cv::class;
    public function index(Request $request)
    {
        $this->authorize('viewAnySystem',Auth::user());

        $cvs_query = $this->model::query()->whereStatus($this->model::ACTIVE);
        $careers = Career::whereStatus(Career::ACTIVE)->get();
        $styles = Style::whereStatus(Style::ACTIVE)->get();
        if(request()->name){
            $cvs_query->where('name','LIKE', '%'.request()->name.'%');
        }
        if(request()->language){
            $cvs_query->whereLanguage(request()->language);
        }
        if (request()->career) {
            $cvs_query->whereHas('careers',function($query){
                $query->where('slug',request()->career);
            });
        }
        if (request()->style) {
            $cvs_query->whereHas('styles',function($query){
                $query->where('slug',request()->style);
            });
        }
        $items = $cvs_query->orderBy('created_at','desc')->paginate(5);
        $param = [
            'items' => $items,
            'careers' => $careers,
            'styles' => $styles,
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
        $this->authorize('createSystem',Auth::user());

        $styles = Style::whereStatus(Style::ACTIVE)->get();
        $careers = Career::whereStatus(Career::ACTIVE)->get();
        $param = [
            'styles' => $styles,
            'careers' => $careers,
            'model' => $this->model,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'create',$param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCvRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token','_method');
            $data['status'] = 1;
            $career_ids = $data['career_ids'];
            $style_ids = $data['style_ids'];
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
            $item = $this->model::create($data);
            $item->styles()->attach($style_ids);
            $item->careers()->attach($career_ids);
            DB::commit();
            return redirect()->route($this->route_prefix.'index')->with('success','Tạo Cv mẫu thành công');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Bug in : '.$e->getMessage());
            return redirect()->back()->with('error','Tạo Cv mẫu thất bại');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $this->authorize('viewSystem',Auth::user());

        return view('cvs::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('updateSystem',Auth::user());

        $item = $this->model::findOrfail($id);
        $styles = Style::whereStatus(Style::ACTIVE)->get();
        $careers = Career::whereStatus(Career::ACTIVE)->get();
        $param = [
            'item' => $item,
            'styles' => $styles,
            'careers' => $careers,
            'model' => $this->model,
            'route_prefix' => $this->route_prefix
        ];
        return view($this->view_path.'edit',$param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $item = $this->model::findOrfail($id);
            $data = $request->except('_token','_method');
            $career_ids = $data['career_ids'];
            $style_ids = $data['style_ids'];
            if ($request->hasFile('image')) {
                $this->deleteFile([$item->image]);
                $data['image'] = $this->uploadFile($request->file('image'), 'uploads/cv_image');
            }
            if ($request->hasFile('file_cv')) {
                $this->deleteFile([$item->file_cv]);
                $data['file_cv'] = $this->uploadFile($request->file('file_cv'), 'uploads/cv_file');
            }
            $item->styles()->detach();
            $item->careers()->detach();
            $item->styles()->attach($style_ids);
            $item->careers()->attach($career_ids);
            $item->update($data);
            DB::commit();
            return redirect()->route($this->route_prefix.'index')->with('success','Cập nhập Cv mẫu thành công');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Bug in : '.$e->getMessage());
            return redirect()->back()->with('error','Cập nhập Cv mẫu thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('deleteSystem',Auth::user());

        try {
            $item = $this->model::findOrfail($id);
            $item->styles()->detach();
            $item->careers()->detach();
            $this->deleteFile([$item->image]);
            $this->deleteFile([$item->file_cv]);
            $item->delete();
            return redirect()->back()->with('success','Xóa hồ sơ mẫu thành công');
        } catch (\Exception $e) {
            Log::error('Bug in : '.$e->getMessag());
            return redirect()->back()->with('error','Xóa hồ sơ mẫu thất bại');
        }
    }
}