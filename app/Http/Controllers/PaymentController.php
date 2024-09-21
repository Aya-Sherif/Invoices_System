<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Display the form to make a payment for an invoice
    public function createPaymentForm(string $invoiceId)
    {
        // dd($invoiceId);
        $invoice = Invoice::findOrFail($invoiceId);
        return view('admin.payments.create', compact('invoice'));
    }

    // Handle payment submission for a specific invoice
    public function processPayment(Request $request, string $invoiceId)
    {
        // Validate the payment input
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // Find the invoice
        $invoice = Invoice::findOrFail($invoiceId);
        $amountPaid = $request->input('amount_paid');

        // Update the paid amount in the invoice
        $invoice->paid += $amountPaid;
        $invoice->save(); // Save the updated invoice

        // Calculate remaining balance
        $remainingBalance = $invoice->total_after_discount - $invoice->paid;

        // Update the client's balance if there is a remaining balance
        if ($remainingBalance > 0) {
            $client = Client::findOrFail($invoice->client_id);
            $client->balance += $remainingBalance;
            $client->save();
        }

        // Store the payment in the payments table
        Payment::create([
            'client_id' => $invoice->client_id,
            'amount' => $amountPaid,
            'payment_date' => now(),
        ]);

        return redirect(route('invoice.index'))->with('success', 'Payment processed successfully.');
    }

    // Display the form to manage client balance
    public function editClientBalance(string $clientId)
    {
        $client = Client::findOrFail($clientId);
        return view('admin.payments.edit-the-clientBalance', compact('client'));
    }

    // Process the balance update for a client
    public function processBalanceUpdate(Request $request, string $clientId)
    {
        // Validate the payment input
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // Create a new payment
        $amountPaid = $request->input('amount_paid');
        Payment::create([
            'client_id' => $clientId,
            'amount' => $amountPaid,
            'payment_date' => now(),
        ]);

        // Update the client's balance
        $client = Client::findOrFail($clientId);
        $client->balance -= $amountPaid;
        $client->save();

        return redirect(route('client.index'))->with('success', 'تم خصم المبلغ بنجاح');
    }
}
