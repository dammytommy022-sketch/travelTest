<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Extra Luggage Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
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

        {{-- ✅ Extra Luggage Form --}}
        <form action="{{ url('extra_luggage/submit') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row g-4">
            <!-- Left Column -->
            <div class="col-md-6">

              <!-- Airline Category -->
              <div class="mb-3">
                <label for="airlineCategory" class="form-label fw-semibold">Airline Category</label>
                <select class="form-select" id="airlineCategory" required>
                  <option value="" selected disabled>Select Category</option>
                  <option value="local">Local</option>
                  <option value="international">International</option>
                </select>
              </div>

              <!-- Upload Data Page -->
              <div class="mb-3">
                <label for="dataPage" class="form-label fw-semibold">Upload Passport Data Page</label>
                <input type="file" class="form-control" id="dataPage" name="data_page" accept=".pdf,.jpg,.png" required>
                <div class="form-text">Accepted formats: PDF, JPG, PNG</div>
              </div>

              <!-- Contact Number -->
              <div class="mb-3">
                <label for="contactNumber" class="form-label fw-semibold">Contact Number</label>
                <input type="tel" class="form-control" id="contactNumber" name="contact_number" placeholder="Enter your contact number" required>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
              <!-- Airline -->
              <div class="mb-3">
                <label for="airline" class="form-label fw-semibold">Select Airline</label>
                <select class="form-select" id="airline" name="airline" required>
                  <option value="" selected disabled>Select Airline</option>
                </select>
              </div>

              <!-- Upload Ticket -->
              <div class="mb-3">
                <label for="ticket" class="form-label fw-semibold">Upload Ticket</label>
                <input type="file" class="form-control" id="ticket" name="ticket" accept=".pdf,.jpg,.png" required>
                <div class="form-text">Accepted formats: PDF, JPG, PNG</div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-main btn-lg px-4 rounded-3">Submit</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script>
    const categorySelect = document.getElementById('airlineCategory');
    const airlineSelect = document.getElementById('airline');

    const airlines = {
      local: [
        "Air Peace",
        "Arik Air",
        "Dana Air",
        "Ibom Air",
        "Overland Airways"
      ],
      international: [
        "Qatar Airways",
        "British Airways",
        "Ethiopian Airlines",
        "Emirates",
        "Turkish Airlines"
      ]
    };

    categorySelect.addEventListener('change', function() {
      const selectedCategory = this.value;
      airlineSelect.innerHTML = '<option value="" disabled selected>Select Airline</option>';

      if (airlines[selectedCategory]) {
        airlines[selectedCategory].forEach(airline => {
          const option = document.createElement('option');
          option.value = airline;
          option.textContent = airline;
          airlineSelect.appendChild(option);
        });
      }
    });

    // Wait until the page fully loads
    document.addEventListener('DOMContentLoaded', function() {
      const alertBox = document.getElementById('alert-message');
      if (alertBox) {
        setTimeout(() => {
          alertBox.style.transition = 'opacity 0.5s ease';
          alertBox.style.opacity = '0';
          setTimeout(() => alertBox.remove(), 500); // remove from DOM after fade-out
        }, 10000); // 10 seconds = 10000ms
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

