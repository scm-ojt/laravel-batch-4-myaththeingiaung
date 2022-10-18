<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AdminRequest $request)
    {
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $admin = auth()->guard('admin')->user();
            if($admin->id){
                return redirect()->route('admin.dashboard')->with('success','You are Logged in sucessfully.');
            }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }

    public function logout(){
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('home'));
    }
}
