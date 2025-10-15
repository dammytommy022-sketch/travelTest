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
    </style>
</head>
<section class="navbarmain pt-5">
        @include('layouts.topnav')
  
        <nav class="navbar navbar-expand-md navbar-light bg-light  shadow-sm fixed-top p-0 mt-5 pt-2 pb-2 " >
            <div class="container-fluid" id="div-nav">
                <a class="navbar-brand" href="/" id="a-nav"><img src="{{ asset('assets\images\mainlogo.png') }}" width="150px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0">
                       
                    </ul>
                </div>
                <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0 ">
                        <li class="nav-item  ">
                            <a class="nav-link product-nav" href="">
                                <img src="{{ asset('assets/images/pa.png') }}" class="image-fluid img-W1" alt="">
                                <span class=" product-nav main-color"> Flight </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="https://travelwheel.ng/air/hotel_bookings">
                                <img src="{{ asset('assets/images/phb.png') }}" class="image-fluid img-W1" alt="">
                                <span class=" product-nav main-color"> Hotel </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="https://travelwheel.ng/air/protocol}">
                                <img src="{{ asset('assets/images/pp.png')}}" class="image-fluid img-W1" alt="">
                                <span class=" product-nav main-color"> Protocol </span></a>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="https://travelwheel.ng/air/lounge">
                                <img src="{{ asset('assets/images/pal.png') }}" class="image-fluid img-W1" alt="">
                                <span class=" product-nav main-color"> Lounge </span></a>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="https://travelwheel.ng/air/insurance">
                                <img src="{{ asset('assets/images/ppi.png') }}" class="image-fluid img-W1" alt="">
                                <span class=" product-nav main-color">Insurance</span></a>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link product-nav" href="{{url('/visa')}}">
                                <img src="{{ asset('assets/images/ppa.png') }}" class="image-fluid img-W1" alt="">
                                <span class=" product-nav main-color">Visa</span></a>
                            </a>
                        </li>
                    </ul> 
                </div>
            </div>
        </nav>
    </div>
    
</section>