<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarHire;
use App\Models\Transfer;
use App\Models\TransportRate;
use App\Models\FleetCar;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SeerbitLaravel\Facades\Seerbit;

class CarController extends Controller
{
    public function index()
    {
        $categories       = $this->buildCategoriesFromDb();
        $transferVehicles = $this->buildTransferVehiclesFromDb();
        $typeThumbs       = $this->buildTypeThumbs($categories, $transferVehicles);

        return view('carhire.index', compact('categories', 'transferVehicles', 'typeThumbs'));
    }

    /*
    |==========================================================================
    | BUILD CATEGORIES FROM DATABASE  (Car Hire)
    | Reads base prices + fuel/hourly rates from transport_rates,
    | and every active model from fleet_cars (service_type = car_hire).
    |==========================================================================
    */
    private function buildCategoriesFromDb(): array
    {
        $vehicleTypes = ['saloon', 'suv', 'van', 'bus', 'luxury'];
        $rates        = TransportRate::whereIn('vehicle_type', $vehicleTypes)->get()->keyBy('vehicle_type');

        // All active car-hire fleet cars, grouped by vehicle_type then category
        $fleetCars = FleetCar::active()->forHire()->get()
            ->groupBy('vehicle_type');

        $categories = [];

        foreach ($vehicleTypes as $vtype) {
            $rate = $rates->get($vtype);

            $priceMap = [
                'Regular'   => $rate->price_regular   ?? 0,
                'Standard'  => $rate->price_standard  ?? 0,
                'Executive' => $rate->price_executive ?? 0,
            ];

            $carsForType = $fleetCars->get($vtype, collect());

            $items = [];
            foreach (['Regular', 'Standard', 'Executive'] as $catName) {
                $modelsInCat = $carsForType->where('category', $catName);

                // Passenger label: use the first model's stored value, fallback by type
                $passengers = $modelsInCat->first()->passengers
                    ?? $this->defaultPassengerLabel($vtype);

                $models = $modelsInCat->map(function ($car) use ($vtype) {
                    $hasImages = $car->images && count($car->images) > 0;
                    return [
                        'name'     => $car->car_name,
                        'image'    => $hasImages
                            ? asset('storage/' . $car->images[0])
                            : $this->defaultVehicleImage($vtype),
                        'images'   => $hasImages
                            ? collect($car->images)->map(fn($img) => asset('storage/' . $img))->all()
                            : [$this->defaultVehicleImage($vtype)],
                        'features' => $car->features ?? [],
                    ];
                })->values()->all();

                // Category-level images: use first model with real images, else SVG fallback (always renders)
                $catImages = $modelsInCat->first() && $modelsInCat->first()->images
                    ? collect($modelsInCat->first()->images)->map(fn($img) => asset('storage/' . $img))->all()
                    : [$this->defaultVehicleImage($vtype)];

                $items[] = [
                    'name'       => $catName,
                    'price'      => (int) $priceMap[$catName],
                    'passengers' => $passengers,
                    'images'     => $catImages,
                    'models'     => $models,
                ];
            }

            $categories[$vtype] = [
                'fuel_rate_per_km' => (int) ($rate->fuel_rate_per_km ?? 1300),
                'hourly_rate'      => (int) ($rate->hourly_rate ?? 0),
                'items'            => $items,
            ];
        }

        return $categories;
    }

    /*
    |==========================================================================
    | BUILD TRANSFER VEHICLES FROM DATABASE
    |==========================================================================
    */
    private function buildTransferVehiclesFromDb(): array
    {
        $vehicleTypes = ['saloon', 'suv', 'van', 'bus', 'luxury'];
        $rates        = TransportRate::whereIn('vehicle_type', $vehicleTypes)->get()->keyBy('vehicle_type');

        $fleetCars = FleetCar::active()->forTransfer()->get()->groupBy('vehicle_type');

        $transferVehicles = [];

        foreach ($vehicleTypes as $vtype) {
            $rate      = $rates->get($vtype);
            $ratePerKm = (int) ($rate->transfer_rate_per_km ?? 0);

            $carsForType = $fleetCars->get($vtype, collect());

            $thumbCar = $carsForType->first();
            $thumb    = $thumbCar && $thumbCar->images && count($thumbCar->images) > 0
                ? asset('storage/' . $thumbCar->images[0])
                : $this->defaultVehicleImage($vtype);

            $models = $carsForType->map(function ($car) use ($ratePerKm, $vtype) {
                $hasImages = $car->images && count($car->images) > 0;
                return [
                    'name'        => $car->car_name,
                    'rate_per_km' => $ratePerKm,
                    'passengers'  => $car->passengers ?? $this->defaultPassengerLabel($vtype),
                    'images'      => $hasImages
                        ? collect($car->images)->map(fn($img) => asset('storage/' . $img))->all()
                        : [$this->defaultVehicleImage($vtype)],
                    'features'    => $car->features ?? [],
                ];
            })->values()->all();

            $transferVehicles[$vtype] = [
                'thumb'  => $thumb,
                'models' => $models,
            ];
        }

        return $transferVehicles;
    }

