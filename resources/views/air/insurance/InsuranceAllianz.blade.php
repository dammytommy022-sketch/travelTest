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
                                <img src="{{ asset('public/assets/img/allianz.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            <div class="row airport-form shadow p-4 mb-5">
                <div class="col-sm-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Get Quote</h5>
                        </div>
                        <div class="card-body">

                        <form action="{{ url('/air/insuranceAllianzQuote')}}" method="POST">

                        {{ csrf_field() }}

                            <div class="row">

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="firstname">Booking Type</label>
                                        <select class="form-select" id="selection"  name="booking_type" aria-label="Default select example">
                                                <option value="">-- Select the booking type --</option>
                                                <option value="1">Individual</option>
                                                <option value="2">Family</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 hidden" id="elementToHide1">
                                    <div class="mb-3">
                                        <label class="form-label" for="nop">No. Of Children</label>
                                        <div class="input-group input-group-merge">                                 
                                        <span id="fullname" class="input-group-text"><i class="fa fa-users"></i></span>
                                        <input type="number" class="form-control" name="noc" id="numberInput" value="0" aria-describedby="basic-icon-default-fullname2">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-3 hidden" id="elementToHide2">
                                    <div class="mb-3">
                                        <label class="form-label" for="nop">No. Of People</label>
                                        <div class="input-group input-group-merge">
                                        <span id="fullname" class="input-group-text"><i class="fa fa-users"></i></span>
                                        <input type="number" class="form-control" name="nop" id="numberInput1" value="1" aria-describedby="basic-icon-default-fullname2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="firstname">Purpose Of Travel</label>
                                            <select class="form-select" name="purpose_of_travel" aria-label="Default select example">
                                                <option value="">-- Select purpose of travel --</option>
                                                <option value="Leisure">Leisure</option>
                                                <option value="Business">Business</option>
                                                <option value="School">School</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="service_date">Date of Birth</label>
                                        <input class="form-control" type="date" name="dob" value="2000-02-02"  id="html5-date-input" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone_no">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Your phone number"
                                            aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email Address</label>
                                        <div class="input-group input-group-merge">
                                            <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email Address"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                    </div>
                                </div>

                        

                                <div class="col-sm-3" id="country1">

                                    <div class="mb-3">

                                        <label class="form-label" for="firstname">Destination Country</label>

                                        <div class="input-group input-group-merge">

                                        <span id="fullname" class="input-group-text"><i class="fa fa-flag"></i></span>

                                        <select id="select1" onchange="updateSelect2()" class="form-select" name="country" aria-label="Default select example">

                                                <option value="">-- Select Country --</option>

                                                    <option value="114">Afghanistan</option>

                                                    <option value="116">Albania</option>

                                                    <option value="150">Algeria</option>

                                                    <option value="113">Andorra</option>

                                                    <option value="118">Angola</option>

                                                    <option value="115">Anguilla</option>

                                                    <option value="175">Antigua</option>

                                                    <option value="119">Argentina</option>

                                                    <option value="117">Armenia</option>

                                                    <option value="120">Australia</option>

                                                    <option value="2">Austria</option> 

                                                    <option value="121">Azerbaijan</option>

                                                    <option value="132">Bahamas</option>

                                                    <option value="126">Bahrain</option> 

                                                    <option value="123">Bangladesh</option>
    
                                                    <option value="122">Barbados</option>

                                                    <option value="135">Belarus</option>

                                                    <option value="3">Belgium</option>

                                                    <option value="136">Belize</option>

                                                    <option value="128">Benin</option>

                                                    <option value="129">Bermuda</option>

                                                    <option value="133">Bhutan</option>

                                                    <option value="176">Bolivia</option>

                                                    <option value="177">BOSNIA</option>

                                                    <option value="134">Botswana</option>

                                                    <option value="131">Brazil</option>

                                                    <option value="130">Brunei Darussalam</option>

                                                    <option value="125">Bulgaria</option>

                                                    <option value="124">Burkina Faso</option>

                                                    <option value="127">Burundi</option>

                                                    <option value="170">Cambodia</option>

                                                    <option value="140">Cameroon</option>

                                                    <option value="4">Canada</option>

                                                    <option value="145">Cape Verde</option>

                                                    <option value="172">Cayman Islands</option>

                                                    <option value="137">Central African Republic</option>

                                                    <option value="174">Chad</option>

                                                    <option value="139">Chile</option>

                                                    <option value="141">China</option>

                                                    <option value="142">Colombia</option>

                                                    <option value="171">Comoros</option>

                                                    <option value="138">Congo</option>

                                                    <option value="143">Costa Rica</option>

                                                    <option value="168">Croatia</option>

                                                    <option value="144">Cuba</option>

                                                    <option value="146">Cyprus</option>

                                                    <option value="6">Czech Republic</option>

                                                    <option value="178">Democratic Republic of the Congo</option>

                                                    <option value="8">Denmark</option>

                                                    <option value="147">Djibouti</option>

                                                    <option value="148">Dominica</option>

                                                    <option value="149">Dominican Republic</option>

                                                    <option value="151">Ecuador</option>

                                                    <option value="152">Egypt</option>

                                                    <option value="173">El Salvador</option>

                                                    <option value="164">Equatorial Guinea</option>

                                                    <option value="153">Eritrea</option>

                                                    <option value="9">Estonia</option>

                                                    <option value="154">Ethiopia</option>

                                                    <option value="155">Fiji</option>

                                                    <option value="11">Finland</option>

                                                    <option value="12">France</option>

                                                    <option value="159">French Guiana</option>

                                                    <option value="156">Gabon</option>

                                                    <option value="161">Gambia</option>

                                                    <option value="158">Georgia</option>

                                                    <option value="7">Germany</option>

                                                    <option value="160">Ghana</option>

                                                    <option value="13">Greece</option>

                                                    <option value="157">Grenada</option>

                                                    <option value="163">Guadeloupe</option>

                                                    <option value="165">Guatemala</option>

                                                    <option value="162">Guinea</option>

                                                    <option value="166">Guinea-Bissau</option>

                                                    <option value="167">Guyana</option>

                                                    <option value="169">Haiti</option>

                                                    <option value="14">Honduras</option>

                                                    <option value="15">Hungary</option>

                                                    <option value="19">Iceland</option>

                                                    <option value="17">India</option>

                                                    <option value="16">Indonesia</option>

                                                    <option value="180">Iran</option>

                                                    <option value="18">Iraq</option>

                                                    <option value="200">Ireland</option>

                                                    <option value="181">Israel</option>

                                                    <option value="20">Italy</option>

                                                    <option value="182">Ivory Coast</option>

                                                    <option value="21">Jamaica</option>

                                                    <option value="23">Japan</option>

                                                    <option value="22">Jordan</option>

                                                    <option value="27">Kazakhstan</option>

                                                    <option value="24">Kenya</option>

                                                    <option value="183">Korea, Democratic Republic of (North Korea) </option>

                                                    <option value="185">KOSOVO</option>

                                                    <option value="26">Kuwait</option>

                                                    <option value="186">Kyrgyz Republic (Kyrgyzstan)</option>

                                                    <option value="187">Laos</option>

                                                    <option value="36">Latvia</option>

                                                    <option value="28">Lebanon</option>

                                                    <option value="33">Lesotho</option>

                                                    <option value="32">Liberia</option>

                                                    <option value="37">Libya</option>

                                                    <option value="30">Liechtenstein</option>

                                                    <option value="34">Lithuania</option>

                                                    <option value="35">Luxembourg</option>

                                                    <option value="42">Madagascar</option>

                                                    <option value="51">Malawi</option>

                                                    <option value="53">Malaysia</option>

                                                    <option value="50">Maldives</option>

                                                    <option value="43">Mali</option>

                                                    <option value="48">Malta</option>

                                                    <option value="45">Martinique</option>

                                                    <option value="46">Mauritania</option>

                                                    <option value="49">Mauritius</option>

                                                    <option value="109">Mayotte</option>

                                                    <option value="52">Mexico</option>

                                                    <option value="39">Monaco</option>

                                                    <option value="44">Mongolia</option>

                                                    <option value="41">Montenegro</option>

                                                    <option value="47">Montserrat</option>

                                                    <option value="38">Morocco</option>

                                                    <option value="54">Mozambique</option>

                                                    <option value="188">Myanmar/Burma</option>

                                                    <option value="55">Namibia</option>

                                                    <option value="61">Nepal</option>

                                                    <option value="59">Netherlands</option>

                                                    <option value="62">New Zealand</option>

                                                    <option value="58">Nicaragua</option>

                                                    <option value="56">Niger</option>

                                                    <option value="60">Norway</option>

                                                    <option value="63">Oman</option>

                                                    <option value="189">Pacific Islands</option>

                                                    <option value="68">Pakistan</option>

                                                    <option value="64">Panama</option>

                                                    <option value="66">Papua New Guinea</option>

                                                    <option value="72">Paraguay</option>

                                                    <option value="65">Peru</option>

                                                    <option value="67">Philippines</option>

                                                    <option value="69">Poland</option>

                                                    <option value="71">Portugal</option>

                                                    <option value="70">Puerto Rico</option>

                                                    <option value="73">Qatar</option>

                                                    <option value="190">Republic of Macedonia</option>

                                                    <option value="40">Republic of Moldova</option>

                                                    <option value="191">Reunion</option>

                                                    <option value="74">Romania</option>

                                                    <option value="76">Russian Federation</option>

                                                    <option value="77">Rwanda</option>

                                                    <option value="25">Saint Kitts &amp; Nevis</option>

                                                    <option value="29">Saint Lucia</option>

                                                    <option value="192">Saint Vincent's &amp; Grenadines</option>

                                                    <option value="107">Samoa</option>

                                                    <option value="91">Sao Tome &amp; Principe</option>

                                                    <option value="78">Saudi Arabia</option>

                                                    <option value="87">Senegal</option>

                                                    <option value="75">Serbia</option>

                                                    <option value="80">Seychelles</option>

                                                    <option value="86">Sierra Leone</option>

                                                    <option value="83">Singapore</option>

                                                    <option value="201">Sint Maarten (Dutch part)</option>

                                                    <option value="193">Slovak Republic (Slovakia)</option>

                                                    <option value="85">SLOVAKIA</option>

                                                    <option value="84">Slovenia</option>

                                                    <option value="79">Solomon Islands</option>

                                                    <option value="88">Somalia</option>

                                                    <option value="110">South Africa</option>

                                                    <option value="184">South Korea</option>

                                                    <option value="90">South Sudan</option>

                                                    <option value="10">Spain</option>

                                                    <option value="31">Sri Lanka</option>

                                                    <option value="81">Sudan</option>

                                                    <option value="89">Suriname</option>

                                                    <option value="92">Swaziland</option>

                                                    <option value="82">Sweden</option>

                                                    <option value="5">Switzerland</option>

                                                    <option value="194">Syria</option>

                                                    <option value="202">Taiwan</option>

                                                    <option value="95">Tajikistan</option>

                                                    <option value="195">Tanzania</option>

                                                    <option value="94">Thailand</option>

                                                    <option value="196">Timor Leste</option>

                                                    <option value="93">Togo</option>

                                                    <option value="197">Trinidad &amp; Tobago</option>

                                                    <option value="97">Tunisia</option>

                                                    <option value="98">Turkey</option>

                                                    <option value="96">Turkmenistan</option>

                                                    <option value="198">Turks &amp; Caicos Islands</option>

                                                    <option value="100">Uganda</option>

                                                    <option value="99">Ukraine</option>

                                                    <option value="1">United Arab Emirates</option>

                                                    <option value="179">United Kingdom</option>

                                                    <option value="199">United States of America</option>

                                                    <option value="101">Uruguay</option>

                                                    <option value="102">Uzbekistan</option>

                                                    <option value="103">Venezuela</option>

                                                    <option value="106">Vietnam</option>

                                                    <option value="104">VIRGIN ISLANDS (BRITISH)</option>

                                                    <option value="105">VIRGIN ISLANDS (US)</option>

                                                    <option value="108">Yemen</option>

                                                    <option value="111">Zambia</option>

                                                    <option value="112">Zimbabwe</option>



                                            </select>



                                        </div>

                                    </div>

                                </div>

                            

                                <div class="col-sm-3">

                                    <div class="mb-3">

                                        <label class="form-label" for="service_date">Cover Begins</label>

                                        <input class="form-control" type="date" name="begin_date"  id="begin_date" />

                                        

                                    </div>

                                    

                                </div>

                                <div class="col-sm-3">

                                    <div class="mb-3"> 

                                        <label class="form-label" for="service_date">Cover Ends <b><span id="result" style="color:red;"></span></b> </label>

                                        <input class="form-control" type="date" name="end_date"  id="end_date"/>

                                        

                                    </div>

                                    

                                </div>

                                <div class="col-sm-3" id="cover">

                                    <div class="mb-3">

                                        <label class="form-label" for="firstname">Level of cover</label>

                                        

                                        <select id="select2" class="form-select" name="travel_plan" aria-label="Default select example" requied>
                                                <option value="">Level Of Cover</option>    
                                        </select>

                                    </div>

                                </div>

                                

                                <div class="col-sm-3 hidden" id="multi-trip1">

                                    <div class="mb-3">

                                        <label class="form-label" for="firstname">Destination Country 1</label>

                                        <div class="input-group input-group-merge">

                                            <span id="fullname" class="input-group-text"><i class="fa fa-flag"></i></span>

                                            <select id="country1"  class="form-select" name="country1" aria-label="Default select example">

                                                <option value="">- Select Country -</option>

                                                <option value="114">Afghanistan</option>

                                                <option value="116">Albania</option>

                                                <option value="150">Algeria</option>

                                                <option value="113">Andorra</option>

                                                <option value="118">Angola</option>

                                                <option value="115">Anguilla</option>

                                                <option value="175">Antigua</option>

                                                <option value="119">Argentina</option>

                                                <option value="117">Armenia</option>

                                                <option value="120">Australia</option>

                                                <option value="2">Austria</option> 

                                                <option value="121">Azerbaijan</option>

                                                <option value="132">Bahamas</option>

                                                <option value="126">Bahrain</option>

                                                <option value="123">Bangladesh</option>

                                                <option value="122">Barbados</option>

                                                <option value="135">Belarus</option>

                                                <option value="3">Belgium</option>

                                                <option value="136">Belize</option>

                                                <option value="128">Benin</option>

                                                <option value="129">Bermuda</option>

                                                <option value="133">Bhutan</option>

                                                <option value="176">Bolivia</option>

                                                <option value="177">BOSNIA</option>

                                                <option value="134">Botswana</option>

                                                <option value="131">Brazil</option>

                                                <option value="130">Brunei Darussalam</option>

                                                <option value="125">Bulgaria</option>

                                                <option value="124">Burkina Faso</option>

                                                <option value="127">Burundi</option>

                                                <option value="170">Cambodia</option>

                                                <option value="140">Cameroon</option>

                                                <option value="4">Canada</option>

                                                <option value="145">Cape Verde</option>

                                                <option value="172">Cayman Islands</option>

                                                <option value="137">Central African Republic</option>

                                                <option value="174">Chad</option>

                                                <option value="139">Chile</option>

                                                <option value="141">China</option>

                                                <option value="142">Colombia</option>

                                                <option value="171">Comoros</option>

                                                <option value="138">Congo</option>

                                                <option value="143">Costa Rica</option>

                                                <option value="168">Croatia</option>

                                                <option value="144">Cuba</option>

                                                <option value="146">Cyprus</option>

                                                <option value="6">Czech Republic</option>

                                                <option value="178">Democratic Republic of the Congo</option>

                                                <option value="8">Denmark</option>

                                                <option value="147">Djibouti</option>

                                                <option value="148">Dominica</option>

                                                <option value="149">Dominican Republic</option>

                                                <option value="151">Ecuador</option>

                                                <option value="152">Egypt</option>

                                                <option value="173">El Salvador</option>

                                                <option value="164">Equatorial Guinea</option>

                                                <option value="153">Eritrea</option>

                                                <option value="9">Estonia</option>

                                                <option value="154">Ethiopia</option>

                                                <option value="155">Fiji</option>

                                                <option value="11">Finland</option>

                                                <option value="12">France</option>

                                                <option value="159">French Guiana</option>

                                                <option value="156">Gabon</option>

                                                <option value="161">Gambia</option>

                                                <option value="158">Georgia</option>

                                                <option value="7">Germany</option>

                                                <option value="160">Ghana</option>

                                                <option value="13">Greece</option>

                                                <option value="157">Grenada</option>

                                                <option value="163">Guadeloupe</option>

                                                <option value="165">Guatemala</option>

                                                <option value="162">Guinea</option>

                                                <option value="166">Guinea-Bissau</option>

                                                <option value="167">Guyana</option>

                                                <option value="169">Haiti</option>

                                                <option value="14">Honduras</option>

                                                <option value="15">Hungary</option>

                                                <option value="19">Iceland</option>

                                                <option value="17">India</option>

                                                <option value="16">Indonesia</option>

                                                <option value="180">Iran</option>

                                                <option value="18">Iraq</option>

                                                <option value="200">Ireland</option>

                                                <option value="181">Israel</option>

                                                <option value="20">Italy</option>

                                                <option value="182">Ivory Coast</option>

                                                <option value="21">Jamaica</option>

                                                <option value="23">Japan</option>

                                                <option value="22">Jordan</option>

                                                <option value="27">Kazakhstan</option>

                                                <option value="24">Kenya</option>

                                                <option value="183">Korea, Democratic Republic of (North Korea) </option>

                                                <option value="185">KOSOVO</option>

                                                <option value="26">Kuwait</option>

                                                <option value="186">Kyrgyz Republic (Kyrgyzstan)</option>

                                                <option value="187">Laos</option>

                                                <option value="36">Latvia</option>

                                                <option value="28">Lebanon</option>

                                                <option value="33">Lesotho</option>

                                                <option value="32">Liberia</option>

                                                <option value="37">Libya</option>

                                                <option value="30">Liechtenstein</option>

                                                <option value="34">Lithuania</option>

                                                <option value="35">Luxembourg</option>

                                                <option value="42">Madagascar</option>

                                                <option value="51">Malawi</option>

                                                <option value="53">Malaysia</option>

                                                <option value="50">Maldives</option>

                                                <option value="43">Mali</option>

                                                <option value="48">Malta</option>

                                                <option value="45">Martinique</option>

                                                <option value="46">Mauritania</option>

                                                <option value="49">Mauritius</option>

                                                <option value="109">Mayotte</option>

                                                <option value="52">Mexico</option>

                                                <option value="39">Monaco</option>

                                                <option value="44">Mongolia</option>

                                                <option value="41">Montenegro</option>

                                                <option value="47">Montserrat</option>

                                                <option value="38">Morocco</option>

                                                <option value="54">Mozambique</option>

                                                <option value="188">Myanmar/Burma</option>

                                                <option value="55">Namibia</option>

                                                <option value="61">Nepal</option>

                                                <option value="59">Netherlands</option>

                                                <option value="62">New Zealand</option>

                                                <option value="58">Nicaragua</option>

                                                <option value="56">Niger</option>

                                                <option value="60">Norway</option>

                                                <option value="63">Oman</option>

                                                <option value="189">Pacific Islands</option>

                                                <option value="68">Pakistan</option>

                                                <option value="64">Panama</option>

                                                <option value="66">Papua New Guinea</option>

                                                <option value="72">Paraguay</option>

                                                <option value="65">Peru</option>

                                                <option value="67">Philippines</option>

                                                <option value="69">Poland</option>

                                                <option value="71">Portugal</option>

                                                <option value="70">Puerto Rico</option>

                                                <option value="73">Qatar</option>

                                                <option value="190">Republic of Macedonia</option>

                                                <option value="40">Republic of Moldova</option>

                                                <option value="191">Reunion</option>

                                                <option value="74">Romania</option>

                                                <option value="76">Russian Federation</option>

                                                <option value="77">Rwanda</option>

                                                <option value="25">Saint Kitts &amp; Nevis</option>

                                                <option value="29">Saint Lucia</option>

                                                <option value="192">Saint Vincent's &amp; Grenadines</option>

                                                <option value="107">Samoa</option>

                                                <option value="91">Sao Tome &amp; Principe</option>

                                                <option value="78">Saudi Arabia</option>

                                                <option value="87">Senegal</option>

                                                <option value="75">Serbia</option>

                                                <option value="80">Seychelles</option>

                                                <option value="86">Sierra Leone</option>

                                                <option value="83">Singapore</option>

                                                <option value="201">Sint Maarten (Dutch part)</option>

                                                <option value="193">Slovak Republic (Slovakia)</option>

                                                <option value="85">SLOVAKIA</option>

                                                <option value="84">Slovenia</option>

                                                <option value="79">Solomon Islands</option>

                                                <option value="88">Somalia</option>

                                                <option value="110">South Africa</option>

                                                <option value="184">South Korea</option>

                                                <option value="90">South Sudan</option>

                                                <option value="10">Spain</option>

                                                <option value="31">Sri Lanka</option>

                                                <option value="81">Sudan</option>

                                                <option value="89">Suriname</option>

                                                <option value="92">Swaziland</option>

                                                <option value="82">Sweden</option>

                                                <option value="5">Switzerland</option>

                                                <option value="194">Syria</option>

                                                <option value="202">Taiwan</option>

                                                <option value="95">Tajikistan</option>

                                                <option value="195">Tanzania</option>

                                                <option value="94">Thailand</option>

                                                <option value="196">Timor Leste</option>

                                                <option value="93">Togo</option>

                                                <option value="197">Trinidad &amp; Tobago</option>

                                                <option value="97">Tunisia</option>

                                                <option value="98">Turkey</option>

                                                <option value="96">Turkmenistan</option>

                                                <option value="198">Turks &amp; Caicos Islands</option>

                                                <option value="100">Uganda</option>

                                                <option value="99">Ukraine</option>

                                                <option value="1">United Arab Emirates</option>

                                                <option value="179">United Kingdom</option>

                                                <option value="199">United States of America</option>

                                                <option value="101">Uruguay</option>

                                                <option value="102">Uzbekistan</option>

                                                <option value="103">Venezuela</option>

                                                <option value="106">Vietnam</option>

                                                <option value="104">VIRGIN ISLANDS (BRITISH)</option>

                                                <option value="105">VIRGIN ISLANDS (US)</option>

                                                <option value="108">Yemen</option>

                                                <option value="111">Zambia</option>

                                                <option value="112">Zimbabwe</option>

                                                </select>

                                            </select>



                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-3 hidden" id="multi-trip2">

                                    <div class="mb-3">

                                        <label class="form-label" for="firstname">Destination Country 2</label>

                                        <div class="input-group input-group-merge">

                                        <span id="fullname" class="input-group-text"><i class="fa fa-flag"></i></span>

                                        <select id="country2" class="form-select" name="country2" aria-label="Default select example">

                                                <option value="">-- Select Country --</option>

                                                <option value="AF">Afghanistan</option>

                                                <option value="AX">Åland Islands</option>

                                                <option value="AL">Albania</option>

                                                <option value="DZ">Algeria</option>

                                                <option value="AS">American Samoa</option>

                                                <option value="AD">Andorra</option>

                                                <option value="AO">Angola</option>

                                                <option value="AI">Anguilla</option>

                                                <option value="AQ">Antarctica</option>

                                                <option value="AG">Antigua and Barbuda</option>

                                                <option value="AR">Argentina</option>

                                                <option value="AM">Armenia</option>

                                                <option value="AW">Aruba</option>

                                                <option value="AU">Australia</option>

                                                <option value="AT">Austria</option>

                                                <option value="AZ">Azerbaijan</option>

                                                <option value="BS">Bahamas (the)</option>

                                                <option value="BH">Bahrain</option>

                                                <option value="BD">Bangladesh</option>

                                                <option value="BB">Barbados</option>

                                                <option value="BY">Belarus</option>

                                                <option value="BE">Belgium</option>

                                                <option value="BZ">Belize</option>

                                                <option value="BJ">Benin</option>

                                                <option value="BM">Bermuda</option>

                                                <option value="BT">Bhutan</option>

                                                <option value="BO">Bolivia (Plurinational State of)</option>

                                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>

                                                <option value="BA">Bosnia and Herzegovina</option>

                                                <option value="BW">Botswana</option>

                                                <option value="BV">Bouvet Island</option>

                                                <option value="BR">Brazil</option>

                                                <option value="IO">British Indian Ocean Territory (the)</option>

                                                <option value="BN">Brunei Darussalam</option>

                                                <option value="BG">Bulgaria</option>

                                                <option value="BF">Burkina Faso</option>

                                                <option value="BI">Burundi</option>

                                                <option value="CV">Cabo Verde</option>

                                                <option value="KH">Cambodia</option>

                                                <option value="CM">Cameroon</option>

                                                <option value="CA">Canada</option>

                                                <option value="KY">Cayman Islands (the)</option>

                                                <option value="CF">Central African Republic (the)</option>

                                                <option value="TD">Chad</option>

                                                <option value="CL">Chile</option>

                                                <option value="CN">China</option>

                                                <option value="CX">Christmas Island</option>

                                                <option value="CC">Cocos (Keeling) Islands (the)</option>

                                                <option value="CO">Colombia</option>

                                                <option value="KM">Comoros (the)</option>

                                                <option value="CD">Congo (the Democratic Republic of the)</option>

                                                <option value="CG">Congo (the)</option>

                                                <option value="CK">Cook Islands (the)</option>

                                                <option value="CR">Costa Rica</option>

                                                <option value="HR">Croatia</option>

                                                <option value="CU">Cuba</option>

                                                <option value="CW">Curaçao</option>

                                                <option value="CY">Cyprus</option>

                                                <option value="CZ">Czech Republic</option>

                                                <option value="CI">Côte d'Ivoire</option>

                                                <option value="DK">Denmark</option>

                                                <option value="DJ">Djibouti</option>

                                                <option value="DM">Dominica</option>

                                                <option value="DO">Dominican Republic (the)</option>

                                                <option value="EC">Ecuador</option>

                                                <option value="EG">Egypt</option>

                                                <option value="SV">El Salvador</option>

                                                <option value="GQ">Equatorial Guinea</option>

                                                <option value="ER">Eritrea</option>

                                                <option value="EE">Estonia</option>

                                                <option value="SZ">Eswatini</option>

                                                <option value="ET">Ethiopia</option>

                                                <option value="FK">Falkland Islands (the) [Malvinas]</option>

                                                <option value="FO">Faroe Islands (the)</option>

                                                <option value="FJ">Fiji</option>

                                                <option value="FI">Finland</option>

                                                <option value="FR">France</option>

                                                <option value="GF">French Guiana</option>

                                                <option value="PF">French Polynesia</option>

                                                <option value="TF">French Southern Territories (the)</option>

                                                <option value="GA">Gabon</option>

                                                <option value="GM">Gambia (the)</option>

                                                <option value="GE">Georgia</option>

                                                <option value="DE">Germany</option>

                                                <option value="GH">Ghana</option>

                                                <option value="GI">Gibraltar</option>

                                                <option value="GR">Greece</option>

                                                <option value="GL">Greenland</option>

                                                <option value="GD">Grenada</option>

                                                <option value="GP">Guadeloupe</option>

                                                <option value="GU">Guam</option>

                                                <option value="GT">Guatemala</option>

                                                <option value="GG">Guernsey</option>

                                                <option value="GN">Guinea</option>

                                                <option value="GW">Guinea-Bissau</option>

                                                <option value="GY">Guyana</option>

                                                <option value="HT">Haiti</option>

                                                <option value="HM">Heard Island and McDonald Islands</option>

                                                <option value="VA">Holy See (the)</option>

                                                <option value="HN">Honduras</option>

                                                <option value="HK">Hong Kong</option>

                                                <option value="HU">Hungary</option>

                                                <option value="IS">Iceland</option>

                                                <option value="IN">India</option>

                                                <option value="ID">Indonesia</option>

                                                <option value="IR">Iran (Islamic Republic of)</option>

                                                <option value="IQ">Iraq</option>

                                                <option value="IE">Ireland</option>

                                                <option value="IM">Isle of Man</option>

                                                <option value="IL">Israel</option>

                                                <option value="IT">Italy</option>

                                                <option value="JM">Jamaica</option>

                                                <option value="JP">Japan</option>

                                                <option value="JE">Jersey</option>

                                                <option value="JO">Jordan</option>

                                                <option value="KZ">Kazakhstan</option>

                                                <option value="KE">Kenya</option>

                                                <option value="KI">Kiribati</option>

                                                <option value="KP">Korea (the Democratic People's Republic of)</option>

                                                <option value="KR">Korea (the Republic of)</option>

                                                <option value="KW">Kuwait</option>

                                                <option value="KG">Kyrgyzstan</option>

                                                <option value="LA">Lao People's Democratic Republic (the)</option>

                                                <option value="LV">Latvia</option>

                                                <option value="LB">Lebanon</option>

                                                <option value="LS">Lesotho</option>

                                                <option value="LR">Liberia</option>

                                                <option value="LY">Libya</option>

                                                <option value="LI">Liechtenstein</option>

                                                <option value="LT">Lithuania</option>

                                                <option value="LU">Luxembourg</option>

                                                <option value="MO">Macao</option>

                                                <option value="MG">Madagascar</option>

                                                <option value="MW">Malawi</option>

                                                <option value="MY">Malaysia</option>

                                                <option value="MV">Maldives</option>

                                                <option value="ML">Mali</option>

                                                <option value="MT">Malta</option>

                                                <option value="MH">Marshall Islands (the)</option>

                                                <option value="MQ">Martinique</option>

                                                <option value="MR">Mauritania</option>

                                                <option value="MU">Mauritius</option>

                                                <option value="YT">Mayotte</option>

                                                <option value="MX">Mexico</option>

                                                <option value="FM">Micronesia (Federated States of)</option>

                                                <option value="MD">Moldova (the Republic of)</option>

                                                <option value="MC">Monaco</option>

                                                <option value="MN">Mongolia</option>

                                                <option value="ME">Montenegro</option>

                                                <option value="MS">Montserrat</option>

                                                <option value="MA">Morocco</option>

                                                <option value="MZ">Mozambique</option>

                                                <option value="MM">Myanmar</option>

                                                <option value="NA">Namibia</option>

                                                <option value="NR">Nauru</option>

                                                <option value="NP">Nepal</option>

                                                <option value="NL">Netherlands (the)</option>

                                                <option value="NC">New Caledonia</option>

                                                <option value="NZ">New Zealand</option>

                                                <option value="NI">Nicaragua</option>

                                                <option value="NE">Niger (the)</option>

                                                <option value="NG">Nigeria</option>

                                                <option value="NU">Niue</option>

                                                <option value="NF">Norfolk Island</option>

                                                <option value="MP">Northern Mariana Islands (the)</option>

                                                <option value="NO">Norway</option>

                                                <option value="OM">Oman</option>

                                                <option value="PK">Pakistan</option>

                                                <option value="PW">Palau</option>

                                                <option value="PS">Palestine, State of</option>

                                                <option value="PA">Panama</option>

                                                <option value="PG">Papua New Guinea</option>

                                                <option value="PY">Paraguay</option>

                                                <option value="PE">Peru</option>

                                                <option value="PH">Philippines (the)</option>

                                                <option value="PN">Pitcairn</option>

                                                <option value="PL">Poland</option>

                                                <option value="PT">Portugal</option>

                                                <option value="PR">Puerto Rico</option>

                                                <option value="QA">Qatar</option>

                                                <option value="MK">Republic of North Macedonia</option>

                                                <option value="RO">Romania</option>

                                                <option value="RU">Russian Federation (the)</option>

                                                <option value="RW">Rwanda</option>

                                                <option value="RE">Réunion</option>

                                                <option value="BL">Saint Barthélemy</option>

                                                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>

                                                <option value="KN">Saint Kitts and Nevis</option>

                                                <option value="LC">Saint Lucia</option>

                                                <option value="MF">Saint Martin (French part)</option>

                                                <option value="PM">Saint Pierre and Miquelon</option>

                                                <option value="VC">Saint Vincent and the Grenadines</option>

                                                <option value="WS">Samoa</option>

                                                <option value="SM">San Marino</option>

                                                <option value="ST">Sao Tome and Principe</option>

                                                <option value="SA">Saudi Arabia</option>

                                                <option value="SN">Senegal</option>

                                                <option value="RS">Serbia</option>

                                                <option value="SC">Seychelles</option>

                                                <option value="SL">Sierra Leone</option>

                                                <option value="SG">Singapore</option>

                                                <option value="SX">Sint Maarten (Dutch part)</option>

                                                <option value="SK">Slovakia</option>

                                                <option value="SI">Slovenia</option>

                                                <option value="SB">Solomon Islands</option>

                                                <option value="SO">Somalia</option>

                                                <option value="ZA">South Africa</option>

                                                <option value="GS">South Georgia and the South Sandwich Islands</option>

                                                <option value="SS">South Sudan</option>

                                                <option value="ES">Spain</option>

                                                <option value="LK">Sri Lanka</option>

                                                <option value="SD">Sudan (the)</option>

                                                <option value="SR">Suriname</option>

                                                <option value="SJ">Svalbard and Jan Mayen</option>

                                                <option value="SE">Sweden</option>

                                                <option value="CH">Switzerland</option>

                                                <option value="SY">Syrian Arab Republic</option>

                                                <option value="TW">Taiwan (Province of China)</option>

                                                <option value="TJ">Tajikistan</option>

                                                <option value="TZ">Tanzania, United Republic of</option>

                                                <option value="TH">Thailand</option>

                                                <option value="TL">Timor-Leste</option>

                                                <option value="TG">Togo</option>

                                                <option value="TK">Tokelau</option>

                                                <option value="TO">Tonga</option>

                                                <option value="TT">Trinidad and Tobago</option>

                                                <option value="TN">Tunisia</option>

                                                <option value="TR">Turkey</option>

                                                <option value="TM">Turkmenistan</option>

                                                <option value="TC">Turks and Caicos Islands (the)</option>

                                                <option value="TV">Tuvalu</option>

                                                <option value="UG">Uganda</option>

                                                <option value="UA">Ukraine</option>

                                                <option value="AE">United Arab Emirates (the)</option>

                                                <option value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>

                                                <option value="UM">United States Minor Outlying Islands (the)</option>

                                                <option value="US">United States of America (the)</option>

                                                <option value="UY">Uruguay</option>

                                                <option value="UZ">Uzbekistan</option>

                                                <option value="VU">Vanuatu</option>

                                                <option value="VE">Venezuela (Bolivarian Republic of)</option>

                                                <option value="VN">Viet Nam</option>

                                                <option value="VG">Virgin Islands (British)</option>

                                                <option value="VI">Virgin Islands (U.S.)</option>

                                                <option value="WF">Wallis and Futuna</option>

                                                <option value="EH">Western Sahara</option>

                                                <option value="YE">Yemen</option>

                                                <option value="ZM">Zambia</option>

                                                <option value="ZW">Zimbabwe</option>

                                            </select>



                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-3">

                                    <div class="mb-3 pt-4">

                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />

                                    <label class="form-check-label" for="defaultCheck1">I agreed to Terms & Services.</label>

                                    </div>

                                

                                </div>

                                <!-- <div class="col-sm-6">

                                    <div class="mb-3 pt-4">

                                        <input class="form-check-input" type="checkbox" onchange="toggleSelect()" value="multi_trip" id="multi" />

                                        <label class="form-check-label" for="defaultCheck1">Multi-Trip</label>

                                    </div>

                                

                                </div> -->

                                <div class="col-sm-3">

                                    <button type="submit" class="btn btn-pry">Get Quote</button>

                        

                                </div>

                            </div>
                            </form>
                        </div>     
                    </div>
                </div>
                <div class="col-sm-6">
                    @if(session('success'))
                        <div class="card-body bg-light">
                            <h6> <b> PRICING</b></h6>
                            @if(session('success'))
                                <p>The Qoute Price Is: <b>{{ session('amount') }}</b></p>
                            @endif
                            @if(session('dataRequest'))
                                <input type="hidden" name="dataRequest" value="{{ session('dataRequest') }}">
                            @endif
                            @if(session('success'))
                            <a href="{{ url('/air/insuranceRequest') }}?dataRequest={{ session('dataRequest') }}" class="btn btn-success">Purchase</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
</section>

@include('layouts.footer')
</main>
<script>
    const selectElement = document.getElementById('selection');
    const numberInputElement = document.getElementById('numberInput1');
    selectElement.addEventListener('change', function () {
        const selectedValue = parseInt(selectElement.value);
        switch (selectedValue) {
        case 1:
            numberInputElement.value = "1";
            break;
        case 2:
            numberInputElement.value = "1";
            break;
        case 3:
            numberInputElement.value = "1";
            break;
        default:
            numberInputElement.value = "0";
            break;
        }
    });
</script>

<script>
    function updateSelect2() {
    let select1 = document.getElementById("select1");
    let select2 = document.getElementById("select2");
    let selectedOption = select1.value;
    let country = ["2", "3", "6", "8", "9", "11", "12", "7", "13", "15", "19", "20", "36", "34",
                     "35", "48", "59", "60", "69", "71", "84", "85", "10", "82", "5", "30"];              
    select2.innerHTML = "";
    // Add options to select2 based on the selected option in select1
    if (country.includes(selectedOption)) {
        select2.add(new Option("Schengen", "Schengen"));
        } 
        else{
            select2.add(new Option("Worldwide Area 1&2", "Worldwide Area 1&2"));
        }
    }
    function toggleSelect() {
        let checkbox = document.getElementById("multi");
        let select_multi1 = document.getElementById("multi-trip1");
        let select_multi2 = document.getElementById("multi-trip2");
        let select_country1 = document.getElementById("country1");
        let select_cover = document.getElementById("cover");
        if (checkbox.checked) {
            select_multi1.style.display = "block";
            select_multi2.style.display = "block";
            select_country1.style.display = "none";
            select_cover.style.display = "none";
        } else {
            select_multi1.style.display = "none";
            select_multi2.style.display = "none";
            select_country1.style.display = "block";
            select_cover.style.display = "block";
        }
    }
</script>
<script>
  var startDateInput = document.getElementById("begin_date");
  var endDateInput = document.getElementById("end_date");
  var resultElement = document.getElementById("result");
  startDateInput.addEventListener("change", calculateDays);
  endDateInput.addEventListener("change", calculateDays);

  function calculateDays() {
    var startDate = new Date(startDateInput.value);
    var endDate = new Date(endDateInput.value);
    if (!isNaN(startDate) && !isNaN(endDate)) {
      var timeDifference = endDate.getTime() - startDate.getTime();
      var daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
      resultElement.textContent =  daysDifference + "Days " ;
    }
  }
</script>
<script>
    var selection = document.getElementById("selection");
    var elementToHide1 = document.getElementById("elementToHide1");
    var elementToHide2 = document.getElementById("elementToHide2");
  
    selection.addEventListener("change", function() {
        if (selection.value === "1") {
            elementToHide1.style.display = "none";
            elementToHide2.style.display = "none";      
        } else if (selection.value === "2") {
            elementToHide1.style.display = "block";
            elementToHide2.style.display = "none";
        } else if (selection.value === "3") {
            elementToHide2.style.display = "block";
            elementToHide1.style.display = "none";     
        }else {
            elementToHide1.style.display = "none";
            elementToHide2.style.display = "none";
        }
    });
</script>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</body>
</html>
