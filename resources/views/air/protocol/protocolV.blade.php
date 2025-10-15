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
                    <div class="col-sm-6 p-3 ">
                        <h3> <img src="{{ asset('public/assets/img/pp.png') }}" class="image-fluid wd-25" alt="protocol"> Airport Protocol Service </h3>
                        
                    </div>
                </div>
            
            <div class="row airport-form shadow p-4 mb-5">
            <div class="col-sm-4 mb-3">
                    <div class="bg-light p-3 shadow-sm protocol"  >
                            <p style="color: rgba(13, 156, 83, 1);"> <b>Benefits of Our Protocol Services for VIP</b> </p>
                            <ul class="list-unstyled">
                            <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> Meet and Greet.</b>
                            (Passagers are received with Name on Placards from the Drop-off point. )
                        </li>
                        <li class="text-muted"><i class="fa fa-check" style="color:green"></i> <b> No Queuing </b>
                            (Passagers are Fast Tracked through Checking Process)
                        </li>
                        <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                            Boarding Gate Fast Track Process
                        </li>
                        <li class="text-muted"><i class="fa fa-check" style="color:green"></i>
                            Leading to the Aircraft feet or Lounge any that is required.
                        </li></ul>
                           <p>NB: <span class="text-muted">A Protocol Pass will be generated, after transaction been made. It expire after departure.</span>
                   </p>
                        </div>
                </div>
                <div class="col-sm-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h6 class="mb-0" style="color: rgba(13, 156, 83, 1);">Flight Details</h6>
                      <small class="text-muted float-end">FIll in details</small>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('air.protocol_checkout')}}" method="POST">
                      {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Fist Name</label>
                                    <div class="input-group input-group-merge">
                                        <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter first name"
                                        aria-describedby="basic-icon-default-fullname2" value="{{Session::get('firstname')}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Last Name</label>
                                    <div class="input-group input-group-merge">
                                        <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="lastname" id="firstname" placeholder="Enter last name"
                                        aria-describedby="basic-icon-default-fullname2" value="{{Session::get('lastname')}}"/>
                                    </div>
                                </div>
                            </div>
                        
                        
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" name="phone_no" id="firstname" placeholder="Your phone number"
                                        aria-describedby="basic-icon-default-fullname2" value="{{Session::get('phone_no')}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Email Address</label>
                                    <div class="input-group input-group-merge">
                                        <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" name="email" id="firstname" placeholder="Email Address"
                                        aria-describedby="basic-icon-default-fullname2" value="{{Session::get('email')}}"/>
                                    </div>
                                </div>
                            </div>
                       
                        
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Travel Date</label>
                                    <input class="form-control" type="date" name="travel_date"  id="html5-date-input" value="{{Session::get('travel_date')}}"/>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Departure Time</label>
                                    <input type="time" name="d_time" class="form-control" value="{{Session::get('d_time')}}"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">State</label>
                                    <input type="text" name="" class="form-control" value="{{$data['state']}}" readonly/>
                                    <input type="hidden" name="state" class="form-control" value="{{$data['state']}}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                <label class="form-label" for="firstname">Airport</label>
                                    <input type="text" name="" class="form-control" value="{{$airports}}" readonly/>
                                    <input type="hidden" name="airport" id="airport" class="form-control" value="{{$airports}}" />
                                </div>
                            </div>
                            <div class="col-sm-6 hidden" id="airline1" >
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Select Airline</label>
                                     <div class="input-group input-group-merge">
                                    
                                        <select class="form-select" id="airlineselect1" name="airline1" aria-label="Default select example">
                                            <option value="">-- Choose Airline --</option>
                                            <option value="AIR COTE D'IVOIRE">AIR COTE D'IVOIRE</option>
                                            <option value="ARIK AIR">ARIK AIR</option>
                                            <option value="ASKY AIRLINES">ASKY AIRLINES</option>
                                            <option value="AIR FRANCE5">AIR FRANCE5</option>
                                            <option value="AIR NAMIBIA">AIR NAMIBIA</option>
                                            <option value="BRITISH AIRWAYS">BRITISH AIRWAYS</option>
                                            <option value="DELTA AIRLINES">DELTA AIRLINES</option>
                                            <option value="Egypt Airline">Egypt Airline</option>
                                            <option value="Emirates Airlines">Emirates Airlines</option>
                                            <option value="ETHIOPIAN AIRLINES">ETHIOPIAN AIRLINES</option>
                                            <option value="ETIHAD AIRWAYS">ETIHAD AIRWAYS</option>
                                            <option value="KENYA AIRWAYS">KENYA AIRWAYS</option>
                                            <option value="KLM">KLM</option>
                                            <option value="LUFTHANSA">LUFTHANSA</option>
                                            <option value="QATAR AIRWAYS">QATAR AIRWAYS</option>
                                            <option value="ROYAL AIR MAROC">ROYAL AIR MAROC</option>
                                            <option value="RWANDA AIR">RWANDA AIR</option>
                                            <option value="SOUTH AFRICAN AIRWAYS">SOUTH AFRICAN AIRWAYS</option>
                                            <option value="TURKISH AIRLINE">TURKISH AIRLINE</option>
                                            <option value="VIRGIN ATLANTIC">VIRGIN ATLANTIC</option>
                                            <option value="TAP PORTUGAL">TAP PORTUGAL</option>
                                            <option value="AFRICAN WORLD AIRLINES">AFRICAN WORLD AIRLINES</option>
                                            <option value="MID AFRICA AIRLINES">MID AFRICA AIRLINES</option>
                                            <option value="SAUDI ARABIAN AIRLINE">SAUDI ARABIAN AIRLINE</option>
                                            <option value="AIRPEACE">AIRPEACE     </option>   
                                            <option value="OTHERS">OTHERS</option>                                   
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden" id="other1" >
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Other Airline</label>
                                     <div class="input-group input-group-merge">
                                     <input type="text" class="form-control" name="other1" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden" id="airline2" >
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Select Airline</label>
                                     <div class="input-group input-group-merge">
                                    
                                        <select class="form-select" id="airlineselect2"  name="airline2" aria-label="Default select example">
                                            <option value="">-- Choose Airline --</option>
                                            <option value="AIR PEACE">AIR PEACE</option>
                                            <option value="DANA AIR">DANA AIR</option>
                                            <option value="MAX AIR">MAX AIR</option>
                                            <option value="OVERLAND AIRWAYS">OVERLAND AIRWAYS</option>
                                            <option value="AERO">AERO</option>
                                            <option value="IBOM AIR">IBOM AIR</option>
                                            <option value="UNITED NIGERIA">UNITED NIGERIA</option>
                                            <option value="AZMAN">AZMAN</option>
                                            <option value="ARIK">ARIK</option>
                                            <option value="GREEN AFRICA">GREEN AFRICA</option>
                                            <option value="VALUE JET">VALUE JET</option>
                                            <option value="FIRST NATION AIRLINE">FIRST NATION AIRLINE</option>
                                            <option value="IRS AIRLINE">IRS AIRLINE</option>
                                            <option value="KABO AIR">KABO AIR</option>
                                            <option value="OTHERS">OTHERS</option>                       
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden" id="other2" >
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">Other Airline</label>
                                     <div class="input-group input-group-merge">
                                     <input type="text" class="form-control" name="other2" value="">
                                    </div>
                                </div>
                            </div>
                       
                            
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname">No. of Passengers</label>
                                    <div class="input-group input-group-merge">
                                        <span id="fullname" class="input-group-text"><i class="fa fa-users"></i></span>
                                        <select id="my-select" onchange="displaySelectedOption()" class="form-select" name="no_of_passenger" aria-label="Default select example">
                                            <option value="">-- Select Number Of Passenger --</option>
                                            <option value="1">Travling ALone</option>
                                            <option value="2">Traveling with Family (Couple)</option>
                                            <option value="3">Traveling with Family (Family of 1)</option>
                                            <option value="4">Traveling with Family (Family of 2)</option>
                                            <option value="5">Traveling with Family (Family of 3)</option>
                                            <option value="6">Traveling with Family (Family of 4)</option>
                                            <option value="More">Traveling with Family (Family of More)</option>
                                        </select>
                                        <input type="hidden" id="selectedAmount" name="amount" value="">
                                        <input type="hidden"  name="plan" value="VIP">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                <input class="form-check-input" type="checkbox" name="terms" value="" id="defaultCheck1" />
                                    <label class="form-check-label" for="defaultCheck1">I agreed to Terms & Services.</label>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <p>Amount: NGN <span id="selected-option">25,000</span> </p>

                                <script>
                                function displaySelectedOption() {
                                    var select = document.getElementById("my-select");
                                    var selectedOption = select.options[select.selectedIndex].value;
                                    const selectedAmount = document.getElementById("selectedAmount");
                                    let Amount;
                                        if (selectedOption == "1") {
                                            Amount = "25,000";
                                        } else if (selectedOption == "2") {
                                            Amount = "30,000";
                                        } else if (selectedOption == "3") {
                                            Amount = "35,000";
                                        } else if (selectedOption == "4") {
                                            Amount = "40,000";
                                        } else if (selectedOption == "5") {
                                            Amount = "45,000";
                                        } else if (selectedOption == "6") {
                                            Amount = "50,000";
                                        } else {
                                            Amount = "70,000";
                                        }
                                    document.getElementById("selected-option").innerHTML = Amount;
                                    selectedAmount.value = Amount;
                                }
                                </script>
                                <script>
                                        var airport = document.getElementById("airport");
                                        var airline1 = document.getElementById("airline1");
                                        var airline2 = document.getElementById("airline2");
                                            if (airport.value === "International Airport") {
                                                airline1.style.display = "block";
                                                airline2.style.display = "none";
                                            }
                                            else if (airport.value === "Local Airport") {
                                                airline1.style.display = "none";
                                                airline2.style.display = "block";
                                            }
                                </script>
                                <script>
                                        var airlineselect1 = document.getElementById("airlineselect1");
                                        var airlineselect2 = document.getElementById("airlineselect2");
                                        var other1 = document.getElementById("other1");
                                        var other2 = document.getElementById("other2");

                                        airlineselect1.addEventListener("change", function() {
                                            if (airlineselect1.value === "OTHERS") {
                                                other1.style.display = "block";
                                            }
                                            else {
                                                other1.style.display = "none";
                                            }
                                        })
                                        airlineselect2.addEventListener("change", function() {
                                            if (airlineselect2.value === "OTHERS") {
                                                other2.style.display = "block";
                                            }
                                            else {
                                                other2.style.display = "none";
                                            }

                                        })
                                </script>
                            </div>
                        </div>
                       <center> <input type="submit" class="btn btn-pry" value="Book Service" /></center>
                      </form>
                    </div>
                  </div>
                </div>
               
            </div>
            </div>
            


</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    


    </main>
        @include('layouts.footer')
</body>

</html>
