<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrenyController extends Controller
{
    public function change(Request $request)
    {
        $selectedCurrency = $request->input('currency');
        // Implement your currency conversion logic here
    
        // Pass the selected currency to the view
        return view('layouts.frontend')->with('selectedCurrency', $selectedCurrency);
    }
    
}
