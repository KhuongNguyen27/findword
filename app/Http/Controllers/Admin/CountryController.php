<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Country::orderBy('name', 'ASC');
    
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $items = $query->paginate(25)->withQueryString();
    
        return view('admin.countries.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        try {
            Country::create($request->all());

            return redirect()->route('countries.index')
                ->with('success', 'Country created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating country: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error creating country. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->update($request->all());

            return redirect()->route('countries.index')
                ->with('success', 'Country updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating country: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error updating country. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();

            return redirect()->route('countries.index')
                ->with('success', 'Country deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting country: ' . $e->getMessage());

            return redirect()->route('countries.index')
                ->with('error', 'Error deleting country. Please try again later.');
        }
    }
}
