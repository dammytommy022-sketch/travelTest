@component('mail::message')

Dear <span style="font-weight: bold;"> Support Team</span>,

The Following Flight Details has been booked on hold by {{ $fullname }}

Please check the flight details or proceed to payment by using the following link: [Flight Details]({{ url('/air/tripdetails' . $mfRefNo) }}).

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent