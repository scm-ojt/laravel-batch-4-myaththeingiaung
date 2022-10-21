<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection,WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user = User::where('name',$row['username'])->get();

            $product = new Product();
            $product->user_id = $user->pluck('id')['0'];
            $product->title = $row['title'];
            $product->price = $row['price'];
            $product->description = $row['description'];
            $product->save();

           $myString = $row['category_name'];
           $myArray = explode(',', $myString);

           foreach($myArray as $value){
                $category = Category::where('name',$value)->get();
                $cat_id = $category->pluck('id');
                $product->categories()->attach($cat_id);
            }     
      }
   }

}
