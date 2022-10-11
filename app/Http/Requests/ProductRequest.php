<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'price' => 'required|regex:/^\d*/',
            'category-names' => 'required',
            'description' => 'required',
        ];
    }
}