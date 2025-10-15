<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Title -->
<title>TravelWheel | Air Cargo</title>
 
<!-- Date picker CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/ship/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('public/assets/ship/assets/css/bootstrap-datetimepicker.min.css')}}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/ship/style.css')}}">

<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/ship/assets/css/responsive.css')}}">
<!-- jQuery -->
<script src="{{ asset('public/assets/ship/assets/js/jquery-3.4.1.min.js')}}"></script>
<style>
  #area-autocomplete-container {
      position: relative;
      max-width: 100%;
  }

    #typeOfDoc::placeholder {
      font-size: 12px;
    }
  
  #area-input {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
  }
  
  #area-suggestions {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      border-top: none;
      border-radius: 0 0 4px 4px;
      max-height: 200px;
      overflow-y: auto;
      display: none;
      z-index: 1000;
  }
  
  .area-suggestion-item {
      padding: 8px 10px;
      cursor: pointer;
  }
  
  .area-suggestion-item:hover {
      background-color: #f0f0f0;
  }

  input {
    font-family: "Arial", sans-serif; /* Change to any font you want */
    font-size: 24px;
  }

</style>
<script>
    document.getElementById('myForm').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
          event.preventDefault(); // Prevent form submission on Enter
        }
    });
</script>
</head>
<body>
<!-- Main Wrapper Start -->
<div class="main-wrapper"> 
  <!-- Create New Shipment Start -->
  <div class="wshipping-content-block shipping-block">
    <div class="container">
      <h2 class="heading2-border mt0">Create New Shipping</h2>
      <div class="row">
        <div class="shipping-form-block">
          <form class="steps" action="{{ route('air.aircargoPost')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">From</li>
              <li>To</li>
              <li>Details</li>
              <li>How</li>
              <li>Review</li>
              <li>Payment</li>
              <li>Complete</li>
            </ul>
            <!-- fieldsets Shipping From Start-->
            <fieldset>
              <h2 class="fs-title">Welcome, where are you shipping from?</h2>
              <h3 class="fs-subtitle">* Indicates required field </h3>
              <div class="shipping-form">
                 <div class="row">
                  <div class="col-12 col-lg-9">
                    <div class="form-group">
                      <label>Address<sup>*</sup></label>
                      <input type="text" id="autocomplete1" class="form-control" name="address1" required="required" placeholder="Your Address" oninput="updateParagraph()"  onfocus="initAutocomplete1()" />
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle  text-danger"></i> </span> 
                    </div>
                  </div>
                  
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Postal Code<sup>*</sup></label>
                      <input type="text" id="postalcode1" class="form-control" required="required" name="postalcode1" />
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle  text-danger"></i> </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Country<sup>*</sup></label>
                      <select name="country" class="form-control" id="countrySelect1" onchange="updateParagraph()">
                        <option value="AF" data-category="zone_6" data-name="Afghanistan">Afghanistan</option>
                        <option value="AL" data-category="zone_4" data-name="Albania">Albania</option>
                        <option value="DZ" data-category="zone_5" data-name="Algeria">Algeria</option>
                        <option value="AS" data-category="zone_8" data-name="American Samoa">American Samoa</option>
                        <option value="AD" data-category="zone_4" data-name="Andorra">Andorra</option>
                        <option value="AO" data-category="zone_5" data-name="Angola">Angola</option>
                        <option value="AI" data-category="zone_8" data-name="Anguilla">Anguilla</option>
                        <option value="AG" data-category="zone_8" data-name="Antigua">Antigua</option>
                        <option value="AR" data-category="zone_8" data-name="Argentina">Argentina</option>
                        <option value="AM" data-category="zone_7" data-name="Armenia">Armenia</option>
                        <option value="AW" data-category="zone_8" data-name="Aruba">Aruba</option>
                        <option value="AU" data-category="zone_7" data-name="Australia">Australia</option>
                        <option value="AT" data-category="zone_4" data-name="Austria">Austria</option>
                        <option value="AZ" data-category="zone_7" data-name="Azerbaijan">Azerbaijan</option>
                        <option value="BS" data-category="zone_8" data-name="Bahamas">Bahamas</option>
                        <option value="BH" data-category="zone_6" data-name="Bahrain">Bahrain</option>
                        <option value="BD" data-category="zone_7" data-name="Bangladesh">Bangladesh</option>
                        <option value="BB" data-category="zone_8" data-name="Barbados">Barbados</option>
                        <option value="BY" data-category="zone_4" data-name="Belarus">Belarus</option>
                        <option value="BE" data-category="zone_4" data-name="Belgium">Belgium</option>
                        <option value="BZ" data-category="zone_8" data-name="Belize">Belize</option>
                        <option value="BJ" data-category="zone_2" data-name="Benin">Benin</option>
                        <option value="BM" data-category="zone_8" data-name="Bermuda">Bermuda</option>
                        <option value="BT" data-category="zone_7" data-name="Bhutan">Bhutan</option>
                        <option value="BO" data-category="zone_8" data-name="Bolivia">Bolivia</option>
                        <option value="BA" data-category="zone_4" data-name="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                        <option value="BW" data-category="zone_5" data-name="Botswana">Botswana</option>
                        <option value="BR" data-category="zone_8" data-name="Brazil">Brazil</option>
                        <option value="IO" data-category="zone_8" data-name="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="VG" data-category="zone_8" data-name="British Virgin Islands">British Virgin Islands</option>
                        <option value="BN" data-category="zone_7" data-name="Brunei">Brunei</option>
                        <option value="BG" data-category="zone_4" data-name="Bulgaria">Bulgaria</option>
                        <option value="BF" data-category="zone_2" data-name="Burkina Faso">Burkina Faso</option>
                        <option value="BI" data-category="zone_5" data-name="Burundi">Burundi</option>
                        <option value="KH" data-category="zone_7" data-name="Cambodia">Cambodia</option>
                        <option value="CM" data-category="zone_2" data-name="Cameroon">Cameroon</option>
                        <option value="CA" data-category="zone_3" data-name="Canada">Canada</option>
                        <option value="KY" data-category="zone_8" data-name="Cayman Islands">Cayman Islands</option>
                        <option value="CF" data-category="zone_2" data-name="Central African Republic">Central African Republic</option>
                        <option value="TD" data-category="zone_2" data-name="Chad">Chad</option>
                        <option value="CL" data-category="zone_8" data-name="Chile">Chile</option>
                        <option value="CN" data-category="zone_7" data-name="China">China</option>
                        <option value="CO" data-category="zone_8" data-name="Colombia">Colombia</option>
                        <option value="KM" data-category="zone_5" data-name="Comoros">Comoros</option>
                        <option value="CG" data-category="zone_2" data-name="Congo">Congo</option>
                        <option value="CR" data-category="zone_8" data-name="Costa Rica">Costa Rica</option>
                        <option value="CI" data-category="zone_2" data-name="Cote D'Ivoire">Cote D'Ivoire</option>
                        <option value="HR" data-category="zone_4" data-name="Croatia">Croatia</option>
                        <option value="CU" data-category="zone_8" data-name="Cuba">Cuba</option>
                        <option value="CY" data-category="zone_4" data-name="Cyprus">Cyprus</option>
                        <option value="CZ" data-category="zone_4" data-name="Czech Republic">Czech Republic</option>
                        <option value="DK" data-category="zone_4" data-name="Denmark">Denmark</option>
                        <option value="DJ" data-category="zone_5" data-name="Djibouti">Djibouti</option>
                        <option value="DM" data-category="zone_8" data-name="Dominica">Dominica</option>
                        <option value="DO" data-category="zone_8" data-name="Dominican Republic">Dominican Republic</option>
                        <option value="TL" data-category="zone_7" data-name="East Timor">East Timor</option>
                        <option value="EC" data-category="zone_8" data-name="Ecuador">Ecuador</option>
                        <option value="EG" data-category="zone_5" data-name="Egypt">Egypt</option>
                        <option value="SV" data-category="zone_8" data-name="El Salvador">El Salvador</option>
                        <option value="GQ" data-category="zone_2" data-name="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="ER" data-category="zone_5" data-name="Eritrea">Eritrea</option>
                        <option value="EE" data-category="zone_4" data-name="Estonia">Estonia</option>
                        <option value="SZ" data-category="zone_5" data-name="Eswatini">Eswatini</option>
                        <option value="ET" data-category="zone_5" data-name="Ethiopia">Ethiopia</option>
                        <option value="FO" data-category="zone_4" data-name="Faroe Islands">Faroe Islands</option>
                        <option value="FJ" data-category="zone_8" data-name="Fiji">Fiji</option>
                        <option value="FI" data-category="zone_4" data-name="Finland">Finland</option>
                        <option value="FR" data-category="zone_4" data-name="France">France</option>
                        <option value="GF" data-category="zone_8" data-name="French Guyana">French Guyana</option>
                        <option value="PF" data-category="zone_8" data-name="French Polynesia">French Polynesia</option>
                        <option value="TF" data-category="zone_8" data-name="French Southern Territories">French Southern Territories</option>
                        <option value="GA" data-category="zone_2" data-name="Gabon">Gabon</option>
                        <option value="GM" data-category="zone_2" data-name="Gambia">Gambia</option>
                        <option value="GE" data-category="zone_7" data-name="Georgia">Georgia</option>
                        <option value="DE" data-category="zone_4" data-name="Germany">Germany</option>
                        <option value="GH" data-category="zone_2" data-name="Ghana">Ghana</option>
                        <option value="GI" data-category="zone_4" data-name="Gibraltar">Gibraltar</option>
                        <option value="GR" data-category="zone_4" data-name="Greece">Greece</option>
                        <option value="GL" data-category="zone_4" data-name="Greenland">Greenland</option>
                        <option value="GD" data-category="zone_8" data-name="Grenada">Grenada</option>
                        <option value="GU" data-category="zone_8" data-name="Guam">Guam</option>
                        <option value="GT" data-category="zone_8" data-name="Guatemala">Guatemala</option>
                        <option value="GG" data-category="zone_1" data-name="Guernsey">Guernsey</option>
                        <option value="GN" data-category="zone_2" data-name="Guinea">Guinea</option>
                        <option value="GW" data-category="zone_2" data-name="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="GY" data-category="zone_8" data-name="Guyana">Guyana</option>
                        <option value="HT" data-category="zone_8" data-name="Haiti">Haiti</option>
                        <option value="HN" data-category="zone_8" data-name="Honduras">Honduras</option>
                        <option value="HK" data-category="zone_7" data-name="Hong Kong">Hong Kong</option>
                        <option value="HU" data-category="zone_4" data-name="Hungary">Hungary</option>
                        <option value="IS" data-category="zone_4" data-name="Iceland">Iceland</option>
                        <option value="IN" data-category="zone_7" data-name="India">India</option>
                        <option value="ID" data-category="zone_7" data-name="Indonesia">Indonesia</option>
                        <option value="IR" data-category="zone_6" data-name="Iran">Iran</option>
                        <option value="IQ" data-category="zone_6" data-name="Iraq">Iraq</option>
                        <option value="IE" data-category="zone_1" data-name="Ireland">Ireland</option>
                        <option value="IM" data-category="zone_8" data-name="Isle of Man">Isle of Man</option>
                        <option value="IL" data-category="zone_6" data-name="Israel">Israel</option>
                        <option value="IT" data-category="zone_4" data-name="Italy">Italy</option>
                        <option value="JM" data-category="zone_8" data-name="Jamaica">Jamaica</option>
                        <option value="JP" data-category="zone_7" data-name="Japan">Japan</option>
                        <option value="JE" data-category="zone_1" data-name="Jersey">Jersey</option>
                        <option value="JO" data-category="zone_6" data-name="Jordan">Jordan</option>
                        <option value="KZ" data-category="zone_7" data-name="Kazakhstan">Kazakhstan</option>
                        <option value="KE" data-category="zone_5" data-name="Kenya">Kenya</option>
                        <option value="KI" data-category="zone_8" data-name="Kiribati">Kiribati</option>
                        <option value="KP" data-category="zone_7" data-name="North Korea">North Korea</option>
                        <option value="KR" data-category="zone_7" data-name="South Korea">South Korea</option>
                        <option value="KW" data-category="zone_6" data-name="Kuwait">Kuwait</option>
                        <option value="KG" data-category="zone_7" data-name="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="LA" data-category="zone_7" data-name="Laos">Laos</option>
                        <option value="LV" data-category="zone_4" data-name="Latvia">Latvia</option>
                        <option value="LB" data-category="zone_6" data-name="Lebanon">Lebanon</option>
                        <option value="LS" data-category="zone_5" data-name="Lesotho">Lesotho</option>
                        <option value="LR" data-category="zone_2" data-name="Liberia">Liberia</option>
                        <option value="LY" data-category="zone_5" data-name="Libya">Libya</option>
                        <option value="LI" data-category="zone_4" data-name="Liechtenstein">Liechtenstein</option>
                        <option value="LT" data-category="zone_4" data-name="Lithuania">Lithuania</option>
                        <option value="LU" data-category="zone_4" data-name="Luxembourg">Luxembourg</option>
                        <option value="MO" data-category="zone_7" data-name="Macau">Macau</option>
                        <option value="MK" data-category="zone_4" data-name="North Macedonia">North Macedonia</option>
                        <option value="MG" data-category="zone_5" data-name="Madagascar">Madagascar</option>
                        <option value="MW" data-category="zone_5" data-name="Malawi">Malawi</option>
                        <option value="MY" data-category="zone_7" data-name="Malaysia">Malaysia</option>
                        <option value="MV" data-category="zone_7" data-name="Maldives">Maldives</option>
                        <option value="ML" data-category="zone_2" data-name="Mali">Mali</option>
                        <option value="MT" data-category="zone_4" data-name="Malta">Malta</option>
                        <option value="MH" data-category="zone_8" data-name="Marshall Islands">Marshall Islands</option>
                        <option value="MQ" data-category="zone_8" data-name="Martinique">Martinique</option>
                        <option value="MR" data-category="zone_5" data-name="Mauritania">Mauritania</option>
                        <option value="MU" data-category="zone_5" data-name="Mauritius">Mauritius</option>
                        <option value="YT" data-category="zone_8" data-name="Mayotte">Mayotte</option>
                        <option value="MX" data-category="zone_8" data-name="Mexico">Mexico</option>
                        <option value="FM" data-category="zone_8" data-name="Micronesia">Micronesia</option>
                        <option value="MD" data-category="zone_4" data-name="Moldova">Moldova</option>
                        <option value="MC" data-category="zone_4" data-name="Monaco">Monaco</option>
                        <option value="MN" data-category="zone_7" data-name="Mongolia">Mongolia</option>
                        <option value="ME" data-category="zone_4" data-name="Montenegro">Montenegro</option>
                        <option value="MS" data-category="zone_8" data-name="Montserrat">Montserrat</option>
                        <option value="MA" data-category="zone_5" data-name="Morocco">Morocco</option>
                        <option value="MZ" data-category="zone_5" data-name="Mozambique">Mozambique</option>
                        <option value="MM" data-category="zone_7" data-name="Myanmar">Myanmar</option>
                        <option value="NA" data-category="zone_5" data-name="Namibia">Namibia</option>
                        <option value="NR" data-category="zone_8" data-name="Nauru">Nauru</option>
                        <option value="NP" data-category="zone_7" data-name="Nepal">Nepal</option>
                        <option value="NL" data-category="zone_4" data-name="Netherlands">Netherlands</option>
                        <option value="NC" data-category="zone_8" data-name="New Caledonia">New Caledonia</option>
                        <option value="NZ" data-category="zone_8" data-name="New Zealand">New Zealand</option>
                        <option value="NI" data-category="zone_8" data-name="Nicaragua">Nicaragua</option>
                        <option value="NE" data-category="zone_2" data-name="Niger">Niger</option>
                        <option value="NG" data-category="zone_2" data-name="Nigeria">Nigeria</option>
                        <option value="NU" data-category="zone_8" data-name="Niue">Niue</option>
                        <option value="NF" data-category="zone_8" data-name="Norfolk Island">Norfolk Island</option>
                        <option value="MP" data-category="zone_8" data-name="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="NO" data-category="zone_4" data-name="Norway">Norway</option>
                        <option value="OM" data-category="zone_6" data-name="Oman">Oman</option>
                        <option value="PK" data-category="zone_7" data-name="Pakistan">Pakistan</option>
                        <option value="PW" data-category="zone_8" data-name="Palau">Palau</option>
                        <option value="PA" data-category="zone_8" data-name="Panama">Panama</option>
                        <option value="PG" data-category="zone_5" data-name="Papua New Guinea">Papua New Guinea</option>
                        <option value="PY" data-category="zone_8" data-name="Paraguay">Paraguay</option>
                        <option value="PE" data-category="zone_8" data-name="Peru">Peru</option>
                        <option value="PH" data-category="zone_7" data-name="Philippines">Philippines</option>
                        <option value="PN" data-category="zone_8" data-name="Pitcairn Islands">Pitcairn Islands</option>
                        <option value="PL" data-category="zone_4" data-name="Poland">Poland</option>
                        <option value="PT" data-category="zone_4" data-name="Portugal">Portugal</option>
                        <option value="PR" data-category="zone_8" data-name="Puerto Rico">Puerto Rico</option>
                        <option value="QA" data-category="zone_6" data-name="Qatar">Qatar</option>
                        <option value="RE" data-category="zone_8" data-name="Reunion">Reunion</option>
                        <option value="RO" data-category="zone_4" data-name="Romania">Romania</option>
                        <option value="RU" data-category="zone_7" data-name="Russia">Russia</option>
                        <option value="RW" data-category="zone_5" data-name="Rwanda">Rwanda</option>
                        <option value="SH" data-category="zone_8" data-name="Saint Helena">Saint Helena</option>
                        <option value="KN" data-category="zone_8" data-name="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="LC" data-category="zone_8" data-name="Saint Lucia">Saint Lucia</option>
                        <option value="MF" data-category="zone_4" data-name="Saint Martin">Saint Martin</option>
                        <option value="PM" data-category="zone_8" data-name="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="VC" data-category="zone_8" data-name="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                        <option value="WS" data-category="zone_8" data-name="Samoa">Samoa</option>
                        <option value="SM" data-category="zone_4" data-name="San Marino">San Marino</option>
                        <option value="ST" data-category="zone_8" data-name="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="SA" data-category="zone_6" data-name="Saudi Arabia">Saudi Arabia</option>
                        <option value="SN" data-category="zone_2" data-name="Senegal">Senegal</option>
                        <option value="RS" data-category="zone_4" data-name="Serbia">Serbia</option>
                        <option value="SC" data-category="zone_5" data-name="Seychelles">Seychelles</option>
                        <option value="SL" data-category="zone_5" data-name="Sierra Leone">Sierra Leone</option>
                        <option value="SG" data-category="zone_7" data-name="Singapore">Singapore</option>
                        <option value="SX" data-category="zone_8" data-name="Sint Maarten">Sint Maarten</option>
                        <option value="SK" data-category="zone_4" data-name="Slovakia">Slovakia</option>
                        <option value="SI" data-category="zone_4" data-name="Slovenia">Slovenia</option>
                        <option value="SB" data-category="zone_5" data-name="Solomon Islands">Solomon Islands</option>
                        <option value="SO" data-category="zone_5" data-name="Somalia">Somalia</option>
                        <option value="ZA" data-category="zone_5" data-name="South Africa">South Africa</option>
                        <option value="SS" data-category="zone_5" data-name="South Sudan">South Sudan</option>
                        <option value="ES" data-category="zone_4" data-name="Spain">Spain</option>
                        <option value="LK" data-category="zone_7" data-name="Sri Lanka">Sri Lanka</option>
                        <option value="SD" data-category="zone_5" data-name="Sudan">Sudan</option>
                        <option value="SR" data-category="zone_5" data-name="Suriname">Suriname</option>
                        <option value="SJ" data-category="zone_8" data-name="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="SE" data-category="zone_4" data-name="Sweden">Sweden</option>
                        <option value="CH" data-category="zone_4" data-name="Switzerland">Switzerland</option>
                        <option value="SY" data-category="zone_6" data-name="Syria">Syria</option>
                        <option value="TW" data-category="zone_7" data-name="Taiwan">Taiwan</option>
                        <option value="TJ" data-category="zone_7" data-name="Tajikistan">Tajikistan</option>
                        <option value="TZ" data-category="zone_5" data-name="Tanzania">Tanzania</option>
                        <option value="TH" data-category="zone_7" data-name="Thailand">Thailand</option>
                        <option value="TG" data-category="zone_2" data-name="Togo">Togo</option>
                        <option value="TK" data-category="zone_8" data-name="Tokelau">Tokelau</option>
                        <option value="TO" data-category="zone_8" data-name="Tonga">Tonga</option>
                        <option value="TT" data-category="zone_8" data-name="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="TN" data-category="zone_5" data-name="Tunisia">Tunisia</option>
                        <option value="TR" data-category="zone_7" data-name="Turkey">Turkey</option>
                        <option value="TM" data-category="zone_7" data-name="Turkmenistan">Turkmenistan</option>
                        <option value="TC" data-category="zone_8" data-name="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="TV" data-category="zone_8" data-name="Tuvalu">Tuvalu</option>
                        <option value="UG" data-category="zone_5" data-name="Uganda">Uganda</option>
                        <option value="UA" data-category="zone_7" data-name="Ukraine">Ukraine</option>
                        <option value="AE" data-category="zone_6" data-name="United Arab Emirates">United Arab Emirates</option>
                        <option value="GB" data-category="zone_1" data-name="United Kingdom">United Kingdom</option>
                        <option value="US" data-category="zone_3" data-name="United States">United States</option>
                        <option value="UY" data-category="zone_8" data-name="Uruguay">Uruguay</option>
                        <option value="VI" data-category="zone_8" data-name="US Virgin Islands">US Virgin Islands</option>
                        <option value="UZ" data-category="zone_7" data-name="Uzbekistan">Uzbekistan</option>
                        <option value="VU" data-category="zone_8" data-name="Vanuatu">Vanuatu</option>
                        <option value="VA" data-category="zone_4" data-name="Vatican City">Vatican City</option>
                        <option value="VE" data-category="zone_8" data-name="Venezuela">Venezuela</option>
                        <option value="VN" data-category="zone_7" data-name="Vietnam">Vietnam</option>
                        <option value="WF" data-category="zone_8" data-name="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="EH" data-category="zone_8" data-name="Western Sahara">Western Sahara</option>
                        <option value="YE" data-category="zone_6" data-name="Yemen">Yemen</option>
                        <option value="ZM" data-category="zone_5" data-name="Zambia">Zambia</option>
                        <option value="ZW" data-category="zone_5" data-name="Zimbabwe">Zimbabwe</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Full Name<sup>*</sup></label>
                      <input type="text" class="form-control" name="fullname" id="fullname" required="required" oninput="updateParagraph()"/>
                      <span class="error1 " style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span> 
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Phone Number<sup>*</sup></label>
                      <div class="input-group mb-3">
                          <select class="form-control" id="country_code" name="country_code" style="max-width: 60px; height: 40px;">
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
                              <option value="+234">+234 (Nigeria)</option>
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
                        <input type="text" class="form-control" name="phone_no" id="phone_no" required="required" oninput="updateParagraph()"/>
                        <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle  text-danger"></i> </span> 
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>E-mail <sup>*</sup></label>
                      <input type="email" class="form-control" name="email" id="email" required="required" oninput="updateParagraph()"/>
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle  text-danger"></i> </span> 
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-12 col-lg-4">
                    <div class="checkbox">
                      <input type="checkbox" name="remember" id="send-update" class="css-checkbox" />
                      <label for="send-update" class="css-label">Send updates on this shipment</label>
                    </div>
                  </div>
                </div>
                            
              </div>
              <input type="button" name="next" class="next action-button" value="Continue" />
              <input type="reset" name="cancel" class="action-button btn-blue" value="Cancel Shipment" />
            </fieldset>
            <!-- fieldsets Shipping From end--> 
            
            <!-- fieldsets Shipping going Start-->
            <fieldset>
              <h2 class="fs-title">Where are you shipping to? </h2>
              
              <h3 class="fs-subtitle">* Indicates required field </h3>
              <div class="shipping-form">
                <div class="row">
                  <div class="col-12 col-lg-9">
                    <div class="form-group">
                      <label>Address<sup>*</sup></label>
                      <input type="text" id="autocomplete2" class="form-control" name="address2" required="required" placeholder="Street Address" oninput="updateParagraph()" onfocus="initAutocomplete2()" />                    
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Zip Code<sup>*</sup></label>
                      <input type="text" id="postalcode2" class="form-control" name="postalcode2" required="required" placeholder="Postal Code" />
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                    </div>
                  </div>
                  <input type="hidden" id="sCountry1" name="sCountry" value="" readonly>
                  <input type="hidden" id="rCountry1" name="rCountry" value="" readonly>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-3">
                    <label>Country<sup>*</sup></label>
                    <select id="countrySelect" name="country1" class="form-control" required="required" onchange="calculatePrice(); updateParagraph();">
                      <option value="AF" data-category="zone_6" data-name="Afghanistan">Afghanistan</option>
                      <option value="AL" data-category="zone_4" data-name="Albania">Albania</option>
                      <option value="DZ" data-category="zone_5" data-name="Algeria">Algeria</option>
                      <option value="AS" data-category="zone_8" data-name="American Samoa">American Samoa</option>
                      <option value="AD" data-category="zone_4" data-name="Andorra">Andorra</option>
                      <option value="AO" data-category="zone_5" data-name="Angola">Angola</option>
                      <option value="AI" data-category="zone_8" data-name="Anguilla">Anguilla</option>
                      <option value="AG" data-category="zone_8" data-name="Antigua">Antigua</option>
                      <option value="AR" data-category="zone_8" data-name="Argentina">Argentina</option>
                      <option value="AM" data-category="zone_7" data-name="Armenia">Armenia</option>
                      <option value="AW" data-category="zone_8" data-name="Aruba">Aruba</option>
                      <option value="AU" data-category="zone_7" data-name="Australia">Australia</option>
                      <option value="AT" data-category="zone_4" data-name="Austria">Austria</option>
                      <option value="AZ" data-category="zone_7" data-name="Azerbaijan">Azerbaijan</option>
                      <option value="BS" data-category="zone_8" data-name="Bahamas">Bahamas</option>
                      <option value="BH" data-category="zone_6" data-name="Bahrain">Bahrain</option>
                      <option value="BD" data-category="zone_7" data-name="Bangladesh">Bangladesh</option>
                      <option value="BB" data-category="zone_8" data-name="Barbados">Barbados</option>
                      <option value="BY" data-category="zone_4" data-name="Belarus">Belarus</option>
                      <option value="BE" data-category="zone_4" data-name="Belgium">Belgium</option>
                      <option value="BZ" data-category="zone_8" data-name="Belize">Belize</option>
                      <option value="BJ" data-category="zone_2" data-name="Benin">Benin</option>
                      <option value="BM" data-category="zone_8" data-name="Bermuda">Bermuda</option>
                      <option value="BT" data-category="zone_7" data-name="Bhutan">Bhutan</option>
                      <option value="BO" data-category="zone_8" data-name="Bolivia">Bolivia</option>
                      <option value="BA" data-category="zone_4" data-name="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                      <option value="BW" data-category="zone_5" data-name="Botswana">Botswana</option>
                      <option value="BR" data-category="zone_8" data-name="Brazil">Brazil</option>
                      <option value="IO" data-category="zone_8" data-name="British Indian Ocean Territory">British Indian Ocean Territory</option>
                      <option value="VG" data-category="zone_8" data-name="British Virgin Islands">British Virgin Islands</option>
                      <option value="BN" data-category="zone_7" data-name="Brunei">Brunei</option>
                      <option value="BG" data-category="zone_4" data-name="Bulgaria">Bulgaria</option>
                      <option value="BF" data-category="zone_2" data-name="Burkina Faso">Burkina Faso</option>
                      <option value="BI" data-category="zone_5" data-name="Burundi">Burundi</option>
                      <option value="KH" data-category="zone_7" data-name="Cambodia">Cambodia</option>
                      <option value="CM" data-category="zone_2" data-name="Cameroon">Cameroon</option>
                      <option value="CA" data-category="zone_3" data-name="Canada">Canada</option>
                      <option value="KY" data-category="zone_8" data-name="Cayman Islands">Cayman Islands</option>
                      <option value="CF" data-category="zone_2" data-name="Central African Republic">Central African Republic</option>
                      <option value="TD" data-category="zone_2" data-name="Chad">Chad</option>
                      <option value="CL" data-category="zone_8" data-name="Chile">Chile</option>
                      <option value="CN" data-category="zone_7" data-name="China">China</option>
                      <option value="CO" data-category="zone_8" data-name="Colombia">Colombia</option>
                      <option value="KM" data-category="zone_5" data-name="Comoros">Comoros</option>
                      <option value="CG" data-category="zone_2" data-name="Congo">Congo</option>
                      <option value="CR" data-category="zone_8" data-name="Costa Rica">Costa Rica</option>
                      <option value="CI" data-category="zone_2" data-name="Cote D'Ivoire">Cote D'Ivoire</option>
                      <option value="HR" data-category="zone_4" data-name="Croatia">Croatia</option>
                      <option value="CU" data-category="zone_8" data-name="Cuba">Cuba</option>
                      <option value="CY" data-category="zone_4" data-name="Cyprus">Cyprus</option>
                      <option value="CZ" data-category="zone_4" data-name="Czech Republic">Czech Republic</option>
                      <option value="DK" data-category="zone_4" data-name="Denmark">Denmark</option>
                      <option value="DJ" data-category="zone_5" data-name="Djibouti">Djibouti</option>
                      <option value="DM" data-category="zone_8" data-name="Dominica">Dominica</option>
                      <option value="DO" data-category="zone_8" data-name="Dominican Republic">Dominican Republic</option>
                      <option value="TL" data-category="zone_7" data-name="East Timor">East Timor</option>
                      <option value="EC" data-category="zone_8" data-name="Ecuador">Ecuador</option>
                      <option value="EG" data-category="zone_5" data-name="Egypt">Egypt</option>
                      <option value="SV" data-category="zone_8" data-name="El Salvador">El Salvador</option>
                      <option value="GQ" data-category="zone_2" data-name="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="ER" data-category="zone_5" data-name="Eritrea">Eritrea</option>
                      <option value="EE" data-category="zone_4" data-name="Estonia">Estonia</option>
                      <option value="SZ" data-category="zone_5" data-name="Eswatini">Eswatini</option>
                      <option value="ET" data-category="zone_5" data-name="Ethiopia">Ethiopia</option>
                      <option value="FO" data-category="zone_4" data-name="Faroe Islands">Faroe Islands</option>
                      <option value="FJ" data-category="zone_8" data-name="Fiji">Fiji</option>
                      <option value="FI" data-category="zone_4" data-name="Finland">Finland</option>
                      <option value="FR" data-category="zone_4" data-name="France">France</option>
                      <option value="GF" data-category="zone_8" data-name="French Guyana">French Guyana</option>
                      <option value="PF" data-category="zone_8" data-name="French Polynesia">French Polynesia</option>
                      <option value="TF" data-category="zone_8" data-name="French Southern Territories">French Southern Territories</option>
                      <option value="GA" data-category="zone_2" data-name="Gabon">Gabon</option>
                      <option value="GM" data-category="zone_2" data-name="Gambia">Gambia</option>
                      <option value="GE" data-category="zone_7" data-name="Georgia">Georgia</option>
                      <option value="DE" data-category="zone_4" data-name="Germany">Germany</option>
                      <option value="GH" data-category="zone_2" data-name="Ghana">Ghana</option>
                      <option value="GI" data-category="zone_4" data-name="Gibraltar">Gibraltar</option>
                      <option value="GR" data-category="zone_4" data-name="Greece">Greece</option>
                      <option value="GL" data-category="zone_4" data-name="Greenland">Greenland</option>
                      <option value="GD" data-category="zone_8" data-name="Grenada">Grenada</option>
                      <option value="GU" data-category="zone_8" data-name="Guam">Guam</option>
                      <option value="GT" data-category="zone_8" data-name="Guatemala">Guatemala</option>
                      <option value="GG" data-category="zone_1" data-name="Guernsey">Guernsey</option>
                      <option value="GN" data-category="zone_2" data-name="Guinea">Guinea</option>
                      <option value="GW" data-category="zone_2" data-name="Guinea-Bissau">Guinea-Bissau</option>
                      <option value="GY" data-category="zone_8" data-name="Guyana">Guyana</option>
                      <option value="HT" data-category="zone_8" data-name="Haiti">Haiti</option>
                      <option value="HN" data-category="zone_8" data-name="Honduras">Honduras</option>
                      <option value="HK" data-category="zone_7" data-name="Hong Kong">Hong Kong</option>
                      <option value="HU" data-category="zone_4" data-name="Hungary">Hungary</option>
                      <option value="IS" data-category="zone_4" data-name="Iceland">Iceland</option>
                      <option value="IN" data-category="zone_7" data-name="India">India</option>
                      <option value="ID" data-category="zone_7" data-name="Indonesia">Indonesia</option>
                      <option value="IR" data-category="zone_6" data-name="Iran">Iran</option>
                      <option value="IQ" data-category="zone_6" data-name="Iraq">Iraq</option>
                      <option value="IE" data-category="zone_1" data-name="Ireland">Ireland</option>
                      <option value="IM" data-category="zone_8" data-name="Isle of Man">Isle of Man</option>
                      <option value="IL" data-category="zone_6" data-name="Israel">Israel</option>
                      <option value="IT" data-category="zone_4" data-name="Italy">Italy</option>
                      <option value="JM" data-category="zone_8" data-name="Jamaica">Jamaica</option>
                      <option value="JP" data-category="zone_7" data-name="Japan">Japan</option>
                      <option value="JE" data-category="zone_1" data-name="Jersey">Jersey</option>
                      <option value="JO" data-category="zone_6" data-name="Jordan">Jordan</option>
                      <option value="KZ" data-category="zone_7" data-name="Kazakhstan">Kazakhstan</option>
                      <option value="KE" data-category="zone_5" data-name="Kenya">Kenya</option>
                      <option value="KI" data-category="zone_8" data-name="Kiribati">Kiribati</option>
                      <option value="KP" data-category="zone_7" data-name="North Korea">North Korea</option>
                      <option value="KR" data-category="zone_7" data-name="South Korea">South Korea</option>
                      <option value="KW" data-category="zone_6" data-name="Kuwait">Kuwait</option>
                      <option value="KG" data-category="zone_7" data-name="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="LA" data-category="zone_7" data-name="Laos">Laos</option>
                      <option value="LV" data-category="zone_4" data-name="Latvia">Latvia</option>
                      <option value="LB" data-category="zone_6" data-name="Lebanon">Lebanon</option>
                      <option value="LS" data-category="zone_5" data-name="Lesotho">Lesotho</option>
                      <option value="LR" data-category="zone_2" data-name="Liberia">Liberia</option>
                      <option value="LY" data-category="zone_5" data-name="Libya">Libya</option>
                      <option value="LI" data-category="zone_4" data-name="Liechtenstein">Liechtenstein</option>
                      <option value="LT" data-category="zone_4" data-name="Lithuania">Lithuania</option>
                      <option value="LU" data-category="zone_4" data-name="Luxembourg">Luxembourg</option>
                      <option value="MO" data-category="zone_7" data-name="Macau">Macau</option>
                      <option value="MK" data-category="zone_4" data-name="North Macedonia">North Macedonia</option>
                      <option value="MG" data-category="zone_5" data-name="Madagascar">Madagascar</option>
                      <option value="MW" data-category="zone_5" data-name="Malawi">Malawi</option>
                      <option value="MY" data-category="zone_7" data-name="Malaysia">Malaysia</option>
                      <option value="MV" data-category="zone_7" data-name="Maldives">Maldives</option>
                      <option value="ML" data-category="zone_2" data-name="Mali">Mali</option>
                      <option value="MT" data-category="zone_4" data-name="Malta">Malta</option>
                      <option value="MH" data-category="zone_8" data-name="Marshall Islands">Marshall Islands</option>
                      <option value="MQ" data-category="zone_8" data-name="Martinique">Martinique</option>
                      <option value="MR" data-category="zone_5" data-name="Mauritania">Mauritania</option>
                      <option value="MU" data-category="zone_5" data-name="Mauritius">Mauritius</option>
                      <option value="YT" data-category="zone_8" data-name="Mayotte">Mayotte</option>
                      <option value="MX" data-category="zone_8" data-name="Mexico">Mexico</option>
                      <option value="FM" data-category="zone_8" data-name="Micronesia">Micronesia</option>
                      <option value="MD" data-category="zone_4" data-name="Moldova">Moldova</option>
                      <option value="MC" data-category="zone_4" data-name="Monaco">Monaco</option>
                      <option value="MN" data-category="zone_7" data-name="Mongolia">Mongolia</option>
                      <option value="ME" data-category="zone_4" data-name="Montenegro">Montenegro</option>
                      <option value="MS" data-category="zone_8" data-name="Montserrat">Montserrat</option>
                      <option value="MA" data-category="zone_5" data-name="Morocco">Morocco</option>
                      <option value="MZ" data-category="zone_5" data-name="Mozambique">Mozambique</option>
                      <option value="MM" data-category="zone_7" data-name="Myanmar">Myanmar</option>
                      <option value="NA" data-category="zone_5" data-name="Namibia">Namibia</option>
                      <option value="NR" data-category="zone_8" data-name="Nauru">Nauru</option>
                      <option value="NP" data-category="zone_7" data-name="Nepal">Nepal</option>
                      <option value="NL" data-category="zone_4" data-name="Netherlands">Netherlands</option>
                      <option value="NC" data-category="zone_8" data-name="New Caledonia">New Caledonia</option>
                      <option value="NZ" data-category="zone_8" data-name="New Zealand">New Zealand</option>
                      <option value="NI" data-category="zone_8" data-name="Nicaragua">Nicaragua</option>
                      <option value="NE" data-category="zone_2" data-name="Niger">Niger</option>
                      <option value="NG" data-category="zone_2" data-name="Nigeria">Nigeria</option>
                      <option value="NU" data-category="zone_8" data-name="Niue">Niue</option>
                      <option value="NF" data-category="zone_8" data-name="Norfolk Island">Norfolk Island</option>
                      <option value="MP" data-category="zone_8" data-name="Northern Mariana Islands">Northern Mariana Islands</option>
                      <option value="NO" data-category="zone_4" data-name="Norway">Norway</option>
                      <option value="OM" data-category="zone_6" data-name="Oman">Oman</option>
                      <option value="PK" data-category="zone_7" data-name="Pakistan">Pakistan</option>
                      <option value="PW" data-category="zone_8" data-name="Palau">Palau</option>
                      <option value="PA" data-category="zone_8" data-name="Panama">Panama</option>
                      <option value="PG" data-category="zone_5" data-name="Papua New Guinea">Papua New Guinea</option>
                      <option value="PY" data-category="zone_8" data-name="Paraguay">Paraguay</option>
                      <option value="PE" data-category="zone_8" data-name="Peru">Peru</option>
                      <option value="PH" data-category="zone_7" data-name="Philippines">Philippines</option>
                      <option value="PN" data-category="zone_8" data-name="Pitcairn Islands">Pitcairn Islands</option>
                      <option value="PL" data-category="zone_4" data-name="Poland">Poland</option>
                      <option value="PT" data-category="zone_4" data-name="Portugal">Portugal</option>
                      <option value="PR" data-category="zone_8" data-name="Puerto Rico">Puerto Rico</option>
                      <option value="QA" data-category="zone_6" data-name="Qatar">Qatar</option>
                      <option value="RE" data-category="zone_8" data-name="Reunion">Reunion</option>
                      <option value="RO" data-category="zone_4" data-name="Romania">Romania</option>
                      <option value="RU" data-category="zone_7" data-name="Russia">Russia</option>
                      <option value="RW" data-category="zone_5" data-name="Rwanda">Rwanda</option>
                      <option value="SH" data-category="zone_8" data-name="Saint Helena">Saint Helena</option>
                      <option value="KN" data-category="zone_8" data-name="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                      <option value="LC" data-category="zone_8" data-name="Saint Lucia">Saint Lucia</option>
                      <option value="MF" data-category="zone_4" data-name="Saint Martin">Saint Martin</option>
                      <option value="PM" data-category="zone_8" data-name="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                      <option value="VC" data-category="zone_8" data-name="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                      <option value="WS" data-category="zone_8" data-name="Samoa">Samoa</option>
                      <option value="SM" data-category="zone_4" data-name="San Marino">San Marino</option>
                      <option value="ST" data-category="zone_8" data-name="Sao Tome and Principe">Sao Tome and Principe</option>
                      <option value="SA" data-category="zone_6" data-name="Saudi Arabia">Saudi Arabia</option>
                      <option value="SN" data-category="zone_2" data-name="Senegal">Senegal</option>
                      <option value="RS" data-category="zone_4" data-name="Serbia">Serbia</option>
                      <option value="SC" data-category="zone_5" data-name="Seychelles">Seychelles</option>
                      <option value="SL" data-category="zone_5" data-name="Sierra Leone">Sierra Leone</option>
                      <option value="SG" data-category="zone_7" data-name="Singapore">Singapore</option>
                      <option value="SX" data-category="zone_8" data-name="Sint Maarten">Sint Maarten</option>
                      <option value="SK" data-category="zone_4" data-name="Slovakia">Slovakia</option>
                      <option value="SI" data-category="zone_4" data-name="Slovenia">Slovenia</option>
                      <option value="SB" data-category="zone_5" data-name="Solomon Islands">Solomon Islands</option>
                      <option value="SO" data-category="zone_5" data-name="Somalia">Somalia</option>
                      <option value="ZA" data-category="zone_5" data-name="South Africa">South Africa</option>
                      <option value="SS" data-category="zone_5" data-name="South Sudan">South Sudan</option>
                      <option value="ES" data-category="zone_4" data-name="Spain">Spain</option>
                      <option value="LK" data-category="zone_7" data-name="Sri Lanka">Sri Lanka</option>
                      <option value="SD" data-category="zone_5" data-name="Sudan">Sudan</option>
                      <option value="SR" data-category="zone_5" data-name="Suriname">Suriname</option>
                      <option value="SJ" data-category="zone_8" data-name="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                      <option value="SE" data-category="zone_4" data-name="Sweden">Sweden</option>
                      <option value="CH" data-category="zone_4" data-name="Switzerland">Switzerland</option>
                      <option value="SY" data-category="zone_6" data-name="Syria">Syria</option>
                      <option value="TW" data-category="zone_7" data-name="Taiwan">Taiwan</option>
                      <option value="TJ" data-category="zone_7" data-name="Tajikistan">Tajikistan</option>
                      <option value="TZ" data-category="zone_5" data-name="Tanzania">Tanzania</option>
                      <option value="TH" data-category="zone_7" data-name="Thailand">Thailand</option>
                      <option value="TG" data-category="zone_2" data-name="Togo">Togo</option>
                      <option value="TK" data-category="zone_8" data-name="Tokelau">Tokelau</option>
                      <option value="TO" data-category="zone_8" data-name="Tonga">Tonga</option>
                      <option value="TT" data-category="zone_8" data-name="Trinidad and Tobago">Trinidad and Tobago</option>
                      <option value="TN" data-category="zone_5" data-name="Tunisia">Tunisia</option>
                      <option value="TR" data-category="zone_7" data-name="Turkey">Turkey</option>
                      <option value="TM" data-category="zone_7" data-name="Turkmenistan">Turkmenistan</option>
                      <option value="TC" data-category="zone_8" data-name="Turks and Caicos Islands">Turks and Caicos Islands</option>
                      <option value="TV" data-category="zone_8" data-name="Tuvalu">Tuvalu</option>
                      <option value="UG" data-category="zone_5" data-name="Uganda">Uganda</option>
                      <option value="UA" data-category="zone_7" data-name="Ukraine">Ukraine</option>
                      <option value="AE" data-category="zone_6" data-name="United Arab Emirates">United Arab Emirates</option>
                      <option value="GB" data-category="zone_1" data-name="United Kingdom">United Kingdom</option>
                      <option value="US" data-category="zone_3" data-name="United States">United States</option>
                      <option value="UY" data-category="zone_8" data-name="Uruguay">Uruguay</option>
                      <option value="VI" data-category="zone_8" data-name="US Virgin Islands">US Virgin Islands</option>
                      <option value="UZ" data-category="zone_7" data-name="Uzbekistan">Uzbekistan</option>
                      <option value="VU" data-category="zone_8" data-name="Vanuatu">Vanuatu</option>
                      <option value="VA" data-category="zone_4" data-name="Vatican City">Vatican City</option>
                      <option value="VE" data-category="zone_8" data-name="Venezuela">Venezuela</option>
                      <option value="VN" data-category="zone_7" data-name="Vietnam">Vietnam</option>
                      <option value="WF" data-category="zone_8" data-name="Wallis and Futuna">Wallis and Futuna</option>
                      <option value="EH" data-category="zone_8" data-name="Western Sahara">Western Sahara</option>
                      <option value="YE" data-category="zone_6" data-name="Yemen">Yemen</option>
                      <option value="ZM" data-category="zone_5" data-name="Zambia">Zambia</option>
                      <option value="ZW" data-category="zone_5" data-name="Zimbabwe">Zimbabwe</option>
                    </select>
                    <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Full Name<sup>*</sup></label>
                      <input type="text" class="form-control" name="fullname2" id="fullname2" required="required" oninput="updateParagraph()"/>
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>Contact Number<sup>*</sup></label>
                      <div class="input-group mb-3">
                        <select class="form-control" id="country_code2" name="country_code2" style="max-width: 60px; height: 40px;">
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
                          <option value="+234">+234 (Nigeria)</option>
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
                        <input type="text" class="form-control" name="contact2" id="contact2" required="required" oninput="updateParagraph()"/>
                        <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label>E-mail <sup>*</sup></label>
                      <input type="email" class="form-control" name="email2" id="email2" required="required" oninput="updateParagraph()"/>
                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                    </div>
                  </div>
                </div>
                
                
              </div>
              <input type="button" name="previous" class="previous action-button" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Continue" />
              <input type="reset" name="cancel" class="action-button btn-blue" value="Cancel Shipment" />
            </fieldset>
            <!-- fieldsets Shipping going end--> 
            
            <!-- fieldsets package Start-->
            <fieldset>
              <h2 class="fs-title">What are you Sending? </h2>
              <h3 class="fs-subtitle">* Indicates required field </h3>
              <div class="shipping-form">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Shipment Type<sup>*</sup></label>
                                    <div class="input-comment">
                                      <select name="shipment_type" class="form-control" id="packageSelect" required="required" onchange="updateParagraph(), ">
                                          <option disabled selected value>Client Packaging</option>
                                          <option value="Document">Document</option>
                                          <option value="Package">Package</option>
                                      </select>
                                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="additionalFields" class="d-none">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Weight<sup>*</sup></label>
                                        <div class="input-comment">
                                          <select name="package_weight" class="form-control" id="package_weight" required="required" onchange="calculatePrice(); updateParagraph()">
                                            <option disabled selected value>Select Weight</option>
                                            <option value="0.5" data-category="weight_0_5">0.5kg</option>
                                            <option value="1" data-category="weight_1_0">1kg</option>
                                            <option value="1.5" data-category="weight_1_5">1.5kg</option>
                                            <option value="2" data-category="weight_2_0">2kg</option>
                                            <option value="2.5" data-category="weight_2_5">2.5kg</option>
                                            <option value="3" data-category="weight_3_0">3kg</option>
                                            <option value="3.5" data-category="weight_3_5">3.5kg</option>
                                            <option value="4" data-category="weight_4_0">4kg</option>
                                            <option value="4.5" data-category="weight_4_5">4.5kg</option>
                                            <option value="5" data-category="weight_5_0">5kg</option>
                                          </select>
                                            <span class="error1" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle text-danger"></i>
                                            </span>
                                            <span class="field-comment">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                  <div class="form-group">
                                      <label>Package Description</label>
                                      <div class="input-comment">
                                        <input type="text" class="form-control" name="pDescription" id="pDescription" required="required" onchange="updateParagraph()"/>
                                        <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                        
                                      </div>
                                  </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Length</label>
                                        <div class="input-comment">
                                            <input type="number" class="form-control" name="length" id="length" required="required" onchange="updateParagraph()"/>
                                            <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                            <span class="field-comment">in</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Width</label>
                                        <div class="input-comment">
                                            <input type="number" class="form-control" name="width" id="width" required="required" onchange="updateParagraph()"/>
                                            <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                            <span class="field-comment">in</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Height</label>
                                        <div class="input-comment">
                                            <input type="number" class="form-control" name="height" id="height" required="required" onchange="updateParagraph()"/>
                                            <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                            <span class="field-comment">in</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                  <div class="form-group">
                                      <label>Upload/Take a picture of your Package</label>
                                      <div class="input-comment">
                                          <input type="file" class="form-control" name="pPreview" required="required"/>
                                          <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>

                                      </div>
                                  </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Etimated Price</label>
                                    <div class="input-comment">
                                      <input type="text" class="form-control" name="price2" id="priceInput2" readonly onchange="updateParagraph()"/>
                                      <small class="text-danger"><b class="text-danger">Note: Price is Estimated, Until TravelWheel re-weigh.</b></small>
                                      
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div id="additionalFields1" class="d-none">
                          <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Describe your document<sup>*</sup></label>
                                    <div class="input-comment">
                                      <input type="text" class="form-control" name="typeOfDoc" id="typeOfDoc" required="required" placeholder="Passport, Company Documnent, Certificate, etc." onchange="updateParagraph()"/>
                                      
                                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Document Weight</label>
                                    <div class="input-comment">
                                      <select name="doc_weight" class="form-control" id="document_weight" required="required" onchange="calculatePrice(); updateParagraph();">
                                      <option disabled selected value>Select Weight</option>
                                            <option value="0.5" data-category="weight_0_5">0.5kg</option>
                                            <option value="1" data-category="weight_1_0">1kg</option>
                                            <option value="1.5" data-category="weight_1_5">1.5kg</option>
                                            <option value="2" data-category="weight_2_0">2kg</option>
                                            <option value="2.5" data-category="weight_2_5">2.5kg</option>
                                            <option value="3" data-category="weight_3_0">3kg</option>
                                            <option value="3.5" data-category="weight_3_5">3.5kg</option>
                                            <option value="4" data-category="weight_4_0">4kg</option>
                                            <option value="4.5" data-category="weight_4_5">4.5kg</option>
                                            <option value="5" data-category="weight_5_0">5kg</option>
                                      </select>
                                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                  
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Upload/Take a picture of your Document</label>
                                    <div class="input-comment">
                                      <input type="file" class="form-control" name="preview" required="required"/>
                                      <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Etimated Price</label>
                                    <div class="input-comment">
                                      <input type="text" class="form-control" name="price" id="priceInput" readonly onchange="updateParagraph()"/>
                                      <small class="text-danger"><b class="text-danger">Note: Price is Estimated, Until TravelWheel re-weigh.</b></small>
                                      
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-4">
                        <div class="what-package d-none" id="whatpackage"><img src="{{ asset('public/assets/ship/assets/images/package.jpg')}}" alt=""/></div>
                        <div class="what-package d-none" id="whatpackage1"><img src="{{ asset('public/assets/ship/assets/images/document.jpg')}}" alt=""/></div>
                    </div>
                    <script>
                      document.getElementById('packageSelect').addEventListener('change', function() {
                          const additionalFields = document.getElementById('additionalFields');
                          const additionalFields1 = document.getElementById('additionalFields1');
                          const whatpackage = document.getElementById('whatpackage');
                          const whatpackage1 = document.getElementById('whatpackage1');

                          if (this.value === 'Package') {
                              additionalFields.classList.remove('d-none');
                              additionalFields1.classList.add('d-none');
                              whatpackage.classList.remove('d-none');
                              whatpackage1.classList.add('d-none');
                          }
                          else if (this.value === 'Document') {  // Corrected 'else if'
                              additionalFields.classList.add('d-none');
                              additionalFields1.classList.remove('d-none');
                              whatpackage.classList.add('d-none');
                              whatpackage1.classList.remove('d-none');
                          }
                          else {
                              additionalFields.classList.add('d-none');
                              additionalFields.classList.add('d-none');
                              whatpackage.classList.add('d-none');
                              whatpackage1.classList.add('d-none');
                          }
                      });
                    </script>
                    

                </div>
              </div>
              <input type="button" name="previous" class="previous action-button" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Continue" />
              <input type="reset" name="cancel" class="action-button btn-blue" value="Cancel Shipment" />
            </fieldset>
            <!-- fieldsets package end--> 
            
            <!-- fieldsets pick up Start-->
            <fieldset>
              <h2 class="fs-title">Would you like us to pick up your shipment? </h2>
              <h3 class="fs-subtitle">* Indicates required field </h3>
              <div class="shipping-form dropoff-block">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" href="#no-drop" aria-controls="no-drop" role="tab" data-toggle="tab">No, I'll drop it off</a></li>
                  <li class="or-text">--or--</li>
                  <li class="nav-item"><a class="nav-link" href="#yes-drop" aria-controls="yes-drop" role="tab" data-toggle="tab">Yes, pick up my shipment</a></li>
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="no-drop">
                    <div class="row">
                      <div class="col-12 col-lg-4">
                        <div class="form-group">
                          <label>Dropoff date:</label>
                          <div class="datepicker-group">
                            <input type="date" class="form-control" name="dropoff_date" id="dropoff_date" required="required" placeholder="Date" onchange="updateParagraph()" />
                            <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                            <script>
                              // Clear the value on page load to prevent any default value
                              document.getElementById('dropoff_date').value = '';
                            </script>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-lg-5">
                        <h6>Drop-Off Information</h6>
                          <small class="d-block"><b>Address: <span> 74, Ayanguran Road, Ikorodu Garage, Ikorodu, Lagos.</span></b></small>
                          <small class="d-block"><b>Support No.: +2342018891759</b></small>
                          <small class="d-block"><b>Drop-Off Window: 9:00AM - 5:00PM </b></small>
                      </div>
                      
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="yes-drop">
                    <div class="row"> 
                        <div class="col-lg-5">
                          <div class="col-sm-12 ">
                            <div class="form-group">
                              <label>Pick-up Address</label>
                              <div class="input-comment">
                                <input type="text" id="autocomplete1_full" name="pick_upAddress" class="form-control"/>

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <label>Nearest Bus-Stop</label>
                            <div id="area-autocomplete-container">
                              <input type="text" id="area-input" name="nBus_stop" placeholder="Enter an Area" required="required" onfocus="updateDPrice()"/>
                              <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                              
                              <div id="area-suggestions"></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Pickup date:</label>
                              <div class="datepicker-group">
                                <input type="date" class="form-control " name="pick_upDate" id="pickUpDate" placeholder="Date" required="required" onchange="updateParagraph()" autocomplete="off"/>
                                <span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle text-danger"></i> </span>
                                
                                <script>
                                  // Clear the value on page load to prevent any default value
                                  document.getElementById('pickUpDate').value = '';
                                </script>
                              </div>
                            </div>
                          </div>
                        
                        
                      </div>
                      <div class="col-lg-6 p-4">
                        <h6 id="deliveryPrice"></h6> 
                        <small class="d-block">Pickup window: 9:00AM - 4:00PM</small>
                        <small class="d-block">Pickup location: Front Door</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <input type="button" name="previous" class="previous action-button" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Continue" />
              <input type="reset" name="cancel" class="action-button btn-blue" value="Cancel Shipment" />
            </fieldset>
            <!-- fieldsets pick up end--> 

            <!-- fieldsets payment Start-->
            <fieldset>
              <h2 class="fs-title">Please re-confirm your details.</h2>
              <div class="shipping-form">
                <div class="review">
                    <h3><b>Ship from </b><a href="" title="Edit" class="btn-edit"></a></h3>
                    <ul>
                      <li><span id="senderName"></span></li>
                      <li><span id="shipFrom"> </span></li>
                      <li><span id="senderPhone"> </span></li>
                      <li><span id="senderEmail"> </span></li>
                      <li><span id="senderCountry"> </span></li>
                      <li><span id="postalCodeD1"> </span></li>
                    </ul>
                </div>
                <div class="review">
                    <h3>Ship to <a href="" title="Edit" class="btn-edit"></a></h3>
                    <ul >
                      <li><b><span id="recieverName"> </span></b></li>
                      <li><b><span id="shipmentTo"> </span></b></li>
                      <li><b><span id="recieverPhone"> </span></b></li>
                      <li><b><span id="recieverEmail"> </span></b></li>
                      <li><b><span id="recieverCountry"> </span></b></li>
                      <li><b><span id="postalCodeD2"> </span></b></li>
                    </ul>
                </div>
                <div class="review">
                  <h3>Shipment information<a href="" title="Edit" class=" btn-edit"></a></h3>
                  <ul class="d-none" id="document">
                    <li><b>Shipment Type: <span id="pType"></span></b></li>
                    <li><b>Type of Document: <span id="dType"></span></b></li>
                    <li><b>Document Weight: <span id="dQty"> </span>kg</b></li>
                  </ul>
                  <ul class="d-none" id="package">
                    <li><b>Shipment Type: <span id="pPType"></span></b></li>
                    <li><b>Package Description: <span id="pDescrip"></span></b> </li>
                    <li><b>Package Weight: <span id="pWeight"></span>kg</b></li>
                    <li><b>Package Volumetric: <span id="pVolume"></span></b></li>
                  </ul>
                  <script>
                    document.getElementById('packageSelect').addEventListener('change', function() {
                      const documentDetails = document.getElementById('document');
                      const packageDetails = document.getElementById('package');

                      if (this.value === 'Package') {
                        documentDetails.classList.add('d-none');
                        packageDetails.classList.remove('d-none');
                      }
                      else if (this.value === 'Document') {  // Corrected 'else if'
                        documentDetails.classList.remove('d-none');
                        packageDetails.classList.add('d-none');
                      }
                    });
                  </script>
                </div>
                <div class="review">
                  <div class="d-none" id="pick-up">
                    <h3>Pick-up Information<a href="" title="Edit" class=" btn-edit"></a></h3>
                    <ul>
                      <li><b>Pick-up Address: <span id="pAddress"></span></b></li>
                      <li><b>Nearest Bus-top: <span id="pBustop"></span></b></li>
                      <li><b>Pick-Up Date: <span id="pDate"></span></b></li>
                      <li><b>Pick-Up Window: 9:00AM - 4:00PM </b></li>
                      <li><b>Pick-Up Price: <span id="pPrice"></span></b></li>
                    </ul>
                    <script>
                      // Get the input box and span element
                      const inputBox = document.getElementById('autocomplete1_full');
                      const pAddress = document.getElementById('pAddress');
                      // Update the span when the user types
                      inputBox.addEventListener('input', function () {
                        pAddress.innerText = this.value; // Update span with input value
                      });
                    </script>
                  </div>
                  <div class="d-none" id="drop-off">
                    <h3>Drop-Off Information<a href="" title="Edit" class=" btn-edit"></a></h3>
                    <ul>
                      <li><b>Drop-Off Address: <span> 74, Ayanguran Road, Ikorodu Garage, Ikorodu, Lagos</span></b></li>
                      <li><b>Drop-Off Date: <span id="dDate"></span></b></li>
                      <li><b>Drop-Off Window: 9:00AM - 5:00PM </b></li>
                    </ul>
                  </div>
                    <script>
                      // Get the DOM elements
                      const pickUpDate = document.getElementById('pickUpDate');                      
                      const dropOffDate = document.getElementById('dropoff_date');
                      const pickUp = document.getElementById('pick-up');
                      const dropOff = document.getElementById('drop-off');

                      // Function to update the display
                      function updateDisplay() {
                        const pickUpValue = pickUpDate.value; // Get the value of pick-up date
                        const dropOffValue = dropOffDate.value; // Get the value of drop-off date

                        if (pickUpValue && !dropOffValue) {
                          pickUp.classList.remove('d-none'); // Show 'pick-up'
                          dropOff.classList.add('d-none');   // Hide 'drop-off'
                        } else if (dropOffValue && !pickUpValue) {
                          pickUp.classList.add('d-none');    // Hide 'pick-up'
                          dropOff.classList.remove('d-none'); // Show 'drop-off'
                        } else {
                          // If both dates are filled or both are empty, reset display
                          pickUp.classList.add('d-none');
                          dropOff.classList.add('d-none');
                        }
                      }

                      // Add event listeners for 'change' events on both inputs
                      pickUpDate.addEventListener('change', updateDisplay);
                      dropOffDate.addEventListener('change', updateDisplay);
                    </script>
                  
                </div>
                <div class="review">
                  <div class="d-none" id="pDocument">
                    <h3>Shipment Price</h3>
                    <h4 class="pt-3"><b>Estimated Price: N<span id="ePrice"></span></b></h4>
                    <small class="text-danger"><b class="text-danger">Note: Price is Estimated, Until TravelWheel re-weigh. </b></small>
                  </div>
                  <div class="d-none" id="pPackage">
                    <h3>Shipment Price</h3>
                    <h4 class="pt-3"><b>Estimated Price: N<span id="ePPrice"></span></b></h4>
                    <small class="text-danger"><b class="text-danger">Note: Price is Estimated, Until TravelWheel re-weigh. </b></small>
                  </div>
                  <script>
                    document.getElementById('packageSelect').addEventListener('change', function() {
                      const documentPrice = document.getElementById('pDocument');
                      const packagePrice = document.getElementById('pPackage');

                      if (this.value === 'Document') {
                        documentPrice.classList.remove('d-none');
                        packagePrice.classList.add('d-none');
                      }
                      else if (this.value === 'Package') {  // Corrected 'else if'
                        documentPrice.classList.add('d-none');
                        packagePrice.classList.remove('d-none');
                      }
                    });
                  </script>
                </div>
              </div>
              <input type="button" name="previous" class="previous action-button" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Continue" />
              <input type="reset" name="cancel" class="action-button btn-blue" value="Cancel Shipment" />
            </fieldset>
            <!-- fieldsets payment end--> 
            
            <!-- fieldsets Review Start-->
            <fieldset>
              <h3 class="fs-title pb-3"><b>Please Confirm and Make Payment </b></h3>
              <div class="shipping-form">
                <div class="form-group">
                  <div class="row pe-3">
                    <div class="col-12 text-end">
                      <div class="d-none" id="cmpDocument">
                        <input type="hidden" id="pPrice2">
                        <h4>Total Amount (NGN)</h4>
                        <span class="d-block"><b>Shipping Price: <span id="tPrice"> </span>.00</b></span>
                        {{--<span class="d-block"><b>VAT: <span id="vat"></span>.00</b></span> --}}
                        <span class="d-none" id="displayPickUp"><b>Pick-UP Price: <span id="pPrice1"></span>.00</b></span> 
                        <span class="d-block"><b>Total Price: <span id="tAmount"></span>.00</b></span> 
                        {{--<input type="hidden" id="priceVat" name="priceVat">--}}
                        <input type="hidden" id="pick-Upshipment" name="pick-Upshipment">
                        <input type="hidden" id="totalPrice" name="totalPrice">
                      </div>
                      <div class="d-none" id="cmpPackage">
                        <h4>Total Amount (NGN)</h4>
                        <span class="d-block"><b>Shipping Price: <span id="tPrice2"> </span>.00</b></span>
                        {{--<span class="d-block"><b>VAT: <span id="vat2"></span>.00</b></span>--}} 
                        <span class="d-none" id="displayPickUp2"><b>Pick-UP Price: <span id="pPrice22"></span>.00</b></span> 
                        <span class="d-block"><b>Total Price: <span id="tAmount2"></span>.00</b></span> 
                        {{--<input type="hidden" id="priceVat2" name="priceVat2">--}}
                        <input type="hidden" id="pick-Upshipment2" name="pick-Upshipment2">
                        <input type="hidden" id="totalPrice2" name="totalPrice2">
                      </div>
                      <script>
                        document.getElementById('packageSelect').addEventListener('change', function() {
                          const cmpDocument = document.getElementById('cmpDocument');
                          const cmpPackage = document.getElementById('cmpPackage');

                          if (this.value === 'Document') {
                            cmpDocument.classList.remove('d-none');
                            cmpPackage.classList.add('d-none');
                          }
                          else if (this.value === 'Package') {  // Corrected 'else if'
                            cmpDocument.classList.add('d-none');
                            cmpPackage.classList.remove('d-none');
                          }
                        });
                      </script>
                     
                    </div>
                    <hr>
                    
                    <div class="col-12 col-lg-6 p-3">
                      <h6><b>Shiping From</b></h6>
                      <span class="d-block"><span id="sName"></span></span>
                      <span class="d-block" id="sEmail"></span>
                      <span class="d-block" id="sPhone"></span>
                      <span class="d-block" id="sAddress"></span>
                      <span class="d-block" id="sCountry"></span>
                      <span class="d-block" id="postalCodeP1"></span>

                    </div>
                    <div class="col-12 col-lg-6 p-3">
                      <h6><b>Shiping To</b></h6>
                      <span class="d-block"><span id="rName" ></span></span>
                      <span class="d-block" id="rEmail"></span>
                      <span class="d-block" id="rPhone"></span>
                      <span class="d-block" id="rAddress"></span>
                      <span class="d-block" id="rCountry"></span>
                      <span class="d-block" id="postalCodeP2"></span>
                    </div>
                    <div class="col-12 col-lg-6 p-3">
                      <h6><b>Shipment Details</b></h6>
                      <div class="d-none" id="document1">
                        <span class="d-block">Shipment Type: <span id="pType1"></span></span>
                        <span class="d-block">Type of Document: <span id="dType1"></span></b></span>
                        <span class="d-block">Document Weight: <span id="dQty1"> </span>kg</b></span>
                      </div>
                      <div class="d-none" id="package1">
                        <span class="d-block">Shipment Type: <span id="pPType1"></span></span>
                        <span class="d-block">Package Description: <span id="pDescrip1"></span></span>
                        <span class="d-block">Package Weight: <span id="pWeight1"></span>kg</span>
                        <span class="d-block">Package Volumetric: <span id="pVolume1"></span></span>
                      </div>
                      <script>
                        document.getElementById('packageSelect').addEventListener('change', function() {
                          const documentDetails1 = document.getElementById('document1');
                          const packageDetails1 = document.getElementById('package1');

                          if (this.value === 'Package') {
                            documentDetails1.classList.add('d-none');
                            packageDetails1.classList.remove('d-none');
                          }
                          else if (this.value === 'Document') {  // Corrected 'else if'
                            documentDetails1.classList.remove('d-none');
                            packageDetails1.classList.add('d-none');
                          }
                        });
                      </script>
                    </div>
                    <div class="col-12 col-lg-6 p-3">
                      <div class="d-none" id="dPick-up">
                        <h6><b> Pick-Up Details</b></h6>
                        <span class="d-block">Address: <span id="pAddress1"></span></span>
                        <span class="d-block">Nearest Bus-top: <span id="pBustop1"></span></span>
                        <span class="d-block">Pick-Up Date: <span id="pDate1"></span></span>
                        <span class="d-block">Pickup window: 9:00AM - 4:00PM </span>
                      </div>
                      <div class="d-none" id="dDrop-off">
                        <h6><b>Drop-Off Details</b></h6>
                        <span class="d-block">Address:  74, Ayanguran Road, Ikorodu Garage, Ikorodu, Lagos</span>
                        <span class="d-block">Drop-Off Date: <span id="dDate1"></span></span>
                        <span class="d-block">Drop-Off Window: 9:00AM - 5:00PM </span>
                      </div>
                        <script>
                          // Get the DOM elements
                          const pickUpDate1 = document.getElementById('pickUpDate');                      
                          const dropOffDate1 = document.getElementById('dropoff_date');
                          const dPickUp = document.getElementById('dPick-up');
                          const dDropOff = document.getElementById('dDrop-off');
                          const displayPickUp = document.getElementById('displayPickUp');
                          const displayPickUp2 = document.getElementById('displayPickUp2');

                          // Function to update the display
                          function updateDisplay1() {
                            const pickUpValue1 = pickUpDate1.value; // Get the value of pick-up date
                            const dropOffValue1 = dropOffDate1.value; // Get the value of drop-off date

                            if (pickUpValue1 && !dropOffValue1) {
                              dPickUp.classList.remove('d-none'); // Show 'pick-up'
                              displayPickUp.classList.remove('d-none'); // Show 'pick-up'
                              displayPickUp2.classList.remove('d-none'); // Show 'pick-up'
                              dDropOff.classList.add('d-none');   // Hide 'drop-off'
                            } else if (dropOffValue1 && !pickUpValue1) {
                              dPickUp.classList.add('d-none');    // Hide 'pick-up'
                              displayPickUp.classList.add('d-none');    // Hide 'pick-up'
                              displayPickUp2.classList.add('d-none');    // Hide 'pick-up'
                              dDropOff.classList.remove('d-none'); // Show 'drop-off'
                            } else {
                              // If both dates are filled or both are empty, reset display
                              dPickUp.classList.add('d-none');
                              displayPickUp.classList.add('d-none');    // Hide 'pick-up'
                              displayPickUp2.classList.add('d-none');    // Hide 'pick-up'
                              dDropOff.classList.add('d-none');
                            }
                          }

                          // Add event listeners for 'change' events on both inputs
                          pickUpDate1.addEventListener('change', updateDisplay1);
                          dropOffDate1.addEventListener('change', updateDisplay1);
                        </script>

                        
                    </div>
                  </div>
                </div>
                
              </div>
              <input type="button" name="previous" class="previous action-button" value="Previous" />
              <input type="submit" name="submit" class="action-button" value="Make Payment" />
            </fieldset>
            <!-- fieldsets Review end-->
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Create New Shipment end --> 
</div>
<!-- Main Wrapper end --> 

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
<script src="{{ asset('public/assets/js/cargo.js')}}"></script> 
<script>
    function calculatePrice() {
    const countryZone = document.querySelector('#countrySelect').selectedOptions[0]?.dataset.category;
    const serviceType = document.querySelector('#packageSelect')?.value; 
    const weightElement = document.getElementById(`${serviceType?.toLowerCase()}_weight`); 
    const weight = weightElement?.selectedOptions?.[0]?.dataset?.category ?? null; 

    if (countryZone && serviceType && weight) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            url: '{{ route("getShippingPrice") }}', // Laravel route
            method: 'POST',
            data: {
                zone: countryZone,
                service: serviceType,
                weight: weight,
            },
            success: function (response) {
                const formattedPrice = response.price 
                    ? new Intl.NumberFormat('en-NG', { style: 'decimal' }).format(response.price) 
                    : 'Price not available';

                if (serviceType === "Document") {
                    document.querySelector('#priceInput').value = formattedPrice;
                } else if (serviceType === "Package") {
                    document.querySelector('#priceInput2').value = formattedPrice;
                }
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Error fetching price';
                if (serviceType === "Document") {
                    document.querySelector('#priceInput').value = errorMessage;
                } else if (serviceType === "Package") {
                    document.querySelector('#priceInput2').value = errorMessage;
                }
            },
        });
    } else {
        const errorMessage = 'Please select all fields';
        if (serviceType === "Document") {
            document.querySelector('#priceInput').value = errorMessage;
        } else if (serviceType === "Package") {
            document.querySelector('#priceInput2').value = errorMessage;
        }
    }

    // Debug logs
    console.log("Selected CountryZone:", countryZone);
    console.log("Selected ShipmentType:", serviceType);
    console.log("Selected Weight:", weight);
  }
