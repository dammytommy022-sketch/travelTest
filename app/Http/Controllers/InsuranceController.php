<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use App\Models\InsuranceQuoteModel;
use App\Models\InsurancePurchaseModel;
use Illuminate\Support\Facades\Session;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use SeerbitLaravel\Facades\Seerbit;
use App\Http\Requests;
use Illuminate\Support\Facades\Http;

class InsuranceController extends Controller
{
    public function insurance()
    {
        return view('air.insurance.insurance');
    }
    public function insuranceAllianz()
    {
        return view('air.insurance.InsuranceAllianz');
    }
    public function insurancesuccess()
    {
        return view('air.insurance.insurance');
    }
    public function getInsurance()
    {
        return view('air.insurance.insuranceQuote');
    }

    public function makeRequestQuote(Request $request)
    { 
        $dataform = $request->input();
        
        //dd($dataform);
        $inputDate = $dataform['dob'];
        $inputDate1 = $dataform['begin_date'];
        $inputDate2 = $dataform['end_date'];

        if("Schengen" == $dataform['travel_plan']){
        $TravelPlanId = 1;
        } 
         else {
            $TravelPlanId = 2;  
        }
        // Convert the input date to the desired format
        $dateOfBirth = Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y');
        $coverDate = Carbon::createFromFormat('Y-m-d', $inputDate1)->format('d-M-Y');
        $endDate = Carbon::createFromFormat('Y-m-d', $inputDate2)->format('d-M-Y');
        $baseUrl = config('api.allianz_base_url');
        $url = $baseUrl.'/token';
        $response = Http::asForm()->post($url, [
            'username' => 'lightaydot@yahoo.com',
            'password' => 'Travelwheel@15',
            'grant_type' => 'password',
        ]);

        $content = $response->getBody()->getContents();
        $data = json_decode($content);
        
        if (isset($data->access_token)) {
            $token = $data->access_token;
            //dd($token);
           
        } else {
            // Handle the case where access_token is not present
            dd('Access token not found in the response');
        }
        //dd($token);

        try {
            $client = new Client();
            $baseUrl = config('api.allianz_base_url');
            $url = $baseUrl.'test/api/Quote'; 
            //dd($url);
            $token = $token;
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
            $payload = [
                'DateOfBirth' => $dateOfBirth,
                "Email" => $dataform['email'],
                "Telephone"=> $dataform['phone_no'],
                "CoverBegins"=> $coverDate,
                "CoverEnds"=> $endDate,
                "CountryId" => $dataform['country'],
                "PurposeOfTravel" => $dataform['purpose_of_travel'],
                "TravelPlanId" => $TravelPlanId,
                "BookingTypeId"=> $dataform['booking_type'],
                "IsRoundTrip"=> false,
                "NoOfPeople"=> $dataform['nop'],
                "NoOfChildren"=> $dataform['noc'],
                "IsMultiTrip"=> false //true if duration is greater than 92days
            ];
            //dd($payload);

            $jsonPayload = json_encode($payload);

            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => $payload,
            ]);
            
            // Get the response body

            // Get the status code
            $status_code = $response->getStatusCode();
            
            // Get the response body
            $response_body = $response->getBody()->getContents();
            //dd($response);
            // Dump the status code and response body
            //dd($status_code, $response_body);
            
            $body = $response->getBody();
            $headers = $response->getHeaders();
            //dd($response->getStatusCode(), $response->getBody()->getContents());
            $data = json_decode($response_body, true);

            //dd($data);
            $Quote = new InsuranceQuoteModel();
            $Quote->quoteRequestId = $data["QuoteRequestId"];
            $Quote->productVariantId = $data["ProductVariantId"];
            $Quote->dob = $data["DateOfBirth"];
            $Quote->email = $data["Email"];
            $Quote->phone_no = $data["Telephone"];
            $Quote->coverBegins = $data["CoverBegins"];
            $Quote->coverEnds = $data["CoverEnds"]; 
            $Quote->countryId = $data["CountryId"]; 
            $Quote->countryId2 = $data["CountryId2"];  
            $Quote->purposeOfTravel = $data["PurposeOfTravel"];  
            $Quote->travelPlanId = $data["TravelPlanId"]; 
            $Quote->bookingTypeId = $data["BookingTypeId"]; 
            $Quote->noOfPeople = $data["NoOfPeople"]; 
            $Quote->noOfChildren = $data["NoOfChildren"];  
            $Quote->multiTrip = $data["IsMultiTrip"];  
            $Quote->amount = $data["Amount"]; 
            $Quote->amountA = $data["AllianzPrice"]; 
            $Quote->quoteId = $data["quoteId"];  
            $Quote->requestdate = $data["DateTimeAdded"];  

            $Quote->save();

