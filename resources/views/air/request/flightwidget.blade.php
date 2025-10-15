

<head>
 
    <!-- ASSETS -->
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/childstyle.css') }}">

    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery/jquery.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">

    <!-- PACEJS -->
    <script src="../cdn.jsdelivr.net/npm/pace-js%40latest/pace.min.js"></script>

    <!-- RTL -->

    <style>
        .widget_cover{
            padding: 100px;
            padding-top: 100px;  
        }

        @media only screen and (max-width: 985px) {
            .widget_cover {
                padding: 10px;
            }
        }
        @media only screen and (max-width: 885px) {
            .widget_cover {
                padding: 0px;
            }
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
    <section class=" widget_cover"  style="background-image: url('{{ asset('public/assets/image/slide.jpg') }}');"> 
        <div class="container-fluid" id="cover">
            <div class="card ">
                <div style="" id="fadein">
                    <form autocomplete="off" id="my-form" class="main_search" action="{{ route('air.flightpost')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row mb-3 g-1" style="justify-content: space-between;">
                            <div class="col-lg-5 flight_types">
                                
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="one-way"
                                                onclick="oneway();" value="OneWay" checked>
                                            <label class="form-check-label" for="one-way">
                                                <!--<i class="icon mdi mdi-arrow-missed"></i>--> Oneway </label>
                                        </div>
                                    </div>
                                    <div class="col-5" >
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="round-trip"
                                                value="Return">
                                            <label class="form-check-label " for="round-trip"> Round Trip </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="multi-trip"
                                                onclick="multiway();" value="multi">
                                            <label class="form-check-label" for="multi-trip"> Multi Way</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="row contact-form-action g-1" id="onereturn">
                            <hr>
                            <div class="col-lg-4">
                                <div class="row g-1">
                                    <div class="col-md-6">
                                        <div class="input-box input-items">
                                            <label class="label-text">Flying From</label>
                                            <div class="form-group">
                                                <span class="la la-plane-departure form-icon"></span>
                                                <input class="form-control autocomplete-airport" type="search"
                                                    placeholder="Flying From" name="from[]" id="autocomplete" value="" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-box input-items">
                                            <div id="swap" class="position-absolute">
                                                <div class="swap-places waves-effect shadow">
                                                    <span class="swap-places__arrow --top">
                                                        <svg width="13" height="6" viewBox="0 0 13 6" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3 4V6L0 3L3 0V2H13V4H3Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <span class="swap-places__arrow --bottom">
                                                        <svg width="13" height="6" viewBox="0 0 13 6" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3 4V6L0 3L3 0V2H13V4H3Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <label class="label-text">To Destination</label>
                                            <div class="form-group">
                                                <span class="la la-plane-arrival form-icon mx-2"></span>
                                                <input class="form-control autocomplete-airport focus px-5" type="search"
                                                    placeholder="To Destination" name="to[]" id="autocomplete2" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <div class="input-box">
                                            <label class="label-text">Depart Date</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class="depart form-control" id="departure" name="depart[]"
                                                    type="text" value="mm/dd/yyyy">
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" id="show">
                                        <div class="input-box">
                                            <label class="label-text">Return Date</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class="returning form-control dateright border-top-l0"
                                                    name="returning" type="text" id="return" value="mm/dd/yyyy ">
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="col-lg-2">
                                <div class="input-box">
                                    <label class="label-text">Passengers </label>
                                    <div class="form-group">
                                        <div class="dropdown dropdown-contain">
                                            <i class="la la-user form-icon"></i>
                                            <a class="dropdown-toggle dropdown-btn travellers" href="#" role="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <p style="font-style:12px;">Travellers <span class="guest_flights"></span>
                                                    <!-- <span>Rooms <span class="roomTotal">0</span></span> -->
                                                </p> 
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-wrap">
                                                <div class="dropdown-item adult_qty">
                                                    <div class="qty-box d-flex align-items-center justify-content-between"
                                                        style="margin-bottom: 10px; border-bottom: 1px solid #dedede; padding-bottom: 10px;">
                                                        <label style="line-height:16px">
                                                            <i class="la la-user"></i> Adults <div class="clear"></div>
                                                            <small style="font-size:10px">+12</small>
                                                        </label>
                                                        <div class="qtyBtn d-flex align-items-center">
                                                            <input type="text" name="adults" id="fadults" value="1"
                                                                class="qtyInput_flights">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-item child_qty">
                                                    <div class="qty-box d-flex align-items-center justify-content-between"
                                                        style="margin-bottom: 10px; border-bottom: 1px solid #dedede; padding-bottom: 10px;">
                                                        <label style="line-height:16px">
                                                            <i class="la la-female"></i> Childs <div class="clear">
                                                            </div>
                                                            <small style="font-size:10px">2 - 11</small>
                                                        </label>
                                                        <div class="qtyBtn d-flex align-items-center">
                                                            <input type="text" name="childs" id="fchilds" value="0"
                                                                class="qtyInput_flights">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-item infant_qty">
                                                    <div class="qty-box d-flex align-items-center justify-content-between">
                                                        <label style="line-height:16px">
                                                            <i class="la la-female"></i> Infants <div class="clear">
                                                            </div>
                                                            <small style="font-size:10px">-2</small>
                                                        </label>
                                                        <div class="qtyBtn d-flex align-items-center">
                                                            <input type="text" name="kids" id="finfant" value="0"
                                                                class="qtyInput_flights">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="language" id="language" value="en">
                            <div class="col-lg-2">
                                <div class="input-box">
                                    <label class="label-text">Cabin Type </label>
                                    <div class="form-group">
                                    <select name="flight_type" id="flight_type" class="flight_type form-select form-select-sm p-3">
                                        <option value="Y" selected>Economy</option>
                                        <option value="S">Economy Premium</option>
                                        <option value="C">Business</option>
                                        <option value="F">First</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="btn-search text-center">
                                    <!-- <input type="submit" class=" w-100 btn-lg " value="Book Your Flight" data-style="zoom-in"> -->
                                    <button class="theme-btn  w-100" type="submit">Search flights</button>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="multi-flight-wrap" id="multiway">
                            <div class="contact-form-action multi-flight-field">
                                <div class="row g-1 contact-form-action multi_flight">
                                    <div class="col-md-6">
                                        <div class="row g-1">
                                            <div class="col-md-6">
                                                <div class="input-box input-items">
                                                    <label class="label-text">Flying From</label>
                                                    <div class="form-group">
                                                        <span class="la la-plane-departure form-icon"></span>
                                                        <div class="autocomplete-wrapper _1 row_1">
                                                            <input class="form-control autocomplete-airport" type="search"
                                                                placeholder="Flying From" name="from[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-box input-items">
                                                    <label class="label-text">To Destination</label>
                                                    <div class="form-group">
                                                        <span class="la la-plane-arrival form-icon"></span>
                                                        <div class="autocomplete-wrapper _1 row_2">
                                                            <input class="form-control autocomplete-airport" type="search"
                                                                placeholder="To Destination" name="to[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-box">
                                                    <label class="label-text">Departure Date</label>
                                                    <div class="form-group">
                                                        <span class="la la-calendar form-icon"></span>
                                                        <input class="dp form-control" name="depart[]" type="text"
                                                            value="Depart date">
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- end col-lg-3 -->
                                    <div class="col-md-3 d-flex flight-remove" style="padding-left:10px;align-items:center">
                                        <label class="label-text">&nbsp;</label>
                                        <button
                                            class="btn multi-flight-remove d-flex align-items-center justi-content-center"
                                            type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-3 pr-0">
                                    <div class="form-group">
                                        <button class="theme-btn add-flight-btn margin-top-20px w-100" type="button"><i
                                                class="la la-plus mr-1"></i>Add another flight</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        
                        
                        
                    </form>

                    <script>
                        // SWAP VALUES
                        var btn = document.getElementById("swap");
                        btn.addEventListener("click", function (e) {
                            var from = document.getElementById("autocomplete"),
                                to = document.getElementById("autocomplete2");
                            if (!!from && !!to) {
                                var _ = from.value;
                                from.value = to.value;
                                to.value = _;
                            } else {
                                console.log("some input elements could not be found");
                            }
                        });

                        // show loading model of flights
                        function load_modal() {
                            var flying_from = $("#autocomplete").val();
                            $('.flying_from').append(flying_from);
                            var flying_to = $("#autocomplete2").val();
                            $('.flying_to').append(flying_to);
                            var date = $("#departure").val();
                            $('.date').append(date);
                            $('#loading').modal('show');

                            $(function () {
                                setTimeout(function () {
                                    $(".loading-results-globe .loading-results-track-progress.is-active").css('width', 480);
                                }, 500);
                            });

                        };



                        /* oneway */
                        document.getElementById("one-way").onclick = function () {
                            document.getElementById("show").className = "col hide";
                            document.getElementById("onereturn").className = "row g-1 contact-form-action";
                            document.getElementById("multiway").className = "";
                            document.getElementById("departure").className = "depart form-control";
                        }

                        /* return */
                        document.getElementById("round-trip").onclick = function () {
                            document.getElementById("show").className = "col show_";
                            document.getElementById("onereturn").className = "row g-1 contact-form-action";
                            document.getElementById("multiway").className = "";
                            document.getElementById("departure").className = "depart form-control dateleft border-top-r0";
                        }

                        /* multiway */
                        document.getElementById("multi-trip").onclick = function () {
                            document.getElementById("multiway").className = "multi-flight-wrap show_";
                            document.getElementById("show").className = "col hide";
                            document.getElementById("departure").className = "depart form-control";
                        }
                    </script>

                    <style>
                        .hide {
                            display: none;
                        }

                        .show_ {
                            display: block !important;
                        }

                        #show,
                        #multiway {
                            display: none;
                        }
                    </style>
                </div>
                @if(session('error'))
                    <span class="alert text-warning">
                        {{ session('error') }}
                    </span>
                @endif

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

        // Event listener for form submission
        document.getElementById('my-form').addEventListener('submit', function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Display the loading screen
            showLoadingScreen();

            // Submit the form after a short delay (simulating API call)
            setTimeout(function () {
                document.getElementById('my-form').submit();
            }, 600); // Adjust the delay as needed
        });

        // Event listener for page visibility change
        document.addEventListener('visibilitychange', function () {
            // Check if the page visibility state has changed to visible
            if (document.visibilityState === 'visible') {
                // Hide the loading screen
                hideLoadingScreen();
            }
        });
    </script>
    <script>
    const timeoutDuration = 30 * 60 * 1000; 
    let timeoutTimer;
    function startTimeout() {
        timeoutTimer = setTimeout(() => {
            window.location.reload(); 
        }, timeoutDuration);
    }

    function resetTimeout() {
        clearTimeout(timeoutTimer);
        startTimeout();
    }

    startTimeout();
    document.addEventListener('keypress', resetTimeout);
    document.addEventListener('mousemove', resetTimeout);
    document.addEventListener('click', resetTimeout);
    document.addEventListener('scroll', resetTimeout);

    window.addEventListener('focus', () => {
        resetTimeout();
        window.location.reload();
    });
</script>


    <!-- javascript resouces and libs -->
    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery-ui.js') }}"></script>
    <!-- <script src="../app/themes/default/assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery.countTo.min.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/quantity-input.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/select2.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/app.js') }}"></script>


</body>

