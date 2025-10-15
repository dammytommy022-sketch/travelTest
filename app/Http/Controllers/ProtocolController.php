<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\PaymentProtocolModel; 
use App\Models\ProtocolModel;
use App\Models\ContactDetailsModel;
use App\Models\TransactionDetailsModel;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use SeerbitLaravel\Facades\Seerbit;
use App\Mail\ProtocolMail;
use App\Mail\ProtocolPassMail;
use App\Mail\ProtocolCopyMail;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use Image;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
//use Intervention\Image\Facades\Image;
ini_set('memory_limit', '256M');

class ProtocolController extends Controller
{ 
     public function protocol()
    {
        return view('air.protocol.protocol');
    }
    public function protocolPlan(Request $request)
    {
        $rules = [
            'location' => 'required|string|max:255',
            'airport' => 'required|string|max:255',
            'service' => 'required|string|max:255',
        ];
        $message = [
            'location.required' => 'The Location field is required.',
            'airport.required' => 'The airport field is required.',
            'service.email' => 'The airport field is required.',
        ];
        $this->validate($request, $rules, $message);
        $data =  $request->input();
        Session::put('data', $data);
        $location = $data['location'];
        $service = $data['service'];

       // dd($data);
        if($data['airport'] == "Local Airport"){
            $airport = "Local";
            $protocol = ProtocolModel::where('location', $location)->where('airport', $airport)->where('service', $service)->latest()->first();
            $id = $protocol->id;
            //$price1 = $price['price1'];
            //dd($id);
            return redirect()->route('air.protocolplans', compact('id'));
        }
        elseif($data['airport'] == "International Airport"){
            $airport = "International";
            $protocol = ProtocolModel::where('location', $location)->where('airport', $airport)->where('service', $service)->latest()->first();
            $id = $protocol->id;
            return redirect()->route('air.protocolplansI', compact('id'));
        }
       
       

        //return view('air.protocol.protocolplans');
    }
    public function protocolPlans(Request $request, $id)
    {
        $id = $id;
        $protocol = ProtocolModel::where('id', $id)->latest()->first();
        $price1 = $protocol->price1;
        $price2 = $protocol->price2;

        //dd($price2);
        return view('air.protocol.protocolplans', ['price1' => $price1, 'price2' => $price2]);
    }
    public function protocolPlansI(Request $request, $id)
    {
        $id = $id;
        $protocol = ProtocolModel::where('id', $id)->latest()->first();
        $price1 = $protocol->price1;
        $price2 = $protocol->price2;

        //dd($price1);
        return view('air.protocol.protocolInternational', ['price1' => $price1, 'price2' => $price2]);
    }
    
    public function protocolR()
    {   
        $data = Session::get('data');
        //dd($data);
        return view('air.protocol.protocolR', compact('data'));
    }
    public function protocolForm(Request $request, $plan)
    {   
        $data = Session::get('data');
        //dd($data);
        $plan = $request->route('plan');
        //dd($plan);
        $location = $data['location'];
        $service = $data['service'];
        if($data['airport'] == "Local Airport"){
            $airport = "Local";
            $protocol = ProtocolModel::where('location', $location)->where('airport', $airport)->where('service', $service)->latest()->first();
            if($plan == "1"){
                $price = $protocol->price1;
            }elseif($plan == "2"){
                $price = $protocol->price2;
            }
            return view('air.protocol.protocolForm', compact('data', 'price'));
        }
        elseif($data['airport'] == "International Airport"){
            $airport = "International";
            $protocol = ProtocolModel::where('location', $location)->where('airport', $airport)->where('service', $service)->latest()->first();
            if($plan == "1"){
                $price = $protocol->price1;
            }elseif($plan == "2"){
                $price = $protocol->price2;
            }
            return view('air.protocol.protocolForm', compact('data', 'price'));
        }
    }
    public function protocolV()
    {
        $data = Session::get('data');
        return view('air.protocol.protocolV', compact('data'));
    }
    
