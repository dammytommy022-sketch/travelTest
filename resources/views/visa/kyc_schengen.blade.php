<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Wheel | Air - Airport Lounge </title>
  <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
  <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://kit.fontawesome.com/0626e5d22c.js" crossorigin="anonymous"></script>
  <style>
    .form-check-inline {
      display: inline-block;
    }

    .dropdown-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .items-controls {
      display: flex;
      align-items: center;
    }

    .item-count {
      font-size: 12px;
      margin: 0 5px;
    }

    .increment-button,
    .decrement-button {
      padding: 4px 8px;
      font-size: 12px;
    }

    .solid {
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .hidden {
      display: none;
    }

    @keyframes fadeDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-down {
      animation: fadeDown 0.5s ease;
    }
  </style>

</head>

<body>
  <!-- Navbar -->
  <section>
    @include('layouts.newnav')
  </section>
  <main id="main" style="padding-top: 60px;">
    <section class="shadow-sm">
      <div class="container">
        <form id="myForm" action="{{ route('kyc_schengen.form') }}" method="POST">
          {{ csrf_field() }}
          <div class="row airport-form shadow p-4 mt-2 mb-5">
            <div class="col-sm-6">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Personal Details</h5>
                  <small class="text-muted float-end">Fill in necessary details</small>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="surname_family">Surname (Family name)</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" name="surname" id="surname_family"
                            placeholder="Enter Surname" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="surname_former">Surname (Former Family name)</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" name="surname_at_birth" id="surname_former"
                            placeholder="Enter surname" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="firstname">First Name</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" name="first_name" id="firstname"
                            placeholder="Enter first name" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="email">Middle Name</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" name="middle_name" id="middlename"
                            placeholder="Enter Middlename" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>

                    </div>

                    <div class="col-12 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="dob">Date Of Birth</label>
                        <div class="row">
                          <div class="col-4">
                            <input type="text" class="form-control" id="datepicker" placeholder="DD">
                          </div>
                          <div class="col-4">
                            <input type="text" class="form-control" id="month" placeholder="MM">
                          </div>
                          <div class="col-4">
                            <input type="text" class="form-control" id="year" placeholder="YYYY">
                          </div>
                          <input type="hidden" id="combinedDate" name="date_of_birth">
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="pob">Place of Birth</label>
                        <input type="text" name="place_of_birth" class="form-control" />
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="cob">Country of Birth</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-globe"></i></span>
                          <select name="country_of_birth" id="cob" class="form-select">
                            <option value="nigeria" selected>Nigeria</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cabo Verde">Cabo Verde</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo (Congo-Brazzaville)</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czechia">Czechia (Czech Republic)</option>
                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo
                            </option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Eswatini">Eswatini (fmr. "Swaziland")</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Greece">Greece</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Holy See">Holy See</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar (formerly Burma)</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="North Korea">North Korea</option>
                            <option value="North Macedonia">North Macedonia (formerly
                              Macedonia)</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine State">Palestine State</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                            </option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="cn">Current Nationality</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-globe"></i></span>
                          <select name="current_nationality" id="cn" class="form-select">
                            <option value="nigeria" selected>Nigeria</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cabo Verde">Cabo Verde</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo (Congo-Brazzaville)</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czechia">Czechia (Czech Republic)</option>
                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo
                            </option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Eswatini">Eswatini (fmr. "Swaziland")</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Greece">Greece</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Holy See">Holy See</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar (formerly Burma)</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="North Korea">North Korea</option>
                            <option value="North Macedonia">North Macedonia (formerly
                              Macedonia)</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine State">Palestine State</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                            </option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="nob">Nationality at Birth <i class="fa fa-info-circle"
                            data-toggle="tooltip" title="if different from current Nationality"></i></label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-globe"></i></span>
                          <select name="nationality_at_birth" id="nob" class="form-select">
                            <option value="nigeria" selected>Nigeria</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cabo Verde">Cabo Verde</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo (Congo-Brazzaville)</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czechia">Czechia (Czech Republic)</option>
                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo
                            </option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Eswatini">Eswatini (fmr. "Swaziland")</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Greece">Greece</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Holy See">Holy See</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar (formerly Burma)</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="North Korea">North Korea</option>
                            <option value="North Macedonia">North Macedonia (formerly
                              Macedonia)</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine State">Palestine State</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                            </option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3 mt-2">
                        <label class="form-label" for="gender">Gender</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="sex" id="inlineRadio1"
                            value="male">
                          <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="sex" id="inlineRadio2"
                            value="female">
                          <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="gender">Marital Status</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="civil_status" id="inlineRadio3"
                            value="married">
                          <label class="form-check-label" for="inlineRadio3">Married</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="civil_status" id="inlineRadio4"
                            value="single">
                          <label class="form-check-label" for="inlineRadio4">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="civil_status" id="inlineRadio5"
                            value="pathners">
                          <label class="form-check-label" for="inlineRadio5">Registered Pathners</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="civil_status" id="inlineRadio6"
                            value="separated">
                          <label class="form-check-label" for="inlineRadio6">Separated</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="civil_status" id="inlineRadio7"
                            value="divorced">
                          <label class="form-check-label" for="inlineRadio7">Divorced</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="civil_status" id="inlineRadio8"
                            value="widow">
                          <label class="form-check-label" for="inlineRadio8">widow(er)</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 mt-2">
                        <input type="checkbox" name="minor" id="minor" class="form-check-input">
                        <label class="form-check-label" for="minor">Are you a minor <i class="fa fa-info-circle"
                            data-toggle="tooltip" title="Less than 18 years old"></i></label>
                      </div>
                    </div>
                    <div class="col-12" id="guardian" style="display: none">
                      <div class="mb-3 mt-2">
                        <h6>Guardian Information</h6>
                        <div class="row">
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="gsname">Surname</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="guardian_surname" id="gsname"
                                  placeholder="Guardian Surname" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="gfname">Firstname</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="guardian_first_name" id="gfname"
                                  placeholder="Guardian Firstname" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="g-address">Address<span><small
                                    class="text-danger ms-2">*if different from applicant</small></span></label>
                              <textarea name="guardian_address" id="g-address" cols="27" rows="1" placeholder="Guardian Address"></textarea>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="gnumber">Phone Number</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" name="guardian_number" id="gnumber"
                                  placeholder="Guardian Phonenumber"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="gmail">Email Address</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="guardian_email" id="gmail"
                                  placeholder="Guardian Email Address"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="gnation">Nationality</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-globe"></i></span>
                                <select name="gnation" id="gnation" class="form-select">
                                  <option value="nigeria" selected>Nigeria</option>
                                  <option value="Afghanistan">Afghanistan</option>
                                  <option value="Albania">Albania</option>
                                  <option value="Algeria">Algeria</option>
                                  <option value="Andorra">Andorra</option>
                                  <option value="Angola">Angola</option>
                                  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                  <option value="Argentina">Argentina</option>
                                  <option value="Armenia">Armenia</option>
                                  <option value="Australia">Australia</option>
                                  <option value="Austria">Austria</option>
                                  <option value="Azerbaijan">Azerbaijan</option>
                                  <option value="Bahamas">Bahamas</option>
                                  <option value="Bahrain">Bahrain</option>
                                  <option value="Bangladesh">Bangladesh</option>
                                  <option value="Barbados">Barbados</option>
                                  <option value="Belarus">Belarus</option>
                                  <option value="Belgium">Belgium</option>
                                  <option value="Belize">Belize</option>
                                  <option value="Benin">Benin</option>
                                  <option value="Bhutan">Bhutan</option>
                                  <option value="Bolivia">Bolivia</option>
                                  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                  <option value="Botswana">Botswana</option>
                                  <option value="Brazil">Brazil</option>
                                  <option value="Brunei">Brunei</option>
                                  <option value="Bulgaria">Bulgaria</option>
                                  <option value="Burkina Faso">Burkina Faso</option>
                                  <option value="Burundi">Burundi</option>
                                  <option value="Cabo Verde">Cabo Verde</option>
                                  <option value="Cambodia">Cambodia</option>
                                  <option value="Cameroon">Cameroon</option>
                                  <option value="Canada">Canada</option>
                                  <option value="Central African Republic">Central African Republic</option>
                                  <option value="Chad">Chad</option>
                                  <option value="Chile">Chile</option>
                                  <option value="China">China</option>
                                  <option value="Colombia">Colombia</option>
                                  <option value="Comoros">Comoros</option>
                                  <option value="Congo">Congo (Congo-Brazzaville)</option>
                                  <option value="Costa Rica">Costa Rica</option>
                                  <option value="Croatia">Croatia</option>
                                  <option value="Cuba">Cuba</option>
                                  <option value="Cyprus">Cyprus</option>
                                  <option value="Czechia">Czechia (Czech Republic)</option>
                                  <option value="Democratic Republic of the Congo">Democratic Republic of the Congo
                                  </option>
                                  <option value="Denmark">Denmark</option>
                                  <option value="Djibouti">Djibouti</option>
                                  <option value="Dominica">Dominica</option>
                                  <option value="Dominican Republic">Dominican Republic</option>
                                  <option value="Ecuador">Ecuador</option>
                                  <option value="Egypt">Egypt</option>
                                  <option value="El Salvador">El Salvador</option>
                                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                                  <option value="Eritrea">Eritrea</option>
                                  <option value="Estonia">Estonia</option>
                                  <option value="Eswatini">Eswatini (fmr. "Swaziland")</option>
                                  <option value="Ethiopia">Ethiopia</option>
                                  <option value="Fiji">Fiji</option>
                                  <option value="Finland">Finland</option>
                                  <option value="France">France</option>
                                  <option value="Gabon">Gabon</option>
                                  <option value="Gambia">Gambia</option>
                                  <option value="Georgia">Georgia</option>
                                  <option value="Germany">Germany</option>
                                  <option value="Ghana">Ghana</option>
                                  <option value="Greece">Greece</option>
                                  <option value="Grenada">Grenada</option>
                                  <option value="Guatemala">Guatemala</option>
                                  <option value="Guinea">Guinea</option>
                                  <option value="Guinea-Bissau">Guinea-Bissau</option>
                                  <option value="Guyana">Guyana</option>
                                  <option value="Haiti">Haiti</option>
                                  <option value="Holy See">Holy See</option>
                                  <option value="Honduras">Honduras</option>
                                  <option value="Hungary">Hungary</option>
                                  <option value="Iceland">Iceland</option>
                                  <option value="India">India</option>
                                  <option value="Indonesia">Indonesia</option>
                                  <option value="Iran">Iran</option>
                                  <option value="Iraq">Iraq</option>
                                  <option value="Ireland">Ireland</option>
                                  <option value="Israel">Israel</option>
                                  <option value="Italy">Italy</option>
                                  <option value="Jamaica">Jamaica</option>
                                  <option value="Japan">Japan</option>
                                  <option value="Jordan">Jordan</option>
                                  <option value="Kazakhstan">Kazakhstan</option>
                                  <option value="Kenya">Kenya</option>
                                  <option value="Kiribati">Kiribati</option>
                                  <option value="Kuwait">Kuwait</option>
                                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                                  <option value="Laos">Laos</option>
                                  <option value="Latvia">Latvia</option>
                                  <option value="Lebanon">Lebanon</option>
                                  <option value="Lesotho">Lesotho</option>
                                  <option value="Liberia">Liberia</option>
                                  <option value="Libya">Libya</option>
                                  <option value="Liechtenstein">Liechtenstein</option>
                                  <option value="Lithuania">Lithuania</option>
                                  <option value="Luxembourg">Luxembourg</option>
                                  <option value="Madagascar">Madagascar</option>
                                  <option value="Malawi">Malawi</option>
                                  <option value="Malaysia">Malaysia</option>
                                  <option value="Maldives">Maldives</option>
                                  <option value="Mali">Mali</option>
                                  <option value="Malta">Malta</option>
                                  <option value="Marshall Islands">Marshall Islands</option>
                                  <option value="Mauritania">Mauritania</option>
                                  <option value="Mauritius">Mauritius</option>
                                  <option value="Mexico">Mexico</option>
                                  <option value="Micronesia">Micronesia</option>
                                  <option value="Moldova">Moldova</option>
                                  <option value="Monaco">Monaco</option>
                                  <option value="Mongolia">Mongolia</option>
                                  <option value="Montenegro">Montenegro</option>
                                  <option value="Morocco">Morocco</option>
                                  <option value="Mozambique">Mozambique</option>
                                  <option value="Myanmar">Myanmar (formerly Burma)</option>
                                  <option value="Namibia">Namibia</option>
                                  <option value="Nauru">Nauru</option>
                                  <option value="Nepal">Nepal</option>
                                  <option value="Netherlands">Netherlands</option>
                                  <option value="New Zealand">New Zealand</option>
                                  <option value="Nicaragua">Nicaragua</option>
                                  <option value="Niger">Niger</option>
                                  <option value="North Korea">North Korea</option>
                                  <option value="North Macedonia">North Macedonia (formerly
                                    Macedonia)</option>
                                  <option value="Norway">Norway</option>
                                  <option value="Oman">Oman</option>
                                  <option value="Pakistan">Pakistan</option>
                                  <option value="Palau">Palau</option>
                                  <option value="Palestine State">Palestine State</option>
                                  <option value="Panama">Panama</option>
                                  <option value="Papua New Guinea">Papua New Guinea</option>
                                  <option value="Paraguay">Paraguay</option>
                                  <option value="Peru">Peru</option>
                                  <option value="Philippines">Philippines</option>
                                  <option value="Poland">Poland</option>
                                  <option value="Portugal">Portugal</option>
                                  <option value="Qatar">Qatar</option>
                                  <option value="Romania">Romania</option>
                                  <option value="Russia">Russia</option>
                                  <option value="Rwanda">Rwanda</option>
                                  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                  <option value="Saint Lucia">Saint Lucia</option>
                                  <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                  </option>
                                  <option value="Samoa">Samoa</option>
                                  <option value="San Marino">San Marino</option>
                                  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                  <option value="Saudi Arabia">Saudi Arabia</option>
                                  <option value="Senegal">Senegal</option>
                                  <option value="Serbia">Serbia</option>
                                  <option value="Seychelles">Seychelles</option>
                                  <option value="Sierra Leone">Sierra Leone</option>
                                  <option value="Singapore">Singapore</option>
                                  <option value="Slovakia">Slovakia</option>
                                  <option value="Slovenia">Slovenia</option>
                                  <option value="Solomon Islands">Solomon Islands</option>
                                  <option value="Somalia">Somalia</option>
                                  <option value="South Africa">South Africa</option>
                                  <option value="South Korea">South Korea</option>
                                  <option value="South Sudan">South Sudan</option>
                                  <option value="Spain">Spain</option>
                                  <option value="Sri Lanka">Sri Lanka</option>
                                  <option value="Sudan">Sudan</option>
                                  <option value="Suriname">Suriname</option>
                                  <option value="Sweden">Sweden</option>
                                  <option value="Switzerland">Switzerland</option>
                                  <option value="Syria">Syria</option>
                                  <option value="Tajikistan">Tajikistan</option>
                                  <option value="Tanzania">Tanzania</option>
                                  <option value="Thailand">Thailand</option>
                                  <option value="Timor-Leste">Timor-Leste</option>
                                  <option value="Togo">Togo</option>
                                  <option value="Tonga">Tonga</option>
                                  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                  <option value="Tunisia">Tunisia</option>
                                  <option value="Turkey">Turkey</option>
                                  <option value="Turkmenistan">Turkmenistan</option>
                                  <option value="Tuvalu">Tuvalu</option>
                                  <option value="Uganda">Uganda</option>
                                  <option value="Ukraine">Ukraine</option>
                                  <option value="United Arab Emirates">United Arab Emirates</option>
                                  <option value="United Kingdom">United Kingdom</option>
                                  <option value="United States of America">United States of America</option>
                                  <option value="Uruguay">Uruguay</option>
                                  <option value="Uzbekistan">Uzbekistan</option>
                                  <option value="Vanuatu">Vanuatu</option>
                                  <option value="Venezuela">Venezuela</option>
                                  <option value="Vietnam">Vietnam</option>
                                  <option value="Yemen">Yemen</option>
                                  <option value="Zambia">Zambia</option>
                                  <option value="Zimbabwe">Zimbabwe</option>
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

            {{-- Passport --}}
            <div class="col-sm-6">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Passport Information</h5>
                  <small class="text-muted float-end">FIll in necessary details</small>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="nin">National Identity Number (NIN)</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-id-card"></i></span>
                          <input type="text" class="form-control" name="national_identity_number"
                            id="nin" placeholder="Enter NIN"
                            aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="ordinary">Type of International Passport</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="passport_type" id="ordinary"
                            value="ordinary">
                          <label class="form-check-label" for="ordinary">Ordinary</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="passport_type" id="diplomatic"
                            value="diplomatic">
                          <label class="form-check-label" for="diplomatic">Diplomatic</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="passport_type" id="service"
                            value="service">
                          <label class="form-check-label" for="service">Service</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="passport_type" id="official"
                            value="official">
                          <label class="form-check-label" for="official">Official</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="passport_type" id="special"
                            value="special">
                          <label class="form-check-label" for="special">Special</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="passport_type" id="others"
                            value="">
                          <label class="form-check-label" for="others">Others Travel Documents</label>
                          <input type="text" class="form-control" name="" style="display: none"
                            id="others-input" placeholder="Please specify">
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="passport_no">Passport Number</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-passport"></i></span>
                          <input type="text" class="form-control" name="passport_number" id="passport_no"
                            placeholder="Your passport number" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                     <div class="col-12 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="doi">Date Of Issue</label>
                        <div class="row">
                          <div class="col-4">
                            <input type="text" class="form-control" id="doi-day" placeholder="DD">
                          </div>
                          <div class="col-4">
                            <input type="text" class="form-control" id="doi-month" placeholder="MM">
                          </div>
                          <div class="col-4">
                            <input type="text" class="form-control" id="doi-year" placeholder="YYYY">
                          </div>
                          <input type="hidden" id="combinedDOI" name="date_of_issue">
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="ped">Passport Expiry Date <i class="fa fa-info-circle"
                            data-toggle="tooltip"
                            title="Passport expiry date must be at least 6 months
                        after the return date."></i></label>
                        <input class="form-control" type="date" name="passport_expiry_date" id="ped" />
                      </div>
                      <p id="warning" style="color: red; font-size:12px;" hidden>Passport expiry date must be at
                        least 6 months
                        after the return date.</p>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label class="form-label" for="ic">Issuing Country</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-globe"></i></span>
                          <select name="issued_by_country" id="ic" class="form-select">
                            <option value="nigeria" selected>Nigeria</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cabo Verde">Cabo Verde</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo (Congo-Brazzaville)</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czechia">Czechia (Czech Republic)</option>
                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo
                            </option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Eswatini">Eswatini (fmr. "Swaziland")</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Greece">Greece</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Holy See">Holy See</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar (formerly Burma)</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="North Korea">North Korea</option>
                            <option value="North Macedonia">North Macedonia (formerly
                              Macedonia)</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine State">Palestine State</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                            </option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 mt-2">
                        <label class="form-label" for="other_country">Are you a residence of another country other
                          than country of nationality</label><br>
                        <div class="row">
                          <div class="col-4">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="other_country_radio"
                                id="inlineRadio11" value="yes">
                              <label class="form-check-label" for="inlineRadio11">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="other_country_radio"
                                id="inlineRadio21" value="no">
                              <label class="form-check-label" for="inlineRadio21">No</label>
                            </div>
                          </div>
                          <div class="col-8" id="other_country" style="display: none">
                            <input type="text" name="other_country" placeholder="other country">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="pot">Have you previously applied for a Schengen
                          visa?</label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="print" id="yes_print"
                            value="yes_print">
                          <label class="form-check-label" for="yes_print">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="print" id="no_print"
                            value="no_print">
                          <label class="form-check-label" for="no_print">No</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12" id="options" style="display: none">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="date">Date (optional)</label>
                            <input type="date" name="date_of_application" class="form-control"
                              placeholder="Enter date" id="date">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="stcker_no">Sticker Number</label>
                            <input type="text" id="stcker_no" class="form-control" name="sticker_number"
                              placeholder="Enter sticker number">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- Application --}}
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Application Details</h5>
                  <small class="text-muted float-end">FIll in necessary details</small>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="a_phone">Applicant Phone Number</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                          <input type="text" class="form-control" name="telephone_number" id="a_phone"
                            placeholder="Applicant Phone" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="a_mail">Applicant Email Address</label>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                          <input type="text" class="form-control" name="email_address" id="a_mail"
                            placeholder="Applicant mail" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="a_address">Applicant Address</label><br>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-house-user"></i></span>
                          <input type="text" class="form-control" name="home_address" id="a_address"
                            placeholder="Applicant Address" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                     <div class="col-6 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="ida">Intended Date of Arrival</label>
                        <input class="form-control" type="date" name="intended_arrival_date" id="ida"
                          value="{{ $return }}" readonly />
                      </div>
                    </div>
                    <div class="col-6 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="idd">Intended Date of Departure</label>
                        <input class="form-control" type="date" name="intended_departure_date" id="idd"
                          value="{{ $departure }}" readonly />
                      </div>
                    </div>
                    <div class="col-12 col-md-4">
                      <div style="margin-top: 40px;">
                      <small><b class="text danger">You have a maximum stay of {{ $visa_validity }}
                            day(s)</b></small>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 mt-2">
                        <label class="form-label" for="pot">Purpose of Travel</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="tour" value="tourism">
                          <label class="form-check-label" for="tour">Tourism</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="business" value="business">
                          <label class="form-check-label" for="business">Business</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="visiting" value="visiting">
                          <label class="form-check-label" for="visiting">Visiting</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="cultural" value="cultural">
                          <label class="form-check-label" for="cultural">Cultural</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="sport" value="sport">
                          <label class="form-check-label" for="sport">Sports</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="medical" value="medical">
                          <label class="form-check-label" for="medical">Medical</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="study" value="study">
                          <label class="form-check-label" for="study">Study</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="airport_transit" value="airport_transit">
                          <label class="form-check-label" for="airport_transit">Airport Transit</label>
                        </div>
                        <div class="form-check form-check-inline" id="othersContainer">
                          <input class="form-check-input" type="radio" name="purpose_of_journey"
                            id="others_purpose" value="">
                          <label class="form-check-label" for="others_purpose">Others</label>
                          <input type="text" name="" id="others_purpose_input"
                            placeholder="Please specify" style="display: none">
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="msmd">Member State of Main Destination</label><br>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-map-pin"></i></span>
                          <input type="text" class="form-control" name="main_destination_member_state"
                            id="msmd" placeholder="member state of main destination"
                            aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="msfe">Member State of First Entry</label><br>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-map-pin"></i></span>
                          <input type="text" class="form-control" name="first_entry_member_state"
                            id="msfe" placeholder="member state of first entry"
                            aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-md-4">
                      <div class="mb-3">
                        <label class="form-label" for="omsd">Other Member State of Destination (if
                          applicable)</label><br>
                        <div class="input-group input-group-merge">
                          <span id="fullname" class="input-group-text"><i class="fa fa-map-pin"></i></span>
                          <input type="text" class="form-control" name="other_member_destination"
                            id="omsd" placeholder="other member state of destination"
                            aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="pot">Cost of travelling and living during the
                          applicant’s
                          stay is covered by:</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="cost_coverage" id="applicant"
                            value="applicant">
                          <label class="form-check-label" for="applicant">Applicant</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="cost_coverage" id="sponsor"
                            value="sponsor">
                          <label class="form-check-label" for="sponsor">Sponsor<i class="fa fa-info-circle ms-2"
                              data-toggle="tooltip" title="host/company/organization"></i></label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="moi">Means of invitation</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="invitaion_means" id="individual"
                            value="individual">
                          <label class="form-check-label" for="individual">Individual <i class="fa fa-info-circle"
                              data-toggle="tooltip" title="Family/friends"></i></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="invitaion_means" id="company"
                            value="Organization/Company">
                          <label class="form-check-label" for="company">Organization/Company</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="invitaion_means" id="none"
                            value="none">
                          <label class="form-check-label" for="none">None</label>
                        </div>
                      </div>
                      <div id="individual_details" class="col-12" style="display: none;">
                        <h6>Individual Details</h6>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="i_name">Name of Inviting person</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="inviting_person" id="i_name"
                                  placeholder="Full name" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="i_phone">Phone Number</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="inviting_person_telephone"
                                  id="i_phone" placeholder="Phone Number"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="i_mail">Email</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i
                                    class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="inviting_mail" id="i_mail"
                                  placeholder="Email Address" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="i_home">Home Address</label>
                              <textarea name="inviting_person_address" id="i_home" cols="30" rows="1" class="form-control"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id="company_details" class="col-12" style="display: none;">
                        <h6>Company Contact Person Details</h6>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="c_name">Name of Company</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="company_or_organization_name"
                                  id="c_name" placeholder="Full name"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="c_phone">Phone Number of Company</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control"
                                  name="company_or_organization_telephone" id="c_phone"
                                  placeholder="Phone Number" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="c_mail">Email of Company</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i
                                    class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="company_or_organization_email"
                                  id="c_mail" placeholder="Phone Number"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="c_home">Company Address</label>
                              <textarea name="c_home" id="company_or_organization_address" cols="30" rows="1"
                                class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="cp_name">FullName of person</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="contact_person_surname"
                                  id="cp_name" placeholder="Full name"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="cp_phone">Phone Number of Contact Person</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="contact_person_telephone"
                                  id="cp_phone" placeholder="Phone Number"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="cp_mail">Email of Contact Person</label>
                              <div class="input-group input-group-merge">
                                <span id="fullname" class="input-group-text"><i
                                    class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="contact_person_email"
                                  id="cp_mail" placeholder="Enter Email"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="hotel_details" class="col-12" style="display: none;">
                        <p>Do you have accommodations or a temporary place to stay?</p>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="yes" name="accommodation"
                            value="yes">
                          <label class="form-check-label" for="yes">Yes, I do</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="no" name="accommodation"
                            value="no">
                          <label class="form-check-label" for="no">No, I don't</label>
                        </div>
                        <div id="hotel" style="display: none">
                          <h6>Hotel/Temporary accommodation Details</h6>
                          <div class="row">
                            <div class="col-12 col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="h_home">Name of Hotel</label>
                                <div class="input-group input-group-merge">
                                  <span id="fullname" class="input-group-text"><i class="fa fa-hotel"></i></span>
                                  <input type="text" name="hotel_adress" id="h_home" class="form-control"
                                    placeholder="Hotel Name" aria-describedby="basic-icon-default-fullname2" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="travelwheel_hotel" style="display: none">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="travelwheel_hotel"
                              id="agree_travelwheel" value="{{ $hotel_fees }}">
                            <label class="form-check-label" for="agree_travelwheel">Certainly! Travelwheel can
                              assist
                              with temporary accommodation if needed, for a fee of
                              <b>₦{{ number_format($hotel_fees) }}</b>.</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="mb-3 mt-2">
                        <label class="form-label" for="work_status">Current work status</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="current_work_status"
                            id="employed" value="employed" onchange="toggleEmployerVisibility()">
                          <label class="form-check-label" for="employed">Employed</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="current_work_status"
                            id="student" value="student" onchange="toggleStudentVisibility()">
                          <label class="form-check-label" for="student">Student</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="current_work_status"
                            id="self_employed" value="self-employed">
                          <label class="form-check-label" for="self_employed">Self-employed</label>
                        </div>
                      </div>

                      <div id="employer_details" class="col-12" style="display: none;">
                        <h6>Employer Details</h6>
                        <div class="row">
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="e_name">Employer Name</label>
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="employer_name" id="e_name"
                                  placeholder="Employer name" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="e_phone">Phone Number</label>
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="employer_telephone_number"
                                  id="e_phone" placeholder="Employer Phone"
                                  aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="home">Home Address</label>
                              <textarea name="employer_address" id="home" cols="30" rows="1" class="form-control"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="student_details" class="col-12" style="display: none;">
                        <h6>Student details</h6>
                        <div class="row">
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="school_name">Name of School</label>
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa fa-school"></i></span>
                                <input type="text" class="form-control" name="school_name" id="school_name"
                                  placeholder="Name of school" aria-describedby="basic-icon-default-fullname2" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="school_address">Address of School</label><br>
                              <textarea name="school_address" id="school_address" class="form-control" cols="20" rows="1"></textarea>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class=" d-flex justify-content-end"> <!-- Utilize d-flex and justify-content-end -->
              <button type="submit" class="btn btn-success">Proceed</button>
            </div>
          </div>

        </form>
      </div>
    </section>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Include Bootstrap DatePicker JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $(document).ready(function() {
         localStorage.removeItem('visaToken');
      // Initialize Bootstrap DatePicker for month input
      $('#month').datepicker({
        format: "mm",
        viewMode: "months",
        minViewMode: "months"
      });

      // Initialize Bootstrap DatePicker for year input
      $('#year').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"

      });
    });

    $(document).ready(function() {
      // Initialize Bootstrap DatePicker
      $('#datepicker').datepicker({
        format: "dd",
        autoclose: true,
        todayHighlight: true
      });
    });

    $('#month, #year, #datepicker').on('changeDate', function() {
      var month = $('#month').val();
      var year = $('#year').val();
      var date = $('#datepicker').datepicker('getDate');
      var day = date.getDate();
      var combinedDate = year + '-' + month + '-' + day;
      $('#combinedDate').val(combinedDate);
    });
    
      $(document).ready(function() {
  // Initialize Bootstrap DatePicker for day input
  $('#doi-day').datepicker({
    format: "dd",
    autoclose: true,
    todayHighlight: true
  });

  // Initialize Bootstrap DatePicker for month input
  $('#doi-month').datepicker({
    format: "mm",
    viewMode: "months",
    minViewMode: "months"
  });

  // Initialize Bootstrap DatePicker for year input
  $('#doi-year').datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
  });

  $('#doi-day, #doi-month, #doi-year').on('changeDate', function() {
    var day = $('#doi-day').datepicker('getDate').getDate();
    var month = $('#doi-month').datepicker('getDate').getMonth() + 1;
    var year = $('#doi-year').datepicker('getDate').getFullYear();
    var combinedDOI =  day + '-' + month + '-' + year;
    $('#combinedDOI').val(combinedDOI);
  });
});

  </script>
  <script>
    $(document).ready(function() {
      $('#yes').click(function() {
        $('#hotel').slideDown();
        $('#travelwheel_hotel').slideUp();
      });

      $('#no').click(function() {
        $('#hotel').slideUp();
        $('#travelwheel_hotel').slideDown();
        $('#h_home').val(''); // Clear hotel name input
      });
    });
  </script>
  <script>
    // Initialize tooltips
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>

  <script>
    $(document).ready(function() {
      // Toggle individual details
      $('#individual').change(function() {
        if ($(this).is(":checked")) {
          $('#individual_details').slideDown();
          $('#company_details, #hotel_details').slideUp();
        }
      });

      // Toggle company details
      $('#company').change(function() {
        if ($(this).is(":checked")) {
          $('#company_details').slideDown();
          $('#individual_details, #hotel_details').slideUp();
        }
      });

      // Toggle hotel details
      $('#none').change(function() {
        if ($(this).is(":checked")) {
          $('#hotel_details').slideDown();
          $('#individual_details, #company_details').slideUp();
        }
      });
    });
  </script>

  <script>
    // Function to toggle guardian information visibility and apply fade-down animation
    function toggleGuardianVisibility() {
      var guardianSection = document.getElementById("guardian");
      if (document.getElementById("minor").checked) {
        guardianSection.style.display = "block";
        guardianSection.classList.add("fade-down"); // Apply fade-down animation
      } else {
        guardianSection.style.display = "none";
        guardianSection.classList.remove("fade-down"); // Remove fade-down animation
      }
    }

    // Event listener for changes on the "minor" checkbox
    document.getElementById("minor").addEventListener("change", toggleGuardianVisibility);
  </script>
  <script>
    // Get the radio buttons and the text input field
    var othersRadio = document.getElementById("others");
    var othersInput = document.getElementById("others-input");

    // Add event listener to the "Others" radio button
    othersRadio.addEventListener("change", function() {
      if (this.checked) {
        // Show the text input field when "Others" radio button is checked
        othersInput.style.display = "inline-block";
        // Clear the input value when showing the input field
        othersInput.value = "";
      } else {
        // Hide the text input field when "Others" radio button is not checked
        othersInput.style.display = "none";
      }
    });

    // Get all radio buttons except "Others"
    var nonOthersRadios = document.querySelectorAll('input[name="passport_type"]:not(#others)');

    // Add event listener to all non-"Others" radio buttons
    nonOthersRadios.forEach(function(radio) {
      radio.addEventListener("change", function() {
        // Hide the text input field when any non-"Others" radio button is checked
        othersInput.style.display = "none";
      });
    });

    // Add event listener to the text input field for updating the "Others" radio button value
    othersInput.addEventListener("input", function() {
      // Update the value of the "Others" radio button as the user types
      othersRadio.value = this.value;
    });
  </script>
  <script>
    // Function to toggle employer details visibility and apply fade-down animation
    function toggleEmployerVisibility() {
      var employerDetails = document.getElementById("employer_details");
      if (document.getElementById("employed").checked) {
        employerDetails.style.display = "block";
        employerDetails.classList.add("fade-down"); // Apply fade-down animation
      } else {
        employerDetails.style.display = "none";
        employerDetails.classList.remove("fade-down"); // Remove fade-down animation
      }
    }

    // Function to toggle student details visibility and apply fade-down animation
    function toggleStudentVisibility() {
      var studentDetails = document.getElementById("student_details");
      if (document.getElementById("student").checked) {
        studentDetails.style.display = "block";
        studentDetails.classList.add("fade-down"); // Apply fade-down animation
      } else {
        studentDetails.style.display = "none";
        studentDetails.classList.remove("fade-down"); // Remove fade-down animation
      }
    }

    // Function to handle radio button changes
    function handleRadioButtonChange() {
      toggleEmployerVisibility();
      toggleStudentVisibility();
    }

    // Event listener for changes on the radio buttons
    var radioButtons = document.getElementsByName("current_work_status");
    for (var i = 0; i < radioButtons.length; i++) {
      radioButtons[i].addEventListener("change", handleRadioButtonChange);
    }
  </script>
  <script>
    $(document).ready(function() {
      // Add event listener to radio buttons with name "purpose_of_journey"
      $("input[name='purpose_of_journey']").change(function() {
        // Check if the "Others" radio button is checked
        if ($(this).val() === "others") {

          // Show the text input field when "Others" radio button is checked
          $("#others_purpose_input").show();
          // Clear the input value when showing the input field
          $("#others_purpose_input").val("");
        } else {

          // Hide the text input field when any other radio button is checked
          $("#others_purpose_input").hide();
        }
      });

      // Add event listener to the text input field for updating the "Others" radio button value
      $("#others_purpose_input").on("input", function() {
        // Update the value of the "Others" radio button as the user types
        $("#others_purpose").val($(this).val());
      });
    });
  </script>
  <script>
    // Get radio buttons and optional input fields
    const yesRadio = document.getElementById('yes_print');
    const noRadio = document.getElementById('no_print');
    const optionalInputs = document.getElementById('options');

    // Add event listener to radio buttons
    yesRadio.addEventListener('change', function() {
      // Show optional inputs if 'Yes' is selected
      if (this.checked) {
        optionalInputs.style.display = 'block';
      }
    });

    noRadio.addEventListener('change', function() {
      // Hide optional inputs if 'No' is selected
      if (this.checked) {
        optionalInputs.style.display = 'none';
      }
    });
  </script>
  <script>
    $('#inlineRadio11').change(function() {
      if ($(this).is(":checked")) {
        $('#other_country').show();

      }
    });
    $('#inlineRadio21').change(function() {
      if ($(this).is(":checked")) {
        $('#other_country').hide();
      }
    });
  </script>

  <script>
    // Get the return date from PHP variable
    const returnDate = "{{ $return }}";

    // Calculate the minimum allowed passport expiry date
    const sixMonthsLater = new Date(returnDate);
    sixMonthsLater.setMonth(sixMonthsLater.getMonth() + 6);

    // Format the minimum allowed date as "YYYY-MM-DD" for input field comparison
    const minPassportExpiryDate = sixMonthsLater.toISOString().split('T')[0];

    // Set the minimum allowed date for the passport expiry date input field
    document.getElementById("ped").setAttribute("min", minPassportExpiryDate);

    // Validate passport expiry date on form submission
    document.getElementById("myForm").addEventListener("submit", function(event) {
      const passportExpiryDate = document.getElementById("ped").value;
      const warning = document.getElementById('warning');
      if (passportExpiryDate < minPassportExpiryDate) {
        warning.removeAttribute("hidden");
        event.preventDefault(); // Prevent form submission
      } else {
        warning.setAttribute("hidden", "true");
      }
    });
  </script>
</body>

</html>
