<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Hotel Booking Notification</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Helvetica Neue', Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      background-color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      border: 1px solid #eaeaea;
    }

    .header {
      background-color: #0d1883;
      padding: 15px;
      text-align: center;
      border-radius: 8px 8px 0 0;
    }

    .header h2 {
      color: #fff;
      margin: 10px 0;
      font-size: 1.5rem;
    }

    h4 {
      color: #0d1883;
    }

    .card {
      border: none;
      margin-bottom: 20px;
      background-color: #f7f7f7;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .footer {
      text-align: center;
      color: #888;
      padding: 15px 0;
      font-size: 0.9rem;
    }

    .footer a {
      color: #0d1883;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <h2>New Hotel Booking Notification</h2>
    </div>

    <!-- Booking Details Section -->
    <div class="main-content mt-4">
      <h4>Booking Details</h4>
      <p><strong>Check In:</strong> {{ $bookingDetails['checkin'] }}</p>
      <p><strong>Check Out:</strong> {{ $bookingDetails['checkout'] }}</p>

      @php
        $bookingData = json_decode($bookingDetails['bookingData'], true);
        $roomDetails = $bookingData[0]['rates'][0];
        $hotel_id = $bookingDetails['hotel_id'];
        $formatted_hotel_id = ucwords(str_replace('_', ' ', $hotel_id));
      @endphp

      <p><strong>Room Type:</strong> {{ $roomDetails['room_name'] }}<br>Hosted by {{ $formatted_hotel_id }}</p>
      <p><strong>Cost per Night:</strong> ₦{{ number_format($roomDetails['daily_prices'][0], 0) }}</p>
      <p><strong>Total Nights:</strong> {{ count($roomDetails['daily_prices']) }}</p>



      <!-- Payment Information -->
      <div class="card">
        <h5>Payment Information</h5>
        <p><strong>Amount Paid:</strong> ₦{{ number_format($roomDetails['payment_options']['payment_types'][0]['show_amount'], 2) }}</p>
        <p><strong>Payment Date:</strong> {{ date('l, F d, Y h:i A') }}</p>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>This email is for notification purposes. Please ensure all details are recorded.</p>
    </div>
  </div>
</body>

</html>
