<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="author" content="Travel Wheel">
<title>TravelWheel | Air -visa</title>
<meta name="twitter:url" content="https://www.travelwheel.ng/air/visa">
  <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha384-y+56Fn5EXOTmb3TzC2oWyKxu2O7p3pEbxkbeUGtJkZttp6Cgjb99E3Z2kd4Rfiiy" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    .hidden {
      display: none;
    }

.nav-tabs {
  border: none;
  background: linear-gradient(90deg, #f0f9f4 0%, rgba(6, 139, 89, 0.05) 100%);
  padding: 0.75rem;
  border-radius: 1rem;
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  gap: 0.5rem;
  scrollbar-width: none;
  position: relative;
}

.nav-tabs::-webkit-scrollbar {
  display: none;
}

/* Enhanced tab items */
.nav-item {
  position: relative;
}

.nav-link {
  color: #566a7f;
  padding: 0.75rem 1.25rem;
  
  position: relative;
  transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  background: #fff;
  white-space: nowrap;
  font-size: 0.875rem;
  overflow: hidden;
  clip-path: polygon(
    0% 10%, 3% 10%, 3% 0%, 97% 0%, 97% 10%, 100% 10%,
    100% 90%, 97% 90%, 97% 100%, 3% 100%, 3% 90%, 0% 90%
  );
}

/* Enhanced airplane with contrail effect */
.nav-link::before {
  content: '✈';
  position: absolute;
  top: 50%;
  left: -50px;
  transform: translateY(-50%) scale(0);
  opacity: 0;
  transition: all 0.8s ease;
  color: #068b59;
  font-size: 1.5rem; /* Larger plane */
  text-shadow: 0 0 10px rgba(6, 139, 89, 0.3);
  z-index: 2;
}

/* Contrail effect */
.nav-link.active::after {
  content: '';
  position: absolute;
  top: 50%;
  left: -50px;
  right: 100%;
  height: 2px;
  background: linear-gradient(90deg, 
    transparent 0%,
    rgba(6, 139, 89, 0.2) 20%,
    rgba(6, 139, 89, 0.2) 80%,
    transparent 100%
  );
  transform: translateY(-50%);
  opacity: 0;
  z-index: 1;
}

/* Cloud particles */
.nav-link.active::before {
  animation: fly-plane 2.5s cubic-bezier(0.34, 1.56, 0.64, 1); /* Slower animation */
  transform: translateY(-50%) scale(1);
  opacity: 1;
  left: calc(100% + 20px);
}

.nav-link.active::after {
  animation: draw-contrail 2.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Enhanced animations */
@keyframes fly-plane {
  0% {
    transform: translateY(-50%) scale(0) rotate(-45deg);
    left: -50px;
  }
  20% {
    transform: translateY(-50%) scale(1) rotate(0deg);
    left: 0;
  }
  80% {
    transform: translateY(-50%) scale(1) rotate(0deg);
  }
  100% {
    transform: translateY(-50%) scale(1) rotate(0deg);
    left: calc(100% + 20px);
  }
}

@keyframes draw-contrail {
  0% {
    right: 100%;
    opacity: 0;
    left: -50px;
  }
  20% {
    opacity: 1;
    left: 0;
  }
  80% {
    opacity: 1;
    right: 0;
  }
  100% {
    right: -20px;
    opacity: 0;
    left: 0;
  }
}

/* Cloud decoration */
.nav-link::before {
  filter: drop-shadow(0 0 2px rgba(6, 139, 89, 0.3));
}

/* Active tab styling */
.nav-link.active {
  background: #fff;
  color: #068b59;
  font-weight: 500;
  box-shadow: 0 4px 15px rgba(6, 139, 89, 0.15);
  transform: translateY(-3px) scale(1.05);
}

/* Flying particles effect */
.nav-tabs::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  pointer-events: none;
}

.nav-link.active + .nav-tabs::before {
  animation: particle-burst 2s ease-out;
}

@keyframes particle-burst {
  0% {
    background: radial-gradient(circle at var(--x) var(--y), 
      rgba(6, 139, 89, 0.1) 0%, 
      transparent 10%);
  }
  50% {
    background: radial-gradient(circle at var(--x) var(--y), 
      rgba(6, 139, 89, 0.05) 0%, 
      transparent 30%);
  }
  100% {
    background: none;
  }
}

/* Tab content transition */
.tab-content {
  padding: 2rem;
  position: relative;
  overflow: hidden;
}

.tab-pane {
  opacity: 0;
  transform-origin: center;
  transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.tab-pane:not(.active) {
  transform: translate3d(0, 30px, -100px) rotateX(-10deg);
  pointer-events: none;
}

.tab-pane.active {
  opacity: 1;
  transform: translate3d(0, 0, 0) rotateX(0);
}

/* Mobile optimizations */
@media (max-width: 768px) {
  .nav-link::before {
    font-size: 1.25rem; /* Slightly smaller plane on mobile but still visible */
  }
  
  .nav-link.active::before {
    animation: fly-plane 2s ease; /* Slightly faster on mobile for better performance */
  }
}
    @media all and (-ms-high-contrast: none),
    (-ms-high-contrast: active) {

      .card,
      .card-body,
      .media,
      .flex-column,
      .tab-content {
        min-height: 1px;
      }

      img {
        min-height: 1px;
        height: auto;
      }
    }
    
     .featured-label {
      color: #fff;
	background: #0d1883;
	font-size: 16px;
	width: 100px;
	margin-bottom: 15px;
	display: block;
	-webkit-clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
	clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
	margin-left: -20px;
	position: absolute;
    }
    
    /*voa*/
    
    
 .visa-details-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 1rem;
            overflow: hidden;
        }

        .visa-details-header {
            background: #0d1883;
            padding: 1.5rem;
            text-align: center;
        }

        .visa-details-body {
            padding: 1.5rem;
        }

        .icon-container {
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .icon-container i {
            color: white;
        }

        .fee-item {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .fee-item:last-child {
            border-bottom: none;
        }

        .fee-label {
            color: #666;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .fee-value {
            font-weight: bold;
            color: #333;
            display: block;
            text-align: center;
        }

        .total-fee {
            background: #f8f9fa;
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 8px;
        }

        .travel-dates {
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }

        /* Desktop View */
        @media (min-width: 769px) {
            .visa-details-header {
                text-align: left;
            }
            
            .fee-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: left;
            }
            
            .fee-label {
                margin-bottom: 0;
            }
            
            .fee-value {
                text-align: right;
            }
            
            .travel-dates {
                text-align: left;
            }
        }

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .visa-details-card {
                margin: 0.5rem;
            }

            .visa-details-header {
                padding: 1rem;
            }

            .visa-details-body {
                padding: 1rem;
            }

            .fee-item {
                flex-direction: column;
                gap: 0.5rem;
                padding: 1.5rem 0;
            }

            .travel-dates {
                padding: 1rem !important;
            }

            .travel-dates .d-flex {
                flex-direction: column;
                gap: 0.5rem;
            }

            h4 {
                font-size: 1.2rem;
            }

            .header-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .icon-container {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }

        /* Utility Classes */
        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .text-light {
            color: white;
        }

        .text-success {
            color: #28a745;
        }

        .p-3 {
            padding: 1rem;
        }
        
        /*tourist*/
/* Card Container Styles */
.card-container {
    padding: 15px;
    perspective: 1000px;
    transform-style: preserve-3d;
}

/* Main Card Styles */
.card-link {
    border: none !important;
    border-radius: 20px !important;
    background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(13, 24, 131, 0.05);
}

/* Ticket-like decorative elements */
.card-link::before,
.card-link::after {
    content: '';
    position: absolute;
    height: 35px;
    width: 18px;
    background: #f8f9fa;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
}

.card-link::before {
    left: -1px;
    border-top-right-radius: 18px;
    border-bottom-right-radius: 18px;
    box-shadow: inset -3px 0 5px rgba(0,0,0,0.08);
}

.card-link::after {
    right: -1px;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 18px;
    box-shadow: inset 3px 0 5px rgba(0,0,0,0.08);
}

/* Card Body Styles */
.card-body {
    padding: 30px 25px !important;
    border-left: 5px solid #0d1883;
    position: relative;
}

/* Header Styles */
.hello {
    color: #0d1883;
    font-size: 1.4rem !important;
    margin-bottom: 25px !important;
    border-bottom: 2px dashed #068b59;
    padding-bottom: 12px;
    font-weight: 700 !important;
    letter-spacing: 0.5px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.hello::after {
    content: '✈';
    font-size: 1.2rem;
    color: #068b59;
    transform: rotate(-45deg);
    display: inline-block;
    margin-left: 10px;
}

/* Summary Text Styles */
.summary {
    margin-bottom: 12px !important;
    line-height: 1.5;
    transition: transform 0.2s ease;
}

/* Price Emphasis */
.summary b {
    color: #0d1883;
    font-weight: 600;
}

/* Embassy Payment Highlight */
.text-danger {
    color: #dc3545 !important;
    font-weight: 600 !important;
}

/* Hover Effects */
.card-link:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(13, 24, 131, 0.12) !important;
}

/* Selected Card State */
.card-link.selected {
    background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    border: 2px solid #068b59 !important;
    transform: scale(1.02) translateY(-5px);
    position: relative;
}

/* Travel-themed Corner Indicator */
.card-link.selected::before {
    content: '';
    position: absolute;
    top: -15px;
    right: -15px;
    width: 60px;
    height: 60px;
    background: #068b59;
    transform: rotate(45deg);
    z-index: 3;
}

/* Passport Stamp Effect */
.card-link.selected .card-body::after {
    content: '';
    position: absolute;
    top: 5px;
    right: 5px;
    width: 40px;
    height: 40px;
    background: #068b59;
    border-radius: 50%;
    z-index: 4;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: 
        radial-gradient(circle at center, transparent 8px, #068b59 8px),
        linear-gradient(45deg, transparent 48%, white 48%, white 52%, transparent 52%);
    border: 2px solid white;
    animation: stampEffect 0.5s ease-out forwards;
}

/* Stamp Animation */
@keyframes stampEffect {
    0% {
        transform: scale(0.5) rotate(-45deg);
        opacity: 0;
    }
    50% {
        transform: scale(1.2) rotate(0deg);
    }
    100% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }
}

.card-link.selected .card-body {
    border-left-color: #068b59;
}

.card-link.selected .hello {
    color: #068b59;
}

/* Horizontal Rule Styling */
.card-body hr {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(13, 24, 131, 0.2) 20%, 
        rgba(6, 139, 89, 0.2) 80%, 
        transparent
    );
    margin: 20px 0;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .card-container {
        padding: 10px;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    .hello {
        font-size: 1.2rem !important;
    }
}

@media (max-width: 768px) {
    .summary {
        font-size: 11px !important;
    }
    
    .card-link::before,
    .card-link::after {
        height: 25px;
        width: 12px;
    }
}

/* Print Optimization */
@media print {
    .card-link {
        break-inside: avoid;
        box-shadow: none !important;
        transform: none !important;
    }
    
    .card-body {
        border-left-width: 2px;
    }
    
    .card-link.selected::before,
    .card-link.selected .card-body::after {
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
    <div class="container-fluid">
      <img src="{{ asset('public/assets/image/Visa.jpg') }}" class="image-fluid w-100" alt="">
    </div>
    <section class="shadow-sm">
      <div class="container-fluid">
        <div class="row p-2 pt-5 ">
          <h4 class="">Visa Category</h4>
          <!-- Packages -->
          <div class="row pb-90 mb-3">
            <div class="nav-align-top ">
                <div class=" fade show active" id="navs-top-tourist">
                  <form action="" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-lg-6 col-12 mt2 mb-3">
                        <h6>Visa Information</h6>
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <label for="nationality"><b>Nationality</b></label>
                            <select name="nationality" id="nationality" class="form-select"
                              onchange="toggleVisaOptions()">
                              <option value="nigeria" selected>Nigeria</option>
                              <option value="Afghanistan">Afghanistan</option>
                              <option value="Albania">Albania</option>
                              <option value="Algeria">Algeria</option>
                            </select>
                          </div>

                          <div class="col-lg-6 col-12">
                            <label for="visa_to"><b>Visa to</b></label>
                            <select name="visa_to" id="visa_to" class="form-select" readonly>
                              <!-- Options will be populated dynamically based on nationality selection -->
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-12 mt2 mb-3">
                        <h6>Travel Date</h6>
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <label for="departureDate"><b>Departure</b></label>
                            <input type="date" name="departure" class="form-control" id="departureDate"
                              placeholder="Select date" required>
                          </div>
                          <div class="col-lg-6 col-12">
                            <label for="returnDate"><b>Return <span id="date_diff"></span></b></label>
                            <input type="date" name="return" class="form-control" id="returnDate"
                              placeholder="Select date" required>
                          </div>
                          <input type="hidden" name="calculated_days" id="calculated_days">
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 mb-3">
                      <div class="col-lg-6 col-12">
                        <h6>Traveller Information</h6>
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <label class="form-label pb-1" for="nop"><b>No. Of Person(s)</b></label>
                            <p hidden style="font-size: 12px;" id="warning_message"></p>
                            <div class="input-group input-group-merge" id="notschengen" style="display: block">
                              <div class="dropdown" data-bs-dropdown="true">
                                <a class="dropdown-toggle solid p-2 text-muted " href="#"
                                  id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false" style="text-decoration: none;">
                                  <i class="fa fa-user ps-2 pe-4"></i> No. of Person(s)<input type="text"
                                    class="ms-2" value="" name="nop" id="totalValue" readonly required
                                    style="border: none; background: none; width: 50px;">
                                </a>
                                <ul class="dropdown-menu ps-2 pe-2" aria-labelledby="navbarDropdownMenuLink">
                                  <li>
                                    <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                      data-item-type="Adult">
                                      <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fa fa-user pe-2"></i> Adult(s)_ <small>+18 yrs</small></span>
                                        <div class="items-controls ms-1">
                                          <button class="decrement-button"
                                            style="border-radius: 10px; border: none;">-</button>
                                          <span class="item-count">0</span>
                                          <button class="increment-button"
                                            style="border-radius: 10px; border: none;">+</button>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                      data-item-type="Child">
                                      <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fa fa-child pe-2"></i> Child(s)_ <small> 2 - 17
                                            yrs</small></span>
                                        <div class="items-controls ms-1">
                                          <button class="decrement-button"
                                            style="border-radius: 10px; border: none;">-</button>
                                          <span class="item-count">0</span>
                                          <button class="increment-button"
                                            style="border-radius: 10px; border: none;">+</button>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                      data-item-type="Infant">
                                      <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fa fa-child pe-2"></i>Infant(s)_ <small> 0 - 2
                                            yrs</small></span>
                                        <div class="items-controls ms-1">
                                          <button class="decrement-button"
                                            style="border-radius: 10px; border: none;">-</button>
                                          <span class="item-count">0</span>
                                          <button class="increment-button"
                                            style="border-radius: 10px; border: none;">+</button>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <input type="hidden" id="adult_count_1" name="adult_count_1" value="0">
                            <input type="hidden" id="child_count_1" name="child_count_1" value="0">
                            <input type="hidden" id="infant_count_1" name="infant_count_1" value="0">
                            <div class="input-group input-group-merge" id="schengen" style="display: none">
                              <div class="dropdown" data-bs-dropdown="true">
                                <a class="dropdown-toggle solid p-2 text-muted " href="#"
                                  id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false" style="text-decoration: none;">
                                  <i class="fa fa-user ps-2 pe-4"></i> No. of Person(s)<input type="text"
                                    class="ms-2" value="" name="nop" id="totalValue2" readonly required
                                    style="border: none; background: none; width: 50px;">
                                </a>
                                <ul class="dropdown-menu ps-2 pe-2" aria-labelledby="navbarDropdownMenuLink">
                                  <li>
                                    <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                      data-item-type="Adult">
                                      <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fa fa-user pe-2"></i> Adult(s)_ <small>+16 yrs</small></span>
                                        <div class="items-controls">
                                          <button class="decrement-button2"
                                            style="border-radius: 10px; border: none;">-</button>
                                          <span class="item-count2">0</span>
                                          <button class="increment-button2"
                                            style="border-radius: 10px; border: none;">+</button>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                      data-item-type="Child">
                                      <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fa fa-child pe-2"></i> Child(s)_ <small> 2 - 15
                                            yrs</small></span>
                                        <div class="items-controls">
                                          <button class="decrement-button2"
                                            style="border-radius: 10px; border: none;">-</button>
                                          <span class="item-count2">0</span>
                                          <button class="increment-button2"
                                            style="border-radius: 10px; border: none;">+</button>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                      data-item-type="Infant">
                                      <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fa fa-child pe-2"></i> Infant(s)_ <small> 0 - 2
                                            yrs</small></span>
                                        <div class="items-controls">
                                          <button class="decrement-button2"
                                            style="border-radius: 10px; border: none;">-</button>
                                          <span class="item-count2">0</span>
                                          <button class="increment-button2"
                                            style="border-radius: 10px; border: none;">+</button>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <input type="hidden" id="adult_count_2" name="adult_count_2" value="0">
                            <input type="hidden" id="child_count_2" name="child_count_2" value="0">
                            <input type="hidden" id="infant_count_2" name="infant_count_2" value="0">
                          </div>
                          <div class="col-lg-6 col-12">
                            <label for="visa_type"><b>Visa Processing Time</b></label>
                            <select name="visa_type" id="visa_type" class="form-select" disabled>
                              <option selected disabled>--Select Processing Time--</option>
                              <!-- Options will be populated dynamically based on nationality selection -->
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <h6 id="contact_info">Contact Information</h6>
                        <div class="row">
                          <div class="col-lg-6 col-12" id="phone_number_div">
                            <label for="phone"><b>Phone Number</b></label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                              placeholder="Enter Phone Number" required>
                          </div>
                          <div class="col-lg-6 col-12" id="email_div">
                            <label for="email"><b>Email</b></label>
                            <input type="email" name="email" id="email" class="form-control"
                              placeholder="Enter Email Address" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-check mt-2" style="display: none">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault"><b>
                            <p class="text-danger">Have you undergone biometric identification within the past 10
                              years?</p></b>
                        </label>
                      </div>
                      <div id="visa_details_container" style="display: none; margin-top:15px;">
                        <hr>
                        <h6 class="text-center font-weight-bold"><b class="text-danger" > Please note that fees marked in red are payable directly to the embassy.</b></h6>

                        <p class="text-center font-weight-bold"><b style="font-size: 18px"> Select A Visa Application Type.</b></p>
                        <!-- Dynamically generated cards will be placed here -->
                        <div id="visa_details_row" class="d-flex flex-row flex-nowrap overflow-auto"></div>
                      </div>
                    </div>
<div class="mt-3">
                      <hr>
                      <h5<b>Disclaimer</b></h5>
 <ul>
                          <li>
                            <p><b>TravelWheel</b> will process visas based on the information provided in the
                                documentation.
                              </p>
                          </li>
                          <li>
                            <p>Please note that the processing time indicated above are from the time they are
                                submitted
                                to the
                                respective visa decision making authority. Processing time may vary under exceptional
                                circumstances beyound the
                                control of <b>TravelWheel</b>.
                              </p>
                          </li>
                          <li>
                            <p>Please note that the document/documents list shown are subject to change without
                                prior
                                notice.
                                Any additional documents/information required will be communicated after careful
                                evaluation
                                of the application.
                              </p>
                          </li>
                         
                          <li>
                            <p><b>TravelWheel</b> hereby declares that it does not facilitate the sale of
                                visas.</p>
                          </li>
                          <li>
                            <p>Visa is at the discretion of the embassy visa officer, and <b>TravelWheel</b> does
                                not influence or
                                guarantee the outcome of visa applications.</p>
                          </li>
                          <li>
                            <p>Should you become aware of any visa sale or purchase transactions, please report
                                them to
                                <b>TravelWheel</b> management immediately, as we strictly prohibit such
                                activities.</p>
                          </li>
                          <li>
                            <p>Visas for any form of trafficking are strictly prohibited by
                                <b>TravelWheel</b>.</p>
                          </li>
                        </ul>
                        </div>                    <div class="d-flex justify-content-end mb-3">
                      <button type="submit" class="btn btn-success" id="proceed_button">Proceed</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      
      
      
    </section>
  </main>
@include('layouts.footer')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/jquery.flurry.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('public/assets/js/tourist.js') }}"></script>
  <!--<script src="{{ asset('public/assets/js/voa.js') }}"></script>-->

  <script>
function toggleVisaOptions() {
    var nationality = document.getElementById("nationality").value;
    var visaToSelect = document.getElementById("visa_to");
    var continent = "{{ $continent ?? '' }}";
    var selectedCountry = "{{ $selectedCountry ?? '' }}";

    visaToSelect.innerHTML = ""; // Clear previous options

    // Default option
    var defaultOption = document.createElement("option");
    defaultOption.text = "--Select Destination--";
    defaultOption.disabled = true;
    defaultOption.selected = !selectedCountry; // Select default only if no country is pre-selected
    visaToSelect.appendChild(defaultOption);

    if (nationality === "nigeria") {
        // Populate with countries from the selected continent
        @foreach ($countries as $id => $countryName)
            var option = document.createElement("option");
            option.value = "{{ $countryName }}";
            option.text = "{{ $countryName }}";
            if ("{{ $countryName }}" === selectedCountry) {
                option.selected = true; // Pre-select the chosen country
            }
            visaToSelect.appendChild(option);
        @endforeach
    } else {
        // For non-Nigerian nationalities, show Nigeria and UAE
        var nigeriaOption = document.createElement("option");
        nigeriaOption.value = "Nigeria";
        nigeriaOption.text = "Nigeria";
        nigeriaOption.selected = selectedCountry === "Nigeria";
        visaToSelect.appendChild(nigeriaOption);

        var dubaiOption = document.createElement("option");
        dubaiOption.value = "dubai";
        dubaiOption.text = "United Arab Emirates";
        dubaiOption.selected = selectedCountry === "dubai";
        visaToSelect.appendChild(dubaiOption);
    }

    // Trigger visa types fetch if a country is pre-selected
    if (selectedCountry) {
        fetchVisaTypes(selectedCountry);
    }
}
function fetchVisaTypes(country) {
    var visaTypeDropdown = document.getElementById("visa_type");

    // Send an AJAX request to fetch visa types for the selected country
    fetch('/get-visa-types/' + encodeURIComponent(country))
        .then(response => response.json())
        .then(data => {
            // Clear previous options
            visaTypeDropdown.innerHTML = '<option selected disabled>--Select Visa Processing Time--</option>';

            // Populate dropdown with fetched visa types
            data.visaTypes.forEach(visaType => {
                var option = document.createElement("option");
                option.text = visaType;
                option.value = visaType;
                visaTypeDropdown.appendChild(option);
            });

            // Enable the visa type dropdown
            visaTypeDropdown.disabled = true;
        })
        .catch(error => {
            console.error('Error fetching visa types:', error);
            visaTypeDropdown.innerHTML = '<option selected disabled>--Select Visa Processing Time--</option>';
            visaTypeDropdown.disabled = true;
        });
}
document.addEventListener("DOMContentLoaded", function() {
    var visaToDropdown = document.getElementById("visa_to");

    // Populate the visa_to dropdown
    toggleVisaOptions();

    // Add change event listener for visa_to dropdown
    visaToDropdown.addEventListener("change", function() {
        var selectedCountry = visaToDropdown.value;
        if (selectedCountry) {
            fetchVisaTypes(selectedCountry);
        } else {
            var visaTypeDropdown = document.getElementById("visa_type");
            visaTypeDropdown.innerHTML = '<option selected disabled>--Select Visa Processing Time--</option>';
            visaTypeDropdown.disabled = true;
        }
    });
});
  </script>
<script>
    // Set the minimum date for the input
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    document.getElementById('voa_departureDate').setAttribute('min', today);
document.addEventListener('DOMContentLoaded', function() {
  const tabList = document.querySelector('.nav-tabs');
  
  // Existing overflow check
  function checkOverflow() {
    if (tabList.scrollWidth > tabList.clientWidth) {
      tabList.classList.add('has-overflow');
    } else {
      tabList.classList.remove('has-overflow');
    }
  }

  // Track mouse position for particle effects
  tabList.addEventListener('mousemove', function(e) {
    const rect = tabList.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    tabList.style.setProperty('--x', `${x}px`);
    tabList.style.setProperty('--y', `${y}px`);
  });

  // Enhanced tab click handling
  const tabs = document.querySelectorAll('.nav-link');
  tabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
      // Remove active class from all tabs
      tabs.forEach(t => t.classList.remove('active-animation'));
      
      // Add animation class to clicked tab
      this.classList.add('active-animation');
      
      // Smooth scroll to center
      setTimeout(() => {
        if (this.classList.contains('active')) {
          this.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center'
          });
        }
      }, 100);
    });
  });

  checkOverflow();
  window.addEventListener('resize', checkOverflow);
});
</script>

<script src="https://kit.fontawesome.com/b1c7dc27be.js" crossorigin="anonymous"></script>
    
    <script src="https://web.pressone.africa/pub-widget.js"></script>
 
</body>

</html>