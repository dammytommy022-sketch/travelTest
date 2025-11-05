<?php

namespace App\Http\Controllers;

use App\Models\YellowCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log; // Added for correct logging

class YellowCardController extends BaseController
{
    // Show the form
    public function yellow_card()
    {
        return view('yellow_card.yellow_card');
    }

    // Handle form submission (data and file upload) and initiate BudPay
    public function submit(Request $request)
    {
        // 1. Validation
        $request->validate([
            'service_type' => 'required|in:standard,fasttrack',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'data_page' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'home_address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:255',
        ]);

        // 2. Determine price and unique reference
        $price = $request->service_type === 'fasttrack' ? 50000 : 30000;
        $reference = 'YC_' . time() . rand(100, 999);
        $amountInKobo = $price * 100;

        // 3. Temporarily save the uploaded file.
        try {
            $filePath = $request->file('data_page')->store('yellowcards_temp', 'public');
        } catch (\Exception $e) {
            Log::error('Temporary file upload failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'File upload failed. Please try again.');
        }

        // 4. PREPARE METADATA for BudPay
        // This data will be saved to the DB upon successful payment verification.
        $metadata = [
            'application_data' => [
                'service_type' => $request->service_type,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'home_address' => $request->home_address,
                'phone_number' => $request->phone_number,
                'delivery_address' => $request->delivery_address,
                'price' => $price,
                'temp_file_path' => $filePath, 
            ]
        ];
        
        // 5. CALL BUDPAY API TO INITIATE PAYMENT
        $payload = [
            'amount' => $amountInKobo,
            'email' => $request->email,
            'currency' => 'NGN',
            'reference' => $reference,
            'callback_url' => url('/yellow_card/verify'),
            'metadata' => $metadata,
        ];

        // ✅ FIX: Using explicit Authorization header construction for reliability
        $url = 'https://api.budpay.com/api/v2/transaction/initialize';
        $skey ="sk_test_5conjviuayp5d7d3qcwvagxq2tumanmvswdjkbj";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $skey,
            'Accept' => 'application/json',
        ])->post($url, $payload);

        $result = $response->json();

        if ($response->successful() && isset($result['status']) && $result['status'] === true) {
            
            $paymentUrl = $result['data']['payment_url'] ?? null;

            if ($paymentUrl) {
                // Redirect customer directly to the BudPay payment URL
                return redirect()->away($paymentUrl);
            }
        }
        
        // Failure: Clean up temporary file and notify user
        Log::error('BudPay initiation failed:', ['response' => $result]);
        Storage::disk('public')->delete($filePath); 
        return back()->with('error', 'Payment service could not be started. Please try again or contact support.');
    }

    // 2. BudPay Payment Verification (Saves to DB only upon success)
    public function verifyPayment(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('yellow_card.failed')->with('error', 'Invalid payment reference.');
        }

        $tempFilePath = null; 

        try {
            // 1. Verify transaction with BudPay
            $verifyUrl = "https://api.budpay.com/api/v2/transaction/verify/$reference";
            
            // ✅ FIX: Use explicit Authorization header for verification too
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('BUDPAY_SECRET_KEY'),
                'Accept' => 'application/json',
            ])->get($verifyUrl);

            $result = $response->json();

            // 2. Check if verification was successful
            if ($response->successful() && isset($result['status']) && $result['status'] === true && $result['data']['status'] === 'success') {

                $metadata = $result['data']['metadata']['application_data'] ?? [];
                $tempFilePath = $metadata['temp_file_path'] ?? null;
                
                if (empty($metadata) || !$tempFilePath) {
                    Log::error('BudPay verification success but metadata missing.', ['reference' => $reference]);
                    return redirect()->route('yellow_card.failed')->with('error', 'Payment succeeded but application data was lost.');
                }
                
                // 3. Move the file from temp folder to final folder
                $finalFileName = basename($tempFilePath);
                $finalFilePath = 'yellowcards/' . $finalFileName;

                if (Storage::disk('public')->exists($tempFilePath)) {
                    Storage::disk('public')->move($tempFilePath, $finalFilePath);
                } else {
                    Log::warning("Temporary file {$tempFilePath} not found for moving.");
                    $finalFilePath = $tempFilePath; 
                }

                // 4. Save the new YellowCard record to the database
                YellowCard::create([
                    'service_type' => $metadata['service_type'],
                    'full_name' => $metadata['full_name'],
                    'data_page' => $finalFilePath, 
                    'email' => $metadata['email'],
                    'home_address' => $metadata['home_address'],
                    'phone_number' => $metadata['phone_number'],
                    'delivery_address' => $metadata['delivery_address'],
                    'price' => $metadata['price'],
                    'status' => 'paid', 
                    'reference' => $reference, 
                ]);

                return redirect()->route('yellow_card.success')
                    ->with('success', 'Payment successful and application submitted!');
            }

            // If verification failed 
            return redirect()->route('yellow_card.failed')
                ->with('error', 'Payment failed or was not successful.');

        } catch (\Exception $e) {
            // Clean up temporary file if payment failed
            if ($tempFilePath && Storage::disk('public')->exists($tempFilePath)) {
                Storage::disk('public')->delete($tempFilePath);
            }
            Log::error('Error during payment verification: ' . $e->getMessage());
            return redirect()->route('yellow_card.failed')
                ->with('error', 'Error verifying payment. Please contact support with reference: ' . $reference);
        }
    }

    public function success()
    {
        return view('yellow_card.success');
    }

    public function failed()
    {
        return view('yellow_card.failed');
    }
}