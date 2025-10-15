<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWheel - Visa on Arrival Application Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .email-header {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #005eb8;
        }
        .email-header img {
            max-width: 200px;
            height: auto;
        }
        .email-body {
            padding: 30px;
            color: #333333;
        }
        .email-footer {
            background-color: #005eb8;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #005eb8;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #005eb8;
            padding: 15px;
            margin: 20px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
            color: #333333;
        }
        h1 {
            color: #005eb8;
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            color: #333333;
            font-size: 18px;
            margin-top: 25px;
        }
        p {
            margin-bottom: 15px;
        }
        ul {
            padding-left: 20px;
        }
        .contact-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <img src="https://test.travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="Travel Wheel Logo">
        </div>
        
        <div class="email-body">
            <h1>Nigerian Business Visa Application Confirmation</h1>
            
            <p>Dear {{ $userDetails['fullName'] }},</p>
            
            <p>Thank you for choosing TravelWheel for your Visa on Arrival application to Nigeria. We are pleased to confirm that we have received your application.</p>

            <div class="info-box">
                <h2>Application Details</h2>
                <p><strong>Application ID:</strong> {{ $applicationId }}</p>
                <!--<p><strong>Visa Type:</strong> {{ $visa->visa_type }} ({{ $visa->processing_type }})</p>-->
                <p><strong>Destination:</strong> Nigeria</p>
                <p><strong>Processing Time:</strong> {{ $visa->processing_days }} days</p>
                <!--<p><strong>Validity:</strong> {{ $visa->validity_days }} days</p>-->
                <p><strong>Passenger Count:</strong> {{ $passengerCount }}</p>
                <p><strong>Total Price:</strong> NGN{{ $totalPrice }}</p>
                <p><strong>Payment Reference:</strong> {{ $reference }}</p>
            </div>

            <div class="info-box">
                <h2>Submitted Documents</h2>
                <p>The following documents have been received. You can download them using the links below:</p>
                <ul>
                    @foreach (['Document', 'Passport Photo', 'Receipt'] as $type)
                    @php
                        $links = array_filter($downloadLinks, fn($link) => $link['type'] === $type);
                    @endphp
                    @if (!empty($links))
                        <h4>{{ $type }}s</h4>
                        <ul>
                            @foreach ($links as $link)
                                <li><a href="{{ $link['url'] }}" target="_blank">{{ $link['name'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
                </ul>
            </div>
            
            <div class="info-box">
                <p><strong>Note:</strong> {{ $visa->note ?? 'Please ensure all documents are valid and meet the immigration requirements for Nigeria.' }}</p>
                <p>If you have any questions, please contact us at <a href="mailto:support@travelwheel.ng">support@travelwheel.ng</a>.</p>
            </div>

            <h2>Next Steps</h2>
            <p>Our visa processing team will review your application within {{ $visa->processing_days }} days. You will receive updates on your application status via email. You can also track your application status <a href="{{ url('/track-application') }}">here</a>.</p>
            <p>Please ensure all submitted documents are valid and meet the requirements. Contact us if you have any questions.</p>

            <div class="contact-info">
                <h2>Need Assistance?</h2>
                <p>Our dedicated support team is available to help you:</p>
                <ul>
                    <li>Email: <a href="mailto:support@travelwheel.ng">support@travelwheel.ng</a></li>
                    <li>Phone: +234 813 456 7890</li>
                    <li>Working Hours: Monday - Friday, 8:00 AM - 6:00 PM WAT</li>
                </ul>
            </div>
        </div>

        <div class="email-footer">
            <p>© {{ date('Y') }} TravelWheel. All rights reserved.</p>
            <p>74, Ayanguran Road, Ikorodu, Lagos, Nigeria</p>
        </div>
    </div>
</body>
</html>