    /*
    |==========================================================================
    | TYPE THUMBNAILS  — used in the sidebar vehicle-type list
    |==========================================================================
    */
    private function buildTypeThumbs(array $categories, array $transferVehicles): array
    {
        $thumbs = [];
        foreach (['saloon', 'suv', 'van', 'bus', 'luxury'] as $vtype) {
            // Prefer a real fleet image if one exists on either side, else the SVG fallback (always renders)
            $thumb = $categories[$vtype]['items'][0]['images'][0]
                ?? $transferVehicles[$vtype]['thumb']
                ?? $this->defaultVehicleImage($vtype);
            $thumbs[$vtype] = $thumb;
        }
        return $thumbs;
    }

    /*
    |==========================================================================
    | DEFAULT VEHICLE SVG ICONS  (inline data-URIs — always render, no file
    | dependency). Used whenever no admin-uploaded image exists for a model,
    | category, or vehicle type.
    |==========================================================================
    */
    private function defaultVehicleImage(string $vtype): string
    {
        $colors = [
            'saloon' => '#0d1883',
            'suv'    => '#1a5d8f',
            'van'    => '#1a7a4e',
            'bus'    => '#b07000',
            'luxury' => '#7a1f8f',
        ];
        $color = $colors[$vtype] ?? '#0d1883';

        $svg = match ($vtype) {
            'saloon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><rect width="200" height="100" fill="#eef1ff"/><path d="M30 65 L40 40 Q45 32 60 32 L140 32 Q155 32 160 40 L170 65 L170 75 L30 75 Z" fill="' . $color . '" opacity="0.85"/><circle cx="55" cy="75" r="11" fill="#1a1a1a"/><circle cx="145" cy="75" r="11" fill="#1a1a1a"/><rect x="55" y="38" width="90" height="22" rx="4" fill="#cdd6ff" opacity="0.7"/></svg>',
            'suv' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><rect width="200" height="100" fill="#eaf2f8"/><path d="M28 62 L35 35 Q40 28 55 28 L145 28 Q160 28 165 35 L172 62 L172 76 L28 76 Z" fill="' . $color . '" opacity="0.85"/><circle cx="55" cy="76" r="12" fill="#1a1a1a"/><circle cx="145" cy="76" r="12" fill="#1a1a1a"/><rect x="48" y="34" width="104" height="24" rx="4" fill="#c8e0ee" opacity="0.7"/></svg>',
            'van' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><rect width="200" height="100" fill="#e8f8f0"/><path d="M25 30 Q25 22 35 22 L155 22 Q170 22 170 35 L170 70 L25 70 Z" fill="' . $color . '" opacity="0.85"/><circle cx="55" cy="74" r="11" fill="#1a1a1a"/><circle cx="145" cy="74" r="11" fill="#1a1a1a"/><rect x="32" y="28" width="40" height="26" rx="3" fill="#bfeed4" opacity="0.7"/></svg>',
            'bus' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><rect width="200" height="100" fill="#fff6e3"/><rect x="20" y="20" width="160" height="48" rx="6" fill="' . $color . '" opacity="0.85"/><circle cx="50" cy="72" r="11" fill="#1a1a1a"/><circle cx="150" cy="72" r="11" fill="#1a1a1a"/><rect x="28" y="28" width="28" height="18" rx="2" fill="#fde6b0" opacity="0.8"/><rect x="60" y="28" width="28" height="18" rx="2" fill="#fde6b0" opacity="0.8"/><rect x="92" y="28" width="28" height="18" rx="2" fill="#fde6b0" opacity="0.8"/><rect x="124" y="28" width="28" height="18" rx="2" fill="#fde6b0" opacity="0.8"/></svg>',
            'luxury' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><rect width="200" height="100" fill="#f5eaf8"/><path d="M22 64 L34 38 Q40 30 58 30 L150 30 Q165 32 172 42 L178 64 L178 76 L22 76 Z" fill="' . $color . '" opacity="0.85"/><circle cx="55" cy="76" r="11" fill="#1a1a1a"/><circle cx="148" cy="76" r="11" fill="#1a1a1a"/><rect x="58" y="36" width="100" height="22" rx="4" fill="#e3c8ee" opacity="0.7"/></svg>',
            default => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><rect width="200" height="100" fill="#eef1ff"/><circle cx="100" cy="50" r="30" fill="' . $color . '" opacity="0.6"/></svg>',
        };

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    private function defaultPassengerLabel(string $vtype): string
    {
        return match ($vtype) {
            'saloon' => '1 – 3 Passengers',
            'suv'    => '1 – 3 Passengers',
            'van'    => 'Up to 5 Passengers',
            'bus'    => 'Up to 12 Passengers',
            'luxury' => '1 – 4 Passengers',
            default  => '1 – 3 Passengers',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE DATA HELPERS  (server-side price verification only)
    | Now reads from the database instead of hardcoded arrays, so admin
    | rate changes are always enforced server-side too.
    |--------------------------------------------------------------------------
    */
    private function categoriesData(): array
    {
        $rates = TransportRate::get()->keyBy('vehicle_type');
        $data  = [];

        foreach (['saloon', 'suv', 'van', 'bus', 'luxury'] as $vtype) {
            $r = $rates->get($vtype);
            $data[$vtype] = [
                'fuel_rate_per_km' => (int) ($r->fuel_rate_per_km ?? 1300),
                'hourly_rate'      => (int) ($r->hourly_rate ?? 0),
                'items' => [
                    ['name' => 'Regular',   'price' => (int) ($r->price_regular   ?? 0)],
                    ['name' => 'Standard',  'price' => (int) ($r->price_standard  ?? 0)],
                    ['name' => 'Executive', 'price' => (int) ($r->price_executive ?? 0)],
                ],
            ];
        }

        return $data;
    }

    private function transferVehiclesData(): array
    {
        $rates = TransportRate::get()->keyBy('vehicle_type');
        $cars  = FleetCar::active()->forTransfer()->get();

        $data = [];
        foreach ($cars as $car) {
            $ratePerKm = (int) ($rates->get($car->vehicle_type)->transfer_rate_per_km ?? 0);
            $data[] = [
                'type'        => $car->vehicle_type,
                'name'        => $car->car_name,
                'rate_per_km' => $ratePerKm,
            ];
        }

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | GOOGLE MAPS DISTANCE PROXY
    |--------------------------------------------------------------------------
    */
    public function distance(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string|max:500',
            'destination' => 'required|string|max:500',
        ]);

        $apiKey = config('services.google.maps_key');
        if (!$apiKey) {
            return response()->json(['error' => 'Maps API not configured.'], 500);
        }

        $origin = ($request->filled('origin_lat') && $request->filled('origin_lng'))
            ? $request->origin_lat . ',' . $request->origin_lng
            : $request->origin;

        $destination = ($request->filled('dest_lat') && $request->filled('dest_lng'))
            ? $request->dest_lat . ',' . $request->dest_lng
            : $request->destination;

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins'      => $origin,
                'destinations' => $destination,
                'units'        => 'metric',
                'region'       => 'NG',
                'key'          => $apiKey,
            ]);

            $data = $response->json();

            if (($data['status'] ?? '') !== 'OK') {
                Log::warning('Google Maps Distance API error', ['status' => $data['status'] ?? 'unknown']);
                return response()->json(['error' => 'Google API error: ' . ($data['status'] ?? 'UNKNOWN')], 500);
            }

            $element = $data['rows'][0]['elements'][0] ?? null;
            if (!$element || ($element['status'] ?? '') !== 'OK') {
                return response()->json(['error' => 'No route found. Status: ' . ($element['status'] ?? 'N/A')], 400);
            }

            $distanceKm  = max(1, (int) ceil($element['distance']['value'] / 1000));
            $durationMins = (int) ceil($element['duration']['value'] / 60);
            $driveTime   = $durationMins >= 60
                ? floor($durationMins / 60) . 'h ' . ($durationMins % 60 > 0 ? ($durationMins % 60) . 'm' : '')
                : $durationMins . ' mins';

            return response()->json([
                'distance_km'   => $distanceKm,
                'distance_text' => $element['distance']['text'],
                'duration_text' => $element['duration']['text'],
                'drive_time'    => trim($driveTime),
            ]);

        } catch (\Exception $e) {
            Log::error('Google Maps Distance Exception', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Distance calculation failed. Please try again.'], 500);
        }
    }

