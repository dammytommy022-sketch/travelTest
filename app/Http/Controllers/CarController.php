<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarHire;
use App\Models\Transfer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SeerbitLaravel\Facades\Seerbit;

class CarController extends Controller
{
    public function index()
    {
        $categories = [
            'saloon' => [
                'fuel_rate_per_km' => 50,
                'hourly_rate'      => 5000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 15000,
                        'passengers' => '1 – 3',
                        'images'     => [
                            asset('assets/image/saloon.jpg'),//front
                            asset('assets/image/saloon.jpg'),//rear
                            asset('assets/image/saloon.jpg'),//interior
                        ],
                        'features' => [
                            'Comfortable sedan vehicle',
                            'Air conditioning',
                            'Professional driver',
                            'Suitable for short trips',
                            'Basic luggage space',
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 20000,
                        'passengers' => '1 – 3',
                        'images'     => [
                            asset('assets/image/saloon.jpg'),//front
                            asset('assets/image/saloon.jpg'),//rear
                            asset('assets/image/saloon.jpg'),//interior
                        ],
                        'features' => [
                            'Mid-range sedan vehicle',
                            'Air conditioning',
                            'Professional uniformed driver',
                            'Suitable for city & airport trips',
                            'Complimentary bottled water',
                            'Adequate boot space',
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 30000,
                        'passengers' => '1 – 3',
                        'images'     => [
                            asset('assets/image/saloon.jpg'),//front
                            asset('assets/image/saloon.jpg'),//rear
                            asset('assets/image/saloon.jpg'),//interior
                        ],
                        'features' => [
                            'Premium executive sedan',
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Wi-Fi on request',
                            'Complimentary refreshments',
                            'Meet & greet service',
                            'Large boot for luggage',
                        ],
                    ],
                ],
            ],

            'suv' => [
                'fuel_rate_per_km' => 70,
                'hourly_rate'      => 8000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 30000,
                        'passengers' => '1 – 3',
                        'images'     => [
                            asset('assets/image/suv.jpg'),//front
                            asset('assets/image/suv.jpg'),//rear
                            asset('assets/image/suv.jpg'),//interior
                        ],
                        'features' => [
                            'Standard SUV vehicle',
                            'Air conditioning',
                            'Professional driver',
                            'Suitable for family trips',
                            'Good luggage capacity',
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 40000,
                        'passengers' => '1 – 3',
                        'images'     => [
                            asset('assets/image/suv.jpg'),//front
                            asset('assets/image/suv.jpg'),//rear
                            asset('assets/image/suv.jpg'),//interior
                        ],
                        'features' => [
                            'Mid-size SUV vehicle',
                            'Full air conditioning',
                            'Professional uniformed driver',
                            'Ideal for airport & group trips',
                            'Complimentary bottled water',
                            'Spacious boot',
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 60000,
                        'passengers' => '1 – 3',
                        'images'     => [
                            asset('assets/image/suv.jpg'),//front
                            asset('assets/image/suv.jpg'),//rear
                            asset('assets/image/suv.jpg'),//interior
                        ],
                        'features' => [
                            'Premium full-size SUV',
                            'Dual-zone climate control',
                            'Smartly dressed chauffeur',
                            'Wi-Fi on request',
                            'Complimentary refreshments',
                            'Meet & greet service',
                            'Panoramic sunroof (where available)',
                            'Extra-large boot space',
                        ],
                    ],
                ],
            ],

            'van' => [
                'fuel_rate_per_km' => 80,
                'hourly_rate'      => 10000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 40000,
                        'passengers' => 'Up to 5',
                        'images'     => [
                            asset('assets/image/minivan.png'),//front
                            asset('assets/image/minivan.png'),//rear
                            asset('assets/image/minivan.png'),//interior
                        ],
                        'features' => [
                            'Standard minivan',
                            'Air conditioning',
                            'Professional driver',
                            'Suitable for group travel',
                            'Luggage storage available',
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 55000,
                        'passengers' => 'Up to 5',
                        'images'     => [
                            asset('assets/image/minivan.png'),//front
                            asset('assets/image/minivan.png'),//rear
                            asset('assets/image/minivan.png'),//interior
                        ],

                        'features' => [
                            'Mid-size passenger van',
                            'Full air conditioning',
                            'Professional uniformed driver',
                            'Ideal for family & group outings',
                            'Complimentary bottled water',
                            'Generous luggage space',
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 75000,
                        'passengers' => 'Up to 5',
                        'images'     => [
                            asset('assets/image/minivan.png'),//front
                            asset('assets/image/minivan.png'),//rear
                            asset('assets/image/minivan.png'),//interior
                        ],

                        'features' => [
                            'Premium people carrier',
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Reclining captain seats',
                            'Complimentary refreshments',
                            'USB charging ports',
                            'Extra-wide luggage bay',
                        ],
                    ],
                ],
            ],

            'bus' => [
                'fuel_rate_per_km' => 100,
                'hourly_rate'      => 15000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 40000,
                        'passengers' => 'Up to 12',
                        'images'     => [
                            asset('assets/image/coaster.jpg'),//front
                            asset('assets/image/coaster.jpg'),//rear
                            asset('assets/image/coaster.jpg'),//interior
                        ],
                        'features' => [
                            'Standard coaster bus',
                            'Air conditioning',
                            'Professional driver',
                            'Ideal for large groups',
                            'Luggage compartment',
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 55000,
                        'passengers' => 'Up to 12',
                        'images'     => [
                            asset('assets/image/coaster.jpg'),//front
                            asset('assets/image/coaster.jpg'),//rear
                            asset('assets/image/coaster.jpg'),//interior
                        ],
                        'features' => [
                            'Mid-size coach bus',
                            'Full air conditioning',
                            'Professional uniformed driver',
                            'Reclining seats',
                            'Luggage racks',
                            'Complimentary bottled water',
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 75000,
                        'passengers' => 'Up to 12',
                        'images'     => [
                            asset('assets/image/coaster.jpg'),//front
                            asset('assets/image/coaster.jpg'),//rear
                            asset('assets/image/coaster.jpg'),//interior
                        ],
                        'features' => [
                            'Premium coach bus',
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Reclining luxury seats',
                            'Onboard entertainment system',
                            'Complimentary refreshments',
                            'Overhead luggage racks',
                            'USB charging at every seat',
                        ],
                    ],
                ],
            ],

            'luxury' => [
                'fuel_rate_per_km' => 90,
                'hourly_rate'      => 20000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 40000,
                        'passengers' => '1 – 4',
                        'images'     => [
                            asset('assets/image/limo.avif'),//front
                            asset('assets/image/limo.avif'),//rear
                            asset('assets/image/limo.avif'),//interior
                        ],
                        'features' => [
                            'Entry-level luxury vehicle',
                            'Air conditioning',
                            'Professional chauffeur',
                            'Suitable for special occasions',
                            'Premium interior finish',
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 55000,
                        'passengers' => '1 – 4',
                        'images'     => [
                            asset('assets/image/limo.avif'),//front
                            asset('assets/image/limo.avif'),//rear
                            asset('assets/image/limo.avif'),//interior
                        ],
                        'features' => [
                            'Mid-range luxury limousine',
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Leather interior',
                            'Complimentary champagne on request',
                            'Privacy partition',
                            'Meet & greet service',
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 75000,
                        'passengers' => '1 – 4',
                        'images'     => [
                            asset('assets/image/limo.avif'),//front
                            asset('assets/image/limo.avif'),//rear
                            asset('assets/image/limo.avif'),//interior
                        ],
                        'features' => [
                            'Top-tier stretch limousine',
                            'Dual-zone climate control',
                            'White-glove chauffeur service',
                            'Premium leather & wood trim',
                            'Onboard bar & refreshments',
                            'Entertainment system',
                            'Privacy partition',
                            'Red carpet meet & greet',
                            'Flower arrangement on request',
                        ],
                    ],
                ],
            ],
        ];

        /* TRANSFER VEHICLE CLASSES
         */
        $transferVehicles = [
            [
                'key'         => 'saloon',
                'name'        => 'Saloon',
                'passengers'  => '1 – 3',
                'rate_per_km' => 350,
                'thumb'       => asset('assets/image/saloon.jpg'),
            ],
            [
                'key'         => 'suv',
                'name'        => 'SUV',
                'passengers'  => '1 – 3',
                'rate_per_km' => 500,
                'thumb'       => asset('assets/image/suv.jpg'),
                
            ],
            [
                'key'         => 'van',
                'name'        => 'Mini Van',
                'passengers'  => 'Up to 5',
                'rate_per_km' => 650,
                'thumb'       => asset('assets/image/minivan.png'),
                
            ],
            [
                'key'         => 'bus',
                'name'        => 'Bus',
                'passengers'  => 'Up to 12',
                'rate_per_km' => 900,
                'thumb'       => asset('assets/image/coaster.jpg'),
                
            ],
            [
                'key'         => 'luxury',
                'name'        => 'Luxury',
                'passengers'  => '1 – 4',
                'rate_per_km' => 1200,
                'thumb'       => asset('assets/image/limo.avif'),
                
            ],
        ];

        /*
         Type thumbnails shown on the left sidebar (one per vehicle type).
         These are the small thumb images for the type selector cards.
        */
        $typeThumbs = [
            'saloon'  => asset('assets/image/saloon.jpg'),
            'suv'     => asset('assets/image/suv.jpg'),
            'van'     => asset('assets/image/minivan.png'),
            'bus'     => asset('assets/image/coaster.jpg'),
            'luxury'  => asset('assets/image/limo.avif'),
        ];

        return view('carhire.index', compact('categories', 'transferVehicles', 'typeThumbs'));
    }

