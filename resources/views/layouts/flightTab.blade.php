<style>
    .img-W{
        width: 20px;
    }
   
    @media only screen and (max-width: 600px) {
        .proTab{
            display:none;
        }
    }
    
</style>

<div class="container p-2 pt-5 pb-5">

    <ul class="nav nav-tabs" id="myTabs" role="tablist">

    <li class="nav-item" role="presentation">

        <a class="nav-link active product-nav" aria-current="page" href="#"><img src="assets/img/pa.png" class="image-fluid img-W" alt=""><span class="proTab product-nav"> Flight Bookings</span></a>

    </li>

    <li class="nav-item">

        <a class="nav-link product-nav" href="{{route('air.hotel_booking')}}"><img src="assets/img/phb.png" class="image-fluid img-W" alt=""><span class="proTab product-nav"> Hotel Bookings</span></a>

    </li>

    <li class="nav-item">

        <a class="nav-link product-nav" href="{{route('air.protocol')}}"><img src="assets/img/pp.png" class="image-fluid img-W" alt=""><span class="proTab product-nav"> Airport Protocol</span></a>

    </li>

    <li class="nav-item">

        <a class="nav-link product-nav" href="{{route('air.lounge')}}"><img src="assets/img/pal.png" class="image-fluid img-W" alt=""><span class="proTab product-nav"> Airport Lounge</span></a>

    </li>

    <li class="nav-item">

        <a class="nav-link product-nav" href="{{route('air.travelInsurance')}}"><img src="assets/img/ppi.png" class="image-fluid img-W" alt=""><span class="proTab product-nav"> Travel Insurance</span></a>

    </li>

    </ul>

    <div class="tab-content" id="myTabContent">

      <div class="tab-pane fade show active p-3" id="home" role="tabpanel" aria-labelledby="home-tab">

    

      </div>

      

    </div>



</div>