<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <title>Travel Wheel | Air - Airport Protocol </title>
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    
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
                    <!-- <h3> <img src="../assets/img/pp.png" class="image-fluid wd-25" alt="protocol"> Airport Protocol Plans </h3> -->
                        
                    <div class="col-sm-12 p-3 ">
                    <div class="row">
                         <div class="col-xs-3 col-3 col-sm-2 col-lg-1">
                            <img src="{{ asset('public/assets/img/pp.png') }}" class="image-fluid w-100" alt="protocol"> 
                         </div>
                         <div class="col-xs-12 col-12 col-sm-10 col-lg-7 protocol">
                             <h3>   Airport Protocol and Services  </h3>
                                <span class="text-muted">
                                    As part of our aggregating effort we can also assist you with some of 
                                    the services you can get within the airport zone. We are committed to 
                                    making your travel experience remarkable with all support and fast-tracking 
                                    services within the airport.
                                </span>
                         </div>
                    </div>
                </div>
            
                <!-- Packages -->
                <div class="row pb-90">
                    <div class="col-md-5 pb-3">
                        <div class="bg-light p-3 shadow-sm protocol"  >
                            <p style="color: rgba(13, 156, 83, 1);"> <b>All the benefits of using our Airport Protocol Services In All Nigeria International Airports</b> </p>
                            <input type="hidden" value="{{Session::get('data')['service']}}" id="trip">
                            <ul class="list-unstyled"  >
                                <li> <i class="fa fa-check"></i> Meet and Greet.</li>
                                <li><i class="fa fa-check"></i> Exclusive Baggage Handling. </li>
                                <li><i class="fa fa-check"></i> No Queue.</li>
                                <li><i class="fa fa-check"></i> Fast-tracking Check-in Process.</li>
                                <li><i class="fa fa-check"></i> Stress free Check-in Process.</li>
                                <li><i class="fa fa-check"></i> Escort through Boarding Gate. </li> 
                                <li><i class="fa fa-check"></i> Escort to the Arrival Lobby. </li> 
                                <li><i class="fa fa-check"></i> Cordinate Passenger to their Pre-arranged Transportation. </li>
                                <li><i class="fa fa-check"></i> Other relevant Airport Protocol Service as case may be.</li>
                                <li><i class="fa fa-angle-right" style="font-size:24px;"></i> Pick-up Request (Optional)</li>
                                <li><i class="fa fa-angle-right" style="font-size:24px;"></i> Drop-off Request (Optional)</li>
                                <li><i class="fa fa-angle-right" style="font-size:24px;"></i> Police Escort Request (Optional)</li>
                            </ul>
                            <h6>NB: <span > <b style="color:red;">A Protocol Boarding Pass will be generated after a Succefful transaction. It expires after Departure / Arrival date.</span>
                            </b></h6>
                            
                            
                        </div>
                    </div>
    
    
                    <div class="col-md-7">
                        <div class="row">
                            <div class="hidden" id="departure">
                                <div class="row">
                                    <div class=" col-sm-6" >
                                        <div class="single-package " data-animate="fadeInUp" data-delay=".1">
                                            <div class="text-center">
                                                <h4>Regular Plan</h4>
                                                <hr> 
                                            </div>
                                            
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Meet and Greet.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Exclusive Baggage Handling.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> No Queuing </b>
                                                </li>
                                                
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Stress free Check-in Process.</b>
                                                </li>
                                                
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Other relevant Airport Protocol Service as case may be.</b>
                                                </li>
                                                
                                            </ul>
                                            <div class="text-center">
                                                @php
                                                    $formattedprice1 =  number_format($price1, 0, '', ','); 
                                                    $formattedprice2 =  number_format($price2, 0, '', ','); 
                                                    $plan1 = "1";
                                                    $plan2 = "2"
                                                @endphp

                                                <p><sup>₦</sup>{{$formattedprice2}}<span>/Passenger</span></p>
                                                <a href="{{ route('air.protocolForm', ['plan' => $plan2]) }}" class="btn btn-pry">Select This Plan</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-6 ">
                                        <div class="single-package " data-animate="fadeInUp" data-delay=".1">
                                            <div class="text-center">
                                                <h4>VIP Plan</h4>
                                                <hr> 
                                            </div>
                                            
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Meet and Greet.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Exclusive Baggage Handling.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                <b> Fast-tracking Check-in Process.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> No Queuing </b>
                                                </li>
                                                
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                <b>Stress free Check-in Process.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                <b> Escort through Boarding Gate.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Other relevant Airport Protocol Service as case may be.</b>
                                                </li>
                                                
                                            </ul>
                                            <div class="text-center">
                                                <p><sup>₦</sup>{{$formattedprice1}}<span>/Passenger</span></p>
                                                <a href="{{ route('air.protocolForm', ['plan' => $plan1]) }}" class="btn btn-pry">Select This Plan</a>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="hidden" id="arrival">
                                <div class="row">
                                    <div class=" col-sm-6">
                                        <div class="single-package" data-animate="fadeInUp" data-delay=".4">
                                            <div class="text-center">
                                                <h4>Regular Plan</h4>
                                                <hr> 
                                            </div>
                                            
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Meet and Greet.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Exclusive baggage handling. </b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Escort to the Arrival Lobby.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Cordinate Passenger to their Pre-arranged Transportation.</b>
                                                </li> 
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Other relevant Airport protocol service as case may be.</b>
                                                </li> 
                                            </ul>
                                            <div class="text-center">
                                                <p><sup>₦</sup>{{$formattedprice2}}<span>/Passenger</span></p>
                                                <a href="{{ route('air.protocolForm', ['plan' => $plan2]) }}" class="btn btn-pry">Select This Plan</a>
                                            </div>


                                        </div>
                                    </div>
                                    <div class=" col-sm-6">
                                        <div class="single-package" data-animate="fadeInUp" data-delay=".4">
                                            <div class="text-center">
                                                <h4>VIP Plan</h4>
                                                <hr> 
                                            </div>
                                            
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Meet and Greet.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Exclusive baggage handling. </b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Escort to the Arrival Lobby.</b>
                                                </li>
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Cordinate Passenger to their Pre-arranged Transportation.</b>
                                                </li> 
                                                <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                                                    <b>Other relevant Airport protocol service as case may be.</b>
                                                </li> 
                                            </ul>
                                            <div class="text-center">
                                                <p><sup>₦</sup>{{$formattedprice1}}<span>/Passenger</span></p>
                                                <a href="{{ route('air.protocolForm', ['plan' => $plan1]) }}" class="btn btn-pry">Select This Plan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                var trip = document.getElementById("trip");
                                var arrival = document.getElementById("arrival");
                                var departure = document.getElementById("departure");
                                 
                                if (trip.value === "Arrival"){
                                    arrival.style.display = "block";
                                }
                                else if(trip.value === "Departure"){
                                    departure.style.display = "block";
                                }
                            </script>
            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Packages -->
        </section>
    


    </main>
        @include('layouts.footer')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</body>

</html>
