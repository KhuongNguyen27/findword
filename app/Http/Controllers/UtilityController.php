<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function grossToNet()
    {
        return view('website.utilities.gross-to-net');
    }

    public function personalTax()
    {
        return view('website.utilities.personal-tax');
    }

    public function unemploymentInsurance()
    {
        return view('website.utilities.unemployment-insurance');
    }

    public function socialInsurance()
    {
        return view('website.utilities.social-insurance');
    }

    public function compoundInterest()
    {
        return view('website.utilities.compound-interest');
    }

    public function savingsPlan()
    {
        return view('website.utilities.savings-plan');
    }
}
