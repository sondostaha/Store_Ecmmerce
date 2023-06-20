<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImagesRequeest extends FormRequest
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
            'document' => 'required|array|min:1',
            'document.*' => 'required|string'
        ];
    }
}
