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
    .breadcrumb {
      background-color: #f8f9fa;
    }



   .hotel-gallery {
    position: relative;
}

  .gallery-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: repeat(2, 240px);
      gap: 0.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 8px;
    }
    
    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
      transform: scale(1.05);
    }
    
    .main-image {
      grid-column: span 2;
      grid-row: span 2;
    }
    
    .view-all-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    .view-all-overlay:hover {
      background: rgba(0, 0, 0, 0.7);
    }
    
    @media (max-width: 768px) {
      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(3, 200px);
      }
      
      .main-image {
        grid-column: span 2;
        grid-row: span 1;
      }
    }

/* Modal styles */
.gallery-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 1050;
    overflow-y: auto;
}

.modal-content {
    padding: 20px;
    max-width: 1200px;
    margin: 40px auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    padding: 0 0 20px 0;
}

.modal-close {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 5px;
    transition: transform 0.3s ease;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    transform: rotate(90deg);
    background: rgba(255, 255, 255, 0.1);
}

.modal-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 16px;
}

.modal-gallery .gallery-item {
    aspect-ratio: 4/3;
}

.loading-placeholder {
    background: #f0f0f0;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
}

   

    .price-box {
      background-color: #fff3cd;
      padding: 20px;
      border: 1px solid #ffeeba;
      border-radius: 5px;
    }

    .price {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .carousel-item img {
      height: 250px;
      object-fit: cover;
    }

    .review-box {
      position: relative;
      border-radius: 10px;
    }

    .review-box .rating-box {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: white;
      color: green;
      padding: 5px;
      border-radius: 50%;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .review-detail {
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    .review-detail p {
      margin-bottom: 10px;
    }

    .btn-warning {
      color: white;
      background-color: #f0ad4e;
      border-color: #eea236;
    }

    .check-in-out-section {
      background-color: #fff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .check-in-out-section a {
      color: #007bff;
      text-decoration: none;
    }

    .check-in-out-section a:hover {
      text-decoration: underline;
    }


    .filter-section select {
      border-radius: 5px;
    }

    .reload-section {
      text-align: center;
      margin-bottom: 15px;
    }

    .room-section {
      background-color: #fff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .room-title {
      font-weight: bold;
      font-size: 1.25rem;
    }

    .room-details {
      margin-bottom: 10px;
      color: #666;
    }

    .room-amenities i {
      margin-right: 10px;
      color: #888;
    }

    .table thead th {
      background-color: #333;
      color: #fff;
    }

    .table tbody td {
      vertical-align: middle;
    }

    .choose-button {
      background-color: #068b59;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px;
      font-weight: bold;
      cursor: pointer;
    }

    .choose-button:hover {
      background-color: ##056e47;
    }

    .more-options {
      cursor: pointer;
      color: #888;
    }

    .more-options:hover {
      color: #333;
    }.custom-breadcrumb {
  background-color: #f8f9fa; /* Light background */
  border-radius: 5px; /* Rounded corners */
  padding: 10px 15px; /* Spacing */
  font-size: 1rem; /* Slightly larger text */
}

  .custom-breadcrumb {
      background-color: #f8f9fa;
      /* Light background */
      border-radius: 8px;
      /* Rounded corners */
      padding: 10px 20px;
      /* Padding inside the breadcrumb */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      /* Subtle shadow */
    }

    .custom-breadcrumb .breadcrumb-item a {
      color: #007bff;
      /* Primary blue link color */
      font-weight: 500;
      /* Medium weight for links */
      text-decoration: none;
      /* Remove underline */
      transition: color 0.2s ease-in-out;
      /* Smooth hover effect */
    }

    .custom-breadcrumb .breadcrumb-item a:hover {
      color: #0056b3;
      /* Darker shade on hover */
    }

    .custom-breadcrumb .breadcrumb-item.active {
      color: #6c757d;
      /* Gray color for active item */
      font-weight: 600;
      /* Slightly bold for emphasis */
    }

    .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
      content: "›";
      /* Change separator to an arrow */
      color: #adb5bd;
      /* Light gray arrow color */
      padding: 0 10px;
      /* Space around separator */
    }

    .custom-breadcrumb {
      margin-top: 20px;
      /* Space from top */
      margin-bottom: 20px;
      /* Space from bottom */
    }
    
    
    
     .card {
      border-radius: 12px;
      background-color: #f8f9fa;
    }

    .card-title {
      font-weight: bold;
      font-size: 1.8rem;
      color: #0d1883;
    }

    .card-text {
      font-size: 1rem;
      margin-bottom: 1rem;
    }

    .list-unstyled li {
      margin-bottom: 0.8rem;
    }

    .text-primary {
      color: #0d1883 !important;
    }

    .text-success {
      color: #0d9c53 !important;
    }

    .text-warning {
      color: #ffc107 !important;
    }

    .btn-primary {
      background-color: #0d1883;
      border-color: #0d1883;
    }

    .btn-primary:hover {
      background-color: #0b156a;
      border-color: #0b156a;
    }

    .shadow-lg {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    
    
    
.expandable-content {
    position: relative;
    overflow: hidden;
    transition: all 0.5s ease-in-out;
}

.content-gradient {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 80px;
    background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1));
    pointer-events: none;
    transition: opacity 0.3s ease-in-out;
}

.read-more-btn {
    transition: transform 0.3s ease;
}

.read-more-btn:hover {
    transform: scale(1.05);
}

.chevron-icon {
    transition: transform 0.3s ease;
}

.chevron-icon.rotated {
    transform: rotate(180deg);
}
  </style>
</head>

<body>
     <section>
        @include('layouts.topnav')
        @include('layouts.newnav')
    </section>
  <div class="container-fluid" style="margin-top:70px;">
  

    <!-- Hotel Header and Details -->
    <div class="row">
      <div class="col-md-8 ps-4">
       <h4 class="card-title text-primary">{{ $hoteldb->name ?? ($hotelinfo['data']['name'] ?? 'Hotel Name Not Available') }}</h4>
        <p>
           <i class="las la-map-marker-alt text-primary"></i> {{ $hoteldb->name ?? $hotelinfo['data']['address'] }} 
           @if (isset($hotelinfo['data']['star_rating']))
            <span class="star-rating">
              @for ($i = 0; $i < $hotelinfo['data']['star_rating']; $i++)
                <i class="las la-star text-warning"></i> <!-- Filled star -->
              @endfor
              @for ($i = $hotelinfo['data']['star_rating']; $i < 5; $i++)
                <i class="lar la-star text-warning"></i> <!-- Empty star -->
              @endfor
            </span>
          @else
            <p>Star rating not available</p>
          @endif
        </p>

      </div>
    <!--  <div class="col-md-4 text-right">-->
    <!--    <div class="price-box">-->
    <!--      <span class="price">from {{ $hotelinfo['data']['min_rate']['price'] ?? 'N/A' }}</span>-->
    <!--      <a href="#" class="btn btn-warning">Show rooms</a>-->
    <!--      <p><small>Get 1 point</small></p>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    <div class="row">
      <div class="col-lg-12">
  <div class="hotel-gallery">
    @if (isset($hotelinfo['data']['images']) && is_array($hotelinfo['data']['images']) && count($hotelinfo['data']['images']) > 0)
      <div class="gallery-grid">
        {{-- Main large image - using 1024x768 fit for best quality --}}
        <div class="gallery-item main-image">
          <img src="{{ str_replace('{size}', '1024x768', $hotelinfo['data']['images'][0]) }}" 
               alt="Hotel Main Image"
               loading="eager">
        </div>
        
        {{-- Secondary images using 240x240 crop for consistent square thumbnails --}}
        @for ($i = 1; $i < min(4, count($hotelinfo['data']['images'])); $i++)
          <div class="gallery-item">
            <img src="{{ str_replace('{size}', '240x240', $hotelinfo['data']['images'][$i]) }}" 
                 alt="Hotel Image {{ $i + 1 }}"
                 loading="eager">
          </div>
        @endfor
        
        {{-- Last thumbnail with overlay showing total images --}}
        @if (count($hotelinfo['data']['images']) > 4)
          <div class="gallery-item" onclick="openGalleryModal()">
            <img src="{{ str_replace('{size}', '240x240', $hotelinfo['data']['images'][4]) }}" 
                 alt="Hotel Image 5"
                 loading="eager">
            <div class="view-all-overlay">
              <span style="color:white;">View all {{ count($hotelinfo['data']['images']) }} photos</span>
            </div>
          </div>
        @endif
      </div>
    @else
      <p>No images available</p>
    @endif
  </div>

{{-- Modal for all images --}}
<div class="gallery-modal" id="galleryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h5>All Photos ({{ count($hotelinfo['data']['images']) }})</h5>
            <button class="modal-close" onclick="closeGalleryModal()">×</button>
        </div>
        <div class="modal-gallery">
            @foreach ($hotelinfo['data']['images'] as $index => $imageUrl)
                <div class="gallery-item">
                    <img src="{{ str_replace('{size}', '1024x768', $imageUrl) }}" 
                         alt="Hotel Image {{ $index + 1 }}"
                         loading="lazy"
                         onload="this.parentElement.classList.remove('loading-placeholder')">
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Check-in/Check-out Section -->
        <div class="check-in-out-section d-flex justify-content-between align-items-center mt-4">
          <div>
            <strong>Check-in</strong> <br>
            <a href="#">{{ $requestData['check-in'] }}</a>
          </div>
          <div>
            <strong>Check-out</strong> <br>
            <a href="#">{{ $requestData['check-out'] }}</a>
          </div>
          <div>
              <a href="/air/hotel">
            <button class="btn btn-outline-secondary">Change</button>
            </a>
          </div>
        </div>
        <!-- Reload Rates Section -->
        <div class="reload-section">
    <button class="btn btn-outline-secondary" onclick="location.reload();">Reload rates</button>
</div>

      </div>
       <div class="col-lg-12">
        <!-- Filter Section -->
        <div class="filter-section d-flex justify-content-between my-3">
          <div class="containes">
            <!-- Filter Section -->
<div class="filter-section">
    <div class="card shadow border-0">
        <div class="card-body">
            <div class="expandable-wrapper">
                {{-- Added inner-content div for proper height calculation --}}
                <div class="expandable-content" id="hotel-content">
                    <div class="inner-content">
                        <ul class="list-unstyled">
                            <div class="row">
                                <div class="col-6">
                                    <li><i class="las la-sign-in-alt text-success"></i> <strong>Check-in:</strong>
                                        {{ $hotelinfo['data']['check_in_time'] ?? 'Not Available' }}</li>
                                </div>
                                <div class="col-6">
                                    <li><i class="las la-sign-out-alt text-success"></i> <strong>Check-out:</strong>
                                        {{ $hotelinfo['data']['check_out_time'] ?? 'Not Available' }}</li>
                                </div>
                            </div>
                        </ul>
                        <!-- Amenities Section -->
                        <div class="row">
                            @php
                                $amenities = json_decode($hoteldb->amenities, true); // Convert JSON string to array
                            @endphp
                        
                            @if(is_array($amenities))
                                @foreach ($amenities as $group)
                                    <div class="col-md-2 col-6">
                                        <h6 class="text-primary">{{ $group['group_name'] }}</h6>
                                        <ul class="list-unstyled">
                                            @foreach ($group['amenities'] as $amenity)
                                                <li><i class="las la-check-circle text-success"></i> {{ $amenity }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="content-gradient"></div>
                </div>
                
                <div class="text-center mt-3">
                    <button id="toggle-content-btn" class="btn btn-outline-secondary btn-sm rounded-pill read-more-btn px-4">
                        <span class="d-flex align-items-center justify-content-center gap-2">
                            Show More
                            <i class="las la-chevron-down chevron-icon"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        </div>
      </div>
    </div>
    <!-- Image Gallery -->





    <!-- Room Section -->

    @foreach ($hotelRates as $roomName => $rates)
      <div class="room-section">
        <div class="d-flex justify-content-between align-items-center">
          <div>
               @php
          // Find the first room group matching the room name
          $roomGroup = collect($hotelinfo['data']['room_groups'])->firstWhere('name', $roomName);
        @endphp

        @if (!empty($roomGroup) && !empty($roomGroup['images']))
          <div class="room-images mt-3">
            <div class="d-flex flex-wrap">
              @foreach ($roomGroup['images'] as $index => $image)
                <!-- Changed $loop->index to $index -->
                <div class="image-wrapper m-1">
                  <img src="{{ str_replace('{size}', '100x100', $image) }}" class="img-thumbnail"
                    alt="{{ $roomName }} Image" style="width: 120px; height: 120px; cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#imageModal-{{ $index }}">
                </div>

                <!-- Modal for each image -->
                <div class="modal fade" id="imageModal-{{ $index }}" tabindex="-1"
                  aria-labelledby="imageModalLabel-{{ $index }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <img src="{{ str_replace('{size}', 'x500', $image) }}" class="img-fluid"
                          alt="{{ $roomName }} Image">
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @else
          <p class="text-muted"></p>
        @endif
            <h5 class="room-title">{{ $roomName }}</h5>
            <p class="room-details">{{ $rates[0]['room_data_trans']['bedding_type'] ?? '' }}</p>
          </div>
        </div>

        <!-- Room Amenities -->
        <div class="room-amenities mb-3">
          @if (!empty($rates[0]['amenities_data']))
            @foreach ($rates[0]['amenities_data'] as $amenity)
              <i class="bi bi-check-circle">{{ $amenity }}</i>
            @endforeach
          @else
            <p>No amenities available</p>
          @endif
        </div>

        <!-- Room Table -->
        <div class="table-responsive">
          <table class="table table-bordered">
           <thead class="custom-table-header">
              <tr>
                <th>Room</th>
                <th>Meals</th>
                <th>Cancellation</th>
                <th>Daily price</th>
                <th>amount in usd</th>
                <th>amount with ratehawk exchange rate</th>
                <th>amount with travelwheel rate</th>
                <th>amount with travelwheel rate + $100</th>
                <th>Net price <small><i class="text-light">(incl. VAT)</i></small></th>
                
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rates as $rate)
                <tr>
                  <td>
                    <i class="las la-bed" style="font-size:20px;"></i><small
                      class="text-mutes">{{ $rate['allotment'] }} rooms Left</small><br>
                    {{ $rate['room_name'] ?? 'Room Type Not Available' }} <br>
                    {{-- {{ $rate['room_data_trans']['bedding_type'] ?? 'No bed information' }} <br> --}}
                    @if (!empty($rate['amenities_data']))
                      {{ implode(', ', $rate['amenities_data']) }}
                    @else
                    @endif
                  </td>
                  <td>
    @php
        $meal = ucfirst($rate['meal']);
    @endphp

    @if ($meal === 'Full-board')
        <i class="las la-utensils" style="color: green;"></i> Full-board
    @elseif ($meal === 'Nomeal')
        <i class="las la-times-circle" style="color: red;"></i> No Meal
    @elseif ($meal === 'Breakfast')
        <i class="las la-coffee" style="color: orange;"></i> Breakfast
    @elseif ($meal === 'Breakfast-for-1')
        <i class="las la-user" style="color: blue;"></i> Breakfast for 1
    @elseif ($meal === 'Breakfast-for-2')
        <i class="las la-users" style="color: purple;"></i> Breakfast for 2
    @else
        <i class="las la-question-circle" style="color: grey;"></i> {{ $meal }}
    @endif
</td>

                 <td>
                    @if (isset($rate['payment_options']['payment_types'][0]['cancellation_penalties']))
                      @if ($rate['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'] !== null)
                        Free cancellation until {{ \Carbon\Carbon::parse($rate['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'])->format('F j, Y, H:i') }}
                      @else
                        No free cancellation
                      @endif
                    @else
                      Cancellation policies not available
                    @endif
                    <i class="bi bi-info-circle"></i>
                  </td>
                   <td>
                    ₦{{ number_format($rate['daily_prices'][0]) }}
                  </td>
                  <td>
                    ₦
                    {{ number_format(($rate['payment_options']['payment_types'][0]['amount'] ?? 0)) }}
                </td>
                 <td>
                    ₦
                    {{ number_format(($rate['payment_options']['payment_types'][0]['show_amount'] ?? 0)) }}
                </td>
               <td>
                    ₦ {{ number_format(($rate['payment_options']['payment_types'][0]['amount'] ?? 0) * $exchange->usd) }}
                </td>
                
                <td>
                    ₦ {{ number_format((($rate['payment_options']['payment_types'][0]['amount'] ?? 0) + 100) * $exchange->usd) }}
                </td>

                 <td>
                    ₦
                    {{ number_format(($rate['payment_options']['payment_types'][0]['show_amount'] ?? 0) * 1.075) }}
                </td>

                 
                  <td>
                                       <a href="{{ route('prebook', ['token' => $rate['book_hash'], 'data' => $data]) }}" class="btn choose-button">choose</a>
                    <br>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endforeach


  </div>
  </div>
     @include('layouts.footer')
 
 <!-- html -->
<div id="call-widget"></div>
<!-- script -->
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
function openGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
    
    // Add loading placeholders
    const items = modal.querySelectorAll('.gallery-item');
    items.forEach(item => item.classList.add('loading-placeholder'));
}

