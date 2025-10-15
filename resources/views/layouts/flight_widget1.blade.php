<head>
    <!-- ASSETS -->
    <link rel="stylesheet" href="app/themes/default/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/line-awesome.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/animate.min.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/animated-headline.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/style.css">
    <link rel="stylesheet" href="app/themes/default/style.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/mobile.css">
    <link rel="stylesheet" href="app/themes/default/assets/css/childstyle.css">

    <script src="app/themes/default/assets/js/jquery/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">

    <!-- PACEJS -->
    <script src="cdn.jsdelivr.net/npm/pace-js%40latest/pace.min.js"></script>

    <!-- RTL -->

</head>

<body>
        <div class="container">

            <div style="padding:50px 20" id="fadein">
                <form autocomplete="off" class="main_searchw" action="{{ url('/air/flightbookingsPdf')}}" method="POST">
                {{ csrf_field() }}
                    <div class="row mb-3 g-1" style="justify-content: space-between;">
                        <div class="col-md-4 flight_types">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trip" id="one-way"
                                            onclick="oneway();" value="oneway" checked>
                                        <label class="form-check-label" for="one-way">
                                            <!--<i class="icon mdi mdi-arrow-missed"></i>--> One Way </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trip" id="round-trip"
                                            value="return">
                                        <label class="form-check-label" for="round-trip">
                                            <!--<i class="icon mdi mdi-import-export"></i>--> Round Trip </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        
                        

                        <div class="col-md-6">
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
                        <div class="col">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="input-box">
                                        <label class="label-text">Departure Date</label>
                                        <div class="form-group">
                                            <span class="la la-calendar form-icon"></span>
                                            <input class="depart form-control" id="departure" name="depart[]"
                                                type="text" value="mm/dd/yyyy">
                                                <div class="col">
                                                    <select name="flight_type_departure" id="flight_type_departure" class="flight_type form-select form-select-sm">
                                                        <option value="Economy" selected>
                                                            Economy</option>
                                                        <option value="Economy_premium">
                                                            Economy Premium</option>
                                                        <option value="Business">
                                                            Business</option>
                                                        <option value="First">
                                                            First</option>
                                                    </select>
                                                </div>
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
                                                <div class="col">
                                                    <select name="flight_type_returning" id="flight_type_returning" class="flight_type form-select form-select-sm">
                                                        <option value="Economy" selected>
                                                            Economy</option>
                                                        <option value="Economy_premium">
                                                            Economy Premium</option>
                                                        <option value="Business">
                                                            Business</option>
                                                        <option value="First">
                                                            First</option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        <div class="col-lg-3">
                            <div class="input-box">
                                <label class="label-text">Passengers </label>
                                <div class="form-group">
                                    <div class="dropdown dropdown-contain">

                                        <i class="la la-user form-icon"></i>
                                        <a class="dropdown-toggle dropdown-btn travellers" href="#" role="button"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <p style="font-style:12px;">Travellers <small class="guest_flights"></small>
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
                                                        value="11-03-2023">
                                                        <div class="col">
                                                        <select name="flight_type_departure" id="flight_type_departure" class="flight_type form-select form-select-sm">
                                                            <option value="Economy" selected>
                                                                Economy</option>
                                                            <option value="Economy_premium">
                                                                Economy Premium</option>
                                                            <option value="Business">
                                                                Business</option>
                                                            <option value="First">
                                                                First</option>
                                                        </select>
                                                    </div>
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
                  
                        <!-- end col-lg-3 -->
                        <center>
                            <div class="col-md-3 pt-3">
                                <div class="btn-search text-center">
                                
                                    <input type="submit" class=" w-100 btn-lg btn-success " value="Book Your Flight" data-style="zoom-in">

                                    
                                </div>
                            </div>
                        </center>
                    </div>
                    
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
        </div>




    <!-- javascript resouces and libs -->
    <script src="app/themes/default/assets/js/jquery-ui.js"></script>
    <!-- <script src="app/themes/default/assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="app/themes/default/assets/js/jquery.fancybox.min.js"></script>
    <script src="app/themes/default/assets/js/jquery.countTo.min.js"></script>
    <script src="app/themes/default/assets/js/quantity-input.js"></script>
    <script src="app/themes/default/assets/js/select2.js"></script>
    <script src="app/themes/default/assets/js/main.js"></script>
    <script src="app/themes/default/assets/js/app.js"></script>


</body>

