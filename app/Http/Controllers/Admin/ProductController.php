<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Mail\ProductDeleteMail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductImportRequest;

class ProductController extends Controller
{
    /**
     * To show product information
     * 
     * @param Request $request request with inputs
     * @return $product product object
     */
    public function index(Request $request)
    {
        if($request['title']!= null){
            $products = Product::join("users", function ($join) {
                $join->on("products.user_id", "=", "users.id");
            })->orwhere('users.name','LIKE','%'.$request->title.'%')
            ->orwhere('products.title','LIKE','%'.$request->title.'%')->paginate(5);               
        }else
        {
            $products = Product::orderBy('id','desc')->paginate(5);
        }
        $i = ($request->input('page', 1) - 1) * 5;

        return view('admin.product.index',compact('products','i','request'));
    }

    /**
     * To show product detail information
     *
     * @param  int  $id product id
     * @return $product Product Object
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        return view('admin.product.show',compact('product'));
    }


    /**
     * To delete product by id
     *
     * @param  int  $id product id
     * @return View index product and sending email to user
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
        Toastr::success('Product Delete Successfully!','SUCCESS');
        
        return redirect()->route('admin.product.index');
    }

    /**
     * To export product information
     * 
     * @param Product $product object
     * @return View index product
     */
    public function export(Product $product) 
    {

        return Excel::download(new ProductsExport($product) , 'product'.uniqid(time()).'.xlsx');
    }

    /**
     * To import product information
     * 
     * @param ProductImportRequest $request request with inputs 
     * @return View index product
     */
    public function import(ProductImportRequest $request) 
    {
        Excel::import(new ProductsImport, $request['file']);
        Toastr::success('CSV Import Successfully!','SUCCESS');
        
        return redirect()->route('admin.product.index')->with('success', 'All good!');
    }
}
