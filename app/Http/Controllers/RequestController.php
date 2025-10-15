<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use App\Models\InsuranceQuoteModel;
use App\Models\InsurancePurchaseModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use SeerbitLaravel\Facades\Seerbit;
use DateTime;
use App\Mail\RequestMail;
use App\Mail\RequestMailCopy;
use App\Mail\SupportFlightMail;
use App\Models\FlightrateModel;
use App\Models\Review;
use App\Models\FlightRequestModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



class RequestController extends Controller
{
    public function index()
    {
        try {
            $reviews = Review::where('is_approved', true)
                ->select('name', 'location', 'review_text', 'rating', 'service_type')
                ->get();

            return response()->json($reviews, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching reviews',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new review.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'service_type' => 'required|string|in:Flight Booking Service,Hotel Booking Service,Visa Assistance Service,Airport Lounge Service,Travel Insurance Service,Protocol Service',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $review = Review::create([
                'name' => $request->name,
                'location' => $request->location,
                'review_text' => $request->review_text,
                'rating' => $request->rating,
                'service_type' => $request->service_type,
                'is_approved' => true, // Reviews start as unapproved
            ]);

            return response()->json([
                'message' => 'Review submitted successfully',
                'review' => $review
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error submitting review',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function flight()
    {
        return view('air.request.flights'); 
    }

    public function policy()
    {
        return view('air.request.policy'); 
    }

    public function flightpost(Request $request)
    {

        $id = 1;
        $rate = FlightrateModel::where('id', $id)->first();
        $rates = $rate->usd; 
        $flightTrip = $request->input('trip');

        //dd($flightTrip);
        //return view('air.flight.flightsearch', compact('flightTrip'));

        if($request->input('trip') == "multi"){
            $data = $request->input();
            
            $departureArray = $data['from'];
            $depart1 = $data['from'][0];

            //dd($formattedDate );
            $numberOfDeparts = count($departureArray); // Assuming $numberOfDeparts is the number of departures

            if ($data['adults'] >= 1){
                $passengerCode = 'ADT';
                $passengerQty = intval($data['adults']);
            }
            elseif($data['childs'] >= 1){
                $passengerCode = 'CHD';
                $passengerQty = intval($data['childs']);
            }
            elseif($data['kids'] >= 1){
                $passengerCode = 'INF';
                $passengerQty = intval($data['kids']);
            }
            $allFlightData = [];

            for ($i = 0; $i < $numberOfDeparts; $i++) {

                $flightData = [];
                
                $date = new DateTime($data['depart'][$i] . " 00:00:00");
                $formattedDate = $date->format("Y-m-d\TH:i:s");
                $flightData["DepartureDateTime"] = $formattedDate;
                
                $originCodePart = explode(" - ", $data['from'][$i]);
                $originCode = $originCodePart[0];
                $flightData["OriginLocationCode"] = $originCode ;

                $destinationPart = explode(" - ", $data['to'][$i]);
                $destinationCode = $destinationPart[0];
                $flightData["DestinationLocationCode"] = $destinationCode;
                
                
                            
                $allFlightData[] = $flightData;
            
            }
            
            try {
                $client = new Client();
                $url = 'https://restapidemo.myfarebox.com/api/v1/multiCityFaresBETA/Search/Flight'; 
                $token = 'B0045EEC-34B4-4949-B9EA-0DE88D26B8B2-6328';
                $headers = [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ];
                
                $payload = [
                    'OriginDestinationInformations' => $allFlightData,
                    'TravelPreferences' => [
                        'MaxStopsQuantity' => 'All',
                        'CabinPreference' => $data['flight_type'],
                        'Preferences' => [
                            'CabinClassPreference' => [
                                'CabinType' => $data['flight_type'],
                                'PreferenceLevel' => 'Preferred',
                            ],
                        ],
                        'AirTripType' => 'OneWay',
                    ],
                    'PricingSourceType' => 'All',
                    'IsRefundable' => false,
                    'PassengerTypeQuantities' => [
                        [
                            'Code' => $passengerCode,
                            'Quantity' => $passengerQty,
                        ],
                    ],
                    'RequestOptions' => 'Fifty',
                    'Target' => 'Development',
                ];
                
                
                
                //dd($payload);
                //$jsonPayload = json_encode($payload);
    
                $response = $client->request('POST', $url, [
                    'headers' => $headers,
                    'json' => $payload,
                ]);
                // Get the status code
                $status_code = $response->getStatusCode();
    
                // Get the response body
                $response_body = $response->getBody()->getContents();
                
                $headers = $response->getHeaders();
                // Dump the status code and response body
                dd($status_code, $response_body, $headers);
                $body = $response->getBody();
                
                //dd($response->getStatusCode(), $response->getBody()->getContents());
                
                $quoteResponse = $response->getBody()->getContents();
                $data = json_decode($quoteResponse, true);
    
            }catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $response = $e->getResponse();
                    $statusCode = $response->getStatusCode();
                    $responseBody = $response->getBody();
                    // Handle the error response
                    // ...
                } else {
                    // Handle other request exceptions
                    // ...
                }
            }
    
        }
        else {
            
            $data = $request->input();
            //dd($data);
            $departure = $request->input('depart');
            $flyto = $request->input('to');
            $flyfrom = $request->input('from');
            $departDate = $departure[0];
            $date = new DateTime($departDate . " 00:00:00");
            $formattedDate = $date->format("Y-m-d\TH:i:s");
            $returnDate = new DateTime($data['returning'] . " 00:00:00");
            $returningDate = $returnDate->format("Y-m-d\TH:i:s");
            $destination = $flyto[0];
            $origin = $flyfrom[0];
            //dd($destination);
            // Using explode
            $destinationPart = explode(" - ", $destination);
            $originCodePart = explode(" - ", $origin);

            $destinationCode = $destinationPart[0];
            $destinationCode1 = $destinationPart[1];
            $destinationCode2 = $destinationPart[2];
            $originCode = $originCodePart[0];
            $originCode1 = $originCodePart[1];
            $originCode2 = $originCodePart[2];

            //dd($destinationCode2);

            $passengerADT = $data['adults'];
            $passengerCHD = $data['childs'];
            $passengerINF = $data['kids'];
            
            
            if ($passengerADT > 0) {
                $passengerTypeQuantities[] = [
                    'Code' => 'ADT',
                    'Quantity' => $passengerADT,
                ];
            }

            if ($passengerCHD > 0) {
                $passengerTypeQuantities[] = [
                    'Code' => 'CHD',
                    'Quantity' => $passengerCHD,
                ];
            }

            if ($passengerINF > 0) {
                $passengerTypeQuantities[] = [
                    'Code' => 'INF',
                    'Quantity' => $passengerINF,
                ];
            }
            $uniqueId = uniqid();
            //dd($data);

            $flight = [
                'DepartureDateTime' => $formattedDate,
                'ReturningDateTime' => $returningDate,
                'DepartureWindow' => 'Obsolete',
                'ArrivalWindow' => 'Obsolete',
                'OriginLocationCode' => $originCode,
                'OriginLocationCode1' => $originCode1,
                'OriginLocationCode2' => $originCode2,
                'DestinationLocationCode' => $destinationCode,
                'DestinationLocationCode1' => $destinationCode1,
                'DestinationLocationCode2' => $destinationCode2,
                'Destination' => $destination,
                'Origin' => $origin,
                'MaxStopsQuantity' => 'All',
                'VendorPreferenceCodes' => '',
                'VendorExcludeCodes' => '',
                'CabinPreference' => $data['flight_type'],
                'CabinType' => $data['flight_type'],
                'PreferenceLevel' => 'Preferred',
                'AirTripType' => $data['trip'],
                'PricingSourceType' => 'All',
                'IsRefundable' => true,
                'PassengerQuantity' => $passengerTypeQuantities,
                'RequestOptions' => 'Fifty',
                'NearByAirports' => true,
                'IsResidentFare' => true,
                'Nationality' => 'NG',
                'Target' => 'Test',
                'ConversationId' => 'string',
                'IsInfantWithSeat' => true,
                'Provider' => 'string',
                'UniqueId' => $uniqueId,
            ];
            //dd($flight);                                                  
            return view('air.request.request', compact('flight','rates', 'flightTrip'));

            
           
        } 
    }

    public function requestpost(Request $request)
    {
        $data = $request->input();
        //dd($data);
        $phone = $data['country_code'].$data['phone_no'];

        $flight_request = new FlightRequestModel();
        $flight_request->origin = $data['origin'];
        $flight_request->destination = $data['destination'];
        $flight_request->departure_date = $data['departure_date'];
        $flight_request->return_date = $data['return_date'];
        $flight_request->passenger = $data['passenger'];  
        $flight_request->cabinType = $data['cabinType'];
        $flight_request->email = $data['email'];
        $flight_request->phone_no = $phone;
        $flight_request->fullname = $data['fullname'];
        $flight_request->save();

        if($flight_request->save()){
            $fullname = $data['fullname'];
            $email = $data['email'];
            $emailCopy = "support@travelwheel.ng";

            $flightMail = new RequestMail($email, $fullname, $data);
            Mail::to($email)->send($flightMail);

            
            $flightMailCopy = new RequestMailCopy($email, $fullname, $data);
            Mail::to($emailCopy)->send($flightMailCopy);
            
            //dd("Mail Sent");
            
            //return redirect()->back()->with('success', 'Mail sent successfully!');
            return view('air.request.request_success');
        }
        
    }


    
    
}