            if($Quote->save()){
                //echo "Booking Successful";
                // Set a success flash message
                $request->session()->flash('success', 'Form submitted successfully!');
                $request->session()->put('amount', $data["Amount"]);

                $quoteRequestId = $data["QuoteRequestId"]; // Replace 'unique_key' with the actual input field name
                $dataRequest= InsuranceQuoteModel::where('quoteRequestId', $quoteRequestId)->first(); // Replace 'id' with the actual unique key column name in your table
                
                //->attributes
                $request->session()->flash('dataRequest', $dataRequest);
                // Redirect back to the form page
                //dd($dataRequest);
                //return back()->withInput();
                return view('air.insurance.insuranceQuote', compact('data') );
                
              }else{
                  echo "Booking Failed ";
                  
              }

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

    public function insuranceRequest(Request $request)
    {
        $dataRequestMyDB = $request->query('dataRequest');
        $dataRequest = json_decode($dataRequestMyDB);
       
        //dd($dataRequest);
         if (2 == $dataRequest->bookingTypeId){
            return view('air.insurance.insurancePurchaseF', compact('dataRequest'));
        } 
        else {
            return view('air.insurance.insurancePurchase', compact('dataRequest'));
        }
    }


    public function insurancePurchase(Request $request)
    { 

        $dataform = $request->all();
        Session::put('data_form', $dataform);
        //dd($dataform );
        if (3 == $dataform["bookingTypeId"]){
            return view('air.insurancePurchaseGN', compact('dataform'));
        } 
         else {
            return view('air.insurance.insurancePurchaseN', compact('dataform'));
        }

        // Redirect to the next page (for example, the next step of the form)
       // return view('air.insurancePurchaseN', compact('dataform'));
    }
    
    public function makeRequestPurchase(Request $request)
    { 
        $dataform2 = $request->input();
        
        Session::put('data_form2', $dataform2);
        $dataform = Session::get('data_form');
        //dd($dataform2);
        if ('fluterwave' == $dataform2['payment_option']){
             $reference = Flutterwave::generateReference();
            $fullname = $dataform['surname']. " ".$dataform['firstname'];
            // Enter the details of the payment
                $data = [

                'payment_options' => 'FluterWave',
                'amount' => $dataform2['p_amount'],
                'email' => $dataform['email'],
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => route('callback.rave'),
                'customer' => [
                    'email' => $dataform['email'],
                    "phone_number" => $dataform['phone_no'],
                    "name" => $fullname,
                    'dataform' => $dataform, 
                    'dataform2' => $dataform2, 
                ],
                

                "customizations" => [
                    "title" => 'Travel Insurance Individual',
                    "description" => "Travel Insurance payment for individual cover"
                ]
            ];
            //dd($data);
            $payment = Flutterwave::initializePayment($data);
            dd($payment['status']);

            if ($payment['status'] !== 'success') {
                // notify something went wrong
                return;
            }
            //dd($payment);
            return redirect($payment['data']['link']);
       
        }
       elseif('seerbit' == $dataform2['payment_option']) {
        try {

            $uuid = bin2hex(random_bytes(6));
            $transaction_ref = strtoupper(trim($uuid));
            $productId = "TIP".$uuid;
            $fullname = $dataform['surname']. " ".$dataform['firstname'];
            $payload = [
                "amount" => $dataform2['p_amount'],
                "callbackUrl" => route('callback.seerbit'),
                "country" => "NG",
                "currency" => "NGN",
                "email" => $dataform['email'],
                'client_name' => $fullname,
                "paymentReference" => $transaction_ref,
                "productDescription" => "Travel Insurance",
                "productId" => $productId,
            ];
            dd($payload);
            
            $trans = SeerBit::Standard()->Initialize($payload);
            $pay = $trans['data']['message'];
            //dd($trans);
            $redirectLink = $trans['data']['payments']['redirectLink'];
            return redirect($redirectLink);
            //$redirectLink = $trans['data']['payments']['redirectLink'];

            // Redirect the user to the payment redirect link
            
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->withMessage(['msg'=>'The payment gateway token has expired. Please refresh the page and try again.', 'type'=>'error']);
             
        }
       } 
    }

