@component('mail::message')
Dear <span style="font-weight: bold;">{{ $fullname }}</span>,

Your payment of NGN{{ $amount }} for Protocol Service Booking has been successfully processed.

To generate your boarding pass, please click on the link below:
<a href="{{ route('air.protocol_payment', ['trans_id' => $trans_id]) }}" 
   style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 0;">
   Generate Boarding Pass
</a>

Alternatively, you can copy and paste this link in your browser:  
{{ route('air.protocol_payment', ['trans_id' => $trans_id]) }}


<small>
If you have any questions, please don't hesitate to contact our customer service team.

Thank you for choosing TravelWheel.<br>
We look forward to serving you.
</small>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent 
