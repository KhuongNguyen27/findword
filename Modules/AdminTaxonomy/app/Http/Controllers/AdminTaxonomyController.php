<?php

namespace Modules\AdminTaxonomy\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AutoPostJobPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\AdminTaxonomy\app\Http\Requests\StoreAdminTaxonomyRequest;
use Illuminate\Http\Response;
use Modules\AdminTaxonomy\app\Models\AdminTaxonomy;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AdminTaxonomyController extends Controller
{
    protected $view_path    = 'admintaxonomy::';
    protected $route_prefix = 'admintaxonomy.';
    protected $model        = AdminTaxonomy::class;
    public function index(Request $request)
    {
        $type = $request->type;
        $items = $this->model::getItems($request, null, $type);
        $params = [
            'route_prefix'  => $this->route_prefix,
            'model'         => $this->model,
            'items'         => $items
        ];
        // dd($items);
        if ($type && view()->exists($this->view_path . 'types.' . $type . '.index')) {
            return view($this->view_path . 'types.' . $type . '.index', $params);
        }
        return view($this->view_path . 'index', $params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->type;
        $params = [
            'route_prefix'  => $this->route_prefix,
            'model'         => $this->model,
            'type'         => $request->type,
        ];
        if ($type && view()->exists($this->view_path . 'types.' . $type . '.create')) {
            return view($this->view_path . 'types.' . $type . '.create', $params);
        }
        return view($this->view_path . 'create', $params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminTaxonomyRequest $request): RedirectResponse
    {
        $type = $request->type;
        // dd($request);
        try {
            $this->model::saveItem($request, $type);
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.item_not_found'));
        }
    }


    /**
     * Show the specified resource.
     */
    public function show($id, Request $request)
    {
        $type = $request->type;
        try {
            $item = $this->model::findItem($id, $type);
            $params = [
                'route_prefix'  => $this->route_prefix,
                'model'         => $this->model,
                'item' => $item
            ];
            if ($type && view()->exists($this->view_path . 'types.' . $type . '.show')) {
                return view($this->view_path . 'types.' . $type . '.show', $params);
            }
            return view($this->view_path . 'show', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.item_not_found'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $type = $request->type;
        try {
            $item = $this->model::findItem($id, $type);
          
            if ($type === "Account" && isset($item->ckeditor_features)) {
            $decodedFeatures = json_decode($item->ckeditor_features, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $item->ckeditor_features = $decodedFeatures;
            } else {
                Log::error('JSON decode error in ckeditor_features: ' . json_last_error_msg());
            }
        }
            $ckeditor_features = $item->ckeditor_features ?? [];
            $selectAllChecked = !empty(array_filter($ckeditor_features)) ? 'checked' : '';
            // dd($ckeditor_features);
            $params = [
                'route_prefix'  => $this->route_prefix,
                'model'         => $this->model,
                'item' => $item,
                'ckeditor_features' => $ckeditor_features, 
                'selectAllChecked' => $selectAllChecked,

            ];
            if ($type && view()->exists($this->view_path . 'types.' . $type . '.edit')) {
                return view($this->view_path . 'types.' . $type . '.edit', $params);
            }
            return view($this->view_path . 'edit', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index')->with('error', __('sys.item_not_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAdminTaxonomyRequest $request, $id): RedirectResponse
    {

        $type = $request->type;
        try {
            $this->model::updateItem($id, $request, $type);

            if ($type === "Account") {
                $ckeditorFeatures = $request->input('ckeditor_features', []);
                $ckeditorFeaturesJson = json_encode($ckeditorFeatures);
                $account = Account::find($id);
                if ($account) {
                    $account->ckeditor_features = $ckeditorFeaturesJson;
                    $account->save();
                } else {
                    return redirect()->back()->with('error', __('sys.account_not_found'));
                }
            } else if ($type === "JobPackage") {
                // Cập nhật các thông tin khác liên quan đến AutoPostJobPackage
                $autoPostJobPackage = AutoPostJobPackage::where("job_package_id", $id)->first();
                if ($autoPostJobPackage) {
                    $autoPostJobPackage->area = $request->area;
                    $autoPostJobPackage->daily = $request->daily;
                    $autoPostJobPackage->hour = $request->hour;
                    $autoPostJobPackage->auto_in_hour = $request->auto_in_hour;
                    $autoPostJobPackage->job_package_id = $id;
                    $autoPostJobPackage->save();
                } else {
                    if ($request->area) {
                        AutoPostJobPackage::create([
                            'area' => $request->area,
                            'daily' => $request->daily,
                            'auto_in_hour' => $request->auto_in_hour,
                            'job_package_id' => $id,
                        ]);
                    }
                }
            }

            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error('Error in update method: ' . $e->getMessage());
            return redirect()->back()->with('error', __('sys.update_item_error'));
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = request()->admintaxonomy;
            $type = $request->type;
            $this->model::deleteItem($id, $type);
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            $type = $request->type;
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            $type = $request->type;
            Log::error('Error in destroy method: ' . $e->getMessage());
            return redirect()->route($this->route_prefix . 'index', ['type' => $type])->with('error', __('sys.destroy_item_error'));
        }
    }
}