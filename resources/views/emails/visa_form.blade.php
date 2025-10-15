<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa on Arrival Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
            background-color: #fff;
            color: #333;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.05;
            font-size: 150px;
            z-index: -1;
            color: #1a4b8c;
            white-space: nowrap;
        }
        .header {
            display: block;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #1a4b8c;
            text-align: center;
        }
        .header img {
            max-width: 120px;
            height: auto;
            display: inline-block;
            vertical-align: middle;
        }
        .header .separator {
            display: inline-block;
            width: 2px;
            height: 40px;
            background-color: #1a4b8c;
            margin: 0 20px;
            vertical-align: middle;
        }
        .status-approved {
            position: absolute;
            top: 130px;
            right: 60px;
            color: #f39b2f;
            border: 2px solid #f39b2f;
            padding: 8px 15px;
            border-radius: 5px;
            transform: rotate(-15deg);
            font-weight: bold;
            font-size: 1.1em;
        }
        .section {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 22px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .section-title {
            color: #1a4b8c;
            font-size: 14px;
            text-transform: uppercase;
            padding-bottom: 5px;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .row {
            margin-bottom: 15px;
        }
        .label {
            font-weight: 600;
            color: #555;
            font-size: 0.85em;
            display: block;
            margin-bottom: 2px;
        }
        .value {
            color: #333;
            font-size: 0.9em;
            display: block;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #1a4b8c;
            color: #666;
            font-size: 0.8em;
        }
        .applicant-section {
            margin-bottom: 30px;
            padding-top: 20px;
            border-top: 2px dashed #e0e0e0;
        }
        .applicant-title {
            color: #1a4b8c;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="watermark">TRAVELWHEEL</div>
    <div class="header">
        <img src="https://immigration.gov.ng/wp-content/uploads/2022/07/nis-logo-Long.fw_.png" alt="Nigeria Immigration Service">
        <div class="separator"></div>
        <img src="https://test.travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="TravelWheel">
        <div class="status-approved">PENDING</div>
    </div>
    <div class="header">
        <p>Visa on Arrival Application</p>
        <p>Number of Applicants: {{ count($applicants) }}</p>
    </div>
    @foreach ($applicants as $index => $data)
        <div class="applicant-section">
            <div class="applicant-title">Applicant {{ $index + 1 }}</div>
            <div class="section">
                <div class="section-title">Applicant Details</div>
                <div class="row">
                    <div class="label">Full Name</div>
                    <div class="value">{{ $data['first_name'] ?? 'N/A' }} {{ $data['middle_name'] ?? 'N/A' }} {{ $data['surname_at_birth'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">E-mail Address</div>
                    <div class="value">{{ $data['contact_email'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Date of Birth</div>
                    <div class="value">{{ isset($data['date_of_birth']) ? \Carbon\Carbon::parse($data['date_of_birth'])->format('d/m/Y') : 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Place of Birth</div>
                    <div class="value">{{ ($data['place_of_birth'] ?? 'N/A') . ', ' . ($data['country_of_birth'] ?? 'N/A') }}</div>
                </div>
                <div class="row">
                    <div class="label">Gender</div>
                    <div class="value">{{ isset($data['sex']) ? ucfirst($data['sex']) : 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Marital Status</div>
                    <div class="value">{{ isset($data['civil_status']) ? ucfirst($data['civil_status']) : 'N/A' }}</div>
                </div>
            </div>
            <div class="section">
                <div class="section-title">Visa Details</div>
                <div class="row">
                    <div class="label">Nationality</div>
                    <div class="value">{{ $data['current_nationality'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Passport Number</div>
                    <div class="value">{{ $data['passport_number'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Passport Type</div>
                    <div class="value">{{ isset($data['passport_type']) ? ucfirst($data['passport_type']) : 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Visa Class</div>
                    <div class="value">{{ $data['visa_class'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Expiry Date</div>
                    <div class="value">{{ isset($data['passport_expiry_date']) ? \Carbon\Carbon::parse($data['passport_expiry_date'])->format('d/m/Y') : 'N/A' }}</div>
                </div>
            </div>
            <div class="section">
                <div class="section-title">Travel Details</div>
                <div class="row">
                    <div class="label">Purpose of Journey</div>
                    <div class="value">{{ $data['purpose'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Port of Entry</div>
                    <div class="value">{{ $data['entry'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Country of Departure</div>
                    <div class="value">{{ $data['country_of_birth'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Arrival Date</div>
                    <div class="value">{{ isset($data['return']) ? \Carbon\Carbon::parse($data['return'])->format('d/m/Y') : 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Duration of Stay</div>
                    <div class="value">{{ isset($data['depature']) && isset($data['return']) ? \Carbon\Carbon::parse($data['depature'])->diffInDays($data['return']) : 'N/A' }} days</div>
                </div>
                <div class="row">
                    <div class="label">Airline</div>
                    <div class="value">{{ $data['airline'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Flight Number</div>
                    <div class="value">{{ $data['flight_number'] ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="section">
                <div class="section-title">Contact Details</div>
                <div class="row">
                    <div class="label">Contact Name</div>
                    <div class="value">{{ $data['contact_name'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Contact Number</div>
                    <div class="value">{{ $data['contact_number'] ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Contact Address</div>
                    <div class="value">{{ $data['contact_address'] ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="footer">
        <p>Processed by TravelWheel - Your One-Stop Travel Solution</p>
        <p>Contact: support@travelwheel.ng | www.travelwheel.ng | +234 813 456 7890</p>
    </div>
</body>
</html>