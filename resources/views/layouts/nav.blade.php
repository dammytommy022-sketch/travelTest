<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">

            <div class="container" id="div-nav">

                <a class="navbar-brand" href="/" id="a-nav"><img src="assetsU/assets/img/favicon/twlogo.png" width="150px" alt=""></a>

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

                    <!--     <li class="nav-item">

                            <a class="nav-link a-nav text-muted" href="land">Land</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link a-nav text-muted" href="water">Water</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link a-nav text-muted" href="rail">Rail</a>

                        </li>      -->   



                    </ul>



                </div>

                <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">

                    <ul class="navbar-nav  mb-2 mb-lg-0 pe-5">

                    <li class="nav-item dropdown">

                            <a class="nav-link a-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"  

                                aria-expanded="false">

                                Products

                            </a>

                           <ul class="dropdown-menu dropdown-menu-nav">

                                <div class="row">

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="{{ route('air.flights')}}">

                                                <div class="row">

                                                    <div class="col-3"><img src="assets/img/pa.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Flight Bookings </p>

                                                        <span class="product-nav-span">Book a flight ticket with

                                                            ease</span>



                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    </div>

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="{{ route('air.hotel_booking')}}">

                                                <div class="row">

                                                    <div class="col-3"><img src="assets/img/phb.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Hotel Bookings </p>

                                                        <span class="product-nav-span">Book a particular Hotel</span>



                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="{{ route('air.airportlounge')}}">

                                                <div class="row">

                                                    <div class="col-3"> <img src="assets/img/pal.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Airport Lounge</p>

                                                        <span class="product-nav-span">

                                                            Get a little rest before your flight</span>



                                                    </div>

                                                </div>

                                            </a>

                                            

                                        </li>

                                    </div>

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="{{route('air.protocol')}}">

                                                <div class="row">

                                                    <div class="col-3">

                                                    <img src="assets/img/pp.png" class="image-fluid w-100" alt="">

                                                    </div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Airport Protocol </p>

                                                        <span class="product-nav-span">Book for an assitance</span>



                                                    </div>

                                                </div>

                                            </a>

                                            

                                        </li>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="air#insurance">

                                                <div class="row">

                                                    <div class="col-3"><img src="assets/img/ppi.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Travel Insurance </p>

                                                        <span class="product-nav-span">Get your travel Insurance

                                                        </span>



                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    </div>

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="air#guide">

                                                <div class="row">

                                                    <div class="col-3"><img src="assets/img/ptg.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Tour Guide </p>

                                                        <span class="product-nav-span">Book a flight ticket with

                                                            ease</span>



                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="air#pass">

                                                <div class="row">

                                                    <div class="col-3">

                        <img src="assets/img/ppp.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">International Passport </p>

                                                        <span class="product-nav-span">Get your International

                                                            Passport</span>



                                                    </div>

                                                </div>

                                            </a> 

                                        </li>

                                    </div>

                                    <div class="col-6">

                                        <li>

                                            <a class="dropdown-item" href="air#helicopter">

                                                <div class="row">

                                                    <div class="col-3"><img src="assets/img/pht.png" class="image-fluid w-100" alt=""></div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Helicopter Booking </p>

                                                        <span class="product-nav-span">Book a flight ticket with

                                                            ease</span>



                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    </div>

                                </div>



                            </ul> 

                           <!-- <ul class="dropdown-menu dropdown-menu-b1">

                                <div class="row">

                                     <li>

                                        <a class="dropdown-item" href="/air/flights">

                                            <div class="row">

                                                <div class="col-3"><img src="../assets/img/pa.png" class="image-fluid w-100" alt=""></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Flight Bookings </p>

                                                    <span class="product-nav-span">Book a flight ticket with

                                                        ease</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                </div>

                                <div class="row">

                                    <li>

                                        <a class="dropdown-item" href="/air/hotel_bookings">

                                            <div class="row">

                                                <div class="col-3"><img src="../assets/img/phb.png" class="image-fluid w-100" alt=""></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Hotel Bookings </p>

                                                    <span class="product-nav-span">Book a particular Hotel</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                </div>

                                <div class="row">

                                    <li>

                                        <a class="dropdown-item" href="/air/airport_lounge">

                                            <div class="row">

                                                <div class="col-3"> <img src="../assets/img/pal.png" class="image-fluid w-100" alt=""></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Airport Lounge</p>

                                                    <span class="product-nav-span">

                                                        Get a little rest before your flight</span>



                                                </div>

                                            </div>

                                        </a>

                                        

                                    </li>

                                </div>

                                <div class="row">

                                    <li>

                                            <a class="dropdown-item" href="/air/airport_protocol_plans">

                                                <div class="row">

                                                    <div class="col-3">

                                                    <img src="../assets/img/pp.png" class="image-fluid w-100" alt="">

                                                    </div>

                                                    <div class="col-9">

                                                        <p class="product-nav">Airport Protocol </p>

                                                        <span class="product-nav-span">Book for an assitance</span>



                                                    </div>

                                                </div>

                                            </a>

                                            

                                        </li>

                                </div>

                                <div class="row">

                                    <li>

                                        <a class="dropdown-item" href="air#insurance">

                                            <div class="row">

                                                <div class="col-3"><img src="../assets/img/ppi.png" class="image-fluid w-100" alt=""></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Travel Insurance </p>

                                                    <span class="product-nav-span">Get your travel Insurance

                                                    </span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                </div>











                            </ul>-->

                            

                        </li>

                        

                        <li class="nav-item dropdown">

                            <a class="nav-link a-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"

                                aria-expanded="false">

                                Company

                            </a>

                            <ul class="dropdown-menu dropdown-menu-b">

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="aboutus">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-list-alt fa-xm mb-1 i-nav"></i></div>

                                                <div class="col-9">

                                                    <p class="product-nav">About Us </p>

                                                    <span class="product-nav-span">About the Company</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-spinner fa-spin mb-1 i-nav"></i>

                                                    <span class="sr-only">Loading...</span></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Media </p>

                                                    <span class="product-nav-span">Company news and Info</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-shield mb-1 i-nav"></i></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Terms and Condition </p>

                                                    <span class="product-nav-span">Our terms and Condition</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>











                            </ul>

                        </li>



                        <li class="nav-item">

                            <a class="nav-link a-nav" href="faq">FAQ</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link a-nav" href="help">Help</a>

                        </li>

                         <li class="nav-item"> 

                            <a class="nav-link a-nav" href="#">|</a>

                        </li>
                        <li class="nav-item">

                            <a class="nav-link a-nav" href="#">  <i class="fa fa-facebook text-muted pt-1"></i></a>

                        </li>
                         <li class="nav-item">

                            <a class="nav-link a-nav" href="#"> <i class="fa fa-twitter text-muted pt-1"></i></a>

                        </li>

                         <li class="nav-item">

                            <a class="nav-link a-nav" href="#"> <i class="fa fa-instagram text-muted pt-1"></i></a>

                        </li>

                        <!--

                        <li class="nav-item dropdown">

                            <a class="nav-link a-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"

                                aria-expanded="false">

                                Login

                            </a>

                            <ul class="dropdown-menu dropdown-menu-d ">

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="{{ route('login') }}">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-user fa-lg mb-1 i-nav"></i></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Vendor </p>

                                                    <span class="product-nav-span">Login As a Vendor</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="LoginA">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-user fa-lg mb-1 i-nav"></i></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Agent </p>

                                                    <span class="product-nav-span">Login As a Agent</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>











                            </ul>



                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link a-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"

                                aria-expanded="false">

                                Sign Up

                            </a>

                            <ul class="dropdown-menu dropdown-menu-d dropdown-menu-end">

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="{{ route('register') }}">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-user fa-lg mb-1 i-nav"></i></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Vendor </p>

                                                    <span class="product-nav-span">Sign Up As a Vendor</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>

                                <div class="row">



                                    <li>

                                        <a class="dropdown-item" href="signinA">

                                            <div class="row">

                                                <div class="col-3"><i class="fa fa-user fa-lg mb-1 i-nav"></i></div>

                                                <div class="col-9">

                                                    <p class="product-nav">Agent </p>

                                                    <span class="product-nav-span">Sign Up As a Agent</span>



                                                </div>

                                            </div>

                                        </a>

                                    </li>





                                </div>





  





                            </ul> 



                        </li>-->





                    </ul>



                </div>

            </div>

        </nav>