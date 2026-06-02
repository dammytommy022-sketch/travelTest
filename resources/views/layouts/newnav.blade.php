<head>
    <style>
         @media (max-width: 650px) {
            .navbarmain {
               padding-top:50px ;
            }
        }

        .img-W1{
            width: 25px;
        }
        .nav-content {
            display: flex;
            align-items: center;
            gap: 10px; /* Space between image and text */
        }

        .nav-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2; /* Adjust line height between text */
        }

        .img-W1 {
            width: 25px; /* Adjust image size as needed */
            height: auto;
        }

        .product-nav {
            color: inherit;
            text-decoration: none;
        }
    </style>
   
</head>
<section class="navbarmain pt-5">
        @include('layouts.topnav')
  
        <nav class="navbar navbar-expand-md navbar-light bg-light  shadow-sm fixed-top p-0 mt-5 pt-2 pb-2 " >
            <div class="container-fluid" id="div-nav">
                <a class="navbar-brand" href="/" id="a-nav"><img src="{{ asset('assetsU/assets/img/favicon/twlogo.png') }}" width="150px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link a-nav text-muted" href="air">Air</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0 ">
                        <li class="nav-item  ">
                            <a class="nav-link product-nav" href="{{route('air.flight')}}">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/pa.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class=" product-nav main-color"> Flight </span>
                                        <span class=" product-nav main-color"> Request </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="{{route('air.hotel')}}">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/phb.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class=" product-nav main-color"> Hotel </span>
                                        <span class=" product-nav main-color"> Booking </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link product-nav" href="{{route('air.protocol')}}">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/pp.png')}}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class="product-nav main-color">Airport</span>
                                        <span class="product-nav main-color">Protocol</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/pal.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class="product-nav main-color">Airport</span>
                                        <span class="product-nav main-color">Lounge</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="{{route('air.insurance')}}">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/ppi.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class="product-nav main-color">Travel</span>
                                        <span class="product-nav main-color">Insurance</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="/visa">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/ppa.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class="product-nav main-color">Visa </span>
                                        <span class="product-nav main-color">Assistance</span>
                                    </div> 
                                </div>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="{{route('air.aircargo')}}">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/pc.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class="product-nav main-color">Air </span>
                                        <span class="product-nav main-color">Freight</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="{{route('carhire.index')}}">
                                <div class="nav-content">
                                    <img src="{{ asset('assets/img/pc.png') }}" class="image-fluid img-W1" alt="">
                                    <div class="nav-text">
                                        <span class="product-nav main-color">Car </span>
                                        <span class="product-nav main-color">Hire</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul> 
                </div>
            </div>
        </nav>
    </div>
    
</section>
