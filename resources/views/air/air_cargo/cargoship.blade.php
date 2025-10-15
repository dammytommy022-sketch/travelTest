<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Title -->
<title>TravelWheel | Air Cargo</title>
 
<!-- Date picker CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/ship/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('public/assets/ship/assets/css/bootstrap-datetimepicker.min.css')}}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/ship/style.css')}}">

<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/ship/assets/css/responsive.css')}}">
<!-- jQuery -->
<script src="{{ asset('public/assets/ship/assets/js/jquery-3.4.1.min.js')}}"></script>
<style>
  #area-autocomplete-container {
      position: relative;
      max-width: 100%;
  }
  
  #area-input {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
  }
  
  #area-suggestions {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      border-top: none;
      border-radius: 0 0 4px 4px;
      max-height: 200px;
      overflow-y: auto;
      display: none;
      z-index: 1000;
  }
  
  .area-suggestion-item {
      padding: 8px 10px;
      cursor: pointer;
  }
  
  .area-suggestion-item:hover {
      background-color: #f0f0f0;
  }

  input {
    font-family: "Arial", sans-serif; /* Change to any font you want */
    font-size: 24px;
}

</style>

</head>
<body>
<!-- Main Wrapper Start -->
<div class="main-wrapper"> 
  <!-- Create New Shipment Start -->
   <img src="{{ asset('public/assets/img/aircargo.jpg') }}" class="img-fluid w-100" alt="">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card p-4">
                    <h4><b>Create Shipment</b></h4>
                    <div class="card p-3 shadow">
                        <div class="mb-3 " >
                            <label class="form-label" for="firstname">New Shipment</label>
                            <select class="form-select" id='stateselect' name="state" aria-label="Default select example" required>
                                <option value="">-- Select Shipment Type --</option>
                                    <option value="{{route('air.aircargoInternational')}}">International Shipment</option>
                                    <option value="{{route('air.aircargoInternational')}}">Local Shipment</option>
                            </select>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="purchaseButton" class="btn btn-pry">Continue </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card p-4">
                    <h4><b>Track Shipment</b></h4>
                    <div class="card p-3 shadow">
                        <div class="mb-3 " >
                            <label class="form-label" for="firstname">Shipment ID</label>
                            <input type="text" class="form-control" placeholder="Enter Shipment ID">
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="purchaseButton" class="btn btn-pry">Continue </button>
                        </div>
                        {{--
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{route('air.aircargoInternational')}}">International Shipment</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('air.aircargoInternational')}}">Local Shipment</a>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>  
            </div>
            
        </div>
    </div>
  <!-- Create New Shipment end --> 
</div>
<!-- Main Wrapper end --> 

<script>
    document.getElementById('purchaseButton').addEventListener('click', function() {
        let select = document.getElementById('stateselect');
        let selectedValue = select.value;
        
        if (selectedValue) {
            window.location.href = selectedValue;
        } else {
            alert('Please select a shipment type');
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
<script src="{{ asset('assets/js/cargo.js')}}"></script> 


<!-- Bootstrap JS --> 
<script src="{{ asset('public/assets/ship/assets/js/bootstrap.min.js')}}"></script> 

<!-- OwlCarousel JS --> 
<script src="{{ asset('public/assets/ship/assets/js/owl.carousel.min.js')}}"></script> 

<!-- Tether JS --> 
<script src="{{ asset('public/assets/ship/assets/js/tether.min.js')}}"></script> 

<script src="{{ asset('public/assets/ship/assets/js/jquery.filterizr.min.js')}}"></script> 


<!-- Popper JS --> 
<script src="{{ asset('public/assets/ship/assets/js/popper.min.js')}}"></script> 


<!-- Bootstrap dateTimePicker --> 
<script src="{{ asset('public/assets/ship/assets/js/datetimepicker-moment.min.js')}}"></script> 
<script src="{{ asset('public/assets/ship/assets/js/bootstrap-datetimepicker.min.js')}}"></script> 

<script src="{{ asset('public/assets/ship/assets/js/jquery.slicknav.min.js')}}"></script> 

<!-- WOW JS --> 
<script src="{{ asset('public/assets/ship/assets/js/wow-1.3.0.min.js')}}"></script> 



<!-- Step Form with validate --> 
<script src="{{ asset('public/assets/ship/assets/js/jquery.validate.js')}}"></script> 
<script src="{{ asset('public/assets/ship/assets/js/form-step.js')}}"></script> 


<!-- Active JS --> 
<script src="{{ asset('public/assets/ship/assets/js/active.js')}}"></script>
</body>
</html>