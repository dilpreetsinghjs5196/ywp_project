<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('site.com.home');
    }

    public function about()
    {
        return view('site.com.about');
    }
}
