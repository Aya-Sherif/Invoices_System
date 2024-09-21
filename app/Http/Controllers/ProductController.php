<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request);

        return redirect(route('productdetails.index'))->with('success', 'لقد تم اضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product =
            $this->productService->getProductDetailsById($id);
        $product1=
            $this->productService->getProductById($product->product_id);

        return view('admin.product.show', compact('product','product1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductById($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $this->productService->updateProduct($id, $request);

        return redirect()->route('productdetails.index')->with('success', 'تم تحديث المنتج بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implement destroy logic if needed
    }

    /**
     * Fetch sizes for a product.
     */
    public function fetchSizes(Request $request)
    {
        $productId = $request->query('product_id');
        $sizes = $this->productService->getSizesByProductId($productId);
        return response()->json($sizes);
    }


}
