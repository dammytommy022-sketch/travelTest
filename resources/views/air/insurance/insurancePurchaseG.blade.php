<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Travel Insurance</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome-6/dist-font/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        .hidden {
        display: none;
        }
    </style>
    
</head>

<body>
    <!-- Navbar -->
    <section>
        @include('air.nav')
    </section>
    <!-- Navbar -->
    <main id="main" style="padding-top: 60px;">
        <section class="shadow-sm">
            <div class="container">
                <div class="row p-2 pt-5 ">
                    <div class="col-sm-12 p-3 ">
                    <div class="row">
                         <div class="col-xs-3 col-3 col-sm-2 col-lg-1">
                            <img src="../assets/img/ppi.png" class="image-fluid w-100" alt="protocol"> 
                         </div>
                         <div class="col-xs-12 col-12 col-sm-10 col-lg-7 protocol">
                             <h3>   Travel Insurance </h3>
                                <span class="text-muted">
                                   
                                Booking your Travel Insurance with us will give you a lot of benefits 
                                as our team and partners are always ready to follow up with your claim anytime.
                                </span>
                         </div>
                    </div>
                    </div>
                </div>
            
            <div class="row airport-form shadow p-4 mb-5">
                @if($dataRequest)
                <div class="col-sm-12 mb-3">
                    <div class="bg-light p-3 shadow-sm protocol" style="border-radius:15px;" > 
                        <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Insurance Family Purchase </h5>
                        <div class="card-body bg-light">
                            <h5>  PRICING</h5>
                            <p><b> The Qoute Price Is:</b> <span style="font-size:20px; font-weight: bolder;"> N{{$dataRequest->amount}}</span></p>
                        </div>
                    </div>
                </div>
                <form action="{{ url('/air/insurancePurchase')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="numberOfDuplicates" name="nop" value="{{$dataRequest->noOfPeople}}" />
                    <input type="hidden"  name="bookingTypeId" value="{{$dataRequest->bookingTypeId}}" />
                    <input type="hidden" class="form-control" name="qouteId" id="qouteId" value="{{$dataRequest->quoteRequestId}}" 
                        aria-describedby="basic-icon-default-fullname2"/>
                    <input type="hidden" class="form-control" name="amount" id="amount" value="{{$dataRequest->amount}}" 
                    aria-describedby="basic-icon-default-fullname2"/>
                    <div class="row">
                        <div class="hidden">
                            <div class="col-sm-12 group">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0" style="color: rgba(13, 156, 83, 1);">Customer Information</h6>
                                        <small class="text-muted float-end">
                                            Fill in Details
                                        </small>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="surname">Surname</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Your surname"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="Middlename">Middle Name</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                        <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Your middlename"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="firstname">Firstname</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Your Firstname"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="firstname">Gender</label>
                                                    <select class="form-select" name="gender" aria-label="Default select example">
                                                            <option value="">-- Select Gender --</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="firstname">Title</label>
                                                    <select class="form-select" name="title" aria-label="Default select example">
                                                            <option value="">-- Select Title --</option>
                                                            <option value="1">Alhaja</option>
                                                            <option value="2">Alhaji</option>
                                                            <option value="3">Amb.</option>
                                                            <option value="4">Barr.</option>
                                                            <option value="5">Bishop</option>
                                                            <option value="6">Captain</option>
                                                            <option value="7">Chief</option>
                                                            <option value="8">Chief (Mrs.)</option>
                                                            <option value="9">Deacon</option>
                                                            <option value="10">Deacon &amp; Deaconess</option>
                                                            <option value="11">Deaconess</option>
                                                            <option value="12">Dr.</option>
                                                            <option value="13">Dr. (Mrs.)</option>
                                                            <option value="14">Engr.</option>
                                                            <option value="15">H.R.H</option>
                                                            <option value="16">LEUT.</option>
                                                            <option value="17">LUET. COMMANDER</option>
                                                            <option value="18">Miss.</option>
                                                            <option value="19">Most Rev. Fr.</option>
                                                            <option value="20">Mr.</option>
                                                            <option value="21">Mr. &amp; Mrs.</option>
                                                            <option value="22">Mrs.</option>
                                                            <option value="23">Very Rev. Fr.</option>
                                                            <option value="24">Pastor</option>
                                                            <option value="25">Prince</option>
                                                            <option value="26">Prof.</option>
                                                            <option value="27">Rev.</option>
                                                            <option value="28">Rev. &amp; Mrs</option>
                                                            <option value="29">Rev. Fr.</option>
                                                            <option value="30">Sir</option>
                                                            <option value="31">Ven</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="service_date">Date of Birth</label>
                                                
                                                    <input class="form-control" type="date" name="dob" value=""  id="html5-date-input" />
                                                    
                                                </div>  
                                                <!-- \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dataRequest->dob)->format('d F Y')                        -->
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email">Email Address</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                        <input type="text" class="form-control" name="email" id="email" value="{{$dataRequest->email}}"  placeholder="Email Address"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="phone_no">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                                        <input type="text" class="form-control" name="phone_no" id="phone_no" value="{{$dataRequest->phone_no}}"  placeholder="Your phone number"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" id="state">
                                                <div class="mb-3">
                                                    <label class="form-label" for="firstname">State of Residence</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-flag"></i></span>
                                                        <select id="state" class="form-select" name="state">
                                                            <option value="">-- Select state --</option>
                                                            <option value="1">Abia State</option>
                                                            <option value="2">Adamawa State</option>
                                                            <option value="3">Akwa Ibom State</option>
                                                            <option value="4">Anambra State</option>
                                                            <option value="5">Bauchi State</option>
                                                            <option value="6">Bayelsa State</option>
                                                            <option value="7">Benue State</option>
                                                            <option value="8">Borno State</option>
                                                            <option value="9">Cross River State</option>
                                                            <option value="10">Delta State</option>
                                                            <option value="11">Ebonyi State</option>
                                                            <option value="12">Edo State</option>
                                                            <option value="13">Ekiti State</option>
                                                            <option value="14">Enugu State</option>
                                                            <option value="15">FCT</option>
                                                            <option value="16">Gombe State</option>
                                                            <option value="17">Imo State</option>
                                                            <option value="18">Jigawa State</option>
                                                            <option value="19">Kaduna State</option>
                                                            <option value="20">Kano State</option>
                                                            <option value="21">Katsina State</option>
                                                            <option value="22">Kebbi State</option>
                                                            <option value="23">Kogi State</option>
                                                            <option value="24">Kwara State</option>
                                                            <option value="25">Lagos State</option>
                                                            <option value="26">Nasarawa State</option>
                                                            <option value="27">Niger State</option>
                                                            <option value="28">Ogun State</option>
                                                            <option value="29">Ondo State</option>
                                                            <option value="30">Osun State</option>
                                                            <option value="31">Oyo State</option>
                                                            <option value="32">Plateau State</option>
                                                            <option value="33">Rivers State</option>
                                                            <option value="34">Sokoto State</option>
                                                            <option value="35">Taraba State</option>
                                                            <option value="36">Yobe State</option>
                                                            <option value="37">Zamfara State</option>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="service_date">Address</label>
                                                    <input class="form-control" type="text" name="address"  />
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3"> 
                                                    <label class="form-label" for="service_date">Zip Code</label>
                                                    <input class="form-control" type="text" name="zipcode"  />
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3"> 
                                                    <label class="form-label" for="service_date">Passport No.</label>
                                                    <input class="form-control" type="text" name="passport_no"  />
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3"> 
                                                    <label class="form-label" for="service_date">Occupation</label>
                                                    <input class="form-control" type="text" name="ocupation"  />
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="firstname">Marital Status</label>
                                                    <select class="form-select" name="marital_status" aria-label="Default select example">
                                                            <option value="">-- Marital Status  --</option>
                                                            <option value="1">Single</option>
                                                            <option value="2">Married</option>
                                                            <option value="3">Divorced</option>
                                                            <option value="4">Widowed</option>
                                                            <option value="5">Seperated</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3"> 
                                                    <label class="form-label" for="service_date">Nationalty</label>
                                                    <input class="form-control" type="text" name="nationalty"  />
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                            
                                                <div class="mb-3" id="medicalhid">
                                                    <label class="form-label" for="MedicalCondition">Pre-Existing Medical Conditions</label>
                                                    <input class="form-control text-box single-line" data-val="true" data-val-length="The field 
                                                    Details of Medical Conditions must be a string with a maximum length of 100." 
                                                    data-val-length-max="100" id="MedicalCondition" name="MedicalCondition" type="text" value="">
                                                </div>

                                            
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="duplicate-container"></div>
                       
                        
                        
                        
                        <div class="col-sm-12 text-end">
                                  <button type="submit" class="btn btn-pry">Purchase</button>
                       
                            </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
            
