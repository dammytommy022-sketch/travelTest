@component('mail::message')

Dear <span style="font-weight: bold;"> Support Team</span>,

The Following Flight Details has been Requested by {{ $fullname }}

Flight Rquest: <hr>

Origin: {{$data['origin']}}, <br>
Destination: {{$data['destination']}}, <br>

Departure Date: {{$data['departure_date']}}, <br>
Return Date: {{$data['return_date']}}, <br>

Passenger: {{$data['passenger']}},<br>
Cabin Type: {{$data['cabinType']}},

<hr>

Support Team, Kinly reach out and attend to the client base on the information provided.

Email Address: {{$data['email']}},<br>
Phone Number: {{$data['phone_no']}},<br>
Country Code: {{$data['country_code']}}

<hr>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent


   