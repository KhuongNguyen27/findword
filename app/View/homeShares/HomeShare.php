<?php
 
namespace App\View\homeShares;
 
use App\Models\Career;
use App\Models\Country;
use App\Models\Wage;
use App\Models\JobPackage;
use App\Models\Level;
use App\Models\FormWork;
use App\Models\Rank;
use App\Models\Province;
use Illuminate\View\View;

class HomeShare
{
    /**
     * Create a new profile composer.
     */
    public function __construct() {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
		$degrees = Level::where('status', Level::ACTIVE)->orderBy('position')->get();
		$formworks = FormWork::where('status', FormWork::ACTIVE)->orderBy('position')->get();
		$job_categories = Career::where('status', 1)->orderBy('position')->get()->chunk(9);
		$careers = Career::where('status', 1)->orderBy('position')->get();
        $job_packages = JobPackage::whereIn('slug', ['tin-gap', 'tin-hot'])->get();
		$countries = Country::all();
		$ranks = Rank::where('status', 1)->orderBy('position')->get();

		$wages = Wage::where('status', 1)->orderBy('position')->get();
        $normal_provinces = Province::whereNotIn('name', [1, 50, 32])->orderBy('name')->get();
        $provinces = Province::whereIn('id', [1, 50, 32])
        ->orderByRaw("FIELD(id,1,50,32)")
        ->get()->concat($normal_provinces);
        $newWages = [];
		foreach ($wages as $wage) {
			$newWages[$wage->salaryMin . '-' . $wage->salaryMax] = $wage->name;
		}
        $view->with('degrees', $degrees);
        $view->with('formworks', $formworks);
        $view->with('job_categories', $job_categories);
        $view->with('careers', $careers);
        $view->with('job_packages', $job_packages);
        $view->with('countries', $countries);
        $view->with('wages', $newWages);
        $view->with('ranks', $ranks);
        $view->with('provinces', $provinces);
    }
}