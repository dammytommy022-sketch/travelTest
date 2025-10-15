<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <title>TravelWheel | Air - Airport Protocol </title>
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <style>
        .input-control {
    display: block;
    width: 100%;
    padding: .175rem .25rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border-top-style: hidden;
    border-right-style: hidden;
    border-left-style: hidden;
    border-bottom: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
      }
      
      .no-outline:focus {
        outline: none;}

       
        .hidden {
        display: none;
        }
        #loading-screen {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
        z-index: 9999; /* Ensure it's above other content */
        text-align: center;
    }

    #loading-screen img {
        margin-top: 15%; /* Adjust this value to center the image vertically */
        max-width: 40%;
        max-height: 40%;
    }

    @media (max-width: 768px) {
        #loading-screen img {
            margin-top: 20%; /* Adjust for smaller screens */
        } 
    }
</style>
    
</head>

<body>
    <!-- Navbar -->
    <section>
    @include('layouts.newnav') 
    </section>
    <!-- Navbar -->
    <main id="main" style="padding-top: 60px;">
        <section class="shadow-sm">
            <div class="container">
                <div class="row p-2 pt-5 ">
                    <div class="col-sm-8 p-3 ">
                        <h3> <img src="{{ asset('public/assets/img/pp.png') }}" class="image-fluid wd-25" alt="protocol"> Airport Protocol Service </h3>
                        
                    </div>
                </div>
            
            <div class="row airport-form shadow p-4 mb-5">
          
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Protocol Service Checkout</h5>
                        </div>
                        <div class="card-body">
                            <div class="hidden">
                                <div class="passenger mb-2">
                                    <div class="col-sm-12 ">
                                        <fieldset class="border p-2">
                                            <small> <b>Passenger 1:</b></small>
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <label class="form-label" for="firstname">Firstname</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="fa fa-file"></i></span>
                                                        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="basic-icon-default-fullname2" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <label class="form-label" for="lastname">Lastname</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="fa fa-file"></i></span>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="basic-icon-default-fullname2" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <label class="form-label" for="pnr">PNR / Reservation Code</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="fa fa-file"></i></span>
                                                        <input type="text" class="form-control" name="pnr" id="pnr" aria-describedby="basic-icon-default-fullname2" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <label class="form-label" for="ticket-no">e-Ticket No.</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="fa fa-file"></i></span>
                                                        <input type="text" class="form-control" name="ticket-no" id="ticket-no" aria-describedby="basic-icon-default-fullname2" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <label class="form-label" for="nobs">Number of Bags</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                                        <input type="number" class="form-control" name="nobs" id="nobs" aria-describedby="basic-icon-default-fullname2" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <label for="formFile" class="form-label">Upload Means Of ID</label>
                                                    <input class="form-control" type="file" name="means-id" id="formFile" required>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <form id="payment-form" action="{{ route('air.protocolmakePurchase')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <input type="hidden"  name="plan" value="{{$dataform['plan']}}">
                                <input type="hidden" name="nops" id="nops" value="{{$dataform['nop']}}"/>
                                <div class="row">
                                    <h6>Passengers Flight Details</h6>
                                    <hr>
                                    
                                    <div id="duplicate-container"></div>
                                    @if ($dataform['airport'] == 'International Airport') 
                                        @if ($dataform['optinal_requestD'])
                                        <div class="passenger mb-2">
                                            <div class="col-sm-12 ">
                                                <fieldset class="border p-2">
                                                    <small> <b>Pick-Up Details:</b></small>
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label" for="pickUpAddress">Pick-Up Location:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                                <input type="text" class="form-control" name="pickUpAddress" id="pickUpAddress" aria-describedby="basic-icon-default-fullname2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label" for="pickUpAddress">Pick-Up Vehicle:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-vehicle"></i></span>
                                                                <input type="text" class="form-control" name="pickUpVehicle" id="pickUpVehicle" value="{{$optionalVehicle}}" aria-describedby="basic-icon-default-fullname2" required>
                                                                <input type="hidden" name="seaters" value="{{$seaters}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        @elseif($dataform['optinal_requestA'])
                                        <div class="passenger mb-2">
                                            <div class="col-sm-12 ">
                                                <fieldset class="border p-2">
                                                    <small> <b>Drop-Off Details:</b></small>
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label" for="dropOffAddress">Drop-Off Location:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                                <input type="text" class="form-control" name="dropOffAddress" id="dropOffAddress" aria-describedby="basic-icon-default-fullname2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label" for="dropOffAddress">Drop-Off Vehicle:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-vehicle"></i></span>
                                                                <input type="text" class="form-control" name="dropOffVehicle" id="dropOffVehicle" value="{{$optionalVehicle}}" aria-describedby="basic-icon-default-fullname2" required>
                                                                <input type="hidden" name="seaters" value="{{$seaters}}" >
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        @endif
                                    @elseif ($dataform['airport'] == 'Local Airport')
                                        @if ($dataform['optinal_requestD2'])
                                        <div class="passenger mb-2">
                                            <div class="col-sm-12 ">
                                                <fieldset class="border p-2">
                                                    <small> <b>Pick-Up Details:</b></small>
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label" for="pickUpAddress">Pick-Up Location:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                                <input type="text" class="form-control" name="pickUpAddress" id="pickUpAddress" aria-describedby="basic-icon-default-fullname2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 mb-2">
                                                            <label class="form-label" for="pickUpAddress">Pick-Up Vehicle:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-vehicle"></i></span>
                                                                <input type="text" class="form-control" name="pickUpVehicle" id="pickUpVehicle" value="{{$optionalVehicle}}" aria-describedby="basic-icon-default-fullname2" required>
                                                                <input type="hidden" name="seaters" value="{{$seaters}}" >
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        @elseif($dataform['optinal_requestA2'])
                                        <div class="passenger mb-2">
                                            <div class="col-sm-12 ">
                                                <fieldset class="border p-2">
                                                    <small> <b>Drop-Off Details:</b></small>
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <label class="form-label" for="dropOffAddress">Drop-Off Location:</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa fa-map"></i></span>
                                                                <input type="text" class="form-control" name="dropOffAddress" id="dropOffAddress" aria-describedby="basic-icon-default-fullname2" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                    
                                    <div class="passenger mb-2">
                                        <div class="col-sm-12 ">
                                            <fieldset class="border p-2">
                                                <small> <b>Next of Kin Details:</b></small>
                                                <div class="row">
                                                    <div class="col-sm-6 mb-2">
                                                        <label class="form-label" for="dropOffAddress">Full Name:</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="nextOfKin_fullname" id="nextOfKin_fullname" aria-describedby="basic-icon-default-fullname2" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <label class="form-label" for="dropOffAddress">Phone Number:</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                            <input type="text" class="form-control" name="nextOfKin_phone" id="nextOfKin_phone" aria-describedby="basic-icon-default-fullname2" required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mt-3">  
                                    <small class="text-muted mb-2"><b>Confirm your details</b></small>
                                    <hr>
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="state">Location</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="state" id="state" value="{{$dataform['location']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['location']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="airport">Airport</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="airport" id="airport" value="{{$dataform['airport']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['airport']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="travel_date">Travel Date</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="travel_date" id="travel_date" value="{{$dataform['travel_date']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['travel_date']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="d_time">{{$dataform['service']}} Time</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="d_time" id="d_time'" value="{{$dataform['d_time']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['d_time']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="airport">Airline</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="airline" id="airport" value="{{$dataform['airline']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['airline']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="no_of_passenger">No. of Passengers</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="no_of_passenger" id="nop" value="{{$dataform['nop']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                                <input type="hidden" class="input-control no-outline" name="package" id="plan" value="{{$dataform['plan']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['nop']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="phone_no">Phone Number</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="phone" id="phone_no" value="{{$dataform['phone_no']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['phone_no']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="email" id="email" value="{{$dataform['email']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$dataform['email']}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="airport">Optional Request</label>
                                            <div class="checkout">
                                                <input type="hidden" class="input-control no-outline" name="optional_request" value="{{$optinal_request}}"
                                                aria-describedby="basic-icon-default-fullname2"/>

                                            <input type="text"  disabled class="input-control no-outline"  value="{{$optinal_request.': '.$optionalVehicle}}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden"  name="service" value="{{$dataform['service']}}"/>
                                </div>  
                                <div class="col-12 p-3 text-center">
                                    <a href="javascript:history.back()" class="btn btn-sm btn-secondary">
                                        Back to Edit 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card-body bg-light">
                            <h5> Protocol Service Price</h5>
                            @php
                                $c_amount = $dataform['amount'];
                                $amount = (int) str_replace(',', '', $c_amount);
                                if ($dataform['airport'] == 'International Airport') {
                                    if ($dataform['optinal_requestD']){
                                        $totalPrice = $amount;
                                    }
                                    elseif ($dataform['optinal_requestA']){
                                        $totalPrice = $amount;
                                    }
                                    else{
                                        $totalPrice = $amount;
                                    }
                                }
                                elseif ($dataform['airport'] == 'Local Airport'){
                                    if ($dataform['optinal_requestD2']){
                                        $totalPrice = $amount;
                                    }
                                    elseif ($dataform['optinal_requestA2']){
                                        $totalPrice = $amount;
                                    }
                                    else{
                                        $totalPrice = $amount;
                                    }
                                }  
                                $percentage = 7.5;
                                $result = ($percentage / 100) * $totalPrice;
                                $total = $totalPrice + $result;
                            @endphp
                            <div class="row">
                                <div class="col-7 col-sm-9">
                                    <span for="">Amount For Service</span>
                                </div>
                                <div class="col-5 col-sm-3 text-center">
                                    <span for="">₦{{$dataform['amount']}}</span>
                                    <input type="hidden" id="priceInput" name="c_amount" value="{{$dataform['amount']}}">
                                </div><br>
                                <hr>
                            </div>
                            {{--
                                @if ($dataform['airport'] == 'International Airport') 
                                    @if ($dataform['optinal_requestD'])
                                    <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for="">Pick-Up Price</span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span for="">₦0</span>
                                            <input type="hidden" id="priceInput" name="pickUpPrice" value="0">
                                        </div><br>
                                        <hr>
                                    </div>
                                    @elseif($dataform['optinal_requestA'])
                                    <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for="">Drop-Off Price</span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span for="">₦{{$dropOffPrice}}</span>
                                            <input type="hidden" id="priceInput" name="dropOffPrice" value="{{$dropOffPrice}}">
                                        </div><br>
                                        <hr>
                                    </div>
                                    @endif
                                @elseif ($dataform['airport'] == 'Local Airport')
                                    @if ($dataform['optinal_requestD2'])
                                    <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for="">Pick-Up Price</span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span for="">₦{{$pickUpPrice}}</span>
                                            <input type="hidden" id="priceInput" name="pickUpPrice" value="{{$pickUpPrice}}">
                                        </div><br>
                                        <hr>
                                    </div>
                                    @elseif($dataform['optinal_requestA2'])
                                    <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for="">Drop-Off Price</span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span for="">₦{{$dropOffPrice}}</span>
                                            <input type="hidden" id="priceInput" name="dropOffPrice" value="{{$dropOffPrice}}">
                                        </div><br>
                                        <hr>
                                    </div>
                                    @endif
                                @endif
                            --}}
                            <div class="row">
                                <div class="col-7 col-sm-9">
                                    <span for="">Value Added Tax (VAT)</span>
                                </div>
                                <div class="col-5 col-sm-3 text-center">
                                    <span id="result" for="">₦{{$result}}</span>
                                    <input type="hidden" id="vat" name="vat" value="{{$result}}">
                                    <p id="result"></p>
                                </div><br>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-7 col-sm-9">
                                    <span for=""><b>Total Amount Including Tax</b></span>
                                </div>
                                <div class="col-5 col-sm-3 text-center">
                                    <span id="result" for="">₦{{$total}}</span>
                                    <input type="hidden" id="p_amount" name="p_amount" value="{{$total}}">
                                    <p id="result"></p>
                                </div><br>
                                <hr>
                                @if(($dataform['optinal_requestD'] ?? false) || ($dataform['optinal_requestD2'] ?? false))
                                    <div class="text-end mb-2">
                                        <small class="text-danger">Please Note that Pick-UP Price Is Not Included. </small>
                                    </div>
                                @elseif(($dataform['optinal_requestA'] ?? false) || ($dataform['optinal_requestA2'] ?? false))
                                    <div class="text-end mb-2">
                                        <small class="text-danger">Please Note that Drop-Off Price Is Not Included. </small>
                                    </div>
                                @endif

                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="paymentoption">Payment Option</label>
                                    <select class="form-select" name="payment_option" aria-label="Default select example">
                                            <option value="">-- Select Payment Option --</option>
                                            <option value="seerbit">SEER BIT</option>
                                            <option value="fluterwave">FluterWave</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6 text-end">
                                    <button type="submit" class="btn btn-pry">Purchase</button>
                                </div>
                            </div>
                            


                        </div>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
            


</section>
    <div id="loading-screen" style="display: none;">
        <!-- Loading screen content (e.g., logo, loading message) -->
        <!-- Loading screen content (e.g., logo, loading message) -->
         <video width="640" height="480" autoplay muted loop>
            <source src="{{ asset('public/assets/dist/loading.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <p>Loading... Please wait.</p>
    </div>

    <script src="{{ asset('public/assets/dist/please-wait.min.js') }}"></script>

    <script type="text/javascript">
        // Function to show the loading screen
        function showLoadingScreen() {
            document.getElementById('loading-screen').style.display = 'block';
        }

        // Function to hide the loading screen
        function hideLoadingScreen() {
            document.getElementById('loading-screen').style.display = 'none';
        }

        // Event listener for form submission
        document.getElementById('payment-form').addEventListener('submit', function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Display the loading screen
            showLoadingScreen();

            // Submit the form after a short delay (simulating API call)
            setTimeout(function () {
                document.getElementById('payment-form').submit();
            }, 600); // Adjust the delay as needed
        });
    </script>
      
   
<script>
    function duplicateFormElements() {
        const nop = parseInt(document.getElementById('nop').value);

        if (isNaN(nop) || nop <= 0) {
            alert('Please enter a valid number greater than 0.');
            return;
        }

        const originalCard = document.querySelector('.passenger');
        const duplicateContainer = document.getElementById('duplicate-container');

        // Clear any existing duplicated cards
        duplicateContainer.innerHTML = '';

        for (let i = 1; i <= nop; i++) {
            const newCard = originalCard.cloneNode(true);
            newCard.querySelector('small').textContent = `Passenger ${i}`; // Update the child number in the duplicated card
           
                // Update the attribute names for input and selection fields
            newCard.querySelectorAll('input').forEach(input => {
                    const currentName = input.getAttribute('name');
                    input.setAttribute('name', `${currentName}${i}`);
                });

                
           
            duplicateContainer.appendChild(newCard);
        }
    }

    // Automatically invoke the duplication function when the page loads
    window.addEventListener('load', duplicateFormElements);
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    


    </main>
        @include('layouts.footer')
</body>

</html>
