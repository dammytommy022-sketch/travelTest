<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Bookings</title>
</head>
<body>
    <h2>Service Bookings</h2>
    <p>Dear {{ $name }},</p>
    <p>Your Booking of {{ $service }} ( {{ $package }} ) for {{ $passenger }}, is being process.</p>
    <p>It's cost NGN{{ $amount }}.</p>
    <p>Please Transfer to this Bank details, to complete your request.</p>
    <small> <b> Account Name: First Contact</b></small><br>
    <small><b> Account Number: 1234567890</b></small><br>
    <small> <b> Bank Name: Zenith</b></small><br>
    <br>
    <p>Please find the attached PDF document: <a href="{{ $pdfContent }}">document.pdf</a></p> <br>


    <p>Thank you,</p>
    <p>From Travel Wheel.  </p>
    <img src="{{ asset('assets/image/twlogo.png') }}" style="max-width: 150px;" alt="Company Logo">
</body>
</html>