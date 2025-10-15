@component('mail::message')

Dear <span style="font-weight: bold;">{{ $shipment->fullname  }}</span>,

Please find attached your shipment details document. 

Your Shipment ID is {{ $shipment->shipping_id }}.

Thank you for choosing our services.

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


   