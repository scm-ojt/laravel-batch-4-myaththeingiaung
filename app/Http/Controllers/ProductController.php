<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Http\Requests\ProductImportRequest;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('product.create',compact('categories'));
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

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $categories = Category::all();
        
        return view('product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
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
        
        return redirect()->route('product.index');
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
        if($product){
            $product->categories()->detach();
            $product->delete();
        }

        return redirect()->back();
    }

    /**
     * Excel export for Product
     */
    public function export() 
    {
        $time = 1;
        return Excel::download(new ProductsExport() , 'product'.$time.'.xlsx');
    }

    public function import(ProductImportRequest $request) 
    {
        Excel::import(new ProductsImport, $request['file']);
        
        return redirect('/')->with('success', 'All good!');
    }
}
