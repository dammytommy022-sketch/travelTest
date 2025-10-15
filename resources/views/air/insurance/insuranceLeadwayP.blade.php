<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/x-icon" href="{{ asset('assetsU/assets/img/favicon/twicon.png') }}" />
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
                                <img src="{{ asset('public/assets/image/leadway.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row airport-form shadow p-4 mb-5">
                <div class="col-sm-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">{{ $prodName }}</h5>
                            
                        </div>
                        <div class="card-body">
                            <form action="{{ route('air.insuranceLeadwayQ')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">      
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">Country</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-flag"></i></span>
                                                <select class="form-select" id="selection"  name="country" aria-label="Default select example" required>
                                                    <option value="">-- Select Country --</option>
                                                    @foreach($data['ctry'] as $contry)
                                                        <option value="{{ $contry['countryName'] }}">{{ $contry['countryName'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input class="form-control" type="hidden" name="prod_code"  id="prod_code" value="{{ $prodCode }}"/>
                                            </div>
                                        </div>
                                    </div>          
                                    <input type="hidden" class="form-control" name="prodCode"  value="{{ $prodCode }}">
                                    <div class="col-sm-3" >
                                        <div class="mb-3">
                                            <label class="form-label" for="nop">No. Of Passenger</label> 
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-users"></i></span>
                                                <input type="text" class="form-control"  id="numberInput1"  aria-describedby="basic-icon-default-fullname2" value="1 Person Per Pollicy"  readonly/>
                                                <input type="hidden" value="1" name="nop"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="service_date">Cover Begins</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input class="form-control" type="date" name="begin_date"  id="begin_date" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3"> 
                                            
                                            <label class="form-label" for="end_date">Cover Ends <b><span id="result" style="color:inherit;"></span></b></label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input class="form-control" type="date" name="end_date"  id="end_date" required/>
                                            </div>
                                             <small id="warning-msg" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">Surname</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input class="form-control" type="text" name="surname" id="surname" placeholder="Surname"
                                                aria-describedby="basic-icon-default-fullname2" required/>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">First Name</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input class="form-control" type="text" name="othername" id="othername" placeholder="First Name"
                                                aria-describedby="basic-icon-default-fullname2" required/>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">Other Name</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input class="form-control" type="text" name="lastname" id="lasstname" placeholder="Other Name"
                                                aria-describedby="basic-icon-default-fullname2" required/>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email Address</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone_no">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Your phone number"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">Gender</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                <select class="form-select" id="selection"  name="gender" aria-label="Default select example" required>
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="service_date">Date of Birth</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input class="form-control" type="date" name="dob" value="2000-02-02"  id="html5-date-input" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="address">Postal Address</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                <input type="text" class="form-control" name="address" id="address" placeholder="Your Address"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="city">City</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                <input type="text" class="form-control" name="city" id="city" placeholder="city"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="state">State</label>
                                            <div class="input-group input-group-merge">
                                                <span id="fullname" class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                <input type="text" class="form-control" name="state" id="state" placeholder="state"
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="state">Passport No.</label>
                                            <div class="input-group input-group-merge">
                                                <span id="passport" class="input-group-text"><i class="fa fa-globe"></i></span>
                                                <input type="text" class="form-control" name="passport_no" id="state" placeholder="Passport No."
                                                aria-describedby="basic-icon-default-fullname2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3 pt-4">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required/>
                                            <label class="form-check-label" for="defaultCheck1">I agreed to Terms & Services.</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="javascript:history.back()" class="btn btn-sm btn-secondary">
                                                    Back to Edit 
                                                </a>
                                            </div>
                                            <div class="col-6 text-end"> 
                                                <button type="submit" class="btn btn-pry" id="submitBtn" disabled>
                                                  Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>     
                    </div>
                </div>
               
            </div>
            </div>
    </section>

@include('layouts.footer')
</main>
<script>
  const prodCode    = document.getElementById('prod_code'); // hidden <input>
  const startInput  = document.getElementById('begin_date');
  const endInput    = document.getElementById('end_date');
  const resultSpan  = document.getElementById('result');
  const warningText = document.getElementById('warning-msg');
  const submitBtn   = document.getElementById('submitBtn');

  // --- mapping: product‑code ➜ allowed day‑ranges ---
  const rangeMap = {
    IPUM: [[11, 15], [22, 30]],
    IPHA: [[11, 15], [22, 30]],
    IPEX: [[11, 15], [22, 30]],
    IPPP: [[11, 15], [22, 30]],
    IPPB: [[11, 15], [22, 30]],
    IPSI: [[91, 180]],
    IPSE: [[91, 180]]
    // any other code = no length restriction
  };

  startInput.addEventListener('change', checkRange);
  endInput  .addEventListener('change', checkRange);

  function checkRange () {
    const start = new Date(startInput.value);
    const end   = new Date(endInput.value);

    // nothing to do until both dates exist
    if (isNaN(start) || isNaN(end)) {
      clearFeedback();
      return;
    }

    // inclusive difference
    const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
    resultSpan.textContent = `${days} day${days === 1 ? '' : 's'}`;

    // look up allowed ranges for this product
    const code      = (prodCode.value || '').trim().toUpperCase();
    const ranges    = rangeMap[code];          // undefined ⇒ no rule
    const isAllowed = !ranges || ranges.some(
      ([min, max]) => days >= min && days <= max
    );

    if (isAllowed) {
      setValid();
    } else {
      const niceRanges = ranges
        .map(([min, max]) => `${min}–${max} days`)
        .join(' or ');
      setInvalid(`Coverage must be ${niceRanges}.`);
    }
  }

  /* helper functions */
  function clearFeedback () {
    resultSpan.textContent  = '';
    warningText.textContent = '';
    submitBtn.disabled      = true;
  }
  function setValid () {
    warningText.textContent = '';
    resultSpan.style.color  = 'green';
    submitBtn.disabled      = false;
  }
  function setInvalid (msg) {
    warningText.textContent = msg;
    resultSpan.style.color  = 'red';
    submitBtn.disabled      = true;
  }

  // run once on page load in case default values are pre‑filled
  checkRange();
</script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</body>
</html>
