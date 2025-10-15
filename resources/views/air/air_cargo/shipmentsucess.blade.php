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


</head>
<body>
<!-- Main Wrapper Start -->
<div class="main-wrapper"> 
  <!-- Create New Shipment Start -->
  <div class="wshipping-content-block shipping-block">
    <div class="container">
      <h2 class="heading2-border mt0">Create New Shipping</h2>
      <div class="row">
        <div class="shipping-form-block">
          <form class="steps" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">Where From</li>
              <li class="active">Where Going</li>
              <li class="active">What</li>
              <li class="active">How</li>
              <li class="active">Review</li>
              <li class="active">Payment</li>
              <li class="active">Complete</li>
            </ul>
         
            <fieldset>
              <div class="shipping-form p-3">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 text-center pt-2 pb-2">
                        <img src="{{ asset('public/assets/img/77suc.gif') }}" class="w-auto" alt="Animated GIF">
                        <h4 class="tanks-message mb-3">Shipment Completed</h4>
                        <h6 class="tanks-message mb-2">Your shipment is well recieved, an email containing your shipment ID and 
                            shipment details has been sent to your mail.</h6>
                        <h6 class="tanks-message"><b>Thank You For Trusting us</b></h6>
                        <form id="whatsappForm" action="">
                          <input type="hidden" id="fullname" value="{{ session('shipData.sender_name') }}">
                          <input type="hidden" id="destination" value="{{ session('shipData.receiver_country') }}">
                          <input type="hidden" id="shipmentType" value="{{ session('shipData.shipment_type') }}">
                          @if(session('shipData.shipment_type') == "Document")
                          <input type="hidden" id="shipmentdes" value="{{ session('shipData.document_type') }}">
                          <input type="hidden" id="shipmentweight" value="{{ session('shipData.document_weight') }}">
                          @elseif(session('shipData.shipment_type') == "Package")
                          <input type="hidden" id="shipmentdes" value="{{ session('shipData.pDescription') }}">
                          <input type="hidden" id="shipmentweight" value="{{ session('shipData.package_weight') }}">
                          @endif
                          <button type="button" class="action-button" onclick="sendWhatsApp()">
                              <i class="fa fa-whatsapp"></i> Notify Us
                          </button>
                      </form>

                      <script>
                          function sendWhatsApp() {
                            const fullname = document.getElementById('fullname').value;
                            const destination = document.getElementById('destination').value;
                            const shipmentType = document.getElementById('shipmentType').value;
                            const shipmentDescription = document.getElementById('shipmentdes').value;
                            const shipmentWeight = document.getElementById('shipmentweight').value;


                              const message = `Hello TravelWheel,\nI am ${fullname}.\nI just made a shipment to ${destination}:\n- Shipment Type: ${shipmentType}\n- Description: ${shipmentDescription}\n- Weight: ${shipmentWeight}.`;
                              console.log(message);

                              var phoneNumber = '+2349125871221';
                              var url = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(message);
                              
                              window.open(url, '_blank');
                          }
                      </script>

                        <a href="{{route('air.aircargo')}}"><button type="button" class="action-button">Back To Top</button></a>
                    </div>

                    
                    <div class="col-3"></div>
                </div>
              </div> 
              
            </fieldset>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Create New Shipment end --> 
</div>
<!-- Main Wrapper end --> 


<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>

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