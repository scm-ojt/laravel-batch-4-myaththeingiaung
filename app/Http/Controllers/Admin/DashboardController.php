<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    /**
     * To show admin dashboard
     *
     * @return View admin dashboard page
     */
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }
}
