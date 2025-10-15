<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <title>TravelWheel | Travel Insurance</title>
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
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
        
        .h7 {
    font-size: 0.8rem;
    font-weight: 800;
    line-height: 0;
    margin-top: 0;
    margin-bottom: 0;
    font-family: Opensans-Bold;
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
                <div class="row p-2 pt-3 ">
                    <div class="col-sm-12 p-3 ">
                        <div class="row">
                            <div class="col-6 col-sm-3 col-lg-2">
                                <img src="{{ asset('public/assets/image/leadway.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                            
                        </div>
                    </div>
                    

                </div>
            <div class="row airport-form shadow p-4 mb-5">
                <div class="col-sm-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Select Cover</h5>
                        </div>
                        <div class="card-body">
                            <div class="row m-2">
                                @foreach($data['products'] as $product)
                                    <div class="col-lg-2 col-md-3 col-sm-6 shadow sm p-3 selectable" data-link="{{ route('air.insuranceLeadwayP') }}" data-prodname="{{ $product['productName'] }}" data-prodcode="{{ $product['productCode'] }} - {{ $product['productName'] }}" onclick="selectImage(this)">
                                        <img src="{{ asset('public/assets/image/leadway.png') }}" class="w-100" alt="">
                                        <h7 class="h7">{{ $product['productName'] }}</h7>
                                    </div>
                                @endforeach
                            </div>
                        </div>     
                    </div>
                </div>
                
            </div>
        </div>
</section>

@include('layouts.footer')
</main>
<!-- Include SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function selectImage(element) {
        // Remove 'selected' class from all images
        document.querySelectorAll('.selectable').forEach(img => {
            img.classList.remove('selected');
        });

        // Add 'selected' class to the clicked image
        element.classList.add('selected');
        
        // Get selected product details
        let selectedLink = element.getAttribute('data-link');
        let selectedProdCode = element.getAttribute('data-prodcode');
        let selectedProdName = element.getAttribute('data-prodname');

        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: "Confirm Selection",
            text: `You have selected: ${selectedProdName}. Do you want to proceed?`,
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Yes, Proceed",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect if confirmed
                window.location.href = `${selectedLink}?prodCode=${selectedProdCode}`;
            }
        });
    }
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</body>
</html>
