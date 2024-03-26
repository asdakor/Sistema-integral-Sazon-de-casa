<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminview()
    {
        return view('admindashboard');
    }
    public function userview()
    {
        return view('dashboard');
    }

}
