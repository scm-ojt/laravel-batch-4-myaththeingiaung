<?php

namespace App\Http\Controllers;

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
