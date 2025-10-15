@component('mail::message')

Dear <span style="font-weight: bold;">{{ $fullname }}</span>,

Your flight Request has been recieved.

Our support service personnel will be in touch with you based on the information provided.

Flight Rquest: <hr>

Origin: {{$data['origin']}}, <br>
Destination: {{$data['destination']}}, <br>

Departure Date: {{$data['departure_date']}}, <br>
Return Date: {{$data['return_date']}}, <br>

Passenger: {{$data['passenger']}},<br>
Cabin Type: {{$data['cabinType']}},

<hr>

<div class="p-sm-2">
    <small> <b>Kindly take note of our active operational hours for Booking and Resavation:</b> </small>
    <div class="row p-2 text-start">
        <div class="col-6 ">
            <small class="smaller text-muted">- Mondays to Fridays (8am to 6pm)</small><br>
            <small class="smaller text-muted">- Saturdays (9am to 2pm)</small><br>
            <small class="smaller text-muted">- Sunday ( 12pm to 2pm)</small>
        </div>
        <div class="col-6 ">
            <small class="smaller text-muted"> - For Date Change, Booking Cancellation, and other Service Emergency requests (24/7). Call or Whatsapp 08032705319.</small>
        </div>
    </div>
</div>

<hr>


<small>Thank you for choosing TravelWheel. <br>
    We look forward to serving you. <br>
</small>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent


   