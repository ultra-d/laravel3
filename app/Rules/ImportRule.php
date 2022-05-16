<?php

namespace App\Rules;

use App\Contracts\ProductImportRuleContract;
use Illuminate\Validation\Rule;

class ImportRule implements ProductImportRuleContract
{
    public static function toArray(): array
    {
        return [
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'code' => ['required', 'size:10', Rule::unique('products', 'code')],
            'title' => ['required', 'string', 'max:100', Rule::unique('products', 'title')],
            'description' => ['required', 'string', 'min:10', 'max:250'],
            'slug' => ['required', 'min:6', 'max:100', Rule::unique('products', 'slug')],
            'price' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }
}
