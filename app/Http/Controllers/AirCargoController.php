<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\ContactDetailsModel;
use App\Models\AirCargoModel;
use Carbon\Carbon;
use PDF;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use SeerbitLaravel\Facades\Seerbit;
use App\Mail\ShipmentMail;
use App\Models\ShippingZone;
use App\Models\CargoDocumentPrice;
use App\Models\CargoPackagePrice;


class AirCargoController extends Controller
{
    public function air_cargo(){
        return view('air.air_cargo.cargo');
    }
    public function air_cargoInternational(){
        return view('air.air_cargo.cargoInt');
    }

    public function getPrices(Request $request)
    {
        $zoneId = $request->input('zone_id');
        $type = $request->input('type'); // 'Document' or 'Package'

        if ($type === 'Document') {
            $prices = CargoDocumentPrice::where('zone_id', $zoneId)->first();
        } elseif ($type === 'Package') {
            $prices = CargoPackagePrice::where('zone_id', $zoneId)->first();
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        return response()->json($prices);
    }

    public function getShippingPrice(Request $request)
    {
       

        // Retrieve zone ID
        $zone = ShippingZone::where('Zone_name', $request['zone'])->first();
        if (!$zone) {
            return response()->json(['message' => 'Invalid zone provided'], 400);
        }

        $zone_id = $zone->id;
        $shipping_type = $request['service'];
        $weight = $request['weight'];
        $price = null;

        // Determine price based on shipping type
        if ($shipping_type === 'Document') {
            $price = CargoDocumentPrice::where('zone_id', $zone_id)->value($weight);
        } elseif ($shipping_type === 'Package') {
            $price = CargoPackagePrice::where('zone_id', $zone_id)->value($weight);
        }

        // Return price if found, otherwise error message
        if ($price !== null) {
            return response()->json(['price' => $price]);
        } else {
            return response()->json(['message' => 'Price not found for the given parameters'], 404);
        }
    }

    public function getShippingZones()
    {
        $zones = ShippingZone::all();
        return response()->json($zones);
    }


    public function air_cargo_post(Request $request){
        $dataform =  $request->input();
        //dd($dataform);
        $email = $dataform['email'];
        $fullname = $dataform['fullname'];
        $contact = ContactDetailsModel::where('email', $email)->first();
        if (!$contact) {
            $details = new ContactDetailsModel();
            $details->fullname = $fullname;
            $details->email = $dataform['email'];
            $details->phone = $dataform['phone_no'];
            $details->product = "Air Cargo";
            $details->request = 1;
            $details->save();
        }
        else{
            $contact->increment('request');
        }
        $date = Carbon::now()->format('md');
        $shipping_id = 'TWAC07'. $date . Str::random(2);
        $shipping_type = $dataform['shipment_type'];
        if ($shipping_type == "Document"){
            $shippingPrice = $dataform['price'];
            $shipping_price = str_replace(',', '', $shippingPrice);
            $shipPrice = (int)$shipping_price; 
            $data = [
                'shipping_id' => $shipping_id,
                'shipping_price' => $shipPrice,
                //'vat' => $dataform['priceVat'],
                'pickup_price' => $dataform['pick-Upshipment'],
                'total_price' => $dataform['totalPrice'],
                'sender_name' => $dataform['fullname'],
                'sender_address' => $dataform['address1'],
                'sender_email' => $dataform['email'],
                'sender_phone' => $dataform['phone_no'],
                'sender_country' => $dataform['sCountry'],
                'sender_postalCode' => $dataform['postalcode1'],
                'receiver_name' => $dataform['fullname2'],
                'receiver_address' => $dataform['address2'],
                'receiver_email' => $dataform['email2'],
                'receiver_phone' => $dataform['contact2'],
                'receiver_country' => $dataform['rCountry'],
                'receiver_postalCode' => $dataform['postalcode1'],
                'shipment_type' => $dataform['shipment_type'],
                'document_type' => $dataform['typeOfDoc'],
                'document_weight' => $dataform['doc_weight'],
                'pickup_address' => $dataform['pick_upAddress'],
                'pickup_busstop' => $dataform['nBus_stop'],
                'pickup_date' => $dataform['pick_upDate'],
                'dropoff_date' => $dataform['dropoff_date'],
            ];
            // Generate PDF
            //dd($data);
            $pdf = PDF::loadView('air.air_cargo.shipment2', $data);
            $filename = $shipping_id . '.pdf';
            Storage::put('public/shipments/' . $filename, $pdf->output());

            $preview_Path = $request->file('preview');
            $destinationPath = public_path('assets/aircargo');
            $previewImage = $shipping_id . '.jpg';
            $preview_Path->move($destinationPath, $previewImage);

        }
        elseif ( $shipping_type == "Package" ){
            $shippingPrice = $dataform['price2'];
            $shipping_price = str_replace(',', '', $shippingPrice);
            $shipPrice = (int)$shipping_price; 
            $pVolume = "Lenght: ".$dataform['length']." | Width: ".$dataform['width']." | Height: ".$dataform['height'];

            $data = [
                'shipping_id' => $shipping_id,
                'shipping_price' => $shipPrice,
                //'vat' => $dataform['priceVat2'],
                'pickup_price' => $dataform['pick-Upshipment'],
                'total_price' => $dataform['totalPrice2'],
                'sender_name' => $dataform['fullname'],
                'sender_address' => $dataform['address1'],
                'sender_email' => $dataform['email'],
                'sender_phone' => $dataform['phone_no'],
                'sender_country' => $dataform['sCountry'],
                'sender_postalCode' => $dataform['postalcode1'],
                'receiver_name' => $dataform['fullname2'],
                'receiver_address' => $dataform['address2'],
                'receiver_email' => $dataform['email2'],
                'receiver_phone' => $dataform['contact2'],
                'receiver_country' => $dataform['rCountry'],
                'receiver_postalCode' => $dataform['postalcode1'],
                'shipment_type' => $dataform['shipment_type'],
                'pDescription' => $dataform['pDescription'],
                'package_weight' => $dataform['package_weight'],
                'package_volumetric' => $pVolume,
                'pickup_address' => $dataform['pick_upAddress'],
                'pickup_busstop' => $dataform['nBus_stop'],
                'pickup_date' => $dataform['pick_upDate'],
                'dropoff_date' => $dataform['dropoff_date'],
            ];
            // Generate PDF
            dd($data);
            $pdf = PDF::loadView('air.air_cargo.shipment2', $data);
            $filename = $shipping_id . '.pdf';
            Storage::put('public/shipments/' . $filename, $pdf->output());

            $preview_Path = $request->file('pPreview');
            $destinationPath = public_path('assets/aircargo');
            $previewImage = $shipping_id . '.jpg';
            $preview_Path->move($destinationPath, $previewImage);

        }
        
        $shipment = new AirCargoModel();
        $shipment->shipping_id = $shipping_id;
        $shipment->fullname = $dataform['fullname'];
        $shipment->email = $dataform['email'];
        $shipment->phone = $dataform['phone_no'];
        $shipment->shipping_to = $dataform['rCountry'];
        $shipment->shipment_type = $dataform['shipment_type'];
        $shipment->shipment_preview = $previewImage ;
        $shipment->shipment_details = $filename;
        $shipment->price = $shippingPrice;
        //$shipment->vat = $dataform['priceVat2'];
        $shipment->total_price = $dataform['totalPrice2'];
        $shipment->payment_status = "Pending";
        $shipment->save();

        $shipData = $data;
        Session::put('shipData', $shipData);
        
        //dd($dataform);
        /*
            $reference = Flutterwave::generateReference();
            $fullname = $dataform['fullname'];

            // Enter the details of the payment
            $data = [ 
                'amount' => $dataform['totalPrice'],
                'email' => $dataform['email'],
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => url('/rave_a/callback'),
                'customer' => [
                    'email' => $dataform['email'],
                    'phone_number' => $dataform['phone_no'],
                    'name' => $fullname,
                ],
                'customizations' => [
                    'title' => 'Air Cargo',
                    'description' => 'TravelWheel Air Cargo',
                ],
            ];

            try {
                $payment = Flutterwave::initializePayment($data);
            
                // Log the payment response
                \Log::info('Flutterwave Payment Response', ['response' => $payment]);
            
                if ($payment['status'] !== 'success') {
                    \Log::error('Flutterwave Payment Initialization Failed', ['response' => $payment]);
                    return back()->with('error', 'Payment initialization failed. Please try again.');
                }
            
                return redirect($payment['data']['link']);
            } catch (\Exception $e) {
                \Log::error('Flutterwave Error', ['error' => $e->getMessage()]);
                return back()->with('error', 'An error occurred while processing your payment.');
            }
            
         */           
        $uuid = bin2hex(random_bytes(6));
        $transaction_ref = strtoupper(trim($uuid));
        $productId = "ACG".$uuid;
        $fullname = $dataform['fullname'];
        $email = $dataform['email'];
        $payload = [
            "amount" => $dataform['totalPrice'],
            "callbackUrl" => url('/seerbit_a/callback'),
            "country" => "NG",
            "currency" => "NGN",
            "email" => $dataform['email'],
            'client_name' => $fullname,
            "paymentReference" => $transaction_ref,
            "productDescription" => "Air Cargo",
            "productId" => $productId,
            
            
        ];
        //dd($payload);
        $trans = SeerBit::Standard()->Initialize($payload);
        //$pay = $trans['data']['message'];
        //dd($trans);
        $redirectLink = $trans['data']['payments']['redirectLink'];
        return redirect($redirectLink);
        
    }
            
    public function callbackFlutterwave(Request $request)
    {   
        $data = $request->all();
        $dataform = Session::get('data_form');
    }
    public function callbackSeerbit(Request $request)
    {   
        $data = $request->all();
        $shipData = Session::get('shipData');
        $shipping_id = $shipData['shipping_id'];
        
        //dd($data);


        if ($data['message'] == 'Successful') {
            $shipment = AirCargoModel::where('shipping_id', $shipping_id)->first();
            $filename = $shipment['shipment_details'];
            $email = $shipment['email'];

            if ($shipment) {
                // Update the attributes of the selected record
                $shipment->payment_status = 'successful'; 
                $shipment->transaction_id = $data['reference']; 
                $shipment->transaction_ref = $data['linkingreference'];
                $shipment->save(); 

                try {
                    Mail::to($email)->send(new ShipmentMail($shipment, $filename));
                    \Log::info('Email sent successfully to: ' . $email);
                    
                } catch (\Exception $e) {
                    \Log::error('Failed to send email: ' . $e->getMessage());
                   
                }
            }
              
        //return redirect('/air/aircargo_success'); 
        //dd($shipData); 
        return redirect('/air/aircargo_success')->with('data', $shipData); 
        }
    }   
    public function air_cargo_success(){
        return view('air.air_cargo.ship');
    }
}
