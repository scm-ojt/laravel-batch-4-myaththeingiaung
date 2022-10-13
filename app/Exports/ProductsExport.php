<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements WithHeadings,FromCollection,WithMapping
{
    use Exportable;

    // a place to store the team dependency
    private $product;

    // use constructor to handle dependency injection
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    // set the collection of product to export
    public function collection()
    {
        return $this->product;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($product): array
    {
        return [
            $product->user->name,
            $product->title,
            $product->description,
            $product->price,
            $product->categories
        ];
    }


    public function headings(): array
    {
        return[
            'Username',
            'Title',
            'Description',
            'Price',
            'Category Name'
        ];
    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */

    // public function collection()
    // { 
    //     $productsData = Product::with('categories')->select('user_id','title','description','price','category_id')
    //                     ->orderBy('user_id','desc')->get();

    //     foreach($productsData as $key => $product){
    //         $userName = User::select('name')->where('id',$product->user_id)->first();
    //         $productsData[$key]->user_id = $userName->name;
    //     }

    //     // $productsData = DB::table('users')
    //     //     ->join('products', 'porducts.user_id', '=', 'users.id')
    //     //     ->join('category_product', 'category_product.porduct_id', '=', 'products.product_id')
    //     //     ->join('category_product', 'category_product.category_id', '=', 'categories.product_id')
    //     //     ->select('users.name', 'products.*', 'categories.name')
    //     //     ->get();
        
    //     return $productsData;
    // }
}
