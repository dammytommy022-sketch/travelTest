@component('mail::message') 

Dear <span style="font-weight: bold;">{{ $fullname }}</span>,

Your Protocol Service Booking has been received. Our customer service personnel will reach out to you based on the information provided.

Please find attached your Protocol Boarding Pass.

<small>
    Thank you for choosing TravelWheel. <br>
    We look forward to serving you. <br>
</small>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent 