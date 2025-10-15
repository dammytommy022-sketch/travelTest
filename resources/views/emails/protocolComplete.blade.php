@component('mail::message')

Dear <span style="font-weight: bold;">{{ $dataform['firstname1'] }} {{ $dataform['lastname1'] }}</span>,

Your transaction has been completed successfully!

Note: Your transaction is not completed until you generate your boarding pass.

Click the link to countinue and also generate your boarding pass: <br>

<a href="{{ route('air.protocol_payment', ['data' => json_encode($data), 'dataform' => json_encode($dataform)]) }}">
    View Transaction Details
</a>

Thank you for using our service!
<small>Thank you for choosing TravelWheel. <br>
    We look forward to serving you. <br>
</small>

<small>
Best regards,<br>
Management<br>
TravelWheel
</small>
@endcomponent


   