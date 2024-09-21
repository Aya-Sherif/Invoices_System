<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductDetailsRequest;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\ProductDetailsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSizeController extends Controller
{
    protected $productDetailsService;

    public function __construct(ProductDetailsService $productDetailsService)
    {
        $this->productDetailsService = $productDetailsService;
    }

    private function getUserRole()
    {
        return Auth::user()->role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productsNames = Product::all();
        $products = $this->getFilteredProducts($request); // Apply filter

        return view('admin.product-details.index', compact('products', 'productsNames'));
    }

    // Get filtered products based on product name and size
    private function getFilteredProducts($request)
    {
        $query = ProductSize::query();
        $flag = false;
        // Filter by product name
        if ($request->has('product') && $request->product) {
            $query->where('product_id', $request->product);
            $flag = true;
        }

        // Filter by size
        if ($request->has('size') && $request->size) {
            $query->where('id', $request->size);
            $flag = true;
        }

        // If no filters are applied, return all products
        if ($flag == false) {
            return ProductSize::all();
        }

        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->getUserRole() != 'admin'&&$this->getUserRole() != 'accounts') {
            abort(403, 'Unauthorized action.');
        }
        $products = Product::all();
        return view('admin.product-details.add', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductDetailsRequest $request)
    {
        if ($this->getUserRole() != 'admin'&&$this->getUserRole() != 'accounts') {
            abort(403, 'Unauthorized action.');
        }
        $this->productDetailsService->createProductSize($request);
        return redirect()->route('productdetails.index')->with('success', 'تم إضافة المقاس بنجاح!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($this->getUserRole() != 'admin'&&$this->getUserRole() != 'accounts') {
            abort(403, 'Unauthorized action.');
        }
        $product = ProductSize::findOrFail($id);
        return view('admin.product-details.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductDetailsRequest $request, string $id)
    {
        if ($this->getUserRole() != 'admin'&&$this->getUserRole() != 'accounts') {
            abort(403, 'Unauthorized action.');
        }
        $this->productDetailsService->updateProductSize($request, $id);
        return redirect()->route('productdetails.index')->with('success', 'تم تعديل المقاس بنجاح');
    }

    /**
     * Show the form for editing quantity.
     */
    public function editQuantity(string $id)
    {
        if ($this->getUserRole() != 'admin'&&$this->getUserRole() != 'accounts') {
            abort(403, 'Unauthorized action.');
        }
        $product = ProductSize::findOrFail($id);
        return view('admin.product-details.editquantity', compact('product'));
    }

    /**
     * Update quantity of the specified resource.
     */
    public function updateQuantity(string $id, Request $request)
    {
        if ($this->getUserRole() != 'admin'&&$this->getUserRole() != 'accounts') {
            abort(403, 'Unauthorized action.');
        }
        $this->productDetailsService->updateProductQuantity($id, $request);
        return redirect()->route('productdetails.index')->with('success', 'تم إضافة الكميه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implement if needed
    }
}