    /*
    |==========================================================================
    | CAR HIRE — submit, callbacks, success
    |==========================================================================
    */
    public function submitCarHire(Request $request)
    {
        $data = $request->validate([
            'car_type'         => 'required|string',
            'category'         => 'required|string',
            'car_model'        => 'required|string|max:100',
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

        $allCats       = $this->categoriesData();
        $typeData      = $allCats[$data['car_type']] ?? null;
        $catItem       = collect($typeData['items'] ?? [])->firstWhere('name', $data['category']);
        $basePrice     = $catItem['price'] ?? 0;
        $verifiedPrice = $basePrice
            + ($data['distance_km'] * ($typeData['fuel_rate_per_km'] ?? 0))
            + ($data['rental_hours'] * ($typeData['hourly_rate'] ?? 0));

        $reference = 'CARHIRE-' . strtoupper(bin2hex(random_bytes(5)));

        CarHire::create([
            'car_type'          => $data['car_type'],
            'category'          => $data['category'],
            'car_model'         => $data['car_model'],
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
            product_title:  'Car Hire — ' . ucfirst($data['car_type']) . ' · ' . $data['category'] . ' · ' . $data['car_model'],
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
    | TRANSFER — submit, callbacks, success
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

        $allModels     = $this->transferVehiclesData();
        $modelData     = collect($allModels)->firstWhere('name', $data['vehicle_name']);
        $ratePerKm     = $modelData['rate_per_km'] ?? 0;
        $verifiedPrice = $ratePerKm > 0
            ? (int) round($data['distance_km'] * $ratePerKm)
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
    | SHARED PAYMENT LAUNCHER
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
                amount:        $amount,
                email:         $email,
                phone:         $phone,
                customerName:  $customerName,
                reference:     $reference,
                product_title: $product_title,
                seerbit_route: $seerbit_route,
            );
        }

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
                'amount' => (int) $amount,
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
    | SHARED CALLBACK HANDLERS
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
            return redirect()->route($fail_route)->with('error', 'Missing payment reference. Please contact support.');
        }

        try {
            $verify = Http::withToken(env('BUDPAY_SECRET_KEY'))
                ->get("https://api.budpay.com/api/v2/transaction/verify/{$reference}");

            if ($verify->failed()) {
                Log::error($product_type . ' BudPay Verify Failed', ['reference' => $reference]);
                return redirect()->route($fail_route)->with('error', 'Payment gateway error. Please contact support.');
            }

            $data      = $verify->json();
            $txnStatus = $data['data']['transaction_status'] ?? $data['data']['status'] ?? null;

            if (!in_array($txnStatus, ['success', 'completed'])) {
                return redirect()->route($fail_route)
                    ->with('error', 'Payment was not completed. Status: ' . ($txnStatus ?? 'Unknown'));
            }

            $record = $model::where('payment_reference', $reference)->first();

            if (!$record) {
                return redirect()->route($fail_route)->with('error', 'Payment received but booking not found. Please contact support.');
            }

            if ($record->payment_status !== 'paid') {
                $record->update(['payment_status' => 'paid']);
                $this->sendMails($record, $product_type);
            }

            $successMessage = $product_type === 'car_hire'
                ? 'Car Hire booking confirmed! Your vehicle is reserved.'
                : 'Transfer booking confirmed! Your vehicle is reserved.';

            return redirect()->route($success_route)->with('success', $successMessage);

        } catch (\Exception $e) {
            Log::error($product_type . ' BudPay Callback Exception', ['reference' => $reference, 'error' => $e->getMessage()]);
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

        if (strtolower($message) !== 'successful') {
            return redirect()->route($fail_route)->with('error', 'Payment failed or was cancelled. Please try again.');
        }

        $record = $model::where('payment_reference', $reference)->first();

        if (!$record) {
            return redirect()->route($fail_route)->with('error', 'Payment received but booking not found. Please contact support.');
        }

        if ($record->payment_status !== 'paid') {
            $record->update(['payment_status' => 'paid']);
            $this->sendMails($record, $product_type);
        }

        $successMessage = $product_type === 'car_hire'
            ? 'Car Hire booking confirmed! Your vehicle is reserved.'
            : 'Transfer booking confirmed! Your vehicle is reserved.';

        return redirect()->route($success_route)->with('success', $successMessage);
    }

    /*
    |==========================================================================
    | MAIL SENDER
    |==========================================================================
    */
    private function sendMails($record, string $product_type): void
    {
        $supportMail = 'damilola@travelwheel.ng';

        try {
            switch ($product_type) {
                case 'car_hire':
                    Mail::to($record->email)->send(new \App\Mail\CarHireSuccessMail($record));
                    Mail::to($supportMail)->send(new \App\Mail\CarHireNotificationMail($record));
                    break;
                case 'transfer':
                    Mail::to($record->email)->send(new \App\Mail\TransferSuccessMail($record));
                    Mail::to($supportMail)->send(new \App\Mail\TransferNotificationMail($record));
                    break;
                default:
                    Log::warning('sendMails: unknown product_type', ['product_type' => $product_type]);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Mail Error for ' . $product_type, [
                'reference' => $record->payment_reference ?? 'unknown',
                'error'     => $e->getMessage(),
            ]);
        }
    }
}