    public function protocol_checkout(Request $request )
    {
        $dataform =  $request->input();
        //dd($dataform); 
        
        if(!empty($dataform['optinal_requestA'])){
            $optinal_request = $dataform['optinal_requestA'];
            if($dataform['optionalPriceA'] == "Up to 3 Seaters"){
                $optionalVehicle = "Saloon Comfort";
                $seaters = $dataform['optionalPriceA'];
            }
            elseif($dataform['optionalPriceA'] == "Up to 3  Seaters"){
                $optionalVehicle = "SUV Business";
                $seaters = $dataform['optionalPriceA'];
            }
            elseif($dataform['optionalPriceA'] == "Up to 5 Seaters"){
                $optionalVehicle = "Mini Van";
                $seaters = $dataform['optionalPriceA'];
            }
            else{
                $optionalVehicle = "None";
                $seaters = "None";
            }
        }
        elseif(!empty($dataform['optinal_requestD'])){
            $optinal_request = $dataform['optinal_requestD'];
            if($dataform['optionalPriceD'] == "Up to 3 Seaters"){
                $optionalVehicle = "Saloon Comfort";
                $seaters = $dataform['optionalPriceD'];
            }
            elseif($dataform['optionalPriceD'] == "Up to 3  Seaters"){
                $optionalVehicle = "SUV Business";
                $seaters = $dataform['optionalPriceD'];
            }
            elseif($dataform['optionalPriceD'] == "Up to 5 Seaters"){
                $optionalVehicle = "Mini Van";
                $seaters = $dataform['optionalPriceD'];
            }
            else{
                $optionalVehicle = "None";
                $seaters = "None";
            }
        }
        elseif(!empty($dataform['optinal_requestA2'])){
            $optinal_request = $dataform['optinal_requestA2'];
            if($dataform['optionalPriceA2'] == "Up to 3 Seaters"){
                $optionalVehicle = "Saloon Comfort";
                $seaters = $dataform['optionalPriceA2'];
            }
            elseif($dataform['optionalPriceA2'] == "Up to 3  Seaters"){
                $optionalVehicle = "SUV Business";
                $seaters = $dataform['optionalPriceA2'];
            }
            elseif($dataform['optionalPriceA2'] == "Up to 5 Seaters"){
                $optionalVehicle = "Mini Van";
                $seaters = $dataform['optionalPriceA2'];
            }
            else{
                $optionalVehicle = "None";
                $seaters = "None";
            }
        }
        elseif(!empty($dataform['optinal_requestD2'])){
            $optinal_request = $dataform['optinal_requestD2'];
            if($dataform['optionalPriceD2'] == "Up to 3 Seaters"){
                $optionalVehicle = "Saloon Comfort";
                $seaters = $dataform['optionalPriceD2'];
            }
            elseif($dataform['optionalPriceD2'] == "Up to 3  Seaters"){
                $optionalVehicle = "SUV Business";
                $seaters = $dataform['optionalPriceD2'];
            }
            elseif($dataform['optionalPriceD2'] == "Up to 5 Seaters"){
                $optionalVehicle = "Mini Van";
                $seaters = $dataform['optionalPriceD2'];
            }
            else{
                $optionalVehicle = "None";
                $seaters = "None";
            }
        }
        else{
            $optinal_request = "None"; 
            $optionalVehicle = "None";
            $seaters = "None";
        }  
        //dd($optinal_request, $seaters, $optionalVehicle);
       

        return view('air.protocol.protocol_checkout', compact('dataform', 'optinal_request', 'optionalVehicle', 'seaters'));
    }
    public function makePurchase(Request $request)
    { 
        $dataform = $request->input();
        dd($dataform);
        $fullname = $dataform['lastname1']. " ".$dataform['firstname1'];
        
        $nop = $dataform['no_of_passenger'];
        $email = $dataform['email'];
        $contact = ContactDetailsModel::where('email', $email)->first();
        if (!$contact) {
            $details = new ContactDetailsModel();
            $details->fullname = $fullname;
            $details->email = $dataform['email'];
            $details->phone = $dataform['phone'];
            $details->product = "Protocol Bookings";
            $details->request = 1;
            $details->save();
        }
        else{
            $contact->increment('request');
        }
        if ($nop == 1){
            $fullyname = $dataform['lastname1'].$dataform['firstname1'];
            $means_idPath = $request->file('means-id1');
            $destinationPath = public_path('assets/means_id');
            $means_idImage = $fullyname . '.jpg';

            $means_idPath->move($destinationPath, $means_idImage);
            $means_idImage = $fullyname.'.jpg';
            $dataform['means_id_image'] = $means_idImage;
        }
        elseif ($nop >= 1) {
            $nops = $nop;

            for ($i = 1; $i <= $nops; $i++) {
                $firstnameKey = 'firstname' . $i;
                $firstname = $dataform[$firstnameKey];
                $means_idPath = $request->file("means-id$i");
                $destinationPath = public_path('assets/means_id');
                $means_idImage = "$firstname.jpg";

                $means_idPath->move($destinationPath, $means_idImage);

                $dataform["means_id_image_passenger$i"] = $means_idImage;
            }  
        }

        //dd($dataform);
        Session::put('data_form', $dataform);
        if ('fluterwave' == $dataform['payment_option']){
            $reference = Flutterwave::generateReference();
            $fullname = $dataform['lastname1']. " ".$dataform['firstname1'];
            // Enter the details of the payment
                $data = [
                'payment_options' => 'FluterWave',
                'amount' => $dataform['p_amount'],
                'email' => $dataform['email'],
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => url('/rave_p/callback'),
                'customer' => [
                    'email' => $dataform['email'],
                    "phone_number" => $dataform['phone'],
                    "name" => $fullname,
                    'dataform' => $dataform, 
                ],
                
                "customizations" => [
                    "title" => 'Airpot Protocol Service',
                    "description" => "Airpot Protocol Service"
                ]
            ];
            //dd($data);
            $payment = Flutterwave::initializePayment($data);


            if ($payment['status'] !== 'success') {
                // notify something went wrong
                return;
            }
            //dd($payment);
            // $url = 'https://www.example.com';
            // return response(QrCode::size(300)->generate($url));

            
            return redirect($payment['data']['link']);
       
        }
       elseif('seerbit' == $dataform['payment_option']) {
        try {

            $uuid = bin2hex(random_bytes(6));
            $transaction_ref = strtoupper(trim($uuid));
            $productId = "APS".$uuid;
            $fullname = $dataform['lastname1']. " ".$dataform['firstname1'];
            
            $email = $dataform['email'];
            $payload = [
                "amount" => $dataform['p_amount'],
                "callbackUrl" => url('/seerbit_p/callback'),
                "country" => "NG",
                "currency" => "NGN",
                "email" => $dataform['email'],
                'client_name' => $fullname,
                "paymentReference" => $transaction_ref,
                "productDescription" => "Airport Protocol",
                "productId" => $productId,
                
             
            ];
            //dd($payload);
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
    public function callbackFlutterwaveP(Request $request)
    {   
        $data = $request->all();
        $dataform = Session::get('data_form');
        $fullname = $dataform['lastname1']. " ".$dataform['firstname1'];
        //dd($data, $dataform);
        if ($data['status'] ==  'completed') {
            $transaction = new TransactionDetailsModel();
            $transaction->fullname = $fullname;
            $transaction->email = $dataform['email'];
            $transaction->product = "Protocol Bookings";
            $transaction->paymentgateway = $dataform['payment_option'];
            $transaction->amount = $dataform['c_amount'];
            $transaction->vat = $dataform['vat'];
            $transaction->referenceID = $data['tx_ref'] ;
            $transaction->transactionID = $data['transaction_id'];
            $transaction->save();

            Session::put('data', $data);
            Session::put('dataform', $dataform);
            //dd($dataform);

             // Send email to the user with the transaction details and route link
            Mail::to($dataform['email'])->send(new ProtocolComplete($data, $dataform));

            return redirect()->route('air.protocol_payment');
        }
        else{
            return redirect('/air/protocol')->with('error', 'Payment Cancel');
        }
    }
    public function callbackSeerbitP(Request $request)
    {   
        $data = $request->all();
        $dataform = Session::get('data_form');
        //dd($data, $dataform);
        $email = $dataform['email'];
        $fullname = $dataform['lastname1']. " ".$dataform['firstname1'];
        $amount = $dataform['c_amount'];
        $status = $data['message'];
        $ref_id = $data['reference'];
        $trans_id = $data['linkingreference'];
        if (!empty($dataform['optional_request']) && $dataform['optional_request'] !== "None"){
            if($dataform['optional_request'] == "Pick-up"){
                $optionalRequestOption = $dataform['pickUpVehicle']. ":".$dataform['seaters'];
                $optionalRequestAddress = $dataform['pickUpAddress'];

            }
            elseif($dataform['optional_request'] == "Drop-off"){
                $optionalRequestOption = $dataform['dropOffVehicle']. ":".$dataform['seaters'];
                $optionalRequestAddress = $dataform['dropOffAddress'];
            }
        }
        if ($dataform['nops'] == 1) {
            $means_id = $dataform['means_id_image'];
            $fullnames = $dataform['lastname1'] . " " . $dataform['firstname1'];
            $pnrs = $dataform['pnr1'];
            $ticket_nos = $dataform['ticket-no1'];
            $nobs = $dataform['nobs1'];
        } elseif ($dataform['nops'] > 1) {
            $nops = $dataform['nops'];
            $imagesHtml = '';
            $fullnames = [];
            $pnrs = [];
            $ticket_nos = [];
            $nobs_list = [];
        
            // Collect passenger info into arrays
            for ($i = 1; $i <= $nops; $i++) {
                $firstnameKey = 'firstname' . $i;
                $lastnameKey = 'lastname' . $i;
                $pnrKey = 'pnr' . $i;
                $ticket_noKey = 'ticket-no' . $i;
                $nobsKey = 'nobs' . $i;
        
                $fullnames[] = ($dataform[$lastnameKey] ?? '') . ' ' . ($dataform[$firstnameKey] ?? '');
                $pnrs[] = $dataform[$pnrKey] ?? '';
                $ticket_nos[] = $dataform[$ticket_noKey] ?? '';
                $nobs[] = $dataform[$nobsKey] ?? '';
            }
            
            // Build the PDF content
            for ($i = 1; $i <= $nops; $i++) {
                if (isset($dataform["means_id_image_passenger$i"])) {
                    $imageFilename = $dataform["means_id_image_passenger$i"];
                    $imagePath = public_path("assets/means_id/$imageFilename");
        
                    if (File::exists($imagePath)) {
                        $imageBase64 = base64_encode(File::get($imagePath));
                        $imageSrc = 'data:image/jpeg;base64,' . $imageBase64;
        
                        $imagesHtml .= '<div style="page-break-after: always; text-align: center;">
                                            <small><b>' . htmlspecialchars($fullnames[$i - 1]) . '</b></small><br>
                                            <small>PNR: ' . htmlspecialchars($pnrs[$i - 1]) . '</small><br>
                                            <small>e-Ticket No: ' . htmlspecialchars($ticket_nos[$i - 1]) . '</small><br><br>
                                            <img src="' . $imageSrc . '" style="width: 80%; height: auto;">
                                        </div>';
                    }
                }
            }
        
            // Generate and save the PDF
            if (!empty($imagesHtml)) {
                $dompdf = new Dompdf();
                $dompdf->loadHtml('<html><body>' . $imagesHtml . '</body></html>');
                $dompdf->setPaper('A5', 'portrait');
                $dompdf->render();
        
                $filename = 'means_id_' . time() . '.pdf';
                $savePath = public_path("assets/means_id/$filename");
        
                if (!File::isDirectory(public_path('assets/means_id'))) {
                    File::makeDirectory(public_path('assets/means_id'), 0755, true);
                }
        
                file_put_contents($savePath, $dompdf->output());
        
                // Set the PDF file name
                $means_id = $filename;
            }
        }
        //dd($means_id, $fullnames, $pnrs);
        if ($data['message'] ==  'Successful') {
            $transaction = new TransactionDetailsModel();
            $transaction->fullname = $fullname;
            $transaction->email = $email;
            $transaction->product = "Protocol Bookings";
            $transaction->paymentgateway = $dataform['payment_option'];
            $transaction->amount = $dataform['c_amount'];
            $transaction->vat = $dataform['vat'];
            $transaction->referenceID = $data['linkingreference'];
            $transaction->transactionID = $data['reference'];
            $transaction->save();

            //dd($optionalRequestOption);
            if($transaction->save()){
                $payment = new PaymentProtocolModel();
                $payment->paymentoption = $dataform['payment_option'];
                $payment->fullname = $fullnames;
                $payment->package = $dataform['package'];
                $payment->service = "Protocol Service";
                $payment->email = $email;
                $payment->phone = $dataform['phone'];
                $payment->travel_date = $dataform['travel_date'];
                $payment->passenger = $dataform['no_of_passenger'];
                $payment->vat = $dataform['vat'];
                $payment->state = $dataform['state'];
                $payment->airport = $dataform['airport'];
                $payment->airline = $dataform['airline'];
                $payment->d_time = $dataform['d_time'];
                $payment->service_type = $dataform['service'];
                $payment->status = $status;
                $payment->amount = $dataform['c_amount'];
                $payment->optional_request = $dataform['optional_request'];
                $payment->optionalRequestOption = $optionalRequestOption;
                $payment->optionalRequestAddress = $optionalRequestAddress;
                $payment->reservationCode = $pnrs;
                $payment->eTicketNo = $ticket_nos;
                $payment->noOfBags = $nobs;
                $payment->means_id = $means_id;
                $payment->trans_id = $trans_id;
                $payment->ref_id = $ref_id;
                $payment->save();
            }

            // Store data in the session
            //Session::put('data', $data);
            //Session::put('dataform', $dataform);
            //dd($trans_id);
            Mail::to($email)->send(new ProtocolPassMail($email, $fullname, $amount, $trans_id));

            return redirect()->route('air.protocol_payment', ['trans_id' => $trans_id]);
        }
        else{
            return redirect('/air/protocol')->with('error', 'Payment Cancel');
        }
    }

    public function protocol_payment($trans_id)
    {
        
        $protocols = PaymentProtocolModel::where('trans_id', $trans_id)->firstOrFail();
        //dd($protocols);

        return view('air.protocol.protocol_payment', compact('protocols'));

    }
    public function callbackFlutterwaveP1()
    {
        $data = Session::get('data');
        $status = $data['status'];

        $dataform = Session::get('data_form');
        dd($data);
        $ref = $data['tx_ref'];

        $generatePass = PaymentProtocolModel::where('ref_id', $ref)->first();
        if ($generatePass) {
            return redirect('/air/protocolsuccess')->with('message', 'You have generated a boarding pass earlier, check your mail for your boarding pass or contact customer support.');
        }        
        else{
            $date = Carbon::now()->format('md');
            $ticketid = 'PRTS01'. $date . Str::random(2);
            $fullname = $dataform['lastname1']. " ".$dataform['firstname1'];
            $email = $dataform['email'];
            
            $traveldate = $dataform['travel_date'];
            $time = $dataform['d_time'];
            $service =$dataform['service']. " Date";
            $service1 =$dataform['service']. " Time";
            $ticket = $ticketid;
            $firstname = $dataform['firstname1'];
            $lastname = $dataform['lastname1'];
            $phone = $dataform['phone'];
            $nop = $dataform['no_of_passenger'];
            $airport = $dataform['airport'];
            $state = $dataform['state'];
            $airline = $dataform['airline'];
            $optional_request = $dataform['optional_request'];
            $fullname = strtoupper($dataform['lastname1'] . " " . $dataform['firstname1']);

            if($dataform['package'] == 2){
                $plan = "Regular";
                $image = Image::make(public_path('assets/image/regTickets.png'));
            }
            if($dataform['package'] == 1){
                $plan = "VIP";
                $image = Image::make(public_path('assets/image/vipTickets.png'));
            }
            //if payment is successful
            //dd($data);
            if ($status ==  'completed') 
            {
                $transactionID = $data['transaction_id'];
                $t_data = Flutterwave::verifyTransaction($transactionID);
                //dd($dataform);
                $payment = new PaymentProtocolModel();
                $payment->paymentoption = $dataform['payment_option'];
                $payment->fullname = $fullname;
                $payment->package = $dataform['package'];
                $payment->service = "Protocol Service";
                $payment->email = $dataform['email'];
                $payment->phone = $dataform['phone'];
                $payment->travel_date = $dataform['travel_date'];
                $payment->passenger = $dataform['no_of_passenger'];
                $payment->vat = $dataform['vat'];
                $payment->state = $dataform['state'];
                $payment->airport = $dataform['airport'];
                $payment->airline = $dataform['airline'];
                $payment->d_time = $dataform['d_time'];
                $payment->status = $status;
                $payment->amount = $dataform['c_amount'];
                $payment->optional_request = $dataform['optional_request'];
                $payment->trans_id = $data['transaction_id'];
                $payment->ref_id = $data['tx_ref'];
                $payment->save();
                
                if($payment->save()){
                    //dd($dataform);
                    $image->text($ticket, 130, 370, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($plan, 490, 370, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($nop, 850, 370, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($state, 1150, 370, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($airport, 1450, 370, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($fullname, 130, 550, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    
                    $image->text($phone, 780, 550, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($email, 130, 700, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(30, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($phone, 780, 700, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(36, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($airline, 1250, 525, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(30, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($service , 1238, 585, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-Regular.ttf'));
                        $font->size(30, 'pt');
                        $font->color('#666666');
                    });
                    $image->text($service1 , 1583, 585, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-Regular.ttf'));
                        $font->size(30, 'pt');
                        $font->color('#666666');
                    });
                    $image->text($traveldate , 1250, 640, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(32, 'pt');
                        $font->color('#000000');
                    });
                    $image->text($time, 1600, 640, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(32, 'pt');
                        $font->color('#000000');
                    });
                    
                    
                    $image->text($optional_request, 1550, 715, function ($font) {
                        $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                        $font->size(32, 'pt');
                        $font->color('#000000');
                    });
                
                    $imageDirectory = public_path('assets/image/');
                    $imageFileName = $ticketid . '.png';
                    $path = $imageDirectory . $imageFileName;

                    // Save the image with the constructed file name
                    $image->save($imageDirectory . $imageFileName);
                    //dd($dataform);

                        
                        if($nop == 1)
                        { 
                            //dd($dataform);
                            $pnr = $dataform['pnr1'];
                            $ticket_no = $dataform['ticket-no1'];
                            $nobs = $dataform['nobs1'];

                            $data = "Ticket ID: $ticket\nEmail: $email\nPackage: $plan\nTravel Date: $traveldate\nDeparture Time: $time\nNo Of Passenger: 
                                    $nop\nFirst Name: $firstname\nLast Name: $lastname\nPhone: $phone\nState: $state\nAirport: $airport\nAirline: 
                                    $airline\nService: $service\nPNR: $pnr\nE-Tickek No.: $ticket_no\nNo. Of Bags: $nobs\nOther Service: $optional_request";
                
                            $qrCode = QrCode::size(100)->generate($data);
            
                            //$pdf = PDF::loadView('ticket', ['path' => $path], ['qrCode' => $qrCode], ['plan' => $plan]);
                            $pdf = PDF::loadView('ticket', ['path' => $path, 'qrCode' => $qrCode, 'plan' => $plan,]);
                            
                            $pdf->setPaper('a5', 'landscape');
                        
                            $pdfDirectory = public_path('assets/pdf/');
                            $pdfFileName = $ticketid . '.pdf';

                            
                            //dd($dataform);
                            $emailData = (object) [
                                'email' => $email,     
                                'fullname' => $fullname,
                            ];
                            $pdf->save($pdfDirectory . $pdfFileName);
                            //dd($data);        
                            //Mail::to($email)->send(new ProtocolMail($email, $fullname));
                            $emailCopy = "support@travelwheel.ng";
                            $protocolMail = new ProtocolMail($email, $fullname);
                            $protocolMail->attach($pdfDirectory . $pdfFileName);
                            Mail::to($email)->send($protocolMail);

                            $protocolCopyMail = new ProtocolCopyMail($email, $fullname);
                            $means_id_image = $dataform['means_id_image'];
                            $means_idDirectory = public_path('assets/means_id/');
                            $protocolCopyMail->attach($means_idDirectory . $means_id_image);
                    
                            $protocolCopyMail->attach($pdfDirectory . $pdfFileName);
                            // Send the email after attaching all the files
                            Mail::to($emailCopy)->send($protocolCopyMail);
                            return redirect('/air/protocolsuccess');
                        }
                        elseif ($nop >= 1) {
                            $nops = $nop; 
                            
                            $data = "Ticket ID: $ticket\nLocation: $state\nAirport: $airport\nTravel Date: $traveldate\nDeparture Time: $time\nAirline: $airline\nService: $service\nPackage: $plan\nEmail: $email\nPhone: $phone\nNo Of Passenger: $nop\nOther Service: $optional_request\n";
                        
                            for ($i = 1; $i <= $nops; $i++) {
                                $firstnameKey = 'firstname' . $i;
                                $lastnameKey = 'lastname' . $i;
                                $pnrKey = 'pnr' . $i;
                                $ticket_noKey = 'ticket-no' . $i;
                                $nobsKey = 'nobs' . $i;

                                // Fetch the nop data for the current passenger
                                $firstname = $dataform[$firstnameKey] ?? '';
                                $lastname = $dataform[$lastnameKey] ?? '';
                                $pnr = $dataform[$pnrKey] ?? '';
                                $ticket_no = $dataform[$ticket_noKey] ?? '';
                                $nobs = $dataform[$nobsKey] ?? '';

                                // Construct the data string for the current passenger
                                $passengerData = "Passenger $i:\n";
                                $passengerData .= "First Name: $firstname\n";
                                $passengerData .= "Last Name: $lastname\n";
                                $passengerData .= "PNR: $pnr\n";
                                $passengerData .= "E-Ticket No.: $ticket_no\n";
                                $passengerData .= "No. Of Bags: $nobs\n";

                                // Append the passenger data to the main data string
                                $data .= $passengerData . "\n";
                            }
                            //dd($data);
                            $qrCode = QrCode::size(100)->generate($data);
            
                            //$pdf = PDF::loadView('ticket', ['path' => $path], ['qrCode' => $qrCode], ['plan' => $plan]);
                            $pdf = PDF::loadView('ticket', ['path' => $path, 'qrCode' => $qrCode, 'plan' => $plan,]);
                            
                            $pdf->setPaper('a5', 'landscape');
                        
                            $pdfDirectory = public_path('assets/pdf/');
                            $pdfFileName = $ticketid . '.pdf';
                            $pdf->save($pdfDirectory . $pdfFileName);

                            
                            //dd($dataform); 
                            $emailData = (object) [
                                'email' => $email,     
                                'fullname' => $fullname,
                            ];
                            
                            //Mail::to($email)->send(new ProtocolMail($email, $fullname));

                            $protocolMail = new ProtocolMail($email, $fullname);
                            $protocolMail->attach($pdfDirectory . $pdfFileName);
                            Mail::to($email)->send($protocolMail);
                            
                            
                            $emailCopy = "support@travelwheel.ng";
                            $protocolCopyMail = new ProtocolCopyMail($emailCopy, $fullname);

                            for ($i = 1; $i <= $nops; $i++) {
                                // Correctly construct the filename with the loop index
                                $means_id_image = $dataform['means_id_image_passenger' . $i];
                                $means_idDirectory = public_path('assets/means_id/');

                                // Attach files within the loop
                                $protocolCopyMail->attach($means_idDirectory . $means_id_image);
                            }
                                $protocolCopyMail->attach($pdfDirectory . $pdfFileName);
                                // Send the email after attaching all the files
                                Mail::to($emailCopy)->send($protocolCopyMail);

                            return redirect('/air/protocolsuccess');

                        }
                }
                else{
                    echo "Booking Failed ";
                }
            }
            elseif ($status ==  'cancelled'){
                return redirect('/air/protocol');
            }
                //Put desired action/code after transaction has failed here
        }
            // Get the transaction from your DB using the transaction reference (txref)
    }
    public function callbackSeerbitP1($trans_id)
    {
        set_time_limit(300); 
        $protocols = PaymentProtocolModel::where('trans_id', $trans_id)->firstOrFail();
        //dd($protocols);
        if($protocols){
            $date = Carbon::now()->format('md');
            $ticketid = 'PRTS01'. $date . Str::random(2);
            $fullnames = $protocols['fullname'];
            $email = $protocols['email'];
            $traveldate = $protocols['travel_date'];
            $time = $protocols['d_time'];
            $service =$protocols['service_type']. " Date";
            $service1 =$protocols['service_type']. " Time";
            $ticket = $ticketid;
            $phone = $protocols['phone'];
            $nop = $protocols['passenger'];
            $airport = $protocols['airport'];
            $state = $protocols['state'];
            $airline = $protocols['airline'];
            $optional_request = $protocols['optional_request'];
            $optional_requestOption = $protocols['optionalRequestOption'];
            $optional_requestAddress = $protocols['optionalRequestAddress'];
            if($protocols['package'] == 2 && $protocols['service_type'] == "Departure"){
                $plan = "Regular";
                $image = Image::make(public_path('assets/image/regDeparture.png'));
            }
            elseif ($protocols['package'] == 2 && $protocols['service_type'] == "Arrival") {
                $plan = "Regular";
                $image = Image::make(public_path('assets/image/regArrival.png'));
            }
            elseif($protocols['package'] == 1 && $protocols['service_type'] == "Departure"){
                $plan = "VIP";
                $image = Image::make(public_path('assets/image/vipDeparture.png'));
            }
            elseif ($protocols['package'] == 1 && $protocols['service_type'] == "Arrival") {
                $plan = "VIP";
                $image = Image::make(public_path('assets/image/vipArrival.png'));
            }
            
            if($nop == 1){
                $fullname = $fullnames;
            }
            elseif($nop >= 1){
                $fullname = $fullnames[0];
            }
            
           

            //dd($fullname, $protocols);
            if("Successful" == $protocols['status']){  
                $image->text($ticket, 130, 370, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($plan, 490, 370, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($nop, 850, 370, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($state, 1150, 370, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($airport, 1450, 370, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($fullname, 130, 550, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($phone, 780, 550, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(36, 'pt');
                    $font->color('#000000');
                });
                $image->text($email, 130, 700, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(34, 'pt');
                    $font->color('#000000');
                });
                $image->text($airline, 1250, 525, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(30, 'pt');
                    $font->color('#000000');
                });
                $image->text($service , 1238, 585, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-Regular.ttf'));
                    $font->size(30, 'pt');
                    $font->color('#666666');
                });
                $image->text($service1 , 1583, 585, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-Regular.ttf'));
                    $font->size(30, 'pt');
                    $font->color('#666666');
                });
                $image->text($traveldate , 1250, 640, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(32, 'pt');
                    $font->color('#000000');
                });
                $image->text($time, 1600, 640, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(32, 'pt');
                    $font->color('#000000');
                });
                $image->text($optional_request, 1550, 715, function ($font) {
                    $font->file(public_path('assets/css/font/OpenSans-SemiBold.ttf'));
                    $font->size(32, 'pt');
                    $font->color('#000000');
                });
            
                $imageDirectory = public_path('assets/image/pass/');
                $imageFileName = $ticketid . '.png';
                $path = $imageDirectory . $imageFileName;

                // Save the image with the constructed file name
                $image->save($imageDirectory . $imageFileName);
                //dd($protocols);
                if($nop == 1){ 
                    //dd($dataform);
                    $pnr = $protocols['reservationCode'];
                    $ticket_no = $protocols['eTicketNo'];
                    $nobs = $protocols['noOfBags'];

                    $data = "Ticket ID: $ticket\nEmail: $email\nPackage: $plan\nTravel Date: $traveldate\nDeparture Time: $time\nNo Of Passenger: 
                            $nop\nFull Name: $fullname\nPhone: $phone\nState: $state\nAirport: $airport\nAirline: 
                            $airline\nService: $service\nPNR: $pnr\nE-Tickek No.: $ticket_no\nNo. Of Bags: $nobs\nOther Service: $optional_request";
        
                    $qrCode = QrCode::size(100)->generate($data);
    
                    //$pdf = PDF::loadView('ticket', ['path' => $path], ['qrCode' => $qrCode], ['plan' => $plan]);  $optional_requestAddress 
                    $pdf = PDF::loadView('ticket', ['path' => $path, 'qrCode' => $qrCode, 'pnr' => $pnr, 'nobs' => $nobs, 'ticket_no' => $ticket_no, 'plan' => $plan, 'optional_request' => $optional_request, 'optional_requestOption' => $optional_requestOption, 'optional_requestAddress' => $optional_requestAddress, 'nop' => $nop],);
                    
                    $pdf->setPaper('a4', 'portrait');
                
                    $pdfDirectory = public_path('assets/pdf/');
                    $pdfFileName = $ticketid . '.pdf';

                    
                    //dd($protocols);
                    $emailData = (object) [
                        'email' => $email,     
                        'fullname' => $fullname,
                    ];
                    $pdf->save($pdfDirectory . $pdfFileName);
                     
                    //dd($protocols);       
                    //Mail::to($email)->send(new ProtocolMail($email, $fullname));
                            $emailCopy = "damilola@travelwheel.ng";
                            $protocolMail = new ProtocolMail($email, $fullname);
                            $protocolMail->attach($pdfDirectory . $pdfFileName);
                            Mail::to($email)->send($protocolMail);

                            $protocolCopyMail = new ProtocolCopyMail($email, $fullname);
                            $means_id_image = $protocols['means_id'];
                            $means_idDirectory = public_path('assets/means_id/');
                            $protocolCopyMail->attach($means_idDirectory . $means_id_image);
                    
                            $protocolCopyMail->attach($pdfDirectory . $pdfFileName);
                            // Send the email after attaching all the files
                            Mail::to($emailCopy)->send($protocolCopyMail);
                            return redirect('/air/protocolsuccess');
                }
                elseif ($nop >= 1) {
                    $nops = $nop; 
                    $pnr = $protocols['reservationCode'];
                    $emailfullname = $protocols['fullname'][0];
                    //dd($fullname);
                    $ticket_no = $protocols['eTicketNo'];
                    $nobs = $protocols['noOfBags'];
                    
                    $data = "Ticket ID: $ticket\nLocation: $state\nAirport: $airport\nTravel Date: $traveldate\nDeparture Time: $time\nAirline: $airline\nService: $service\nPackage: $plan\nEmail: $email\nPhone: $phone\nNo Of Passenger: $nop\nOther Service: $optional_request\n";
                
                    for ($i = 1; $i <= $nops; $i++) {
                        $fullnameKey = 'fullname' . $i;
                        $pnrKey = 'reservationCode' . $i;
                        $ticket_noKey = 'eTicketNo' . $i;
                        $nobsKey = 'noOfBags' . $i;

                        // Fetch the nop data for the current passenger
                        $fullname = $protocols[$fullnameKey] ?? '';
                        $pnr = $protocols[$pnrKey] ?? '';
                        $ticket_no = $protocols[$ticket_noKey] ?? '';
                        $nobs = $protocols[$nobsKey] ?? '';

                        // Construct the data string for the current passenger
                        $passengerData = "Passenger $i:\n";
                        $passengerData .= "Full Name: $fullname\n";
                        $passengerData .= "PNR: $pnr\n";
                        $passengerData .= "E-Ticket No.: $ticket_no\n";
                        $passengerData .= "No. Of Bags: $nobs\n";

                        // Append the passenger data to the main data string
                        $data .= $passengerData . "\n";
                    }
                    //dd($data);
                    $qrCode = QrCode::size(200)->generate($data);
    
                    //$pdf = PDF::loadView('ticket', ['path' => $path, 'qrCode' => $qrCode, 'plan' => $plan,]);
                    $pdf = PDF::loadView('ticket', ['path' => $path, 'qrCode' => $qrCode, 'pnr' => $protocols['reservationCode'], 'nobs' => $protocols['noOfBags'], 'ticket_no' => $protocols['eTicketNo'], 'plan' => $plan, 'optional_request' => $optional_request, 'optional_requestOption' => $optional_requestOption, 'optional_requestAddress' => $optional_requestAddress, 'nop' => $nop], );
                    
                    $pdf->setPaper('a4', 'portrait');
                
                    $pdfDirectory = public_path('assets/pdf/');
                    $pdfFileName = $ticketid . '.pdf';
                    $pdf->save($pdfDirectory . $pdfFileName);

                    
                    //dd($email, $emailfullname); 
                    
                    $emailCopy = "damilola@travelwheel.ng";
                        $protocolMail = new ProtocolMail($email, $emailfullname);
                        $protocolMail->attach($pdfDirectory . $pdfFileName);
                        Mail::to($email)->send($protocolMail);

                        $protocolCopyMail = new ProtocolCopyMail($email, $emailfullname);
                        $means_id_image = $protocols['means_id'];
                        $means_idDirectory = public_path('assets/means_id/');
                        $protocolCopyMail->attach($means_idDirectory . $means_id_image);
                
                        $protocolCopyMail->attach($pdfDirectory . $pdfFileName);
                        // Send the email after attaching all the files
                        Mail::to($emailCopy)->send($protocolCopyMail);
                        return redirect('/air/protocolsuccess');
                    
                    //Mail::to($email)->send(new ProtocolMail($email, $fullname));

                }
            }
            else{
                echo "Booking Failed "; 
            }
        }
        elseif ("Cancelled" ==  $data['message']){
            return view('air.protocol.protocol_checkout');
        }
        else{
            //Put desired action/code after transaction has failed here
        }
    }

    public function protocol_success()
    {
        return view('air.protocol.protocol_success');
    }
}
