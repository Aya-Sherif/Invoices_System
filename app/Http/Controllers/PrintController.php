<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\Product;
use Illuminate\Http\Request;

class PrintController extends Controller
{
        public function prnpriview(string $id)
    {
        $invoice = $this->getInvoice($id);
        $items = $this->processExistanceItems($id);

        return view('admin.invoice.printView', compact('invoice', 'items'));
    }
    private function getInvoice($id)
    {
        return Invoice::findOrFail($id);
    }

    public function processExistanceItems($id)
    {
        $items=[];
        $existancItems = InvoiceItems::where('invoice_id', $id)->get();
        foreach ($existancItems as $index => $item) {
            $product = Product::findOrFail($item->product->product_id);
            $price_after_discount = $item->price - $item->price * ($item->discount) / 100;
            $items[] = [
                'id' => $item->product->id,
                'name' => $product->name,
                'product_id' => $item->product->product_id,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'discount' => $item->discount,
                'price_after_discount' => $price_after_discount

            ];
        }
        return $items;
    }
}
