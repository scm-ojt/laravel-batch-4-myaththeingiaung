<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id = User::find($row[0]);
        info($id);
        $product = new Product([
            'user_id' => $id,
            'title' => $row[1],
            'description' => $row[2],
            'price' => $row[3],
        ]);

        $product->save();
    }
}
