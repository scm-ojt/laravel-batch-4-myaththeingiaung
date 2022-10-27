<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
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
        $users = User::count();
        $products = Product::count();
        $categories = Category::count();
        $images = Image::count();
        return view('admin.dashboard.dashboard',compact('users','products','categories','images'));
    }
}
