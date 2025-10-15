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
            <p><strong>Nationality:</strong> {{ $userDetails['nationality'] ?? 'In the filled form' }}</p>

<p><strong>Passport Number:</strong> {{ $userDetails['passportNumber'] ?? 'In the filled form' }}</p>

<p><strong>Passport Expiry:</strong>
    {{ isset($userDetails['passportExpiry']) ? \Carbon\Carbon::parse($userDetails['passportExpiry'])->format('m/d/Y') : 'In the filled form' }}
</p>

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
    @php
        $details = $passenger['details'] ?? [];
    @endphp
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $details['surname'] ?? explode(' ', $details['full_name'] ?? 'N/A')[0] }} {{ $details['first_name'] ?? explode(' ', $details['full_name'] ?? 'N/A')[1] ?? '' }}</td>
        <td>{{ $details['passport_number'] ?? 'N/A' }}</td>
        <td>{{ $details['passport_type'] ?? 'N/A' }}</td>
        <td>{{ $details['current_nationality'] ?? 'N/A' }}</td>
        <td>{{ isset($details['purpose_of_journey']) ? ucfirst($details['purpose_of_journey']) : 'N/A' }}</td>
        <td>{{ isset($details['intended_arrival_date']) ? \Carbon\Carbon::parse($details['intended_arrival_date'])->format('m/d/Y') : 'N/A' }}</td>
        <td>{{ isset($details['intended_departure_date']) ? \Carbon\Carbon::parse($details['intended_departure_date'])->format('m/d/Y') : 'N/A' }}</td>
    </tr>
@endforeach

                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Documents Submitted</h2>
            @foreach ($formData['passengers'] as $index => $passenger)
    <p><strong>Passenger {{ $index + 1 }} ({{ $passenger['details']['full_name'] ?? 'N/A' }})</strong></p>
    <ul>
        @forelse ($passenger['documents'] ?? ['flight' => $passenger['flight'] ?? null, 'hotel' => $passenger['hotel'] ?? null, 'insurance' => $passenger['insurance'] ?? null] as $label => $path)
            @if ($path)
                <li>{{ ucfirst($label) }}: {{ basename($path) }}</li>
            @endif
        @empty
            <li>No documents submitted.</li>
        @endforelse
    </ul>
@endforeach

        </div>

        <div class="section">
            <h2>Additional Information</h2>
            @foreach ($formData['passengers'] as $index => $passenger)
    @php $details = $passenger['details'] ?? []; @endphp
    <p><strong>Passenger {{ $index + 1 }} ({{ $details['full_name'] ?? 'N/A' }})</strong></p>
    <ul>
        <li><strong>Gender:</strong> {{ isset($details['sex']) ? ucfirst($details['sex']) : 'N/A' }}</li>
        <li><strong>Date of Birth:</strong> {{ isset($details['date_of_birth']) ? \Carbon\Carbon::parse($details['date_of_birth'])->format('m/d/Y') : 'N/A' }}</li>
        <li><strong>Place of Birth:</strong> {{ $details['place_of_birth'] ?? 'N/A' }}</li>
        <li><strong>Issuing Country:</strong> {{ $details['issued_by_country'] ?? 'N/A' }}</li>
        <li><strong>Email Address:</strong> {{ $details['email_address'] ?? $details['email'] ?? 'N/A' }}</li>
        <li><strong>Phone Number:</strong> {{ $details['telephone_number'] ?? 'N/A' }}</li>
        <li><strong>Home Address:</strong> {{ $details['home_address'] ?? 'N/A' }}</li>

        @if (isset($details['guardian_surname']))
            <li><strong>Guardian:</strong> {{ $details['guardian_surname'] }} {{ $details['guardian_first_name'] ?? '' }}</li>
            <li><strong>Guardian Phone:</strong> {{ $details['guardian_number'] ?? 'N/A' }}</li>
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