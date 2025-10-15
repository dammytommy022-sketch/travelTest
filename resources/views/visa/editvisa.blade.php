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
                        <form action="{{ route('update.visa') }}" method="POST">
                          @csrf
                          <input type="hidden" name="country_id" value="{{ $visas->country_id }}">
                          <div class="row">
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-company">Vendor</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class="bx bx-buildings"></i>
                                </span>
                                <input type="text" value="{{ $visas->brand }}" name="brand_name"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Email</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class="bx bx-envelope"></i>
                                </span>
                                <input type="text" value="{{ $visas->email }}" name="email"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Phone No.</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class="bx bx-phone"></i>
                                </span>
                                <input type="text" value="{{ $visas->number }}" name="phone_no"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Location</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="bx bx-map"></i>
                                </span>
                                <select name="location" id="smallSelect" class="form-select">
                                  <option value="Abuja" {{ $visas->location == 'Abuja' ? 'selected' : '' }}>Abuja
                                  </option>
                                  <option value="Lagos" {{ $visas->location == 'Lagos' ? 'selected' : '' }}>Lagos
                                  </option>
                                  <option value="Kano" {{ $visas->location == 'Kano' ? 'selected' : '' }}>Kano
                                  </option>
                                </select>
                              </div>
                            </div>

                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-phone">Country</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                  <i class="fa fa-earth-africa"></i>
                                </span>
                                <select name="country" id="smallSelect" class="form-select">
                                  <option value="nigeria"
                                    {{ $countries[$visas->country_id] == 'nigeria' ? 'selected' : '' }}>
                                    Nigeria</option>
                                  <option value="Afghanistan"
                                    {{ $countries[$visas->country_id] == 'Afghanistan' ? 'selected' : '' }}>
                                    Afghanistan</option>
                                  <option value="Albania"
                                    {{ $countries[$visas->country_id] == 'Albania' ? 'selected' : '' }}>
                                    Albania</option>
                                  <option value="Algeria"
                                    {{ $countries[$visas->country_id] == 'Algeria' ? 'selected' : '' }}>
                                    Algeria</option>
                                  <option value="Andorra"
                                    {{ $countries[$visas->country_id] == 'Andorra' ? 'selected' : '' }}>
                                    Andorra</option>
                                  <option value="Angola"
                                    {{ $countries[$visas->country_id] == 'Angola' ? 'selected' : '' }}>Angola
                                  </option>
                                   <option value="Antigua and Barbuda"
                                    {{  $countries[$visas->country_id]  == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and
                                    Barbuda</option>
                                  <option value="Argentina" {{  $countries[$visas->country_id]  == 'Argentina' ? 'selected' : '' }}>
                                    Argentina</option>
                                  <option value="Armenia" {{  $countries[$visas->country_id]  == 'Armenia' ? 'selected' : '' }}>
                                    Armenia</option>
                                  <option value="Australia" {{  $countries[$visas->country_id]  == 'Australia' ? 'selected' : '' }}>
                                    Australia</option>
                                  <option value="Austria" {{  $countries[$visas->country_id]  == 'Austria' ? 'selected' : '' }}>
                                    Austria</option>
                                  <option value="Azerbaijan"
                                    {{  $countries[$visas->country_id]  == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                  <option value="Bahamas" {{  $countries[$visas->country_id]  == 'Bahamas' ? 'selected' : '' }}>
                                    Bahamas</option>
                                  <option value="Bahrain" {{  $countries[$visas->country_id]  == 'Bahrain' ? 'selected' : '' }}>
                                    Bahrain</option>
                                  <option value="Bangladesh"
                                    {{  $countries[$visas->country_id]  == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                  <option value="Barbados" {{  $countries[$visas->country_id]  == 'Barbados' ? 'selected' : '' }}>
                                    Barbados</option>
                                  <option value="Belarus" {{  $countries[$visas->country_id]  == 'Belarus' ? 'selected' : '' }}>
                                    Belarus</option>
                                  <option value="Belgium" {{  $countries[$visas->country_id]  == 'Belgium' ? 'selected' : '' }}>
                                    Belgium</option>
                                  <option value="Belize" {{  $countries[$visas->country_id]  == 'Belize' ? 'selected' : '' }}>Belize
                                  </option>
                                  <option value="Benin" {{  $countries[$visas->country_id]  == 'Benin' ? 'selected' : '' }}>Benin
                                  </option>
                                  <option value="Bhutan" {{  $countries[$visas->country_id]  == 'Bhutan' ? 'selected' : '' }}>Bhutan
                                  </option>
                                  <option value="Bolivia" {{  $countries[$visas->country_id]  == 'Bolivia' ? 'selected' : '' }}>
                                    Bolivia</option>
                                  <option value="Bosnia and Herzegovina"
                                    {{  $countries[$visas->country_id]  == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and
                                    Herzegovina</option>
                                  <option value="Botswana" {{  $countries[$visas->country_id]  == 'Botswana' ? 'selected' : '' }}>
                                    Botswana</option>
                                  <option value="Brazil" {{  $countries[$visas->country_id]  == 'Brazil' ? 'selected' : '' }}>Brazil
                                  </option>
                                  <option value="Brunei" {{  $countries[$visas->country_id]  == 'Brunei' ? 'selected' : '' }}>Brunei
                                  </option>
                                  <option value="Bulgaria" {{  $countries[$visas->country_id]  == 'Bulgaria' ? 'selected' : '' }}>
                                    Bulgaria</option>
                                  <option value="Burkina Faso"
                                    {{  $countries[$visas->country_id]  == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                  <option value="Burundi" {{  $countries[$visas->country_id]  == 'Burundi' ? 'selected' : '' }}>
                                    Burundi</option>
                                  <option value="Cabo Verde"
                                    {{  $countries[$visas->country_id]  == 'Cabo Verde' ? 'selected' : '' }}>Cabo Verde</option>
                                  <option value="Cambodia" {{  $countries[$visas->country_id]  == 'Cambodia' ? 'selected' : '' }}>
                                    Cambodia</option>
                                  <option value="Cameroon" {{  $countries[$visas->country_id]  == 'Cameroon' ? 'selected' : '' }}>
                                    Cameroon</option>
                                  <option value="Canada" {{  $countries[$visas->country_id]  == 'Canada' ? 'selected' : '' }}>Canada
                                  </option>
                                  <option value="Central African Republic"
                                    {{  $countries[$visas->country_id]  == 'Central African Republic' ? 'selected' : '' }}>Central
                                    African Republic</option>
                                  <option value="Chad" {{  $countries[$visas->country_id]  == 'Chad' ? 'selected' : '' }}>Chad
                                  </option>
                                  <option value="Chile" {{  $countries[$visas->country_id]  == 'Chile' ? 'selected' : '' }}>Chile
                                  </option>
                                  <option value="China" {{  $countries[$visas->country_id]  == 'China' ? 'selected' : '' }}>China
                                  </option>
                                  <option value="Colombia" {{  $countries[$visas->country_id]  == 'Colombia' ? 'selected' : '' }}>
                                    Colombia</option>
                                  <option value="Comoros" {{  $countries[$visas->country_id]  == 'Comoros' ? 'selected' : '' }}>
                                    Comoros</option>
                                  <option value="Congo" {{  $countries[$visas->country_id]  == 'Congo' ? 'selected' : '' }}>Congo
                                    (Congo-Brazzaville)</option>
                                  <option value="Costa Rica"
                                    {{  $countries[$visas->country_id]  == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                  <option value="Croatia" {{  $countries[$visas->country_id]  == 'Croatia' ? 'selected' : '' }}>
                                    Croatia</option>
                                  <option value="Cuba" {{  $countries[$visas->country_id]  == 'Cuba' ? 'selected' : '' }}>Cuba
                                  </option>
                                  <option value="Cyprus" {{  $countries[$visas->country_id]  == 'Cyprus' ? 'selected' : '' }}>Cyprus
                                  </option>
                                  <option value="Czechia" {{  $countries[$visas->country_id]  == 'Czechia' ? 'selected' : '' }}>
                                    Czechia (Czech Republic)</option>
                                  <option value="Democratic Republic of the Congo"
                                    {{  $countries[$visas->country_id]  == 'Democratic Republic of the Congo' ? 'selected' : '' }}>
                                    Democratic Republic of the Congo</option>
                                  <option value="Denmark" {{  $countries[$visas->country_id]  == 'Denmark' ? 'selected' : '' }}>
                                    Denmark</option>
                                  <option value="Djibouti" {{  $countries[$visas->country_id]  == 'Djibouti' ? 'selected' : '' }}>
                                    Djibouti</option>
                                  <option value="Dominica" {{  $countries[$visas->country_id]  == 'Dominica' ? 'selected' : '' }}>
                                    Dominica</option>
                                  <option value="Dominican Republic"
                                    {{  $countries[$visas->country_id]  == 'Dominican Republic' ? 'selected' : '' }}>Dominican
                                    Republic</option>
                                  <option value="Ecuador" {{  $countries[$visas->country_id]  == 'Ecuador' ? 'selected' : '' }}>
                                    Ecuador</option>
                                  <option value="Egypt" {{  $countries[$visas->country_id]  == 'Egypt' ? 'selected' : '' }}>Egypt
                                  </option>
                                  <option value="El Salvador"
                                    {{  $countries[$visas->country_id]  == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                  <option value="Equatorial Guinea"
                                    {{  $countries[$visas->country_id]  == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea
                                  </option>
                                  <option value="Eritrea" {{  $countries[$visas->country_id]  == 'Eritrea' ? 'selected' : '' }}>
                                    Eritrea</option>
                                  <option value="Estonia" {{  $countries[$visas->country_id]  == 'Estonia' ? 'selected' : '' }}>
                                    Estonia</option>
                                  <option value="Eswatini" {{  $countries[$visas->country_id]  == 'Eswatini' ? 'selected' : '' }}>
                                    Eswatini (fmr. "Swaziland")</option>
                                  <option value="Ethiopia" {{  $countries[$visas->country_id]  == 'Ethiopia' ? 'selected' : '' }}>
                                    Ethiopia</option>
                                  <option value="Fiji" {{  $countries[$visas->country_id]  == 'Fiji' ? 'selected' : '' }}>Fiji
                                  </option>
                                  <option value="Finland" {{  $countries[$visas->country_id]  == 'Finland' ? 'selected' : '' }}>
                                    Finland</option>
                                  <option value="France" {{  $countries[$visas->country_id]  == 'France' ? 'selected' : '' }}>France
                                  </option>
                                  <option value="Gabon" {{  $countries[$visas->country_id]  == 'Gabon' ? 'selected' : '' }}>Gabon
                                  </option>
                                  <option value="Gambia" {{  $countries[$visas->country_id]  == 'Gambia' ? 'selected' : '' }}>Gambia
                                  </option>
                                  <option value="Georgia" {{  $countries[$visas->country_id]  == 'Georgia' ? 'selected' : '' }}>
                                    Georgia</option>
                                  <option value="Germany" {{  $countries[$visas->country_id]  == 'Germany' ? 'selected' : '' }}>
                                    Germany</option>
                                  <option value="Ghana" {{  $countries[$visas->country_id]  == 'Ghana' ? 'selected' : '' }}>Ghana
                                  </option>
                                  <option value="Greece" {{  $countries[$visas->country_id]  == 'Greece' ? 'selected' : '' }}>Greece
                                  </option>
                                  <option value="Grenada" {{  $countries[$visas->country_id]  == 'Grenada' ? 'selected' : '' }}>
                                    Grenada</option>
                                  <option value="Guatemala" {{  $countries[$visas->country_id]  == 'Guatemala' ? 'selected' : '' }}>
                                    Guatemala</option>
                                  <option value="Guinea" {{  $countries[$visas->country_id]  == 'Guinea' ? 'selected' : '' }}>Guinea
                                  </option>
                                  <option value="Guinea-Bissau"
                                    {{  $countries[$visas->country_id]  == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau
                                  </option>
                                  <option value="Guyana" {{  $countries[$visas->country_id]  == 'Guyana' ? 'selected' : '' }}>Guyana
                                  </option>
                                  <option value="Haiti" {{  $countries[$visas->country_id]  == 'Haiti' ? 'selected' : '' }}>Haiti
                                  </option>
                                  <option value="Holy See" {{  $countries[$visas->country_id]  == 'Holy See' ? 'selected' : '' }}>
                                    Holy See</option>
                                  <option value="Honduras" {{  $countries[$visas->country_id]  == 'Honduras' ? 'selected' : '' }}>
                                    Honduras</option>
                                  <option value="Hungary" {{  $countries[$visas->country_id]  == 'Hungary' ? 'selected' : '' }}>
                                    Hungary</option>
                                  <option value="Iceland" {{  $countries[$visas->country_id]  == 'Iceland' ? 'selected' : '' }}>
                                    Iceland</option>
                                  <option value="India" {{  $countries[$visas->country_id]  == 'India' ? 'selected' : '' }}>India
                                  </option>
                                  <option value="Indonesia" {{  $countries[$visas->country_id]  == 'Indonesia' ? 'selected' : '' }}>
                                    Indonesia</option>
                                  <option value="Iran" {{  $countries[$visas->country_id]  == 'Iran' ? 'selected' : '' }}>Iran
                                  </option>
                                  <option value="Iraq" {{  $countries[$visas->country_id]  == 'Iraq' ? 'selected' : '' }}>Iraq
                                  </option>
                                  <option value="Ireland" {{  $countries[$visas->country_id]  == 'Ireland' ? 'selected' : '' }}>
                                    Ireland</option>
                                  <option value="Israel" {{  $countries[$visas->country_id]  == 'Israel' ? 'selected' : '' }}>Israel
                                  </option>
                                  <option value="Italy" {{  $countries[$visas->country_id]  == 'Italy' ? 'selected' : '' }}>Italy
                                  </option>
                                  <option value="Jamaica" {{  $countries[$visas->country_id]  == 'Jamaica' ? 'selected' : '' }}>
                                    Jamaica</option>
                                  <option value="Japan" {{  $countries[$visas->country_id]  == 'Japan' ? 'selected' : '' }}>Japan
                                  </option>
                                  <option value="Jordan" {{  $countries[$visas->country_id]  == 'Jordan' ? 'selected' : '' }}>Jordan
                                  </option>
                                  <option value="Kazakhstan"
                                    {{  $countries[$visas->country_id]  == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                  <option value="Kenya" {{  $countries[$visas->country_id]  == 'Kenya' ? 'selected' : '' }}>Kenya
                                  </option>
                                  <option value="Kiribati" {{  $countries[$visas->country_id]  == 'Kiribati' ? 'selected' : '' }}>
                                    Kiribati</option>
                                  <option value="Kuwait" {{  $countries[$visas->country_id]  == 'Kuwait' ? 'selected' : '' }}>Kuwait
                                  </option>
                                  <option value="Kyrgyzstan"
                                    {{  $countries[$visas->country_id]  == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                                  <option value="Laos" {{  $countries[$visas->country_id]  == 'Laos' ? 'selected' : '' }}>Laos
                                  </option>
                                  <option value="Latvia" {{  $countries[$visas->country_id]  == 'Latvia' ? 'selected' : '' }}>
                                    Latvia</option>
                                  <option value="Lebanon" {{  $countries[$visas->country_id]  == 'Lebanon' ? 'selected' : '' }}>
                                    Lebanon</option>
                                  <option value="Lesotho" {{  $countries[$visas->country_id]  == 'Lesotho' ? 'selected' : '' }}>
                                    Lesotho</option>
                                  <option value="Liberia" {{  $countries[$visas->country_id]  == 'Liberia' ? 'selected' : '' }}>
                                    Liberia</option>
                                  <option value="Libya" {{  $countries[$visas->country_id]  == 'Libya' ? 'selected' : '' }}>Libya
                                  </option>
                                  <option value="Liechtenstein"
                                    {{  $countries[$visas->country_id]  == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein
                                  </option>
                                  <option value="Lithuania"
                                    {{  $countries[$visas->country_id]  == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                  <option value="Luxembourg"
                                    {{  $countries[$visas->country_id]  == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                  <option value="Madagascar"
                                    {{  $countries[$visas->country_id]  == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                  <option value="Malawi" {{  $countries[$visas->country_id]  == 'Malawi' ? 'selected' : '' }}>
                                    Malawi</option>
                                  <option value="Malaysia" {{  $countries[$visas->country_id]  == 'Malaysia' ? 'selected' : '' }}>
                                    Malaysia</option>
                                  <option value="Maldives" {{  $countries[$visas->country_id]  == 'Maldives' ? 'selected' : '' }}>
                                    Maldives</option>
                                  <option value="Mali" {{  $countries[$visas->country_id]  == 'Mali' ? 'selected' : '' }}>Mali
                                  </option>
                                  <option value="Malta" {{  $countries[$visas->country_id]  == 'Malta' ? 'selected' : '' }}>Malta
                                  </option>
                                  <option value="Marshall Islands"
                                    {{  $countries[$visas->country_id]  == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands
                                  </option>
                                  <option value="Mauritania"
                                    {{  $countries[$visas->country_id]  == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                                  <option value="Mauritius"
                                    {{  $countries[$visas->country_id]  == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                                  <option value="Mexico" {{  $countries[$visas->country_id]  == 'Mexico' ? 'selected' : '' }}>
                                    Mexico</option>
                                  <option value="Micronesia"
                                    {{  $countries[$visas->country_id]  == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                                  <option value="Moldova" {{  $countries[$visas->country_id]  == 'Moldova' ? 'selected' : '' }}>
                                    Moldova</option>
                                  <option value="Monaco" {{  $countries[$visas->country_id]  == 'Monaco' ? 'selected' : '' }}>
                                    Monaco</option>
                                  <option value="Mongolia" {{  $countries[$visas->country_id]  == 'Mongolia' ? 'selected' : '' }}>
                                    Mongolia</option>
                                  <option value="Montenegro"
                                    {{  $countries[$visas->country_id]  == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                                  <option value="Morocco" {{  $countries[$visas->country_id]  == 'Morocco' ? 'selected' : '' }}>
                                    Morocco</option>
                                  <option value="Mozambique"
                                    {{  $countries[$visas->country_id]  == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                  <option value="Myanmar" {{  $countries[$visas->country_id]  == 'Myanmar' ? 'selected' : '' }}>
                                    Myanmar (formerly Burma)</option>
                                  <option value="Namibia" {{  $countries[$visas->country_id]  == 'Namibia' ? 'selected' : '' }}>
                                    Namibia</option>
                                  <option value="Nauru" {{  $countries[$visas->country_id]  == 'Nauru' ? 'selected' : '' }}>Nauru
                                  </option>
                                  <option value="Nepal" {{  $countries[$visas->country_id]  == 'Nepal' ? 'selected' : '' }}>Nepal
                                  </option>
                                  <option value="Netherlands"
                                    {{  $countries[$visas->country_id]  == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                  <option value="New Zealand"
                                    {{  $countries[$visas->country_id]  == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                  <option value="Nicaragua"
                                    {{  $countries[$visas->country_id]  == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                  <option value="Niger" {{  $countries[$visas->country_id]  == 'Niger' ? 'selected' : '' }}>Niger
                                  </option>
                                  <option value="North Korea"
                                    {{  $countries[$visas->country_id]  == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                                  <option value="North Macedonia"
                                    {{  $countries[$visas->country_id]  == 'North Macedonia' ? 'selected' : '' }}>North Macedonia
                                    (formerly Macedonia)</option>
                                  <option value="Norway" {{  $countries[$visas->country_id]  == 'Norway' ? 'selected' : '' }}>
                                    Norway</option>
                                  <option value="Oman" {{  $countries[$visas->country_id]  == 'Oman' ? 'selected' : '' }}>Oman
                                  </option>
                                  <option value="Pakistan" {{  $countries[$visas->country_id]  == 'Pakistan' ? 'selected' : '' }}>
                                    Pakistan</option>
                                  <option value="Palau" {{  $countries[$visas->country_id]  == 'Palau' ? 'selected' : '' }}>Palau
                                  </option>
                                  <option value="Palestine State"
                                    {{  $countries[$visas->country_id]  == 'Palestine State' ? 'selected' : '' }}>Palestine State
                                  </option>
                                  <option value="Panama" {{  $countries[$visas->country_id]  == 'Panama' ? 'selected' : '' }}>
                                    Panama</option>
                                  <option value="Papua New Guinea"
                                    {{  $countries[$visas->country_id]  == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea
                                  </option>
                                  <option value="Paraguay" {{  $countries[$visas->country_id]  == 'Paraguay' ? 'selected' : '' }}>
                                    Paraguay</option>
                                  <option value="Peru" {{  $countries[$visas->country_id]  == 'Peru' ? 'selected' : '' }}>Peru
                                  </option>
                                  <option value="Philippines"
                                    {{  $countries[$visas->country_id]  == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                  <option value="Poland" {{  $countries[$visas->country_id]  == 'Poland' ? 'selected' : '' }}>
                                    Poland</option>
                                  <option value="Portugal" {{  $countries[$visas->country_id]  == 'Portugal' ? 'selected' : '' }}>
                                    Portugal</option>
                                  <option value="Qatar" {{  $countries[$visas->country_id]  == 'Qatar' ? 'selected' : '' }}>Qatar
                                  </option>
                                  <option value="Romania" {{  $countries[$visas->country_id]  == 'Romania' ? 'selected' : '' }}>
                                    Romania</option>
                                  <option value="Russia" {{  $countries[$visas->country_id]  == 'Russia' ? 'selected' : '' }}>
                                    Russia</option>
                                  <option value="Rwanda" {{  $countries[$visas->country_id]  == 'Rwanda' ? 'selected' : '' }}>
                                    Rwanda</option>
                                  <option value="Saint Kitts and Nevis"
                                    {{  $countries[$visas->country_id]  == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts
                                    and Nevis</option>
                                  <option value="Saint Lucia"
                                    {{  $countries[$visas->country_id]  == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                                  <option value="Saint Vincent and the Grenadines"
                                    {{  $countries[$visas->country_id]  == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>
                                    Saint Vincent and the Grenadines</option>
                                  <option value="Samoa" {{  $countries[$visas->country_id]  == 'Samoa' ? 'selected' : '' }}>Samoa
                                  </option>
                                  <option value="San Marino"
                                    {{  $countries[$visas->country_id]  == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                                  <option value="Sao Tome and Principe"
                                    {{  $countries[$visas->country_id]  == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and
                                    Principe</option>
                                  <option value="Saudi Arabia"
                                    {{  $countries[$visas->country_id]  == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                  <option value="Senegal" {{  $countries[$visas->country_id]  == 'Senegal' ? 'selected' : '' }}>
                                    Senegal</option>
                                  <option value="Serbia" {{  $countries[$visas->country_id]  == 'Serbia' ? 'selected' : '' }}>
                                    Serbia</option>
                                  <option value="Seychelles"
                                    {{  $countries[$visas->country_id]  == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                  <option value="Sierra Leone"
                                    {{  $countries[$visas->country_id]  == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                  <option value="Singapore"
                                    {{  $countries[$visas->country_id]  == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                  <option value="Slovakia" {{  $countries[$visas->country_id]  == 'Slovakia' ? 'selected' : '' }}>
                                    Slovakia</option>
                                  <option value="Slovenia" {{  $countries[$visas->country_id]  == 'Slovenia' ? 'selected' : '' }}>
                                    Slovenia</option>
                                  <option value="Solomon Islands"
                                    {{  $countries[$visas->country_id]  == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands
                                  </option>
                                  <option value="Somalia" {{  $countries[$visas->country_id]  == 'Somalia' ? 'selected' : '' }}>
                                    Somalia</option>
                                  <option value="South Africa"
                                    {{  $countries[$visas->country_id]  == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                  <option value="South Korea"
                                    {{  $countries[$visas->country_id]  == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                  <option value="South Sudan"
                                    {{  $countries[$visas->country_id]  == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                                  <option value="Spain" {{  $countries[$visas->country_id]  == 'Spain' ? 'selected' : '' }}>Spain
                                  </option>
                                  <option value="Sri Lanka"
                                    {{  $countries[$visas->country_id]  == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                  <option value="Sudan" {{  $countries[$visas->country_id]  == 'Sudan' ? 'selected' : '' }}>Sudan
                                  </option>
                                  <option value="Suriname" {{  $countries[$visas->country_id]  == 'Suriname' ? 'selected' : '' }}>
                                    Suriname</option>
                                  <option value="Sweden" {{  $countries[$visas->country_id]  == 'Sweden' ? 'selected' : '' }}>
                                    Sweden</option>
                                  <option value="Switzerland"
                                    {{  $countries[$visas->country_id]  == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                  <option value="Syria" {{  $countries[$visas->country_id]  == 'Syria' ? 'selected' : '' }}>Syria
                                  </option>
                                  <option value="Tajikistan"
                                    {{  $countries[$visas->country_id]  == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                                  <option value="Tanzania" {{  $countries[$visas->country_id]  == 'Tanzania' ? 'selected' : '' }}>
                                    Tanzania</option>
                                  <option value="Thailand" {{  $countries[$visas->country_id]  == 'Thailand' ? 'selected' : '' }}>
                                    Thailand</option>
                                  <option value="Timor-Leste"
                                    {{  $countries[$visas->country_id]  == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
                                  <option value="Togo" {{  $countries[$visas->country_id]  == 'Togo' ? 'selected' : '' }}>Togo
                                  </option>
                                  <option value="Tonga" {{  $countries[$visas->country_id]  == 'Tonga' ? 'selected' : '' }}>Tonga
                                  </option>
                                  <option value="Trinidad and Tobago"
                                    {{  $countries[$visas->country_id]  == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and
                                    Tobago</option>
                                  <option value="Tunisia" {{  $countries[$visas->country_id]  == 'Tunisia' ? 'selected' : '' }}>
                                    Tunisia</option>
                                  <option value="Turkey" {{  $countries[$visas->country_id]  == 'Turkey' ? 'selected' : '' }}>
                                    Turkey</option>
                                  <option value="Turkmenistan"
                                    {{  $countries[$visas->country_id]  == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                                  <option value="Tuvalu" {{  $countries[$visas->country_id]  == 'Tuvalu' ? 'selected' : '' }}>
                                    Tuvalu</option>
                                  <option value="Uganda" {{  $countries[$visas->country_id]  == 'Uganda' ? 'selected' : '' }}>
                                    Uganda</option>
                                  <option value="Ukraine" {{  $countries[$visas->country_id]  == 'Ukraine' ? 'selected' : '' }}>
                                    Ukraine</option>
                                  <option value="United Arab Emirates"
                                    {{  $countries[$visas->country_id]  == 'United Arab Emirates' ? 'selected' : '' }}>United Arab
                                    Emirates</option>
                                  <option value="United Kingdom"
                                    {{  $countries[$visas->country_id]  == 'United Kingdom' ? 'selected' : '' }}>United Kingdom
                                  </option>
                                  <option value="United States of America"
                                    {{  $countries[$visas->country_id]  == 'United States of America' ? 'selected' : '' }}>United
                                    States of America</option>
                                  <option value="Uruguay" {{  $countries[$visas->country_id]  == 'Uruguay' ? 'selected' : '' }}>
                                    Uruguay</option>
                                  <option value="Uzbekistan"
                                    {{  $countries[$visas->country_id]  == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                  <option value="Vanuatu" {{  $countries[$visas->country_id]  == 'Vanuatu' ? 'selected' : '' }}>
                                    Vanuatu</option>
                                  <option value="Venezuela"
                                    {{  $countries[$visas->country_id]  == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                  <option value="Vietnam" {{  $countries[$visas->country_id]  == 'Vietnam' ? 'selected' : '' }}>
                                    Vietnam</option>
                                  <option value="Yemen" {{  $countries[$visas->country_id]  == 'Yemen' ? 'selected' : '' }}>Yemen
                                  </option>
                                  <option value="Zambia" {{  $countries[$visas->country_id]  == 'Zambia' ? 'selected' : '' }}>
                                    Zambia</option>
                                  <option value="Zimbabwe" {{  $countries[$visas->country_id]  == 'Zimbabwe' ? 'selected' : '' }}>
                                    Zimbabwe</option>
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
                                  <option value="E-visa" {{ $visas->visa_type_name == 'E-visa' ? 'selected' : '' }}>
                                    E-visa
                                  </option>
                                  <option value="Sticker" {{ $visas->visa_type_name == 'Sticker' ? 'selected' : '' }}>
                                    Sticker</option>
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
                                  <option value="Single" {{ $visas->entry == 'Single' ? 'selected' : '' }}>Single
                                  </option>
                                  <option value="Multiple" {{ $visas->entry == 'Multiple' ? 'selected' : '' }}>
                                    Multiple</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Processing Period</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-business-time'></i>
                                </span>
                                <input type="number" value="{{ $visas->processing_period }}" name="process"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Validity</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-clock'></i>
                                </span>
                                <input type="number" value="{{ $visas->visa_validity }}" name="validity"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Admin Charge</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-user-tie'></i>
                                </span>
                                <input type="number"value="{{ $visas->admin_charge }}" name="admin_charge"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
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
                                  <option value="travelwheel"
                                    {{ $visas->visa_payment_to == 'travelwheel' ? 'selected' : '' }}>TravelWheel
                                  </option>
                                  <option value="embassy"
                                    {{ $visas->visa_payment_to == 'embassy' ? 'selected' : '' }}>Embassy</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Fee - Adult</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='bx bxs-purchase-tag-alt'></i>
                                </span>
                                <input type="text" value="{{ $visas->visa_fee }}" name="fee_adult"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Fee - Child</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='bx bxs-purchase-tag-alt'></i>
                                </span>
                                <input type="text" value="{{ $visas->child_visa_fee }}" name="fee_child"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Visa Fee - Infant</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='bx bxs-purchase-tag-alt'></i>
                                </span>
                                <input type="text" value="{{ $visas->infant_visa_fee }}" name="fee_infant"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
                              </div>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label class="form-label" for="basic-icon-default-email">Biometrics Fee</label>
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text">
                                  <i class='fa fa-fingerprint'></i>
                                </span>
                                <input type="number" value="{{ $visas->biometrics_fee }}" name="Biometrics"
                                  id="basic-icon-default-company" class="form-control"
                                  aria-describedby="basic-icon-default-company2" />
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
                                  <option value="travelwheel"
                                    {{ $visas->bio_payment_to == 'travelwheel' ? 'selected' : '' }}>TravelWheel
                                  </option>
                                  <option value="embassy" {{ $visas->bio_payment_to == 'embassy' ? 'selected' : '' }}>
                                    Embassy</option>
                                </select>
                              </div>
                            </div>
                            @foreach ($charges as $charge)
                              <div class="mb-3 col-sm-6 col-md-4" style="margin-top:35px;">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                  onchange="toggleElements()">
                                <label class="form-label" for="flexCheckDefault">Other Charges?</label>
                              </div>
                              {{-- <div class="mb-3 col-sm-6 col-md-4" style=""></div> --}}
                              <div class="mb-3 col-sm-6 col-md-3" id="charge_name">
                                <label class="form-label" for="basic-icon-default-email">Charge name</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-company2" class="input-group-text">
                                    <i class='fa fa-coins'></i>
                                  </span>
                                  <input type="text" value="{{ $charge['other_charge_name'] }}"
                                    name="charge_name" id="basic-icon-default-company" class="form-control"
                                    aria-describedby="basic-icon-default-company2" />
                                </div>
                              </div>

                              <div class="mb-3 col-sm-6 col-md-3" id="charge_amount">
                                <label class="form-label" for="basic-icon-default-email">Charge amount</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-company2" class="input-group-text">
                                    <i class='fa fa-coins'></i>
                                  </span>
                                  <input type="number" value="{{ $charge['other_charge_amount'] }}"
                                    name="charge_amount" id="basic-icon-default-company" class="form-control"
                                    aria-describedby="basic-icon-default-company2" />
                                </div>
                              </div>
                              <div class="mb-3 col-sm-6 col-md-3" id="info">
                                <label class="form-label" for="basic-icon-default-email">Additional
                                  Information</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-company2" class="input-group-text">
                                    <i class='fa fa-info-circle'></i>
                                  </span>
                                  <input type="text" value="{{ $charge['note'] }}" name="info"
                                    id="basic-icon-default-company" class="form-control"
                                    aria-describedby="basic-icon-default-company2" />
                                </div>
                              </div>
                              <div class="mb-3 col-sm-6 col-md-3" id="charge_charge">
                                <label class="form-label" for="basic-icon-default-phone">Charge is to be paid
                                  to?</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-phone2" class="input-group-text">
                                    <i class="fa fa-money-bill-wave"></i>
                                  </span>
                                  <select name="payment" id="smallSelect" class="form-select ">
                                    <option value="travelwheel"
                                      {{ $charge->payment_to == 'travelwheel' ? 'selected' : '' }}>TravelWheel
                                    </option>
                                    <option value="embassy" {{ $charge->payment_to == 'embassy' ? 'selected' : '' }}>
                                      Embassy</option>
                                  </select>
                                </div>
                              </div>
                            @endforeach
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label for="document">Required Documents - Adult</label>
                              <select class="selectpicker" name="document_adult[]" multiple
                                aria-label="size 3 select example">
                                @foreach ($requiredDocuments as $document)
                                  <option value="{{ $document->document_name }}"
                                    {{ in_array($document->document_name, $adultdocumentNames) ? 'selected' : '' }}>
                                    {{ $document->document_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label for="document">Required Documents - Child</label>
                              <select class="selectpicker" name="document_child[]" multiple
                                aria-label="size 3 select example">
                                @foreach ($requiredDocuments as $document)
                                  <option value="{{ $document->document_name }}"
                                    {{ in_array($document->document_name, $childdocumentNames) ? 'selected' : '' }}>
                                    {{ $document->document_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-sm-6 col-md-4">
                              <label for="document">Required Documents - infant</label>
                              <select class="selectpicker" name="document_infant[]" multiple
                                aria-label="size 3 select example">
                                @foreach ($requiredDocuments as $document)
                                  <option value="{{ $document->document_name }}"
                                    {{ in_array($document->document_name, $infantdocumentNames) ? 'selected' : '' }}>
                                    {{ $document->document_name }}
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
                                <button type="submit" class="btn btn-primary">Update Visa</button>
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

  <!-- / Content -->
  @include('admin.layouts.footer')