</script>
<script>
    const zones = {
        'Mainland 1': { price: 4500, areas: ['Abule oja', 'Alagomeji', 'Ebute metta', 'Folagoro', 'Idiaraba', 'Iponri', 'Itire', 'Iwaya', 'Lawanson', 'Ojuelegba', 'Oyingbo', 'Oshodi'] },
        'Mainland 2': { price: 4000, areas: ['Magodo', 'Alapere', 'Bariga', 'Ilupeju', 'Jibowu', 'Ikeja', 'Ogudu', 'Onipanu', 'Obanikoro', 'Somolu', 'Palmgroove', 'Yaba', 'Ajao', 'Maryland', 'Ketu', 'Mile12', 'Anthony', 'Shangisha', 'Ojota'] },
        'Mainland 3': { price: 4500, areas: ['Abule-egba', 'Agege', 'Berger', 'Iju ishaga', 'Fagba', 'Akute', 'Magodo phase2', 'Omole'] },
        'Mainland 4': { price: 6000, areas: ['Egbeda', 'Gowon', 'Ayobo', 'Ipaja', 'Igando', 'Ikotun', 'Iyana Ipaja', 'Okota', 'Ago palace', 'Ijaye', 'Dopemu', 'Meran'] },
        'Mainland 5': { price: 2500, areas: ['Agric Ikorodu', 'Ajegunle ikorodu', 'Asolo', 'Owede oniri', 'Ishawo', 'Ogolonto'] },
        'Mainland 6': { price: 2500, areas: ['Ikorodu garage', 'Sabo', 'Jubilee', 'laspotech', 'Ori okuta', 'ojokoro'] },
        'Mainland 7': { price: 4000, areas: ['Lucky fiber', 'Imota', 'Odogunyan', 'Gberigbe', 'Ogijo', 'Caleb'] },
        'Mainland 8': { price: 6000, areas: ['Festac', 'Apapa', 'Ajegunle', 'Satellite', 'Ijegun'] },
        'Mainland 9': { price: 6000, areas: ['Lasu Gate', 'Iyana iba', 'Iyana Ishashi', 'Okoko', 'Ojo'] },
        'Island 1': { price: 6000, areas: ['Lagos island', 'Cms', 'Marina', 'Idumota'] },
        'Island 2': { price: 6000, areas: ['Eko Hotel', 'VI', 'Bonny camp', '1004', 'Oniru'] },
        'Island 3': { price: 7000, areas: ['Lekki phase 1', 'Igbo efun', 'Ikate', 'Maruwa'] },
        'Island 4': { price: 7000, areas: ['Ajah', 'Badore', 'Ogombo', 'Abraham adesanya', 'Ado', 'Langbasa'] },
        'Island 5': { price: 8000, areas: ['Awoyaya', 'Sangotedo', 'Ocean bay'] }
    };

    const input = document.getElementById('area-input');
    const suggestionsContainer = document.getElementById('area-suggestions');

    // Get all areas from all zones
    const allAreas = Object.values(zones).reduce((acc, zone) => {
        return acc.concat(zone.areas);
    }, []);

    function getPriceBasedOnAddress(address) {
        // Check if the exact input matches any area in our list
        const exactMatch = allAreas.some(area => 
            area.toLowerCase() === address.toLowerCase()
        );

        if (!exactMatch) {
            return { zone: 'Unknown', price: 0 };
        }

        for (const [zone, data] of Object.entries(zones)) {
            for (const area of data.areas) {
                if (address.toLowerCase() === area.toLowerCase()) {
                    return { zone, price: data.price };
                }
            }
        }
        return { zone: 'Unknown', price: 0 };
    }

    function updateDPrice() {
        const address = document.getElementById('area-input').value;
        const result = getPriceBasedOnAddress(address);
        const pBustop = document.getElementById('pBustop');
        pBustop.innerHTML = address;
        document.getElementById('pBustop1').innerHTML = address;
        
        document.getElementById('deliveryPrice').innerText = 
        result.price ? `Delivery Price: ₦${result.price}` : 'Price not found, please call customer support for price';

        document.getElementById('pPrice').innerText = 
        result.price ? `₦${result.price}` : 'Price not found, please call customer support for price';
        document.getElementById('pPrice1').innerText = (result.price).toLocaleString()
        document.getElementById('pPrice22').innerText = (result.price).toLocaleString()
        document.getElementById('pick-Upshipment').value = result.price;
        document.getElementById('pPrice2').value = result.price;
    }

    input.addEventListener('input', function() {
        const inputValue = this.value.toLowerCase();
        updateDPrice(); // Update price on every input change
        
        if (inputValue.length < 1) {
            suggestionsContainer.style.display = 'none';
            return;
        }

        const matchingAreas = allAreas.filter(area => 
            area.toLowerCase().includes(inputValue)
        );

        if (matchingAreas.length > 0) {
            suggestionsContainer.innerHTML = matchingAreas
                .map(area => `<div class="area-suggestion-item">${area}</div>`)
                .join('');
            suggestionsContainer.style.display = 'block';
        } else {
            suggestionsContainer.style.display = 'none';
        }
    });

    suggestionsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('area-suggestion-item')) {
            input.value = e.target.textContent;
            suggestionsContainer.style.display = 'none';
            updateDPrice(); // Update price immediately after selection
        }
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!input.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.style.display = 'none';
        }
    });
