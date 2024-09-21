<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductDetailsRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $productId = $request->input('id'); // Using the product ID from the request
        $productSizeId = $this->route('productdetail') ?? $this->route('id'); // Get the current product size ID from the route

        // dd($productSizeId);
        return [
            'المقاس' => [
                'required',
                Rule::unique('product_sizes', 'size')
                    ->where(function ($query) use ($productId) {
                        return $query->where('product_id', $productId); // Ensure it's unique for this product
                    })
                    ->ignore($productSizeId), // Ignore the current product size ID being updated
            ],
            'السعر' => ['required', 'numeric', 'min:0'],
            'نسبة_الخصم' => ['required', 'numeric', 'between:0,100'],
            'الكميه' => ['required', 'integer', 'min:0'],
        ];
    }
}
