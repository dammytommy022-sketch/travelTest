<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <title>Travel Wheel </title>
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <script src="https://kit.fontawesome.com/b1c7dc27be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/styleslide.css') }}">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
    integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
    integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* General Styles */
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }

    h4,
    h5,
    h6 {
      color: #343a40;
    }

    /*#main {*/
    /*  margin-top: 70px;*/
    /*}*/


    .filters {

      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: -webkit-sticky;
      /* For Safari */
      position: sticky;
      top: 20px;
      /* Adjust this value based on your layout */
      height: calc(100vh - 20px);
      /* Keep it within the viewport */
      overflow-y: auto;
      /* Enable vertical scrolling if content overflows */
      border: 1px solid #dee2e6;
      /* Optional: Border for better visibility */
      border-radius: 20px;
      /* Optional: Rounded corners */
      padding: 15px;
      /* Optional: Add some padding */
      background-color: #fff;
      /* Ensure it stands out */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      /* Optional: Add a subtle shadow */
    }

    /* Hide scrollbar for WebKit browsers (Chrome, Safari) */
    .filters::-webkit-scrollbar {
      display: none;
      /* Hide scrollbar */
    }

    /* Hide scrollbar for Firefox */
    .filters {
      scrollbar-width: none;
      /* Hide scrollbar */
    }

    /* Optional: Style for the cards within filters */
    .filter_card {
      margin-bottom: 15px;
      /* Spacing between cards */
      border: 1px solid #e0e0e0;
      /* Card border */
      border-radius: 5px;
      /* Rounded corners for cards */
    }

    .filters h5 {
      font-weight: bold;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .card-title {
      margin-bottom: 15px;
    }

    .form-check-label {
      margin-left: 8px;
    }

    #priceRange {
      accent-color: #007bff;
      /* Customize the color of the range slider */
    }

    #applyFilters {
      border-radius: 20px;
      font-weight: bold;
    }

    #minPrice,
    #maxPrice {
      font-size: 14px;
      color: #555;
    }



    /* Hotel Card Styling */
    .hotel-card {
      margin-top: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      display: flex;
      flex: 0 0 auto;
      width: 100%;
      max-width: 100%;
    }

    .hotel-card img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .hotel-image {
      position: relative;
      flex: 0 0 40%;
      height: auto;
      /* Adjust based on content */
      display: flex;
      /* Allows the image to grow to fill the space */
      align-items: stretch;
    }

    .hotel-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Ensures the image covers the entire container */
      border-radius: 10px 0 0 10px;
    }

    /* Heart icon (wishlist) */
    .wishlist-icon {
      position: absolute;
      top: 10px;
      left: 10px;
      font-size: 1.5rem;
      color: #fff;
      background-color: rgba(0, 0, 0, 0.5);
      padding: 10px;
      border-radius: 50%;
    }

    /* Max capacity badge */
    .max-capacity {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #fff;
      padding: 5px 10px;
      border-radius: 20px;
      color: #007bff;
      font-size: 0.85rem;
      font-weight: bold;
    }

    .carousel-indicator {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 2px 8px;
      border-radius: 5px;
      font-size: 0.9rem;
    }

    .hotel-details {

      width: 60%;
      /* Adjust width as needed */
    }

    #HotelName {
      font-size: 16px;
      font-weight: bold;
      color: #007bff;

    }

    .hotel-details small {
      color: #495057;
      font-size: 12px;
    }

    .review-section {
      display: flex;
      align-items: center;
      justify-content: space-between;

    }

    .review-section small {

      color: #6c757d;
    }

    .rating-badge {
      background-color: #8bc34a;
      color: white;
      font-size: 1.2rem;
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: bold;
    }

    .room-info {
      background-color: #f1f1f1;
      padding: 10px;
      border-radius: 5px;
      margin-top: 10px;
    }

    .room-info p {
      font-size: 0.9rem;
      margin: 0;
    }

    .room-info-icons {
      font-size: 0.9rem;
    }

    .room-info-icons i {
      margin-right: 10px;
      color: #6c757d;
    }

    .price-section {
      font-weight: bold;
      margin-top: 5px;
      font-size: 1.1rem;
      color: #212529;
    }

    .price-section small {
      font-size: 0.8rem;
      color: #6c757d;
    }

    .btn-rooms {
      background-color:#068b59;
      margin-top: 10px;
      font-size: 0.95rem;
      padding: 10px;
      border-radius: 5px;
    }
    
    .btn-rooms:hover{
        background-color:#068b59;
    }

    /* Responsive Spacing */
    @media (max-width: 768px) {
      .hotel-listings {
        padding-left: 0;
      }

      .filters {
        margin-bottom: 20px;
      }

      .hotel-cards-container {
        flex-direction: column;
      }

      .hotel-card {
        flex-direction: column;
        margin-bottom: 20px;
      }

      .hotel-image {
        width: 100%;
        height: auto;
      }

      .hotel-details {
        padding: 10px;
        width: 100%;
      }
    }

    .pagination-links nav ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: flex;
      justify-content: flex-end;
    }

    .pagination-links .page-item {
      margin: 0 5px;
    }

    .pagination-links .page-item .page-link {
      padding: 8px 16px;
      font-size: 14px;
      color: #5a5a5a;
      background-color: #f0f0f0;
      border: 1px solid #e0e0e0;
      border-radius: 25px;
      transition: all 0.3s ease;
      display: inline-block;
      text-decoration: none;
    }

    .pagination-links .page-item a.page-link:hover {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
    }

    .pagination-links .page-item span.disabled {
      color: #c0c0c0;
      background-color: #e9ecef;
      cursor: not-allowed;
      border-color: #e0e0e0;
    }

    .pagination-links .page-item .page-link {
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .pagination-links .page-item .page-link:hover {
      box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.3);
    }
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    flex-direction: column; /* Centers the image and text vertically */
}

