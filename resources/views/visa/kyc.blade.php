<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Air - Visa KYC</title>
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://kit.fontawesome.com/0626e5d22c.js" crossorigin="anonymous"></script>
    <style>
        .form-check-inline { display: inline-block; }
        .dropdown-item { display: flex; justify-content: space-between; align-items: center; }
        .items-controls { display: flex; align-items: center; }
        .item-count { font-size: 12px; margin: 0 5px; }
        .increment-button, .decrement-button { padding: 4px 8px; font-size: 12px; }
        .solid { border: 1px solid #ddd; border-radius: 5px; }
        .hidden { display: none; }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-down { animation: fadeDown 0.5s ease; }
        .accordion-button { font-size: 1.1rem; font-weight: bold; }
        .accordion-body { background-color: #f8f9fa; }
        .card-header { background-color: #e9ecef; font-weight: bold; }
        .is-invalid { border-color: #dc3545 !important; }
        .invalid-feedback { display: none; color: #dc3545; }
        .is-invalid ~ .invalid-feedback { display: block; }
    </style>
</head>
<body>
    @include('layouts.newnav')
    <main id="main" style="padding-top: 60px;">
        <section class="shadow-sm">
            <div class="container">
                <h2 class="text-center mb-4">Know Your Customer (KYC) Form</h2>
                @if ($note !== 'null')
                    <h4>Note: {{ $note }}</h4>
                    <p></p>
                @endif
                <form id="kycForm" action="{{ route('kyc.form') }}" method="POST">
                    @csrf
                    <div class="row airport-form shadow p-4 mt-2 mb-5">
                        <!-- Accordion for Passenger Forms -->
                        <div class="accordion" id="passengerAccordion">
                            @for ($i = 0; $i < $total_passengers; $i++)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $i }}">
                                        <button class="accordion-button {{ $i == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="{{ $i == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $i }}">
                                            Passenger {{ $i + 1 }} {{ $i < $adult_count ? '(Adult)' : ($i < $adult_count + $child_count ? '(Child)' : '(Infant)') }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $i }}" data-bs-parent="#passengerAccordion">
                                        <div class="accordion-body">
                                            <!-- Personal Details -->
                                            <div class="card mb-3">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Personal Details</h5>
                                                    <small class="text-muted float-end">Fill in necessary details</small>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="surname_family_{{ $i }}">Surname (Family name)</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][surname]" id="surname_family_{{ $i }}" placeholder="Enter Surname" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="surname_former_{{ $i }}">Surname (Former Family name)</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][surname_at_birth]" id="surname_former_{{ $i }}" placeholder="Enter surname" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="firstname_{{ $i }}">First Name</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][first_name]" id="firstname_{{ $i }}" placeholder="Enter first name" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="middlename_{{ $i }}">Middle Name</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][middle_name]" id="middlename_{{ $i }}" placeholder="Enter Middlename" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="datepicker_{{ $i }}">Date Of Birth</label>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <input type="text" class="form-control" id="datepicker_{{ $i }}" placeholder="DD">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="text" class="form-control" id="month_{{ $i }}" placeholder="MM">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="text" class="form-control" id="year_{{ $i }}" placeholder="YYYY">
                                                                    </div>
                                                                    <input type="hidden" id="combinedDate_{{ $i }}" name="passengers[{{ $i }}][date_of_birth]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="pob_{{ $i }}">Place of Birth</label>
                                                                <input type="text" name="passengers[{{ $i }}][place_of_birth]" id="pob_{{ $i }}" class="form-control" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cob_{{ $i }}">Country of Birth</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                                    <select name="passengers[{{ $i }}][country_of_birth]" id="cob_{{ $i }}" class="form-select" required>
                                                                        <option value="nigeria" selected>Nigeria</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Albania">Albania</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cn_{{ $i }}">Current Nationality</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                                    <select name="passengers[{{ $i }}][current_nationality]" id="cn_{{ $i }}" class="form-select" required>
                                                                        <option value="nigeria" selected>Nigeria</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Albania">Albania</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="nob_{{ $i }}">Nationality at Birth <i class="fa fa-info-circle" data-toggle="tooltip" title="if different from current Nationality"></i></label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                                    <select name="passengers[{{ $i }}][nationality_at_birth]" id="nob_{{ $i }}" class="form-select">
                                                                        <option value="nigeria" selected>Nigeria</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Albania">Albania</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 mt-2">
                                                                <label class="form-label" for="gender_{{ $i }}">Gender</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][sex]" id="inlineRadio1_{{ $i }}" value="male" required>
                                                                    <label class="form-check-label" for="inlineRadio1_{{ $i }}">Male</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][sex]" id="inlineRadio2_{{ $i }}" value="female">
                                                                    <label class="form-check-label" for="inlineRadio2_{{ $i }}">Female</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="civil_status_{{ $i }}">Marital Status</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][civil_status]" id="inlineRadio3_{{ $i }}" value="married">
                                                                    <label class="form-check-label" for="inlineRadio3_{{ $i }}">Married</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][civil_status]" id="inlineRadio4_{{ $i }}" value="single">
                                                                    <label class="form-check-label" for="inlineRadio4_{{ $i }}">Single</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][civil_status]" id="inlineRadio5_{{ $i }}" value="pathners">
                                                                    <label class="form-check-label" for="inlineRadio5_{{ $i }}">Registered Pathners</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][civil_status]" id="inlineRadio6_{{ $i }}" value="separated">
                                                                    <label class="form-check-label" for="inlineRadio6_{{ $i }}">Separated</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][civil_status]" id="inlineRadio7_{{ $i }}" value="divorced">
                                                                    <label class="form-check-label" for="inlineRadio7_{{ $i }}">Divorced</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][civil_status]" id="inlineRadio8_{{ $i }}" value="widow">
                                                                    <label class="form-check-label" for="inlineRadio8_{{ $i }}">widow(er)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($i >= $adult_count) <!-- Show guardian info for children and infants -->
                                                            <div class="col-12">
                                                                <div class="mb-3 mt-2">
                                                                    <input type="checkbox" name="passengers[{{ $i }}][minor]" id="minor_{{ $i }}" class="form-check-input">
                                                                    <label class="form-check-label" for="minor_{{ $i }}">Are you a minor <i class="fa fa-info-circle" data-toggle="tooltip" title="Less than 18 years old"></i></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 guardian-info" id="guardian_{{ $i }}" style="display: none">
                                                                <div class="mb-3 mt-2">
                                                                    <h6>Guardian Information</h6>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="gsname_{{ $i }}">Surname</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][guardian_surname]" id="gsname_{{ $i }}" placeholder="Guardian Surname" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="gfname_{{ $i }}">Firstname</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][guardian_first_name]" id="gfname_{{ $i }}" placeholder="Guardian Firstname" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="g-address_{{ $i }}">Address<span><small class="text-danger ms-2">*if different from applicant</small></span></label>
                                                                                <textarea name="passengers[{{ $i }}][guardian_address]" id="g-address_{{ $i }}" cols="27" rows="1" placeholder="Guardian Address"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="gnumber_{{ $i }}">Phone Number</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][guardian_number]" id="gnumber_{{ $i }}" placeholder="Guardian Phonenumber" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="gmail_{{ $i }}">Email Address</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][guardian_email]" id="gmail_{{ $i }}" placeholder="Guardian Email Address" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="gnation_{{ $i }}">Nationality</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                                                    <select name="passengers[{{ $i }}][gnation]" id="gnation_{{ $i }}" class="form-select">
                                                                                        <option value="nigeria" selected>Nigeria</option>
                                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                                        <option value="Albania">Albania</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Passport Information -->
                                            <div class="card mb-3">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Passport Information</h5>
                                                    <small class="text-muted float-end">Fill in necessary details</small>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="nin_{{ $i }}">National Identity Number (NIN)</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][national_identity_number]" id="nin_{{ $i }}" placeholder="Enter NIN" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="ordinary_{{ $i }}">Type of International Passport</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][passport_type]" id="ordinary_{{ $i }}" value="ordinary" required>
                                                                    <label class="form-check-label" for="ordinary_{{ $i }}">Ordinary</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][passport_type]" id="diplomatic_{{ $i }}" value="diplomatic">
                                                                    <label class="form-check-label" for="diplomatic_{{ $i }}">Diplomatic</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][passport_type]" id="service_{{ $i }}" value="service">
                                                                    <label class="form-check-label" for="service_{{ $i }}">Service</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][passport_type]" id="official_{{ $i }}" value="official">
                                                                    <label class="form-check-label" for="official_{{ $i }}">Official</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][passport_type]" id="special_{{ $i }}" value="special">
                                                                    <label class="form-check-label" for="special_{{ $i }}">Special</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][passport_type]" id="others_{{ $i }}" value="">
                                                                    <label class="form-check-label" for="others_{{ $i }}">Others Travel Documents</label>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][passport_type_others]" id="others-input_{{ $i }}" placeholder="Please specify" style="display: none">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="passport_no_{{ $i }}">Passport Number</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-passport"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][passport_number]" id="passport_no_{{ $i }}" placeholder="Your passport number" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="doi-day_{{ $i }}">Date Of Issue</label>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <input type="text" class="form-control" id="doi-day_{{ $i }}" placeholder="DD">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="text" class="form-control" id="doi-month_{{ $i }}" placeholder="MM">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="text" class="form-control" id="doi-year_{{ $i }}" placeholder="YYYY">
                                                                    </div>
                                                                    <input type="hidden" id="combinedDOI_{{ $i }}" name="passengers[{{ $i }}][date_of_issue]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="ped_{{ $i }}">Passport Expiry Date <i class="fa fa-info-circle" data-toggle="tooltip" title="Passport expiry date must be at least 6 months after the return date."></i></label>
                                                                <input class="form-control" type="date" name="passengers[{{ $i }}][passport_expiry_date]" id="ped_{{ $i }}" required />
                                                                <p id="warning_{{ $i }}" style="color: red; font-size:12px;" hidden>Passport expiry date must be at least 6 months after the return date.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="ic_{{ $i }}">Issuing Country</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                                    <select name="passengers[{{ $i }}][issued_by_country]" id="ic_{{ $i }}" class="form-select" required>
                                                                        <option value="nigeria" selected>Nigeria</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Albania">Albania</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3 mt-2">
                                                                <label class="form-label" for="other_country_{{ $i }}">Are you a resident of another country other than country of nationality</label><br>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="passengers[{{ $i }}][other_country_radio]" id="inlineRadio11_{{ $i }}" value="yes">
                                                                            <label class="form-check-label" for="inlineRadio11_{{ $i }}">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="passengers[{{ $i }}][other_country_radio]" id="inlineRadio21_{{ $i }}" value="no">
                                                                            <label class="form-check-label" for="inlineRadio21_{{ $i }}">No</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-8" id="other_country_{{ $i }}" style="display: none">
                                                                        <input type="text" name="passengers[{{ $i }}][other_country]" placeholder="other country">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Application Details -->
                                            <div class="card mb-3">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Application Details</h5>
                                                    <small class="text-muted float-end">Fill in necessary details</small>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6 col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for=" Aragon_{{ $i }}">Applicant Phone Number</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][telephone_number]" id="a_phone_{{ $i }}" placeholder="Applicant Phone" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="a_mail_{{ $i }}">Applicant Email Address</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                                    <input type="email" class="form-control" name="passengers[{{ $i }}][email_address]" id="a_mail_{{ $i }}" placeholder="Applicant mail" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="a_address_{{ $i }}">Applicant Address</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i class="fa fa-house-user"></i></span>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][home_address]" id="a_address_{{ $i }}" placeholder="Applicant Address" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="ida_{{ $i }}">Intended Date of Return</label>
                                                                <input class="form-control" type="date" name="passengers[{{ $i }}][intended_arrival_date]" id="ida_{{ $i }}" value="{{ $return }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="idd_{{ $i }}">Intended Date of Departure</label>
                                                                <input class="form-control" type="date" name="passengers[{{ $i }}][intended_departure_date]" id="idd_{{ $i }}" value="{{ $departure }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <div style="margin-top: 40px;">
                                                                <small><b id="stay-warning_{{ $i }}" class="text-danger">You have a maximum stay of {{ $visa_validity }} day(s)</b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3 mt-2">
                                                                <label class="form-label" for="pot_{{ $i }}">Purpose of Travel</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="tour_{{ $i }}" value="tourism" required>
                                                                    <label class="form-check-label" for="tour_{{ $i }}">Tourism</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="business_{{ $i }}" value="business">
                                                                    <label class="form-check-label" for="business_{{ $i }}">Business</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="visiting_{{ $i }}" value="visiting">
                                                                    <label class="form-check-label" for="visiting_{{ $i }}">Visiting</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="cultural_{{ $i }}" value="cultural">
                                                                    <label class="form-check-label" for="cultural_{{ $i }}">Cultural</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="sport_{{ $i }}" value="sport">
                                                                    <label class="form-check-label" for="sport_{{ $i }}">Sports</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="medical_{{ $i }}" value="medical">
                                                                    <label class="form-check-label" for="medical_{{ $i }}">Medical</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="study_{{ $i }}" value="study">
                                                                    <label class="form-check-label" for="study_{{ $i }}">Study</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="airport_transit_{{ $i }}" value="airport_transit">
                                                                    <label class="form-check-label" for="airport_transit_{{ $i }}">Airport Transit</label>
                                                                </div>
                                                                <div class="form-check form-check-inline" id="othersContainer_{{ $i }}">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][purpose_of_journey]" id="others_purpose_{{ $i }}" value="others">
                                                                    <label class="form-check-label" for="others_purpose_{{ $i }}">Others</label>
                                                                    <input type="text" name="passengers[{{ $i }}][purpose_of_journey_others]" id="others_purpose_input_{{ $i }}" placeholder="Please specify" style="display: none">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cost_coverage_{{ $i }}">Cost of travelling and living during the applicant’s stay is covered by:</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][cost_coverage]" id="applicant_{{ $i }}" value="applicant" required>
                                                                    <label class="form-check-label" for="applicant_{{ $i }}">Applicant</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][cost_coverage]" id="sponsor_{{ $i }}" value="sponsor" required>
                                                                    <label class="form-check-label" for="sponsor_{{ $i }}">Sponsor<i class="fa fa-info-circle ms-2" data-toggle="tooltip" title="host/company/organization"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="moi_{{ $i }}">Means of invitation</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][invitaion_means]" id="individual_{{ $i }}" value="individual" required>
                                                                    <label class="form-check-label" for="individual_{{ $i }}">Individual <i class="fa fa-info-circle" data-toggle="tooltip" title="Family/friends"></i></label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][invitaion_means]" id="company_{{ $i }}" value="Organization/Company">
                                                                    <label class="form-check-label" for="company_{{ $i }}">Organization/Company</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][invitaion_means]" id="none_{{ $i }}" value="none">
                                                                    <label class="form-check-label" for="none_{{ $i }}">None</label>
                                                                </div>
                                                            </div>
                                                            <div id="individual_details_{{ $i }}" class="col-12" style="display: none;">
                                                                <h6>Individual Details</h6>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="i_name_{{ $i }}">Name of Inviting person</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][inviting_person]" id="i_name_{{ $i }}" placeholder="Full name" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="i_phone_{{ $i }}">Phone Number</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][inviting_person_telephone]" id="i_phone_{{ $i }}" placeholder="Phone Number" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="i_mail_{{ $i }}">Email</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][inviting_mail]" id="i_mail_{{ $i }}" placeholder="Email Address" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="i_home_{{ $i }}">Home Address</label>
                                                                            <textarea name="passengers[{{ $i }}][inviting_person_address]" id="i_home_{{ $i }}" cols="30" rows="1" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="company_details_{{ $i }}" class="col-12" style="display: none;">
                                                                <h6>Company Contact Person Details</h6>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="c_name_{{ $i }}">Name of Company</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][company_or_organization_name]" id="c_name_{{ $i }}" placeholder="Full name" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="c_phone_{{ $i }}">Phone Number of Company</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][company_or_organization_telephone]" id="c_phone_{{ $i }}" placeholder="Phone Number" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="c_mail_{{ $i }}">Email of Company</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][company_or_organization_email]" id="c_mail_{{ $i }}" placeholder="Phone Number" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="c_home_{{ $i }}">Company Address</label>
                                                                            <textarea name="passengers[{{ $i }}][company_or_organization_address]" id="c_home_{{ $i }}" cols="30" rows="1" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="cp_name_{{ $i }}">FullName of person</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][contact_person_surname]" id="cp_name_{{ $i }}" placeholder="Full name" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="cp_phone_{{ $i }}">Phone Number of Contact Person</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][contact_person_telephone]" id="cp_phone_{{ $i }}" placeholder="Phone Number" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="cp_mail_{{ $i }}">Email of Contact Person</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][contact_person_email]" id="cp_mail_{{ $i }}" placeholder="Enter Email" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="hotel_details_{{ $i }}" class="col-12">
                                                                <p>Do you have accommodations or a temporary place to stay?</p>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="yes_{{ $i }}" name="passengers[{{ $i }}][accommodation]" value="yes">
                                                                    <label class="form-check-label" for="yes_{{ $i }}">Yes, I do</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="no_{{ $i }}" name="passengers[{{ $i }}][accommodation]" value="no">
                                                                    <label class="form-check-label" for="no_{{ $i }}">No, I don't</label>
                                                                </div>
                                                                <div id="hotel_{{ $i }}" style="display: none">
                                                                    <h6>Hotel/Temporary accommodation Details</h6>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="h_home_{{ $i }}">Name of Hotel</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <span id="fullname_{{ $i }}" class="input-group-text"><i class="fa fa-hotel"></i></span>
                                                                                    <input type="text" name="passengers[{{ $i }}][hotel_adress]" id="h_home_{{ $i }}" class="form-control" placeholder="Hotel Name" aria-describedby="basic-icon-default-fullname2" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="travelwheel_hotel_{{ $i }}" style="display: none">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="passengers[{{ $i }}][travelwheel_hotel]" id="agree_travelwheel_{{ $i }}" value="{{ $hotel_fees }}" data-passenger="{{ $i }}">
                                                                        <label class="form-check-label" for="agree_travelwheel_{{ $i }}">Certainly! Travelwheel can assist with temporary accommodation if needed, for a fee of <b>₦{{ number_format($hotel_fees) }}</b>.</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div class="mb-3 mt-2">
                                                                <label class="form-label" for="work_status_{{ $i }}">Current work status</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][current_work_status]" id="employed_{{ $i }}" value="employed" onchange="toggleEmployerVisibility({{ $i }})">
                                                                    <label class="form-check-label" for="employed_{{ $i }}">Employed</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][current_work_status]" id="student_{{ $i }}" value="student" onchange="toggleStudentVisibility({{ $i }})">
                                                                    <label class="form-check-label" for="student_{{ $i }}">Student</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="passengers[{{ $i }}][current_work_status]" id="self_employed_{{ $i }}" value="self-employed">
                                                                    <label class="form-check-label" for="self_employed_{{ $i }}">Self-employed</label>
                                                                </div>
                                                            </div>
                                                            <div id="employer_details_{{ $i }}" class="col-12" style="display: none;">
                                                                <h6>Employer Details</h6>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="e_name_{{ $i }}">Employer Name</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][employer_name]" id="e_name_{{ $i }}" placeholder="Employer name" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="e_phone_{{ $i }}">Phone Number</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][employer_telephone_number]" id="e_phone_{{ $i }}" placeholder="Employer Phone" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="home_{{ $i }}">Home Address</label>
                                                                            <textarea name="passengers[{{ $i }}][employer_address]" id="home_{{ $i }}" cols="30" rows="1" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="student_details_{{ $i }}" class="col-12" style="display: none;">
                                                                <h6>Student details</h6>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="school_name_{{ $i }}">Name of School</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span class="input-group-text"><i class="fa fa-school"></i></span>
                                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][school_name]" id="school_name_{{ $i }}" placeholder="Name of school" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="school_address_{{ $i }}">Address of School</label>
                                                                            <textarea name="passengers[{{ $i }}][school_address]" id="school_address_{{ $i }}" class="form-control" cols="20" rows="1"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Travel and Reservation -->
                                                        <div class="col-12">
                                                            <div class="card mb-3">
                                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                                    <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Travel and Reservation</h5>
                                                                    <small class="text-muted float-end">Fill in necessary details</small>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="mb-3">
                                                                                <div id="insure_{{ $i }}">
                                                                                    <p>Do you already have travel insurance?</p>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="radio" id="yesInsurance_{{ $i }}" name="passengers[{{ $i }}][insurance]" value="yes">
                                                                                        <label class="form-check-label" for="yesInsurance_{{ $i }}">Yes, I do</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="radio" id="noInsurance_{{ $i }}" name="passengers[{{ $i }}][insurance]" value="no">
                                                                                        <label class="form-check-label" for="noInsurance_{{ $i }}">No, I don't</label>
                                                                                    </div>
                                                                                    <div id="coverageDaysInput_{{ $i }}" style="display: none;">
                                                                                        <label class="form-label" for="coverage_{{ $i }}">Coverage Days</label>
                                                                                        <div class="input-group input-group-merge">
                                                                                            <span class="input-group-text"><i class="bi bi-calendar-fill"></i></span>
                                                                                            <select name="passengers[{{ $i }}][coverage_days]" id="coverage_days_{{ $i }}" class="form-select coverage-days" data-passenger="{{ $i }}">
                                                                                                <option selected>Select coverage days</option>

                                                                                                  <option value="7" data-price="15.00">7 days</option>
                                                                                                <option value="14" data-price="25.00">14 days</option>
                                                                                                <option value="30" data-price="40.00">30 days</option>
                                                                                                <option value="60" data-price="70.00">60 days</option>
                                                                                                <option value="90" data-price="90.00">90 days</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="hidden" id="selectedCoverageDays_{{ $i }}" name="passengers[{{ $i }}][selectedCoverageDays]">
                                                                                    <input type="hidden" id="selectedPrice_{{ $i }}" name="passengers[{{ $i }}][selectedPrice]">
                                                                                </div>
                                                                                <div id="flight_reserve_{{ $i }}" class="col-12">
                                                                                    <p>Do you have a flight reservation?</p>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="radio" id="yesflight_{{ $i }}" name="passengers[{{ $i }}][flight]" value="yes">
                                                                                        <label class="form-check-label" for="yesflight_{{ $i }}">Yes, I do</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="radio" id="noflight_{{ $i }}" name="passengers[{{ $i }}][flight]" value="no">
                                                                                        <label class="form-check-label" for="noflight_{{ $i }}">No, I don't</label>
                                                                                    </div>
                                                                                    <div id="travelwheel_flight_{{ $i }}" style="display: none;">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="passengers[{{ $i }}][travelwheel_flight]" id="flight_travelwheel_{{ $i }}" value="{{ $reserve_fees }}" data-passenger="{{ $i }}">
                                                                                            <label class="form-check-label" for="flight_travelwheel_{{ $i }}">Travelwheel can assist with Flight reservation for a fee of <b>₦{{ number_format($reserve_fees) }}</b>.</label>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <!-- Cost Summary Section -->
                        <div class="col-12 mt-3" id="cost_summary" style="display:none">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Cost Summary</h5>
                                    <small class="text-muted float-end">Total due to TravelWheel</small>
                                </div>
                                <div class="card-body">
                                    <div id="price_summary">
                                        <h5>Due to TravelWheel</h5>
                                        <div id="price_details">
                                            <!-- Price details will be appended here by JavaScript -->
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><strong>Total</strong></span>
                                            <span><strong id="total_price">₦0</strong></span>
                                        </div>
                                        <input type="hidden" id="total_amount" name="total_amount">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Disclaimer -->
                        <div class="mt-3">
                            <hr>
                            <h5><b>Disclaimer</b></h5>
                            <ul>
                                <li><p><b>TravelWheel</b> will process visas based on the information provided in the documentation.</p></li>
                                <li><p>Please note that the processing time indicated above are from the time they are submitted to the respective visa decision making authority. Processing time may vary under exceptional circumstances beyond the control of <b>TravelWheel</b>.</p></li>
                                <li><p>Please note that the document/documents list shown are subject to change without prior notice. Any additional documents/information required will be communicated after careful evaluation of the application.</p></li>
                                <li><p><b>TravelWheel</b> hereby declares that it does not facilitate the sale of visas.</p></li>
                                <li><p>Visa is at the discretion of the embassy visa officer, and <b>TravelWheel</b> does not influence or guarantee the outcome of visa applications.</p></li>
                                <li><p>Should you become aware of any visa sale or purchase transactions, please report them to <b>TravelWheel</b> management immediately, as we strictly prohibit such activities.</p></li>
                                <li><p>Visas for any form of trafficking are strictly prohibited by <b>TravelWheel</b>.</p></li>
                            </ul>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevPassenger">Previous Passenger</button>
                            <button type="button" class="btn btn-primary" id="nextPassenger">Next Passenger</button>
                            <button type="submit" class="btn btn-success">Proceed</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            localStorage.removeItem('visaToken');

            // Initialize variables
            const visaProcessingFee = {{ str_replace(',', '', $country->travelwheel_pay) }};
            const reserveFee = {{ $reserve_fees }};
            const hotelFee = {{ $hotel_fees }};
            const totalPassengers = {{ $total_passengers }};
            const visaValidity = {{ $visa_validity }};
            const returnDate = "{{ $return }}";
            let passengerCosts = Array(totalPassengers).fill().map(() => ({
                insurancePrice: 0,
                flightReservationFee: 0,
                hotelAssistanceFee: 0,
                coverageDays: ''
            }));

            // Function to update cost summary
            function updateCostSummary() {
                let total = 0;
                let details = '';
                passengerCosts.forEach((cost, index) => {
                    const passengerTotal = visaProcessingFee + cost.insurancePrice + cost.flightReservationFee + cost.hotelAssistanceFee;
                    total += passengerTotal;
                    details += `<div><strong>Passenger ${index + 1}</strong></div>`;
                    details += `<div class="d-flex justify-content-between"><span>Visa Processing Fee</span><span>₦${new Intl.NumberFormat().format(visaProcessingFee)}</span></div>`;
                    if (cost.coverageDays) {
                        details += `<div class="d-flex justify-content-between"><span>Coverage Days (${cost.coverageDays})</span><span>₦${new Intl.NumberFormat().format(cost.insurancePrice)}</span></div>`;
                    }
                    if (cost.flightReservationFee > 0) {
                        details += `<div class="d-flex justify-content-between"><span>Flight Reservation</span><span>₦${new Intl.NumberFormat().format(cost.flightReservationFee)}</span></div>`;
                    }
                    if (cost.hotelAssistanceFee > 0) {
                        details += `<div class="d-flex justify-content-between"><span>Hotel Assistance</span><span>₦${new Intl.NumberFormat().format(cost.hotelAssistanceFee)}</span></div>`;
                    }
                });
                $('#price_details').html(details);
                $('#total_price').text(`₦${new Intl.NumberFormat().format(total)}`);
                $('#total_amount').val(total);
            }

            // Initialize date pickers for each passenger
            @for ($i = 0; $i < $total_passengers; $i++)
                $('#month_{{ $i }}').datepicker({
                    format: "mm",
                    viewMode: "months",
                    minViewMode: "months"
                });
                $('#year_{{ $i }}').datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years"
                });
                $('#datepicker_{{ $i }}').datepicker({
                    format: "dd",
                    autoclose: true,
                    todayHighlight: true
                });
                $('#month_{{ $i }}, #year_{{ $i }}, #datepicker_{{ $i }}').on('changeDate', function () {
                    var month = $('#month_{{ $i }}').val();
                    var year = $('#year_{{ $i }}').val();
                    var date = $('#datepicker_{{ $i }}').datepicker('getDate');
                    var day = date ? date.getDate() : '';
                    var combinedDate = day && month && year ? `${day}-${month}-${year}` : '';
                    $('#combinedDate_{{ $i }}').val(combinedDate);
                });
                $('#doi-day_{{ $i }}').datepicker({
                    format: "dd",
                    autoclose: true,
                    todayHighlight: true
                });
                $('#doi-month_{{ $i }}').datepicker({
                    format: "mm",
                    viewMode: "months",
                    minViewMode: "months"
                });
                $('#doi-year_{{ $i }}').datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years"
                });
                $('#doi-day_{{ $i }}, #doi-month_{{ $i }}, #doi-year_{{ $i }}').on('changeDate', function () {
                    var day = $('#doi-day_{{ $i }}').datepicker('getDate') ? $('#doi-day_{{ $i }}').datepicker('getDate').getDate() : '';
                    var month = $('#doi-month_{{ $i }}').datepicker('getDate') ? $('#doi-month_{{ $i }}').datepicker('getDate').getMonth() + 1 : '';
                    var year = $('#doi-year_{{ $i }}').datepicker('getDate') ? $('#doi-year_{{ $i }}').datepicker('getDate').getFullYear() : '';
                    var combinedDOI = day && month && year ? `${day}-${month}-${year}` : '';
                    $('#combinedDOI_{{ $i }}').val(combinedDOI);
                });
            @endfor

            // Toggle visibility for conditional fields
            @for ($i = 0; $i < $total_passengers; $i++)
                // Guardian visibility
                $('#minor_{{ $i }}').change(function () {
                    $('#guardian_{{ $i }}').toggle(this.checked);
                });

                // Invitation means
                $(`input[name="passengers[{{ $i }}][invitaion_means]"]`).change(function () {
                    $('#individual_details_{{ $i }}').slideUp();
                    $('#company_details_{{ $i }}').slideUp();
                    $('#hotel_details_{{ $i }}').slideUp();
                    if (this.value === 'individual') {
                        $('#individual_details_{{ $i }}').slideDown();
                    } else if (this.value === 'Organization/Company') {
                        $('#company_details_{{ $i }}').slideDown();
                    } else if (this.value === 'none') {
                        $('#hotel_details_{{ $i }}').slideDown();
                    }
                });

                // Accommodation
                $(`#yes_{{ $i }}`).click(function () {
                    $('#hotel_{{ $i }}').slideDown();
                    $('#travelwheel_hotel_{{ $i }}').slideUp();
                    $('#h_home_{{ $i }}').val('');
                });
                $(`#no_{{ $i }}`).click(function () {
                    $('#hotel_{{ $i }}').slideUp();
                    $('#travelwheel_hotel_{{ $i }}').slideDown();
                    $('#h_home_{{ $i }}').val('');
                });

                // Flight reservation
                $(`#yesflight_{{ $i }}`).change(function () {
                    $('#travelwheel_flight_{{ $i }}').slideUp();
                    passengerCosts[{{ $i }}].flightReservationFee = 0;
                    updateCostSummary();
                });
                $(`#noflight_{{ $i }}`).change(function () {
                    $('#travelwheel_flight_{{ $i }}').slideDown();
                });

                // Others passport type
                $(`#others_{{ $i }}`).change(function () {
                    $('#others-input_{{ $i }}').toggle(this.checked);
                });
                $(`input[name="passengers[{{ $i }}][passport_type]"]:not(#others_{{ $i }})`).change(function () {
                    $('#others-input_{{ $i }}').hide();
                });
                $(`#others-input_{{ $i }}`).on('input', function () {
                    $(`#others_{{ $i }}`).val(this.value);
                });

                // Others purpose of journey
                $(`input[name="passengers[{{ $i }}][purpose_of_journey]"]`).change(function () {
                    $('#others_purpose_input_{{ $i }}').toggle(this.value === 'others');
                });
                $(`#others_purpose_input_{{ $i }}`).on('input', function () {
                    $(`#others_purpose_{{ $i }}`).val(this.value);
                });

                // Other country
                $(`#inlineRadio11_{{ $i }}`).change(function () {
                    $('#other_country_{{ $i }}').show();
                });
                $(`#inlineRadio21_{{ $i }}`).change(function () {
                    $('#other_country_{{ $i }}').hide();
                });

                // Passport expiry validation
                const sixMonthsLater_{{ $i }} = new Date(returnDate);
                sixMonthsLater_{{ $i }}.setMonth(sixMonthsLater_{{ $i }}.getMonth() + 6);
                const minPassportExpiryDate_{{ $i }} = sixMonthsLater_{{ $i }}.toISOString().split('T')[0];
                $(`#ped_{{ $i }}`).attr('min', minPassportExpiryDate_{{ $i }});
                $(`#ped_{{ $i }}`).change(function () {
                    const warning = $(`#warning_{{ $i }}`);
                    if (this.value < minPassportExpiryDate_{{ $i }}) {
                        warning.show();
                    } else {
                        warning.hide();
                    }
                });

                // Stay validation
                $(`#ida_{{ $i }}, #idd_{{ $i }}`).change(function () {
                    const arrivalDate = new Date($(`#ida_{{ $i }}`).val());
                    const departureDate = new Date($(`#idd_{{ $i }}`).val());
                    const stayWarning = $(`#stay-warning_{{ $i }}`);
                    if (arrivalDate && departureDate) {
                        const diffTime = Math.abs(departureDate - arrivalDate);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        if (diffDays > visaValidity) {
                            stayWarning.addClass('text-danger');
                            stayWarning.text(`Your stay exceeds the maximum allowed of ${visaValidity} day(s)`);
                        } else {
                            stayWarning.removeClass('text-danger');
                            stayWarning.text(`You have a maximum stay of ${visaValidity} day(s)`);
                        }
                    }
                });

                // Insurance handling
                $(`#yesInsurance_{{ $i }}`).change(function () {
                    $(`#coverageDaysInput_{{ $i }}`).hide();
                    $(`#selectedCoverageDays_{{ $i }}`).val('');
                    $(`#selectedPrice_{{ $i }}`).val('');
                    passengerCosts[{{ $i }}].insurancePrice = 0;
                    passengerCosts[{{ $i }}].coverageDays = '';
                    updateCostSummary();
                });
                // $(`#noInsurance_{{ $i }}`).change(function () {
                //     $(`#coverageDaysInput_{{ $i }}`).show();
                // });
                $(`#coverage_days_{{ $i }}`).change(function () {
                    const selectedOption = this.options[this.selectedIndex];
                    passengerCosts[{{ $i }}].coverageDays = selectedOption.textContent.trim();
                    passengerCosts[{{ $i }}].insurancePrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    $(`#selectedCoverageDays_{{ $i }}`).val(passengerCosts[{{ $i }}].coverageDays);
                    $(`#selectedPrice_{{ $i }}`).val(passengerCosts[{{ $i }}].insurancePrice);
                    updateCostSummary();
                });

                // Flight and hotel checkboxes
                $(`#flight_travelwheel_{{ $i }}`).change(function () {
                    passengerCosts[{{ $i }}].flightReservationFee = this.checked ? reserveFee : 0;
                    updateCostSummary();
                });
                $(`#agree_travelwheel_{{ $i }}`).change(function () {
                    passengerCosts[{{ $i }}].hotelAssistanceFee = this.checked ? hotelFee : 0;
                    updateCostSummary();
                });
            @endfor

            // Navigation between passengers
            let currentPassenger = 0;
            $('#nextPassenger').click(function () {
                if (currentPassenger < totalPassengers - 1) {
                    currentPassenger++;
                    $(`#collapse${currentPassenger}`).collapse('show');
                    $(`#collapse${currentPassenger - 1}`).collapse('hide');
                }
            });
            $('#prevPassenger').click(function () {
                if (currentPassenger > 0) {
                    currentPassenger--;
                    $(`#collapse${currentPassenger}`).collapse('show');
                    $(`#collapse${currentPassenger + 1}`).collapse('hide');
                }
            });

            // Form validation
            $('#kycForm').on('submit', function (e) {
                let isValid = true;
                $('.accordion-body').each(function () {
                    $(this).find('input[required], select[required]').each(function () {
                        if (!$(this).val()) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });
                });
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill all required fields.');
                }
            });

            // Initial cost summary update
            updateCostSummary();
        });

        // Employer and student visibility toggles
        function toggleEmployerVisibility(index) {
            const employerDetails = $(`#employer_details_${index}`);
            employerDetails.toggle($(`#employed_${index}`).is(':checked'));
            employerDetails.toggleClass('fade-down', $(`#employed_${index}`).is(':checked'));
            $(`#student_details_${index}`).hide();
        }
        function toggleStudentVisibility(index) {
            const studentDetails = $(`#student_details_${index}`);
            studentDetails.toggle($(`#student_${index}`).is(':checked'));
            studentDetails.toggleClass('fade-down', $(`#student_${index}`).is(':checked'));
            $(`#employer_details_${index}`).hide();
        }
    </script>
</body>
</html>