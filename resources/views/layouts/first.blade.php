<style>
    .img-W{
        width: 40px;
    }
   
    @media only screen and (max-width: 600px) {
        .proTab{
            display:none;
        }
    }
    .slides{
       padding-top: 100px;
    }
    .btn-service{
        font-size: 10px;
        color: white;
    }
    .h7 {
    font-size: 0.95rem; /* Adjust the font size to make it smaller */
    font-weight: bold; /* Optionally, make it bold or adjust other styles */
    
}
</style>
<section class="container-fluid p-0 m-0">

    <div style="margin: 10px; background-image: url('{{ asset('assets/image/flight-bg.jpg') }}');">
        <div class=" mb-0 pb-0 slides text-center p-2 p-md-5">
            <div class="col-sm-12 p-3 p-md-4">
                <h2>
                    Simplifying Access To Travel
                </h2>
            </div>
            <div class="row p-3 p-md-4">
                <div class="col-6 col-sm-4 col-md-2 mb-3">
                    <h6 class="h7">Flight Tickets</h6>
                    <a href="{{route('air.flight')}}" class="btn btn-sm  btn-pry shadow-sm" role="button">
                        <button class="btn btn-service btn-sm">Book Tickets</button>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 mb-3">
                    <h6 class="h7">Hotel Booking</h6>
                    <a href="https://travelwheel.ng/air/hotel_bookings" class="btn btn-sm  btn-pry shadow-sm" role="button">
                        <button class="btn btn-service btn-sm">Book Hotels</button>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 mb-3">
                    <h6 class="h7">Protocol Service</h6>
                    <a href="https://travelwheel.ng/air/protocol" class="btn btn-sm  btn-pry shadow-sm" role="button">
                        <button class="btn btn-service btn-sm">Book Service </button>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 mb-3">
                    <h6 class="h7">Airport Lounge</h6>
                    <a href="https://travelwheel.ng/air/lounge" class="btn btn-sm  btn-pry shadow-sm" role="button">
                        <button class="btn btn-service btn-sm"> Book Lounge </button>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 mb-3">
                    <h6 class="h7">Travel Insurance</h6>
                    <a href="{{route('air.insurance')}}" class="btn btn-sm  btn-pry shadow-sm" role="button">
                        <button class="btn btn-service btn-sm"> Book service </button>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 mb-3">
                    <h6 class="h7">Visa Assistance</h6>
                    <a href="{{url('/visa')" class="btn btn-sm  btn-pry shadow-sm" role="button">
                        <button class="btn btn-service btn-sm"> Book service </button>
                    </a>
                </div>
            </div>
        </div> 
    </div>
       
</section>
