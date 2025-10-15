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
            <div class="info-box">

<p>Document {{ $documentRequest->document_name }} has been uploaded for application {{ $application->application_id }}.</p>
<p><a href="{{ route('admin.applications.edit', $application->id) }}">View Application</a></p>
            </div>

          
 

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