<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:products,name,'.$this->route('products')],
            'slug' => ['unique:products,slug,'.$this->route('products')],
            'image' => ['required'],
            'category_id' => ['required', 'not_in:0'],
            'brand_id' => ['required', 'not_in:0'],
            'content' => ['required', 'min:3'],
            'price' => ['required'],
        ];
    }
}
