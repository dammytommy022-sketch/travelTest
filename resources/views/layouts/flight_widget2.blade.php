<head>
    <!-- ASSETS -->
    <link rel="stylesheet" href="./app/themes/default/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/line-awesome.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/animate.min.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/animated-headline.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/style.css">
    <link rel="stylesheet" href="./app/themes/default/style.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/mobile.css">
    <link rel="stylesheet" href="./app/themes/default/assets/css/childstyle.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
        
        
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://res.accessone.io/css/Dropdown.css">
    <link rel="stylesheet" href="/amadeus/style.css">
    <link rel="stylesheet" href="/amadeus/responsive.css">
    <link rel="stylesheet" href="/amadeus/Searchwidget.css">
    <link rel="stylesheet" href="/amadeus/select2.min.css">
    <style>
        .search_box {
    margin-top: unset;
}
.row {
 
    width: 100%;
}
.radio-toolbar label {
    display: inline-block;
    background-color: #076f93;
    color: #fff;
    padding: 8px 9px !important;
    cursor: pointer;
    transition: .5s ease-in;
    font-size: 11px;
    letter-spacing: 0.9px;
    margin-right: 10px;
    margin-bottom: 0;
}

.autocomplete-wrapper {
    margin-top: -6px;
}
input#departure {
    margin-top: -1px;
}
input#return {
    margin-top: -1px;
}
button.dropdown-toggle.waves-effect {
      margin-top: -1px;
}
.search_box_inner .tab-content {
    background: #fdfdfd;
    border: 1px solid #ddd;
    border-top: 3px solid #ffffff;
    border-bottom: 3px solid #ffffff;
    padding: 30px 25px;
    float: left;
    width: 100%;
    background: #fff;
}
button.dropdown-toggle.waves-effect {
    border: none;
}

    </style>

   
</head>

