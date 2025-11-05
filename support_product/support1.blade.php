<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 15px;
      overflow: hidden;
    }
    .main-color {
      color: rgba(13, 24, 131, 1);
    }
    .bg-main {
      background-color: rgba(13, 24, 131, 1);
    }
    .btn-main {
      background-color: rgba(13, 24, 131, 1);
      color: white;
      border: none;
      transition: 0.3s ease;
    }
    .btn-main:hover {
      background-color: rgba(9, 18, 100, 1);
      color: #fff;
    }
    .form-section {
      display: none;
      transition: all 0.4s ease;
    }
    .price-display {
      font-size: 2.5rem;
      font-weight: bolder;
      text-align: center;
      color: rgba(13, 24, 131, 1);
      margin-top: 1.5rem;
    }
  </style>
</head>
<body class= "m-3">

<div class="container col-md-9">
  <div class="card shadow m-4">
    <div class="card-header bg-main text-white text-center py-3">
      <h4>FlightFlex Assist</h4>
    </div>
    <div class="card-body">

      {{-- ✅ Success Message --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- ❌ Error Message --}}
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif


      <form method="POST" action="{{ route('support.initiatePayment') }}">
        @csrf

        {{-- Row: Request type + Booking source --}}
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label">Select Request Type</label>
            <select name="request_type" id="request_type" class="form-select" required>
              <option value="">-- Choose Option --</option>
              <option value="date_change">Date Change</option>
              <option value="rerouting">Rerouting</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Confirm where you booked from</label>
            <select name="booking_source" id="booking_source" class="form-select" required>
              <option value="">-- Select Source --</option>
              <option value="airline">From Airline Website</option>
              <option value="agent">From Travelling Agent</option>
            </select>
          </div>
        </div>

        {{-- Agent Message --}}
        <div id="agent_message" class="alert alert-warning" style="display:none;">
          Please contact your travel agent for any changes or rerouting requests.
        </div>

        {{-- Airline Form --}}
        <div id="airline_form" class="form-section">
          <div class="row g-3">

            {{-- Name & Reference --}}
            <div class="col-md-6">
              <label class="form-label">Name on Ticket</label>
              <input type="text" name="name_on_ticket" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Airline Reference</label>
              <input type="text" name="airline_reference" class="form-control" required>
            </div>

            {{-- Airline Category & Selection --}}
            <div class="col-md-6">
              <label class="form-label">Select Airline Category</label>
              <select id="airline_category" name="airline_category" class="form-select" required>
                <option value="">-- Select Category --</option>
                <option value="local">Local Airline</option>
                <option value="international">International Airline</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Select Airline</label>
              <select id="airline" name="airline" class="form-select" required>
                <option value="">-- Select Airline --</option>
              </select>
            </div>

            {{-- Trip Type --}}
            <div class="col-md-6">
              <label class="form-label">Trip Type</label>
              <select name="trip_type" id="trip_type" class="form-select" required>
                <option value="">-- Select Trip Type --</option>
                <option value="one_way">One Way</option>
                <option value="round_trip">Round Trip</option>
              </select>
            </div>

            {{-- One Way Date --}}
            <div class="col-md-6" id="one_way_date" style="display:none;">
              <label class="form-label">Travel Date</label>
              <input type="date" name="travel_date_oneway" class="form-control">
            </div>

            {{-- Round Trip Dates (Side by side) --}}
            <div class="col-md-6" id="round_trip_dates" style="display:none;">
              <div class="row">
                <div class="col-md-6">
                  <label class="form-label">Departure Date</label>
                  <input type="date" name="departure_date" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Return Date</label>
                  <input type="date" name="return_date" class="form-control">
                </div>
              </div>
            </div>

            {{-- Route --}}
            <div class="col-md-6">
              <label class="form-label">Route From</label>
              <input type="text" name="route_from" class="form-control" placeholder="e.g., Lagos">
            </div>
            <div class="col-md-6">
              <label class="form-label">To</label>
              <input type="text" name="route_to" class="form-control" placeholder="e.g., Abuja">
            </div>

            {{-- Preferred Time --}}
            <div class="col-md-6">
              <label class="form-label">Preferred Time</label>
              <input type="text" name="preferred_time" class="form-control" placeholder="Morning / Evening">
            </div>

            {{-- Phone --}}
            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phone" class="form-control" required>
            </div>

            {{-- Email & Additional Info side by side --}}
            <div class="col-md-6">
              <label class="form-label">Email (as on ticket)</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Additional Information</label>
              <textarea name="additional_info" class="form-control" rows="1" placeholder="Provide more details if needed..."></textarea>
            </div>

          </div>

          {{-- Price Display --}}
          <div class="price-display" id="price_display">₦25,000</div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-main px-5 py-2 rounded-pill">
              Proceed to Payment
            </button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- Custom Script --}}
<script>
$(document).ready(function() {

  // Airline category logic
  $('#airline_category').on('change', function() {
    const category = $(this).val();
    const airlineSelect = $('#airline');
    airlineSelect.empty().append('<option value="">-- Select Airline --</option>');

    if (category === 'local') {
      airlineSelect.append(`
        <option value="Air Peace">Air Peace</option>
        <option value="Dana Air">Dana Air</option>
        <option value="Ibom Air">Ibom Air</option>
        <option value="Arik Air">Arik Air</option>
        <option value="Max Air">Max Air</option>
        <option value="United Nigeria">United Nigeria</option>
      `);
    } else if (category === 'international') {
      airlineSelect.append(`
        <option value="Qatar Airways">Qatar Airways</option>
        <option value="Emirates">Emirates</option>
        <option value="British Airways">British Airways</option>
        <option value="Ethiopian Airlines">Ethiopian Airlines</option>
        <option value="Lufthansa">Lufthansa</option>
      `);
    }
  });

  // Trip type logic
  $('#trip_type').on('change', function() {
    const tripType = $(this).val();
    if (tripType === 'one_way') {
      $('#one_way_date').show();
      $('#round_trip_dates').hide();
    } else if (tripType === 'round_trip') {
      $('#one_way_date').hide();
      $('#round_trip_dates').show();
    } else {
      $('#one_way_date, #round_trip_dates').hide();
    }
  });

  // Booking + Request toggle logic
  function toggleSections() {
    const requestType = $('#request_type').val();
    const bookingSource = $('#booking_source').val();

    if (bookingSource === 'agent') {
      $('#agent_message').fadeIn();
      $('#airline_form').slideUp();
    } else if ((requestType === 'date_change' || requestType === 'rerouting') && bookingSource === 'airline') {
      $('#agent_message').hide();
      $('#airline_form').slideDown();
    } else {
      $('#agent_message').hide();
      $('#airline_form').slideUp();
    }
  }

  $('#request_type, #booking_source').on('change', toggleSections);
});
</script>

</body>
</html>


