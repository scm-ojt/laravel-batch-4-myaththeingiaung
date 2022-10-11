<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    { 
        $productsData = Product::with('categories')->select('user_id','title','description','price')
                        ->orderBy('user_id','desc')->get();

        foreach($productsData as $key => $product){
            $userName = User::select('name')->where('id',$product->user_id)->first();
            $productsData[$key]->user_id = $userName->name;
        }
        
        return $productsData;
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
}
