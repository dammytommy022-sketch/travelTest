<?php

namespace App\Http\Controllers;

use PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingReceiptMail;
use App\Mail\BookingNotificationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use SeerbitLaravel\Facades\Seerbit;
use App\Models\Hotel;
use Illuminate\Support\Facades\Cache;

class HotelController extends Controller
{
    
    public function hotel(){
        return view('air.hotel.hotel');
    }
    
public function hotelAutocomplete(Request $request)
{
    $query = $request->input('query', 'ber');

    // ✅ CACHE AUTOCOMPLETE RESULTS FOR 1 HOUR
    $cacheKey = "hotel_autocomplete_" . md5($query);
    $autocompleteResults = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($query) {
        $client = new Client(['timeout' => 10]); // Define Guzzle client inside cache function
        $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c";
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Basic " . base64_encode($apiKey),
        ];
        $body = [
            'query' => $query,
            'language' => 'en',
        ];

        try {
            $response = $client->post('https://api.worldota.net/api/b2b/v3/search/multicomplete/', [
                'headers' => $headers,
                'json' => $body,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            Log::error('Failed to fetch autocomplete results: ' . $e->getMessage());
            return null;
        }
    });

    // ✅ HANDLE CASE WHERE NO RESULTS ARE FOUND
    if (!$autocompleteResults) {
        return response()->json(['error' => 'No autocomplete results found'], 404);
    }

    return response()->json($autocompleteResults);
}



    public function hotelpost(Request $request)
    {
        
        set_time_limit(600);
        $hotels = $request->all();
        dd($hotels);
        // Pass the filtered hotels to the view
        return view('hotels.search_results', ['hotels' => $hotels]);
    }

public function posthotelid(Request $request)
{
 
    $regionID = array_map('trim', explode(',', $request['hotel_regionID']))[1];

    $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c";
    $header = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        'Authorization' => "Basic " . base64_encode($apiKey),
    ];

