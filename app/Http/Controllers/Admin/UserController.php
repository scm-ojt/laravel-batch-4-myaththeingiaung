<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserCreateRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\Image;

class UserController extends Controller
{
    /**
     * To show user list
     * 
     * @param Request $request request with inputs
     * @return Object $user user information and View profile index page
     */
    public function index(Request $request)
    {
        if($request['name']!= null){
            $users = User::where('name','LIKE','%'.$request->name.'%')->paginate(5);               
        }else{
            $users = User::orderBy('id','desc')->paginate(5);
        }
        $i = ($request->input('page', 1) - 1) * 5;
        
        return view('admin.profile.index',compact('users','i','request'));
    }

    /**
     * To show admin user create form
     *
     * @return View profile create page
     */
    public function create()
    {
        return view('admin.profile.create');
    }

    /**
     * To store user information
     * 
     * @param AdminUserCreateRequest $request request with inputs
     * @return View profile index page
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

        $image = new Image();
        $file = $request['image'];
        $file_name = uniqid(time()).'_'.$file;
        $file_path = 'img/users'."/$file_name";
        $image->name = $file_name;
        $image->path = $file_path;
        $file->move(public_path('img/users'), $file_path);
        $user->images()->save($image);
        Toastr::success('User Create Successfully!','SUCCESS');

        return redirect()->route('admin.profile.index')->withSuccess('You have signed-in');
    }

    /**
     * To show user details information
     *
     * @param  int  $id user id
     * @return View details page
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.profile.show',compact('user'));
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

        return view('admin.profile.edit',compact('user'));
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
        Toastr::success('User Update Successfully!','SUCCESS');
        
        return redirect()->route('admin.profile.index');
    }

    /**
     * To delete user by id
     *
     * @param  int  $id user id
     * @return View profile index page 
     */
    public function destroy($id)
    {
        $image = Image::where('imagable_id',$id)->first();
        $user = User::findOrFail($id);
        $product = Product::where('user_id',$id);
        $user->delete();
        $user->images()->delete();   
        unlink(public_path('img/users/'.$image->name));
        $product->delete();

        Toastr::success('Account Delete Successfully!','SUCCESS');
        
        return redirect()->route('admin.profile.index');
    }

}
