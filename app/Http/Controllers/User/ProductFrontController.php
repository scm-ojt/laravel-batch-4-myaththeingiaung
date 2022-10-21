<?php

namespace App\Http\Controllers\User;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\ProductDeleteMail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductFrontController extends Controller
{

    public function profile()
    {
        return view('user.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('user.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->user_id = auth()->user()->id;
        $product->title = $request['title'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->save();

        foreach($request['category-names'] as $cid){
            $category = Category::find($cid);
            $product->categories()->attach($category);
        }

        $image = new Image();
        $file = request()->file('image');
        $file_name = uniqid(time()) . '_' . $file->getClientOriginalName();
        $file_path = 'img/products'."/$file_name";
        $image->name = $file_name;
        $image->path = $file_path;
        $file->move(public_path('img/products'), $file_path);
        $product->images()->save($image);
        
        Toastr::success('Product Create Successfully!','SUCCESS');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        return view('user.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $product = Product::find($id);
        if (Gate::allows('update-product', $product)) {
            $categories = Category::all();
            return view('user.product.edit',compact('product','categories'));
        }else{
            abort(403);
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id); 
        $product->user_id = auth()->user()->id;
        $product->title = $request['title'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->update();

        $product->categories()->detach();
        foreach($request['category-names'] as $cid){
            $category = Category::find($cid);
            $product->categories()->attach($category);
        }

        $image = Image::where('imagable_id',$id)->first();
        if(request()->hasFile('image')){
            unlink(public_path('img/products/'.$image->name));         
            $file = request()->file('image');
            $file_name = uniqid(time()) . '_' . $file->getClientOriginalName();
            $file_path = 'img/products'."/$file_name";
            $image->name = $file_name;
            $image->path = $file_path;
            $file->move(public_path('img/products'), $file_path);
            $product->images()->save($image);
        }
        Toastr::success('Product Update Successfully!','SUCCESS');

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $email = $product->user->email;
        if($product){
            unlink(public_path('img/products/').$product->images[0]->name);
            $product->categories()->detach();
            $product->images()->delete();  
            $product->delete();
        }

        Mail::to($email)->send(new ProductDeleteMail($product));
        Toastr::success('Product Delete Successfully!','SUCCESS');

        return redirect()->route('home');
    }

}
