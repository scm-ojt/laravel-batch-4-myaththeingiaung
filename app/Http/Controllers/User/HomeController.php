<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * To show Product Information
     *
     * @return View home page
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(6);
        $users = User::all();
        return view('home',compact('products','users'));
    }

}
