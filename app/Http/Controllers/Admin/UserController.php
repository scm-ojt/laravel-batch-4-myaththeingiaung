<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserCreateRequest;
use App\Models\Image;

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
    public function store(AdminUserCreateRequest $request)
    {

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->password = Hash::make($request['password']);
        $user->save();

        if($request['image']){
            $image = new Image();
            $file = $request['image'];
            // return $file->getClientOriginalName();
            $file_name = uniqid(time()) . '_' . $file;
            $save_path = public_path('img/users');
            $file_path = $save_path."/$file_name";
            // $file->move($save_path, $save_path."/$file_name");

            $image->name = $file_name;
            $image->path = $file_path;

            $user->images()->save($image);
        }

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
        $product = Product::where('user_id',$id);
        if(auth()->guard('admin')->user()){
            $user->delete();
            $product->delete();
            return redirect()->route('admin.profile.index');
        }elseif($id == Auth::user()->id){
            $user->delete();
            $product->delete();
        }
        Toastr::success('Account Delete Successfully!','SUCCESS');
        return redirect()->route('home');
    }

}