    public function distance(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string',
            'destination' => 'required|string',
        ]);

        $apiKey = config('services.google.maps_key');

        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'units'        => 'metric',
            'origins'      => $request->origin,
            'destinations' => $request->destination,
            'key'          => $apiKey,
        ]);

        $data = $response->json();

        if (($data['status'] ?? null) !== 'OK') {
            return response()->json([
                'error' => 'Google API error: ' . ($data['status'] ?? 'UNKNOWN') . ' — ' . ($data['error_message'] ?? 'No details')
            ], 500);
        }

        $element = $data['rows'][0]['elements'][0] ?? null;

        if (!$element || $element['status'] !== 'OK') {
            return response()->json([
                'error' => 'No route found between those locations. Status: ' . ($element['status'] ?? 'N/A')
            ], 400);
        }

        return response()->json([
            'distance_km'   => $element['distance']['value'] / 1000,
            'distance_text' => $element['distance']['text'],
            'drive_time'    => $element['duration']['text'],   // ✅ "54 mins" human-readable
        ]);
    }
    
    /*
    |==========================================================================
    |  CAR HIRE — submit, callbacks, emails
    |==========================================================================*/

    

    public function submitCarHire(Request $request)
    {
        $data = $request->validate([
            'car_type'         => 'required|string',
            'category'         => 'required|string',
            'price'            => 'required|numeric|min:0',
            'distance_km'      => 'required|numeric|min:1',
            'rental_hours'     => 'required|numeric|min:1',
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone_number'     => 'required|string|max:20',
            'passengers'       => 'required|integer|min:1',
            'pickup_location'  => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'pickup_date'      => 'required|date',
            'pickup_time'      => 'required',
            'payment_option'   => 'required|in:budpay,seerbit',
        ]);

        // Server-side price verification — never trust the submitted price
        $allCats   = $this->index()->getData()['categories'];
        $typeData  = $allCats[$data['car_type']] ?? null;
        $catItem   = collect($typeData['items'] ?? [])->firstWhere('name', $data['category']);
        $basePrice = $catItem['price'] ?? 0;

        $verifiedPrice = $basePrice
            + ($data['distance_km'] * ($typeData['fuel_rate_per_km'] ?? 0))
            + ($data['rental_hours'] * ($typeData['hourly_rate'] ?? 0));

        $reference = 'CARHIRE-' . strtoupper(bin2hex(random_bytes(5)));

        CarHire::create([
            'car_type'          => $data['car_type'],
            'category'          => $data['category'],
            'full_name'         => $data['full_name'],
            'email'             => $data['email'],
            'phone_number'      => $data['phone_number'],
            'passengers'        => $data['passengers'],
            'pickup_location'   => $data['pickup_location'],
            'dropoff_location'  => $data['dropoff_location'],
            'pickup_date'       => $data['pickup_date'],
            'pickup_time'       => $data['pickup_time'],
            'distance_km'       => $data['distance_km'],
            'rental_hours'      => $data['rental_hours'],
            'amount'            => $verifiedPrice,
            'payment_option'    => $data['payment_option'],
            'payment_reference' => $reference,
            'payment_status'    => 'pending',
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount:         $verifiedPrice,
            email:          $data['email'],
            phone:          $data['phone_number'],
            customerName:   $data['full_name'],
            reference:      $reference,
            product_title:  'Car Hire — ' . ucfirst($data['car_type']) . ' (' . $data['category'] . ')',
            callback_route: 'carhire.budpay.callback',
            cancel_route:   'carhire.index',
            seerbit_route:  'carhire.seerbit.callback',
        );
    }

    public function budpayCallbackCarHire(Request $request)
    {
        return $this->handleBudpayCallback(
            request:      $request,
            model:        CarHire::class,
            product_type: 'car_hire',
            fail_route:   'carhire.index',
            success_route:'carhire.success',
        );
    }

    public function seerbitCallbackCarHire(Request $request)
    {
        return $this->handleSeerbitCallback(
            request:      $request,
            model:        CarHire::class,
            product_type: 'car_hire',
            fail_route:   'carhire.index',
            success_route:'carhire.success',
        );
    }

    public function successCarHire()
    {
        return view('carhire.success')
            ->with('success', session('success', 'Your Car Hire booking was confirmed!'));
    }


    /*
    |==========================================================================
    |  TRANSFER — submit, callbacks, emails
    |==========================================================================
    */

    public function submitTransfer(Request $request)
    {
        $data = $request->validate([
            'vehicle_type'      => 'required|string',
            'vehicle_name'      => 'required|string',
            'price'             => 'required|numeric|min:0',
            'distance_km'       => 'required|numeric|min:1',
            'pickup_location'   => 'required|string|max:255',
            'dropoff_location'  => 'required|string|max:255',
            'full_name'         => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone_number'      => 'required|string|max:20',
            'passengers'        => 'required|integer|min:1',
            'flight_number'     => 'nullable|string|max:50',
            'special_requests'  => 'nullable|string|max:500',
            'pickup_date'       => 'required|date',
            'pickup_time'       => 'required',
            'payment_option'    => 'required|in:budpay,seerbit',
        ]);

        // Server-side price verification — find the vehicle rate from our data
        $allVehicles  = $this->index()->getData()['transferVehicles'];
        $vehicleData  = collect($allVehicles)->firstWhere('key', $data['vehicle_type']);
        $verifiedPrice = $vehicleData
            ? (int) round($data['distance_km'] * $vehicleData['rate_per_km'])
            : (int) $data['price'];

        $reference = 'TRANSFER-' . strtoupper(bin2hex(random_bytes(5)));

        Transfer::create([
            'vehicle_type'      => $data['vehicle_type'],
            'vehicle_name'      => $data['vehicle_name'],
            'amount'            => $verifiedPrice,
            'distance_km'       => $data['distance_km'],
            'pickup_location'   => $data['pickup_location'],
            'dropoff_location'  => $data['dropoff_location'],
            'full_name'         => $data['full_name'],
            'email'             => $data['email'],
            'phone_number'      => $data['phone_number'],
            'passengers'        => $data['passengers'],
            'flight_number'     => $data['flight_number']    ?? null,
            'special_requests'  => $data['special_requests'] ?? null,
            'pickup_date'       => $data['pickup_date'],
            'pickup_time'       => $data['pickup_time'],
            'payment_option'    => $data['payment_option'],
            'payment_reference' => $reference,
            'payment_status'    => 'pending',
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount:         $verifiedPrice,
            email:          $data['email'],
            phone:          $data['phone_number'],
            customerName:   $data['full_name'],
            reference:      $reference,
            product_title:  'Transfer — ' . $data['vehicle_name'] . ' (' . $data['distance_km'] . ' km)',
            callback_route: 'transfer.budpay.callback',
            cancel_route:   'carhire.index',
            seerbit_route:  'transfer.seerbit.callback',
        );
    }

    public function budpayCallbackTransfer(Request $request)
    {
        return $this->handleBudpayCallback(
            request:      $request,
            model:        Transfer::class,
            product_type: 'transfer',
            fail_route:   'carhire.index',
            success_route:'transfer.success',
        );
    }

    public function seerbitCallbackTransfer(Request $request)
    {
        return $this->handleSeerbitCallback(
            request:      $request,
            model:        Transfer::class,
            product_type: 'transfer',
            fail_route:   'carhire.index',
            success_route:'transfer.success',
        );
    }

    public function successTransfer()
    {
        return view('carhire.success')
            ->with('success', session('success', 'Your Transfer booking was confirmed!'));
    }

    /*
    |==========================================================================
    |  PAYMENT LAUNCHER
    |==========================================================================
    */

    private function launchPayment(
        string $payment_option,
        float  $amount,
        string $email,
        string $phone,
        string $customerName,
        string $reference,
        string $product_title,
        string $callback_route,
        string $cancel_route,
        string $seerbit_route
    ) {
        if ($payment_option === 'seerbit') {
            return $this->launchSeerbitPayment(
                amount:         $amount,
                email:          $email,
                phone:          $phone,
                customerName:   $customerName,
                reference:      $reference,
                product_title:  $product_title,
                seerbit_route:  $seerbit_route,
            );
        }

        // ── BudPay ──
        $publicKey   = env('BUDPAY_PUBLIC_KEY');
        $callbackUrl = route($callback_route);
        $cancelUrl   = route($cancel_route);
        $firstName   = explode(' ', $customerName)[0];
        $lastName    = explode(' ', $customerName)[1] ?? '';

        return response()->make('
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Redirecting to BudPay</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <script src="https://inlinepay.budpay.com/budpay-inline-custom.js"></script>
                <style>
                    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
                    body { font-family: "DM Sans", "Segoe UI", Arial, sans-serif; background: #f7f6f2; display: flex; align-items: center; justify-content: center; height: 100vh; }
                    .payment-card { background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 48px 36px; max-width: 420px; width: 100%; text-align: center; animation: fadeIn 0.5s ease-in-out; }
                    .logo-bar img { height: 32px; margin-bottom: 24px; }
                    h2 { font-size: 1.25rem; color: #1a1a1a; margin-bottom: 6px; }
                    .sub { color: #777; font-size: 0.875rem; margin-bottom: 24px; }
                    .amount-box { font-size: 2rem; font-weight: 700; color: #0d1883; margin-bottom: 28px; }
                    #payBtn { background: linear-gradient(135deg, #0d1883, #2d39b6); color: #fff; border: none; border-radius: 12px; padding: 14px 28px; font-size: 0.95rem; font-weight: 600; cursor: pointer; width: 100%; transition: background 0.2s, transform 0.15s; }
                    #payBtn:hover { background: #0b1570; transform: translateY(-1px); }
                    #payBtn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
                    .loader { display: none; margin: 16px auto 0; border: 3px solid #eee; border-top-color: #0d1883; border-radius: 50%; width: 28px; height: 28px; animation: spin 0.8s linear infinite; }
                    .secure-note { margin-top: 18px; font-size: 0.8rem; color: #aaa; }
                    @keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
                    @keyframes spin   { to { transform:rotate(360deg); } }
                </style>
            </head>
            <body>
                <div class="payment-card">
                    <div class="logo-bar">
                        <img src="https://travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="TravelWheel Logo">
                    </div>
                    <h2>Complete Your Payment</h2>
                    <p class="sub">You are about to pay for <strong>' . $product_title . '</strong></p>
                    <div class="amount-box">₦' . number_format($amount) . '</div>
                    <button id="payBtn">Proceed to Pay Securely</button>
                    <div class="loader" id="loader"></div>
                    <p class="secure-note">🔒 Secured by BudPay · NGN payment</p>
                </div>
                <script>
                    const payBtn = document.getElementById("payBtn");
                    const loader = document.getElementById("loader");
                    payBtn.addEventListener("click", function () {
                        loader.style.display = "block";
                        payBtn.disabled = true;
                        payBtn.textContent = "Launching...";
                        BudPayCheckout({
                            key:          "' . $publicKey . '",
                            email:        "' . $email . '",
                            amount:       "' . $amount . '",
                            first_name:   "' . $firstName . '",
                            last_name:    "' . $lastName . '",
                            currency:     "NGN",
                            reference:    "' . $reference . '",
                            callback_url: "' . $callbackUrl . '",
                            onSuccess: function (res) {
                                window.location.href = "' . $callbackUrl . '?reference=" + res.reference;
                            },
                            onClose: function () {
                                loader.style.display = "none";
                                payBtn.disabled = false;
                                payBtn.textContent = "Proceed to Pay Securely";
                                window.location.href = "' . $cancelUrl . '?payment=cancelled";
                            }
                        });
                    });
                </script>
            </body>
            </html>
        ');
    }

    private function launchSeerbitPayment(
        float  $amount,
        string $email,
        string $phone,
        string $customerName,
        string $reference,
        string $product_title,
        string $seerbit_route
    ) {
        try {
            $callbackUrl = route($seerbit_route);
            $payload = [
                'amount'             => $amount,
                'callbackUrl'        => $callbackUrl,
                'country'            => 'NG',
                'currency'           => 'NGN',
                'email'              => $email,
                'client_name'        => $customerName,
                'paymentReference'   => $reference,
                'productDescription' => $product_title,
                'productId'          => 'PRD' . $reference,
            ];
            $response = SeerBit::Standard()->Initialize($payload);
            if (isset($response['data']['payments']['redirectLink']) && !empty($response['data']['payments']['redirectLink'])) {
                return redirect($response['data']['payments']['redirectLink']);
            }
            Log::error('SeerBit Init Failed', ['reference' => $reference, 'response' => $response]);
            return back()->with('error', 'Unable to start SeerBit payment. Please try again.');
        } catch (\Exception $e) {
            Log::error('SeerBit Init Exception', ['reference' => $reference, 'error' => $e->getMessage()]);
            return back()->with('error', 'SeerBit Error: ' . $e->getMessage());
        }
    }

    /*
    |==========================================================================
    | CALLBACK HANDLERS
    |==========================================================================
    */

    private function handleBudpayCallback(
        Request $request,
        string  $model,
        string  $product_type,
        string  $fail_route,
        string  $success_route
    ) {
        $reference = $request->query('reference');

        if (!$reference) {
            Log::warning($product_type . ' BudPay Callback: Missing reference.', ['url' => $request->fullUrl()]);
            return redirect()->route($fail_route)->with('error', 'Missing payment reference. Please contact support.');
        }

        try {
            $verify = Http::withToken(env('BUDPAY_SECRET_KEY'))
                ->get("https://api.budpay.com/api/v2/transaction/verify/{$reference}");

            if ($verify->failed()) {
                Log::error($product_type . ' BudPay Verify Failed', [
                    'reference' => $reference,
                    'status'    => $verify->status(),
                    'body'      => $verify->body(),
                ]);
                return redirect()->route($fail_route)->with('error', 'Payment gateway error. Please contact support.');
            }

            $data      = $verify->json();
            $txnStatus = $data['data']['transaction_status'] ?? $data['data']['status'] ?? null;

            Log::info($product_type . ' BudPay Verify Response', ['reference' => $reference, 'status' => $txnStatus]);

            if (!in_array($txnStatus, ['success', 'completed'])) {
                return redirect()->route($fail_route)
                    ->with('error', 'Payment was not completed. Status: ' . ($txnStatus ?? 'Unknown'));
            }

            $record = $model::where('payment_reference', $reference)->first();

            if (!$record) {
                Log::error($product_type . ' BudPay: No record found.', ['reference' => $reference]);
                return redirect()->route($fail_route)->with('error', 'Payment received but booking not found. Please contact support.');
            }

            if ($record->payment_status !== 'paid') {
                $record->update(['payment_status' => 'paid']);
                $this->sendMails($record, $product_type);
                Log::info($product_type . ' marked paid (BudPay).', ['reference' => $reference]);
            } else {
                Log::warning($product_type . ' BudPay: Duplicate callback.', ['reference' => $reference]);
            }

            $successMessage = $product_type === 'car_hire'
                ? 'Car Hire booking confirmed! Your vehicle is reserved.'
                : 'Transfer booking confirmed! Your vehicle is reserved.';

            return redirect()->route($success_route)->with('success', $successMessage);

        } catch (\Exception $e) {
            Log::error($product_type . ' BudPay Callback Exception', [
                'reference' => $reference,
                'error'     => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ]);
            return redirect()->route($fail_route)->with('error', 'Error verifying payment. Please contact support.');
        }
    }

    private function handleSeerbitCallback(
        Request $request,
        string  $model,
        string  $product_type,
        string  $fail_route,
        string  $success_route
    ) {
        $reference = $request->query('reference');
        $message   = $request->query('message');

        Log::info($product_type . ' SeerBit Callback', ['reference' => $reference, 'message' => $message]);

        if (strtolower($message) !== 'successful') {
            Log::error($product_type . ' SeerBit: Payment not successful.', ['reference' => $reference, 'message' => $message]);
            return redirect()->route($fail_route)->with('error', 'Payment failed or was cancelled. Please try again.');
        }

        $record = $model::where('payment_reference', $reference)->first();

        if (!$record) {
            Log::error($product_type . ' SeerBit: No record found.', ['reference' => $reference]);
            return redirect()->route($fail_route)->with('error', 'Payment received but booking not found. Please contact support.');
        }

        if ($record->payment_status !== 'paid') {
            $record->update(['payment_status' => 'paid']);
            $this->sendMails($record, $product_type);
            Log::info($product_type . ' marked paid (SeerBit).', ['reference' => $reference]);
        } else {
            Log::warning($product_type . ' SeerBit: Duplicate callback.', ['reference' => $reference]);
        }

        $successMessage = $product_type === 'car_hire'
            ? 'Car Hire booking confirmed! Your vehicle is reserved.'
            : 'Transfer booking confirmed! Your vehicle is reserved.';

        return redirect()->route($success_route)->with('success', $successMessage);
    }

    private function sendMails($record, string $product_type): void
    {
        $supportMail = 'damilola@travelwheel.ng';

        try {
            switch ($product_type) {

                case 'car_hire':
                    Mail::to($record->email)
                        ->send(new \App\Mail\CarHireSuccessMail($record));

                    Mail::to($supportMail)
                        ->send(new \App\Mail\CarHireNotificationMail($record));
                    break;

                case 'transfer':
                    Mail::to($record->email)
                        ->send(new \App\Mail\TransferSuccessMail($record));

                    Mail::to($supportMail)
                        ->send(new \App\Mail\TransferNotificationMail($record));
                    break;

                default:
                    Log::warning('sendMails: unknown product_type', ['product_type' => $product_type]);
                    break;
            }

        } catch (\Exception $e) {
            // Log mail failure but never crash the callback — payment is already confirmed
            Log::error('Mail Error for ' . $product_type, [
                'reference' => $record->payment_reference ?? 'unknown',
                'error'     => $e->getMessage(),
            ]);
        }
    }
}
