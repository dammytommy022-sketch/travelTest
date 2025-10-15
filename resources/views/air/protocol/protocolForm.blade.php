<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <title>Travel Wheel | Air - Airport Protocol </title>
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    
    
    <style>
        .hidden {
        display: none;
        }

        .selectable {
            cursor: pointer;
            border: 2px solid transparent;
        }

        .selectable:hover {
            opacity: 0.6;
            border: 1px solid rgba(13, 24, 131, 1);
            border-radius: 5px;
        }

        .selected {
            border: 2px solid rgba(13, 24, 131, 1);
        }

        .optional-display {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .price-input {
            margin-top: 10px;
            padding: 5px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
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
                        <h3> <img src="{{ asset('public/assets/img/pp.png') }}" class="image-fluid wd-25" alt="protocol"> Airport Protocol Service </h3>
                    </div>
                </div> 
                <div class="row airport-form shadow p-4 mb-5">
                    <div class="col-sm-5 mb-3">
                        <div class="bg-light p-3 shadow-sm protocol"  >
                            <p style="color: rgba(13, 156, 83, 1);"> <b>Benefits of Our Protocol Services for All Nigeria Airports</b> </p>
                            <ul class="list-unstyled"  >
                                    <li> <i class="fa fa-check"></i> Meet and Greet.</li>
                                    <li><i class="fa fa-check"></i> Exclusive Baggage Handling. </li>
                                    <li><i class="fa fa-check"></i> No Queue.</li>
                                    <li><i class="fa fa-check"></i> Fast-tracking Check-in Process.</li>
                                    <li><i class="fa fa-check"></i> Stress free Check-in Process.</li>
                                    <li><i class="fa fa-check"></i> Escort through Boarding Gate. </li> 
                                    <li><i class="fa fa-check"></i> Escort to the Arrival Lobby. </li> 
                                    <li><i class="fa fa-check"></i> Cordinate Passenger to their Pre-arranged Transportation. </li>
                                    <li><i class="fa fa-check"></i> Other relevant Airport Protocol Service as case may be.</li>
                                    <li><i class="fa fa-angle-right" style="font-size:24px;"></i> Pick-up Request (Optional)</li>
                                    <li><i class="fa fa-angle-right" style="font-size:24px;"></i> Drop-off Request (Optional)</li>
                                    <li><i class="fa fa-angle-right" style="font-size:24px;"></i> Police Escort Request (Optional)</li>
                                </ul>
                                <h6>NB: <span > <b style="color:red;">A Protocol Boarding Pass will be generated after a Succefful transaction. It expires after Departure / Arrival date.</span>
                                </b></h6>
                        </div>
                    </div>
                    <input type="hidden" id="airport3" value="{{$data['airport']}}">
                    @if($data['airport'] === "International Airport")
                    <div class="col-sm-7" id="international">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0" style="color: rgba(13, 156, 83, 1);">Flight Details</h6>
                                <small class="text-muted float-end">FIll in details</small>
                            </div>
                            <div class="card-body">
                                <form id="myForm" action="{{ route('air.protocol_checkout')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <input type="hidden" value="{{ request('plan') }}" name="plan" id="plan">
                                        <!-- <input type="hidden" id="selectedAmount" name="amount" value="10000"> -->
                                        <input type="hidden" id="selectedAmount" name="amount"  >
                                        <p id="demo"></p>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Location</label>
                                                <input type="text" name="" class="form-control" value="{{$data['location']}}" readonly/>
                                                <input type="hidden" name="location" class="form-control" value="{{$data['location']}}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                            <label class="form-label" for="firstname">Airport</label>
                                                <input type="text" name="" class="form-control" value="{{$data['airport']}}" readonly/>
                                                <input type="hidden" name="airport"  class="form-control" value="{{$data['airport']}}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Travel Date</label>
                                                <input class="form-control" type="date" name="travel_date"  id="html5-date-input" value="{{Session::get('travel_date')}}" required/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">{{$data['service']}} Time</label>
                                                <input type="time" name="d_time" class="form-control" required/>
                                                <input type="hidden" name="service" value="{{$data['service']}}" id="service">
                                                <input type="hidden" value="{{$data['service']}}" id="serviceI">

                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 " id="airline1" >
                                            <div class="mb-3"> 
                                                <label class="form-label" for="firstname">Select Airline</label>
                                                <div class="input-group input-group-merge">
                                                
                                                    <select class="form-select" id="airlineselect1" name="airline" aria-label="Default select example" required>
                                                        <option value="">-- Choose Airline --</option>
                                                        <option value="AIR COTE D'IVOIRE">AIR COTE D'IVOIRE</option>
                                                        <option value="ARIK AIR">ARIK AIR</option>
                                                        <option value="ASKY AIRLINES">ASKY AIRLINES</option>
                                                        <option value="AIR FRANCE5">AIR FRANCE5</option>
                                                        <option value="AIR NAMIBIA">AIR NAMIBIA</option>
                                                        <option value="BRITISH AIRWAYS">BRITISH AIRWAYS</option>
                                                        <option value="DELTA AIRLINES">DELTA AIRLINES</option>
                                                        <option value="Egypt Airline">Egypt Airline</option>
                                                        <option value="Emirates Airlines">Emirates Airlines</option>
                                                        <option value="ETHIOPIAN AIRLINES">ETHIOPIAN AIRLINES</option>
                                                        <option value="ETIHAD AIRWAYS">ETIHAD AIRWAYS</option>
                                                        <option value="KENYA AIRWAYS">KENYA AIRWAYS</option>
                                                        <option value="KLM">KLM</option>
                                                        <option value="LUFTHANSA">LUFTHANSA</option>
                                                        <option value="QATAR AIRWAYS">QATAR AIRWAYS</option>
                                                        <option value="ROYAL AIR MAROC">ROYAL AIR MAROC</option>
                                                        <option value="RWANDA AIR">RWANDA AIR</option>
                                                        <option value="SOUTH AFRICAN AIRWAYS">SOUTH AFRICAN AIRWAYS</option>
                                                        <option value="TURKISH AIRLINE">TURKISH AIRLINE</option>
                                                        <option value="VIRGIN ATLANTIC">VIRGIN ATLANTIC</option>
                                                        <option value="TAP PORTUGAL">TAP PORTUGAL</option>
                                                        <option value="AFRICAN WORLD AIRLINES">AFRICAN WORLD AIRLINES</option>
                                                        <option value="MID AFRICA AIRLINES">MID AFRICA AIRLINES</option>
                                                        <option value="SAUDI ARABIAN AIRLINE">SAUDI ARABIAN AIRLINE</option>
                                                        <option value="AIRPEACE">AIRPEACE     </option>   
                                                        <option value="OTHERS">OTHERS</option>                                   
                                                    </select>
            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 hidden" id="other1" >
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Other Airline</label>
                                                <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="other" value="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nop">No. Of Person(s)</label>
                                                <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input type="number" class="form-control" name="nop" id="numberInput" value="0" aria-describedby="basic-icon-default-fullname2" required>
                                                <small id="nop-error" style="color: red; display: none;">Please enter a number greater than zero.</small>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <select class="form-select" id="country_code" name="country_code" style="width: 90px;">
                                                            <option value="+93">+93 (Afghanistan)</option>
                                                            <option value="+355">+355 (Albania)</option>
                                                            <option value="+213">+213 (Algeria)</option>
                                                            <option value="+376">+376 (Andorra)</option>
                                                            <option value="+244">+244 (Angola)</option>
                                                            <option value="+1-264">+1-264 (Anguilla)</option>
                                                            <option value="+1-268">+1-268 (Antigua and Barbuda)</option>
                                                            <option value="+54">+54 (Argentina)</option>
                                                            <option value="+374">+374 (Armenia)</option>
                                                            <option value="+297">+297 (Aruba)</option>
                                                            <option value="+61">+61 (Australia)</option>
                                                            <option value="+43">+43 (Austria)</option>
                                                            <option value="+994">+994 (Azerbaijan)</option>
                                                            <option value="+1-242">+1-242 (Bahamas)</option>
                                                            <option value="+973">+973 (Bahrain)</option>
                                                            <option value="+880">+880 (Bangladesh)</option>
                                                            <option value="+1-246">+1-246 (Barbados)</option>
                                                            <option value="+375">+375 (Belarus)</option>
                                                            <option value="+32">+32 (Belgium)</option>
                                                            <option value="+501">+501 (Belize)</option>
                                                            <option value="+229">+229 (Benin)</option>
                                                            <option value="+1-441">+1-441 (Bermuda)</option>
                                                            <option value="+975">+975 (Bhutan)</option>
                                                            <option value="+591">+591 (Bolivia)</option>
                                                            <option value="+387">+387 (Bosnia and Herzegovina)</option>
                                                            <option value="+267">+267 (Botswana)</option>
                                                            <option value="+55">+55 (Brazil)</option>
                                                            <option value="+246">+246 (British Indian Ocean Territory)</option>
                                                            <option value="+1-284">+1-284 (British Virgin Islands)</option>
                                                            <option value="+673">+673 (Brunei)</option>
                                                            <option value="+359">+359 (Bulgaria)</option>
                                                            <option value="+226">+226 (Burkina Faso)</option>
                                                            <option value="+257">+257 (Burundi)</option>
                                                            <option value="+855">+855 (Cambodia)</option>
                                                            <option value="+237">+237 (Cameroon)</option>
                                                            <option value="+1">+1 (Canada)</option>
                                                            <option value="+238">+238 (Cape Verde)</option>
                                                            <option value="+1-345">+1-345 (Cayman Islands)</option>
                                                            <option value="+236">+236 (Central African Republic)</option>
                                                            <option value="+235">+235 (Chad)</option>
                                                            <option value="+56">+56 (Chile)</option>
                                                            <option value="+86">+86 (China)</option>
                                                            <option value="+61">+61 (Christmas Island)</option>
                                                            <option value="+61">+61 (Cocos Islands)</option>
                                                            <option value="+57">+57 (Colombia)</option>
                                                            <option value="+269">+269 (Comoros)</option>
                                                            <option value="+682">+682 (Cook Islands)</option>
                                                            <option value="+506">+506 (Costa Rica)</option>
                                                            <option value="+385">+385 (Croatia)</option>
                                                            <option value="+53">+53 (Cuba)</option>
                                                            <option value="+599">+599 (Curacao)</option>
                                                            <option value="+357">+357 (Cyprus)</option>
                                                            <option value="+420">+420 (Czech Republic)</option>
                                                            <option value="+243">+243 (Democratic Republic of the Congo)</option>
                                                            <option value="+45">+45 (Denmark)</option>
                                                            <option value="+253">+253 (Djibouti)</option>
                                                            <option value="+1-767">+1-767 (Dominica)</option>
                                                            <option value="+1-809">+1-809 (Dominican Republic)</option>
                                                            <option value="+670">+670 (East Timor)</option>
                                                            <option value="+593">+593 (Ecuador)</option>
                                                            <option value="+20">+20 (Egypt)</option>
                                                            <option value="+503">+503 (El Salvador)</option>
                                                            <option value="+240">+240 (Equatorial Guinea)</option>
                                                            <option value="+291">+291 (Eritrea)</option>
                                                            <option value="+372">+372 (Estonia)</option>
                                                            <option value="+251">+251 (Ethiopia)</option>
                                                            <option value="+500">+500 (Falkland Islands)</option>
                                                            <option value="+298">+298 (Faroe Islands)</option>
                                                            <option value="+679">+679 (Fiji)</option>
                                                            <option value="+358">+358 (Finland)</option>
                                                            <option value="+33">+33 (France)</option>
                                                            <option value="+594">+594 (French Guiana)</option>
                                                            <option value="+689">+689 (French Polynesia)</option>
                                                            <option value="+241">+241 (Gabon)</option>
                                                            <option value="+220">+220 (Gambia)</option>
                                                            <option value="+995">+995 (Georgia)</option>
                                                            <option value="+49">+49 (Germany)</option>
                                                            <option value="+233">+233 (Ghana)</option>
                                                            <option value="+350">+350 (Gibraltar)</option>
                                                            <option value="+30">+30 (Greece)</option>
                                                            <option value="+299">+299 (Greenland)</option>
                                                            <option value="+1-473">+1-473 (Grenada)</option>
                                                            <option value="+590">+590 (Guadeloupe)</option>
                                                            <option value="+1-671">+1-671 (Guam)</option>
                                                            <option value="+502">+502 (Guatemala)</option>
                                                            <option value="+44-1481">+44-1481 (Guernsey)</option>
                                                            <option value="+224">+224 (Guinea)</option>
                                                            <option value="+245">+245 (Guinea-Bissau)</option>
                                                            <option value="+592">+592 (Guyana)</option>
                                                            <option value="+509">+509 (Haiti)</option>
                                                            <option value="+504">+504 (Honduras)</option>
                                                            <option value="+852">+852 (Hong Kong)</option>
                                                            <option value="+36">+36 (Hungary)</option>
                                                            <option value="+354">+354 (Iceland)</option>
                                                            <option value="+91">+91 (India)</option>
                                                            <option value="+62">+62 (Indonesia)</option>
                                                            <option value="+98">+98 (Iran)</option>
                                                            <option value="+964">+964 (Iraq)</option>
                                                            <option value="+353">+353 (Ireland)</option>
                                                            <option value="+44-1624">+44-1624 (Isle of Man)</option>
                                                            <option value="+972">+972 (Israel)</option>
                                                            <option value="+39">+39 (Italy)</option>
                                                            <option value="+225">+225 (Ivory Coast)</option>
                                                            <option value="+1-876">+1-876 (Jamaica)</option>
                                                            <option value="+81">+81 (Japan)</option>
                                                            <option value="+44-1534">+44-1534 (Jersey)</option>
                                                            <option value="+962">+962 (Jordan)</option>
                                                            <option value="+7">+7 (Kazakhstan)</option>
                                                            <option value="+254">+254 (Kenya)</option>
                                                            <option value="+686">+686 (Kiribati)</option>
                                                            <option value="+383">+383 (Kosovo)</option>
                                                            <option value="+965">+965 (Kuwait)</option>
                                                            <option value="+996">+996 (Kyrgyzstan)</option>
                                                            <option value="+856">+856 (Laos)</option>
                                                            <option value="+371">+371 (Latvia)</option>
                                                            <option value="+961">+961 (Lebanon)</option>
                                                            <option value="+266">+266 (Lesotho)</option>
                                                            <option value="+231">+231 (Liberia)</option>
                                                            <option value="+218">+218 (Libya)</option>
                                                            <option value="+423">+423 (Liechtenstein)</option>
                                                            <option value="+370">+370 (Lithuania)</option>
                                                            <option value="+352">+352 (Luxembourg)</option>
                                                            <option value="+853">+853 (Macau)</option>
                                                            <option value="+389">+389 (Macedonia)</option>
                                                            <option value="+261">+261 (Madagascar)</option>
                                                            <option value="+265">+265 (Malawi)</option>
                                                            <option value="+60">+60 (Malaysia)</option>
                                                            <option value="+960">+960 (Maldives)</option>
                                                            <option value="+223">+223 (Mali)</option>
                                                            <option value="+356">+356 (Malta)</option>
                                                            <option value="+692">+692 (Marshall Islands)</option>
                                                            <option value="+596">+596 (Martinique)</option>
                                                            <option value="+222">+222 (Mauritania)</option>
                                                            <option value="+230">+230 (Mauritius)</option>
                                                            <option value="+262">+262 (Mayotte)</option>
                                                            <option value="+52">+52 (Mexico)</option>
                                                            <option value="+691">+691 (Micronesia)</option>
                                                            <option value="+373">+373 (Moldova)</option>
                                                            <option value="+377">+377 (Monaco)</option>
                                                            <option value="+976">+976 (Mongolia)</option>
                                                            <option value="+382">+382 (Montenegro)</option>
                                                            <option value="+1-664">+1-664 (Montserrat)</option>
                                                            <option value="+212">+212 (Morocco)</option>
                                                            <option value="+258">+258 (Mozambique)</option>
                                                            <option value="+95">+95 (Myanmar)</option>
                                                            <option value="+264">+264 (Namibia)</option>
                                                            <option value="+674">+674 (Nauru)</option>
                                                            <option value="+977">+977 (Nepal)</option>
                                                            <option value="+31">+31 (Netherlands)</option>
                                                            <option value="+599">+599 (Netherlands Antilles)</option>
                                                            <option value="+687">+687 (New Caledonia)</option>
                                                            <option value="+64">+64 (New Zealand)</option>
                                                            <option value="+505">+505 (Nicaragua)</option>
                                                            <option value="+227">+227 (Niger)</option>
                                                            <option value="+234" selected>+234 (Nigeria)</option>
                                                            <option value="+683">+683 (Niue)</option>
                                                            <option value="+850">+850 (North Korea)</option>
                                                            <option value="+1-670">+1-670 (Northern Mariana Islands)</option>
                                                            <option value="+47">+47 (Norway)</option>
                                                            <option value="+968">+968 (Oman)</option>
                                                            <option value="+92">+92 (Pakistan)</option>
                                                            <option value="+680">+680 (Palau)</option>
                                                            <option value="+970">+970 (Palestinian Territory)</option>
                                                            <option value="+507">+507 (Panama)</option>
                                                            <option value="+675">+675 (Papua New Guinea)</option>
                                                            <option value="+595">+595 (Paraguay)</option>
                                                            <option value="+51">+51 (Peru)</option>
                                                            <option value="+63">+63 (Philippines)</option>
                                                            <option value="+64">+64 (Pitcairn)</option>
                                                            <option value="+48">+48 (Poland)</option>
                                                            <option value="+351">+351 (Portugal)</option>
                                                            <option value="+1-787">+1-787 (Puerto Rico)</option>
                                                            <option value="+974">+974 (Qatar)</option>
                                                            <option value="+242">+242 (Republic of the Congo)</option>
                                                            <option value="+40">+40 (Romania)</option>
                                                            <option value="+7">+7 (Russia)</option>
                                                            <option value="+250">+250 (Rwanda)</option>
                                                            <option value="+590">+590 (Saint Barthelemy)</option>
                                                            <option value="+290">+290 (Saint Helena)</option>
                                                            <option value="+1-869">+1-869 (Saint Kitts and Nevis)</option>
                                                            <option value="+1-758">+1-758 (Saint Lucia)</option>
                                                            <option value="+590">+590 (Saint Martin)</option>
                                                            <option value="+508">+508 (Saint Pierre and Miquelon)</option>
                                                            <option value="+1-784">+1-784 (Saint Vincent and the Grenadines)</option>
                                                            <option value="+685">+685 (Samoa)</option>
                                                            <option value="+378">+378 (San Marino)</option>
                                                            <option value="+239">+239 (Sao Tome and Principe)</option>
                                                            <option value="+966">+966 (Saudi Arabia)</option>
                                                            <option value="+221">+221 (Senegal)</option>
                                                            <option value="+381">+381 (Serbia)</option>
                                                            <option value="+248">+248 (Seychelles)</option>
                                                            <option value="+232">+232 (Sierra Leone)</option>
                                                            <option value="+65">+65 (Singapore)</option>
                                                            <option value="+1-721">+1-721 (Sint Maarten)</option>
                                                            <option value="+421">+421 (Slovakia)</option>
                                                            <option value="+386">+386 (Slovenia)</option>
                                                            <option value="+677">+677 (Solomon Islands)</option>
                                                            <option value="+252">+252 (Somalia)</option>
                                                            <option value="+27">+27 (South Africa)</option>
                                                            <option value="+82">+82 (South Korea)</option>
                                                            <option value="+211">+211 (South Sudan)</option>
                                                            <option value="+34">+34 (Spain)</option>
                                                            <option value="+94">+94 (Sri Lanka)</option>
                                                            <option value="+249">+249 (Sudan)</option>
                                                            <option value="+597">+597 (Suriname)</option>
                                                            <option value="+47">+47 (Svalbard and Jan Mayen)</option>
                                                            <option value="+268">+268 (Swaziland)</option>
                                                            <option value="+46">+46 (Sweden)</option>
                                                            <option value="+41">+41 (Switzerland)</option>
                                                            <option value="+963">+963 (Syria)</option>
                                                            <option value="+886">+886 (Taiwan)</option>
                                                            <option value="+992">+992 (Tajikistan)</option>
                                                            <option value="+255">+255 (Tanzania)</option>
                                                            <option value="+66">+66 (Thailand)</option>
                                                            <option value="+228">+228 (Togo)</option>
                                                            <option value="+690">+690 (Tokelau)</option>
                                                            <option value="+676">+676 (Tonga)</option>
                                                            <option value="+1-868">+1-868 (Trinidad and Tobago)</option>
                                                            <option value="+216">+216 (Tunisia)</option>
                                                            <option value="+90">+90 (Turkey)</option>
                                                            <option value="+993">+993 (Turkmenistan)</option>
                                                            <option value="+1-649">+1-649 (Turks and Caicos Islands)</option>
                                                            <option value="+688">+688 (Tuvalu)</option>
                                                            <option value="+1-340">+1-340 (U.S. Virgin Islands)</option>
                                                            <option value="+256">+256 (Uganda)</option>
                                                            <option value="+380">+380 (Ukraine)</option>
                                                            <option value="+971">+971 (United Arab Emirates)</option>
                                                            <option value="+44">+44 (United Kingdom)</option>
                                                            <option value="+1">+1 (United States)</option>
                                                            <option value="+598">+598 (Uruguay)</option>
                                                            <option value="+998">+998 (Uzbekistan)</option>
                                                            <option value="+678">+678 (Vanuatu)</option>
                                                            <option value="+379">+379 (Vatican)</option>
                                                            <option value="+58">+58 (Venezuela)</option>
                                                            <option value="+84">+84 (Vietnam)</option>
                                                            <option value="+681">+681 (Wallis and Futuna)</option>
                                                            <option value="+212">+212 (Western Sahara)</option>
                                                            <option value="+967">+967 (Yemen)</option>
                                                            <option value="+260">+260 (Zambia)</option>
                                                            <option value="+263">+263 (Zimbabwe)</option>
                                                        </select>
                                                    </div>
                                                    <input type="number" class="form-control" name="phone_no" id="phone_no" placeholder=" Your phone number" aria-describedby="basic-icon-default-fullname2" minlength="10" maxlength="10" required/>
                                                    <small id="phone-error" style="color: red; display: none;">Phone number must be exactly 10 digits long.</small>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Email Address</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                    <input type="email" class="form-control" name="email" id="firstname" placeholder="Email Address"
                                                    aria-describedby="basic-icon-default-fullname2" required/>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6 hidden" id="arrival_I">
                                            <div class="mb-3">
                                                <!-- <label class="form-label" for="firstname">Optional Service</label> -->
                                                <div class="input-group input-group-merge">
                                                    <select id="my-selectA"  class="form-select" name="optinal_requestA" aria-label="Default select example">
                                                        <option value="">-- Optional Request --</option>
                                                        <option value="Drop-off">Drop-off Request </option>
                                                        <option value="Police Escort">Police Escort Request</option>
                                                        <option value="Drop-off & Escort">Drop-off & Escort </option>
                                                    </select>
                                                </div>
                                                <div class="d-none" id="vehicleTypeA">
                                                    <div class="card p-2">
                                                        <div class="selectable p-1" onclick="selectVehicleA(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Saloon Comfort</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/saloon.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleA(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">SUV Business</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i> Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/suv.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleA(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Mini Van</strong></small><br>
                                                                    <small>Up to 5 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/minivan.png') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('my-selectA').addEventListener('change', function() {
                                                        const vehicleTypeA = document.getElementById('vehicleTypeA');
                                                        const optionalA = document.getElementById('optionalA');
                                                        const optionalPriceA = document.getElementById('optionalPriceA');
                                                        const selectedValueA = this.value;
                                                        
                                                        if (selectedValueA === 'Drop-off') {
                                                            vehicleTypeA.classList.remove('d-none');

                                                        } else {
                                                            vehicleTypeA.classList.add('d-none');
                                                            optionalA.classList.add('d-none');
                                                            optionalPriceA.value = null;
                                                        }
                                                        
                                                    });
                                                </script>
                                                <small style="color:red">Optional request if applicable.</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 hidden" id="departure_I" >
                                            <div class="mb-3">
                                                <!-- <label class="form-label" for="firstname">Optional Service</label> -->
                                                <div class="input-group input-group-merge">
                                                    <select id="my-selectD" class="form-select" name="optinal_requestD" aria-label="Default select example">
                                                        <option value="">-- Optional Request --</option>
                                                        <option value="Pick-up">Pick-up Request </option>
                                                        <option value="Police Escort">Police Escort Request</option>
                                                        <option value="Pick-up & Escort">Pick-up & Escort </option>
                                                    </select>
                                                </div>
                                                <div class="d-none" id="vehicleTypeD">
                                                    <div class="card p-2">
                                                        <div class="selectable p-1" onclick="selectVehicleD(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Saloon Comfort</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/saloon.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleD(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">SUV Business</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i> Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/suv.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleD(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Mini Van</strong></small><br>
                                                                    <small>Up to 5 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/minivan.png') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('my-selectD').addEventListener('change', function() {
                                                        const vehicleTypeD = document.getElementById('vehicleTypeD');
                                                        const optionalD = document.getElementById('optionalD');
                                                        const optionalPriceD = document.getElementById('optionalPriceD');
                                                        const selectedValueD = this.value;
                                                        
                                                        if (selectedValueD === 'Pick-up') {
                                                            vehicleTypeD.classList.remove('d-none');

                                                        } else {
                                                            vehicleTypeD.classList.add('d-none');
                                                            optionalD.classList.add('d-none');
                                                            optionalPriceD.value = null;
                                                        }
                                                        
                                                    });
                                                </script>
                                                <small style="color:red">Optional request if applicable.</small>
                                            </div>
                                        </div>
                                            <div class="col-sm-6 optional-display d-none" id="optionalA"></div>
                                            <input type="hidden" name="optionalPriceA" id="optionalPriceA">
                                       
                                            <div class="col-sm-6 optional-display d-none" id="optionalD"></div>
                                            <input type="hidden" name="optionalPriceD" id="optionalPriceD">
                                        <script>
                                            function selectVehicleA(element) {
                                                // Remove selected class from all selectable elements
                                                const selectables = document.querySelectorAll('.selectable');
                                                selectables.forEach(selectable => {
                                                    selectable.classList.remove('selected');
                                                });
                                                // Add selected class to the clicked element
                                                element.classList.add('selected');
                                                const vehicleTypeA = document.getElementById('vehicleTypeA');
                                                vehicleTypeA.classList.add('d-none');
                                                // Get the selected vehicle details
                                                const vehicleDetailsA = element.innerHTML;
                                                const priceTextA = element.querySelector('small:last-of-type').innerText;
                                                // Create input box for the price
                                                const priceInputA = document.getElementById('optionalPriceA');
                                                priceInputA.value = (priceTextA);
                                                // Update the optional div with vehicle details and price input
                                                const optionalDivA = document.getElementById('optionalA');
                                                optionalDivA.classList.remove('d-none');
                                                optionalDivA.innerHTML = vehicleDetailsA; // Copy innerHTML of selected element and add input
                                            }
                                        </script>
                                        <script>
                                            function selectVehicleD(element) {
                                                // Remove selected class from all selectable elements
                                                const selectables = document.querySelectorAll('.selectable');
                                                selectables.forEach(selectable => {
                                                    selectable.classList.remove('selected');
                                                });
                                                // Add selected class to the clicked element
                                                element.classList.add('selected');
                                                const vehicleTypeD = document.getElementById('vehicleTypeD');
                                                vehicleTypeD.classList.add('d-none');
                                                // Get the selected vehicle details
                                                const vehicleDetailsD = element.innerHTML;
                                                const priceTextD = element.querySelector('small:last-of-type').innerText;
                                                // Create input box for the price
                                                const priceInputD = document.getElementById('optionalPriceD');
                                                priceInputD.value = priceTextD;
                                                // Update the optional div with vehicle details and price input
                                                const optionalDivD = document.getElementById('optionalD');
                                                optionalDivD.classList.remove('d-none');
                                                optionalDivD.innerHTML = vehicleDetailsD; // Copy innerHTML of selected element and add input                                                
                                            }
                                        </script>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                            <input class="form-check-input" type="checkbox" name="terms" value="" id="defaultCheck1" required/>
                                                <label class="form-check-label" for="defaultCheck1">I agreed to Terms & Services.</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <p>Amount: NGN <span id="textValue">0</span> </p>
                                            <input type="hidden" id="amountpriceI" value="{{$price}}">
                                        </div>
                                    </div>
                                    <center> <input type="submit" class="btn btn-pry" value="Book Service" /></center>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif($data['airport'] === "Local Airport")
                    <div class="col-sm-7 " id="local">       
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0" style="color: rgba(13, 156, 83, 1);">Flight Details</h6>
                                <small class="text-muted float-end">FIll in details</small>
                            </div>
                            <div class="card-body">
                                <form id="myFormL" action="{{ route('air.protocol_checkout')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Location</label>
                                                <input type="text" name="" class="form-control" value="{{$data['location']}}" readonly/>
                                                <input type="hidden" name="location" class="form-control" value="{{$data['location']}}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Airport</label>
                                                <input type="text" name="" class="form-control" value="{{$data['airport']}}" readonly/>
                                                <input type="hidden" name="airport" id="airport" class="form-control" value="{{$data['airport']}}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Travel Date</label>
                                                <input class="form-control" type="date" name="travel_date"  id="html5-date-input" value="{{Session::get('travel_date')}}" required/>                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">{{$data['service']}} Time</label>
                                                <input type="time" name="d_time" class="form-control" required/>
                                                <input type="hidden" id="service" name="service" value="{{$data['service']}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="airline" >
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Select Airline</label>
                                                <div class="input-group input-group-merge">
                                                    <select class="form-select" id="airlineselect2"  name="airline" aria-label="Default select example" required>
                                                        <option value="">-- Choose Airline --</option>
                                                        <option value="AIR PEACE">AIR PEACE</option>
                                                        <option value="DANA AIR">DANA AIR</option>
                                                        <option value="MAX AIR">MAX AIR</option>
                                                        <option value="OVERLAND AIRWAYS">OVERLAND AIRWAYS</option>
                                                        <option value="AERO">AERO</option>
                                                        <option value="IBOM AIR">IBOM AIR</option>
                                                        <option value="UNITED NIGERIA">UNITED NIGERIA</option>
                                                        <option value="AZMAN">AZMAN</option>
                                                        <option value="ARIK">ARIK</option>
                                                        <option value="GREEN AFRICA">GREEN AFRICA</option>
                                                        <option value="VALUE JET">VALUE JET</option>
                                                        <option value="FIRST NATION AIRLINE">FIRST NATION AIRLINE</option>
                                                        <option value="IRS AIRLINE">IRS AIRLINE</option>
                                                        <option value="KABO AIR">KABO AIR</option>
                                                        <option value="OTHERS">OTHERS</option>                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 hidden" id="other2" >
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Other Airline</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="other" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nop">No. Of Person(s)</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                    <input type="number" class="form-control" name="nop" id="numberInputL" value="0" aria-describedby="basic-icon-default-fullname2" required>
                                                    <small id="nop-errorL" style="color: red; display: none;">Please enter a number greater than zero.</small>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <select class="form-select" id="country_code" name="country_code" style="width: 90px;">
                                                            <option value="+93">+93 (Afghanistan)</option>
                                                            <option value="+355">+355 (Albania)</option>
                                                            <option value="+213">+213 (Algeria)</option>
                                                            <option value="+376">+376 (Andorra)</option>
                                                            <option value="+244">+244 (Angola)</option>
                                                            <option value="+1-264">+1-264 (Anguilla)</option>
                                                            <option value="+1-268">+1-268 (Antigua and Barbuda)</option>
                                                            <option value="+54">+54 (Argentina)</option>
                                                            <option value="+374">+374 (Armenia)</option>
                                                            <option value="+297">+297 (Aruba)</option>
                                                            <option value="+61">+61 (Australia)</option>
                                                            <option value="+43">+43 (Austria)</option>
                                                            <option value="+994">+994 (Azerbaijan)</option>
                                                            <option value="+1-242">+1-242 (Bahamas)</option>
                                                            <option value="+973">+973 (Bahrain)</option>
                                                            <option value="+880">+880 (Bangladesh)</option>
                                                            <option value="+1-246">+1-246 (Barbados)</option>
                                                            <option value="+375">+375 (Belarus)</option>
                                                            <option value="+32">+32 (Belgium)</option>
                                                            <option value="+501">+501 (Belize)</option>
                                                            <option value="+229">+229 (Benin)</option>
                                                            <option value="+1-441">+1-441 (Bermuda)</option>
                                                            <option value="+975">+975 (Bhutan)</option>
                                                            <option value="+591">+591 (Bolivia)</option>
                                                            <option value="+387">+387 (Bosnia and Herzegovina)</option>
                                                            <option value="+267">+267 (Botswana)</option>
                                                            <option value="+55">+55 (Brazil)</option>
                                                            <option value="+246">+246 (British Indian Ocean Territory)</option>
                                                            <option value="+1-284">+1-284 (British Virgin Islands)</option>
                                                            <option value="+673">+673 (Brunei)</option>
                                                            <option value="+359">+359 (Bulgaria)</option>
                                                            <option value="+226">+226 (Burkina Faso)</option>
                                                            <option value="+257">+257 (Burundi)</option>
                                                            <option value="+855">+855 (Cambodia)</option>
                                                            <option value="+237">+237 (Cameroon)</option>
                                                            <option value="+1">+1 (Canada)</option>
                                                            <option value="+238">+238 (Cape Verde)</option>
                                                            <option value="+1-345">+1-345 (Cayman Islands)</option>
                                                            <option value="+236">+236 (Central African Republic)</option>
                                                            <option value="+235">+235 (Chad)</option>
                                                            <option value="+56">+56 (Chile)</option>
                                                            <option value="+86">+86 (China)</option>
                                                            <option value="+61">+61 (Christmas Island)</option>
                                                            <option value="+61">+61 (Cocos Islands)</option>
                                                            <option value="+57">+57 (Colombia)</option>
                                                            <option value="+269">+269 (Comoros)</option>
                                                            <option value="+682">+682 (Cook Islands)</option>
                                                            <option value="+506">+506 (Costa Rica)</option>
                                                            <option value="+385">+385 (Croatia)</option>
                                                            <option value="+53">+53 (Cuba)</option>
                                                            <option value="+599">+599 (Curacao)</option>
                                                            <option value="+357">+357 (Cyprus)</option>
                                                            <option value="+420">+420 (Czech Republic)</option>
                                                            <option value="+243">+243 (Democratic Republic of the Congo)</option>
                                                            <option value="+45">+45 (Denmark)</option>
                                                            <option value="+253">+253 (Djibouti)</option>
                                                            <option value="+1-767">+1-767 (Dominica)</option>
                                                            <option value="+1-809">+1-809 (Dominican Republic)</option>
                                                            <option value="+670">+670 (East Timor)</option>
                                                            <option value="+593">+593 (Ecuador)</option>
                                                            <option value="+20">+20 (Egypt)</option>
                                                            <option value="+503">+503 (El Salvador)</option>
                                                            <option value="+240">+240 (Equatorial Guinea)</option>
                                                            <option value="+291">+291 (Eritrea)</option>
                                                            <option value="+372">+372 (Estonia)</option>
                                                            <option value="+251">+251 (Ethiopia)</option>
                                                            <option value="+500">+500 (Falkland Islands)</option>
                                                            <option value="+298">+298 (Faroe Islands)</option>
                                                            <option value="+679">+679 (Fiji)</option>
                                                            <option value="+358">+358 (Finland)</option>
                                                            <option value="+33">+33 (France)</option>
                                                            <option value="+594">+594 (French Guiana)</option>
                                                            <option value="+689">+689 (French Polynesia)</option>
                                                            <option value="+241">+241 (Gabon)</option>
                                                            <option value="+220">+220 (Gambia)</option>
                                                            <option value="+995">+995 (Georgia)</option>
                                                            <option value="+49">+49 (Germany)</option>
                                                            <option value="+233">+233 (Ghana)</option>
                                                            <option value="+350">+350 (Gibraltar)</option>
                                                            <option value="+30">+30 (Greece)</option>
                                                            <option value="+299">+299 (Greenland)</option>
                                                            <option value="+1-473">+1-473 (Grenada)</option>
                                                            <option value="+590">+590 (Guadeloupe)</option>
                                                            <option value="+1-671">+1-671 (Guam)</option>
                                                            <option value="+502">+502 (Guatemala)</option>
                                                            <option value="+44-1481">+44-1481 (Guernsey)</option>
                                                            <option value="+224">+224 (Guinea)</option>
                                                            <option value="+245">+245 (Guinea-Bissau)</option>
                                                            <option value="+592">+592 (Guyana)</option>
                                                            <option value="+509">+509 (Haiti)</option>
                                                            <option value="+504">+504 (Honduras)</option>
                                                            <option value="+852">+852 (Hong Kong)</option>
                                                            <option value="+36">+36 (Hungary)</option>
                                                            <option value="+354">+354 (Iceland)</option>
                                                            <option value="+91">+91 (India)</option>
                                                            <option value="+62">+62 (Indonesia)</option>
                                                            <option value="+98">+98 (Iran)</option>
                                                            <option value="+964">+964 (Iraq)</option>
                                                            <option value="+353">+353 (Ireland)</option>
                                                            <option value="+44-1624">+44-1624 (Isle of Man)</option>
                                                            <option value="+972">+972 (Israel)</option>
                                                            <option value="+39">+39 (Italy)</option>
                                                            <option value="+225">+225 (Ivory Coast)</option>
                                                            <option value="+1-876">+1-876 (Jamaica)</option>
                                                            <option value="+81">+81 (Japan)</option>
                                                            <option value="+44-1534">+44-1534 (Jersey)</option>
                                                            <option value="+962">+962 (Jordan)</option>
                                                            <option value="+7">+7 (Kazakhstan)</option>
                                                            <option value="+254">+254 (Kenya)</option>
                                                            <option value="+686">+686 (Kiribati)</option>
                                                            <option value="+383">+383 (Kosovo)</option>
                                                            <option value="+965">+965 (Kuwait)</option>
                                                            <option value="+996">+996 (Kyrgyzstan)</option>
                                                            <option value="+856">+856 (Laos)</option>
                                                            <option value="+371">+371 (Latvia)</option>
                                                            <option value="+961">+961 (Lebanon)</option>
                                                            <option value="+266">+266 (Lesotho)</option>
                                                            <option value="+231">+231 (Liberia)</option>
                                                            <option value="+218">+218 (Libya)</option>
                                                            <option value="+423">+423 (Liechtenstein)</option>
                                                            <option value="+370">+370 (Lithuania)</option>
                                                            <option value="+352">+352 (Luxembourg)</option>
                                                            <option value="+853">+853 (Macau)</option>
                                                            <option value="+389">+389 (Macedonia)</option>
                                                            <option value="+261">+261 (Madagascar)</option>
                                                            <option value="+265">+265 (Malawi)</option>
                                                            <option value="+60">+60 (Malaysia)</option>
                                                            <option value="+960">+960 (Maldives)</option>
                                                            <option value="+223">+223 (Mali)</option>
                                                            <option value="+356">+356 (Malta)</option>
                                                            <option value="+692">+692 (Marshall Islands)</option>
                                                            <option value="+596">+596 (Martinique)</option>
                                                            <option value="+222">+222 (Mauritania)</option>
                                                            <option value="+230">+230 (Mauritius)</option>
                                                            <option value="+262">+262 (Mayotte)</option>
                                                            <option value="+52">+52 (Mexico)</option>
                                                            <option value="+691">+691 (Micronesia)</option>
                                                            <option value="+373">+373 (Moldova)</option>
                                                            <option value="+377">+377 (Monaco)</option>
                                                            <option value="+976">+976 (Mongolia)</option>
                                                            <option value="+382">+382 (Montenegro)</option>
                                                            <option value="+1-664">+1-664 (Montserrat)</option>
                                                            <option value="+212">+212 (Morocco)</option>
                                                            <option value="+258">+258 (Mozambique)</option>
                                                            <option value="+95">+95 (Myanmar)</option>
                                                            <option value="+264">+264 (Namibia)</option>
                                                            <option value="+674">+674 (Nauru)</option>
                                                            <option value="+977">+977 (Nepal)</option>
                                                            <option value="+31">+31 (Netherlands)</option>
                                                            <option value="+599">+599 (Netherlands Antilles)</option>
                                                            <option value="+687">+687 (New Caledonia)</option>
                                                            <option value="+64">+64 (New Zealand)</option>
                                                            <option value="+505">+505 (Nicaragua)</option>
                                                            <option value="+227">+227 (Niger)</option>
                                                            <option value="+234" selected>+234 (Nigeria)</option>
                                                            <option value="+683">+683 (Niue)</option>
                                                            <option value="+850">+850 (North Korea)</option>
                                                            <option value="+1-670">+1-670 (Northern Mariana Islands)</option>
                                                            <option value="+47">+47 (Norway)</option>
                                                            <option value="+968">+968 (Oman)</option>
                                                            <option value="+92">+92 (Pakistan)</option>
                                                            <option value="+680">+680 (Palau)</option>
                                                            <option value="+970">+970 (Palestinian Territory)</option>
                                                            <option value="+507">+507 (Panama)</option>
                                                            <option value="+675">+675 (Papua New Guinea)</option>
                                                            <option value="+595">+595 (Paraguay)</option>
                                                            <option value="+51">+51 (Peru)</option>
                                                            <option value="+63">+63 (Philippines)</option>
                                                            <option value="+64">+64 (Pitcairn)</option>
                                                            <option value="+48">+48 (Poland)</option>
                                                            <option value="+351">+351 (Portugal)</option>
                                                            <option value="+1-787">+1-787 (Puerto Rico)</option>
                                                            <option value="+974">+974 (Qatar)</option>
                                                            <option value="+242">+242 (Republic of the Congo)</option>
                                                            <option value="+40">+40 (Romania)</option>
                                                            <option value="+7">+7 (Russia)</option>
                                                            <option value="+250">+250 (Rwanda)</option>
                                                            <option value="+590">+590 (Saint Barthelemy)</option>
                                                            <option value="+290">+290 (Saint Helena)</option>
                                                            <option value="+1-869">+1-869 (Saint Kitts and Nevis)</option>
                                                            <option value="+1-758">+1-758 (Saint Lucia)</option>
                                                            <option value="+590">+590 (Saint Martin)</option>
                                                            <option value="+508">+508 (Saint Pierre and Miquelon)</option>
                                                            <option value="+1-784">+1-784 (Saint Vincent and the Grenadines)</option>
                                                            <option value="+685">+685 (Samoa)</option>
                                                            <option value="+378">+378 (San Marino)</option>
                                                            <option value="+239">+239 (Sao Tome and Principe)</option>
                                                            <option value="+966">+966 (Saudi Arabia)</option>
                                                            <option value="+221">+221 (Senegal)</option>
                                                            <option value="+381">+381 (Serbia)</option>
                                                            <option value="+248">+248 (Seychelles)</option>
                                                            <option value="+232">+232 (Sierra Leone)</option>
                                                            <option value="+65">+65 (Singapore)</option>
                                                            <option value="+1-721">+1-721 (Sint Maarten)</option>
                                                            <option value="+421">+421 (Slovakia)</option>
                                                            <option value="+386">+386 (Slovenia)</option>
                                                            <option value="+677">+677 (Solomon Islands)</option>
                                                            <option value="+252">+252 (Somalia)</option>
                                                            <option value="+27">+27 (South Africa)</option>
                                                            <option value="+82">+82 (South Korea)</option>
                                                            <option value="+211">+211 (South Sudan)</option>
                                                            <option value="+34">+34 (Spain)</option>
                                                            <option value="+94">+94 (Sri Lanka)</option>
                                                            <option value="+249">+249 (Sudan)</option>
                                                            <option value="+597">+597 (Suriname)</option>
                                                            <option value="+47">+47 (Svalbard and Jan Mayen)</option>
                                                            <option value="+268">+268 (Swaziland)</option>
                                                            <option value="+46">+46 (Sweden)</option>
                                                            <option value="+41">+41 (Switzerland)</option>
                                                            <option value="+963">+963 (Syria)</option>
                                                            <option value="+886">+886 (Taiwan)</option>
                                                            <option value="+992">+992 (Tajikistan)</option>
                                                            <option value="+255">+255 (Tanzania)</option>
                                                            <option value="+66">+66 (Thailand)</option>
                                                            <option value="+228">+228 (Togo)</option>
                                                            <option value="+690">+690 (Tokelau)</option>
                                                            <option value="+676">+676 (Tonga)</option>
                                                            <option value="+1-868">+1-868 (Trinidad and Tobago)</option>
                                                            <option value="+216">+216 (Tunisia)</option>
                                                            <option value="+90">+90 (Turkey)</option>
                                                            <option value="+993">+993 (Turkmenistan)</option>
                                                            <option value="+1-649">+1-649 (Turks and Caicos Islands)</option>
                                                            <option value="+688">+688 (Tuvalu)</option>
                                                            <option value="+1-340">+1-340 (U.S. Virgin Islands)</option>
                                                            <option value="+256">+256 (Uganda)</option>
                                                            <option value="+380">+380 (Ukraine)</option>
                                                            <option value="+971">+971 (United Arab Emirates)</option>
                                                            <option value="+44">+44 (United Kingdom)</option>
                                                            <option value="+1">+1 (United States)</option>
                                                            <option value="+598">+598 (Uruguay)</option>
                                                            <option value="+998">+998 (Uzbekistan)</option>
                                                            <option value="+678">+678 (Vanuatu)</option>
                                                            <option value="+379">+379 (Vatican)</option>
                                                            <option value="+58">+58 (Venezuela)</option>
                                                            <option value="+84">+84 (Vietnam)</option>
                                                            <option value="+681">+681 (Wallis and Futuna)</option>
                                                            <option value="+212">+212 (Western Sahara)</option>
                                                            <option value="+967">+967 (Yemen)</option>
                                                            <option value="+260">+260 (Zambia)</option>
                                                            <option value="+263">+263 (Zimbabwe)</option>
                                                        </select>
                                                    </div>
                                                    <input type="number" class="form-control" name="phone_no" id="phone_no" placeholder="Your phone number" aria-describedby="basic-icon-default-fullname2" minlength="10" maxlength="10" required/>
                                                    <small id="phone-error" style="color: red; display: none;">Phone number must be exactly 10 digits long.</small>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Email Address</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                    <input type="email" class="form-control" name="email" id="firstname" placeholder="Email Address"
                                                    aria-describedby="basic-icon-default-fullname2" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <input type="hidden" id="selectedAmount" name="amount" value=""> -->
                                        <input type="hidden" id="selectedAmountL" name="amount"  >
                                        <input type="hidden"  name="plan" id="planL" value="{{ request('plan') }}">
                                        
                                        <div class="col-sm-6 hidden" id="departure_L">
                                            <div class="mb-3">
                                                <!-- <label class="form-label" for="firstname">Optional Service</label> -->
                                                <div class="input-group input-group-merge">
                                                    <select  id="my-selectD2"  class="form-select" name="optinal_requestD2" aria-label="Default select example">
                                                        <option value="">-- Optional Request --</option>
                                                        <option value="Pick-up">Pick-up Request </option>
                                                        <option value="Police-escot">Police Escort Request</option>
                                                        <option value="Pick-up">Pick-up $ Escort Request </option>
                                                    </select>
                                                </div>
                                                <div class="d-none" id="vehicleTypeD2">
                                                    <div class="card p-2">
                                                        <div class="selectable p-1" onclick="selectVehicleD2(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Saloon Comfort</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/saloon.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleD2(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">SUV Business</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i> Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/suv.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleD2(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Mini Van</strong></small><br>
                                                                    <small>Up to 5 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/minivan.png') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('my-selectD2').addEventListener('change', function() {
                                                        const vehicleTypeD2 = document.getElementById('vehicleTypeD2');
                                                        const optionalD2 = document.getElementById('optionalD2');
                                                        const optionalPriceD2 = document.getElementById('optionalPriceD2');
                                                        const selectedValueD2 = this.value;
                                                        
                                                        if (selectedValueD2 === 'Pick-up') {
                                                            vehicleTypeD2.classList.remove('d-none');

                                                        } else {
                                                            vehicleTypeD2.classList.add('d-none');
                                                            optionalD2.classList.add('d-none');
                                                            optionalPriceD2.value = null;
                                                        }
                                                    });
                                                </script>
                                                <small style="color:red">Optional request if applicable.</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 optional-display d-none" id="optionalD2"></div>
                                        <input type="hidden" name="optionalPriceD2" id="optionalPriceD2">
                                        <script>
                                            function selectVehicleD2(element) {
                                                // Remove selected class from all selectable elements
                                                const selectables = document.querySelectorAll('.selectable');
                                                selectables.forEach(selectable => {
                                                    selectable.classList.remove('selected');
                                                });
                                                // Add selected class to the clicked element
                                                element.classList.add('selected');
                                                const vehicleTypeD2 = document.getElementById('vehicleTypeD2');
                                                vehicleTypeD2.classList.add('d-none');
                                                // Get the selected vehicle details
                                                const vehicleDetailsD2 = element.innerHTML;
                                                const priceTextD2 = element.querySelector('small:last-of-type').innerText;
                                                // Create input box for the price
                                                const priceInputD2 = document.getElementById('optionalPriceD2');
                                                priceInputD2.value = priceTextD2;
                                                // Update the optional div with vehicle details and price input
                                                const optionalDivD2 = document.getElementById('optionalD2');
                                                optionalDivD2.classList.remove('d-none');
                                                optionalDivD2.innerHTML = vehicleDetailsD2; // Copy innerHTML of selected element and add input                                                
                                            }
                                        </script>
                                        
                                        <div class="col-sm-6 hidden" id="arrival_L">
                                            <div class="mb-3">
                                                <!-- <label class="form-label" for="firstname">Optional Service</label> -->
                                                <div class="input-group input-group-merge">
                                                    <select id="my-selectA2"  class="form-select" name="optinal_requestA2" aria-label="Default select example">
                                                        <option value="">-- Optional Request --</option>
                                                        <option value="Drop-off">Drop-off Request </option>
                                                        <option value="Police Escort">Police Escort Request</option>
                                                        <option value="Drop-off & Escort">Drop-off & Escort </option>
                                                    </select>
                                                </div>
                                                <div class="d-none" id="vehicleTypeA2">
                                                    <div class="card p-2">
                                                        <div class="selectable p-1" onclick="selectVehicleA2(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Saloon Comfort</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/saloon.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleA2(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">SUV Business</strong></small><br>
                                                                    <small>Up to 3 <i class="fa fa-users"></i> Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/suv.jpg') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="selectable p-1" onclick="selectVehicleA2(this)">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <small><strong class="text-muted">Mini Van</strong></small><br>
                                                                    <small>Up to 5 <i class="fa fa-users"></i>Seaters </small>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <img src="{{ asset('public/assets/image/minivan.png') }}" class="image-fluid w-100" alt="Saloon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('my-selectA2').addEventListener('change', function() {
                                                        const vehicleTypeA2 = document.getElementById('vehicleTypeA2');
                                                        const optionalA2 = document.getElementById('optionalA2');
                                                        const optionalPriceA2 = document.getElementById('optionalPriceA2');
                                                        const selectedValueA2 = this.value;
                                                        
                                                        if (selectedValueA2 === 'Drop-off') {
                                                            vehicleTypeA2.classList.remove('d-none');

                                                        } else {
                                                            vehicleTypeA2.classList.add('d-none');
                                                            optionalA2.classList.add('d-none');
                                                            optionalPriceA2.value = null;
                                                        }
                                                        
                                                    });
                                                </script>
                                                <small style="color:red">Optional request if applicable.</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 optional-display d-none" id="optionalA2"></div>
                                        <input type="hidden" name="optionalPriceA2" id="optionalPriceA2"> 
                                        <script>
                                            function selectVehicleA2(element) {
                                                // Remove selected class from all selectable elements
                                                const selectables = document.querySelectorAll('.selectable');
                                                selectables.forEach(selectable => {
                                                    selectable.classList.remove('selected');
                                                });
                                                // Add selected class to the clicked element
                                                element.classList.add('selected');
                                                const vehicleTypeA2 = document.getElementById('vehicleTypeA2');
                                                vehicleTypeA2.classList.add('d-none');
                                                // Get the selected vehicle details
                                                const vehicleDetailsA2 = element.innerHTML;
                                                const priceTextA2 = element.querySelector('small:last-of-type').innerText;
                                                // Create input box for the price
                                                const priceInputA2 = document.getElementById('optionalPriceA2');
                                                priceInputA2.value = (priceTextA2);
                                                // Update the optional div with vehicle details and price input
                                                const optionalDivA2 = document.getElementById('optionalA2');
                                                optionalDivA2.classList.remove('d-none');
                                                optionalDivA2.innerHTML = vehicleDetailsA2; // Copy innerHTML of selected element and add input
                                            }
                                        </script>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                            <input class="form-check-input" type="checkbox" name="terms" value="" id="defaultCheck1" required/>
                                                <label class="form-check-label" for="defaultCheck1">I agreed to Terms & Services.</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <p>Amount: NGN <span id="textValueL">0</span> </p>
                                            <input type="hidden" id="amountprice" value="{{$price}}">
                                        </div>
                                    </div>
                                    <center> <input type="submit" class="btn btn-pry" value="Proceed" /></center>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <script>
            var airport = document.getElementById("airport");
            var airline1 = document.getElementById("international");
            var airline2 = document.getElementById("local");
                if (airport.value === "International Airport") {
                    international.style.display = "block";
                    local.style.display = "none";
                }
                else if (airport.value === "Local Airport") {
                    international.style.display = "none";
                    local.style.display = "block";
                }
        </script>
        <script>
            var service = document.getElementById("service");
            var arrival = document.getElementById("arrival_I");
            var departure = document.getElementById("departure_I");
                if (service.value === "Arrival") {
                    arrival.style.display = "block";
                    departure.style.display = "none";
                }
                else if (service.value === "Departure") {
                    arrival.style.display = "none";
                    departure.style.display = "block";
                }
        </script>
        <script>
            var serviceL = document.getElementById("service");
            var arrivalL = document.getElementById("arrival_L");
            var departureL = document.getElementById("departure_L");
                if (serviceL.value === "Arrival") {
                    arrivalL.style.display = "block";
                    departureL.style.display = "none";
                }
                else if (service.value === "Departure") {
                    arrivalL.style.display = "none";
                    departureL.style.display = "block";
                }
        </script>
        <script>
                var airlineselect1 = document.getElementById("airlineselect1");
                var other1 = document.getElementById("other1");

                airlineselect1.addEventListener("change", function() {
                    if (airlineselect1.value === "OTHERS") {
                        other1.style.display = "block";
                    }
                    else {
                        other1.style.display = "none";
                    }
                })
        </script>
        <script>
                var airlineselect2 = document.getElementById("airlineselect2");
                var other2 = document.getElementById("other2");
                airlineselect2.addEventListener("change", function() {
                    if (airlineselect2.value === "OTHERS") {
                        other2.style.display = "block";
                    }
                    else {
                        other2.style.display = "none";
                    }

                })
        </script>
        <script>
            const numberInput = document.getElementById('numberInput');
            let textValue = document.getElementById('textValue');
            const selectedAmount = document.getElementById('selectedAmount');
            
            let plan = document.getElementById('plan').value;
            let serviceI = document.getElementById('serviceI').value;
            let amountPriceI = document.getElementById('amountpriceI').value;


            // let plan = document.getElementById('plan').value;
            let price = amountPriceI; // Initialize price

            numberInput.addEventListener('input', function() {
                let currentValue = parseInt(numberInput.value);
                let totalAmount = price * currentValue;
                
                textValue.textContent = totalAmount.toLocaleString('en-US');
                selectedAmount.value = totalAmount;
            });
        </script> 
        <script>
            const numberInputL = document.getElementById('numberInputL');
            let textValueL = document.getElementById('textValueL');
            const selectedAmountL = document.getElementById('selectedAmountL');
            let amountPrice = document.getElementById('amountprice').value;
            
            let planL = document.getElementById('planL').value;
            let priceL = amountPrice; // Set the price for the "Regular" plan       

            numberInputL.addEventListener('input', function() {
                let currentValueL = parseInt(numberInputL.value);
                let totalAmountL = priceL * currentValueL;
                
                
                textValueL.textContent = totalAmountL.toLocaleString('en-US');
                selectedAmountL.value = totalAmountL;
            });
        </script>
        <script>
            document.getElementById('myForm').addEventListener('submit', function(event) {
                const phoneInput = document.getElementById('phone_no');
                const phoneError = document.getElementById('phone-error');
                const phoneNumber = phoneInput.value;

                if (phoneNumber.length !== 10) {
                    phoneError.style.display = 'inline'; // Show the error message
                    event.preventDefault(); // Prevent form submission
                } else {
                    phoneError.style.display = 'none'; // Hide the error message
                }
                
                const nop = parseInt(document.getElementById('numberInput').value);
                const nopError = document.getElementById('nop-error');
                if (isNaN(nop) || nop <= 0) {
                    nopError.style.display = 'inline'; // Show the error message
                    event.preventDefault(); // Prevent form submission
                } else {
                    nopError.style.display = 'none'; // Hide the error message
                }

                const nopL = parseInt(document.getElementById('numberInputL').value);
                const nopErrorL = document.getElementById('nop-errorL');
                if (isNaN(nopL) || nopL <= 0) {
                    nopErrorL.style.display = 'inline'; // Show the error message
                    event.preventDefault(); // Prevent form submission
                } else {
                    nopErrorL.style.display = 'none'; // Hide the error message
                }
                
            });
        </script>
        <script>
            document.getElementById('myFormL').addEventListener('submit', function(event) {
                const phoneInput = document.getElementById('phone_no');
                const phoneError = document.getElementById('phone-error');
                const phoneNumber = phoneInput.value;

                if (phoneNumber.length !== 10) {
                    phoneError.style.display = 'inline'; // Show the error message
                    event.preventDefault(); // Prevent form submission
                } else {
                    phoneError.style.display = 'none'; // Hide the error message
                }
                
                const nop = parseInt(document.getElementById('numberInputL').value);
                const nopError = document.getElementById('nop-errorL');
                if (isNaN(nop) || nop <= 0) {
                    nopError.style.display = 'inline'; // Show the error message
                    event.preventDefault(); // Prevent form submission
                } else {
                    nopError.style.display = 'none'; // Hide the error message
                }
                
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
    </main>
    @include('layouts.footer')
</body>

</html>
