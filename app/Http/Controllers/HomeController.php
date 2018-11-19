<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        return view('admin.index');
    }
    */

    public function invoice()
    {
        return view('site.index');
    }
    public function redirect()
    {
        Session::flush();
        return redirect('login');
    }
}
