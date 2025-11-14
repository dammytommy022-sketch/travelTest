<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .btn-pill {
      border: 2px solid rgba(13, 24, 131, 1);
      border-radius: 50px;
      color: rgba(13, 24, 131, 1);
      background-color: white;
      padding: 8px 20px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-pill:hover {
      background-color: rgba(13, 24, 131, 0.1);
    }
    .co {
        text-decoration-color: rgba(13, 24, 131, 0.1);
    }

    .btn-pill.active {
      background-color: rgba(13, 24, 131, 1) !important;
      color: white !important;
    }

    .card {
      border-radius: 
    }
  </style>
</head>

<body class="m-3 bg-light">
  <div class="bg-light py-5">
    <div class="container">
      <div class="card shadow">
        <div class="text-center m-3">
          <h3 class=" co fw-bold">Support Products</h3>
          <p class="text-muted"></p>
        </div>

        {{-- ✅ Button-Style Pills Navigation --}}
        <ul class="nav nav-pills justify-content-center flex-wrap gap-2 mb-4" id="productTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link btn-pill" id="assist-tab" data-bs-toggle="pill" data-bs-target="#assist" type="button" role="tab">
              Flight Assist
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link btn-pill" id="extra-tab" data-bs-toggle="pill" data-bs-target="#extra" type="button" role="tab">
              Extra Luggage
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link btn-pill" id="visa-tab" data-bs-toggle="pill" data-bs-target="#visa" type="button" role="tab">
              Visa Confirmation
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link btn-pill" id="yellow-tab" data-bs-toggle="pill" data-bs-target="#yellow" type="button" role="tab">
              Yellow Card Assistance
            </button>
          </li>
        </ul>

        {{-- ✅ Tab Content --}}
        <div class="tab-content" id="productTabsContent">
          {{-- 1️⃣ Flight Assist --}}
          <div class="tab-pane fade" id="assist" role="tabpanel" aria-labelledby="assist-tab">
            <div class="">
            @include('air.support.ticketAssit.assit')
            </div>
          </div>

          {{-- 2️⃣ Extra Luggage --}}
          <div class="tab-pane fade" id="extra" role="tabpanel" aria-labelledby="extra-tab">
            <div class="card shadow p-4">
              @include('air.support.extra_luggage.extra1')
            </div>
          </div>

          {{-- 3️⃣ Visa Confirmation --}}
          <div class="tab-pane fade" id="visa" role="tabpanel" aria-labelledby="visa-tab">
            <div class="card shadow p-4">
              @include('air.support.visaConfirmation.visa_confirmation1')
            </div>
          </div>

          {{-- 4️⃣ Yellow Card Assistance --}}
          <div class="tab-pane fade" id="yellow" role="tabpanel" aria-labelledby="yellow-tab">
            <div class="card shadow p-4">
              @include('air.support.yellowCard.yellow_card1')
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
