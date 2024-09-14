<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function houseCondo(Request $request)
    {
        return view('house_condo');
    }
}