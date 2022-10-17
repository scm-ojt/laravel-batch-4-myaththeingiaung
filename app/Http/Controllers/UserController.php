<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request['name']!= null){
            $users = User::where('name','LIKE','%'.$request->name.'%')->paginate(5);               
        }else{
            $users = User::orderBy('id','desc')->paginate(5);
        }
        $i = ($request->input('page', 1) - 1) * 5;
        
        return view('profile.index',compact('users','i'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect()->route('admin.profile.index')->withSuccess('You have signed-in');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('profile.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();

        if(auth()->guard('admin')->user())
        {
            return view('profile.edit',compact('user'));           
        }elseif(auth()->user()->id != null){
            if($user->id != auth()->user()->id){
                abort(404);
            }
            abort(404); 
        }

        return view('profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->first();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->password = $request['password'];
        $user->update();
        
        return redirect()->route('admin.profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(auth()->guard('admin')->user()){
            $user->delete();
            return redirect()->route('admin.profile.index');
        }elseif($id == Auth::user()->id){
            $user->delete();
        }
        Toastr::success('Account Delete Successfully!','SUCCESS');
        return redirect()->route('home');
    }
}
