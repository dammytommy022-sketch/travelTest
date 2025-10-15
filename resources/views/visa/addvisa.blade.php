@include('admin.layouts.nav')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h5>Add New Visa</h5>
                  </div>
                  <div class="col-6 text-end">
                    <a href="">Back To Visas</a>
                  </div>
                  @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                </div>
                <div class="row">
                  <div class="col-xl">
                    <div class="card mb-4">
                      <div class="card-body">
                        <form action="{{ route('form.visa') }}" enctype="multipart/form-data" method="POST">
                          @csrf
                          <div class="row">
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-company">Vendor</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class="bx bx-buildings"></i>
                                </span>
                                <input type="text" name="brand_name" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Email</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class="bx bx-envelope"></i>
                                </span>
                                <input type="text" name="email" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Phone No.</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class="bx bx-phone"></i>
                                </span>
                                <input type="text" name="phone_no" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Location</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="bx bx-map"></i>
                                </span>
                                <select name="location" id="smallSelect" class="form-select ">
                                  <option value="Abuja">Abuja</option>
                                  <option value="Lagos">Lagos</option>
                                  <option value="Kano">Kano</option>
                                </select>
                              </div>
                            </div>

                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Country</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-earth-africa"></i>
                                </span>
                                <select name="country" id="smallSelect" class="form-select ">
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
                                  <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                                  <option value="Costa Rica">Costa Rica</option>
                                  <option value="Croatia">Croatia</option>
                                  <option value="Cuba">Cuba</option>
                                  <option value="Cyprus">Cyprus</option>
                                  <option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
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
                                  <option value="Eswatini (fmr. "Swaziland")">Eswatini (fmr. "Swaziland")</option>
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
                                  <option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
                                  <option value="Namibia">Namibia</option>
                                  <option value="Nauru">Nauru</option>
                                  <option value="Nepal">Nepal</option>
                                  <option value="Netherlands">Netherlands</option>
                                  <option value="New Zealand">New Zealand</option>
                                  <option value="Nicaragua">Nicaragua</option>
                                  <option value="Niger">Niger</option>
                                  <option value="Nigeria">Nigeria</option>
                                  <option value="North Korea">North Korea</option>
                                  <option value="North Macedonia">North Macedonia</option>
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
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Processing Time</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-clock"></i>
                                </span>
                                <select name="Process_time" id="smallSelect" class="form-select ">
                                  <option value="Standard">Standard</option>
                                  <option value="Express">Express</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Visa Type</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-ticket"></i>
                                </span>
                                <select name="visa_type" id="smallSelect" class="form-select ">
                                  <option value="E-visa">E-visa</option>
                                  <option value="Sticker">Sticker</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Entry Type</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-right-to-bracket"></i>
                                </span>
                                <select name="entry" id="smallSelect" class="form-select ">
                                  <option value="Single">Single</option>
                                  <option value="Multiple">Multiple</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Processing Period</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-business-time'></i>
                                </span>
                                <input type="number" name="process" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Validity</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-clock'></i>
                                </span>
                                <input type="number" name="validity" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Admin Charge</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-user-tie'></i>
                                </span>
                                <input type="number" name="admin_charge" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Visa Fee is to be paid
                                to?</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-money-bill-wave"></i>
                                </span>
                                <select name="visa_payment_to" id="smallSelect" class="form-select ">
                                  <option value="travelwheel">TravelWheel</option>
                                  <option value="embassy">Embassy</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Fee - Adult</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='bx bxs-purchase-tag-alt'></i>
                                </span>
                                <input type="text" name="fee_adult" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Fee - Child</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='bx bxs-purchase-tag-alt'></i>
                                </span>
                                <input type="text" name="fee_child" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Fee - Infant</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='bx bxs-purchase-tag-alt'></i>
                                </span>
                                <input type="text" name="fee_infant" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-3">
                              <label class="form-label" for="basic-icon-default-email">Biometrics Fee - Adult</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-fingerprint'></i>
                                </span>
                                <input type="number" name="Biometrics_adult" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-2">
                              <label class="form-label" for="basic-icon-default-email">Biometrics Fee - Child</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-fingerprint'></i>
                                </span>
                                <input type="number" name="Biometrics_child" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-3">
                              <label class="form-label" for="basic-icon-default-email">Biometrics Fee - Infant</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-fingerprint'></i>
                                </span>
                                <input type="number" name="Biometrics_infant" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Biometrics Fee is to be paid
                                to?</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-money-bill-wave"></i>
                                </span>
                                <select name="bio_payment_to" id="smallSelect" class="form-select ">
                                  <option value="travelwheel">TravelWheel</option>
                                  <option value="embassy">Embassy</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                                <label class="form-label">Fillable Form (Optional, PDF only)</label>
    <input type="file" class="form-control" name="fillable_form" accept=".pdf">
    <small class="form-text text-muted">Upload a fillable PDF form if required for this visa.</small>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4"></div>
                            <hr>
                            <div class="mb-3 col-sm-6 col-md-4" style="margin-top:10px;">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                onchange="toggleElements()">
                              <label class="form-label" for="flexCheckDefault">Other Charges?</label>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4"></div>
                            <div class="mb-3 col-sm-6 col-md-4"></div>
                            <div class="mb-3 col-sm-6 col-md-3" style="">
                              <div class="" id="charge_charge" style="display: none">
                                <label class="form-label" for="basic-icon-default-phone">Charge is to be paid
                                  to?</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-phone2" class="input-group-text">
                                    <i class="fa fa-money-bill-wave"></i>
                                  </span>
                                  <select name="payment" id="smallSelect" class="form-select ">
                                    <option value="travelwheel">TravelWheel</option>
                                    <option value="embassy">Embassy</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-2" style="">
                              <div class="" id="charge_traveller" style="display: none">
                                <label class="form-label" for="basic-icon-default-phone">traveler</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-phone2" class="input-group-text">
                                    <i class="fa fa-money-bill-wave"></i>
                                  </span>
                                  <select name="traveller" id="smallSelect" class="form-select ">
                                    <option value="all">All</option>
                                    <option value="adult">adult</option>
                                    <option value="child">Child</option>
                                    <option value="infant">Infant</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-2" id="charge_name" style="display: none">
                              <label class="form-label" for="basic-icon-default-email">Charge name</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-coins'></i>
                                </span>
                                <input type="text" name="charge_name" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>

                            <div class="mb-3 col-sm-6 col-md-2" id="charge_amount" style="display: none">
                              <label class="form-label" for="basic-icon-default-email">Charge amount</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-coins'></i>
                                </span>
                                <input type="number" name="charge_amount" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-3" id="info" style="display: none">
                              <label class="form-label" for="basic-icon-default-email">Additional Information</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-info-circle'></i>
                                </span>
                                <input type="text" name="info" id="basic-icon-default-company"
                                  class="form-control" aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div id="additionalChargesContainer"></div>

                            <div class="input-group input-group-merge mt-1" id="charge_btn" style="display: none;">
                              <button type="button" class="btn btn-sm btn-primary" onclick="addMoreCharge()">+ Add
                                more charge</button>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label for="document">Required Documents - Adult</label>
                              <select class="selectpicker" name="document_adult[]" multiple
                                aria-label="size 3 select example">
                                @foreach ($requiredDocuments as $document)
                                  <option value="{{ $document->document_name }}">{{ $document->document_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label for="document">Required Documents - Child</label>
                              <select class="selectpicker" name="document_child[]" multiple
                                aria-label="size 3 select example">
                                @foreach ($requiredDocuments as $document)
                                  <option value="{{ $document->document_name }}">{{ $document->document_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label for="document">Required Documents - infant</label>
                              <select class="selectpicker" name="document_infant[]" multiple
                                aria-label="size 3 select example">
                                @foreach ($requiredDocuments as $document)
                                  <option value="{{ $document->document_name }}">{{ $document->document_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            {{-- <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Picture 3</label>
                              <input class="form-control" name="pics3" type="file" id="formFile" />
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Picture 4</label>
                              <input class="form-control" name="pics4" type="file" id="formFile" />
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Picture 5</label>
                              <input class="form-control" name="pics5" type="file" id="formFile" />
                            </div> --}}
                            <div class="mb-3 col-sm-6 col-md-4">
                              <div class="input-group input-group-merge">
                                <button type="submit" class="btn btn-primary">Create Visa</button>
                              </div>
                            </div>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </div>
                <div class="row"> -->
    </div>


  </div>

  <script>
    function toggleElements() {
      var checkbox = document.getElementById('flexCheckDefault');
      var chargeName = document.getElementById('charge_name');
      var chargeAmount = document.getElementById('charge_amount');
      var info = document.getElementById('info');
      var embassy = document.getElementById('charge_charge');
      var embassy1 = document.getElementById('charge_traveller');
      var btn = document.getElementById('charge_btn');


      if (checkbox.checked) {
        chargeName.style.display = 'block';
        chargeAmount.style.display = 'block';
        info.style.display = 'block';
        embassy.style.display = 'block';
        embassy1.style.display = 'block';
        btn.style.display = 'block';
      } else {
        chargeName.style.display = 'none';
        chargeAmount.style.display = 'none';
        embassy1.style.display = 'none';
        info.style.display = 'none';
        embassy.style.display = 'none';
        btn.style.display = 'none';
      }
    }
  </script>
  <script>
    let chargeCounter = 0; // Counter for unique charge identifiers

    function addMoreCharge() {
      chargeCounter++; // Increment the counter
      // HTML for charge input fields with unique identifiers
      var html = `
<div class="row">
  <div class="mb-3 col-sm-6 col-md-3">
    <label class="form-label" for="charge_to_${chargeCounter}">Charge is to be paid to?</label>
    <div class="input-group input-group-merge">
      <span class="input-group-text">
        <i class="fa fa-money-bill-wave"></i>
      </span>
      <select name="payment_${chargeCounter}" class="form-select">
        <option value="travelwheel">TravelWheel</option>
        <option value="embassy">Embassy</option>
      </select>
    </div>
  </div>
  <div class="mb-3 col-sm-6 col-md-2">
    <label class="form-label" for="traveller_${chargeCounter}">Traveller</label>
    <div class="input-group input-group-merge">
      <span class="input-group-text">
        <i class="fa fa-user"></i>
      </span>
      <select name="traveller_${chargeCounter}" class="form-select">
        <option value="all">All</option>
        <option value="adult">Adult</option>
        <option value="child">Child</option>
        <option value="infant">Infant</option>
      </select>
    </div>
  </div>
  <div class="mb-3 col-sm-6 col-md-2" id="charge_name_${chargeCounter}">
    <label class="form-label" for="charge_name_${chargeCounter}">Charge name</label>
    <div class="input-group input-group-merge">
      <span class="input-group-text">
        <i class='fa fa-coins'></i>
      </span>
      <input type="text" name="charge_name_${chargeCounter}" class="form-control" id="charge_name_${chargeCounter}" aria-describedby="basic-icon-default-company2">
    </div>
  </div>
  <div class="mb-3 col-sm-6 col-md-2" id="charge_amount_${chargeCounter}">
    <label class="form-label" for="charge_amount_${chargeCounter}">Charge amount</label>
    <div class="input-group input-group-merge">
      <span class="input-group-text">
        <i class='fa fa-coins'></i>
      </span>
      <input type="number" name="charge_amount_${chargeCounter}" class="form-control" id="charge_amount_${chargeCounter}" aria-describedby="basic-icon-default-company2">
    </div>
  </div>
  <div class="mb-3 col-sm-6 col-md-2" id="charge_info_${chargeCounter}">
    <label class="form-label" for="charge_info_${chargeCounter}">Additional Information</label>
    <div class="input-group input-group-merge">
      <span class="input-group-text">
        <i class='fa fa-info-circle'></i>
      </span>
      <input type="text" name="charge_info_${chargeCounter}" class="form-control" id="charge_info_${chargeCounter}" aria-describedby="basic-icon-default-company2">
    </div>
  </div>
  <div class="mb-3 col-sm-6 col-md-1">
    <div class="input-group">
      <button type="button" class="btn btn-danger mt-4" onclick="removeCharge(this)"><i class="fa fa-trash"></i></button>
    </div>
  </div>
</div>
`;
      // Create a container div and insert the HTML
      var container = document.createElement('div');
      container.innerHTML = html;
      // Append the container to the main container
      document.getElementById('additionalChargesContainer').appendChild(container);
    }

    function removeCharge(element) {
      // Remove the entire row containing the charge input fields
      element.closest('.row').remove();
    }
  </script>


  <!-- / Content -->
  @include('admin.layouts.footer')
