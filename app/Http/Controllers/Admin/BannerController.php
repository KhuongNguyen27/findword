<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\UploadFileTrait;
use DB;
use Illuminate\Support\Facades\Auth;


class BannerController extends Controller
{
    use UploadFileTrait;
    protected $groupBannerOptions = ['Top Banner', 'Sidebar Banner', 'Bottom Banner'];

    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $this->authorize('viewAnySystem',Auth::user());

            $query = Banner::orderByDesc('created_at');
        
            if ($request->has('name')) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
            $items = $query->paginate(25)->withQueryString();
            return view('admin.banners.index', compact('items'));

        }
    

    /**
     * Show the form for crgeating a new resource.
     */
    public function create()
    {
        $this->authorize('createSystem',Auth::user());
        $groupBannerOptions = ['Top Banner', 'Sidebar Banner', 'Bottom Banner'];
        return view('admin.banners.create', compact('groupBannerOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        try {
            $data = $request->except('_token','_method');
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'uploads/banner');
            }else {
                $data['image'] = 'assets/images/favicon.png';
            }
            Banner::create($data);
            return redirect()->route('banners.index')
                ->with('success', 'banner created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating banner: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error creating banner. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('updateSystem',Auth::user());

        $banner = Banner::findOrFail($id);
        $groupBannerOptions = ['Top Banner', 'Sidebar Banner', 'Bottom Banner'];
        return view('admin.banners.edit', compact('banner', 'groupBannerOptions'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        try {
            $data = $request->except('_token','_method');
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'uploads/banner');
            }
            $banner = Banner::findOrFail($id);
            $banner->update($data);

            return redirect()->route('banners.index')
                ->with('success', 'banner updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating banner: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error updating banner. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('deleteSystem',Auth::user());

        try {
            $banner = Banner::findOrFail($id);
            $banner->delete();

            return redirect()->route('banners.index')
                ->with('success', 'banner deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting banner: ' . $e->getMessage());

            return redirect()->route('banners.index')
                ->with('error', 'Error deleting banner. Please try again later.');
        }
    }
}