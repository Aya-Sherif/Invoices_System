<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductService
{
    /**
     * Create a new product.
     */
    public function createProduct(ProductRequest $request)
    {
        $productData = $this->prepareProductData($request);
        Product::create($productData);
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(string $id, ProductRequest $request)
    {
        $product = Product::findOrFail($id);
        $data = $this->prepareProductUpdateData($request);
        $product->update($data);
    }

    /**
     * Get a product by its ID.
     */
    public function getProductById(string $id)
    {
        return Product::findOrFail($id);
    }
    /**
     * Get a product Details by its ID.
     */
    public function getProductDetailsById(string $id)
    {
        return ProductSize::findOrFail($id);
    }

    /**
     * Get sizes for a specific product.
     */
    public function getSizesByProductId(int $productId)
    {
        return ProductSize::where('product_id', $productId)
            ->whereNotNull('quantity') // Ensure quantity is not null
            ->where('quantity', '!=', 0) // Check that quantity is not equal to zero
            ->get(['id', 'size']);
    }

    /**
     * Prepare product data for creation, including the image handling.
     */
    private function prepareProductData(ProductRequest $request)
    {
        $validatedData = $request->validated();

        // Handle the image upload
        if ($request->hasFile('الصوره')) {
            $imageName = $this->storeImage($request->file('الصوره'));
            $validatedData['الصوره'] = $imageName;
        }

        return $this->mapProductData($validatedData);
    }

    /**
     * Prepare product data for updating.
     */
    private function prepareProductUpdateData(ProductRequest $request)
    {
        $validatedData = $this->validateProductName($request);

        // Handle the image upload if present
        // if ($request->hasFile('الصوره')) {
        //     $imageName = $this->storeImage($request->file('الصوره'));
        //     $validatedData['الصوره'] = $imageName;
        // }

        return $this->mapProductData($validatedData);
    }

    /**
     * Store the uploaded image, give it a unique name, and move it to the public directory.
     */
    private function storeImage($image)
    {
        $uniqueImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $uniqueImageName);
        return $uniqueImageName;
    }

    /**
     * Map validated data to the format needed for product creation/updating.
     */
    private function mapProductData(array $validatedData)
    {
        return [
            'name' => $validatedData['الاسم'],
            'image' => $validatedData['الصوره'] ?? null, // Handle image key if present
        ];
    }

    /**
     * Validate the product name.
     */
    private function validateProductName(ProductRequest $request)
    {
        return $request->validate([
            'الاسم' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('products', 'name')->ignore($request->route('id'))
            ],
        ]);
    }
}
