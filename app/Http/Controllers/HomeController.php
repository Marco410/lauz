<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {

        return view('dashboard', ['request' => $request]);
    }

    public function landing()
    {
        return view('landing');
    }
}