</section>

<!-- Move this script to the end of the Blade view or inside the <head> section -->
<script>
    function duplicateFormElements() {
        const numberOfDuplicates = parseInt(document.getElementById('numberOfDuplicates').value);

        if (isNaN(numberOfDuplicates) || numberOfDuplicates <= 0) {
            alert('Please enter a valid number greater than 0.');
            return;
        }

        const originalCard = document.querySelector('.group');
        const duplicateContainer = document.getElementById('duplicate-container');

        // Clear any existing duplicated cards
        duplicateContainer.innerHTML = '';

        for (let i = 1; i <= numberOfDuplicates; i++) {
            const newCard = originalCard.cloneNode(true);
            newCard.querySelector('h6').textContent = `Customer Information ${i}`; // Update the child number in the duplicated card
           
                // Update the attribute names for input and selection fields
            newCard.querySelectorAll('input').forEach(input => {
                    const currentName = input.getAttribute('name');
                    input.setAttribute('name', `${currentName}${i}`);
                });

                newCard.querySelectorAll('select').forEach(select => {
                    const currentName = select.getAttribute('name');
                    select.setAttribute('name', `${currentName}${i}`);
                });
           
            duplicateContainer.appendChild(newCard);
        }
    }

    // Automatically invoke the duplication function when the page loads
    window.addEventListener('load', duplicateFormElements);
</script>









<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    


    </main>
      @include('air.layout.footer')
</body>

</html>
