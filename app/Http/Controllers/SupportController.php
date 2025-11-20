<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportRequest;             
use App\Models\ExtraLuggage;               
use App\Models\VisaConfirmation;      
use App\Models\YellowCard;                

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SeerbitLaravel\Facades\Seerbit;
use Illuminate\Support\Facades\Redirect;

class SupportController extends Controller
{
    public function index()
    {
        return view('air.support.index');
    }

    public function ticketAssit()
    {
        return view('air.support.index');
    }

    //FLIGHT ASSIST
    public function ticketSave(Request $request)
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
            'payment_option' => 'required|in:budpay,seerbit',
            'amount' => 'required|integer|in:25000',
            'additional_info' => 'nullable|string',
        ]);

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));
        $productId = "SPA".$uuid;

        // Save
        $supportRequest = SupportRequest::create(array_merge($data, [
            'payment_reference' => $transaction_ref,
            'payment_status' => 'pending',
            'payment_option' => $data['payment_option'],
            'amount' => $data['amount'],
        ]));

        // continue with your payment logic...
        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount: $data['amount'],
            email: $data['email'],
            phone: $data['phone'],
            customerName: $data['name_on_ticket'] ?? 'Customer',
            reference: $transaction_ref,
            product_title: "Flight Assist"
        );
    }


     //EXTRA LUGGAGE SUBMISSION
    public function submitExtraLuggage(Request $request)
    {
        $data = $request->validate([
            'full_name'     => 'required|string|max:255',
            'airline_category' => 'required',
            'data_page'       => 'required|file|mimes:pdf,jpg,png',
            'contact_number'  => 'required|string|max:20',
            'airline'         => 'required|string',
            'ticket'          => 'required|file|mimes:pdf,jpg,png',
            'email'           => 'required|email|max:255',
            'payment_option' => 'required|in:budpay,seerbit',
            'amount' => 'required|integer|in:25000',
        ]);

        // Upload files
        $dataPage = $request->file('data_page')->store('extra_luggage', 'public');
        $ticket   = $request->file('ticket')->store('extra_luggage_tickets', 'public');

        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper($uuid);

        // Save into DB
        $record = ExtraLuggage::create([
            'full_name'        => $data['full_name'],
            'airline_category' => $data['airline_category'],
            'data_page'        => $dataPage,
            'ticket'           => $ticket,
            'contact_number'   => $data['contact_number'],
            'email'            => $data['email'],
            'airline'          => $data['airline'],
            'payment_reference'=> $transaction_ref,
            'payment_option' => $data['payment_option'],
            'payment_status'   => 'pending',
            'amount'           => $data['amount'],
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount: $data['amount'],
            email: $data['email'],
            phone: $data['contact_number'],
            customerName: $data['full_name'],
            reference: $transaction_ref,
            product_title: "Extra Luggage"
        );
    }


    
      //VISA CONFIRMATION
    public function submitVisa(Request $request)
    {
        $data = $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone_number'  => 'required|string|max:20',
            'visa_file'     => 'required|file|mimes:pdf,jpg,png',
            'payment_option' => 'required|in:budpay,seerbit',
            'amount' => 'required|integer|in:50000',
            'additional_info'=>'nullable|string'
        ]);

        $visaFile = $request->file('visa_file')->store('visa', 'public');

        $uuid = bin2hex(random_bytes(6));
        $reference = strtoupper($uuid);

        VisaConfirmation::create([
            'full_name'        => $data['full_name'],
            'email'            => $data['email'],
            'phone_number'     => $data['phone_number'],
            'visa_file'        => $visaFile,
            'payment_reference'=> $reference,
            'payment_option' => $data['payment_option'],
            'payment_status'   => 'pending',
            'amount'           => $data['amount'],
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount: $data['amount'],
            email: $data['email'],
            phone: $data['phone_number'],
            customerName: $data['full_name'],
            reference: $reference,
            product_title: "Visa Confirmation",
        );
    }


    // ✅ YELLOW CARD
     
    public function submitYellowCard(Request $request)
    {
        $data = $request->validate([
            'service_type'     => 'required',
            'full_name'        => 'required|string|max:255',
            'data_page'        => 'required|file|mimes:pdf,jpg,png',
            'email'            => 'required|email|max:255',
            'home_address'     => 'required|string',
            'payment_option' => 'required|in:budpay,seerbit',
            'phone_number'     => 'required',
            'delivery_address' => 'required|string'
        ]);

        $filePath = $request->file('data_page')->store('yellow_card', 'public');

        $uuid = bin2hex(random_bytes(6));
        $reference = strtoupper($uuid);

        $amount = ($data['service_type'] === 'fasttrack') ? 50000 : 30000;
        YellowCard::create([
            'service_type'      => $data['service_type'],
            'full_name'         => $data['full_name'],
            'email'             => $data['email'],
            'data_page'         => $filePath,
            'home_address'      => $data['home_address'],
            'phone_number'      => $data['phone_number'],
            'delivery_address'  => $data['delivery_address'],
            'payment_reference' => $reference,
            'payment_option' => $data['payment_option'],
            'payment_status'    => 'pending',
            'amount'            => $amount,
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount: $amount,
            email: $data['email'],
            phone: $data['phone_number'],
            customerName: $data['full_name'],
            reference: $reference,
            product_title: "Yellow Card"
        );
    }


    private function launchPayment($payment_option, $amount, $email, $phone, $customerName, $reference, $product_title)
    {
        $publicKey  = env('BUDPAY_PUBLIC_KEY');
        $firstName  = explode(' ', $customerName)[0];
        $lastName   = explode(' ', $customerName)[1] ?? '';
        $callbackUrl = route('seerbit.support');

        if ($payment_option === 'seerbit') {
            return $this->launchSeerbitPayment(
                amount: $amount,
                email: $email,
                phone: $phone,
                customerName: $customerName,
                reference: $reference,
                product_title: $product_title
            );
        }
        if ($payment_option == 'budpay') {
            
            $callbackUrl = route('callback.budpay');

            return response()->make('
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Redirecting to BudPay</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script src="https://inlinepay.budpay.com/budpay-inline-custom.js"></script>

                    <style>
                        body {
                            font-family: Segoe UI, Arial, sans-serif;
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
                            border-radius: 18px;
                            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
                            padding: 45px 35px;
                            max-width: 430px;
                            width: 100%;
                            text-align: center;
                            animation: fadeIn 0.6s ease-in-out;
                        }
                        .logo-bar img {
                            height: 30px;
                            margin-bottom: 20px;
                        }
                        .amount-box {
                            font-size: 1.7rem;
                            font-weight: 700;
                            color: #0d1883;
                            margin: 25px 0;
                        }
                        #payBtn {
                            background: linear-gradient(135deg, #0d1883, #2d39b6);
                            color: #fff;
                            border: none;
                            border-radius: 10px;
                            padding: 15px 30px;
                            font-size: 1rem;
                            cursor: pointer;
                            transition: 0.3s ease;
                            width: 100%;
                        }
                        #payBtn:hover {
                            background: #0c146e;
                            transform: translateY(-2px);
                        }
                        .loader {
                            display: none;
                            margin: 15px auto;
                            border: 4px solid #f3f3f3;
                            border-top: 4px solid #0d1883;
                            border-radius: 50%;
                            width: 32px;
                            height: 32px;
                            animation: spin 1s linear infinite;
                        }
                        .secure-note {
                            margin-top: 20px;
                            font-size: 0.85rem;
                            color: #777;
                        }
                        @keyframes fadeIn {
                            from {opacity: 0; transform: translateY(10px);}
                            to {opacity: 1; transform: translateY(0);}
                        }
                        @keyframes spin {
                            0% { transform: rotate(0deg);}
                            100% { transform: rotate(360deg);}
                        }
                    </style>
                </head>

                <body>
                    <div class="payment-card">

                        <div class="logo-bar">
                            <img src="https://travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="TravelWheel Logo">
                        </div>

                        <h2 style="color:#1a1a1a; margin-bottom: 8px;">Redirecting to BudPay</h2>
                        <p style="color:#555;">You’re about to complete your <b>'.$product_title.'</b> payment securely.</p>

                        <div class="amount-box">₦'.number_format($amount).'</div>

                        <button id="payBtn">Proceed to Pay Securely</button>

                        <div class="loader" id="loader"></div>

                        <p class="secure-note">Secured payment powered by BudPay</p>
                    </div>

                    <script>
                        const payBtn = document.getElementById("payBtn");
                        const loader = document.getElementById("loader");

                        payBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            loader.style.display = "block";
                            payBtn.disabled = true;
                            payBtn.textContent = "Launching...";

                            BudPayCheckout({
                                key: "'.$publicKey.'",
                                email: "'.$email.'",
                                amount: "'.$amount.'",
                                first_name: "'.$firstName.'",
                                last_name: "'.$lastName.'",
                                currency: "NGN",
                                reference: "'.$reference.'",
                                callback_url: "'.$callbackUrl.'",

                                onSuccess: function(res){
                                    window.location.href = "'.$callbackUrl.'?reference=" + res.reference;
                                },

                                onClose: function(){
                                    loader.style.display = "none";
                                    payBtn.disabled = false;
                                    payBtn.textContent = "Proceed to Pay Securely";

                                    window.location.href = "'.url()->previous().'?payment=failed";
                                }

                                
                            });
                        });
                    </script>
                </body>
                </html>
                ');
        }
    }

    private function launchSeerbitPayment($amount, $email, $phone, $customerName, $reference, $product_title)
    {
        try {
            $callbackUrl = route('seerbit.support');

            $payload = [
                "amount"            => $amount,
                "callbackUrl"       => $callbackUrl,
                "country"           => "NG",
                "currency"          => "NGN",
                "email"             => $email,
                "client_name"       => $customerName,
                "paymentReference"  => $reference,
                "productDescription"=> $product_title,
                "productId"         => "PRD".$reference,
            ];

            $response = SeerBit::Standard()->Initialize($payload);

            if (
                isset($response['data']['payments']['redirectLink']) &&
                !empty($response['data']['payments']['redirectLink'])
            ) {
                return redirect($response['data']['payments']['redirectLink']);
            }

            Log::error("SeerBit Init Failed", ['response' => $response]);

            return back()->with('error', "Unable to start SeerBit payment.");
        }
        catch (\Exception $e) {
            Log::error("SeerBit Init Exception", ['error' => $e->getMessage()]);
            return back()->with('error', "SeerBit Error: ".$e->getMessage());
        }
    }


    public function unifiedCallback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            Log::warning('Unified Callback: Missing payment reference in URL.', ['url' => $request->fullUrl()]);
            return redirect()->route('air.support_ticket')
                ->with('error', 'Missing payment reference. Please contact support.');
        }

        try {
            $verify = Http::withToken(env('BUDPAY_SECRET_KEY'))
                ->get("https://api.budpay.com/api/v2/transaction/verify/{$reference}");

            if ($verify->failed()) {
                $status = $verify->status();
                $body = $verify->body();
                
                Log::error("BudPay API Verification Failed (HTTP Error)", [
                    'reference' => $reference,
                    'status' => $status,
                    'response_body' => $body,
                ]);

                return redirect()->route('air.support_ticket')
                    ->with('error', "Error communicating with payment gateway (Status: {$status}). Please try again.");
            }

            $data = $verify->json();

            Log::info("BudPay API Verification Response", ['reference' => $reference, 'data' => $data]);

            $txnStatus = $data['data']['transaction_status'] ?? $data['data']['status'] ?? null;

            if ($txnStatus !== 'success' && $txnStatus !== 'completed') {
                Log::warning("Payment Verification Status Not Success", [
                    'reference' => $reference,
                    'budpay_status' => $txnStatus,
                ]);
                return redirect()->route('air.support_ticket')
                    ->with('error', 'Payment was not successfully completed. Status: ' . ($txnStatus ?? 'Unknown'));
            }

            $models = [
                'flight_assist'     => \App\Models\SupportRequest::class,
                'extra_luggage'     => \App\Models\ExtraLuggage::class,
                'visa_confirmation' => \App\Models\VisaConfirmation::class,
                'yellow_card'       => \App\Models\YellowCard::class,
            ];

            $record = null;
            $productType = null;

            foreach ($models as $type => $modelClass) {
                $record = $modelClass::where('payment_reference', $reference)->first();
                if ($record) {
                    $productType = $type;
                    break;
                }
            }

            if (!$record) {
                Log::error("Payment Success BUT no record found in database", ['reference' => $reference]);
                return redirect()->route('air.support_ticket')->with('error', 'We received payment but cannot find your request. Please contact support.');
            }

            
            if ($record->payment_status !== 'paid') {
                $record->update(['payment_status' => 'paid']);
                Log::info("Record status updated to 'paid'", ['reference' => $reference, 'type' => $productType]);
            } else {
                Log::warning("Duplicate callback received for paid transaction", ['reference' => $reference, 'type' => $productType]);
            }

            $successRoute = 'air.support.success'; 
            $supportMaill = "damilola@travelwheel.ng";

            switch ($productType) {

            case 'flight_assist':
                Mail::to($record->email)->send(new \App\Mail\PaymentSuccessMail($record));
                Mail::to($supportMaill)
                    ->send(new \App\Mail\SupportNotificationMail($record));
                $message = 'Flight Assist Payment Successful!';
                break;

            case 'extra_luggage':
                if (!$record instanceof \App\Models\ExtraLuggage) {
                        $record = \App\Models\ExtraLuggage::where('payment_reference', $reference)->first();
                    }
                // dd($record, $record->visa_file);
                    Mail::to($record->email)->send(new \App\Mail\ExtraLuggageSuccessMail($record));

                        $attachmentPath1 = storage_path('app/public/' . $record->data_page);
                        $attachmentPath2 = storage_path('app/public/' . $record->ticket);

                    Mail::to($supportMaill)->send( new \App\Mail\ExtraLuggageNotificationMail($record, [
                        ['file' => $attachmentPath1, 'options' => []],
                        ['file' => $attachmentPath2, 'options' => []],
                        ])
                    );
                $message = 'Extra Luggage Payment Successful!';
                break;

            case 'visa_confirmation':
                if (!$record instanceof \App\Models\VisaConfirmation) {
                    $record = \App\Models\VisaConfirmation::where('payment_reference', $reference)->first();
                }
               // dd($record, $record->visa_file);
                Mail::to($record->email)->send(new \App\Mail\VisaConfirmationSuccessMail($record));

                    $attachmentPath = storage_path('app/public/' . $record->visa_file);

                Mail::to($supportMaill)->send( new \App\Mail\VisaConfirmationNotificationMail($record, [
                     ['file' => $attachmentPath, 'options' => []]])
                );
                $message = 'Visa Confirmation Payment Successful!';
                break;

            case 'yellow_card':
                if (!$record instanceof \App\Models\YellowCard) {
                    $record = \App\Models\YellowCard::where('payment_reference', $reference)->first();
                }
                Mail::to($record->email)->send(new \App\Mail\YellowCardSuccessMail($record));
                
                    $attachmentPath = storage_path('app/public/' . $record->data_page);

                Mail::to($supportMaill)->send( new \App\Mail\YellowCardNotificationMail($record, [
                     ['file' => $attachmentPath, 'options' => []]])
                );
                $message = 'Yellow Card Payment Successful!';
                break;

            default:
                $message = 'Payment Successful!';
                break;
        }
        //dd($record);

           /* if ($productType === 'flight_assist') {
                Mail::to($record->email)->send(new \App\Mail\PaymentSuccessMail($record));
                Mail::to('support@travelwheel.ng')->send(new \App\Mail\SupportNotificationMail($record));
                $message = 'Flight Assist Payment Successful!';
            } elseif ($productType === 'extra_luggage') {
                Mail::to($record->email)->send(new \App\Mail\ExtraLuggageSuccessMail($record));
                Mail::to('support@travelwheel.ng')->send(new \App\Mail\ExtraLuggageNotificationMail($record));
                $message = 'Extra Luggage Payment Successful!';
            } elseif ($productType === 'visa_confirmation') {
                Mail::to($record->email)->send(new \App\Mail\VisaConfirmationSuccessMail($record));
                Mail::to('support@travelwheel.ng')->send(new \App\Mail\VisaConfirmationNotificationMail($record));
                $message = 'Visa Confirmation Payment Successful!';
            } elseif ($productType === 'yellow_card') {
                Mail::to($record->email)->send(new \App\Mail\YellowCardSuccessMail($record));
                Mail::to('support@travelwheel.ng')->send(new \App\Mail\YellowCardNotificationMail($record));
                $message = 'Yellow Card Payment Successful!';
            }*/
            
            return redirect()->route($successRoute)->with('success', $message);

        } catch (\Exception $e) {
            Log::error("Unified Callback Critical Error", [
                'reference' => $reference,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return redirect()->route('air.support_ticket')
                ->with('error', 'Error verifying payment. We have been notified of the issue.');
        }
    }

    public function callbackSeerbitS(Request $request)
    {
        //dd($request);
        $reference = $request->query('reference');
        $message = $request->query('message');
           
        Log::info("SeerBit Callback Received", ['reference' => $reference]);

       

        if (!$message == "Successful") {
            Log::error("SeerBit Payment Failed After Retries", [
                'reference' => $reference
            ]);

            return redirect()->route('air.support_ticket')
                ->with('error', 'Payment failed. Please try again.');
        }
        //dd($response);

        //return redirect()->route('air.support_ticket')
        //->with('success', 'Transaction successful and verified!');       

        $models = [
            'flight_assist'      => \App\Models\SupportRequest::class,
            'extra_luggage'      => \App\Models\ExtraLuggage::class,
            'visa_confirmation'  => \App\Models\VisaConfirmation::class,
            'yellow_card'        => \App\Models\YellowCard::class,
        ];

        $record = null; 
        $productType = null;

        foreach ($models as $type => $model) {
            $record = $model::where('payment_reference', $reference)->first();
            if ($record) {
                $productType = $type;
                break;
            }
        }

        if (!$record) {
            Log::error("SeerBit Paid but no record found", ['reference' => $reference]);
            return redirect()->route('air.support_ticket')
                ->with('error', 'Payment received but no matching request found.');
        }

        //Update payment status
        $record->update(['payment_status' => 'paid']);
        $supportMaill = "damilola@travelwheel.ng";
        switch ($productType) {

            case 'flight_assist':
                Mail::to($record->email)->send(new \App\Mail\PaymentSuccessMail($record));
                Mail::to($supportMaill)
                    ->send(new \App\Mail\SupportNotificationMail($record));
                $message = 'Flight Assist Payment Successful!';
                break;

            case 'extra_luggage':
                if (!$record instanceof \App\Models\ExtraLuggage) {
                        $record = \App\Models\ExtraLuggage::where('payment_reference', $reference)->first();
                    }
                // dd($record, $record->visa_file);
                    Mail::to($record->email)->send(new \App\Mail\ExtraLuggageSuccessMail($record));
                        $attachmentPath1 = storage_path('app/public/' . $record->data_page);
                        $attachmentPath2 = storage_path('app/public/' . $record->ticket);

                    Mail::to($supportMaill)->send( new \App\Mail\ExtraLuggageNotificationMail($record, [
                        ['file' => $attachmentPath1, 'options' => []],
                        ['file' => $attachmentPath2, 'options' => []],
                        ])
                    );
                $message = 'Extra Luggage Payment Successful!';
                break;

            case 'visa_confirmation':
                if (!$record instanceof \App\Models\VisaConfirmation) {
                    $record = \App\Models\VisaConfirmation::where('payment_reference', $reference)->first();
                }
               // dd($record, $record->visa_file);

                Mail::to($record->email)->send(new \App\Mail\VisaConfirmationSuccessMail($record));
                    $attachmentPath = storage_path('app/public/' . $record->visa_file);

                Mail::to($supportMaill)->send( new \App\Mail\VisaConfirmationNotificationMail($record, [
                     ['file' => $attachmentPath, 'options' => []]])
                );
               // Mail::to($supportMaill)
                   // ->send(new \App\Mail\VisaConfirmationNotificationMail($record));
                $message = 'Visa Confirmation Payment Successful!';
                break;

            case 'yellow_card':
                if (!$record instanceof \App\Models\YellowCard) {
                    $record = \App\Models\YellowCard::where('payment_reference', $reference)->first();
                }
               // dd($record, $record->visa_file);
                Mail::to($record->email)->send(new \App\Mail\YellowCardSuccessMail($record));
                    $attachmentPath = storage_path('app/public/' . $record->data_page);

                Mail::to($supportMaill)->send( new \App\Mail\YellowCardNotificationMail($record, [
                     ['file' => $attachmentPath, 'options' => []]])
                );
                $message = 'Yellow Card Payment Successful!';
                break;

            default:
                $message = 'Payment Successful!';
                break;
        }

        return redirect()->route('air.support.success')  ->with('success', $message);
    }
  

    public function supportSuccess()
    {   $message = "";

        return view('air.support.success')
            ->with('success', $message);
    }
};
