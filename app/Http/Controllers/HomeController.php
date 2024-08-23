<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the dashboard page with the provided request object.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request object containing input data and server environment info.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View  Returns a view instance of the 'dashboard' view with the request object passed as an array.
     */
    public function dashboard(Request $request)
    {
        return view('dashboard', ['request' => $request]);
    }

    /**
     * Display the landing page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View  Returns a view instance of the 'landing' view.
     */
    public function landing()
    {
        return view('landing');
    }
}
