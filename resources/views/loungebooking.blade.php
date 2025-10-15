<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Wheel | Air - Airport Lounge </title>
  <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
  <script src="../assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../assets/fontawesome-6/dist-font/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://kit.fontawesome.com/0626e5d22c.js" crossorigin="anonymous"></script>
  <style>
    .dropdown-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .items-controls {
      display: flex;
      align-items: center;
    }

    .item-count {
      font-size: 12px;
      margin: 0 5px;
    }

    .increment-button,
    .decrement-button {
      padding: 4px 8px;
      font-size: 12px;
    }

    .solid {
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .hidden {
      display: none;
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
        <div class="row airport-form shadow p-4 mt-2 mb-5">
          @foreach ($lounges as $lounge)
            <div class="col-sm-4">
              <div class="col-12">
                <h3> {{ $lounge->brand_name }} </h3>
              </div>
              <div class=" protocol">
                <span class="text-muted">
                  <i class="fa-solid fa-location-dot" style="color:green"></i>
                  {{ $lounge->description }}.
                </span>
              </div>
              <div class=" protocol">
                <span class="text-muted">
                  <i class="fa-solid fa-city" style="color:green"></i> Facilities
                  <!-- <i class="fa-solid fa-location-dot" style="color:green"></i> -->
                </span>
                <ul class="list-unstyled pt-0">
                  <li class="pb-1"><i class="fas fa-wifi" style="color:green"></i> {{ $lounge->facilities1 }}.</li>
                  <li class="pb-1"><i class="fas fa-hamburger" style="color:green"></i> {{ $lounge->facilities2 }}.
                  </li>
                  <li class="pb-1"><i class="fas fa-couch" style="color:green"></i> {{ $lounge->facilities3 }}.</li>
                  <li class="pb-1"><i class="fas fa-newspaper" style="color:green"></i> {{ $lounge->facilities4 }}.
                  </li>
                  <li class="pb-1"><i class="fas fa-concierge-bell" style="color:green"></i>
                    {{ $lounge->facilities5 }}.</li>
                </ul>
              </div>
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="../assets/lounge/{{ $lounge->pics1 }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../assets/lounge/{{ $lounge->pics2 }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../assets/lounge/{{ $lounge->pics3 }}" class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>



            </div>
            <div class="col-sm-8">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Personal Details</h5>
                  <small class="text-muted float-end">FIll in necessary details</small>
                </div>
                <div class="card-body">
                  <form id="myForm" action="{{ route('air.loungecheckout') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="plan" value="">
                    <input type="hidden" name="lounge" value="{{ $lounge->brand_name }}">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Location</label>
                          <input type="text" name="" class="form-control" value="{{ $lounge->location }}"
                            readonly />
                          <input type="hidden" name="state" class="form-control"
                            value="{{ $lounge->location }}" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          @php
                            if ($lounge->airport == 1) {
                                $airport = 'International';
                            } elseif ($lounge->airport == 2) {
                                $airport = 'Local';
                            }
                          @endphp
                          <label class="form-label" for="firstname">Airport</label>
                          <input type="text" name="" class="form-control" value="{{ $airport }}"
                            readonly />
                          <input type="hidden" name="airport" id="airport" class="form-control"
                            value="{{ $airport }}" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Fist Name</label>
                          <div class="input-group input-group-merge">
                            <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="firstname" id="firstname"
                              placeholder="Enter first name" aria-describedby="basic-icon-default-fullname2"
                              required />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="lastname">Last Name</label>
                          <div class="input-group input-group-merge">
                            <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="lastname" id="lastname"
                              placeholder="Enter last name" aria-describedby="basic-icon-default-fullname2"
                              required />
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="phone_no">Phone Number</label>
                          <div class="input-group input-group-merge">
                            <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" name="phone_no" id="phone_no"
                              placeholder="Your phone number" aria-describedby="basic-icon-default-fullname2"
                              required />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="email">Email Address</label>
                          <div class="input-group input-group-merge">
                            <span id="fullname" class="input-group-text"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" name="email" id="email"
                              placeholder="Email Address" aria-describedby="basic-icon-default-fullname2" required />
                          </div>
                        </div>

                      </div>

                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="service_date">Service Date</label>
                          <input class="form-control" type="date" name="service_date" id="html5-date-input"
                            value="{{ Session::get('travel_date') }}" required />
                        </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Departure Time</label>
                          <input type="time" name="d_time" class="form-control"
                            value="{{ Session::get('d_time') }}" />

                        </div>
                      </div>
                      <div class="col-sm-6 hidden" id="airline1">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Select Airline</label>
                          <div class="input-group input-group-merge">

                            <select class="form-select" id="airlineselect1" name="airline1"
                              aria-label="Default select example">
                              <option value="">-- Choose Airline --</option>
                              <option value="AIR COTE D'IVOIRE">AIR COTE D'IVOIRE</option>
                              <option value="ARIK AIR">ARIK AIR</option>
                              <option value="ASKY AIRLINES">ASKY AIRLINES</option>
                              <option value="AIR FRANCE5">AIR FRANCE5</option>
                              <option value="AIR NAMIBIA">AIR NAMIBIA</option>
                              <option value="BRITISH AIRWAYS">BRITISH AIRWAYS</option>
                              <option value="DELTA AIRLINES">DELTA AIRLINES</option>
                              <option value="Egypt Airline">Egypt Airline</option>
                              <option value="Emirates Airlines">Emirates Airlines</option>
                              <option value="ETHIOPIAN AIRLINES">ETHIOPIAN AIRLINES</option>
                              <option value="ETIHAD AIRWAYS">ETIHAD AIRWAYS</option>
                              <option value="KENYA AIRWAYS">KENYA AIRWAYS</option>
                              <option value="KLM">KLM</option>
                              <option value="LUFTHANSA">LUFTHANSA</option>
                              <option value="QATAR AIRWAYS">QATAR AIRWAYS</option>
                              <option value="ROYAL AIR MAROC">ROYAL AIR MAROC</option>
                              <option value="RWANDA AIR">RWANDA AIR</option>
                              <option value="SOUTH AFRICAN AIRWAYS">SOUTH AFRICAN AIRWAYS</option>
                              <option value="TURKISH AIRLINE">TURKISH AIRLINE</option>
                              <option value="VIRGIN ATLANTIC">VIRGIN ATLANTIC</option>
                              <option value="TAP PORTUGAL">TAP PORTUGAL</option>
                              <option value="AFRICAN WORLD AIRLINES">AFRICAN WORLD AIRLINES</option>
                              <option value="MID AFRICA AIRLINES">MID AFRICA AIRLINES</option>
                              <option value="SAUDI ARABIAN AIRLINE">SAUDI ARABIAN AIRLINE</option>
                              <option value="AIRPEACE">AIRPEACE </option>
                              <option value="OTHERS">OTHERS</option>
                            </select>

                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 hidden" id="other1">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Other Airline</label>
                          <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="other1" value="">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 hidden" id="airline2">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Select Airline</label>
                          <div class="input-group input-group-merge">

                            <select class="form-select" id="airlineselect2" name="airline2"
                              aria-label="Default select example">
                              <option value="">-- Choose Airline --</option>
                              <option value="AIR PEACE">AIR PEACE</option>
                              <option value="DANA AIR">DANA AIR</option>
                              <option value="MAX AIR">MAX AIR</option>
                              <option value="OVERLAND AIRWAYS">OVERLAND AIRWAYS</option>
                              <option value="AERO">AERO</option>
                              <option value="IBOM AIR">IBOM AIR</option>
                              <option value="UNITED NIGERIA">UNITED NIGERIA</option>
                              <option value="AZMAN">AZMAN</option>
                              <option value="ARIK">ARIK</option>
                              <option value="GREEN AFRICA">GREEN AFRICA</option>
                              <option value="VALUE JET">VALUE JET</option>
                              <option value="FIRST NATION AIRLINE">FIRST NATION AIRLINE</option>
                              <option value="IRS AIRLINE">IRS AIRLINE</option>
                              <option value="KABO AIR">KABO AIR</option>
                              <option value="OTHERS">OTHERS</option>
                            </select>

                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 hidden" id="other2">
                        <div class="mb-3">
                          <label class="form-label" for="firstname">Other Airline</label>
                          <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="other2" value="">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label pb-1" for="nop">No. Of Person(s)</label>
                          <div class="input-group input-group-merge">
                            <div class="dropdown" data-bs-dropdown="true">
                              <a class="dropdown-toggle solid p-2 text-muted " href="#"
                                id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" style="text-decoration: none;">
                                <i class="fa fa-user ps-2 pe-4"></i> No. of Person(s)<input type="number"
                                  class="ms-2" value="" name="nop" id="totalValue" readonly
                                  style="border: none; background: none; width: 50px;">
                              </a>
                              <ul class="dropdown-menu ps-2 pe-2" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                  <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                    data-item-type="Adult">
                                    <i class="fa fa-user pe-2"></i> Adult(s)_ <small>+12 yrs</small>
                                    <div class="items-controls pe-2 ps-3">
                                      <button class="decrement-button"
                                        style="border-radius: 10px; border: none;">-</button>
                                      <span class="item-count">0</span>
                                      <button class="increment-button"
                                        style="border-radius: 10px; border: none;">+</button>
                                    </div>
                                    <input type="hidden" id="adultValue" name="adultValue" value="0">
                                    <input type="hidden" id="adultAmount" name="adultAmount">

                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                    data-item-type="Child">
                                    <i class="fa fa-child pe-2"></i> Child(s)_ <small> 2 - 11 yrs</small>
                                    <div class="items-controls pe-2 ps-3">
                                      <button class="decrement-button"
                                        style="border-radius: 10px; border: none;">-</button>
                                      <span class="item-count">0</span>
                                      <button class="increment-button"
                                        style="border-radius: 10px; border: none;">+</button>
                                    </div>
                                    <input type="hidden" id="childValue" name="childValue" value="0">
                                    <input type="hidden" id="childAmount" name="childAmount">

                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item pe-3 ps-2" href="#" data-bs-auto-close="false"
                                    data-item-type="Infant">
                                    <i class="fa-solid fa-baby"></i> Infant(s)_ <small> 0 - 2 yrs</small>
                                    <div class="items-controls pe-2 ps-3">
                                      <button class="decrement-button"
                                        style="border-radius: 10px; border: none;">-</button>
                                      <span class="item-count">0</span>
                                      <!-- <input type="number" class="item-count" value="0" style="border: none; background: none; width: 30px;"> -->
                                      <button class="increment-button"
                                        style="border-radius: 10px; border: none;">+</button>
                                    </div>
                                    <input type="hidden" id="infantValue" name="infantValue" value="0">
                                    <input type="hidden" id="infantAmount" name="infantAmount">

                                  </a>
                                </li>

                              </ul>
                            </div>

                          </div>
                        </div>
                        @error('nop')
                          <small class="text-danger ">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                    <input type="hidden" id="selectedAmount" name="amount" value="">
                    <input type="hidden" id="selectAmountA" value="{{ $lounge->priceA }}">
                    <input type="hidden" id="selectAmountB" value="{{ $lounge->priceB }}">
                    <input type="hidden" id="selectAmountC" value="{{ $lounge->priceC }}">




                    <div class="row">


                      <div class="col-sm-12">
                        <div class="mb-3">
                          <input class="form-check-input" type="checkbox" value="" id="t&c" required />
                          <label class="form-check-label" for="t&c">Agreed to our Terms & Services By Checking
                            the box.</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 text-center">
                      <!-- <p id="textValue">Value: 0</p> -->
                      <p><b>Total Amount: NGN <span id="textValue">0.00</span> </b></p>
                    </div>
                    <center> <button type="submit" class="btn btn-pry">Book Service</button></center>
                  </form>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>



    </section>
    <script>
      const adultValue = document.getElementById('adultValue');
      const selectedAmount = document.getElementById('selectedAmount');
      const selectAmount = document.getElementById('selectAmount');


      adultValue.addEventListener('input', function() {
        let currentAdultValue = parseInt(adultValue.value);
        let selectedValue = parseInt(selectAmount.value);
        let a = 300 * 10;
        selectedAmount.value = a;
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var incrementButtons = document.querySelectorAll(".increment-button");
        var decrementButtons = document.querySelectorAll(".decrement-button");
        const selectAmountA = document.getElementById('selectAmountA');
        const selectAmountB = document.getElementById('selectAmountB');
        const selectAmountC = document.getElementById('selectAmountC');
        const textValue = document.getElementById('textValue');

        incrementButtons.forEach(function(button) {
          button.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var countSpan = button.parentElement.querySelector(".item-count");
            var currentCount = parseInt(countSpan.textContent);
            countSpan.textContent = currentCount + 1;
            updateTotalValue();
          });
        });

        decrementButtons.forEach(function(button) {
          button.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var countSpan = button.parentElement.querySelector(".item-count");
            var currentCount = parseInt(countSpan.textContent);
            if (currentCount > 0) {
              countSpan.textContent = currentCount - 1;
              updateTotalValue();
            }
          });
        });

        function updateTotalValue() {
          var adultCount = parseInt(document.querySelector("[data-item-type='Adult'] .item-count").textContent);
          var childCount = parseInt(document.querySelector("[data-item-type='Child'] .item-count").textContent);
          var infantCount = parseInt(document.querySelector("[data-item-type='Infant'] .item-count").textContent);

          let selectPriceA = parseInt(selectAmountA.value);
          let selectPriceB = parseInt(selectAmountB.value);
          let selectPriceC = parseInt(selectAmountC.value);

          var totalValue = adultCount + childCount + infantCount;
          var amountA = selectPriceA * adultCount;
          var amountB = selectPriceB * childCount;
          var amountC = selectPriceC * infantCount;

          document.getElementById("adultValue").value = adultCount;
          document.getElementById("childValue").value = childCount;
          document.getElementById("infantValue").value = infantCount;

          document.getElementById("totalValue").value = totalValue;
          document.getElementById("adultAmount").value = amountA;
          document.getElementById("childAmount").value = amountB;
          document.getElementById("infantAmount").value = amountC;


          document.getElementById("selectedAmount").value = amountA + amountB + amountC;
          let totalAmount = amountA + amountB + amountC;
          textValue.textContent = totalAmount.toLocaleString('en-US');;



        }
      });
    </script>

    <script>
      var airport = document.getElementById("airport");
      var airline1 = document.getElementById("airline1");
      var airlineselect1 = document.getElementById("airlineselect1");
      var other1 = document.getElementById("other1");

      if (airport.value === "International") {
        airline1.style.display = "block";
      } else {
        airline1.style.display = "none";
      }

      airlineselect1.addEventListener("change", function() {
        if (airlineselect1.value === "OTHERS") {
          other1.style.display = "block";
        } else {
          other1.style.display = "none";
        }
      })
    </script>
    <script>
      var airport2 = document.getElementById("airport");
      var airline2 = document.getElementById("airline2");
      var airlineselect2 = document.getElementById("airlineselect2");
      var other2 = document.getElementById("other2");

      if (airport2.value === "Local") {
        airline2.style.display = "block";
      } else {
        airline2.style.display = "none";
      }

      airlineselect2.addEventListener("change", function() {
        if (airlineselect2.value === "OTHERS") {
          other2.style.display = "block";
        } else {
          other2.style.display = "none";
        }

      })
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>



  </main>
  @include('layouts.footer')
</body>

</html>
