<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Travel Insurance</title>
    <link rel="stylesheet" href="../public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <script src="../public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../public/assets/fontawesome-6/dist-font/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    
    <style>
        .hidden {
        display: none;
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
                    <div class="col-sm-12 p-3 ">
                        <div class="row">
                             <div class="col-6 col-sm-3 col-lg-2">
                                <img src="{{ asset('public/assets/img/allianz.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                        </div>
                    </div>
                </div>
            
            
                <!-- <div class="col-sm-5">
                    <div class="bg-light p-3 shadow-sm protocol" style="border-radius:15px;" >
                            
                        
                    </div>
                </div> -->
                @if($dataform)
                
               <form action="{{ url('/air/makeRequestPurchase')}}" method="POST">
                      {{ csrf_field() }}
                    <div class="row airport-form shadow p-4 mb-5">
                        <div class="col-sm-7">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Insurance Purchase</h5>
                                    <small class="text-muted float-end">
                                        Next Of Kin Details
                                    </small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="fullname">Fullname</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                    <input type="text" class="form-control" name="fullname" id="fullname" required placeholder="Next of Kin Fullname"
                                                    aria-describedby="basic-icon-default-fullname2"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="service_date">Address</label>
                                                <input class="form-control" type="text" name="address" required /> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="phone_no">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                                    <input type="text" class="form-control" name="phone_no" id="phone_no" value="" required placeholder="Phone number"
                                                    aria-describedby="basic-icon-default-fullname2"/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="mb-3"> 
                                                <label class="form-label" for="relationship">Relationship</label>
                                                <input class="form-control" type="text" name="relationship"  required/>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- Button to take the user to the next page -->
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="card-body bg-light">
                                <h5> Cover Purchase Price</h5>
                                @php
                                    $amount = $dataform['amount'];
                                    $percentage = 7.5;
                                    $result = ($percentage / 100) * $amount;
                                    $total = $amount;
                                @endphp
                                     <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for="">Amount Of Cover</span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span for="">₦{{ number_format($dataform['amount'], 0) }}</span>
                                            
                                            <input type="hidden" id="priceInput" name="c_amount" value="{{$dataform['amount']}}">
                                        </div><br>
                                        <hr>
                                    </div>
                                    {{--
                                    <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for="">Value Added Tax (VAT)</span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span id="result" for="">₦{{ $result}}</span>
                                            <input type="hidden" id="vat" name="vat" value="{{$result}}">
                                            <p id="result"></p>
                                        </div><br>
                                        <hr>
                                    </div>
                                    --}}
                                    <div class="row">
                                        <div class="col-7 col-sm-9">
                                            <span for=""><b>Total Amount {{--Including Tax --}}</b></span>
                                        </div>
                                        <div class="col-5 col-sm-3 text-center">
                                            <span id="result" for="">₦{{ number_format($total, 0)}}</span>
                                            <input type="hidden" id="p_amount" name="p_amount" value="{{$total}}">
                                            <p id="result"></p>
                                        </div><br>
                                        <hr>
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
                        
                    
                    
                    </div>
                </form>
                @endif 
        </div>
            
</section>









<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    


    </main>
</body>

</html>
