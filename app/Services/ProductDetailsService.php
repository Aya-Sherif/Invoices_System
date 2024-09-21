<?php

namespace App\Services;

use App\Http\Requests\ProductDetailsRequest;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductDetailsService
{
    public function createProductSize(ProductDetailsRequest $request)
    {
        ProductSize::create([
            'product_id' => $request->input('اسم_المنتج'),
            'size' => $request->input('المقاس'),
            'price' => $request->input('السعر'),
            'discount_percentage' => $request->input('نسبة_الخصم'),
            'quantity' => $request->input('الكميه'),
        ]);
    }

    public function updateProductSize(ProductDetailsRequest $request, string $id)
    {
        $productSize = ProductSize::findOrFail($id);
        $productSize->update([
            'size' => $request->input('المقاس'),
            'price' => $request->input('السعر'),
            'discount_percentage' => $request->input('نسبة_الخصم'),
            'quantity' => $request->input('الكميه'),
        ]);
    }
   

    public function updateProductQuantity(string $id, Request $request)
    {
        $productSize = ProductSize::findOrFail($id);
        $productSize->update([
            'price' => $request->input('السعر'),
            'discount_percentage' => $request->input('نسبة_الخصم'),
            'quantity' => $request->input('الكميه') + $productSize->quantity,
        ]);
    }

    public function getProductSizes($id)
    {
        return ProductSize::where('product_id', $id)->pluck('size', 'id');
    }
}
