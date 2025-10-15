<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>TravelWheel | Air - Visa </title>
  <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
  <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
  <style>
    .summary {
      display: flex;
      justify-content: flex-end;
      position: -webkit-sticky;
      position: sticky;
      top: 0;
    }

    .card {
      width: 300px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 20px;
      position: sticky;
      top: 20px;
    }

    .card h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 14px;
      line-height: 1.5;
    }

    .card .btn {
      display: inline-block;
      padding: 8px 16px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 10px;
    }

    .card .btn:hover {
      background-color: #0056b3;
    }

    .price-paragraph {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
    }

    .price {
      text-align: right;
    }

    .btn {
      display: inline-block;
      padding: 8px 16px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #0056b3;
    }
    
    #loading-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 10000;
    }

    #loading-screen img {
      width: 300px;
    }
  </style>
</head>

<body>
  <section>
    @include('layouts.newnav')
  </section>
 
  <main id="main" style="padding-top: 120px;" class="container">
    <div class="alert" id="alert" style="display: none;"></div>
@if ($fillableForm)
    <div style="
        border-left: 4px solid #0d9c53;
        background-color: #f9f9f9;
        padding: 16px 20px;
        border-radius: 6px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        margin-bottom: 20px;
    ">
        <strong style="color: #0d1883;">Action Required:</strong>  
        <p style="margin: 8px 0 0 0; font-size: 14.5px;">
            A fillable form is required for this visa. Please download, complete, and upload it below.
        </p>
        <a href="{{ asset($fillableForm) }}" download style="
            display: inline-block;
            margin-top: 12px;
            background-color: #0d9c53;
            color: #fff;
            padding: 8px 14px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        " onmouseover="this.style.backgroundColor='#0a7b41'" onmouseout="this.style.backgroundColor='#0d9c53'">
            Download Form
        </a>
    </div>
