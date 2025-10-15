<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Travel Insurance</title>
    <link rel="stylesheet" href="../public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <script src="../public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../public/assets/fontawesome-6/dist-font/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">  
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
                                <img src="{{ asset('public/assets/image/leadway.png') }}" class="image-fluid w-100" alt="protocol"> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            <div class="row airport-form shadow p-4 mb-5">
            <div class="col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Get Quote</h5>   
                      <small>{{session('prodName') }}</small>
                    </div>
                    <div class="card-body">
                            <h6> <b> PRICING</b></h6>
                            
                            <p>The Quote Price Is: <b>₦{{ number_format($data['totalPremium'], 0) }}</b></p>
                           {{-- @if(!empty($errorMsg))
                                <div class="alert alert-danger">
                                    {{ $errorMsg }}
                                </div>
                            @endif--}}


                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:history.back()" class="btn btn-sm btn-secondary">
                                        Back to Edit  
                                    </a>
                                </div>
                                <div class="col-6 text-end">
                                  <form action="{{ route('air.makePurchase')}}" method="POST">
                                    {{ csrf_field() }}
                                      <input type="hidden" name="amount" value="{{ $data['totalPremium'] }}"/>
                                      <input type="hidden" name="quoteNo" value="{{ $data['quoteNo'] }}"/>
                                      <input type="hidden" name="prodCode" value="{{ $dataform['prodCode'] }}"/>
                                      <button type="submit" class="btn btn-sm btn-success">Purchase</button>
                                  </form>  
                                </div>
                            </div>
                            
                    </div>
                    <!-- Button to take the user to the next page -->
                  </div>
                </div>
                <div class="col-sm-7">
                    
                    @php
                        $prodName = session('prodName');
                    
                        $group1 = ["Travel TX (UMRAH)", "Travel TX (HAJJ)"];
                        $group2 = ["Travel TX (PILGRIMAGE EXTRA)", "Travel TX (PILGRIMAGE PLUS)", "Travel TX (PILGRIMAGE BASIC)"];
                        $group3 = ["Travel TX (STUDENT WORLDWIDE INCLUSIVE)", "Travel TX (STUDENT WORLDWIDE EXCLUSIVE)", "Travel TX (ECONOMY WORLDWIDE EXCLUSIVE)", "Travel TX (ECONOMY WORLDWIDE INCLUSIVE)"];
                        $group4 = ["Travel TX (AFRICA)", "Travel TX (SCHENGEN)"];
                        $group5 = ["Travel TX (WORLDWIDE INCLUSIVE)", "Travel TX (WORLDWIDE EXCLUSIVE)", "Travel TX (GOLD WORLDWIDE INCLUSIVE)", "Travel TX (GOLD WORLDWIDE EXCLUSIVE)"];
                    
                    @endphp
                    @if(in_array($prodName, $group1))
                        <div>
                            <img src="{{ asset('public/assets/image/LeadwayH&U.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                        </div>
                    @elseif(in_array($prodName, $group2))
                        <div>
                            <img src="{{ asset('public/assets/image/LeadwayPI.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                        </div>
                    @elseif(in_array($prodName, $group3))
                        <div>
                            <img src="{{ asset('public/assets/image/LeadwayE&S.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                        </div>
                    @elseif(in_array($prodName, $group4))
                        <div>
                            <img src="{{ asset('public/assets/image/LeadwayA&S.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                        </div>
                    @elseif(in_array($prodName, $group5))
                        <div>
                            <img src="{{ asset('public/assets/image/LeadwayP&G.jpg')}}" class="image-fluid w-100" alt="protocol"> 
                        </div>
                    @else
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</main>
</body>
</html>

