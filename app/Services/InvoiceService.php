<?php
namespace App\Services;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceService
{
    public function getInvoices()
    {
        return Invoice::all();
    }

    public function prepareInvoiceDisplayData($request)
    {
        $total_before_discount = 0;
        $total_after_discount = 0;
        $items = [];

        foreach ($request->input('المقاس') as $index => $itemId) {
            $size = ProductSize::find($itemId);
            if ($size) {
                $quantity = $request->input('الكميه')[$index];
                $price = $size->price;
                $discount = $size->discount_percentage;
                $price_before_discount = $price * $quantity;
                $price_after_discount = $price_before_discount - ($price_before_discount * ($discount / 100));
                $total_before_discount += $price_before_discount;
                $total_after_discount += $price_after_discount;

                $items[] = [
                    'id' => $size->id,
                    'name' => $size->product->name,
                    'product_id' => $size->product->id, // Added product_id
                    'size' => $size->size,
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount' => $discount,
                    'price_before_discount' => $price_before_discount,
                    'price_after_discount' => $price_after_discount
                ];
            }
        }

        return [
            'newinvoice' => [
                'client' => Client::findOrFail($request->input('العميل'))->name,
                'total_before_discount' => $total_before_discount,
                'total_after_discount' => $total_after_discount,
                'date' => Carbon::now('Africa/Cairo')->format('d/m/Y'),
                'invoice_identifier' => $this->getNextInvoiceIdentifier()
            ],
            'items' => $items
        ];
    }

    public function storeInvoice(Request $request)
    {
        $client = Client::where('name', $request->input('client'))->first();
        if ($client) {
            $invoice = new Invoice;
            $invoice->client_id = $client->id;
            $invoice->total_before_discount = $request->input('total_before_discount');
            $invoice->total_after_discount = $request->input('total_after_discount');
            $invoice->invoice_date = Carbon::now('Africa/Cairo')->format('d/m/Y');
            $invoice->status = 'approved';
            $invoice->invoice_identifier = $request->input('invoice_identifier');
            $invoice->save();

            foreach ($request->input('items') as $item) {
                $size = ProductSize::findOrFail($item['id']);
                $invoice->items()->create([
                    'product_size_id' => $size->id,
                    'size' => $size->size,
                    'quantity' => $item['quantity'],
                    'price' => $size->price,
                    'price_before_discount' => $item['price_before_discount'],
                    'price_after_discount' => $item['price_after_discount'],
                    'total' => $item['price_after_discount'] * $item['quantity']
                ]);
            }
        }
    }

    public function prepareNewInvoiceItems($request)
    {
        $items = [];
        foreach ($request->input('items') as $index => $item) {
            $items[$index] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'product_id' => $item['product_id'], // Ensure product_id is included
                'size' => $item['size']
            ];
        }

        return $items;
    }

    public function getInvoiceItems($id)
    {
        $invoice = Invoice::findOrFail($id);
        // return $invoice->items;
    }

    public function updateInvoice(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->client_id = $request->input('client');
        $invoice->total_before_discount = $request->input('total_before_discount');
        $invoice->total_after_discount = $request->input('total_after_discount');
        $invoice->status = $request->input('status');
        $invoice->save();

        foreach ($request->input('items') as $item) {
            $invoiceItem = $invoice->items()->where('id', $item['id'])->first();
            $invoiceItem->product_size_id = $item['id'];
            $invoiceItem->size = $item['size'];
            $invoiceItem->quantity = $item['quantity'];
            $invoiceItem->price_before_discount = $item['price_before_discount'];
            $invoiceItem->price_after_discount = $item['price_after_discount'];
            $invoiceItem->total = $item['total'];
            $invoiceItem->save();
        }
    }

    private function getNextInvoiceIdentifier()
    {
        $lastInvoice = Invoice::orderBy('invoice_identifier', 'desc')->first();
        return $lastInvoice ? $lastInvoice->invoice_identifier + 1 : 1000;
    }
}
