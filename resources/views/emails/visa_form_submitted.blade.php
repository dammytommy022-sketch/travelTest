

<!-- resources/views/emails/visa_form_submitted.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Visa Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .summary-box {
            background: #f9f9f9;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .fee-summary {
            margin: 15px 0;
        }
        .important-note {
            color: #d63384;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Thank you for your visa application submission</h1>
    
    <p>Dear {{ $data['first_name'] }},</p>
    
    <p>We have received your visa application form. Please find the attached PDF copy of your submission for your records.</p>
    
    <div class="summary-box">
        <h3>Application Summary:</h3>
        <p>Travel Dates: {{ Carbon\Carbon::parse($data['departure'])->format('d/m/Y') }} - {{ Carbon\Carbon::parse($data['return'])->format('d/m/Y') }}</p>
        <p>Number of Travelers: {{ $data['total_people'] }}</p>
        <p>Reference Number: VF-{{ time() }}</p>
        
        <div class="fee-summary">
            <h4>Total Fee Breakdown:</h4>
            <ul>
                <li>Single Entry Fee: ${{ number_format($data['single_entry_fee'], 2) }}</li>
                <li>Biometrics Fee: ${{ number_format($data['biometrics_fee'], 2) }}</li>
                <li>Service Charge: ${{ number_format($data['service_charge'], 2) }}</li>
                <li>Payment Charge: ${{ number_format($data['payment_charge'], 2) }}</li>
                <li>Processing Charge: ${{ number_format($data['processing_charge'], 2) }}</li>
                <li><strong>Total: ${{ number_format($data['total_fee'], 2) }}</strong></li>
            </ul>
        </div>
    </div>
    
    <p class="important-note">Important Notes:</p>
    <ul>
        <li>Please keep this document for your records</li>
        <li>Your application is being processed</li>
        <li>You will receive further instructions about your application process shortly</li>
        <li>If you have any questions, please contact us using your reference number</li>
    </ul>
    
    <p>Best regards,<br>Travelwheel Team</p>
</body>
</html>