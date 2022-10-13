<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'price' => 'required|regex:/^\d*/',
            // 'image' => 'required|mimes:jpeg,jpg',
            'category-names' => 'required',
            'description' => 'required',
        ];
    }
}