</script>

<script>
  const areas = {
      'Area 1': { areas: ['Abule oja', 'Alagomeji', 'Ebute metta', 'Folagoro', 'Idiaraba', 'Iponri', 'Itire', 'Iwaya', 'Lawanson', 'Ojuelegba', 'Oyingbo', 'Oshodi'] },
      'Area 2': { areas: ['Magodo', 'Alapere', 'Bariga', 'Ilupeju', 'Jibowu', 'Ikeja', 'Ogudu', 'Onipanu', 'Obanikoro', 'Somolu', 'Palmgroove', 'Yaba', 'Ajao', 'Maryland', 'Ketu', 'Mile12', 'Anthony', 'Shangisha', 'Ojota'] },
      'Area 3': { areas: ['Abule-egba', 'Agege', 'Berger', 'Iju ishaga', 'Fagba', 'Akute', 'Magodo phase2', 'Omole'] },
      'Area 4': { areas: ['Egbeda', 'Gowon', 'Ayobo', 'Ipaja', 'Igando', 'Ikotun', 'Iyana Ipaja', 'Okota', 'Ago palace', 'Ijaye', 'Dopemu', 'Meran'] },
      'Area 5': { areas: ['Agric Ikorodu', 'Ajegunle ikorodu', 'Asolo', 'Owede oniri', 'Ishawo', 'Ogolonto'] },
      'Area 6': { areas: ['Ikorodu garage', 'Sabo', 'Jubilee', 'laspotech', 'Ori okuta', 'ojokoro'] },
      'Area 7': { areas: ['Lucky fiber', 'Imota', 'Odogunyan', 'Gberigbe', 'Ogijo', 'Caleb'] },
      'Area 8': { areas: ['Festac', 'Apapa', 'Ajegunle', 'Satellite', 'Ijegun'] },
      'Area 9': { areas: ['Lasu Gate', 'Iyana iba', 'Iyana Ishashi', 'Okoko', 'Ojo'] },
      'Area 10': { areas: ['Lagos island', 'Cms', 'Marina', 'Idumota'] },
      'Area 11': { areas: ['Eko Hotel', 'VI', 'Bonny camp', '1004', 'Oniru'] },
      'Area 12': { areas: ['Lekki phase 1', 'Igbo efun', 'Ikate', 'Maruwa'] },
      'Area 13': { areas: ['Ajah', 'Badore', 'Ogombo', 'Abraham adesanya', 'Ado', 'Langbasa'] },
      'Area 14': { areas: ['Awoyaya', 'Sangotedo', 'Ocean bay'] }
  };

  const input = document.getElementById('area-input');
  const suggestionsContainer = document.getElementById('area-suggestions');

  // Get all areas from all zones
  const allAreas = Object.values(areas).reduce((acc, area) => {
      return acc.concat(area.areas);
  }, []);

  input.addEventListener('input', function() {
      const inputValue = this.value.toLowerCase();
      if (inputValue.length < 1) {
          suggestionsContainer.style.display = 'none';
          return;
      }

      const matchingAreas = allAreas.filter(area => 
          area.toLowerCase().includes(inputValue)
      );

      if (matchingAreas.length > 0) {
          suggestionsContainer.innerHTML = matchingAreas
              .map(area => `<div class="area-suggestion-item">${area}</div>`)
              .join('');
          suggestionsContainer.style.display = 'block';
      } else {
          suggestionsContainer.style.display = 'none';
      }
  });

  suggestionsContainer.addEventListener('click', function(e) {
      if (e.target.classList.contains('area-suggestion-item')) {
          input.value = e.target.textContent;
          suggestionsContainer.style.display = 'none';
          
      }
  });

  // Close suggestions when clicking outside
  document.addEventListener('click', function(e) {
      if (!input.contains(e.target) && !suggestionsContainer.contains(e.target)) {
          suggestionsContainer.style.display = 'none';
      }
  });
