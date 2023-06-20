<?php

namespace App\Http\Requests;

use App\Rules\ProductStockRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStockRequeest extends FormRequest
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
            'sku' => 'required|min:3|max:50',
            'product_id' => 'required',
            'manage_stock' => 'required|in:0,1',
            'in_stock' => 'required|in:0,1',
            'qty' => (new ProductStockRule($this->manage_stock))
        ];
    }
}