function closeGalleryModal() {
    document.getElementById('galleryModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the content
document.getElementById('galleryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeGalleryModal();
    }
});

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeGalleryModal();
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('hotel-content');
    const toggleBtn = document.getElementById('toggle-content-btn');
    const gradient = content.querySelector('.content-gradient');
    const chevron = toggleBtn.querySelector('.chevron-icon');
    const initialHeight = 300; // Initial collapsed height in pixels
    let isExpanded = false;

    // Set initial height
    content.style.maxHeight = initialHeight + 'px';

    // Function to measure content height
    function getFullHeight() {
        // Temporarily remove max-height to measure full height
        const originalHeight = content.style.maxHeight;
        content.style.maxHeight = 'none';
        const fullHeight = content.scrollHeight;
        content.style.maxHeight = originalHeight;
        return fullHeight;
    }

    // Check if content needs expand/collapse functionality
    const fullHeight = getFullHeight();
    if (fullHeight <= initialHeight) {
        toggleBtn.parentElement.style.display = 'none';
        gradient.style.display = 'none';
    }

    toggleBtn.addEventListener('click', function() {
        isExpanded = !isExpanded;
        
        if (isExpanded) {
            content.style.maxHeight = fullHeight + 'px';
            gradient.style.opacity = '0';
            toggleBtn.querySelector('span').firstChild.textContent = 'Show Less';
        } else {
            content.style.maxHeight = initialHeight + 'px';
            gradient.style.opacity = '1';
            toggleBtn.querySelector('span').firstChild.textContent = 'Read More';
        }
        
        chevron.classList.toggle('rotated');
    });
});
</script>
  <!-- Include Bootstrap JS & FontAwesome -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>