    public function callbackFlutterwave()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'completed') 
        {
            $dataform = Session::get('data_form');
            $dataform2 = Session::get('data_form2');

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            //dd($dataform);
            //dd($data);

            if (2 == $dataform['bookingTypeId']) {
                //dd($dataform);
                $inputDate = $dataform['dob1'];
                $inputDate2 = $dataform['dob2'];

                    // Convert the input date to the desired format
                    $dateOfBirth = Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y'); 
                    $dateOfBirth2 = Carbon::createFromFormat('Y-m-d', $inputDate2)->format('d-M-Y'); 

                    // Initialize an empty array to store the fetched data for all children
                    $allChildrenData = [];

                    // Get the total number of children data to process
                    $totalChildren = $dataform['noc'];// Assuming you have the total number of children data available

                    // Loop through each child data and store it in the $allChildrenData array
                    for ($i = 1; $i <= $totalChildren; $i++) {
                        $childData = [];

                        // Form the keys for accessing the child data based on the number
                        $qouteIdKey = 'qouteId';
                        $surnamenameKey = 'surname';
                        $middlenameKey = 'middlenameC' . $i;
                        $firstnameKey = 'firstnameC' . $i;
                        $genderKey = 'genderC' . $i;
                        $titleKey = 'titleC' . $i;
                        $dobKey = 'dobC' . $i;
                        $emailKey = 'email';
                        $phoneKey = 'phone_no';
                        $stateKey = 'state';
                        $addressKey = 'address';
                        $zipcodeKey = 'zipcode';
                        $nationaltyKey = 'nationaltyC' . $i;
                        $passportNoKey = 'passport_noC' . $i;
                        $nationaltyKey = 'nationaltyC' . $i;
                        $medicalConditionKey = 'MedicalConditionC' . $i;

                        $inputDate = $dataform[$dobKey];
                        $dateOfBirthC = Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y'); 

                        // Fetch the child data and store it in the $childData array
                        $childData["QuoteId"] = $dataform[$qouteIdKey];
                        $childData["Surname"] = $dataform[$surnamenameKey];
                        $childData["MiddleName"] = $dataform[$middlenameKey];
                        $childData["FirstName"] = $dataform[$firstnameKey];
                        $childData["GenderId"] = $dataform[$genderKey];
                        $childData["TitleId"] = $dataform[$titleKey];
                        $childData["DateOfBirth"] = $dateOfBirthC;
                        $childData["Email"] = $dataform[$emailKey];
                        $childData["Telephone"] = $dataform[$phoneKey];
                        $childData["StateID"] = $dataform[$stateKey];
                        $childData["Address"] = $dataform[$addressKey];
                        $childData["ZipCode"] = $dataform[$zipcodeKey];
                        $childData["Nationality"] = $dataform[$nationaltyKey];
                        $childData["PassportNo"] = $dataform[$passportNoKey];
                        $childData["IdentificationPath"] = null;
                        $childData["Occupation"] = "Student";
                        $childData["MaritalStatusId"] = 1;
                        $childData["PreExistingMedicalCondition"] = false;
                        $childData["MedicalCondition"] = null;

                        

                        // If NextOfKin data is also available for each child (you can adjust this based on your data structure)
                        $nextOfKinData = [];

                        // Form the keys for accessing the NextOfKin data based on the number
                        $nextOfKinFullnameKey = 'fullname';
                        $nextOfKinAddressKey = 'address';
                        $nextOfKinRelationshipKey = 'relationship';
                        $nextOfKinPhoneNoKey = 'phone_no';

                        // Fetch the NextOfKin data and store it in the $nextOfKinData array
                        $nextOfKinData["FullName"] = $dataform2[$nextOfKinFullnameKey];
                        $nextOfKinData["Address"] = $dataform2[$nextOfKinAddressKey];
                        $nextOfKinData["Relationship"] = $dataform2[$nextOfKinRelationshipKey];
                        $nextOfKinData["Telephone"] = $dataform2[$nextOfKinPhoneNoKey];

                        // Add the NextOfKin data to the childData array
                        $childData["NextOfKin"] = $nextOfKinData;

                        // Add the childData array to the $allChildrenData array
                        $allChildrenData[] = $childData;
                    }
                    $baseUrl = config('api.allianz_base_url');
                    $url = $baseUrl.'/token';
                            $response = Http::asForm()->post($url, [
                                'username' => 'lightaydot@yahoo.com',
                                'password' => 'Travelwheel@15',
                                'grant_type' => 'password',
                            ]);
                    
                            $content = $response->getBody()->getContents();
                            $data = json_decode($content);
                            if (isset($data->access_token)) {
                                $token = $data->access_token;
                               
                            } else {
                                // Handle the case where access_token is not present
                                dd('Access token not found in the response');
                            }
                    try {
                        $client = new Client();
                        $baseUrl = config('api.allianz_base_url');
                        $url = $baseUrl.'test/api/FamilyBooking'; 
                    
                    $headers = [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ];
                        //dd($allChildrenData);
                        $payload = [
                            [
                                "QuoteId"=>$dataform['qouteId'],
                                "Surname"=> $dataform['surname'],
                                "MiddleName"=> $dataform['middlename1'],
                                "FirstName"=> $dataform['firstname'],
                                "GenderId"=> $dataform['gender1'],
                                "TitleId"=> $dataform['title1'],
                                "DateOfBirth"=>  $dateOfBirth,
                                "Email"=> $dataform['email'],
                                "Telephone"=> $dataform['phone_no'],
                                "StateId"=> $dataform['state'],
                                "Address"=> $dataform['address'],
                                "ZipCode"=> $dataform['zipcode'],
                                "Nationality"=> $dataform['nationalty1'],
                                "PassportNo"=> $dataform['passport_no'],
                                "IdentificationPath"=> null,
                                "Occupation"=> $dataform['ocupation1'],
                                "MaritalStatusId"=> $dataform['marital_status1'],
                                "PreExistingMedicalCondition"=> false,
                                "MedicalCondition"=> null,
                                "NextOfKin" => [
                                    "FullName"=>$dataform2['fullname'],
                                    "Address"=> $dataform2['address'],
                                    "Relationship"=> $dataform2['relationship'],
                                    "Telephone"=> $dataform2['phone_no'],
                                    ]
                                ],
                                [
                            
                                "QuoteId"=>$dataform['qouteId'],
                                "Surname"=> $dataform['surname'],
                                "MiddleName"=> $dataform['middlename2'],
                                "FirstName"=> $dataform['firstname2'],
                                "GenderId"=> $dataform['gender2'],
                                "TitleId"=> $dataform['title2'],
                                "DateOfBirth"=>  $dateOfBirth2,
                                "Email"=> $dataform['email2'],
                                "Telephone"=> $dataform['phone_no2'],
                                "StateId"=> $dataform['state'],
                                "Address"=> $dataform['address'],
                                "ZipCode"=> $dataform['zipcode'],
                                "Nationality"=> $dataform['nationalty2'],
                                "PassportNo"=> $dataform['passport_no2'],
                                "IdentificationPath"=> null,
                                "Occupation"=> $dataform['ocupation2'],
                                "MaritalStatusId"=> $dataform['marital_status1'],
                                "PreExistingMedicalCondition"=> false,
                                "MedicalCondition"=> null,
                                "NextOfKin" => [
                                    "FullName"=>$dataform2['fullname'],
                                    "Address"=> $dataform2['address'],
                                    "Relationship"=> $dataform2['relationship'],
                                    "Telephone"=> $dataform2['phone_no'],
                                    ]
                                ],
                        
                                ...$allChildrenData,

                        ];
                        // dd($payload);
                    

                        $response = $client->request('POST', $url, [
                            'headers' => $headers,
                            'json' => $payload,
                        ]);
                        
                        // Get the response body
                        $body = $response->getBody();
                        $headers = $response->getHeaders();
                       // dd($response->getHeaders(), $response->getStatusCode(), $response->getBody()->getContents());
                        $allianzStatus = $response->getStatusCode();
                        $allianzCoverID = $response->getBody()->getContents();

                        if(200 == $allianzStatus){

                            $Purchase = new InsurancePurchaseModel();
                            $Purchase->qoute_id = $dataform["qouteId"];
                            $Purchase->cover_id = $allianzCoverID; 
                            $Purchase->bookingtype_id = $dataform["bookingTypeId"];
                            $Purchase->c_amount = $dataform["amount"]; 
                            $Purchase->vat = $dataform2["vat"]; 
                            $Purchase->t_amount = $dataform2["p_amount"]; 
                            $Purchase->payment_option = $dataform2["payment_option"];
                            $Purchase->surname = $dataform["surname"];  
                            $Purchase->middlename = $dataform["middlename1"]; 
                            $Purchase->firstname = $dataform["firstname"]; 
                            $Purchase->gender = $dataform["gender1"]; 
                            $Purchase->title = $dataform["title1"]; 
                            $Purchase->dob = $dateOfBirth;
                            $Purchase->email = $dataform["email"];
                            $Purchase->phone_no = $dataform["phone_no"];
                            $Purchase->state = $dataform["state"];
                            $Purchase->address = $dataform["address"]; 
                            $Purchase->zipcode = $dataform["zipcode"]; 
                            $Purchase->passport_no = $dataform["passport_no"];  
                            $Purchase->occupation = $dataform["ocupation1"];  
                            $Purchase->nationalty = $dataform["nationalty1"]; 
                            $Purchase->marital_status = $dataform["marital_status1"];
                            $Purchase->noc = $dataform["noc"];;
                            $Purchase->medicalCondition = $dataform["MedicalCondition1"];
                            $Purchase->nok_fullname = $dataform2["fullname"];
                            $Purchase->nok_address = $dataform2["address"];
                            $Purchase->nok_phone = $dataform2["phone_no"];
                            $Purchase->nok_relationship = $dataform2["relationship"];

                            $Purchase->save();

                            if($Purchase->save()){
                            //  $request->session()->flash('success', 'Form submitted successfully!');
                            // $request->session()->put('amount', $data["Amount"]);
                            return view('air.insurance.insurancesucces');
                           // echo "purchase Succesfully";
                                //return back()->withInput();
                
                                
                            }else{
                                echo "Booking Failed ";
                                
                            }

                        }
                    
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

            } else {
                $inputDate = $dataform['dob'];
                // Convert the input date to the desired format
                $dateOfBirth = Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y');
                
                $baseUrl = config('api.allianz_base_url');
                $url = $baseUrl.'/token';
                $response = Http::asForm()->post($url, [
                    'username' => 'lightaydot@yahoo.com',
                    'password' => 'Travelwheel@15',
                    'grant_type' => 'password',
                ]);
        
                $content = $response->getBody()->getContents();
                $data = json_decode($content);
                if (isset($data->access_token)) {
                    $token = $data->access_token;
                   
                } else {
                    // Handle the case where access_token is not present
                    dd('Access token not found in the response');
                }
                
                try {
                    $client = new Client();
                    $baseUrl = config('api.allianz_base_url');
                    $url = $baseUrl.'test/api/IndividualBooking'; 
                    
                    $headers = [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ];
                    $payload = 
                        [
                            "QuoteId"=>$dataform['qouteId'],
                            "Surname"=> $dataform['surname'],
                            "MiddleName"=> $dataform['middlename'],
                            "FirstName"=> $dataform['firstname'],
                            "GenderId"=> $dataform['gender'],
                            "TitleId"=> $dataform['title'],
                            "DateOfBirth"=>  $dateOfBirth,
                            "Email"=> $dataform['email'],
                            "Telephone"=> $dataform['phone_no'],
                            "StateId"=> $dataform['state'],
                            "Address"=> $dataform['address'],
                            "ZipCode"=> $dataform['zipcode'],
                            "Nationality"=> $dataform['nationalty'],
                            "PassportNo"=> $dataform['passport_no'],
                            "IdentificationPath"=> null,
                            "Occupation"=> $dataform['ocupation'],
                            "MaritalStatusId"=> $dataform['marital_status'],
                            "PreExistingMedicalCondition"=> false,
                            "MedicalCondition"=> null,
                            "NextOfKin" => [
                                "FullName"=>$dataform2['fullname'],
                                "Address"=> $dataform2['address'],
                                "Relationship"=> $dataform2['relationship'],
                                "Telephone"=> $dataform2['phone_no'],
                                ]
                            ]; 
                        // dd($payload);
                            $response = $client->request('POST', $url, [
                                'headers' => $headers,
                                'json' => $payload,
                            ]);
                        
                            // Get the response body
                            $body = $response->getBody();
                            $headers = $response->getHeaders();
                            $allianzStatus = $response->getStatusCode();
                            $allianzCoverID = $response->getBody()->getContents();
                        // dd($response->getHeaders(), $response->getStatusCode(), $response->getBody()->getContents());
                            
                            if(200 == $allianzStatus){

                                $Purchase = new InsurancePurchaseModel();
                                $Purchase->qoute_id = $dataform["qouteId"];
                                $Purchase->cover_id = $allianzCoverID; 
                                $Purchase->bookingtype_id = $dataform["bookingTypeId"];
                                $Purchase->c_amount = $dataform["amount"]; 
                                $Purchase->vat = $dataform2["vat"]; 
                                $Purchase->t_amount = $dataform2["p_amount"]; 
                                $Purchase->payment_option = $dataform2["payment_option"];
                                $Purchase->surname = $dataform["surname"];  
                                $Purchase->middlename = $dataform["middlename"]; 
                                $Purchase->firstname = $dataform["firstname"]; 
                                $Purchase->gender = $dataform["gender"]; 
                                $Purchase->title = $dataform["title"]; 
                                $Purchase->dob = $dateOfBirth;
                                $Purchase->email = $dataform["email"];
                                $Purchase->phone_no = $dataform["phone_no"];
                                $Purchase->state = $dataform["state"];
                                $Purchase->address = $dataform["address"]; 
                                $Purchase->zipcode = $dataform["zipcode"]; 
                                $Purchase->passport_no = $dataform["passport_no"];  
                                $Purchase->occupation = $dataform["ocupation"];  
                                $Purchase->nationalty = $dataform["nationalty"]; 
                                $Purchase->marital_status = $dataform["marital_status"];
                                $Purchase->noc = 0;
                                $Purchase->medicalCondition = $dataform["MedicalCondition"];
                                $Purchase->nok_fullname = $dataform2["fullname"];
                                $Purchase->nok_address = $dataform2["address"];
                                $Purchase->nok_phone = $dataform2["phone_no"];
                                $Purchase->nok_relationship = $dataform2["relationship"];

                                $Purchase->save();

                                if($Purchase->save()){
                                //  $request->session()->flash('success', 'Form submitted successfully!');
                                // $request->session()->put('amount', $data["Amount"]);
                                return view('air.insurance.insurancesucces');
                                //echo "purchase Succesfully";
                                    //return back()->withInput();
                    
                                    
                                }else{
                                    echo "Booking Failed ";
                                    
                                }

                            }
                        
                            //dd($body);
                            // Process the response as needed
                            // ...
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


        
        }
        elseif ($status ==  'cancelled'){
            return view('air.insurancePurchaseN', compact('dataform'));
        }
        else{
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
    }

    public function callbackSeerbit(Request $request)
    {
        //$paymentDetails = SeerBit::getPaymentData();
        $data = $request->all();
        
            //dd($data);
         if("Successful" == $data['message'])
         {  
            $dataform = Session::get('data_form');
            $dataform2 = Session::get('data_form2');
            //dd($dataform, $dataform2);
            $ref_id = $data['reference'];
            $trans_id = $data['linkingreference'];
            $status = $data['message'];
            if (2 == $dataform['bookingTypeId']) {
                //dd($dataform);
                $inputDate = $dataform['dob1'];
                $inputDate2 = $dataform['dob2'];
    
                    // Convert the input date to the desired format
                    $dateOfBirth = Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y'); 
                    $dateOfBirth2 = Carbon::createFromFormat('Y-m-d', $inputDate2)->format('d-M-Y'); 
    
                    // Initialize an empty array to store the fetched data for all children
                    $allChildrenData = [];
    
                    // Get the total number of children data to process
                    $totalChildren = $dataform['noc'];// Assuming you have the total number of children data available

                    for ($i = 1; $i <= $totalChildren; $i++) {
    $childData = [];

    // Form the keys for accessing the child data based on the number
    $qouteIdKey = 'qouteId';
    $surnameKey = 'surname';
    $middlenameKey = 'middlenameC' . $i;
    $firstnameKey = 'firstnameC' . $i;
    $genderKey = 'genderC' . $i;
    $titleKey = 'titleC' . $i;
    $dobKey = 'dobC' . $i;
    $emailKey = 'email';
    $phoneKey = 'phone_no';
    $stateKey = 'state';
    $addressKey = 'address';
    $zipcodeKey = 'zipcode';
    $nationaltyKey = 'nationaltyC' . $i;
    $passportNoKey = 'passport_noC' . $i;
    $medicalConditionKey = 'MedicalConditionC' . $i;

    // Check if the date of birth exists before formatting
    $inputDate = $dataform[$dobKey] ?? null;
    $dateOfBirthC = !empty($inputDate) ? Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y') : null;

    // Fetch the child data and store it in the $childData array
    $childData["QuoteId"] = $dataform[$qouteIdKey] ?? null;
    $childData["Surname"] = $dataform[$surnameKey] ?? null;
    $childData["MiddleName"] = $dataform[$middlenameKey] ?? null;
    $childData["FirstName"] = $dataform[$firstnameKey] ?? null;
    $childData["GenderId"] = $dataform[$genderKey] ?? null;
    $childData["TitleId"] = $dataform[$titleKey] ?? null;
    $childData["DateOfBirth"] = $dateOfBirthC;
    $childData["Email"] = $dataform[$emailKey] ?? null;
    $childData["Telephone"] = $dataform[$phoneKey] ?? null;
    $childData["StateID"] = $dataform[$stateKey] ?? null;
    $childData["Address"] = $dataform[$addressKey] ?? null;
    $childData["ZipCode"] = $dataform[$zipcodeKey] ?? null;
    $childData["Nationality"] = $dataform[$nationaltyKey] ?? null;
    $childData["PassportNo"] = $dataform[$passportNoKey] ?? null;
    $childData["IdentificationPath"] = null;
    $childData["Occupation"] = "Student";
    $childData["MaritalStatusId"] = 1;
    $childData["PreExistingMedicalCondition"] = false;
    $childData["MedicalCondition"] = null;

    // If NextOfKin data is also available for each child
    $nextOfKinData = [];

    // Form the keys for accessing the NextOfKin data based on the number
    $nextOfKinFullnameKey = 'fullname';
    $nextOfKinAddressKey = 'address';
    $nextOfKinRelationshipKey = 'relationship';
    $nextOfKinPhoneNoKey = 'phone_no';

    // Fetch the NextOfKin data safely
    $nextOfKinData["FullName"] = $dataform2[$nextOfKinFullnameKey] ?? null;
    $nextOfKinData["Address"] = $dataform2[$nextOfKinAddressKey] ?? null;
    $nextOfKinData["Relationship"] = $dataform2[$nextOfKinRelationshipKey] ?? null;
    $nextOfKinData["Telephone"] = $dataform2[$nextOfKinPhoneNoKey] ?? null;

    // Add the NextOfKin data to the childData array
    $childData["NextOfKin"] = $nextOfKinData;

    // Add the childData array to the $allChildrenData array
    $allChildrenData[] = $childData;
}

                    
                    $baseUrl = config('api.allianz_base_url');
                    $url = $baseUrl.'/token';
                    $response = Http::asForm()->post($url, [
                        'username' => 'lightaydot@yahoo.com',
                        'password' => 'Travelwheel@15',
                        'grant_type' => 'password',
                    ]);
            
                    $content = $response->getBody()->getContents();
                    $data = json_decode($content);
                    if (isset($data->access_token)) {
                        $token = $data->access_token;
                       
                    } else {
                        // Handle the case where access_token is not present
                        dd('Access token not found in the response');
                    }
    
                    try {
                        $client = new Client();
                        $baseUrl = config('api.allianz_base_url');
                        $url = 'test/api/Quote'; 
                    $url = $baseUrl.'test/api/FamilyBooking'; 
                    $headers = [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ];
                        //dd($allChildrenData);
                        $payload = [
                            [
                                "QuoteId"=>$dataform['qouteId'],
                                "Surname"=> $dataform['surname'],
                                "MiddleName"=> $dataform['middlename1'],
                                "FirstName"=> $dataform['firstname'],
                                "GenderId"=> $dataform['gender1'],
                                "TitleId"=> $dataform['title1'],
                                "DateOfBirth"=>  $dateOfBirth,
                                "Email"=> $dataform['email'],
                                "Telephone"=> $dataform['phone_no'],
                                "StateId"=> $dataform['state'],
                                "Address"=> $dataform['address'],
                                "ZipCode"=> $dataform['zipcode'],
                                "Nationality"=> $dataform['nationalty1'],
                                "PassportNo"=> $dataform['passport_no'],
                                "IdentificationPath"=> null,
                                "Occupation"=> $dataform['ocupation1'],
                                "MaritalStatusId"=> $dataform['marital_status1'],
                                "PreExistingMedicalCondition"=> false,
                                "MedicalCondition"=> null,
                                "NextOfKin" => [
                                    "FullName"=>$dataform2['fullname'],
                                    "Address"=> $dataform2['address'],
                                    "Relationship"=> $dataform2['relationship'],
                                    "Telephone"=> $dataform2['phone_no'],
                                    ]
                                ],
                                [
                            
                                "QuoteId"=>$dataform['qouteId'],
                                "Surname"=> $dataform['surname'],
                                "MiddleName"=> $dataform['middlename2'],
                                "FirstName"=> $dataform['firstname2'],
                                "GenderId"=> $dataform['gender2'],
                                "TitleId"=> $dataform['title2'],
                                "DateOfBirth"=>  $dateOfBirth2,
                                "Email"=> $dataform['email2'],
                                "Telephone"=> $dataform['phone_no2'],
                                "StateId"=> $dataform['state'],
                                "Address"=> $dataform['address'],
                                "ZipCode"=> $dataform['zipcode'],
                                "Nationality"=> $dataform['nationalty2'],
                                "PassportNo"=> $dataform['passport_no2'],
                                "IdentificationPath"=> null,
                                "Occupation"=> $dataform['ocupation2'],
                                "MaritalStatusId"=> $dataform['marital_status1'],
                                "PreExistingMedicalCondition"=> false,
                                "MedicalCondition"=> null,
                                "NextOfKin" => [
                                    "FullName"=>$dataform2['fullname'],
                                    "Address"=> $dataform2['address'],
                                    "Relationship"=> $dataform2['relationship'],
                                    "Telephone"=> $dataform2['phone_no'],
                                    ]
                                ],
                        
                                ...$allChildrenData,
    
                        ];
                           //dd($payload);
                       
    
                        $response = $client->request('POST', $url, [
                            'headers' => $headers,
                            'json' => $payload,
                        ]);
                        
                        // Get the response body
                        $body = $response->getBody();
                        $headers = $response->getHeaders();
                        //dd($response->getHeaders(), $response->getStatusCode(), $response->getBody()->getContents());
                        $allianzStatus = $response->getStatusCode();
                        $allianzCoverID = $response->getBody()->getContents();
                        dd($allianzCoverID);
                        if(200 == $allianzStatus){
    
                            $Purchase = new InsurancePurchaseModel();
                            $Purchase->qoute_id = $dataform["qouteId"];
                            $Purchase->cover_id = $allianzCoverID; 
                            $Purchase->bookingtype_id = $dataform["bookingTypeId"];
                            $Purchase->c_amount = $dataform["amount"]; 
                            //$Purchase->vat = $dataform2["vat"]; 
                            $Purchase->t_amount = $dataform2["p_amount"]; 
                            $Purchase->payment_option = $dataform2["payment_option"];
                            $Purchase->surname = $dataform["surname"];  
                            $Purchase->middlename = $dataform["middlename1"]; 
                            $Purchase->firstname = $dataform["firstname"]; 
                            $Purchase->gender = $dataform["gender1"]; 
                            $Purchase->title = $dataform["title1"]; 
                            $Purchase->dob = $dateOfBirth;
                            $Purchase->email = $dataform["email"];
                            $Purchase->phone_no = $dataform["phone_no"];
                            $Purchase->state = $dataform["state"];
                            $Purchase->address = $dataform["address"]; 
                            $Purchase->zipcode = $dataform["zipcode"]; 
                            $Purchase->passport_no = $dataform["passport_no"];  
                            $Purchase->occupation = $dataform["ocupation1"];  
                            $Purchase->nationalty = $dataform["nationalty1"]; 
                            $Purchase->marital_status = $dataform["marital_status1"];
                            $Purchase->noc = $dataform["noc"];;
                            $Purchase->medicalCondition = $dataform["MedicalCondition1"];
                            $Purchase->nok_fullname = $dataform2["fullname"];
                            $Purchase->nok_address = $dataform2["address"];
                            $Purchase->nok_phone = $dataform2["phone_no"];
                            $Purchase->nok_relationship = $dataform2["relationship"];
    
                            $Purchase->save();
    
                            if($Purchase->save()){
                              //  $request->session()->flash('success', 'Form submitted successfully!');
                               // $request->session()->put('amount', $data["Amount"]);
                
                               //echo "purchase Succesfully";
                               return view('air.insurance.insurancesucces');
                
                                
                              }else{
                                  echo "Booking Failed ";
                                  
                              }
    
                        }
                    
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
    
            } else {
                $inputDate = $dataform['dob'];
                // Convert the input date to the desired format
                $dateOfBirth = Carbon::createFromFormat('Y-m-d', $inputDate)->format('d-M-Y');
                $baseUrl = config('api.allianz_base_url');
                $url = $baseUrl.'/token';
                $response = Http::asForm()->post($url, [
                    'username' => 'lightaydot@yahoo.com',
                    'password' => 'Travelwheel@15',
                    'grant_type' => 'password',
                ]);
        
                $content = $response->getBody()->getContents();
                $data = json_decode($content);
                if (isset($data->access_token)) {
                    $token = $data->access_token;
                   
                } else {
                    // Handle the case where access_token is not present
                    dd('Access token not found in the response'); 
                }
                
                $client = new Client();
                
                $baseUrl = config('api.allianz_base_url');
                $url = $baseUrl.'test/api/IndividualBooking';
                
                // Authorization token and headers
                $headers = [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ];
                
                // Payload (request body)
                $payload = [
                    "QuoteId" => $dataform['qouteId'],
                    "Surname" => $dataform['surname'],
                    "MiddleName"=> $dataform['middlename'],
                    "FirstName" => $dataform['firstname'],
                    "GenderId" => $dataform['gender'],
                    "TitleId" => $dataform['title'],
                    "DateOfBirth" => $dateOfBirth,
                    "Email" => $dataform['email'],
                    "Telephone" => "08109422607",
                    "StateId" => $dataform['state'],
                    "Address" => $dataform['address'],
                    "ZipCode" => $dataform['zipcode'],
                    "Nationality" => $dataform['nationalty'],
                    "PassportNo" => $dataform['passport_no'],
                    "IdentificationPath" => null,
                    "Occupation" => $dataform['ocupation'],
                    "MaritalStatusId" => $dataform['marital_status'],
                    "PreExistingMedicalCondition" => false,
                    "MedicalCondition" => null,
                    "NextOfKin" => [
                        "FullName" => $dataform2['fullname'],
                        "Address" => $dataform2['address'],
                        "Relationship" => $dataform2['relationship'],
                        "Telephone" => $dataform2['phone_no'],
                    ],
                ];
                //dd($payload);
                try {
                    // Make the POST request
                    $response = $client->request('POST', $url, [
                        'headers' => $headers,
                        'json' => $payload, // No need for json_encode here
                    ]);
                
                    // Decode the response
                    $responseBody = json_decode($response->getBody(), true);
                
                    // Debug the response
                    //dd($responseBody);
                    // Get the response body
                    $body = $response->getBody();
                    $headers = $response->getHeaders();
                    $allianzStatus = $response->getStatusCode();
                    $allianzCoverID = $response->getBody()->getContents();
                    // dd($response->getHeaders(), $response->getStatusCode(), $response->getBody()->getContents());
                            
                    if(200 == $allianzStatus){
                        $Purchase = new InsurancePurchaseModel();
                        $Purchase->qoute_id = $dataform["qouteId"];
                        $Purchase->cover_id = $allianzCoverID; 
                        $Purchase->bookingtype_id = $dataform["bookingTypeId"];
                        $Purchase->c_amount = $dataform["amount"]; 
                        //$Purchase->vat = $dataform2["vat"]; 
                        $Purchase->t_amount = $dataform2["p_amount"]; 
                        $Purchase->payment_option = $dataform2["payment_option"];
                        $Purchase->surname = $dataform["surname"];  
                        $Purchase->middlename = $dataform["middlename"]; 
                        $Purchase->firstname = $dataform["firstname"]; 
                        $Purchase->gender = $dataform["gender"]; 
                        $Purchase->title = $dataform["title"]; 
                        $Purchase->dob = $dateOfBirth;
                        $Purchase->email = $dataform["email"];
                        $Purchase->phone_no = $dataform["phone_no"];
                        $Purchase->state = $dataform["state"];
                        $Purchase->address = $dataform["address"]; 
                        $Purchase->zipcode = $dataform["zipcode"]; 
                        $Purchase->passport_no = $dataform["passport_no"];  
                        $Purchase->occupation = $dataform["ocupation"];  
                        $Purchase->nationalty = $dataform["nationalty"]; 
                        $Purchase->marital_status = $dataform["marital_status"];
                        $Purchase->noc = 0;
                        $Purchase->medicalCondition = $dataform["MedicalCondition"];
                        $Purchase->nok_fullname = $dataform2["fullname"];
                        $Purchase->nok_address = $dataform2["address"];
                        $Purchase->nok_phone = $dataform2["phone_no"];
                        $Purchase->nok_relationship = $dataform2["relationship"];

                        $Purchase->save();

                        if($Purchase->save()){
                            //  $request->session()->flash('success', 'Form submitted successfully!');
                            // $request->session()->put('amount', $data["Amount"]);
                           //echo "purchase Succesfully";
                            return view('air.insurance.insurancesucces');
                         }
                        else{
                             echo "Booking Failed ";
                        }
                    }
                
                
                } catch (\Exception $e) {
                    // Handle exceptions
                    dd([
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            
            }

      
         
        }
        elseif ("Cancelled" ==  $data['message']){
            return view('air.insurancePurchaseN', compact('dataform'));
        }
        else{
            //Put desired action/code after transaction has failed here
        }
          
    }
}
