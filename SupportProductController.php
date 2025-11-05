<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportPaymentSuccessMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupportProductController extends Controller
{
    /**
     * Display support form
     */
    public function support()
    {
        return view('air.support_product.support');
    }

    /**
     * Initialize BudPay payment
     */
    public function initiatePayment(Request $request)
    {
        $data = $request->validate([
            'request_type' => 'required|in:date_change,rerouting',
            'booking_source' => 'required|in:airline,agent',
            'name_on_ticket' => 'nullable|string|max:255',
            'airline_reference' => 'nullable|string|max:255',
            'airline_category' => 'nullable|string|max:50',
            'airline' => 'nullable|string|max:255',
            'trip_type' => 'nullable|string|max:50',
            'travel_date_oneway' => 'nullable|date',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'route_from' => 'nullable|string|max:255',
            'route_to' => 'nullable|string|max:255',
            'preferred_time' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'additional_info' => 'nullable|string',
        ]);
        
        // Amount (in kobo)
        $amount = "25000";
         // Save form data in session so we can retrieve after callback
        session(['support_form_data' => $data]);
        
        // BudPay API endpoint
        $url = 'https://api.budpay.com/api/v2/transaction/initialize';
        $skey ="sk_test_5conjviuayp5d7d3qcwvagxq2tumanmvswdjkbj";
        // Send initialization request
        $response = Http::withHeaders([
            
            'Authorization' => 'Bearer ' . $skey,
            //'Authorization' => 'sk_test_5conjviuayp5d7d3qcwvagxq2tumanmvswdjkbj', // Replace with your BudPay SECRET key
            'Accept' => 'application/json',
        ])->post($url, [
            'amount' => $amount,
            'email' => $data['email'],
            'currency' => 'NGN',
            'callback_url' => url('https://angeles-isostructural-ordinarily.ngrok-free.dev/air/support_product/verify-payment'),
            'first_name' => $data['name_on_ticket'] ?? '',
            'last_name' => $data['name_on_ticket  '] ?? '',
            'phone' => $data['phone'],
        ]);

        $result = $response->json();
        //dd($result);
        // Handle API failure
        if ($response->failed() || empty($result['data']['authorization_url'])) {
            Log::error('BudPay init failed: ' . $response->body());
            return back()->with('error', 'Unable to initialize payment. Please try again.');
        }

        

        // Redirect to BudPay checkout
        return redirect()->away($result['data']['authorization_url']);
    }

    /**
     * Verify payment after callback from BudPay
     */
     public function verifyPaymentServer(Request $request)
    {
        // BudPay usually returns ?reference=xxxx in the callback
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('support.form')->with('error', 'Missing payment reference.');
        }

        // Verify payment
        $verifyUrl = "https://api.budpay.com/api/v2/transaction/verify/$reference";

        $response = Http::withHeaders([
            'Authorization' => 'sk_test_5conjviuayp5d7d3qcwvagxq2tumanmvswdjkbj',
            'Accept' => 'application/json',
        ])->get($verifyUrl);

        $result = $response->json();

        if ($response->failed() || ($result['data']['status'] ?? '') !== 'success') {
            Log::error('BudPay verify failed: ' . $response->body());
            return redirect()->route('support.form')->with('error', 'Payment verification failed. Please try again.');
        }

        // ✅ Payment succeeded
        $formData = session('support_form_data');

        if (!$formData) {
            return redirect()->route('support.form')->with('error', 'Session expired. Please refill the form.');
        }

        // Save to database
        $supportRequest = SupportRequest::create(array_merge($formData, [
            'payment_reference' => $result['data']['reference'],
            'payment_status' => 'success',
        ]));

        // Send confirmation email
        try {
            Mail::to($formData['email'])
                ->cc(['adeshina524@gmail.com', 'damilola@travelwheel.ng'])
                ->send(new SupportPaymentSuccessMail($supportRequest));
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        // Clear session
        session()->forget(['support_form_data']);

        // Redirect to success page
        return redirect()->route('payment.success')
            ->with('success', 'Payment completed successfully!');
    }

    /**
     * Success page
     */
    public function paymentSuccess()
    {
        return view('air.support_product.payment_successful')
            ->with('success', 'Payment completed successfully!');
    }
}

