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
        $query = $this->model::query()->whereStatus($this->model::ACTIVE);
        if($request->name){
            $query->whereName($request->name);
        }
        if($request->status){
            $query->whereName($request->status);
        }
        $items = $query->paginate(5);
        $param = [
            'items' => $items,
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
        return view('cvs::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
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