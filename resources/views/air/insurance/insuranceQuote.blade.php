<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Travel Insurance</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css')}}">
    <script src="{{asset('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/fontawesome-6/dist-font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">  
    <style>
        .hidden {
        display: none;
        }
        @media only screen and (max-width: 600px) {
            .hid{
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
        <section class="shadow-sm">
            <div class="container">
                <div class="row p-2 pt-3 ">
                    <div class="col-sm-12 p-3 ">
                        <div class="row">
                            <div class="col-6 col-sm-3 col-lg-2">
                                <img src="{{ asset('assets/img/allianz.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row airport-form shadow p-4 mb-5">
            <div class="col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Get Quote</h5>       
                    </div>
                    <div class="card-body">
                            <h6> <b> PRICING</b></h6>
                            @if(session('success'))
                                <p>The Quote Price Is: <b>₦{{ number_format(session('amount'), 0) }}</b></p>
                            @endif
                            @if(session('dataRequest'))
                                <input type="hidden" name="dataRequest" value="{{ session('dataRequest') }}">
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:history.back()" class="btn btn-sm btn-secondary">
                                        Back to Edit 
                                    </a>
                                </div>
                                <div class="col-6 text-end">
                                    @if(session('success'))
                                        <a href="{{ url('/air/insuranceRequest') }}?dataRequest={{ session('dataRequest') }}" class="btn btn-sm btn-success">Purchase</a>
                                    @endif
                                </div>
                            </div>
                            
                    </div>
                    <!-- Button to take the user to the next page -->
                  </div>
                </div>
                <div class="col-sm-7">
                    @if(session('success'))
                        <div class="card-body bg-light">
                            
                            
                            <input type="hidden" id="travelplan" name="travelplan" value="{{ $data['TravelPlanId'] }}">
                            <div class="hidden" id="benefits1">
                                <img src="{{ asset('assets/image/Benefits2.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                            <div class="hidden" id="benefits2">
                                <img src="{{ asset('assets/image/Benefits1.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
</section>
<script>
let travelplan = document.getElementById('travelplan').value;
let benefits1 = document.getElementById("benefits1");
let benefits2 = document.getElementById("benefits2");

function updateBenefitsDisplay() {
    if (travelplan === "1") {
      benefits1.style.display = "block";
      benefits2.style.display = "none";
    } else if (travelplan === "2") {
      benefits1.style.display = "none";
      benefits2.style.display = "block";
    } else {
      benefits1.style.display = "none";
      benefits2.style.display = "none";
    }
  }
  updateBenefitsDisplay();

</script>

<script>
  const selectElement = document.getElementById('selection');
  const numberInputElement = document.getElementById('numberInput1');
  selectElement.addEventListener('change', function () {
    const selectedValue = parseInt(selectElement.value);
    switch (selectedValue) {
      case 1:
        numberInputElement.value = "1";
        break;
      case 2:
        numberInputElement.value = "1";
        break;
      case 3:
        numberInputElement.value = "1";
        break;
      default:
        numberInputElement.value = "0";
        break;
    }
  });
</script>

<script>
    function updateSelect2() {
    let select1 = document.getElementById("select1");
    let select2 = document.getElementById("select2");
    let selectedOption = select1.value;
    let country = ["2", "3", "6", "8", "9", "11", "12", "7", "13", "15", "19", "20", "36", "34",
                     "35", "48", "59", "60", "69", "71", "84", "85", "10", "82", "5", "30"];              
    select2.innerHTML = "";
    // Add options to select2 based on the selected option in select1
    if (country.includes(selectedOption)) {
        select2.add(new Option("Schengen", "Schengen"));
    } else{
        select2.add(new Option("Worldwide Area 1&2", "Worldwide Area 1&2"));
    } 
    }
    function toggleSelect() {
        let checkbox = document.getElementById("multi");
        let select_multi1 = document.getElementById("multi-trip1");
        let select_multi2 = document.getElementById("multi-trip2");
        let select_country1 = document.getElementById("country1");
        let select_cover = document.getElementById("cover");

        if (checkbox.checked) {
            select_multi1.style.display = "block";
            select_multi2.style.display = "block";
            select_country1.style.display = "none";
            select_cover.style.display = "none";
        } else {
            select_multi1.style.display = "none";
            select_multi2.style.display = "none";
            select_country1.style.display = "block";
            select_cover.style.display = "block";
        }
    }

</script>
<script>
    var startDateInput = document.getElementById("begin_date");
    var endDateInput = document.getElementById("end_date");
    var resultElement = document.getElementById("result");
    startDateInput.addEventListener("change", calculateDays);
    endDateInput.addEventListener("change", calculateDays);
    function calculateDays() {
    var startDate = new Date(startDateInput.value);
    var endDate = new Date(endDateInput.value);
    if (!isNaN(startDate) && !isNaN(endDate)) {
      var timeDifference = endDate.getTime() - startDate.getTime();
      var daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
      resultElement.textContent =  daysDifference + "Days " ;
    }
  }
</script>
<script>
    var selection = document.getElementById("selection");
    var elementToHide1 = document.getElementById("elementToHide1");
    var elementToHide2 = document.getElementById("elementToHide2");
    selection.addEventListener("change", function() {
    if (selection.value === "1") {
        elementToHide1.style.display = "none";
        elementToHide2.style.display = "none";      
    } else if (selection.value === "2") {
        elementToHide1.style.display = "block";
        elementToHide2.style.display = "none";
    } else if (selection.value === "3") {
        elementToHide2.style.display = "block";
        elementToHide1.style.display = "none";       

    }else {
            elementToHide1.style.display = "none";
            elementToHide2.style.display = "none";
        }
    });
</script>
<script>
    const numberInput = document.getElementById('numberInput');
    const textValue = document.getElementById('textValue');
    const increaseButton = document.getElementById('increaseButton');
    const decreaseButton = document.getElementById('decreaseButton');
    increaseButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent page refresh
    let currentValue = parseInt(numberInput.value);
    currentValue++;
    numberInput.value = currentValue;
    textValue.textContent = 15000 * currentValue;
    });
    decreaseButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent page refresh
    let currentValue = parseInt(numberInput.value);
    currentValue--;
    numberInput.value = currentValue;
    textValue.textContent = 15000 / currentValue;
    });
    numberInput.addEventListener('input', function() {
    let currentValue = parseInt(numberInput.value);
    textValue.textContent = 15000 * currentValue;
    });
</script>
<script>
    const numberInput1 = document.getElementById('numberInput1');
    const textValue1 = document.getElementById('textValue1');
    const increaseButton1 = document.getElementById('increaseButton1');
    const decreaseButton1 = document.getElementById('decreaseButton1');
    increaseButton1.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent page refresh
    let currentValue1 = parseInt(numberInput1.value);
    currentValue1++;
    numberInput1.value = currentValue1;
    textValue1.textContent1 = 15000 * currentValue1;
    });
    decreaseButton1.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent page refresh
    let currentValue1 = parseInt(numberInput1.value);
    currentValue1--;
    numberInput1.value = currentValue1;
    textValue1.textContent1 = 15000 / currentValue1;
    });
    numberInput1.addEventListener('input', function() {
    let currentValue1 = parseInt(numberInput1.value);
    textValue1.textContent1 = 15000 * currentValue;
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</main>
</body>
</html>

