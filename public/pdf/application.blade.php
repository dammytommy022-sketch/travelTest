<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Visa Application Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            color: #1e293b;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20pt;
            color: #2563eb;
            margin: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 14pt;
            color: #2563eb;
            margin-bottom: 10px;
        }

        .section p {
            margin: 5px 0;
        }

        .section ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .section ul li {
            margin-bottom: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f1f5f9;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 10pt;
            color: #64748b;
            margin-top: 20px;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Visa Application Summary</h1>
            <p>Application ID: {{ $applicationId ?? 'APP_' . \Illuminate\Support\Str::random(10) }}</p>
        </div>

        <div class="section">
            <h2>Primary Applicant Details</h2>
            <p><strong>Full Name:</strong> {{ $userDetails['fullName'] }}</p>
            <p><strong>Email:</strong> {{ $userDetails['email'] }}</p>
            <p><strong>Nationality:</strong> {{ $userDetails['nationality'] }}</p>
            <p><strong>Passport Number:</strong> {{ $userDetails['passportNumber'] }}</p>
            <p><strong>Passport Expiry:</strong>
                {{ \Carbon\Carbon::parse($userDetails['passportExpiry'])->format('m/d/Y') }}</p>
        </div>

        <div class="section">
            <h2>Visa Details</h2>
            <p><strong>Visa ID:</strong> {{ $visaId }}</p>
            <p><strong>Total Passengers:</strong> {{ $passengerCount }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}
                ({{ number_format($totalPrice * 1500, 2) }} NGN)</p>
        </div>

        <div class="section">
            <h2>Passenger Details</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Passport Number</th>
                        <th>Nationality</th>
                        <th>Purpose of Travel</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formData['passengers'] as $index => $passenger)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $passenger['details']['surname'] }} {{ $passenger['details']['first_name'] }}</td>
                            <td>{{ $passenger['details']['passport_number'] }}</td>
                            <td>{{ $passenger['details']['current_nationality'] }}</td>
                            <td>{{ ucfirst($passenger['details']['purpose_of_journey']) }}</td>
                            <td>{{ \Carbon\Carbon::parse($passenger['details']['intended_arrival_date'])->format('m/d/Y') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($passenger['details']['intended_departure_date'])->format('m/d/Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Documents Submitted</h2>
            @foreach ($formData['passengers'] as $index => $passenger)
                <p><strong>Passenger {{ $index + 1 }} ({{ $passenger['details']['surname'] }}
                        {{ $passenger['details']['first_name'] }})</strong></p>
                <ul>
                    @foreach ($passenger['documents'] as $label => $path)
                        <li>{{ $label }}: {{ basename($path) }}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>

        <div class="section">
            <h2>Additional Information</h2>
            @foreach ($formData['passengers'] as $index => $passenger)
                <p><strong>Passenger {{ $index + 1 }} ({{ $passenger['details']['surname'] }}
                        {{ $passenger['details']['first_name'] }})</strong></p>
                <ul>
                    <li><strong>Gender:</strong> {{ ucfirst($passenger['details']['sex']) }}</li>
                    <li><strong>Date of Birth:</strong>
                        {{ \Carbon\Carbon::parse($passenger['details']['date_of_birth'])->format('m/d/Y') }}</li>
                    <li><strong>Place of Birth:</strong> {{ $passenger['details']['place_of_birth'] }}</li>
                    <li><strong>Issuing Country:</strong> {{ $passenger['details']['issued_by_country'] }}</li>
                    <li><strong>Email Address:</strong> {{ $passenger['details']['email_address'] }}</li>
                    <li><strong>Phone Number:</strong> {{ $passenger['details']['telephone_number'] }}</li>
                    <li><strong>Home Address:</strong> {{ $passenger['details']['home_address'] }}</li>
                    @if (isset($passenger['details']['guardian_surname']))
                        <li><strong>Guardian:</strong> {{ $passenger['details']['guardian_surname'] }}
                            {{ $passenger['details']['guardian_first_name'] }}</li>
                        <li><strong>Guardian Phone:</strong> {{ $passenger['details']['guardian_number'] }}</li>
                    @endif
                </ul>
            @endforeach
        </div>

        <div class="footer">
            <p>Generated by Travelwheel on {{ \Carbon\Carbon::now()->format('m/d/Y') }}</p>
            <p>For inquiries, contact support@travelwheel.com</p>
        </div>
    </div>
</body>

</html>