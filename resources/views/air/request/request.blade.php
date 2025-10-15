@extends('layouts.header')
<style>
    .smaller{
        font-size:12px; 
    }
</style>
@section('content')
    <section class="container-fluid p-sm-5 p-2 pt-4" style="background-image: url('{{ asset('assets/image/slide.jpg') }}');">
        <div class="container"> 
            <div class="row">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="col-sm-6  mb-3">
                    <div class="card m-sm-3 p-sm-3">
                        <div class="row  p-0 pt-3 text-center">
                            <div class="col-6 text-end">
                                <h5>{{ $flight['OriginLocationCode2'] }} - ({{$flight['OriginLocationCode'] }})</h5>
                                <p>{{$flight['OriginLocationCode1'] }}</p>
                            </div>
                            <div class="col-6 text-start">
                                <h5>{{ $flight['DestinationLocationCode2'] }} - ({{$flight['DestinationLocationCode'] }})</h5>
                                <p>{{$flight['DestinationLocationCode1'] }}</p>
                            </div>
                            <hr>
                            <div class="col-12 ">
                                <small>{{$flight['AirTripType'] }} Trip</small>
                            </div>
                            @php
                                $dpart = $flight['DepartureDateTime'];
                                $dateTimeDepart = new DateTime($dpart);
                                $formattedDateTimeDepart = $dateTimeDepart->format('M d, Y D');

                                $return = $flight['ReturningDateTime'];
                                $dateTimeReturn = new DateTime($return);
                                $formattedDateTimeReturn = $dateTimeReturn->format('M d, Y D');

                            @endphp
                            @if($flight['AirTripType'] === 'OneWay')
                                <div class="col-6 mb-3 ">
                                    <span class="d-block" style="font-size:16px;"><b>Departure Date</b></span>
                                    <small>{{ $formattedDateTimeDepart }}</small>
                                </div>
                                <div class="col-6 mb-3">
                                    
                                </div> 
                            @elseif($flight['AirTripType'] === 'Return')  
                                <div class="col-6 mb-3">
                                    <span class="d-block" style="font-size:16px;"><b>Departure Date</b></span>
                                    <small>{{ $formattedDateTimeDepart }}</small>
                                </div> 
                                <div class="col-6 mb-3">
                                    <span class="d-block" style="font-size:16px;"><b>Return Date</b></span>
                                    <small>{{$formattedDateTimeReturn}}</small>
                                </div>
                            @endif
                            <div class="col-6 mb-4">
                                <span class="d-block" style="font-size: 16px;"><b>Passenger</b></span>
                                @php
                                    $passengers = $flight['PassengerQuantity']; 
                                @endphp
                                @foreach($passengers as $passenger)
                                    @if($passenger['Code'] === 'ADT') <!-- Check if the passenger is an adult -->
                                        <small>Adult ({{ $passenger['Quantity'] }})</small>
                                    @elseif($passenger['Code'] === 'CHD') <!-- Check if the passenger is a child -->
                                        <small>Child ({{ $passenger['Quantity'] }})</small>
                                    @elseif($passenger['Code'] === 'INF') <!-- Check if the passenger is an infant -->
                                        <small>Infant ({{ $passenger['Quantity'] }})</small>
                                    @endif
                                @endforeach

                                @php
                                    $passengerInfo = '';
                                @endphp

                                @foreach($passengers as $passenger)
                                    @if($passenger['Code'] === 'ADT') <!-- Check if the passenger is an adult -->
                                        @php
                                            $passengerInfo .= 'Adult (' . $passenger['Quantity'] . '), ';
                                        @endphp
                                    @elseif($passenger['Code'] === 'CHD') <!-- Check if the passenger is a child -->
                                        @php
                                            $passengerInfo .= 'Child (' . $passenger['Quantity'] . '), ';
                                        @endphp
                                    @elseif($passenger['Code'] === 'INF') <!-- Check if the passenger is an infant -->
                                        @php
                                            $passengerInfo .= 'Infant (' . $passenger['Quantity'] . '), ';
                                        @endphp
                                    @endif
                                @endforeach

                                @php
                                    // Remove the trailing comma and space
                                    $passengerInfo = rtrim($passengerInfo, ', ');
                                @endphp
                            </div>
                            <div class="col-6 mb-4">
                                <span class="d-block" style="font-size:16px;"><b>Cabin Class</b></span>
                                @if ($flight['CabinType']=== 'Y')
                                    <small>Economy</small>
                                @elseif($flight['CabinType']=== 'S')
                                    <small>Economy Premium</small>
                                @elseif($flight['CabinType']=== 'C')
                                    <small>Business</small>
                                @elseif($flight['CabinType']=== 'F')
                                    <small>First</small>
                                @endif
                                @php
                                    $cabinInfo = '';
                                @endphp

                                @if ($flight['CabinType'] === 'Y')
                                    @php
                                        $cabinInfo = 'Economy';
                                    @endphp
                                @elseif($flight['CabinType'] === 'S')
                                    @php
                                        $cabinInfo = 'Economy Premium';
                                    @endphp
                                @elseif($flight['CabinType'] === 'C')
                                    @php
                                        $cabinInfo = 'Business';
                                    @endphp
                                @elseif($flight['CabinType'] === 'F')
                                    @php
                                        $cabinInfo = 'First';
                                    @endphp
                                @endif
                            </div>
                            
                            <div class="row mb-2 ps-2 pe-2 text-center">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6 text-center">
                                    <button type="submit" class="btn btn-pry btn-block" style="width: 80%;">Modify </button>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="p-sm-2">
                                <small> <b>Kindly take note of our active operational hours for Booking and Resavation:</b> </small>
                                <div class="row p-2 text-start">
                                    <div class="col-6 ">
                                        <small class="smaller text-muted">- Mondays to Fridays (8am to 6pm)</small><br>
                                        <small class="smaller text-muted">- Saturdays (9am to 2pm)</small><br>
                                        <small class="smaller text-muted">- Sunday ( 12pm to 2pm)</small>
                                    </div>
                                    <div class="col-6 ">
                                        <small class="smaller text-muted"> - For Date Change, Booking Cancellation, and other Service Emergency requests (24/7). Call or Whatsapp 08032705319.</small>
                                    </div>
                                </div>
                                
                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 ps-sm-4 pe-sm-4 mb-3">
                    <div class="card m-sm-3 ms-sm-4 me-sm-4 p-3 p-md-4">
                        @if($flight['AirTripType'] === "multi" )
                            <form id="whatsappForm" action="{{route('air.requestpost')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h6 style="font-size:15px;">
                                                We assure you of the best fare. <br> We're sending your request to over 20 IATA Accredited Agents.
                                                <hr>
                                            </h6>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label form-label-sm" for="origin">Initial Origin</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control form-control-sm" name="origin" id="origin" value="{{$flight['FlightData'][0]['OriginCode']}}"
                                                    aria-describedby="basic-icon-default-fullname2" readonly/>
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-plane-departure"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label form-label-sm" for="destination">Final Destination </label>
                                                @php
                                                    $lastFlightData = end($flight['FlightData']);
                                                @endphp

                                                <div class="input-group input-group-merge mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-plane-arrival"></i></span>
                                                    <input type="text" class="form-control form-control-sm" name="destination" id="destination" value="{{ $lastFlightData['DestinationCode'] }}"
                                                    aria-describedby="basic-addon1" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tripType" id="tripType" value="{{$flight['AirTripType']}}">
                                        @php
                                            $flightDataJson = json_encode($flight['FlightData']);
                                        @endphp

                                        <input type="hidden" name="flightdata" id="tripType" value="{{ $flightDataJson }}">
                                        <input type="hidden" name="passenger" id="passenger" value="{{$passengerInfo}}">
                                        <input type="hidden" name="cabinType" id="cabinType" value="{{$cabinInfo}}">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-3">
                                                <div class="input-group input-group-merge">
                                                    
                                                    <input type="email" class="form-control form-control-sm" name="email" id="email" value=""  placeholder="Email Address"
                                                    aria-describedby="basic-icon-default-fullname2" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-2">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <select class="form-select form-select-sm" id="country_code" name="country_code" style="width: 70px;">
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
                                                    <input type="text" class="form-control form-control-sm" name="phone_no" id="phone_no" value="" placeholder="Phone number" aria-describedby="basic-icon-default-fullname2" required/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-2">
                                                <div class="input-group input-group-merge">
                                                    
                                                    <input type="text" class="form-control form-control-sm" name="fullname" id="fullname" placeholder="Your Full Name"
                                                    aria-describedby="basic-icon-default-fullname2" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input form-check-input-sm" id="airline_option" name="airline_option" onchange="toggleAirlineSelect()">
                                                    
                                                    <label class="form-check-label form-check-label-sm" for="airline_option">Preferred Airline (Optional)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden" id="airline_select_div">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 " >
                                                    <div class="mb-2">
                                                        <div class="input-group input-group-merge">
                                                            <select class="form-select form-select-sm" id="airline1" name="airline1">
                                                                <option value="">Airline Option 1</option>
                                                                <option value="Air France">Air France</option>
                                                                <option value="Air Peace">Air Peace</option>
                                                                <option value="Arik Air">Arik Air</option>
                                                                <option value="Azman Air">Azman Air</option>
                                                                <option value="British Airways">British Airways</option>
                                                                <option value="Dana Air">Dana Air</option>
                                                                <option value="EgyptAir">EgyptAir</option>
                                                                <option value="Emirates">Emirates</option>
                                                                <option value="Ethiopian Airlines">Ethiopian Airlines</option>
                                                                <option value="Kenya Airways">Kenya Airways</option>
                                                                <option value="KLM Royal Dutch Airlines">KLM Royal Dutch Airlines</option>
                                                                <option value="Lufthansa">Lufthansa</option>
                                                                <option value="Med-View Airline">Med-View Airline</option>
                                                                <option value="Qatar Airways">Qatar Airways</option>
                                                                <option value="RwandAir">RwandAir</option>
                                                                <option value="South African Airways">South African Airways</option>
                                                                <option value="Turkish Airlines">Turkish Airlines</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 " >
                                                    <div class="mb-2">
                                                        <div class="input-group input-group-merge">
                                                            <select class="form-select form-select-sm" id="airline2" name="airline2">
                                                                <option value="" >Airline Option 2</option>
                                                                <option value="Air France">Air France</option>
                                                                <option value="Air Peace">Air Peace</option>
                                                                <option value="Arik Air">Arik Air</option>
                                                                <option value="Azman Air">Azman Air</option>
                                                                <option value="British Airways">British Airways</option>
                                                                <option value="Dana Air">Dana Air</option>
                                                                <option value="EgyptAir">EgyptAir</option>
                                                                <option value="Emirates">Emirates</option>
                                                                <option value="Ethiopian Airlines">Ethiopian Airlines</option>
                                                                <option value="Kenya Airways">Kenya Airways</option>
                                                                <option value="KLM Royal Dutch Airlines">KLM Royal Dutch Airlines</option>
                                                                <option value="Lufthansa">Lufthansa</option>
                                                                <option value="Med-View Airline">Med-View Airline</option>
                                                                <option value="Qatar Airways">Qatar Airways</option>
                                                                <option value="RwandAir">RwandAir</option>
                                                                <option value="South African Airways">South African Airways</option>
                                                                <option value="Turkish Airlines">Turkish Airlines</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6">
                                                <button type="submit1" class="btn btn-sm btn-pry btn-block" style="width: 100%;">Get Free Quote</button>
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <small class="text-muted" style="font-size:13px; line-height:22px;">
                                            <b></b> By providing my contact details and clicking on "GET A FREE QUOTE" I agree to be contacted for travel 
                                                information via phone call, text messages and email. We respect your <a href="{{route('air.policy')}}">privacy</a>.
                                                </b> 
                                            </small>
                                        </div>
                                    </div>
                                </form>
                        @else
                            <form id="whatsappForm" action="{{route('air.requestpost')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h6 style="font-size:15px;">
                                            We assure you of the best fare. <br> We're sending your request to over 20 IATA Accredited Agents.
                                            <hr>
                                        </h6>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        
                                        <div class="mb-3">
                                            <label class="form-label form-label-sm" for="origin">Origin</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control form-control-sm" name="origin" id="origin" value="{{$flight['Origin']}}"
                                                aria-describedby="basic-icon-default-fullname2" readonly/>
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-plane-departure"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label form-label-sm" for="destination">Destination </label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-plane-arrival"></i></span>
                                                <input type="text" class="form-control form-control-sm" name="destination" id="destination" value="{{$flight['Destination']}}"
                                                aria-describedby="basic-icon-default-fullname2" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tripType" id="tripType" value="{{$flight['AirTripType']}}">

                                    @if($flight['AirTripType'] === 'OneWay')
                                        <input type="hidden" name="departure_date" id="departure_date" value="{{$formattedDateTimeDepart}}">
                                        <input type="hidden" name="return_date" id="return_date" value="">
                                        <input type="hidden" name="passenger" id="passenger" value="{{$passengerInfo}}">
                                        <input type="hidden" name="cabinType" id="cabinType" value="{{$cabinInfo}}">
                                    @elseif($flight['AirTripType'] === 'Return')  
                                        <input type="hidden" name="departure_date" id="departure_date" value="{{$formattedDateTimeDepart}}">
                                        <input type="hidden" name="return_date" id="return_date" value="{{$formattedDateTimeReturn}}">
                                        <input type="hidden" name="passenger" id="passenger" value="{{$passengerInfo}}">
                                        <input type="hidden" name="cabinType" id="cabinType" value="{{$cabinInfo}}">
                                    @endif

                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <div class="input-group input-group-merge">
                                                
                                                <input type="email" class="form-control form-control-sm" name="email" id="email" value=""  placeholder="Email Address"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-2">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <select class="form-select form-select-sm" id="country_code" name="country_code" style="width: 70px;">
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
                                                <input type="text" class="form-control form-control-sm" name="phone_no" id="phone_no" value="" placeholder="Phone number" aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-2">
                                            <div class="input-group input-group-merge">
                                                
                                                <input type="text" class="form-control form-control-sm" name="fullname" id="fullname" placeholder="Your Full Name"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-2">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input form-check-input-sm" id="airline_option" name="airline_option" onchange="toggleAirlineSelect()">
                                                
                                                <label class="form-check-label form-check-label-sm" for="airline_option">Preferred Airline (Optional)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden" id="airline_select_div">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 " >
                                                <div class="mb-2">
                                                    <div class="input-group input-group-merge">
                                                        <select class="form-select form-select-sm" id="airline1" name="airline1">
                                                            <option value="">Airline Option 1</option>
                                                            <option value="Air France">Air France</option>
                                                            <option value="Air Peace">Air Peace</option>
                                                            <option value="Arik Air">Arik Air</option>
                                                            <option value="Azman Air">Azman Air</option>
                                                            <option value="British Airways">British Airways</option>
                                                            <option value="Dana Air">Dana Air</option>
                                                            <option value="EgyptAir">EgyptAir</option>
                                                            <option value="Emirates">Emirates</option>
                                                            <option value="Ethiopian Airlines">Ethiopian Airlines</option>
                                                            <option value="Kenya Airways">Kenya Airways</option>
                                                            <option value="KLM Royal Dutch Airlines">KLM Royal Dutch Airlines</option>
                                                            <option value="Lufthansa">Lufthansa</option>
                                                            <option value="Med-View Airline">Med-View Airline</option>
                                                            <option value="Qatar Airways">Qatar Airways</option>
                                                            <option value="RwandAir">RwandAir</option>
                                                            <option value="South African Airways">South African Airways</option>
                                                            <option value="Turkish Airlines">Turkish Airlines</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 " >
                                                <div class="mb-2">
                                                    <div class="input-group input-group-merge">
                                                        <select class="form-select form-select-sm" id="airline2" name="airline2">
                                                            <option value="" >Airline Option 2</option>
                                                            <option value="Air France">Air France</option>
                                                            <option value="Air Peace">Air Peace</option>
                                                            <option value="Arik Air">Arik Air</option>
                                                            <option value="Azman Air">Azman Air</option>
                                                            <option value="British Airways">British Airways</option>
                                                            <option value="Dana Air">Dana Air</option>
                                                            <option value="EgyptAir">EgyptAir</option>
                                                            <option value="Emirates">Emirates</option>
                                                            <option value="Ethiopian Airlines">Ethiopian Airlines</option>
                                                            <option value="Kenya Airways">Kenya Airways</option>
                                                            <option value="KLM Royal Dutch Airlines">KLM Royal Dutch Airlines</option>
                                                            <option value="Lufthansa">Lufthansa</option>
                                                            <option value="Med-View Airline">Med-View Airline</option>
                                                            <option value="Qatar Airways">Qatar Airways</option>
                                                            <option value="RwandAir">RwandAir</option>
                                                            <option value="South African Airways">South African Airways</option>
                                                            <option value="Turkish Airlines">Turkish Airlines</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <button type="submit1" class="btn btn-sm btn-pry btn-block" style="width: 100%;">Get Free Quote</button>
                                        </div>
                                        <div class="col-sm-3"></div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <small class="text-muted" style="font-size:13px; line-height:22px;">
                                        <b></b> By providing my contact details and clicking on "GET A FREE QUOTE" I agree to be contacted for travel 
                                            information via phone call, text messages and email. We respect your <a href="{{route('air.policy')}}">privacy</a>.
                                            </b> 
                                        </small>
                                    </div>
                                </div>
                            </form>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <div id="loading-screen" style="display: none;">
        <!-- Loading screen content (e.g., logo, loading message) -->
         <video width="640" height="480" autoplay muted loop>
            <source src="{{ asset('public/assets/dist/loading.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <p>Loading... Please wait.</p>
    </div>
    
    <script>
        function toggleAirlineSelect() {
            var checkBox = document.getElementById("airline_option");
            var selectDiv = document.getElementById("airline_select_div");
            if (checkBox.checked) {
                selectDiv.classList.remove("hidden");
            } else {
                selectDiv.classList.add("hidden");
            }
        }
    </script>
    <script type="text/javascript">
    // Function to show the loading screen
    function showLoadingScreen() {
        document.getElementById('loading-screen').style.display = 'block';
    }

    // Function to hide the loading screen
    function hideLoadingScreen() {
        document.getElementById('loading-screen').style.display = 'none';
    }

    // Function to validate the form
    function validateForm() {
        const email = document.getElementById('email').value;
        const phone_no = document.getElementById('phone_no').value;
        const fullname = document.getElementById('fullname').value;

        if (email === '' || phone_no === '' || fullname === '') {
            alert('Please fill out all required fields.');
            return false;
        }
        return true;
    }

    // Function to toggle airline select visibility
    function toggleAirlineSelect() {
        var airlineSelectDiv = document.getElementById('airline_select_div');
        if (document.getElementById('airline_option').checked) {
            airlineSelectDiv.classList.remove('hidden');
        } else {
            airlineSelectDiv.classList.add('hidden');
        }
    }

    // Function to send WhatsApp message
    function sendWhatsApp() {
    
        var fullname = document.getElementById('fullname').value;
        var origin = document.getElementById('origin').value;
        var destination = document.getElementById('destination').value;
        var departure_date = document.getElementById('departure_date').value;
        var return_date = document.getElementById('return_date').value;
        var passenger = document.getElementById('passenger').value;
        var cabinType = document.getElementById('cabinType').value;
        var tripType = document.getElementById('tripType').value;

        var airlineOptionChecked = document.getElementById('airline_option').checked;
        var airline1 = airlineOptionChecked ? document.getElementById('airline1').value : '';
        var airline2 = airlineOptionChecked ? document.getElementById('airline2').value : '';
        var message = '';
        if (tripType === 'OneWay') {
            message = `Hello TravelWheel.\nI am ${fullname}.\nI just made a flight request for ${origin} to ${destination}\nDeparture Date: ${departure_date}.\n${passenger} | ${cabinType}`;
            if (airlineOptionChecked) {
                message += `\nPreferred Airlines:\n1. ${airline1}\n2. ${airline2}`;
            } 
        } 
        else if (tripType === 'Return') {
            message = `Hello TravelWheel.\nI am ${fullname}.\nI just made a flight request for ${origin} to ${destination}\nFrom ${departure_date} to ${return_date}.\n${passenger} | ${cabinType}`;
            if (airlineOptionChecked) {
                message += `\nPreferred Airlines:\n1. ${airline1}\n2. ${airline2}`; 
            }  
        }
        var phoneNumber = '+2349125871221'; // Replace with the desired phone number
        var url = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(message);
        // Open WhatsApp link in a new tab
        window.open(url, '_blank');
    }

    // Event listener for form submission
    document.getElementById('whatsappForm').addEventListener('submit', function (event) {
        var tripType = document.getElementById('tripType').value;
        
        event.preventDefault(); // Prevent the default form submission behavior
        if (!validateForm()) {
            return;
        }
        // Display the loading screen
        showLoadingScreen();

        if (tripType === 'OneWay' || tripType === 'Return') {
            // Send WhatsApp message and submit form after delay
            sendWhatsApp();
            
            setTimeout(function () {
                document.getElementById('whatsappForm').submit();
            }, 2000); // Adjust the delay as needed

        } else {
            setTimeout(function () {
                document.getElementById('whatsappForm').submit();
            }, 2000); // Adjust the delay as needed
        }
 
    });
 
    
</script>


                
@endsection