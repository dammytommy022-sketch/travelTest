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
        .hidden {
        display: none;
        }

        .success-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .success-animation {
            width: 100px;
            height: 100px;
            background-color: green;
            animation: bounce 1s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .success-message {
            font-size: 24px;
            margin-top: 20px;
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
                <div class="row p-3 pb-5">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 pt-3 pb-5">
                        <div class="p-3 text-center">
                            <img src="{{ asset('assets/img/77suc.gif') }}" class="w-auto" alt="Animated GIF">
                            <h4>Purchase Successfully</h4>
                           <p>You have successfully Book a Protocol Service.
                           Please check your inbox or spam/junk of the email provided for your Protocol Service Pass.</p>
                            <div class="row">
                            @if(session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif 

                                <div class="col-12">
                                    <a href="{{route('air.protocol')}}">
                                    <button class="btn btn-primary">
                                        Back to Top
                                    </button></a>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>

                
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    </main>
    @include('air.layout.footer')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to hide the loading screen
            function hideLoadingScreen() {
                if (document.getElementById('loading-screen')) {
                    document.getElementById('loading-screen').style.display = 'none';
                }
            }

            hideLoadingScreen(); // Hide the loading screen once the page is loaded
        });
    </script>

</body>


</html>
