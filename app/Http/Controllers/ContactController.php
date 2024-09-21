<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
{
    $contacts = Contact::all(); // Fetch all contacts
    return view('admin.contacts', compact('contacts')); // Pass them to the view
}

    //
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store the form data
        Contact::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
}
