<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function bestsellerReport()
    {
        
        return view('admin.report.bestseller');
    }

    public function bestclientReport()
    {
        
        return view('admin.report.bestclient');
    }
}
