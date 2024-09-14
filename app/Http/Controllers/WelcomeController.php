<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function houseCondo(Request $request)
    {

        if ($request->all()) {
            dd($request->all());
        }
        return view('house_condo');
    }
}