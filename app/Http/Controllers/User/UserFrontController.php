<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class UserFrontController extends Controller
{

    /**
     * To show user details information
     *
     * @param  int  $id user id
     * @return View details page
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.profile.show',compact('user'));
    }

    /**
     * To store old value in edit page
     * 
     * @param int $id product id
     * @return View profile edit page
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();

        // if(auth()->guard('admin')->user())
        // {
        //     return view('admin.profile.edit',compact('user'));           
        // }elseif(auth()->user()->id != null){
        //     if($user->id != auth()->user()->id){
        //         abort(404);
        //     }
        //     abort(404); 
        // }

        return view('user.profile.edit',compact('user'));
    }

    /**
     * To update user by id
     * 
     * @param AdminUserUpdateRequest $request request with inputs
     * @param int $id user id
     * @return View profile index
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

        $image = Image::where('imagable_id',$id)->first();
        if(request()->hasFile('image')){
            unlink(public_path('img/users/'.$image->name));
            $file = request()->file('image');
            $file_name = uniqid(time()) . '_' . $file->getClientOriginalName();
            $file_path = 'img/users'."/$file_name";
            $image->name = $file_name;
            $image->path = $file_path;
            $file->move(public_path('img/users'), $file_path);
            $user->images()->save($image); 
        }
        
        return redirect()->route('home');
    }

    /**
     * To delete user by id
     *
     * @param  int  $id user id
     * @return View profile index page 
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $product = Product::where('user_id',$id);
        // if(auth()->guard('admin')->user()){
        //     $user->delete();
        //     $product->delete();
        //     return redirect()->route('admin.profile.index');
        // }elseif($id == Auth::user()->id){
        //     $user->delete();
        //     $product->delete();
        // }
        $user->delete();
        $product->delete();

        Toastr::success('Account Delete Successfully!','SUCCESS');
        
        return redirect()->route('home');
    }

    public function storeImage($user){

    }

}
