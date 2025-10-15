<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7fb; padding: 20px; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); overflow: hidden;">
        
        <!-- Header -->
        <div style="padding: 20px; background-color: #ebebeb; text-align: center; color: #ffffff;">
            <img src="https://www.travelwheel.ng/public/assets/img/Travelwheel.png" alt="TravelWheel" style="width: 120px; margin-bottom: 10px;">
            <h1 style="font-size: 24px; font-weight: 700; margin: 0; color:#0d1883;">Booking Confirmed</h1>
        </div>
 @php
            $hotel_id = $bookingDetails['hotel_id'];
            $formatted_hotel_id = ucwords(str_replace('_', ' ', $hotel_id));
            $bookingData = json_decode($bookingDetails['bookingData'], true);
            $roomDetails = $bookingData[0]['rates'][0];
          @endphp
        <!-- Content -->
        <div style="padding: 20px;">
            <!-- Booking Details Section -->
            <div style="padding: 15px; border-left: 4px solid #0d1883; background-color: #f9fafb; border-radius: 4px; margin-bottom: 20px;">
                <h2 style="font-size: 18px; font-weight: 600; color: #1f2937;">Booking Details</h2>
                <p style="margin: 5px 0;"><strong>Check-In:</strong> {{ $bookingDetails['checkin'] }}</p>
                <p style="margin: 5px 0;"><strong>Check-Out:</strong> {{ $bookingDetails['checkout'] }}</p>
                <p style="margin: 5px 0;"><strong>Hotel:</strong> {{ $formatted_hotel_id }}</p>
                <p style="margin: 5px 0;"><strong>Room Type:</strong> {{ $roomDetails['room_name'] }}</p>
                <p style="margin: 5px 0;"><strong>Reference:</strong> {{$reference}}</p>
            </div>

            <!-- Payment Summary Section -->
            <div style="padding: 15px; border-left: 4px solid #0d1883; background-color: #f9fafb; border-radius: 4px; margin-bottom: 20px;">
                <h2 style="font-size: 18px; font-weight: 600; color: #1f2937;">Payment Summary</h2>
                <p style="margin: 5px 0;"><strong>Cost per Night:</strong> ₦{{ number_format($roomDetails['daily_prices'][0], 0) }}</p>
                <p style="margin: 5px 0;"><strong>Number of Nights:</strong> {{ count($roomDetails['daily_prices']) }}</p>
                <p style="margin: 5px 0; font-weight: 700; color: #2563eb; border-top: 1px solid #e5e7eb; padding-top: 10px;">
                    <strong>Total Paid:</strong> ₦{{ number_format($roomDetails['payment_options']['payment_types'][0]['show_amount'], 2) }}
                </p>
            </div>

            <!-- Cancellation Policy Section -->
            <div style="padding: 15px; border-left: 4px solid #0d1883; background-color: #f9fafb; border-radius: 4px;">
                <h2 style="font-size: 18px; font-weight: 600; color: #1f2937;">Cancellation Policy</h2>
                @if ($roomDetails['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'] == null)
                    <p style="color: #dc2626; font-weight: 500;">No free cancellation available</p>
                @else
                    <p style="color: #10b981; font-weight: 500;">Free cancellation before 
                        {{ \Carbon\Carbon::parse($roomDetails['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'])->format('F j, Y, H:i') }}
                    </p>
                @endif
            </div>

            <!-- Receipt Notice -->
            <div style="margin-top: 20px; padding: 10px; background-color: #f0f9ff; border: 1px solid #93c5fd; border-radius: 6px; text-align: center; color: #2563eb; font-weight: 500;">
                📎 Your booking receipt is attached to this email as a PDF.
            </div>
        </div>

        <!-- Footer -->
        <div style="padding: 15px; background-color: #f1f5f9; color: #64748b; text-align: center; font-size: 14px; border-top: 1px solid #e5e7eb;">
            <p style="margin: 0;">Thank you for choosing TravelWheel</p>
            <p style="margin: 5px 0 0;">Need help? <a href="https://www.travelwheel.ng" style="color: #0d1883; text-decoration: none;">Contact our support team</a></p>
        </div>
    </div>
</body>
</html>
