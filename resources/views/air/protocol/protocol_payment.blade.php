<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assetsU/assets/img/favicon/twicon.png') }}" />
    <title>TravelWheel | Air - Airport Protocol </title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
                    <div class="col-sm-6 p-3 ">
                        <h3> <img src="{{ asset('assets/img/pp.png') }}" class="image-fluid wd-25" alt="protocol"> Airport Protocol Service </h3>
                        
                    </div>
                </div>
            
            <div class="row airport-form shadow p-4 mb-5">
                <div class="col-sm-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Payment Details</h5>
                        </div>  
                        @php
                            if($protocols['package'] == "2"){
                                $package = 'Regular';
                            }
                            elseif($protocols['package'] == "1"){
                                $package = 'VIP';
                            }

                            $value = $protocols['amount'];
                            $formattedValue = number_format($value);
                            $trans_id = $protocols['trans_id'];
                        @endphp

                        <div class="card-body">
                            <div class="p-3 text-center">
                                <img src="{{ asset('assets/img/77suc.gif') }}" class="w-auto" alt="Animated GIF">
                                <h5>Payment Successful </h5>
                                <small class="d-block">The Sum of N{{$formattedValue}} has been made, for Protocol Service ({{ $package }}).</small>
                                <small><b>Please continue to generate a service Pass.</b></small>
                                <div class="col-12 mt-2">
                                @if($protocols['paymentoption'] == "seerbit")
                                    <a href="{{route('air.protocol_generateS', ['trans_id' => $trans_id])}}" class="btn btn-sm btn-success" id="generate-pass-link">
                                        Generate Pass
                                    </a>
                                @elseif($protocols['paymentoption'] == "fluterwave")
                                    <a href="{{route('air.protocol_generateF', ['trans_id' => $trans_id])}}" class="btn btn-sm btn-success" id="generate-pass-link">
                                        Generate Pass
                                    </a>
                                @endif
                                

                                </div>
                            </div>
                        </div>
                    </div> 
                         
                </div>
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Protocol Service Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">  
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="state">Location</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['state'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="airport">Airport</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['airport'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="travel_date">Travel Date</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['travel_date'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="d_time">{{ $protocols['service'] }} Time</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['d_time'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="airport">Airline</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['airline'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="no_of_passenger">No. of Passengers</label>
                                        <div class="checkout">
                                            <input type="hidden" class="input-control no-outline" name="package" id="plan" value="{{ $protocols['plan'] }}"
                                            aria-describedby="basic-icon-default-fullname2"/>
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['no_of_passenger'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="phone_no">Phone Number</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['phone'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-1">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['email'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="airport">Optional Request</label>
                                        <div class="checkout">
                                            <input type="text"  disabled class="input-control no-outline"  value="{{ $protocols['optional_request'] }}" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden"  name="service" value="{{ $protocols['service'] }}"/>
                            </div> 
                        </div>
                    </div>
                    
                </div>
              
                
            </div>
        </div>
            


</section>
    <div id="loading-screen" style="display: none;">
        <!-- Loading screen content (e.g., logo, loading message) -->
        <img src="{{ asset('assets/dist/loading.gif') }}" alt="Logo">
        <p>Loading... Please wait.</p>
    </div>

    <script src="{{ asset('assets/dist/please-wait.min.js') }}"></script>

    <script type="text/javascript">
        // Function to show the loading screen
        function showLoadingScreen() {
            document.getElementById('loading-screen').style.display = 'block';
        }

        // Function to hide the loading screen
        function hideLoadingScreen() {
            document.getElementById('loading-screen').style.display = 'none';
        }

        // Event listener for hyperlink click
        document.getElementById('generate-pass-link').addEventListener('click', function (event) {
            // Display the loading screen
            showLoadingScreen();
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
