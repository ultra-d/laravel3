<?php

namespace App\Imports\Admin;

use App\Models\Product;
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
        return new Product([
            'id' => $row[0],
            'title' => $row[1],
            'description' => $row[2],
            'price' => $row[3],
            'category_id' => $row[4],
            'status' => $row[5],
        ]);
    }
}
