@component('mail::message')

Dear <span style="font-weight: bold;">{{ $fullname }}</span>,

Your Lounge Bookings has been recieved, Our customer service personel will reach out to you, 
base on the information provided.

Please find attached, Your Lounge Boarding Pass.

<small>Thank you for choosing TravelWheel. <br>
    We look forward to serving you. <br>
</small>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent 