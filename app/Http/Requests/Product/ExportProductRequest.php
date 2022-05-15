<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ExportProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dateFrom' => 'required|date|date_format:Y-m-d|after_or_equal:01-01-2022',
            'dateTo' => 'required|date|date_format:Y-m-d|after:dateFrom|before:tomorrow',
            'status' => 'required',
        ];
    }
}
