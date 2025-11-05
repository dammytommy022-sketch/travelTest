<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraLuggage;

class ExtraLuggageController extends Controller
{
    public function extra()
    {
        return view('extra_luggage.extra');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'airline' => 'required|string',
            'ticket' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_page' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email'
        ]);

        // Save uploads
        $ticketPath = $request->file('ticket')->store('uploads/tickets', 'public');
        $dataPagePath = $request->file('data_page')->store('uploads/data_pages', 'public');

        // ✅ Save to DB
        ExtraLuggage::create([
            'airline' => $request->airline,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'ticket' => $ticketPath,
            'data_page' => $dataPagePath,
        ]);

        return back()->with('success', 'Extra luggage request submitted successfully!');
    }
}
