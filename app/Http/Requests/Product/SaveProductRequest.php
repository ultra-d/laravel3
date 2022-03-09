<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'code' => ['required', 'size:10', Rule::unique('products', 'code')->ignore($this->product)],
            'title' => ['required', 'string', 'max:100', Rule::unique('products', 'title')->ignore($this->product)],
            'description' => ['required', 'string', 'min:10', 'max:250'],
            'slug' => ['required', 'min:6', 'max:100', Rule::unique('products', 'slug')->ignore($this->product)],
            'images' => ['required', 'array'],
            'images.*' => [
                $this->route('product') ? '' : 'required',
                'image',
                'max:200',
                /* Rule::dimensions()->maxWidth(500)->maxHeight(250)->ratio(2/1) */
                ],
            'price' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El producto necesita un titulo.',
            'description.required' => 'El producto necesita una descripcion.',
            'slug.required' => 'El producto necesita una url.',

        ];
    }
}
