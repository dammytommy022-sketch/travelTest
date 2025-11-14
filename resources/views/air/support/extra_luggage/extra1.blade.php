<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extra Luggage Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom Styles for your main color theme */
        .main-color { color: rgba(13, 24, 131, 1); }
        .bg-main { background-color: rgba(13, 24, 131, 1); }
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
    </style>
</head>

<body class="m-3 bg-light">

    <div class="container col-md-9">
        <div class="card shadow border-0 rounded-4 m-4">
            <div class="card-header bg-main text-white text-center py-3">
                <h4>Extra Luggage Form</h4>
            </div>

            <div class="card-body p-4 p-md-5">

                {{-- ✅ Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success text-center" id="alert-message">{{ session('success') }}</div>
                @endif

                {{-- ✅ Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger" id="alert-message">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('air.extra_luggage.submit')}}" method="POST" enctype="multipart/form-data" id="luggageForm">
                    @csrf
                    <div class="row"> 
                        
                        {{-- LEFT COLUMN --}}
                        <div class="col-md-6">
                         
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Airline Category</label>
                                <select id="airlineCategory2" name="airline_category" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <option value="local">Local</option>
                                    <option value="international">International</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label for="ticket" class="form-label">Upload Ticket</label>
                                <input type="file" name="ticket" id="ticket" accept=".pdf,.jpg,.png" class="form-control" required>
                            </div>
                        </div>

                        {{-- RIGHT COLUMN --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" name="contact_number" id="contactNumber" class="form-control" placeholder="Enter your contact number" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Airline</label>
                                <select id="airline2" name="airline" class="form-select" required>
                                    <option value="">Select Airline</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dataPage" class="form-label">Upload Passport Data Page</label>
                                <input type="file" name="data_page" id="dataPage" accept=".pdf,.jpg,.png" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="paymentOption" class="form-label">Payment Option</label>
                                <select id="paymentOption" name="payment_option" class="form-select" required>
                                    <option value="">Select Payment Option</option>
                                    <option value="budpay">Budpay</option>
                                    <option value="seerbit">Seerbit</option>
                                </select>
                            </div>

                            <div class="price-display" id="price_display">
                              <input type="hidden" name="amount" id="hiddenAmountInput" value="25000"> 
                            </div>
                        </div>
                    </div>   
                    
                    <div class="text-center mt-2">
                      <p class="price-text">₦25,000</p>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-main px-5 py-2 rounded-pill">
                            Proceed to Payment
                        </button>
                    </div>
                  </form>       
            </div>
        </div>
    </div>

{{-- jQuery --}}
<script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {

    $('#airlineCategory2').on('change', function() {
        const category = $(this).val();
        const airlineSelect = $('#airline2');

        airlineSelect.empty().append('<option value="">Select Airline</option>');

        if (category === 'local') {
            airlineSelect.append(
            '<option value="Air Peace">Air Peace</option>' +
            '<option value="Azman Air">Azman Air</option>' +
            '<option value="Arik Air">Arik Air</option>' +
            '<option value="Dana Air">Dana Air</option>' +
            '<option value="Ibom Air">Ibom Air</option>' +
            '<option value="Max Air">Max Air</option>' +
            '<option value="United Nigeria">United Nigeria</option>'
        );

        }

        else if (category === 'international') {
            airlineSelect.append(
            '<option value="British Airways">British Airways</option>' +
            '<option value="Emirates">Emirates</option>' +
            '<option value="Qatar Airways">Qatar Airways</option>' +
            '<option value="Ethiopian Airlines">Ethiopian Airlines</option>' +
            '<option value="Lufthansa">Lufthansa</option>'
        );

        }

    });

});
</script>
</body>
</html>

