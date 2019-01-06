<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function home()
    {
        $sites = Site::all();
        return view('admin.dashboard', ['sites' => $sites]);
    }
}
