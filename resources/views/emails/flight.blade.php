@component('mail::message')

Dear <span style="font-weight: bold;">{{ $fullname }}</span>,

Your flight booking is now on hold.

Our support service personnel will be in touch with you based on the information provided.

Please check your flight details or proceed to payment by using the following link: [Flight Details]({{ url('/air/tripdetails' . $mfRefNo) }}).

<small>Thank you for choosing TravelWheel. <br>
    We look forward to serving you. <br>
</small>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent


   