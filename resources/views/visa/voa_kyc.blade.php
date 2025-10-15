<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Visa on Arrival Application</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://kit.fontawesome.com/0626e5d22c.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary-color: #0d9c53;
            --secondary-color: #6c757d;
            --transition-speed: 0.3s;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .page-header {
            background-color: #fff;
            border-bottom: 3px solid #00a859;
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }
        .header-title {
            color: #00a859;
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        .header-text {
            color: #2c3e50;
            font-size: 1rem;
            margin: 0.5rem 0;
        }
        .header-notice {
            color: #2c3e50;
            font-size: 0.875rem;
            margin-top: 1rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e9ecef;
        }
        .form-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            transition: transform var(--transition-speed);
            margin-bottom: 1rem;
        }
        .form-section:hover {
            transform: translateY(-5px);
        }
        .section-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 1rem;
            border-radius: 15px 15px 0 0;
            border-bottom: 3px solid var(--primary-color);
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            transition: all var(--transition-speed);
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 156, 83, 0.25);
            border-color: var(--primary-color);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 8px 0 0 8px;
            border: 1px solid #dee2e6;
        }
        .btn-success {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            transition: all var(--transition-speed);
        }
        .btn-success:hover {
            background-color: #0b7e42;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .accordion-button {
            font-weight: 600;
            color: #0d1883;
        }
        .accordion-button:not(.collapsed) {
            background-color: #e9ecef;
            color: #0d1883;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    <section>
        @include('layouts.newnav')
    </section>
    <main style="padding-top: 60px;">
        <div class="page-header text-center">
            <h1 class="header-title">Visa on Arrival Application</h1>
            <p class="header-text">Please fill in all the required information accurately for all {{ $visaData['total_people'] }} applicant(s)</p>
            <p class="header-notice">Approved Visa must be used within 14 days of issuance</p>
        </div>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="visaForm" action="{{ route('voa_kyc_submit') }}" method="POST">
                {{ csrf_field() }}
                <div class="accordion" id="applicantAccordion">
                    @for ($i = 0; $i < $visaData['total_people']; $i++)
                        <div class="accordion-item form-section">
                            <h2 class="accordion-header" id="heading{{ $i }}">
                                <button class="accordion-button {{ $i == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="{{ $i == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $i }}">
                                    Applicant {{ $i + 1 }}
                                </button>
                            </h2>
                            <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $i }}" data-bs-parent="#applicantAccordion">
                                <div class="accordion-body">
                                    <!-- Personal Details -->
                                    <div class="form-section">
                                        <div class="section-header">
                                            <h4 class="mb-0" style="color:#0d1883;">
                                                <i class="fas fa-user-circle me-2"></i>Personal Details
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="surname_former_{{ $i }}">Surname (Former Family Name)</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="surname_at_birth[]" id="surname_former_{{ $i }}" placeholder="Enter surname" required />
                                                            <div class="invalid-feedback">Please enter your surname</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="firstname_{{ $i }}">First Name</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="first_name[]" id="firstname_{{ $i }}" placeholder="Enter first name" required />
                                                            <div class="invalid-feedback">Please enter your first name</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="middlename_{{ $i }}">Middle Name</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="middle_name[]" id="middlename_{{ $i }}" placeholder="Enter middle name" required />
                                                            <div class="invalid-feedback">Please enter your middle name</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="dob_{{ $i }}">Date of Birth</label>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input type="text" class="form-control" id="datepicker_{{ $i }}" placeholder="DD" />
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="text" class="form-control" id="month_{{ $i }}" placeholder="MM" />
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="text" class="form-control" id="year_{{ $i }}" placeholder="YYYY" />
                                                            </div>
                                                            <input type="hidden" id="combinedDate_{{ $i }}" name="date_of_birth[]" required />
                                                            <div class="invalid-feedback">Please enter your date of birth</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="pob_{{ $i }}">Place of Birth</label>
                                                        <input type="text" name="place_of_birth[]" class="form-control" id="pob_{{ $i }}" required />
                                                        <div class="invalid-feedback">Please enter your place of birth</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="cob_{{ $i }}">Country of Birth</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                            <select name="country_of_birth[]" id="cob_{{ $i }}" class="form-select" required>
                                                                <option value="nigeria">Nigeria</option>
                                                                <option value="Afghanistan">Afghanistan</option>
                                                                <option value="Albania">Albania</option>
                                                                <!-- Add more countries as needed -->
                                                            </select>
                                                            <div class="invalid-feedback">Please select your country of birth</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="cn_{{ $i }}">Current Nationality</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                            <select name="current_nationality[]" id="cn_{{ $i }}" class="form-select" required>
                                                                <option value="nigeria">Nigeria</option>
                                                                <option value="Afghanistan">Afghanistan</option>
                                                                <option value="Albania">Albania</option>
                                                                <!-- Add more countries as needed -->
                                                            </select>
                                                            <div class="invalid-feedback">Please select your nationality</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3 mt-2">
                                                        <label class="form-label" for="gender_{{ $i }}">Gender</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sex[{{ $i }}]" id="male_{{ $i }}" value="male" required />
                                                            <label class="form-check-label" for="male_{{ $i }}">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sex[{{ $i }}]" id="female_{{ $i }}" value="female" required />
                                                            <label class="form-check-label" for="female_{{ $i }}">Female</label>
                                                        </div>
                                                        <div class="invalid-feedback">Please select your gender</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="civil_status_{{ $i }}">Marital Status (Leave empty if you are a minor)</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="civil_status[{{ $i }}]" id="married_{{ $i }}" value="married" />
                                                            <label class="form-check-label" for="married_{{ $i }}">Married</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="civil_status[{{ $i }}]" id="single_{{ $i }}" value="single" />
                                                            <label class="form-check-label" for="single_{{ $i }}">Single</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="civil_status[{{ $i }}]" id="partners_{{ $i }}" value="partners" />
                                                            <label class="form-check-label" for="partners_{{ $i }}">Registered Partners</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="civil_status[{{ $i }}]" id="separated_{{ $i }}" value="separated" />
                                                            <label class="form-check-label" for="separated_{{ $i }}">Separated</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="civil_status[{{ $i }}]" id="divorced_{{ $i }}" value="divorced" />
                                                            <label class="form-check-label" for="divorced_{{ $i }}">Divorced</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="civil_status[{{ $i }}]" id="widow_{{ $i }}" value="widow" />
                                                            <label class="form-check-label" for="widow_{{ $i }}">Widow(er)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Travel Details -->
                                    <div class="form-section">
                                        <div class="section-header">
                                            <h4 class="mb-0" style="color:#0d1883;">
                                                <i class="fas fa-plane me-2"></i>Travel Details
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="airline_{{ $i }}">Airline</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-plane"></i></span>
                                                            <select name="airline[]" id="airline_{{ $i }}" class="form-select" required>
                                                                <option value="American Airlines">American Airlines</option>
                                                                <option value="Air France">Air France</option>
                                                                <option value="British Airways">British Airways</option>
                                                                <option value="Lufthansa">Lufthansa</option>
                                                                <option value="Emirates">Emirates</option>
                                                                <!-- Add more airlines as needed -->
                                                            </select>
                                                            <div class="invalid-feedback">Please select your airline</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="flight_number_{{ $i }}">Flight Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                                                            <input type="text" class="form-control" name="flight_number[]" id="flight_number_{{ $i }}" placeholder="Enter flight number" required />
                                                            <div class="invalid-feedback">Please enter your flight number</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="purpose_{{ $i }}">Purpose of Journey</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-suitcase-rolling"></i></span>
                                                            <input type="text" class="form-control" name="purpose[]" id="purpose_{{ $i }}" placeholder="Enter purpose of journey" required />
                                                            <div class="invalid-feedback">Please enter your purpose of journey</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="depature_{{ $i }}">Date of Departure</label>
                                                        <input class="form-control" type="date" name="depature[]" id="depature_{{ $i }}" value="{{ $visaData['departure'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="return_{{ $i }}">Date of Return</label>
                                                        <input class="form-control" type="date" name="return[]" id="return_{{ $i }}" value="{{ $visaData['return'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="entry_{{ $i }}">Port of Entry</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                                            <select name="entry[]" id="entry_{{ $i }}" class="form-select" required>
                                                                <option value="LOS">Murtala Muhammed International Airport (Lagos)</option>
                                                                <option value="ABV">Nnamdi Azikiwe International Airport (Abuja)</option>
                                                                <!-- Add more ports as needed -->
                                                            </select>
                                                            <div class="invalid-feedback">Please select your port of entry</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Passport & Visa Information -->
                                    <div class="form-section">
                                        <div class="section-header">
                                            <h4 class="mb-0" style="color:#0d1883;">
                                                <i class="fas fa-passport me-2"></i>Passport & Visa Information
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="passport_number_{{ $i }}">Passport Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                                            <input type="text" class="form-control" name="passport_number[]" id="passport_number_{{ $i }}" placeholder="Your passport number" required />
                                                            <div class="invalid-feedback">Please enter your passport number</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="passport_type_{{ $i }}">Type of International Passport</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="passport_type[{{ $i }}]" id="ordinary_{{ $i }}" value="ordinary" required />
                                                            <label class="form-check-label" for="ordinary_{{ $i }}">Ordinary</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="passport_type[{{ $i }}]" id="diplomatic_{{ $i }}" value="diplomatic" />
                                                            <label class="form-check-label" for="diplomatic_{{ $i }}">Diplomatic</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="passport_type[{{ $i }}]" id="service_{{ $i }}" value="service" />
                                                            <label class="form-check-label" for="service_{{ $i }}">Service</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="passport_type[{{ $i }}]" id="official_{{ $i }}" value="official" />
                                                            <label class="form-check-label" for="official_{{ $i }}">Official</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="passport_type[{{ $i }}]" id="special_{{ $i }}" value="special" />
                                                            <label class="form-check-label" for="special_{{ $i }}">Special</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="passport_type[{{ $i }}]" id="others_{{ $i }}" value="others" />
                                                            <label class="form-check-label" for="others_{{ $i }}">Others</label>
                                                            <input type="text" class="form-control mt-2" name="other_passport_type[{{ $i }}]" id="others_input_{{ $i }}" placeholder="Please specify" style="display: none;" />
                                                        </div>
                                                        <div class="invalid-feedback">Please select your passport type</div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="ped_{{ $i }}">Passport Expiry Date <i class="fa fa-info-circle" data-bs-toggle="tooltip" title="Passport expiry date must be at least 6 months after the return date."></i></label>
                                                        <input class="form-control" type="date" name="passport_expiry_date[]" id="ped_{{ $i }}" required />
                                                        <p id="warning_{{ $i }}" style="color: red; font-size:12px;" hidden>Passport expiry date must be at least 6 months after the return date.</p>
                                                        <div class="invalid-feedback">Please enter your passport expiry date</div>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="visa_class_{{ $i }}">Visa Class</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                            <select name="visa_class[]" id="visa_class_{{ $i }}" class="form-select" required>
                                                                <option value="F2A">F2A - Non-Accredited Diplomatic Visa</option>
                          <option value="F3A">F3A - Transit Without Visa</option>
                          <option value="F3B">F3B - Transit Visa</option>
                          <option value="F4A">F4A - Business Visa (Single Entry)</option>
                          <option value="F4B">F4B - Business Visa (Multiple Entry)</option>
                          <option value="F4C">F4C - Business Visa (Frequent Travelers)</option>
                          <option value="F5A">F5A - Tourism Visa</option>
                          <option value="F6A">F6A - Visiting Visa (Single Entry)</option>
                          <option value="F6B">F6B - Visiting Visa (Multiple Entry)</option>
                          <option value="F7A">F7A - Journalist Visa</option>
                          <option value="F7B">F7B - Cleric Visa</option>
                          <option value="F7C">F7C - Medical Tourism Visa</option>
                          <option value="F7D">F7D - Religious Tourism Visa</option>
                          <option value="F7E">F7E - Sport Visa</option>
                          <option value="F7F">F7F - Entertainer Visa</option>
                          <option value="F7G">F7G - Study Tour Visa</option>
                          <option value="F7H">F7H - Academic Exchange Program Visa</option>
                          <option value="F7I">F7I - International Culture Exchange Visa</option>
                          <option value="F7J">F7J - Humanitarian Service Visa</option>
                          <option value="F7K">F7K - Emergency/Relief Work Visa</option>
                          <option value="F7L">F7L - Staff of International NGO Visa</option>
                          <option value="F7M">F7M - Staff of NGO Visa</option>
                          <option value="F8A">F8A - Temporary Work Permit Visa</option>
                          <option value="F9A">F9A - Returning Nigerian by Birth Visa</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please select your visa class</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Contact Information -->
                                    <div class="form-section">
                                        <div class="section-header">
                                            <h4 class="mb-0" style="color:#0d1883;">
                                                <i class="fas fa-address-book me-2"></i>Contact Information
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="contact_name_{{ $i }}">Contact Name/Hotel Name</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                                            <input type="text" class="form-control" name="contact_name[]" id="contact_name_{{ $i }}" placeholder="Your contact or hotel name" required />
                                                            <div class="invalid-feedback">Please enter your contact name</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="contact_number_{{ $i }}">Contact Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                            <input type="text" class="form-control" name="contact_number[]" id="contact_number_{{ $i }}" placeholder="Your contact number" required />
                                                            <div class="invalid-feedback">Please enter a valid contact number</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="contact_email_{{ $i }}">Contact Email</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                            <input type="email" class="form-control" name="contact_email[]" id="contact_email_{{ $i }}" placeholder="Your contact email" required />
                                                            <div class="invalid-feedback">Please enter a valid contact email</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="contact_address_{{ $i }}">Contact Address</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                            <input type="text" class="form-control" name="contact_address[]" id="contact_address_{{ $i }}" placeholder="Your contact address" required />
                                                            <div class="invalid-feedback">Please enter your contact address</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="d-flex justify-content-end mt-4 mb-5 animate-slide-in" style="animation-delay: 0.4s;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-arrow-right me-2 text-light"></i>Proceed to Next Step
                    </button>
                </div>
            </form>
        </div>
    </main>
    <section>
        @include('layouts.footer')
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
             localStorage.removeItem('voa_token');
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            // Handle date inputs for each applicant
            @for ($i = 0; $i < $visaData['total_people']; $i++)
                (function(index) {
                    const dayInput = document.getElementById('datepicker_' + index);
                    const monthInput = document.getElementById('month_' + index);
                    const yearInput = document.getElementById('year_' + index);
                    const combinedInput = document.getElementById('combinedDate_' + index);

                    [dayInput, monthInput, yearInput].forEach(input => {
                        input.addEventListener('input', function() {
                            const date = `${yearInput.value}-${monthInput.value.padStart(2, '0')}-${dayInput.value.padStart(2, '0')}`;
                            combinedInput.value = date;
                        });
                    });

                    // Handle passport expiry validation
                    const passportExpiryInput = document.getElementById('ped_' + index);
                    const warningElement = document.getElementById('warning_' + index);
                    passportExpiryInput.addEventListener('change', function() {
                        const expiryDate = new Date(this.value);
                        const returnDate = new Date('{{ $visaData['return'] }}');
                        const sixMonthsFromReturn = new Date(returnDate.setMonth(returnDate.getMonth() + 6));
                        if (expiryDate < sixMonthsFromReturn) {
                            warningElement.hidden = false;
                            this.classList.add('is-invalid');
                        } else {
                            warningElement.hidden = true;
                            this.classList.remove('is-invalid');
                        }
                    });

                    // Handle other passport type
                    const othersRadio = document.getElementById('others_' + index);
                    const othersInput = document.getElementById('others_input_' + index);
                    othersRadio.addEventListener('change', function() {
                        othersInput.style.display = this.checked ? 'block' : 'none';
                    });
                })({{ $i }});
            @endfor

            // Client-side form validation
            const form = document.getElementById('visaForm');
            form.addEventListener('submit', function(event) {
                let isValid = true;
                form.querySelectorAll('.form-control[required], .form-select[required], .form-check-input[required]').forEach(input => {
                    if (!input.value || (input.type === 'radio' && !form.querySelector(`input[name="${input.name}"]:checked`))) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelectorAll('.is-invalid').forEach(input => {
                        input.closest('.form-section').scrollIntoView({ behavior: 'smooth' });
                    });
                }
            });
        });
    </script>
</body>
</html>