</html>




{{-- <body>
  <div class="container mt-4">
    <!-- Room Section -->
    @foreach ($hotelinfo['data']['room_groups'] ?? [] as $room)
      <div class="room-section my-4">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="room-title">{{ $room['name'] ?? 'Room Name' }}</h5>
            <p class="room-details">
              @if (isset($room['name_struct']))
                Bedding Type: {{ $room['name_struct']['bedding_type'] ?? 'Not specified' }}<br>
                Bathroom: {{ $room['name_struct']['bathroom'] ?? 'Not specified' }}
              @else
                No detailed room structure information.
              @endif
            </p>
          </div>
          <div>
            @if (isset($room['images']) && is_array($room['images']) && count($room['images']) > 0)
              <span class="text-primary">{{ count($room['images']) }} photos</span>
              <div class="room-images">
                @foreach ($room['images'] as $image)
                  <img src="{{ str_replace('{size}', '640x400', $image) }}" class="img-thumbnail" style="width: 150px;"
                    alt="Room Image">
                @endforeach
              </div>
            @else
              <span>No images available</span>
            @endif
          </div>
        </div>

        <!-- Room Amenities -->
        <div class="room-amenities mb-3">
          @if (isset($room['room_amenities']) && is_array($room['room_amenities']) && count($room['room_amenities']) > 0)
            <strong>Amenities:</strong>
            @foreach ($room['room_amenities'] as $amenity)
              <span class="badge badge-secondary">{{ $amenity }}</span>
            @endforeach
          @else
            <span>No amenities available</span>
          @endif
        </div>

        <!-- Room Details Table (if you need more specific details per room) -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Room Name</th>
                <th>Balcony</th>
                <th>Bathroom</th>
                <th>Capacity</th>
                <th>Bedrooms</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $room['name'] ?? 'Room Name' }}</td>
                <td>{{ $room['rg_ext']['balcony'] ? 'Yes' : 'No' }}</td>
                <td>{{ $room['rg_ext']['bathroom'] ? 'Yes' : 'No' }}</td>
                <td>{{ $room['rg_ext']['capacity'] ?? 'N/A' }}</td>
                <td>{{ $room['rg_ext']['bedrooms'] ?? 'N/A' }}</td>
                <td>{{ $room['rg_ext']['view'] ?? 'N/A' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    @endforeach
  </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('hotel-content');
    const toggleBtn = document.getElementById('toggle-content-btn');
    const gradient = content.querySelector('.content-gradient');
    const chevron = toggleBtn.querySelector('.chevron-icon');
    let isExpanded = false;

    // Check if content needs expand/collapse functionality
    if (content.scrollHeight <= 300) {
        toggleBtn.parentElement.style.display = 'none';
        gradient.style.display = 'none';
    }

    toggleBtn.addEventListener('click', function() {
        isExpanded = !isExpanded;
        
        if (isExpanded) {
            content.style.maxHeight = content.scrollHeight + 'px';
            toggleBtn.querySelector('span').firstChild.textContent = 'Show Less';
            gradient.style.display = 'none';
        } else {
            content.style.maxHeight = '300px';
            toggleBtn.querySelector('span').firstChild.textContent = 'Read More';
            gradient.style.display = 'block';
        }
        
        chevron.classList.toggle('rotated');
    });
});
</script>
  <!-- Include Bootstrap JS & FontAwesome -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body> --}}