<body>
    <section style="width: 100%; height: 350px;">
        <div class="search_box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                    
                        <div class="search_box_inner">
                        
                            <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-flight" role="tabpanel"
                                aria-labelledby="nav-flight-tab">
                                <div class="flight_form_inner">
                                   <form name="flight-form" class="exitform" action="/public/air/searchflight/" method="get" autocomplete="off" onsubmit="return">
                                        <div class="top">
                                        <div class="radio-toolbar">
                                            <input type="radio" id="radio_raound_trip" name="triptype" value="2" checked>
                                            <label for="radio_raound_trip">Round Trip</label>
                                            <input type="radio" id="radio_one_way" name="triptype" value="1">
                                            <label for="radio_one_way">One Way</label>
                                            <input type="radio" id="radio_multy_city" name="triptype" value="3">
                                            <label for="radio_multy_city">Multi-City</label>
                                        </div>
                                        </div>

                                        <div class="flight_search_info">

                                        
                                                <div class="flight_search_info">
                                                    <div class="flight_search_info_inner">
                                                        <div class="input-wrap">
                                                            <div class="icon-wrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        <div class="input-field" id="flight_from">
                                                                <label>Flying from</label>
                                                                <input type="text" class="typeahead tt-query" placeholder="Origin name" autocomplete="off" spellcheck="false" />
                                                                <input class="from_city" id="from_city" type="hidden" name="dep1" value="" placeholder="Origin name">
                                                            </div>
                                                        </div>
                                                        <div class="input-wrap">
                                                            <div class="icon-wrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="input-field" id="flight_to">
                                                                <label>Flying to</label>
                                                                <input type="text" class="typeahead tt-query" placeholder="Destination name" autocomplete="off" spellcheck="false" />
                                                                <input class="to_city" id="to_city" type="hidden" name="ret1" value="" placeholder="Destination name">
                                                            </div>
                                                        </div>
                                                        <div class="input-wrap">
                                                            <div class="icon-wrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="input-field">
                                                                <label>Depart date</label>
                                                                <!-- <input class="datepicker" name="dtt1" type="text" id="departDate" value="" placeholder="mm/dd/yy" /> -->
                                                                <input id="departure" type="text" name="dtt1" type="text" class="depart form-control" value="" data-date-format="dd/mm/yy" placeholder="dd/mm/yy"/>
                                                            </div>
                                                        </div>
                                                        <div class="input-wrap" id="rount_trip_date">
                                                            <div class="icon-wrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="input-field">
                                                                <label>Return date</label>
                                                                <!-- <input class="datepicker" type="text" name="dtt2" id="input-end" value="" placeholder="mm/dd/yy" /> -->
                                                                <input type="text" id="return" name="dtt2" type="text" class="returning form-control" value="" placeholder="dd/mm/yy"/>
                                                            </div>
                                                        </div>
                                                        <div class="input-wrap">
                                                            <div class="icon-wrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="input-field">
                                                                <label>TRAVELERS</label>
                                                                <div class="dropdown">
                                                                    <button type="button" class="dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        <!-- Select Traveler and Class -->
                                                                        <script type="text/javascript">
                                                                            
                                                                        </script>
                                                                        <p id="demo" class="pax-count-text">1 Travelers and Economy Class</p>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-triangle-b-l">
                                                                        <div class="traveler_class">
                                                                            <div class="traveler_count" id="dropdown_menu_0">
                                                                                <ul>
                                                                                    <li>
                                                                                        <label>Adult |s| 12+</label>
                                                                                        <div class="t_counter">
                                                                                            <a href="javascript:void(0)" onclick="remove_adult(this)" class="minus">
                                                                                                <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                                                                            </a>
                                                                                            <input type="text" name="adult" value="1">
                                                                                            <a href="javascript:void(0)" onclick="add(this)" class="plus">
                                                                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <label>Child |s| 2-11 </label>
                                                                                        <div class="t_counter">
                                                                                            <a 
                                                                                                href="javascript:void(0)" onclick="remove(this)" class="minus">
                                                                                                <i class="fa fa-minus-square-o"
                                                                                                    aria-hidden="true"></i>
                                                                                            </a>
                                                                                            <input type="text"
                                                                                                name="child"
                                                                                                value="0">
                                                                                            <a
                                                                                                href="javascript:void(0)" onclick="add(this)" class="plus">
                                                                                                <i class="fa fa-plus-square-o"
                                                                                                    aria-hidden="true"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <label>Infants below 2</label>
                                                                                        <div class="t_counter">
                                                                                            <a
                                                                                                href="javascript:void(0)" onclick="remove(this)" class="minus">
                                                                                                <i class="fa fa-minus-square-o"
                                                                                                    aria-hidden="true"></i>
                                                                                            </a>
                                                                                            <input type="text"
                                                                                                name="infant"
                                                                                                value="0">
                                                                                            <a
                                                                                                href="javascript:void(0)" onclick="add(this)" class="plus">
                                                                                                <i class="fa fa-plus-square-o"
                                                                                                    aria-hidden="true"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="f_class">
                                                                                <div class="radio">
                                                                                <input id="radio-0" name="cl2" type="radio" onclick="handleClick(this);" value="-" checked>
                                                                                    <label for="radio-1" class="radio-label">No preference</label>
                                                                                </div>
                                                                                <div class="radio">
                                                                                <input id="radio-1" name="cl2" type="radio" onclick="handleClick(this);" value="Y" checked>
                                                                                    <label for="radio-1" class="radio-label">Economy</label>
                                                                                </div>
                                                                                <div class="radio">
                                                                                <input id="radio-2" name="cl2" type="radio" onclick="handleClick(this);" value="W">
                                                                                    <label for="radio-2" class="radio-label">Premium</label>
                                                                                </div>
                                                                                <div class="radio">
                                                                                <input id="radio-3" name="cl2" type="radio" onclick="handleClick(this);" value="C">
                                                                                    <label for="radio-3" class="radio-label">Business</label>
                                                                                </div>
                                                                                <div class="radio">
                                                                                <input id="radio-4" name="cl2" type="radio" onclick="handleClick(this);" value="F">
                                                                                    <label for="radio-4" class="radio-label">First</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="direct" value="false">		
                                                        <input type="hidden" id="key" name="key" value="IRT">          
                                                        <input type="hidden" name="langCode" value="EN">                           

                                                        <div class="search_btn mobile-off">
                                                            <button type="submit" class="btn btn-blue">Search</button>
                                                        </div>
                                                        
                                                        <!-- <button type="submit">Search</button> -->

                                                    </div>
                                                    <div class="add_flight_row" id="container"></div>
                                                    <div class="search_btn mobile-on">
                                                            <button type="submit" class="btn btn-blue">Search Now</button>
                                                        </div>
                                                    <div class="advance_search_box">
                                                        <div class="panel-group" id="accordion" role="tablist">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading" role="tab"
                                                                    id="headingTwo">
                                                                    <h4 class="panel-title">
                                                                        <a class="collapsed" data-toggle="collapse"
                                                                            data-parent="#accordion"
                                                                            href="#collapseTwo"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseTwo">
                                                                            Advance
                                                                            Search</a>
                                                                    </h4>
                                                                    <a href="javascript:void(0)" id="add_flight"
                                                                        class="btn btn-blue pull-left"> <i
                                                                            class="fa fa-plus"
                                                                            aria-hidden="true"></i>
                                                                        Add Another Flight</a>
                                                                </div>
                                                                <div id="collapseTwo"
                                                                    class="panel-collapse collapse" role="tabpanel"
                                                                    aria-labelledby="headingTwo">
                                                                    <div class="panel-body">
                                                                        <div class="advace_inner">
                                                                            <div class="left_part">
                                                                                <div class="chk_box" style="display:none;">
                                                                                    <label
                                                                                        class="container-checkbox">Only Refundable Fares
                                                                                        <input type="checkbox" name="opt">
                                                                                        <span
                                                                                            class="checkmark"></span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="chk_box">
                                                                                    <label
                                                                                        class="container-checkbox">+/-3 Days Search
                                                                                        <input type="checkbox" name="IsCalendarSearch" value="true">
                                                                                        <span
                                                                                            class="checkmark"></span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="chk_box">
                                                                                    <label class="container-checkbox">I prefer non-stop flights
                                                                                        <input type="checkbox" name="direct" value="true">
                                                                                        <span
                                                                                            class="checkmark"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="right_part">
                                                                            <label style="color: white; margin-left: 139px;">Preferred Airline</label>
                                                                                <div class="airlin_drop">
                                                                                    <div class="select-dropdown">
                                                                                
                                                                                    <select class="selectpicker" name="preferedAirline[]" multiple data-live-search="true">
                                                                                    
                                                                                        <option value="EI">Aer Lingus</option>
                                                                                        <option value="JR">Aero California</option>
                                                                                        <option value="ML">Aero Costa Rica</option>
                                                                                        <option value="PL">Aero Peru</option>
                                                                                        <option value="SX">AeroEjecutivo</option>
                                                                                        <option value="SU">Aeroflot</option>
                                                                                        <option value="AR">Aerolineas Argentinas
                                                                                        </option>
                                                                                        <option value="VW">Aeromar Airlines</option>
                                                                                        <option value="AM">AeroMexico</option>
                                                                                        <option value="5L">Aerosur</option>
                                                                                        <option value="DP">Air 2000</option>
                                                                                        <option value="RK">Air Afrique</option>
                                                                                        <option value="AH">Air Algerie</option>
                                                                                        <option value="FQ">Air Aruba</option>
                                                                                        <option value="UU">Air Austral</option>
                                                                                        <option value="7L">Air Belfast</option>
                                                                                        <option value="AC">Air Canada</option>
                                                                                        <option value="EN">Air Dolomiti</option>
                                                                                        <option value="UX">Air Europa</option>
                                                                                        <option value="XV">Air Express</option>
                                                                                        <option value="FZ">Air Facilities</option>
                                                                                        <option value="AF">Air France</option>
                                                                                        <option value="J6">Air Greece</option>
                                                                                        <option value="TX">Air Guadeloupe 94</option>
                                                                                        <option value="AI">Air India</option>
                                                                                        <option value="IT">Air Inter</option>
                                                                                        <option value="UE">Air L.A.</option>
                                                                                        <option value="VD">Air Liberty</option>
                                                                                        <option value="TT">Air Lithuania</option>
                                                                                        <option value="FU">Air Lottoral</option>
                                                                                        <option value="NX">Air Macau</option>
                                                                                        <option value="KM">Air Malta</option>
                                                                                        <option value="PN">Air Martinique</option>
                                                                                        <option value="ON">Air Nauru</option>
                                                                                        <option value="NZ">Air New Zealand</option>
                                                                                        <option value="PX">Air Niugini</option>
                                                                                        <option value="AP">Air One</option>
                                                                                        <option value="8K">Air Ostrava</option>
                                                                                        <option value="FJ">Air Pacific Ltd.</option>
                                                                                        <option value="PZ">Air Paraguay</option>
                                                                                        <option value="BM">Air Sicilia SRL</option>
                                                                                        <option value="OJ">Air St Barthelemy</option>
                                                                                        <option value="UK">Air UK</option>
                                                                                        <option value="NF">Air Vanuatu</option>
                                                                                        <option value="QC">Air Zaire</option>
                                                                                        <option value="UL">Airlanka Ltd.</option>
                                                                                        <option value="3L">Air-Lift Associates</option>
                                                                                        <option value="CW">Airline of Marshall</option>
                                                                                        <option value="FL">AirTran Airways</option>
                                                                                        <option value="AS">Alaska Airlines</option>
                                                                                        <option value="IG">Alisarda</option>
                                                                                        <option value="AZ">Alitalia</option>
                                                                                        <option value="NH">All Nippon Airways</option>
                                                                                        <option value="LM">ALM-Antillean Airlines
                                                                                        </option>
                                                                                        <option value="HP">America West</option>
                                                                                        <option value="AA">American Airlines</option>
                                                                                        <option value="AN">Ansett (Australia)</option>
                                                                                        <option value="R3">Armenian Airlines</option>
                                                                                        <option value="OZ">Asiana Airlines</option>
                                                                                        <option value="7V">Austin Express</option>
                                                                                        <option value="IM">Australia-Asia Air.</option>
                                                                                        <option value="OS">Austrian Airlines</option>
                                                                                        <option value="GW">Avia Airlines</option>
                                                                                        <option value="AO">Aviaco</option>
                                                                                        <option value="6A">Aviacsa</option>
                                                                                        <option value="AV">Avianca</option>
                                                                                        <option value="GU">Aviateca S.A.</option>
                                                                                        <option value="UP">Bahamasair</option>
                                                                                        <option value="LZ">Balkan-Bulgarian Airlines
                                                                                        </option>
                                                                                        <option value="IW">Best Airlines</option>
                                                                                        <option value="BG">Biman Bangladesh</option>
                                                                                        <option value="AX">Binter Mediteraneo</option>
                                                                                        <option value="BP">Botswana Ltd.</option>
                                                                                        <option value="BU">Braathens South America
                                                                                        </option>
                                                                                        <option value="BA">British Airways</option>
                                                                                        <option value="KJ">British Mediterranen</option>
                                                                                        <option value="BD">British Midland</option>
                                                                                        <option value="II">Business Air</option>
                                                                                        <option value="BW">Bwia</option>
                                                                                        <option value="XK">C.A.C. Mediterrannee</option>
                                                                                        <option value="VR">Cabo Verde Airlines</option>
                                                                                        <option value="UY">Cameroon Airlines</option>
                                                                                        <option value="2T">Canada 3000</option>
                                                                                        <option value="CP">Canadian Airlines</option>
                                                                                        <option value="KW">Carnival Airlines</option>
                                                                                        <option value="CX">Cathay Pacific</option>
                                                                                        <option value="KX">Cayman Airways</option>
                                                                                        <option value="CI">China Airlines</option>
                                                                                        <option value="H2">City Bird Airlines</option>
                                                                                        <option value="WX">CityJet</option>
                                                                                        <option value="5V">Community Express</option>
                                                                                        <option value="DD">Conti-Flug</option>
                                                                                        <option value="CO">Continental Airlines</option>
                                                                                        <option value="CM">Copa</option>
                                                                                        <option value="FX">Corp Airlines Canberra
                                                                                        </option>
                                                                                        <option value="3C">Corporate Express</option>
                                                                                        <option value="XL">Country Connection</option>
                                                                                        <option value="LX">Crossair A.G.</option>
                                                                                        <option value="CY">Cyprus Airlines</option>
                                                                                        <option value="EX">Dallas Express</option>
                                                                                        <option value="D2">Damania</option>
                                                                                        <option value="2G">Debonair Airways</option>
                                                                                        <option value="DL">Delta Airlines</option>
                                                                                        <option value="DI">Deutsche BA</option>
                                                                                        <option value="D7">Dinar Lineas Aereas</option>
                                                                                        <option value="8U">Dolphin Express</option>
                                                                                        <option value="YU">Dominair</option>
                                                                                        <option value="KA">Dragonair</option>
                                                                                        <option value="EY">E.A.S. Europe Airlines
                                                                                        </option>
                                                                                        <option value="4S">East West Airlines</option>
                                                                                        <option value="EU">Ecuatoriana</option>
                                                                                        <option value="MS">Egyptair</option>
                                                                                        <option value="LY">El Al</option>
                                                                                        <option value="G3">Emerald Airways</option>
                                                                                        <option value="EK">Emirates Airlines</option>
                                                                                        <option value="OV">Estonian Airlines</option>
                                                                                        <option value="ET">Ethiopian</option>
                                                                                        <option value="BR">EVA Airways</option>
                                                                                        <option value="IH">Falcon Aviation AB</option>
                                                                                        <option value="AY">Finnair</option>
                                                                                        <option value="YC">Flight West Airlines</option>
                                                                                        <option value="F3">Flying Enterprise AB</option>
                                                                                        <option value="F9">Frontier Airlines</option>
                                                                                        <option value="GA">Garuda</option>
                                                                                        <option value="GH">Ghana Airways</option>
                                                                                        <option value="9C">Gill Aviation Ltd.</option>
                                                                                        <option value="QD">Grand Airways</option>
                                                                                        <option value="GF">Gulf Air Co.</option>
                                                                                        <option value="3M">Gulfstream Intl</option>
                                                                                        <option value="GY">Guyana Airways</option>
                                                                                        <option value="VN">Hang Khong Vietnam</option>
                                                                                        <option value="ZL">Hazelton Airlines</option>
                                                                                        <option value="UD">Hex Air</option>
                                                                                        <option value="HS">Highland Air AB</option>
                                                                                        <option value="QX">Horizon Air</option>
                                                                                        <option value="AW">Horizon Airways</option>
                                                                                        <option value="IB">Iberia</option>
                                                                                        <option value="FI">Icelandair</option>
                                                                                        <option value="VQ">Impulse Airlines</option>
                                                                                        <option value="IC">Indian Airlines</option>
                                                                                        <option value="HH">Islandsflug</option>
                                                                                        <option value="JD">Japan Air System</option>
                                                                                        <option value="JL">Japan Airlines</option>
                                                                                        <option value="EG">Japan Asia Airways</option>
                                                                                        <option value="JU">JAT/Yugoslav Airline</option>
                                                                                        <option value="JY">Jersey European Air</option>
                                                                                        <option value="9W">Jet Airways</option>
                                                                                        <option value="KD">Kendall Airlines</option>
                                                                                        <option value="4K">Kenn Borek Air</option>
                                                                                        <option value="KP">Kiwi Intl. Air</option>
                                                                                        <option value="KL">KLM Royal Dutch Airlines
                                                                                        </option>
                                                                                        <option value="KE">Korean Airlines</option>
                                                                                        <option value="7B">Krasnoyarsk Airlines</option>
                                                                                        <option value="KU">Kuwait Airlines</option>
                                                                                        <option value="LR">Lacsa</option>
                                                                                        <option value="UC">Ladeco</option>
                                                                                        <option value="LA">Lan Chile S.A.</option>
                                                                                        <option value="NG">Lauda Air</option>
                                                                                        <option value="LI">Liat</option>
                                                                                        <option value="RT">Lincoln Airlines</option>
                                                                                        <option value="TE">Lithuanian Airlines</option>
                                                                                        <option value="LB">Lloyd Aero Boliviano</option>
                                                                                        <option value="LO">LOT Polish</option>
                                                                                        <option value="LT">LTU International</option>
                                                                                        <option value="LH">Lufthansa German Airlines
                                                                                        </option>
                                                                                        <option value="MH">Malaysia Airlines</option>
                                                                                        <option value="MA">Malev Hungarian</option>
                                                                                        <option value="6E">Malmo Aviation</option>
                                                                                        <option value="AE">Mandarin Airlines</option>
                                                                                        <option value="MP">Martinair</option>
                                                                                        <option value="IN">MAT Macedonian</option>
                                                                                        <option value="MZ">Merpati Nusantara Airlines
                                                                                        </option>
                                                                                        <option value="MX">Mexicana</option>
                                                                                        <option value="YX">Midwest Express</option>
                                                                                        <option value="ZO">Mohawk Airlines</option>
                                                                                        <option value="NM">Mount Cook Airlines</option>
                                                                                        <option value="SW">Namib Air</option>
                                                                                        <option value="NC">National Jet Systems</option>
                                                                                        <option value="6Y">Nica</option>
                                                                                        <option value="JH">Nordeste Linhas</option>
                                                                                        <option value="DJ">Nordic European Air</option>
                                                                                        <option value="NW">Northwest Airlines</option>
                                                                                        <option value="UQ">Oconnor Airlines</option>
                                                                                        <option value="OA">Olympic Airways</option>
                                                                                        <option value="WY">Oman Air</option>
                                                                                        <option value="3N">Pac Air</option>
                                                                                        <option value="PK">Pakistan Intl.</option>
                                                                                        <option value="P8">Pantanal Linhas</option>
                                                                                        <option value="K5">Penair</option>
                                                                                        <option value="KS">Peninsula Airways, Inc.
                                                                                        </option>
                                                                                        <option value="PR">Phillipine Airlines</option>
                                                                                        <option value="PH">Polynesian Airlines Ltd
                                                                                        </option>
                                                                                        <option value="NI">Portugalia</option>
                                                                                        <option value="DE">Prime Air Inc.</option>
                                                                                        <option value="QF">Qantas</option>
                                                                                        <option value="VM">Regional Airlines</option>
                                                                                        <option value="QQ">Reno Air</option>
                                                                                        <option value="SL">Rio Sul Servicios</option>
                                                                                        <option value="AT">Royal Air Maroc</option>
                                                                                        <option value="QN">Royal Airlines</option>
                                                                                        <option value="BI">Royal Brunei Airlines
                                                                                        </option>
                                                                                        <option value="RJ">Royal Jordanian</option>
                                                                                        <option value="RA">Royal Nepal Airlines</option>
                                                                                        <option value="ZG">Sabair Airlines Pty</option>
                                                                                        <option value="SN">Sabena</option>
                                                                                        <option value="EH">Saeta-Sociedad</option>
                                                                                        <option value="SV">Saudi Arabian Airlines
                                                                                        </option>
                                                                                        <option value="SK">Scandinavian Airlines
                                                                                        </option>
                                                                                        <option value="SG">Sempati Air</option>
                                                                                        <option value="NL">Shaheen Air intl</option>
                                                                                        <option value="SQ">Singapore Airlines</option>
                                                                                        <option value="BC">Skymark Airlines</option>
                                                                                        <option value="IE">Solomon Island Air</option>
                                                                                        <option value="SA">South African</option>
                                                                                        <option value="JK">Spanair</option>
                                                                                        <option value="SD">Sudan Airways</option>
                                                                                        <option value="PY">Surinam Airways Ltd</option>
                                                                                        <option value="SR">Swissair</option>
                                                                                        <option value="KK">T.a.m.</option>
                                                                                        <option value="TA">TACA Intl.</option>
                                                                                        <option value="GD">Taesa</option>
                                                                                        <option value="TP">TAP Air</option>
                                                                                        <option value="RO">Tarom-Romanian</option>
                                                                                        <option value="IJ">TAT European</option>
                                                                                        <option value="IO">TAT Export</option>
                                                                                        <option value="TG">Thai International</option>
                                                                                        <option value="FF">Tower Air</option>
                                                                                        <option value="UN">Transaero Airlines</option>
                                                                                        <option value="JQ">TransJamaican</option>
                                                                                        <option value="TK">Turkish Airlines</option>
                                                                                        <option value="TW">TWA</option>
                                                                                        <option value="PS">Ukraine Intl.</option>
                                                                                        <option value="UA">United Airlines</option>
                                                                                        <option value="US">US Air</option>
                                                                                        <option value="E8">USAfrica Airways</option>
                                                                                        <option value="RG">Varig</option>
                                                                                        <option value="VP">Vasp</option>
                                                                                        <option value="VA">Viasa</option>
                                                                                        <option value="VS">Virgin Atlantic Airways
                                                                                        </option>
                                                                                        <option value="VG">VLM Nederlands</option>
                                                                                        <option value="JP">Adria Airways</option>
                                                                                        <option value="3Y">Wapititi Aviation</option>
                                                                                        <option value="PT">West Air Sweden</option>
                                                                                        <option value="WW">Whyalla Airlines</option>
                                                                                        <option value="QR">Qatar Airways</option>
                                                                                        <option value="WF">Wideroes Flyveselskap
                                                                                        </option>
                                                                                    </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



              


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
    
  
     <!-- javascript resouces and libs -->
    <!-- javascript resouces and libs -->
    <script src="./app/themes/default/assets/js/jquery.fancybox.min.js"></script>
    <script src="./app/themes/default/assets/js/jquery.countTo.min.js"></script>
    <script src="./app/themes/default/assets/js/quantity-input.js"></script>
    <script src="./app/themes/default/assets/js/select2.js"></script>
    <script src="./app/themes/default/assets/js/main.js"></script>
    <script src="./app/themes/default/assets/js/app.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="/amadeus/typeahead.bundle.js"></script>
    
    <script src="/amadeus/select2.min.js"></script>
    <script src="/amadeus/moment.min.js"></script>
    <script src="/amadeus/daterangepicker.js"></script>
    <script src="/amadeus/global.js"></script>
  
    <script src="/amadeus/custom.js"></script>

</body>

