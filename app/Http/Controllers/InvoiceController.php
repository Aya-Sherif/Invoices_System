<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Client;
use App\Models\invoice;
use App\Models\InvoiceItems;
use App\Models\Product;
use App\Models\ProductSize;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = $this->getAllClients();
        if ($this->getUserRole() == 'sales') {
            return $this->redirectToCreateInvoice();
        } elseif ($this->getUserRole() == 'stock') {

            $invoices = $this->getApprovedInvoicesForStock();
            return view('admin.invoice.index', compact('invoices', 'clients'));
        }
        $invoices = $this->getFilteredInvoices($request); // Apply filter

        return view('admin.invoice.index', compact('invoices', 'clients'));
    }

    // Redirect the sales user to the invoice creation page
    private function redirectToCreateInvoice()
    {
        return redirect(route('invoice.create'));
    }

    // Get only approved invoices for the stock role
    private function getApprovedInvoicesForStock()
    {
        $invoices = Invoice::where('status', 'approved')->get();
        return $invoices;
    }

    // Get all clients
    private function getAllClients()
    {
        return Client::all();
    }

    // Get invoices and apply filters for date, status, and clients
    private function getFilteredInvoices($request)
    {
        $query = Invoice::query();
        $flag = false;
        // Filter by date range
        if ($request->has('filter_date') && $request->filter_date) {
            $query->where('invoice_date', $request->filter_date);
            $flag = true;
        }
        // Filter by status
        if ($request->has('filter_status') && $request->filter_status) {
            $query->where('status', $request->filter_status);
            $flag = true;
        }

        // Filter by client
        if ($request->has('filter_client') && $request->filter_client) {
            $query->where('client_id', $request->filter_client);
            $flag = true;
        }
        // dd($query->orderByRaw("FIELD(status, 'shipped') ASC")->get());
        if ($flag == false) {

            return  Invoice::orderBy('invoice_date', 'desc') // Order by date in descending order (most recent first)
                ->orderByRaw("FIELD(status, 'draft', 'approved', 'shipped') ASC") // Order by status in the desired sequence
                ->get();
        }
        // Ensure 'shipped' invoices are always at the end
        return $query->orderBy('invoice_date', 'desc') // Order by date in descending order (most recent first)
            ->orderByRaw("FIELD(status, 'draft', 'approved', 'shipped') ASC") // Order by status in the desired sequence
            ->get();
    }


    private function getUserRole()
    {
        return Auth::user()->role;
    }


    public function stockDisplay(string $id)
    {
        $invoice = $this->getInvoice($id);
        $items = $this->processExistanceItems($id);
        if ($invoice->status == 'shipped' || $invoice->status == 'approved') {
            // dd($invoice->status);
            $Flag = false;
            return view('admin.invoice.show', compact('invoice', 'items', 'Flag'));
        } else {
            return view('admin.invoice.show', compact('invoice', 'items'));
        }
    }
    public function changeStateToShipped(string $id)
    {
        // Retrieve a single invoice based on the invoice_identifier
        $invoice = Invoice::where('invoice_identifier', $id)->firstOrFail();

        // Update the status of the invoice
        $invoice->status = 'shipped';

        // Save the changes
        $invoice->save();
        return redirect(route('invoice.index'))->with('success', 'لقد تم صرف الفاتوره بنجاح');
    }
    public function changeStateToApproved(string $id)
    {
        // Retrieve a single invoice based on the invoice_identifier
        $invoice = Invoice::where('invoice_identifier', $id)->firstOrFail();

        // Update the status of the invoice
        $invoice->status = 'approved';

        // Save the changes
        $invoice->save();
        return redirect(route('invoice.index'))->with('success', 'لقد تم صرف الفاتوره بنجاح');
    }


    private function getNextInvoiceIdentifier()
    {
        $lastInvoice = Invoice::orderBy('invoice_identifier', 'desc')->first();
        return $lastInvoice ? $lastInvoice->invoice_identifier + 1 : 1000;
    }
    /**
     * Show the data of the invoice before creating it.
     */
    public function display(InvoiceRequest $request)
    {
        if ($request->id) {
            $invoice = $this->getInvoice($request->id);
            $items = $this->processItems($request);
            $invoice = $this->updateInvoiceDetails($invoice, $request, $items);

            return view('admin.invoice.show', compact('invoice', 'items'));
        } else {
            $items = $this->processItems($request);
            $newinvoice = $this->prepareNewInvoiceData($request);
            // Set the totals after processing items
            $newinvoice['total_before_discount'] = array_sum(
                array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, $items)
            );
            $newinvoice['total_after_discount'] = array_sum(array_column($items, 'price_after_discount'));

            // dd($newinvoice);
            return view('admin.invoice.show', compact('newinvoice', 'items'));
        }
    }

    private function getInvoice($id)
    {
        return Invoice::findOrFail($id);
    }

    private function updateInvoiceDetails($invoice, $request, $items)
    {
        if ($request->input('العميل') != $invoice->client_id) {
            $invoice->client_id = $request->input('العميل');
        }
        $invoice->total_before_discount =  array_sum(
            array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $items)
        );
        $invoice->total_after_discount = array_sum(array_column($items, 'price_after_discount'));
        $invoice->save();

        return $invoice;
    }

    private function processItems($request)
    {
        $totalBefore = 0;
        $totalAfter = 0;
        $items = [];

        foreach ($request->input('المقاس') as $index => $itemId) {
            $item = ProductSize::find($itemId);

            if ($item) {
                // dd($item);
                $quantity = $request->input('الكميه')[$index];
                $price = $item->price;
                $discount = $item->discount_percentage;

                $priceBeforeDiscount = $price * $quantity;
                $priceAfterDiscount = $priceBeforeDiscount - ($priceBeforeDiscount * ($discount / 100));

                $totalBefore += $priceBeforeDiscount;
                $totalAfter += $priceAfterDiscount;

                $items[] = [
                    'id' => $itemId,
                    'name' => $item->product->name,
                    'product_id' => $item->product->id,
                    'size' => $item->size,
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount' => $discount,
                    'price_after_discount' => $priceAfterDiscount,
                ];
            }
        }

        return $items;
    }
    public function processExistanceItems($id)
    {
        $items = [];
        $existancItems = InvoiceItems::where('invoice_id', $id)->get();
        foreach ($existancItems as $index => $item) {
            $product = Product::findOrFail($item->product->product_id);
            $price_after_discount = $item->price - $item->price * ($item->discount) / 100;
            // dd($item);
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

    private function prepareNewInvoiceData($request)
    {
        return [
            'client' => Client::findOrFail($request->input('العميل'))->name,
            'total_before_discount' => 0, // Total will be set later
            'total_after_discount' => 0, // Total will be set later
            'date' => Carbon::now('Africa/Cairo')->format('d/m/Y'),
            'invoice_identifier' => $this->getNextInvoiceIdentifier()
        ];
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $items = ProductSize::where('quantity', '!=', 0)->get();
        $clients = $this->getAllClients();
        $products = Product::whereHas('productSizes')->get();
        return view('admin.invoice.add', compact('items', 'clients', 'products'));
    }
    // Function to get the next invoice_identifier

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $client = $this->findClientByName($request->input('client'));

        if (!$client) {
            return redirect()->back()->withErrors(['client' => 'Client not found'])->withInput();
        }

        $invoiceData = $this->prepareInvoiceData($request, $client->id);

        DB::beginTransaction();
        try {
            $invoice = Invoice::create($invoiceData);
            $this->createInvoiceItems($request->input('items'), $invoice->id);

            DB::commit();
            return redirect(route('payments.create',$invoice->id))->with('Success', 'لقد تم إرساله الفاتوره بنجاح الى المخزن');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()])->withInput();
        }
    }

    private function findClientByName($clientName)
    {
        return Client::where('name', $clientName)->first();
    }


    private function createInvoiceItems(array $items, $invoiceId)
    {
        foreach ($items as $item) {
            $product = Product::where('name', $item['name'])->first();
            if (!$product) {
                throw new \Exception('Product not found for item name: ' . $item['name']);
            }

            InvoiceItems::create([
                'invoice_id' => $invoiceId,
                'product_size_id' => $item['id'],
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'total' => $item['price_after_discount'] * $item['quantity'],
            ]);
            $productDetails = ProductSize::findOrFail($item['id']);
            $productDetails->quantity = $productDetails->quantity - $item['quantity'];
            $productDetails->save();  // Save the changes

        }
    }


    private function prepareInvoiceData(Request $request, $clientId)
    {
        $role = $this->getUserRole();

        if ($role === 'admin' || $role === 'accounts') {
            return $this->prepareAdminInvoiceData($request, $clientId);
        } elseif ($role === 'sales') {
            return $this->prepareSalesInvoiceData($request, $clientId);
        } else {
            // Handle unexpected roles or return an error
            abort(403, 'Unauthorized role.');
        }
    }

    private function prepareAdminInvoiceData(Request $request, $clientId)
    {
        return [
            'client_id' => $clientId,
            'total_before_discount' => $request->input('total_before_discount'),
            'total_after_discount' => $request->input('total_after_discount'),
            'invoice_date' => Carbon::now('Africa/Cairo'),
            'status' => 'approved',
            'invoice_identifier' => $request->input('invoice_identifier'),
        ];
    }

    private function prepareSalesInvoiceData(Request $request, $clientId)
    {
        return [
            'client_id' => $clientId,
            'total_before_discount' => $request->input('total_before_discount'),
            'total_after_discount' => $request->input('total_after_discount'),
            'invoice_date' => Carbon::now('Africa/Cairo'),
            'status' => 'draft',
            'invoice_identifier' => $request->input('invoice_identifier'),
        ];
    }


    /**
     * Display the specified resource.
     */
    public function show(invoice $invoices)
    {
        //
        // dd($invoices);
    }



    public function edit(Request $request, string $id)
    {
        if ($this->getUserRole() == 'stock') {
            abort(403, 'Unauthorized action.'); // Forbidden access
        }

        // Determine if the ID is for a new invoice or an existing one
        if ($id == 0) {
            // Prepare data for a new invoice
            $data = $this->prepareEditDataForNewInvoice($request);
        } else {
            // Prepare data for an existing invoice
            $data = $this->prepareEditDataForExistingInvoice($id);
        }

        // Return the view with the prepared data
        return view('admin.invoice.edit', $data);
    }


    private function prepareEditDataForNewInvoice(Request $request)
    {
        $totalItems = ProductSize::where('quantity', '!=', 0)->get();
        $clients = $this->getAllClients();
        $products = Product::all();
        $clientname = $request->client;
        $items = $this->formatItems($request->input('items'));

        return compact('clientname', 'items', 'totalItems', 'clients', 'products');
    }

    private function prepareEditDataForExistingInvoice(string $id)
    {
        $products = Product::all();
        $totalitems = ProductSize::where('quantity', '!=', 0)->get();
        $clients =  $this->getAllClients();
        $invoice = Invoice::findOrFail($id);
        $items = InvoiceItems::where('invoice_id', $id)->get();
        // foreach($items as $item){
        //     dd($item->product->product_id);


        // };
        return  compact('invoice', 'totalitems', 'clients', 'items', 'products');
    }

    private function formatItems(array $items)
    {
        return array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'product_id' => $item['product_id'],
                'size' => $item['size'],
            ];
        }, $items);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        // dd($request);
        $invoiceData = $this->prepareInvoiceDataForUpdat($request, $invoice);
        $invoice->update($invoiceData);

        $this->updateInvoiceItems($request->input('items'), $id);

        return redirect(route('payments.create', $invoice->id));
    }

    private function prepareInvoiceDataForUpdat(Request $request, Invoice $invoice)
    {
        return [
            'client_id' => $request->input('client'),
            'total_before_discount' => $request->input('total_before_discount'),
            'total_after_discount' => $request->input('total_after_discount'),
            'invoice_date' => $invoice->invoice_date,
            'status' => 'approved',
            'invoice_identifier' => $invoice->invoice_identifier,
        ];
    }


    private function updateInvoiceItems(array $items, string $invoiceId)
    {

        $oldItems = InvoiceItems::where('invoice_id', $invoiceId)->get();

        foreach ($oldItems as $item) {
            // Retrieve the ProductSize model based on product_size_id
            $productDetails = ProductSize::where('id', $item->product_size_id)->first();

            if ($productDetails) {
                // Update the quantity
                $productDetails->quantity = $productDetails->quantity + $item['quantity'];
                $productDetails->save();  // Save the changes
            }
        }
        $oldItems = InvoiceItems::where('invoice_id', $invoiceId)->delete();

        foreach ($items as $item) {
            InvoiceItems::create([
                'invoice_id' => $invoiceId,
                'product_size_id' => $item['id'],
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'price_after_discount' => $item['price_after_discount'],
                'total' => $item['price_after_discount'] * $item['quantity'],
            ]);
            $productDetails = ProductSize::findOrFail($item['id']);
            $productDetails->quantity = $productDetails->quantity - $item['quantity'];
            $productDetails->save();  // Save the changes
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoice $invoices)
    {
        //
    }
}
