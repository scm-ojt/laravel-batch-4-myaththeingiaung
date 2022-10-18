<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index(){
        return view('admin.dashboard');
    }
}