.loader img {
    width: 500px; /* Adjust width as per your requirement */
    height: auto; /* Maintains aspect ratio */
}
.wishlist-icon {
    color: #fff !important;
}

  </style>
  
</head>

<body>
<!--              <div id="preloader" style="display: none;">-->
<!--    <div class="loader"> <img src="{{ asset('/public/assets/loading.gif') }}" alt="Logo"></div>-->
<!--    <p>Searching Hotels, please wait...</p>-->
<!--</div-->
    <section>
        @include('layouts.topnav')
        @include('layouts.newnav')
    </section>
    <main id="main" class="mb-3 ">
        <div class="container-fluid">
            <div class="row mt-4">
              <!-- Filters Sidebar -->
<div class="col-md-3 d-none d-md-block filters">
        <h5 class="mb-3"style="color:#0d1883;">Filter Hotels</h5>
        <form action="{{ route('filter.hotels') }}" method="GET">
              @foreach (request()->all() as $key => $value)
        @if (!in_array($key, ['page'])) <!-- Exclude 'page' from being passed in the form -->
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach
          <div class="mb-3">
            <div class="card-body">
              <h6 class="card-title text-secondary">Sort by</h6>
              <select class="form-select" name="sort_by" id="sortFilter">
                <option value="popularity" {{ request('sort_by') == 'popularity' ? 'selected' : '' }}>Popularity</option>
            <option value="low_to_high" {{ request('sort_by') == 'low_to_high' ? 'selected' : '' }}>Price (Low to High)</option>
            <option value="high_to_low" {{ request('sort_by') == 'high_to_low' ? 'selected' : '' }}>Price (High to Low)</option>
            <option value="star_rating" {{ request('sort_by') == 'star_rating' ? 'selected' : '' }}>Star Rating</option>

              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="card-body">
              <h6 class="card-title text-secondary">Hotel Name</h6>
              <input type="text" name="hotel_name" class="form-control" id="" value="{{ request('hotel_name') ?? '' }}">
            </div>
          </div>

          <!-- Star Rating -->
          <!--<div class="card filter_card mb-4">-->
          <!--  <div class="card-body">-->
          <!--    <h6 class="card-title text-secondary">Star Rating</h6>-->
          <!--    <select name="star_rating" class="form-select">-->
          <!--      <option value="">Any</option>-->
          <!--     <option value="1" {{ request('star_rating') == 1 ? 'selected' : '' }}>-->
          <!--  <i class="las la-star"></i> 1 Stars-->
          <!--</option>-->
          <!--<option value="2" {{ request('star_rating') == 2 ? 'selected' : '' }}>-->
          <!--  <i class="las la-star text-warning"></i><i class="las la-star"></i> 2 Stars-->
          <!--</option>-->
          <!--<option value="3" {{ request('star_rating') == 3 ? 'selected' : '' }}>-->
          <!--  <i class="las la-star text-warning"></i><i class="las la-star"></i><i class="las la-star"></i> 3 Stars-->
          <!--</option>-->
          <!--<option value="4" {{ request('star_rating') == 4 ? 'selected' : '' }}>-->
          <!--  <i class="las la-star text-warning"></i><i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i> 4 Stars-->
          <!--</option>-->
          <!--<option value="5" {{ request('star_rating') == 5 ? 'selected' : '' }}>-->
          <!--  <i class="las la-star text-warning"></i><i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i> 5 Stars-->
          <!--</option>-->
          <!--    </select>-->
          <!--  </div>-->
          <!--</div>-->

          <!-- Price Range -->
          <div class="mb-3">
            <div class="card-body">
              <h6 class="card-title text-secondary">Price Range</h6>
              <div class="d-flex align-items-center">
                <input type="number" name="min" class="form-control me-2" id="minPriceInput" placeholder="Min Price"
                  value="{{ request('min') ?? '' }}">
                <input type="number" name="max" class="form-control" id="maxPriceInput" placeholder="Max Price"
                  value="{{ request('max') ?? '' }}">
              </div>
              <input type="range" class="form-range mt-3" min="1000" max="1000000" id="priceRange" hidden>
              <div class="d-flex justify-content-between">
                <span hidden>₦<span id="currentMinPrice">1000</span></span>
                <span hidden>₦<span id="currentMaxPrice">1000000</span></span>
              </div>
            </div>
          </div>


          <div class="mb-3">
            <div class="card-body">
              <h6 class="card-title text-secondary">Meal</h6>
              <select name="meal_type" class="form-select">
                <option value="">Any</option>
                <option value="nomeal" {{ request('meal_type') == 'nomeal' ? 'selected' : '' }}>No Meal</option>
                <option value="breakfast" {{ request('meal_type') == 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                               <option value="breakfast-for-1" {{ request('meal_type') == 'breakfast-for-1' ? 'selected' : '' }}>Breakfast For One</option>
                <option value="breakfast-for-2" {{ request('meal_type') == 'breakfast-for-2' ? 'selected' : '' }}>Breakfast For Two</option>
                <option value="full-board" {{ request('meal_type') == 'full-board' ? 'selected' : '' }}>Full Board</option>
              </select>
            </div>
          </div>
          <!-- Apply Filter Button -->
          <div class="d-grid gap-2">
            <button class="btn btn-primary" id="applyFilters">Apply Filters</button>
          </div>
        </form>
      </div>        
        
        
              <!-- Hotel Listings -->
              <div class="col-md-9 col-12 hotel-listings">
               <div class="d-none d-md-block" >         
                    @if(isset($paginatedHotels[0]['rates'][0]['daily_prices']) && count($paginatedHotels[0]['rates'][0]['daily_prices']) > 0)
                        <h4>{{ $paginatedHotels->total() }} accommodation options available for {{ count($paginatedHotels[0]['rates'][0]['daily_prices']) }} night(s)</h4>
                    @else  
                        <h4>{{ $paginatedHotels->total() }} accommodation options available</h4>
                    @endif
                </div> 
                 <div class="d-md-none" >         
                    @if(isset($paginatedHotels[0]['rates'][0]['daily_prices']) && count($paginatedHotels[0]['rates'][0]['daily_prices']) > 0)
                        <h6>{{ $paginatedHotels->total() }} accommodation options available for {{ count($paginatedHotels[0]['rates'][0]['daily_prices']) }} night(s)</h6>
                    @else  
                        <h6>{{ $paginatedHotels->total() }} accommodation options available</h6>
                    @endif
                </div> 
                <!-- Horizontal Scroll Container -->
                <div class="hotel-cards-container">
                  @foreach ($paginatedHotels as $hotel)
                    <!-- Hotel Card -->
                    <div class="hotel-card">
                      <!-- Hotel Image Section -->
                      <div class="hotel-image">
                        @php
                          // Retrieve the hotel ID from the current hotel
                          $hotelId = $hotel['id'];
        
                          // Get the hotel images from the array and replace {size} with 640x400
                          $hotelImage = isset($hotelImages[$hotelId]['images'][0])
                                                        ? str_replace('{size}', '640x400', $hotelImages[$hotelId]['images'][0])
                              : 'default-image-path.jpg'; // Fallback image if no image found
                        @endphp
                        <img src="{{ $hotelImage }}" alt="Hotel Image">
                        <i class="fas fa-heart wishlist-icon" style="color: #fff !important;"></i>

                        <!--<div class="max-capacity">-->
                        <!--  max {{ $hotel['rates'][0]['rg_ext']['capacity'] ?? 'N/A' }}-->
                        <!--  <span class="fas fa-info-circle ms-2"></span>-->
                        <!--</div>-->
                      </div>
        
                      <div class="hotel-details container">
                        <!-- Review and Rating Section -->
                        <div class="review-section">
                          <div>
                            <span style=" color: #0d1883;" id="HotelName">{{ ucwords($hotelImages[$hotelId]['name']) }}</span>
                            <br>
                            <div class="hotel-rating">
        
                              <span class="star-rating">
                                @for ($i = 0; $i < $hotelImages[$hotelId]['star_rating']; $i++)
                                  <i class="las la-star text-warning"></i> <!-- Filled star -->
                                @endfor
                                @for ($i = $hotelImages[$hotelId]['star_rating']; $i < 5; $i++)
                                  <i class="lar la-star text-warning"></i> <!-- Empty star -->
                                @endfor
                              </span>
                            </div>
                            <i><b><small class="text-muted ">Hotel Chain:
                                  {{ $hotelImages[$hotel['id']]['hotel_chain'] }}</small></b></i><br>
                            <small class="text-muted ">Address:
                              {{ $hotelImages[$hotelId]['address'] }}</small>
        
                          </div>
                          <div class="text-end" style="margin-top: 65px;">
                            <i class="fas fa-wifi ms-3"></i>
                            <i class="fas fa-parking ms-3"></i>
                            <i class="fas fa-car ms-3"></i>
                            <i class="fas fa-utensils ms-3"></i>
                            <i class="fas fa-wheelchair ms-3"></i>
                          </div>
                        </div>
        
                        <!-- Room Info Section -->
                        <div class="room-info row">
                          <div class="col-md-4">
                            <p>{{ $hotel['rates'][0]['room_data_trans']['main_room_type'] }}</p>
                            <small>{{ $hotel['rates'][0]['room_data_trans']['bedding_type'] ?? 'Unknown bed type' }}</small>
                          </div>
                          <div class="col-md-4 room-info-icons" style="font-size: small;">
                            <i class="fas fa-utensils"></i>
                            {{ $hotel['rates'][0]['meal'] == 'nomeal' ? 'No meals' : 'Meals included' }}<br>
        
                            <!-- Check if cancellation_penalties exist -->
                            <i class="fas fa-ban"></i>
                            @if (isset($hotel['rates'][0]['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before']) &&
                                    $hotel['rates'][0]['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'] == null)
                              Free cancellation
                            @else
                              No free cancellation
                            @endif
                            <br>
        
                            <i class="fas fa-credit-card"></i> Pay online
                          </div>
                          <div class="col-md-4 price-section">
                             <p>From ₦{{ number_format($hotel['rates'][0]['payment_options']['payment_types'][0]['show_amount'], 2) }}</p>
                            <small>for {{ count($hotel['rates'][0]['daily_prices']) }} night for {{ $requestData['guest'] }} guests</small>
                          </div>
                        </div>
        
                        <!-- Show all rooms button -->
        <div class="text-end mb-3">
            <a href="{{ route('detail', ['hotel' => $hotel['id']] + request()->all()) }}" target="_blank" id="room-show" class="btn btn-rooms text-light">Show all rooms</a>
        </div>
        
                      </div>
                    </div>
                  @endforeach
                  @if(isset($paginatedHotels[0]['rates'][0]['daily_prices']) && count($paginatedHotels[0]['rates'][0]['daily_prices']) > 0)
        <div class="pagination-links d-flex justify-content-end mt-4">
                    @if ($paginatedHotels->onFirstPage())
                      <span class="page-item disabled">
                        <span class="page-link">Previous</span>
                      </span>
                    @else
                      <a class="page-item" href="{{ $paginatedHotels->previousPageUrl() }}" rel="prev">
                        <span class="page-link">Previous</span>
                      </a>
                    @endif
        
                    @if ($paginatedHotels->hasMorePages())
                      <a class="page-item" href="{{ $paginatedHotels->nextPageUrl() }}" rel="next">
                        <span class="page-link">Next</span>
                      </a>
                    @else
                      <span class="page-item disabled">
                        <span class="page-link">Next</span>
                      </span>
                    @endif
                  </div>
                </div>
                @else  
        @endif
                 
              </div>
            </div>
          </div>
  </main>
   @include('layouts.footer')
 
 <!-- html -->
<div id="call-widget"></div>
<!-- script -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.flurry.js') }}"></script>
    <script>
    window.onload = function() {
        PressOne.init("pk_574736ebxCP65U9wcijrvQ0zfcJIe", {
        minimal: true,
        display: false,
        bottom: "20px",
        right: "20px",
        element: "#call-widget",
        onCallInitiated: function (phone) {},
        onCallStarted: function (call) {},
        onCallEnded: function (call) {},
        })
    }
</script>
   <script>
       // When the search button is clicked, show the preloader
document.getElementById('room-show').addEventListener('click', function() {
    // Show the preloader
    document.getElementById('preloader').style.display = 'flex';
    
    // Simulate page load (Replace this with your AJAX call or form submission)
    setTimeout(function() {
        // Hide preloader when the search page is ready
        document.getElementById('preloader').style.display = 'none';
    }, 300000); // Replace with actual completion time or AJAX success event
});

   </script>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
  const priceRange = document.getElementById('priceRange');
  const minPriceInput = document.getElementById('minPriceInput');
  const maxPriceInput = document.getElementById('maxPriceInput');
  const currentMinPrice = document.getElementById('currentMinPrice');
  const currentMaxPrice = document.getElementById('currentMaxPrice');

  const minPrice = 1000;
  const maxPrice = 1000000000;

  // Initialize the price range display and inputs
  const updatePriceDisplay = () => {
    currentMinPrice.innerText = minPriceInput.value || minPrice;
    currentMaxPrice.innerText = maxPriceInput.value || maxPrice;
    priceRange.min = minPriceInput.value || minPrice;
    priceRange.max = maxPriceInput.value || maxPrice;
  };

  // Update the slider when min or max price input changes
  const updateSlider = () => {
    priceRange.value = maxPriceInput.value || maxPrice;
  };

  // Update the price range display when slider moves
  priceRange.addEventListener('input', () => {
    maxPriceInput.value = priceRange.value;
    updatePriceDisplay();
  });

  // Update the slider and display when min price input changes
  minPriceInput.addEventListener('input', () => {
    const value = Math.max(parseInt(minPriceInput.value, 10) || minPrice, minPrice);
    minPriceInput.value = value; // Ensure value is not lower than minPrice
    updateSlider();
    updatePriceDisplay();
  });

  // Update the slider and display when max price input changes
  maxPriceInput.addEventListener('input', () => {
    const value = Math.min(parseInt(maxPriceInput.value, 10) || maxPrice, maxPrice);
    maxPriceInput.value = value; // Ensure value does not exceed maxPrice
    updateSlider();
    updatePriceDisplay();
  });

  // Initialize display and slider
  updatePriceDisplay();
  updateSlider();
});

  </script>
  <script>
    document.getElementById('applyFilters').addEventListener('click', function() {
      // Scroll to top of the listings
      window.scrollTo({
        top: document.querySelector('.hotel-listings').offsetTop, // Adjust selector to your listings container
        behavior: 'smooth' // Smooth scroll
      });
    });
  </script>
  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>





</html>
