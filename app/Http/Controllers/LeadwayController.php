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
use Illuminate\Support\Facades\Redirect;


class LeadwayController extends Controller
{
    public function authentication(Request $request)
    {
        $authKey = "Pxc0Vu8i5AD1o3WPH3gXeDUt+7E6nb/yZgcahpdo1Nl92NcuCZgZFLuC6v40aXzU";
        $hash = hash('sha512', $authKey);
        dd($hash);
    }

    public function insuranceLeadway()
    {
        $authKey = "Pxc0Vu8i5AD1o3WPH3gXeDUt+7E6nb/yZgcahpdo1Nl92NcuCZgZFLuC6v40aXzU";
        $apikey = hash('sha512', $authKey);
       // dd($apikey);
        $client = new Client();
        $url = 'https://mc.leadway.com/interBusinessConnection/interBusinessConnection.svc/general/getTravelProducts/'; 
        $headers = [
            'Authorization' =>  $apikey,
            'Accept' => 'application/json',
        ];
        $response = $client->request('GET', $url, [
            'headers' => $headers,
        ]);
        // Get the status code
        $status_code = $response->getStatusCode();
        // Get the response body
        $response_body = $response->getBody()->getContents();
        //dd($status_code, $response_body);

        $data = json_decode($response_body, true);
        //dd($data);
        return view('air.insurance.insuranceLeadway', compact('data'));
    }
    public function insuranceLeadwayP(Request $request)
    {
        $packageCode = $request->query('prodCode');
        //dd($packageCode);
        $destinationPart = explode(" - ", $packageCode);
        $prodCode = $destinationPart[0];
        $prodName = $destinationPart[1];
        session(['prodName' => $prodName]);
        //dd($prodName);
        $authKey = "Pxc0Vu8i5AD1o3WPH3gXeDUt+7E6nb/yZgcahpdo1Nl92NcuCZgZFLuC6v40aXzU";
        $apikey = hash('sha512', $authKey);
        //dd($apikey);
        $client = new Client();
        $url = 'https://mc.leadway.com/interBusinessConnection/interBusinessConnection.svc/general/getCountriesForTravel/'.$prodCode; 
        $headers = [
            'Authorization' =>  $apikey,
            'Accept' => 'application/json',
        ];
        $response = $client->request('GET', $url, [
            'headers' => $headers,
        ]);
        // Get the status code
        $status_code = $response->getStatusCode();
        // Get the response body
        $response_body = $response->getBody()->getContents();
        //dd($status_code, $response_body);

        $data = json_decode($response_body, true);
        //dd($data);
        return view('air.insurance.insuranceLeadwayP', compact('data', 'prodCode', 'prodName'));
    }
    public function insuranceLeadwayQ(Request $request)
    {
        $dataform = $request->input();
        //dd($dataform);
        //dd($prodCode);
        Session::put('data_form', $dataform);
        $dob = $dataform['dob'];
        $formattedDob = date('m-d-Y', strtotime($dob));
        $dpdate = $dataform['begin_date'];
        $formattedDpd = date('m-d-Y', strtotime($dpdate));
        $ardate = $dataform['end_date'];
        $formattedArd = date('m-d-Y', strtotime($ardate));
        $authKey = "Pxc0Vu8i5AD1o3WPH3gXeDUt+7E6nb/yZgcahpdo1Nl92NcuCZgZFLuC6v40aXzU";
        $apikey = hash('sha512', $authKey);
        try {
            $client = new Client();
            $url = 'https://mc.leadway.com/interBusinessConnection/interBusinessConnection.svc/quotation/travelInsurance/'; 
            $headers = [
                'Authorization' => $apikey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ];
            $payload = [
                "productCode" => $dataform['prodCode'],
                "clientInfo" => [
                    "surname" => $dataform['surname'],
                    "othername" => $dataform['othername'],
                    "middlename" => $dataform['lastname'],
                    "emailAddress" => $dataform['email'],
                    "mobileNo" => $dataform['phone_no'],
                    "gender" => $dataform['gender'],
                    "dob_mm_dd_yyyy" => $formattedDob,
                    "postalAddress" => $dataform['address'],
                    "city" => $dataform['city'],
                    "state" => $dataform['state'],
                ],
                "clientNo" => "",
                "destination" => $dataform['country'],
                "depaturedate" => $formattedDpd,
                "arrivaldate" => $formattedArd, 
                "passportNo" => $dataform['passport_no'],
            ];

            //dd($payload);
            
            $ieww = json_encode($payload);
            //dd($ieww);
            $response = $client->request('POST', $url, [ 
                'headers' => $headers,
                'json' => $payload,
            ]);

            // Get the status code and response body
            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            //dd($statusCode, $responseBody);
            $data = json_decode($responseBody, true);
            $request->session()->flash('data', $data);
            // Dump the status code and response body for debugging
            //dd($data);

            //return view('air.insurance.insuranceLeadwayQ', compact('data', 'dataform') );
            $errorMsg = "";

            if (!empty($data['errorMsg'])) {
                $errorMsg = 'Unknown error'; // Default error message
                $errorData = json_decode($data['errorMsg'], true);
                
                // Check if JSON decoding was successful
                if (json_last_error() === JSON_ERROR_NONE && isset($errorData['error_description'])) {
                    $errorMsg = $errorData['error'] . " " . $errorData['error_description'];
                }
            } else {
                $errorData = null; // Ensure $errorData is defined even if errorMsg is empty
            }
            
            return view('air.insurance.insuranceLeadwayQ', compact('data', 'dataform', 'errorMsg'));

        } catch (RequestException $e) { 
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $responseBody = $response->getBody()->getContents();
                
                // Handle the error response
                dd($statusCode, $responseBody);
            } else {
                // Handle other request exceptions
                dd($e->getMessage());
            }
        }
    }

    public function makePurchase(Request $request)
    {
        $dataform2 = $request->input();

        $authKey = "Pxc0Vu8i5AD1o3WPH3gXeDUt+7E6nb/yZgcahpdo1Nl92NcuCZgZFLuC6v40aXzU";
        $apikey = hash('sha512', $authKey);
        
        try { 
            $client = new Client();
            $url = 'https://mc.leadway.com/interBusinessConnection/interBusinessConnection.svc/quotation/payforQuotation/'; 
            $headers = [
                'Authorization' => $apikey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ];
            $payload = [
                "quoteNo" => $dataform2['quoteNo'],
                //"callbackUrl" => 'https://test.travelwheel.ng/air/insurance',
                "paymentReferenceNo" =>  "",
                "issueCreditNote" => true,
                "creditNote" => $dataform2['quoteNo'], 
                "callbackUrl" => 'https://test.travelwheel.ng/air/insurance',

            ];
            
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => $payload,
                'timeout' => 60, // Increase timeout for testing
            ]);
            
            // Log status code 
            $statusCode = $response->getStatusCode();
            
            // Get and log headers
            $headers = $response->getHeaders();
            
            // Get and log body content
            $responseBody = $response->getBody()->getContents();
            // Decode and process the response if it's JSON
            $data = json_decode($responseBody, true);
            //dd($data);
            if ($statusCode == 200 && !empty($data['paystackpaymentUrl'])) {
                return redirect()->away($data['paystackpaymentUrl']);
            } else {
                return Redirect::back()->withMessage(['msg' => 'Payment failed. Please try again.', 'type' => 'error']);
            }
            
        } catch (\Exception $e) {
            \Log::error('Payment Error: ' . $e->getMessage());
            return Redirect::back()->withMessage(['msg' => 'Error: ' . $e->getMessage(), 'type' => 'error']);
        }
    }


}