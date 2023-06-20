<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPriceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'price' => 'required|numeric|min:0',
            'special_price' => 'nullable|min:0',
            'special_price_type' => 'required_with:special_price|in:fixed, percent',
            'special_price_start' => 'required|date_format:Y-m-d',
            'special_price_end' => 'required|date_format:Y-m-d',
           
         ];
    }
}