</script>

<!-- Bootstrap JS --> 
<script src="{{ asset('public/assets/ship/assets/js/bootstrap.min.js')}}"></script> 

<!-- OwlCarousel JS --> 
<script src="{{ asset('public/assets/ship/assets/js/owl.carousel.min.js')}}"></script> 

<!-- Tether JS --> 
<script src="{{ asset('public/assets/ship/assets/js/tether.min.js')}}"></script> 

<script src="{{ asset('public/assets/ship/assets/js/jquery.filterizr.min.js')}}"></script> 


<!-- Popper JS --> 
<script src="{{ asset('public/assets/ship/assets/js/popper.min.js')}}"></script> 
<!-- Bootstrap dateTimePicker --> 
<script src="{{ asset('public/assets/ship/assets/js/datetimepicker-moment.min.js')}}"></script> 
<script src="{{ asset('public/assets/ship/assets/js/bootstrap-datetimepicker.min.js')}}"></script> 

<script src="{{ asset('public/assets/ship/assets/js/jquery.slicknav.min.js')}}"></script> 

<!-- WOW JS --> 
<script src="{{ asset('public/assets/ship/assets/js/wow-1.3.0.min.js')}}"></script> 



<!-- Step Form with validate --> 
<script src="{{ asset('public/assets/ship/assets/js/jquery.validate.js')}}"></script> 
<script src="{{ asset('public/assets/ship/assets/js/form-step.js')}}"></script> 


<!-- Active JS --> 
<script src="{{ asset('public/assets/ship/assets/js/active.js')}}"></script>
</body>
</html>