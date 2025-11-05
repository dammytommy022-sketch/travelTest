<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportPaymentSuccessMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SeerbitLaravel\Facades\Seerbit;
use Illuminate\Support\Facades\Redirect;


class SupportController extends Controller
{
    public function ticketAssit()
    {
        return view('air.support.ticketAssist');
    }

    public function ticketSave(Request $request){
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

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));
        $productId = "SPA".$uuid;
        $amount = "25000";
        $payment_option = 'budpay';
        //dd($data);

        // Save to database
        $supportRequest = SupportRequest::create(array_merge($data, [
            'payment_reference' => $transaction_ref,
            'payment_status' => 'pending',
            'payment_option' => $payment_option,
            'amount' => $amount,
        ]));

        //dd('data save in db');
        if('seerbit' == $payment_option) {
            try {
                $payload = [
                    "amount" => $amount,
                    "callbackUrl" => route('callback.seerbit'),
                    "country" => "NG",
                    "currency" => "NGN",
                    "email" => $data['email'],
                    'client_name' => $data['name_on_ticket'],
                    "paymentReference" => $transaction_ref,
                    "productDescription" => "Suppot Assitance",
                    "productId" => $productId,
                ];
                //dd($payload);
                
                $trans = SeerBit::Standard()->Initialize($payload);
                $pay = $trans['data']['message'];
                //dd($pay);
                $redirectLink = $trans['data']['payments']['redirectLink'];
                return redirect($redirectLink);
                //$redirectLink = $trans['data']['payments']['redirectLink'];

                // Redirect the user to the payment redirect link
            } catch (\Exception $e) {
                dd($e->getMessage());
                return Redirect::back()->withMessage(['msg'=>'The payment gateway token has expired. Please refresh the page and try again.', 'type'=>'error']);
                
            }
        }
        // === BUDPAY PAYMENT ===
        elseif ('budpay' == $payment_option) {
            try {
                // Generate a unique transaction reference and prepare inline page
                $publicKey = env('BUDPAY_PUBLIC_KEY', 'pk_test_xolsnu5dpqpia2a7a8iftygugzyluz2qffkhlid');
                $email = $data['email'];
                $amountValue = $amount;
                $firstName = explode(' ', $data['name_on_ticket'] ?? 'Customer')[0];
                $lastName = explode(' ', $data['name_on_ticket'] ?? 'Customer')[1] ?? '';
                $ref = $transaction_ref;
                $callbackUrl = route('callback.budpay');

                // Return inline payment HTML that automatically launches BudPay popup
                return response()->make("
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <title>Redirecting to BudPay</title>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <script src='https://inlinepay.budpay.com/budpay-inline-custom.js'></script>
                        <style>
                            body {
                                font-family: 'Segoe UI', Arial, sans-serif;
                                background: #f8fafc;
                                margin: 0;
                                padding: 0;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                height: 100vh;
                            }
                            .payment-card {
                                background: #fff;
                                border-radius: 16px;
                                box-shadow: 0 8px 25px rgba(0,0,0,0.08);
                                padding: 40px 30px;
                                max-width: 420px;
                                width: 100%;
                                text-align: center;
                                animation: fadeIn 0.7s ease-in-out;
                                position: relative;
                            }
                            .logo-bar {
                                align-items: center;
                                margin-bottom: 25px;
                            }
                            .logo-bar img {
                                height: 25px;
                                transition: transform 0.4s ease;
                            }
                            .logo-bar img:hover {
                                transform: scale(1.05);
                            }
                            .payment-card h2 {
                                color: #1a1a1a;
                                margin-bottom: 10px;
                                font-size: 1.5rem;
                            }
                            .payment-card p {
                                color: #555;
                                margin-bottom: 20px;
                                font-size: 0.95rem;
                            }
                            .amount-box {
                                font-size: 1.6rem;
                                font-weight: 700;
                                color: #1369FF;
                                margin-bottom: 25px;
                            }
                            button {
                                background: linear-gradient(135deg, #1369FF, #0052cc);
                                color: #fff;
                                border: none;
                                border-radius: 10px;
                                padding: 14px 28px;
                                font-size: 1rem;
                                cursor: pointer;
                                transition: all 0.3s ease;
                            }
                            button:hover {
                                background: #0047b3;
                                transform: translateY(-2px);
                                box-shadow: 0 4px 12px rgba(19,105,255,0.3);
                            }
                            .loader {
                                display: none;
                                margin: 20px auto;
                                border: 4px solid #f3f3f3;
                                border-top: 4px solid #1369FF;
                                border-radius: 50%;
                                width: 30px;
                                height: 30px;
                                animation: spin 1s linear infinite;
                            }
                            .secure-note {
                                font-size: 0.85rem;
                                color: #777;
                                margin-top: 15px;
                            }
                            @keyframes fadeIn {
                                from { opacity: 0; transform: translateY(15px); }
                                to { opacity: 1; transform: translateY(0); }
                            }
                            @keyframes spin {
                                0% { transform: rotate(0deg); }
                                100% { transform: rotate(360deg); }
                            }
                        </style>
                    </head>
                    <body>
                        <div class='payment-card'>
                            <!-- Logo bar -->
                            <div class='logo-bar'>
                                <img src='https://travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png' alt='TravelWheel Logo'>
                                
                            </div>

                            <h2>Redirecting to BudPay</h2>
                            <p>You’re about to complete your <b>Support Assistance</b> payment securely.</p>

                            <div class='amount-box'>₦{$amountValue}</div>

                            <button id='payBtn'>Proceed to Pay Securely</button>
                            <div class='loader' id='loader'></div>

                            <p class='secure-note'>Secured payment powered by BudPay</p>
                        </div>

                        <script>
                            const payBtn = document.getElementById('payBtn');
                            const loader = document.getElementById('loader');

                            payBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                loader.style.display = 'block';
                                payBtn.disabled = true;
                                payBtn.textContent = 'Launching...';

                                BudPayCheckout({
                                    key: '{$publicKey}',
                                    email: '{$email}',
                                    amount: '{$amountValue}',
                                    first_name: '{$firstName}',
                                    last_name: '{$lastName}',
                                    currency: 'NGN',
                                    reference: '{$ref}',
                                    callback_url: '{$callbackUrl}',
                                    onSuccess: function(response) {
                                        alert('✅ Payment completed successfully! Reference: ' + response.reference);
                                        window.location.href = '{$callbackUrl}?reference=' + response.reference;
                                    },
                                    onClose: function() {
                                        alert('⚠️ Transaction was not completed or window closed.');
                                        loader.style.display = 'none';
                                        payBtn.disabled = false;
                                        payBtn.textContent = 'Proceed to Pay Securely';
                                    },
                                    custom_fields: {
                                        support_type: '{$data['request_type']}',
                                        phone: '{$data['phone']}'
                                    }
                                });
                            });
                        </script>
                    </body>
                    </html>
                    ");



            } catch (\Exception $e) {
                \Log::error('BudPay Inline Error: '.$e->getMessage());
                return Redirect::back()->with('error', 'BudPay error: '.$e->getMessage());
            }
        }


    }
 

    public function budpayCallback(Request $request)
    {
        $reference = $request->query('reference');
        if (!$reference) {
            return redirect()->route('air.support_ticket')->with('error', 'Missing payment reference.');
        }
        //dd($request);
        try {
            $verify = Http::withToken(env('BUDPAY_SECRET_KEY'))
                ->get("https://api.budpay.com/api/v2/transaction/verify/{$reference}");

            $data = $verify->json();

            //dd($data);

            if ($verify->ok() && isset($data['status']) && $data['status'] === true) {
                $support = SupportRequest::where('payment_reference', $reference)->first();

                if ($support) {
                    $support->update(['payment_status' => 'paid']);

                    // === Send Email to Client ===
                    Mail::to($support->email)->send(new \App\Mail\PaymentSuccessMail($support));

                    // === Send Notification to Support Department ===
                    Mail::to('damilola@travelwheel.ng')->send(new \App\Mail\SupportNotificationMail($support));
                }

                return redirect()->route('air.support_success')->with('success', 'Payment successful!');
            }


            dd($data);
            \Log::error('BudPay verification failed', ['response' => $data]);
            return redirect()->route('air.support_ticket')->with('error', 'Payment verification failed.');

        } catch (\Exception $e) {
            \Log::error('BudPay Callback Error: ' . $e->getMessage());
            return redirect()->route('air.support_ticket')->with('error', 'Error verifying payment.');
        }
    }

    public function supportSuccess()
    {
        return view('air.support.success')
            ->with('success', 'Payment completed successfully!');
    }
}

