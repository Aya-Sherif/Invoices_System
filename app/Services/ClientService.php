<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    /**
     * Prepare data for creating a new client.
     */
    public function prepareClientData($request)
    {
        return [
            'name' => $request->الاسم,
            'phone' => $request->رقم_الهاتف,
            'balance' => 0,
            'client_identifier' => $this->generateClientIdentifier(),
        ];
    }

    /**
     * Generate a unique client identifier.
     */
    private function generateClientIdentifier()
    {
        $year = date('Y');

        // Get the highest identifier for the current year
        $latestIdentifier = Client::where('client_identifier', 'like', $year . '%')
            ->orderBy('client_identifier', 'desc')
            ->value('client_identifier');

        // Extract the sequence number
        if ($latestIdentifier) {
            $sequence = (int) substr($latestIdentifier, 4);
        } else {
            $sequence = 0;
        }

        // Increment the sequence number
        $sequence++;

        // Format sequence as a 5-digit number
        $formattedSequence = str_pad($sequence, 5, '0', STR_PAD_LEFT);

        // Create the new identifier
        return $year . $formattedSequence;
    }
}
