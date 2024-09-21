<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $products=Product::whereHas('productSizes')->get();
        $productDetails=ProductSize::all();
        return view('front.index',compact('products','productDetails'));
    }
}
