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

        <div class="container-fluid">
            <img src="{{ asset('public/assets/image/Protocol.jpg') }}" class="image-fluid w-100" alt="">
        </div>

        <section class="shadow-sm">
            <div class="container">
                <div class="row p-2 pt-5 ">
                    <div class="col-sm-12 p-3 ">
                        <div class="row">
                            <div class="col-xs-3 col-3 col-sm-2 col-lg-1">
                                <img src="{{ asset('public/assets/img/pp.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>

                            <div class="col-xs-12 col-12 col-sm-10 col-lg-8 protocol">

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
                </div>
                <div class="row pb-90">
                    <div class="col-sm-6">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Select Airport</h5>
                            </div>
                            <div class="card-body">
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3 " >
                                            <label class="form-label" for="firstname">Location</label>
                                            <select class="form-select" id='stateselect' name="state" aria-label="Default select example" required>
                                                <option value="">-- Select Location --</option>
                                                    <option value="Abuja">FCT -Abuja </option>
                                                    <!-- <option value="2">Kano -Kano </option> -->
                                                    <option value="Lagos">Lagos -Ikeja</option>
                                                    <!-- <option value="4">Cross-river -Portharcourt</option> -->
                                            </select>
                                        </div>
                                        <div class="hidden" id="airport1">
                                            <form action="{{ route('air.protocolplan')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="location" value="Abuja">
                                                <div class="mb-3 " >
                                                    <label class="form-label" for="firstname">Airport </label>
                                                    <select class="form-select" id='airportSelect' name="airport" aria-label="Default select example" required>
                                                        <option value="">-- Choose Airport --</option>
                                                        <option value="International Airport">International Airport </option>
                                                        <option value="Local Airport">Local Airport </option> 
                                                    </select>
                                                    @error('airport')
                                                        <small class="text-danger ">{{ $message }}</small>
                                                    @enderror
                                                    
                                                    <label class="form-label" for="service1">I need Protocol Service for my:</label>
                                                    <select class="form-select" id='service1' name="service" aria-label="Default select example" required>
                                                        <option value="">-- Segment --</option>
                                                        <option value="Departure">Departure </option>
                                                        <option value="Arrival">Arrival</option>
                                                    </select>
                                                    @error('service')
                                                        <small class="text-danger ">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" id="purchaseButton" class="btn btn-pry">Book Protocol</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="hidden" id="airport2">
                                            <form action="{{ route('air.protocolplan')}}" method="POST">
                                                 @csrf
                                                <input type="hidden" name="location" value="Lagos">
                                                <div class="mb-3 " id="airport2">
                                                    <label class="form-label" for="airport">Airport</label>
                                                    <select class="form-select" id='airportSelect' name="airport" aria-label="Default select example" required>
                                                        <option value="">-- Choose Airport --</option>
                                                        <option value="International Airport">International Airport </option>
                                                        <option value="Local Airport">Local Airport </option>
                                                    </select>
                                                    @error('airport')
                                                        <small class="text-danger ">{{ $message }}</small>
                                                    @enderror
                                                    <label class="form-label" for="service2">I need Protocol Service for my: </label>
                                                    <select class="form-select" id='service2' name="service" aria-label="Default select example" required>
                                                        <option value="">-- Segment --</option>
                                                        <option value="Departure">Departure </option>
                                                        <option value="Arrival">Arrival</option>
                                                    </select>
                                                    @error('service')
                                                        <small class="text-danger ">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" id="purchaseButton" class="btn btn-pry">Book Protocol</button>
                                                </div>
                                            </form>
                                        </div>      
                                    </div>
                                    <script>
                                        var stateselect = document.getElementById("stateselect");
                                        var airport1 = document.getElementById("airport1");
                                        var airport2 = document.getElementById("airport2");
                                        // var airport3 = document.getElementById("airport3");
                                        // var airport4 = document.getElementById("airport4");

                                        stateselect.addEventListener("change", function() {
                                            if (stateselect.value === "Abuja") {
                                                airport1.style.display = "block";
                                                airport2.style.display = "none";
                                            }
                                            else if (stateselect.value === "Lagos") {
                                                airport1.style.display = "none";
                                                airport2.style.display = "block";
                                            }
                                            
                                            
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pb-3">

                        <div class="bg-light p-3 shadow-sm protocol"  >
                            <p style="color: rgba(13, 156, 83, 1);"> 
                                <b>The benefits of our Protocol Services depends on the package you selected</b> 
                            </p>
                            <small class="text-muted ">
                                List of Our Services
                            </small>

                            <ul class="list-unstyled"  >
                                <li> <i class="fa fa-check"></i> Meet and Greet.</li>
                                <li><i class="fa fa-check"></i> Exclusive Baggage Handling. </li>
                                <li><i class="fa fa-check"></i> No Queue.</li>
                                <li><i class="fa fa-check"></i> Fast-tracking Check-in Process.</li>
                                <li><i class="fa fa-check"></i> Stress Free Check-in Process.</li>
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
                </div>
            </div>
        </section>

    





    </main>

    @include('layouts.footer')



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</body>



</html>

