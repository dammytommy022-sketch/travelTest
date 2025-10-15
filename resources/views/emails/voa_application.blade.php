<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWheel - Visa Application Confirmation</title>
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
            <h1>Visa Application Confirmation</h1>
            
            <p>Dear Valued Client,</p>
            
            <p>Thank you for choosing TravelWheel for your visa application process. We are pleased to confirm that we have received your Visa on Arrival application and supporting documents.</p>

            <div class="info-box">
                <h2>Important Information</h2>
                <p>We have attached the following documents to this email:</p>
                <ul>
                    <li>Payment Reference: {{ $reference }}</li>
                    <li>Your completed visa application form</li>
                    <li>Supporting documents you provided</li>
                </ul>
            </div>

            <h2>Next Steps</h2>
            <p>Our visa processing team will review your application and contact you if any additional information is required. We typically process applications within 24-48 business hours.</p>

            <div class="info-box">
                <h2>Please Note:</h2>
                <ul>
                    <li>Approved Visa must be used within 14 days of issuance</li>
                    <li>Keep this email for your records. If you have any questions about your application, please contact our support team and reference your application documents.</li>
                </ul>
               
            </div>

            <div class="contact-info">
                <h2>Need Assistance?</h2>
                <p>Our dedicated support team is available to help you:</p>
                <ul>
                    <li>Email: support@travelwheel.ng</li>
                    <li>Phone: +234 813 456 7890</li>

                    <li>Working Hours: Monday - Friday, 8:00 AM - 6:00 PM WAT</li>
                </ul>
            </div>
        </div>

        <div class="email-footer">
            <p>© {{ date('Y') }} TravelWheel. All rights reserved.</p>
            <p>74, Ayanguran Road, Ikorodu Ikorodu, Ikorodu, Lagos</p>
        </div>
    </div>
</body>
</html>