<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $productId = $this->route('product'); // Route parameter for product ID
        return [
            'الاسم' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('products', 'name')->ignore($productId)
            ],
            'الصوره' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
        ];
    }
}
