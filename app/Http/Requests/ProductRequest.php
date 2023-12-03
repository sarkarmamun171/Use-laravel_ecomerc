<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category'=>'required',
            'subcategory'=>'required',
            'product_name'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'tags'=>'required',
            'long_description'=>'required',
            'add_info'=>'required',
            'pre_image'=>'required|image',
            'gallery_img'=>'required|image',
        ];
    }
}
