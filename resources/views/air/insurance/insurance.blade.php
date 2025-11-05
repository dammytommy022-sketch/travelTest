<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Travel Insurance</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css')}}">
    <script src="{{asset('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/fontawesome-6/dist-font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">   
    <style>
        .hidden {
            display: none;
        }
        @media only screen and (max-width: 600px) {
            .hid{
                display: none;
            }
        }
        .selectable {
            cursor: pointer;
            border: 2px solid transparent;
        }

        .selectable:hover {
            opacity: 0.8;
        }

        .selected {
            border: 2px solid rgba(13, 24, 131, 1);
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
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('assets/image/in1.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In2.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In3.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In4.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In5.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In6.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In7.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In8.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/In9.jpg')}}" class="d-block w-100')}}" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <section class="shadow-sm">
            <div class="container">
                <div class="row p-2 pt-3 ">
                    <div class="col-sm-12 p-3 ">
                        <div class="row">
                            <div class="col-xs-3 col-3 col-sm-2 col-lg-1"> 
                                <img src="{{asset('assets/img/ppi.png')}}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                            <div class="col-xs-12 col-12 col-sm-10 col-lg-7 protocol">
                                <h3>   Travel Insurance </h3>
                                <span class="text-muted">                                  
                                    Booking your Travel Insurance with us will give you a lot of benefits 
                                    as our team and partners are always ready to follow up with your claim anytime.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row airport-form shadow p-4 mb-5">
                    <div class="col-sm-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Select Insurance Company</h5>
                        </div>
                        <div class="card-body">
                            <div class="row m-3 mb-3">
                                <div class="col-6 col-sm-3 col-lg-2 shadow sm p-3  selectable" data-link="{{route('air.insuranceAllianz')}}" onclick="selectImage(this)">
                                    <img src="{{ asset('assets/image/sanlamallianzlogo.png') }}" class="w-100" alt="">
                                </div>
                                <div class="col-6 col-sm-3 col-lg-2 shadow sm p-3  selectable" data-link="{{route('air.insuranceLeadway')}}" onclick="selectImage(this)">
                                    <img src="{{ asset('assets/image/leadway.png') }}" class="w-100" alt="">
                                </div>
                                <p id="error-message" class="text-danger" style="display: none;"></p>

                            </div>
                            <div class="col-sm-12 mt-3 text-end">
                                <button type="button" class="btn btn-pry" onclick="proceed()">Proceed</button>
                            </div>
                        </div>
                        <!-- Button to take the user to the next page -->
                    </div>
                    </div>
                   
                </div>
            </div>
        </section>

        @include('layouts.footer')
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        let selectedLink = null;

        function selectImage(element) {
            // Remove 'selected' class from all images
            document.querySelectorAll('.selectable').forEach(img => {
                img.classList.remove('selected');
            });

            // Add 'selected' class to the clicked image
            element.classList.add('selected');
            
            // Store the link associated with the selected image
            selectedLink = element.getAttribute('data-link');
        }

       
        
        function proceed() {
            var errorMessageElement = document.getElementById('error-message');
            
            if (selectedLink) {
                window.location.href = selectedLink;
                errorMessageElement.style.display = 'none'; // Hide error message when a link is selected
            } else {
                errorMessageElement.textContent = 'Please select an Insurance Company.';
                errorMessageElement.style.display = 'block'; // Show the error message
            }
        }

    </script>
</body>
</html>

