<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductImportRequest;
use App\Mail\ProductDeleteMail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request['title']!= null){
            $products = Product::where('title','LIKE','%'.$request->title.'%')->paginate(5);               
        }else{
            $products = Product::orderBy('id','desc')->paginate(5);
        }
        $i = ($request->input('page', 1) - 1) * 5;

        return view('product.index',compact('products','i'));
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
        
        return view('product.show',compact('product'));
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
            $product->categories()->detach();
            $product->delete();
        }

        Mail::to($email)->send(new ProductDeleteMail($product));
        return redirect()->route('admin.product.index');
    }

    /**
     * Excel export for Product
     */
    public function export(Product $product) 
    {
        $time = 1;
        return Excel::download(new ProductsExport($product) , 'product'.$time.'.xlsx');
    }

    public function import(ProductImportRequest $request) 
    {
        Excel::import(new ProductsImport, $request['file']);
        
        return redirect('/')->with('success', 'All good!');
    }
}