    if ($regionID === "region") {
        // ✅ CACHE REGION SEARCH RESULTS FOR 1 HOUR
        $body = [
            'checkin' => date('Y-m-d', strtotime($request['check-in'])),
            'checkout' => date('Y-m-d', strtotime($request['check-out'])),
            'residency' => 'gb',
            'language' => 'en',
            'guests' => json_decode($request->input('guestse'), true),
            'region_id' => (int)explode(',', $request['hotel_regionID'])[0],
            'currency' => "NGN"
        ];

        $cacheKey = "search_results_" . md5(json_encode($body));
        $hotelList = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($header, $body) {
            $client = new Client(['timeout' => 30]); // ✅ Define $client inside closure
            $response = $client->post('https://api.worldota.net/api/b2b/v3/search/serp/region/', [
                'headers' => $header,
                'json' => $body,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        });

        if (session()->has('hotelList')) {
            session()->forget('hotelList');
            session()->forget('requestData');
        }
        session(['hotelList' => $hotelList]);
        session(['requestData' => $request->all()]);

        // ✅ PAGINATION (15 Hotels Per Page)
        $perPage = 15;
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $perPage;

        $hotelsForPage = array_slice($hotelList['data']['hotels'], $offset, $perPage);
        $hotelImages = $this->getHotelImages($hotelsForPage);

        $paginatedHotels = new LengthAwarePaginator($hotelsForPage, count($hotelList['data']['hotels']), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('air.hotel.list', [
            'requestData' => $request->all(),
            'paginatedHotels' => $paginatedHotels,
            'hotelImages' => $hotelImages
        ]);

    } else {
        // ✅ CACHE HOTEL INFO FOR 2 HOURS
        $hotelname = explode(',', $request['hotel_regionID'])[0];
        $body = [
            'id' => $hotelname,
            'language' => 'en'
        ];

        $cacheKey = "hotel_info_" . $hotelname;
        $hotelInfo = Cache::remember($cacheKey, now()->addHours(2), function () use ($header, $body) {
            $client = new Client(['timeout' => 30]); // ✅ Define $client inside closure
            $response = $client->post('https://api.worldota.net/api/b2b/v3/hotel/info/', [
                'headers' => $header,
                'json' => $body,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        });

        if (session()->has('hotel_info')) {
            session()->forget('hotel_info');
        }
        session()->put('hotel_info', $hotelInfo);

        // ✅ CACHE HOTEL PRICES & AVAILABILITY FOR 30 MINUTES
        $requestData = [
            "checkin" => date('Y-m-d', strtotime($request['check-in'])),
            "checkout" => date('Y-m-d', strtotime($request['check-out'])),
            "residency" => "gb",
            "language" => "en",
            "guests" => json_decode($request->input('guestse'), true),
            "id" => $hotelname,
            "currency" => "NGN"
        ];

        $cacheKey = "hotel_hp_" . md5(json_encode($requestData));
        $hotelRates = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($header, $requestData) {
            $client = new Client(['timeout' => 30]); // ✅ Define $client inside closure
            $response = $client->post('https://api.worldota.net/api/b2b/v3/search/hp/', [
                'headers' => $header,
                'json' => $requestData,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        });

        $hotelRates = $hotelRates['data']['hotels'];
        $groupedRates = [];

        foreach ($hotelRates as $hotel) {
            foreach ($hotel['rates'] as $rate) {
                $roomName = $rate['room_data_trans']['main_name'] ?? 'Unknown Room';
                $groupedRates[$roomName][] = $rate;
            }
        }
        

        return view('air.hotel.detail', [
            'requestData' => $request->all(),
            'hotelinfo' => $hotelInfo,
            'hotelRates' => $groupedRates,
            'data' => $requestData,
        ]);
    }
}



public function getHotelInfo(Request $request)
{
  
   // $hotelname = "test_hotel_do_not_book";
   $hotelname = $request->query('hotel');

    // ✅ CACHE HOTEL INFO FROM DB FOR 10 MINUTES
    $hoteldb = Cache::remember("hotel_$hotelname", now()->addMinutes(10), function () use ($hotelname) {
        return Hotel::find($hotelname);
    });

    if (!$hoteldb) {
        return response()->json(['error' => 'Hotel not found'], 404);
    }

    // ✅ CACHE HOTEL INFO FROM API FOR 2 HOURS
    $cacheKey = "hotel_info_" . $hotelname;
    $hotelInfo = Cache::remember($cacheKey, now()->addHours(2), function () use ($hotelname) {
        $client = new Client(['timeout' => 30]); // ✅ Define client inside closure
        $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c";
        $header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Basic " . base64_encode($apiKey),
        ];
        $body = ['id' => $hotelname, 'language' => 'en'];

        try {
            $response = $client->post('https://api.worldota.net/api/b2b/v3/hotel/info/', [
                'headers' => $header,
                'json' => $body,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            Log::error('Failed to fetch hotel info: ' . $e->getMessage());
            return null;
        }
    });

      if (session()->has('hotel_info')) {
                session()->forget('hotel_info'); // Destroy the existing session
            }
            session()->put('hotel_info', $hotelInfo);

    // ✅ CACHE HOTEL PRICES & AVAILABILITY FOR 30 MINUTES
    $requestData = [
        "checkin" => date('Y-m-d', strtotime($request['check-in'])),
        "checkout" => date('Y-m-d', strtotime($request['check-out'])),
        "residency" => "gb",
        "language" => "en",
        "guests" => json_decode($request->input('guestse'), true),
        "id" => $hotelname,
        "currency" => "NGN"
    ];

    $cacheKey = "hotel_hp_" . md5(json_encode($requestData));
    $hotelRates = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($requestData) {
        $client = new Client(['timeout' => 30]); // ✅ Define client inside closure
        $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c";
        $header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Basic " . base64_encode($apiKey),
        ];

        try {
            $response = $client->post('https://api.worldota.net/api/b2b/v3/search/hp/', [
                'headers' => $header,
                'json' => $requestData,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            Log::error('Failed to fetch hotel rates: ' . $e->getMessage());
            return null;
        }
    });

    if (!$hotelRates || empty($hotelRates['data']['hotels'])) {
        return response()->json(['error' => 'No rates available for this hotel'], 404);
    }

    // ✅ GROUP RATES BY ROOM TYPE
    $hotelRates = $hotelRates['data']['hotels'];
    $groupedRates = [];
    foreach ($hotelRates as $hotel) {
        foreach ($hotel['rates'] as $rate) {
            $roomName = $rate['room_data_trans']['main_name'] ?? 'Unknown Room';
            $groupedRates[$roomName][] = $rate;
        }
    }
    


    return view('air.hotel.detail', [
        'requestData' => $request->all(),
        'hotelinfo' => $hotelInfo,
        'hotelRates' => $groupedRates,
        'data' => $requestData,
        'hoteldb' => $hoteldb // ✅ Sending cached DB info to frontend
    ]);
}





    private function getHotelImages($hotels)
    {
        $client = new Client();
        $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c"; // Replace with your actual API key if needed
        $header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Basic " . base64_encode($apiKey),
        ];
        $hotelImages = [];

        foreach ($hotels as $hotel) {
            $hotelId = $hotel['id']; // Adjust to match the key in your API response

            $body = [
                'id' => $hotelId,
                'language' => 'en',
            ];

            try {
                $response = $client->post('https://api.worldota.net/api/b2b/v3/hotel/info/', [
                    'headers' => $header,
                    'json' => $body,
                ]);

                $hotelInfo = json_decode($response->getBody()->getContents(), true);
                Log::info('Hotel Info for hotel ' . $hotelId . ': ' . print_r($hotelInfo, true));
                $hotelImages[$hotelId] = $hotelInfo['data'] ?? []; // Adjust based on API response structure

            } catch (RequestException $e) {
                Log::error('Failed to fetch images for hotel ' . $hotelId . ': ' . $e->getMessage());
            }
        }

        return $hotelImages;
    }







  public function prebook(Request $request)
    {
        $userData = $request->query('data');
        $client = new Client(['timeout' => 60]);
        $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c"; // Replace with your actual API key if needed
        $header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Basic " . base64_encode($apiKey),
        ];

        // Data from your frontend or backend to pass into the prebook request
        $body = [
            "hash" => $request->query('token'),
        ];

        try {
            // First API Call: Get hotel info
            $response = $client->post('https://api.worldota.net/api/b2b/v3/hotel/prebook', [
                'headers' => $header,
                'json' => $body,
            ]);

            $responseData = json_decode($response->getBody(), true);
            
            // Handle the response
            if ($responseData['status'] === 'ok') {
                //dd($userData, $responseData);
               
                return view('air.hotel.book', ['data' => $responseData['data'], 'user' => $userData]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Prebook failed',
                    'error' => $responseData['error']
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while prebooking.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
   
    
public function filterHotels(Request $request)
{
    // Dump all request data for debugging
   // dump('Filter request data: ', $request->all());

    // Retrieve filter inputs
    $priceRange1 = $request->input('min', null);
    $priceRange2 = $request->input('max', null);
    $starRating = $request->input('star_rating', null);
    $mealType = $request->input('meal_type', null);
    $roomType = $request->input('room_type', null);
    $hotelName = $request->input('hotel_name', null);
    $sortBy = $request->input('sort_by', null);


    // Fetch original hotel list data
    $hotelList = session('hotelList'); // Assume you stored hotel data in session earlier
    $hotels = $hotelList['data']['hotels'];

    // Apply filters
    $filteredHotels = array_filter($hotels, function ($hotel) use ($priceRange1, $priceRange2, $starRating, $mealType, $roomType, $hotelName) {
        $hotelPrice = floatval($hotel['rates'][0]['payment_options']['payment_types'][0]['show_amount']); // Convert hotel price to float

        // Check if price range is set and apply filtering accordingly
        $priceMatch = true; // Default to true if no price range is set
        if (!empty($priceRange1) && !empty($priceRange2)) {
            $priceMatch = ($hotelPrice >= floatval($priceRange1) && $hotelPrice <= floatval($priceRange2));
        } elseif (!empty($priceRange1)) {
            $priceMatch = ($hotelPrice >= floatval($priceRange1)); // Only minimum price is set
        } elseif (!empty($priceRange2)) {
            $priceMatch = ($hotelPrice <= floatval($priceRange2)); // Only maximum price is set
        }

      
        $starMatch = !$starRating || $hotel['rates'][0]['rg_ext']['class'] == $starRating;
        $mealMatch = !$mealType || $hotel['rates'][0]['meal'] == $mealType;
        $roomMatch = !$roomType || strpos(strtolower($hotel['rates'][0]['room_name']), strtolower($roomType)) !== false;

        $normalizedHotelName = str_replace('_', ' ', strtolower($hotel['id']));
        $normalizedInputName = strtolower($hotelName);
        $similarity = 0;
        similar_text($normalizedHotelName, $normalizedInputName, $similarity);
        $nameMatch = !$hotelName || strpos($normalizedHotelName, $normalizedInputName) !== false || $similarity >= 70;

          return $priceMatch && $starMatch && $mealMatch && $roomMatch && $nameMatch;
    });



    // Apply sorting
    if ($sortBy !== "popularity") {
        usort($filteredHotels, function ($a, $b) use ($sortBy) {
            switch ($sortBy) {
                case 'popularity':
                    return $a['popularity'] <=> $b['popularity'];
                case 'low_to_high':
                    return floatval($a['rates'][0]['payment_options']['payment_types'][0]['show_amount']) <=> floatval($b['rates'][0]['payment_options']['payment_types'][0]['show_amount']);
                case 'high_to_low':
                    return floatval($b['rates'][0]['payment_options']['payment_types'][0]['show_amount']) <=> floatval($a['rates'][0]['payment_options']['payment_types'][0]['show_amount']);
                case 'star_rating':
                    return $b['star_rating'] <=> $a['star_rating'];
                default:
                    return 0;
            }
        });
    }

    // Paginate filtered results
    $perPage = 15;
    $page = $request->get('page', 1);
    $offset = ($page - 1) * $perPage;
    $hotelsForPage = array_slice($filteredHotels, $offset, $perPage);

    $hotelImages = $this->getHotelImages($hotelsForPage);

    $paginatedHotels = new LengthAwarePaginator($hotelsForPage, count($filteredHotels), $perPage, $page, [
        'path' => $request->url(),
        'query' => $request->query(),
    ]);
    $requestData = session('requestData');

    //dd('Final paginated hotels: ', $paginatedHotels);

    return view('air.hotel.list', [
        'paginatedHotels' => $paginatedHotels,
        'hotelImages' => $hotelImages,
        'filters' => $request->all(), // Keep track of applied filters
        'requestData' => $requestData
    ]);
}


public function checkout(Request $request)
    {
       if (session()->has('hotel_info')) {
          try {
            // Generate a unique transaction reference
            $uuid = bin2hex(random_bytes(6));
           
            $transaction_ref = 'TWH-' . strtoupper(trim($uuid));

            // Define the payment payload to be sent to SeerBit
            $payload = [
                "amount" => $request->input('amount'), // Amount from the form
                "callbackUrl" => route('prebook.submit'), // The route to handle payment success
                "country" => $request->input('country'), // Country from the form
                "currency" => $request->input('currency'), // Currency from the form
                "email" => $request->input('email'), // Customer email from the form
                "paymentReference" => $transaction_ref, // Unique transaction reference
                "productDescription" => "Hotel Booking", // Description for the payment
                "productId" => $transaction_ref, // Product ID, same as transaction reference
                "tokenize" => true // Optional: Allow tokenization
            ];
        if (session()->has('payment_payload')) {
                session()->forget('payment_payload'); // Destroy the existing session
                session()->forget('transaction_ref');
            }
            // Store payment payload in session (optional, if you want to use it later)
            session()->put('payment_payload', $request->all());
            session()->put('transaction_ref', $transaction_ref);
             
            // Initialize the payment with the SeerBit API
            $trans = Seerbit::standard()->initialize($payload);
           
            // Get the redirect link from SeerBit
            $redirectLink = $trans['data']['payments']['redirectLink'];

            // If the redirect link is valid, redirect the user to SeerBit
            if (!empty($redirectLink)) {
                return Redirect::away($redirectLink)->with("status", $trans['data']['message']);
            } else {
                // Something went wrong, return back with error
                return redirect()->back()->with('error', $trans['data']['message']);
            }

            } catch (\Exception $e) {
                // Handle exception if payment initiation fails
                return redirect()->back()->with('error', 'Failed to initiate payment: ' . $e->getMessage());
            }  
       }  
       else{
            return redirect()->route('air.hotel');
       }
       
    }
    
   public function bookhotel(Request $request)
{
    $details = session('requestData');
    $hotel = session('hotel_info');
    $transaction_ref = session('transaction_ref');
    $requestbody = session('payment_payload');
    $client = new Client();
    $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c";
    $header = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        'Authorization' => "Basic " . base64_encode($apiKey),
    ];
    //dd($requestbody, $details, $hotel);
    $partnerOrderId = Uuid::uuid4()->toString(); // Unique order ID

    /**
     * 1️⃣ Call Order Booking Form API
     */
    $orderBookingFormBody = [
        'partner_order_id' => $partnerOrderId,
        'book_hash' => $requestbody['token'],
        'language' => $requestbody['language'],
        'user_ip' => $request->ip(),
    ];

    try {
        $response = $client->post('https://api.worldota.net/api/b2b/v3/hotel/order/booking/form/', [
            'headers' => $header,
            'json' => $orderBookingFormBody
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($responseData['status'] === 'ok' && isset($responseData['data']['order_id'])) {
            
            $orderId = $responseData['data']['order_id']; // Needed for Order Booking Finish
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Order Booking Form failed',
                'error' => $responseData['error'] ?? 'Unknown error'
            ], 400);
        }

        /**
         * 2️⃣ Extract Guest Data from session('requestData')
         */
$guestData = json_decode($details['guestse'], true);
$rooms = [];

foreach ($guestData as $room) {
    $guests = [];

    // Add adults
    for ($i = 0; $i < $room['adults']; $i++) {
        $guests[] = [
            "first_name" => "Adult",
            "last_name" => "Ratehawk",
            "is_child" => false
        ];
    }

    // Add children with age
    foreach ($room['children'] as $age) {
        if ($age >= 0 && $age <= 17) { // Ensure age is within the allowed range
            $guests[] = [
                "first_name" => "Child",
                "last_name" => "Ratehawk",
                "is_child" => true,
                "age" => $age
            ];
        }
    }

    $rooms[] = ["guests" => $guests];
}


        /**
         * 3️⃣ Call Order Booking Finish API (FIXED STRUCTURE)
         */
        $orderBookingFinishBody = [
            "user" => [
                "email" => $requestbody['email'],
                "phone" => $requestbody['phone'],
                "comment" => "User booking"
            ],
            "supplier_data" => [
                "first_name_original" => "Guest",  // Placeholder
                "last_name_original" => "User",
                "phone" => $requestbody['phone'],
                "email" => $requestbody['email']
            ],
            "partner" => [
                "partner_order_id" => $partnerOrderId,
                "comment" => "Booking via API",
                  
            ],
            "language" => "en",
            "rooms" => $rooms,
            "payment_type" => [
                "type" => "deposit",
                "amount" => $requestbody['showamount'],
                "currency_code" => "USD"
            ],
            "return_path" => "https://test.travelwheel.ng/hotel/receipt" // Required
        ];

        $finishResponse = $client->post('https://api.worldota.net/api/b2b/v3/hotel/order/booking/finish/', [
            'headers' => $header,
            'json' => $orderBookingFinishBody
        ]);

        $finishData = json_decode($finishResponse->getBody(), true);

        if ($finishData['status'] !== 'processing') {
            return response()->json([
                'status' => 'error',
                'message' => 'Order Booking Finish failed',
                'error' => $finishData['error'] ?? 'Unknown error'
            ], 400);
        }

        /**
         * 4️⃣ Poll Order Booking Finish Status API Until Booking Completes
         */
        $pollingAttempts = 0;
        $maxAttempts = 10;
        $bookingConfirmed = false;

        while ($pollingAttempts < $maxAttempts) {
            sleep(5); // Wait 5 seconds before polling again

            $statusResponse = $client->post('https://api.worldota.net/api/b2b/v3/hotel/order/booking/finish/status/', [
                'headers' => $header,
                'json' => ["partner_order_id" => $partnerOrderId]
            ]);

            $statusData = json_decode($statusResponse->getBody(), true);

            if ($statusData['status'] === 'ok') {
                $bookingConfirmed = true;
                break;
            }

            $pollingAttempts++;
        }

        if (!$bookingConfirmed) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking confirmation timeout',
                'error' => 'The booking was not confirmed within the allowed time'
            ], 400);
        }

        /**
         * 5️⃣ Send Email & Save Booking Data in Database
         */
        $bookingDetails = $requestbody;
        $pdfData = PDF::loadView('air.hotel.emails.pdf', compact('bookingDetails','transaction_ref','hotel','details'))
                        ->setPaper('A4')
                        ->setOptions([
                            'isHtml5ParserEnabled' => true,
                            'isRemoteEnabled' => true,
                        ]);

        Mail::to($bookingDetails['email'])->send(new BookingReceiptMail($bookingDetails, $pdfData->output(), $transaction_ref, $hotel, $details));
        Mail::to('info@travelwheel.ng')->send(new BookingNotificationMail($bookingDetails));

        // Save to database
        DB::table('hotel_bookings')->insert([
            'partner_order_id' => $partnerOrderId,
            'user_email' => $bookingDetails['email'],
            'hotel_name' => $bookingDetails['hotel_id'],
            'trans_ref' => $transaction_ref,
            'room_type' => "Standard Room", // Default value since room type isn't clear in session
            'check_in_date' => $bookingDetails['checkin'],
            'check_out_date' => $bookingDetails['checkout'],
            'total_price' => $bookingDetails['amount'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Clear session
        session()->flush();

        return view('air.hotel.receipt', [
            'bookingDetails' => $bookingDetails,
            'details' => $details,
            'reference' => $transaction_ref,
            'hotel' => $hotel
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while booking.',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