@endif


    <div class="row container">
      <div class="col-sm-1"></div>
      <div class="col-12 col-sm-10 files_send" style="display: block">
        <div class="card" style="width: 100%">
          <div class="card-body">
            <h5>Upload Required Document</h5>
            <p>To resume later, please save this <span id="token" style="display: none">{{ $token }}</span>
              <a href="#" id="copy-token-link">token for reference <i class="fa fa-clone" aria-hidden="true" style="font-size: 10px"></i></a>
            </p>
            <div class="alert alert-success alert-dismissible fade" role="alert" id="form_alert" style="display:none; font-size:12px;">
              <strong>Success!</strong> Token copied to clipboard.
            </div>

            <form action="{{ route('upload.files') }}" id="filess" method="POST" enctype="multipart/form-data">
              @csrf
                @if ($fillableForm)
                            <div class="mb-3">
                                <label class="form-label">Filled Visa Form <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="filled_form" accept=".pdf" required>
                                <small class="form-text text-muted">Upload the completed visa form that you downloaded.</small>
                            </div>
                        @endif

              <div class="row">
                {{-- Loop through each adult --}}
                @for ($i = 1; $i <= $adultCount; $i++)
                  <div class="col-12 border-bottom mb-3">
                    <h5>Adult {{ $i }}</h5>
                    <div class="row">
                      @foreach ($adultDocuments as $document)
                        @if ($country->hotel > 0 && stripos($document->document_name, 'hotel') !== false)
                          @continue
                        @endif
                        <div class="col-12 col-lg-6 mb-2">
                          <label for="adult_{{ $i }}_{{ $document->id }}" class="form-label"><b>{{ $document->document_name }}</b></label>
                          <input class="form-control" type="file" name="adult_{{ $i }}_{{ $document->id }}" id="adult_{{ $i }}_{{ $document->id }}" required>
                          <small class="text-danger error-message" id="error-adult_{{ $i }}_{{ $document->id }}"></small>
                        </div>
                      @endforeach
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="adult_{{ $i }}_hotel_reservation" class="form-label"><b>Hotel Reservation</b></label>
                        <input class="form-control" type="file" name="adult_{{ $i }}_hotel_reservation" id="adult_{{ $i }}_hotel_reservation">
                        <small class="text-danger error-message" id="error-adult_{{ $i }}_hotel_reservation"></small>
                      </div>
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="adult_{{ $i }}_flight_reservation" class="form-label"><b>Flight Reservation</b></label>
                        <input class="form-control" type="file" name="adult_{{ $i }}_flight_reservation" id="adult_{{ $i }}_flight_reservation">
                        <small class="text-danger error-message" id="error-adult_{{ $i }}_flight_reservation"></small>
                      </div>
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="adult_{{ $i }}_insurance" class="form-label"><b>Travel Insurance</b></label>
                        <input class="form-control" type="file" name="adult_{{ $i }}_insurance" id="adult_{{ $i }}_insurance">
                        <small class="text-danger error-message" id="error-adult_{{ $i }}_insurance"></small>
                      </div>
                    </div>
                  </div>
                @endfor

                {{-- Loop through each child --}}
                @for ($i = 1; $i <= $childCount; $i++)
                  <div class="col-12 border-bottom mb-3">
                    <h5>Child {{ $i }}</h5>
                    <div class="row">
                      @foreach ($childDocuments as $document)
                        @if ($country->hotel > 0 && stripos($document->document_name, 'hotel') !== false)
                          @continue
                        @endif
                        <div class="col-12 col-lg-6 mb-2">
                          <label for="child_{{ $i }}_{{ $document->id }}" class="form-label"><b>{{ $document->document_name }}</b></label>
                          <input class="form-control" type="file" name="child_{{ $i }}_{{ $document->id }}" id="child_{{ $i }}_{{ $document->id }}" required>
                          <small class="text-danger error-message" id="error-child_{{ $i }}_{{ $document->id }}"></small>
                        </div>
                      @endforeach
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="child_{{ $i }}_hotel_reservation" class="form-label"><b>Hotel Reservation</b></label>
                        <input class="form-control" type="file" name="child_{{ $i }}_hotel_reservation" id="child_{{ $i }}_hotel_reservation">
                        <small class="text-danger error-message" id="error-child_{{ $i }}_hotel_reservation"></small>
                      </div>
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="child_{{ $i }}_flight_reservation" class="form-label"><b>Flight Reservation</b></label>
                        <input class="form-control" type="file" name="child_{{ $i }}_flight_reservation" id="child_{{ $i }}_flight_reservation">
                        <small class="text-danger error-message" id="error-child_{{ $i }}_flight_reservation"></small>
                      </div>
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="child_{{ $i }}_insurance" class="form-label"><b>Travel Insurance</b></label>
                        <input class="form-control" type="file" name="child_{{ $i }}_insurance" id="child_{{ $i }}_insurance">
                        <small class="text-danger error-message" id="error-child_{{ $i }}_insurance"></small>
                      </div>
                    </div>
                  </div>
                @endfor

                {{-- Loop through each infant --}}
                @for ($i = 1; $i <= $infantCount; $i++)
                  <div class="col-12 border-bottom mb-3">
                    <h5>Infant {{ $i }}</h5>
                    <div class="row">
                      @foreach ($infantDocuments as $document)
                        @if ($country->hotel > 0 && stripos($document->document_name, 'hotel') !== false)
                          @continue
                        @endif
                        <div class="col-12 col-lg-6 mb-2">
                          <label for="infant_{{ $i }}_{{ $document->id }}" class="form-label"><b>{{ $document->document_name }}</b></label>
                          <input class="form-control" type="file" name="infant_{{ $i }}_{{ $document->id }}" id="infant_{{ $i }}_{{ $document->id }}" required>
                          <small class="text-danger error-message" id="error-infant_{{ $i }}_{{ $document->id }}"></small>
                        </div>
                      @endforeach
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="infant_{{ $i }}_hotel_reservation" class="form-label"><b>Hotel Reservation</b></label>
                        <input class="form-control" type="file" name="infant_{{ $i }}_hotel_reservation" id="infant_{{ $i }}_hotel_reservation">
                        <small class="text-danger error-message" id="error-infant_{{ $i }}_hotel_reservation"></small>
                      </div>
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="infant_{{ $i }}_flight_reservation" class="form-label"><b>Flight Reservation</b></label>
                        <input class="form-control" type="file" name="infant_{{ $i }}_flight_reservation" id="infant_{{ $i }}_flight_reservation">
                        <small class="text-danger error-message" id="error-infant_{{ $i }}_flight_reservation"></small>
                      </div>
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="infant_{{ $i }}_insurance" class="form-label"><b>Travel Insurance</b></label>
                        <input class="form-control" type="file" name="infant_{{ $i }}_insurance" id="infant_{{ $i }}_insurance">
                        <small class="text-danger error-message" id="error-infant_{{ $i }}_insurance"></small>
                      </div>
                    </div>
                  </div>
                @endfor
              </div>
              <div class="progress mb-3" style="height: 25px; display: none;">
                <div id="upload-progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>
              <button id="upload-btn" type="submit" class="btn btn-primary">Upload Files</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-10 col-12 payment" style="display: none">
        <div class="sticky-top card" style="width:100%;">
          <div class="payment-summary">
            <h3>Payment Summary</h3>
            <div id="dynamic-payment-summary">
              <!-- Dynamically populated based on file uploads -->
            </div>
            @if ($adultCount > 0)
              @if ($prices->visa_payment_to === 'travelwheel')
                <p class="price-paragraph">Visa Fees(Adult) x {{ $adultCount }} <span class="price">₦<span id="visa_fee_adult">{{ number_format($adultvisa, 2) }}</span></span></p>
              @endif
            @endif
            @if ($childCount > 0)
              @if ($prices->visa_payment_to === 'travelwheel')
                <p class="price-paragraph">Visa Fees(Child) x {{ $childCount }} <span class="price">₦<span id="visa_fee_child">{{ number_format($childvisa, 2) }}</span></span></p>
              @endif
            @endif
            @if ($infantCount > 0)
              @if ($prices->visa_payment_to === 'travelwheel')
                <p class="price-paragraph">Visa Fees(Infant) x {{ $infantCount }} <span class="price">₦<span id="visa_fee_infant">{{ number_format($infantvisa, 2) }}</span></span></p>
              @endif
            @endif
            @if ($prices->bio_payment_to === 'travelwheel')
              @if ($adultCount > 0)
                <p class="price-paragraph">Biometrics Fees(Adult) x {{ $adultCount }} <span class="price">₦<span id="biometrics_fee_adult">{{ number_format($adultbio, 2) }}</span></span></p>
              @endif
              @if ($childCount > 0)
                <p class="price-paragraph">Biometrics Fees(Child) x {{ $childCount }} <span class="price">₦<span id="biometrics_fee_child">{{ number_format($childbio, 2) }}</span></span></p>
              @endif
              @if ($infantCount > 0)
                <p class="price-paragraph">Biometrics Fees(Infant) x {{ $infantCount }} <span class="price">₦<span id="biometrics_fee_infant">{{ number_format($infantbio, 2) }}</span></span></p>
              @endif
            @endif
            <p class="price-paragraph">Admin Charge <span class="price">₦<span id="admin_charge">{{ number_format($country->admin_charge, 2) }}</span></span></p>
            @if ($all === 'travelwheel')
              <p class="price-paragraph">Other Charges x {{ $total_count }} <span class="price">₦<span id="charge">{{ number_format($allchargeall) }}</span></span></p>
            @endif
            <p class="price-paragraph">VAT <span class="price">₦<span id="vat">{{ $vat }}</span></span></p>
            <h6 class="price-paragraph">Total Due to TravelWheel <span class="price">₦<span id="total">{{ number_format($total) }}</span></span></h6>
            <form id="paymentForm" action="/visa_checkout" method="POST">
              @csrf
              <input type="hidden" name="payment_method" value="both" />
              <input type="hidden" name="amount" id="amount" value="{{ $total }}">
              <input type="hidden" name="email" id="email" value="{{ $country->email }}">
              <input type="hidden" name="country" value="NG" />
              <input type="hidden" name="currency" value="NGN" />
              <input type="hidden" name="missing_hotel_count" id="missing_hotel_count" value="0">
              <input type="hidden" name="missing_flight_count" id="missing_flight_count" value="0">
              <input type="hidden" name="missing_insurance_count" id="missing_insurance_count" value="0">
              <div style="bottom: 0;">
                <center><button type="submit" class="btn">Pay now</button></center>
              </div>
            </form>
            <hr>
            <h6>Please note that the sum of <b class="text-danger" style="font-size:16px; font-weight:700;"><span id="symbol" class="text-danger">NGN </span>{{ $embassy_pay }}</b> is required to be paid at the embassy. Thank you.</h6>
          </div>
        </div>
      </div>
    </div>
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
        <li><p>Visas for any form of trafficking are strictly prohibited by <b>TravelWheel.</b></p></li>
      </ul>
    </div>
    <div id="myModal" class="modal fade">
      <div class="modal-dialog modal-confirm">
        <div class="modal-content">
          <div class="modal-header">
            <div class="icon-box">
              <i class="fas fa-check"></i>
            </div>
            <h4 class="modal-title w-100">Awesome!</h4>
          </div>
          <div class="modal-body">
            <p class="text-center">Your booking has been confirmed. Check your email for details.</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <div id="loading-screen" style="display: none;">
      <img src="{{ asset('public/assets/dist/loading.mp4') }}" alt="Loading...">
      <p>Loading... Please wait.</p>
    </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://seerbitapi.com/api/v2/seerbit.js"></script>
  <script>
    // Function to copy token to clipboard
    function copyTokenToClipboard(event) {
      event.preventDefault();
      const tokenElement = document.getElementById('token');
      const token = tokenElement.innerText;
      const textarea = document.createElement('textarea');
      textarea.value = token;
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
      const alertElement = document.getElementById('form_alert');
      alertElement.classList.add('alert-success', 'show');
      alertElement.style.display = 'block';
      setTimeout(function() {
        alertElement.style.display = 'none';
        alertElement.classList.remove('show');
      }, 3000);
    }
    document.getElementById('copy-token-link').addEventListener('click', copyTokenToClipboard);

    // Function to update payment summary based on file uploads
    function updatePaymentSummary() {
      const adultCount = {{ $adultCount }};
      const childCount = {{ $childCount }};
      const infantCount = {{ $infantCount }};
      const hotelPrice = {{ $hotel }};
      const flightPrice = {{ $flight }};
      const insurancePrice = {{ $insurance }};
      
      const visaFeeAdult = parseFloat(document.getElementById('visa_fee_adult')?.innerText.replace(/,/g, '') || 0);
      const visaFeeChild = parseFloat(document.getElementById('visa_fee_child')?.innerText.replace(/,/g, '') || 0);
      const visaFeeInfant = parseFloat(document.getElementById('visa_fee_infant')?.innerText.replace(/,/g, '') || 0);
      const bioFeeAdult = parseFloat(document.getElementById('biometrics_fee_adult')?.innerText.replace(/,/g, '') || 0);
      const bioFeeChild = parseFloat(document.getElementById('biometrics_fee_child')?.innerText.replace(/,/g, '') || 0);
      const bioFeeInfant = parseFloat(document.getElementById('biometrics_fee_infant')?.innerText.replace(/,/g, '') || 0);
      const adminCharge = parseFloat(document.getElementById('admin_charge')?.innerText.replace(/,/g, '') || 0);
      const otherCharges = parseFloat(document.getElementById('charge')?.innerText.replace(/,/g, '') || 0);
      const vat = parseFloat(document.getElementById('vat')?.innerText.replace(/,/g, '') || 0);
      
      const baseTotal = visaFeeAdult + visaFeeChild + visaFeeInfant + bioFeeAdult + bioFeeChild + bioFeeInfant + adminCharge + otherCharges + vat;
      
      let missingHotel = 0, missingFlight = 0, missingInsurance = 0;
      let summaryHtml = '';

      // Check adults
      for (let i = 1; i <= adultCount; i++) {
        const hotelInput = document.getElementById(`adult_${i}_hotel_reservation`);
        const flightInput = document.getElementById(`adult_${i}_flight_reservation`);
        const insuranceInput = document.getElementById(`adult_${i}_insurance`);
        
        console.log(`Adult ${i}:`);
        console.log(`  Hotel files:`, hotelInput?.files?.length || 0);
        console.log(`  Flight files:`, flightInput?.files?.length || 0);
        console.log(`  Insurance files:`, insuranceInput?.files?.length || 0);
        
        if (hotelInput && (!hotelInput.files || hotelInput.files.length === 0)) {
          missingHotel++;
          console.log(`  Missing hotel for adult ${i}`);
        }
        if (flightInput && (!flightInput.files || flightInput.files.length === 0)) {
          missingFlight++;
          console.log(`  Missing flight for adult ${i}`);
        }
        if (insuranceInput && (!insuranceInput.files || insuranceInput.files.length === 0)) {
          missingInsurance++;
          console.log(`  Missing insurance for adult ${i}`);
        }
      }

      // Check children
      for (let i = 1; i <= childCount; i++) {
        const hotelInput = document.getElementById(`child_${i}_hotel_reservation`);
        const flightInput = document.getElementById(`child_${i}_flight_reservation`);
        const insuranceInput = document.getElementById(`child_${i}_insurance`);
        
        if (hotelInput && (!hotelInput.files || hotelInput.files.length === 0)) {
          missingHotel++;
        }
        if (flightInput && (!flightInput.files || flightInput.files.length === 0)) {
          missingFlight++;
        }
        if (insuranceInput && (!insuranceInput.files || insuranceInput.files.length === 0)) {
          missingInsurance++;
        }
      }

      // Check infants
      for (let i = 1; i <= infantCount; i++) {
        const hotelInput = document.getElementById(`infant_${i}_hotel_reservation`);
        const flightInput = document.getElementById(`infant_${i}_flight_reservation`);
        const insuranceInput = document.getElementById(`infant_${i}_insurance`);
        
        if (hotelInput && (!hotelInput.files || hotelInput.files.length === 0)) {
          missingHotel++;
        }
        if (flightInput && (!flightInput.files || flightInput.files.length === 0)) {
          missingFlight++;
        }
        if (insuranceInput && (!insuranceInput.files || insuranceInput.files.length === 0)) {
          missingInsurance++;
        }
      }

      // Update hidden inputs with missing counts
      document.getElementById('missing_hotel_count').value = missingHotel;
      document.getElementById('missing_flight_count').value = missingFlight;
      document.getElementById('missing_insurance_count').value = missingInsurance;

      // Calculate new total based on missing documents only
      let newTotal = baseTotal + (missingHotel * hotelPrice) + (missingFlight * flightPrice) + (missingInsurance * insurancePrice);

      // Generate summary HTML for missing documents
      if (missingHotel > 0) {
        summaryHtml += `<p class="price-paragraph">Hotel Reservation x ${missingHotel} <span class="price">₦<span>${(missingHotel * hotelPrice).toLocaleString('en-NG', {minimumFractionDigits: 2})}</span></span></p>`;
      }
      if (missingFlight > 0) {
        summaryHtml += `<p class="price-paragraph">Flight Reservation x ${missingFlight} <span class="price">₦<span>${(missingFlight * flightPrice).toLocaleString('en-NG', {minimumFractionDigits: 2})}</span></span></p>`;
      }
      if (missingInsurance > 0) {
        summaryHtml += `<p class="price-paragraph">Travel Insurance x ${missingInsurance} <span class="price">₦<span>${(missingInsurance * insurancePrice).toLocaleString('en-NG', {minimumFractionDigits: 2})}</span></span></p>`;
      }

      // Debug logging
      console.log('Base Total:', baseTotal);
      console.log('Hotel Price:', hotelPrice, 'Missing:', missingHotel);
      console.log('Flight Price:', flightPrice, 'Missing:', missingFlight);
      console.log('Insurance Price:', insurancePrice, 'Missing:', missingInsurance);
      console.log('Summary HTML:', summaryHtml);
      console.log('Missing - Hotel:', missingHotel, 'Flight:', missingFlight, 'Insurance:', missingInsurance);
      console.log('New Total:', newTotal);

      // Update the payment summary and total
      const dynamicSummaryElement = document.getElementById('dynamic-payment-summary');
      if (dynamicSummaryElement) {
        dynamicSummaryElement.innerHTML = summaryHtml;
        console.log('Updated dynamic summary element');
      } else {
        console.error('dynamic-payment-summary element not found');
      }
      
      const totalElement = document.getElementById('total');
      if (totalElement) {
        totalElement.innerText = newTotal.toLocaleString('en-NG', {minimumFractionDigits: 2});
        console.log('Updated total element to:', newTotal.toLocaleString('en-NG', {minimumFractionDigits: 2}));
      } else {
        console.error('total element not found');
      }
      
      const amountElement = document.getElementById('amount');
      if (amountElement) {
        amountElement.value = newTotal.toFixed(2);
        console.log('Updated amount element to:', newTotal.toFixed(2));
      } else {
        console.error('amount element not found');
      }
    }

    // Update payment summary on file input change
    document.querySelectorAll('input[type="file"]').forEach(input => {
      input.addEventListener('change', updatePaymentSummary);
    });

    // Initial update of payment summary
    document.addEventListener('DOMContentLoaded', updatePaymentSummary);

    // File upload handling
    function uploadFiles(event) {
      event.preventDefault();
      const formData = new FormData($('form')[0]);
      $('#upload-btn').html('Uploading...').prop('disabled', true);
      $('.progress').show();
      $.ajax({
        url: '{{ route('upload.files') }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = Math.round((evt.loaded / evt.total) * 100);
              $('#upload-progress-bar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete).text(percentComplete + '%');
            }
          }, false);
          return xhr;
        },
        success: function(response) {
          $('#alert').addClass('alert-success').removeClass('alert-danger').html('Files uploaded successfully, You can proceed to payment').show();
          $('.payment').css('display', 'block');
          $('.files_send').hide();
          $('#pay-now-btn').prop('disabled', false);
          updatePaymentSummary(); // Call after successful upload
        },
        error: function(xhr, status, error) {
          $('#alert').addClass('alert-danger').removeClass('alert-success').html('Error uploading files. Please try again.').show();
          $('#upload-btn').html('Upload Files').prop('disabled', false);
          $('.progress').hide();
          $('#upload-progress-bar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
        }
      });
    }
    $('#filess').submit(uploadFiles);

    // Show loading screen on payment form submission
    $('#paymentForm').submit(function(event) {
      $('#loading-screen').show();
    });

    // Check URL for payment parameter
    function checkPaymentURL() {
      const urlParams = new URLSearchParams(window.location.search);
      const payment = urlParams.get('payment');
      if (payment && payment.toLowerCase() === 'true') {
        $('.payment').css('display', 'block');
        $('.files_send').hide();
        $('#pay-now-btn').prop('disabled', false);
      }
    }
    $(document).ready(function() {
      checkPaymentURL();
    });

    // File size validation
    document.getElementById('filess').addEventListener('submit', function(event) {
      const maxSize = 2 * 1024 * 1024;
      const fileInputs = document.querySelectorAll('input[type="file"]');
      let valid = true;
      document.querySelectorAll('.error-message').forEach(function(element) {
        element.textContent = '';
      });
      fileInputs.forEach(function(input) {
        if (input.files.length > 0) {
          const file = input.files[0];
          if (file.size > maxSize) {
            valid = false;
            const errorElement = document.getElementById('error-' + input.id);
            if (errorElement) {
              errorElement.textContent = 'File size exceeds 2MB limit.';
            }
          }
        }
      });
      if (!valid) {
        event.preventDefault();
        alert('One or more files exceed the 2MB size limit. Please upload smaller files.');
      }
    });
    document.querySelectorAll('input[type="file"]').forEach(function(input) {
      input.addEventListener('change', function() {
        const maxSize = 2 * 1024 * 1024;
        const errorElement = document.getElementById('error-' + input.id);
        if (input.files.length > 0 && input.files[0].size > maxSize) {
          errorElement.textContent = 'File size exceeds 2MB limit.';
          input.value = '';
        } else {
          errorElement.textContent = '';
        }
      });
    });
  </script>
</body>
</html>