<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Payment;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    /**
     * Constructor to inject the ClientService dependency.
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the clients.
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.client.add');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(ClientRequest $request)
    {
        // Prepare client data using the ClientService
        $clientData = $this->clientService->prepareClientData($request);

        // Create the client
        Client::create($clientData);

        return redirect()->route('client.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified client.
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

    // Fetch all payments associated with this client
    $payments = Payment::where('client_id', $id)->get();

    // Pass the client and payments data to the view
    return view('admin.client.show', compact('client', 'payments'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        // Prepare the data for update using the ClientService
        $clientData = $this->clientService->prepareClientData($request);

        // Update the client
        $client->update($clientData);

        return redirect()->route('admin.client.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.client.index')->with('success', 'Client deleted successfully.');
    }
}
