<!DOCTYPE html>
<html>

<head>
    <title>Visa on Arrival Application Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Visa on Arrival Application Confirmation</h1>
        <h2>Applicant Details</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td>{{ $userDetails['fullName'] }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $userDetails['email'] }}</td>
            </tr>
            <tr>
                <td>Nationality</td>
                <td>{{ $userDetails['nationality'] }}</td>
            </tr>
            <tr>
                <td>Passport Number</td>
                <td>{{ $userDetails['passportNumber'] }}</td>
            </tr>
            <tr>
                <td>Passport Expiry</td>
                <td>{{ $userDetails['passportExpiry'] }}</td>
            </tr>
        </table>
        <h2>Application Details</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>VOA ID</td>
                <td>{{ $voaId }}</td>
            </tr>
            <tr>
                <td>Passenger Count</td>
                <td>{{ $passengerCount }}</td>
            </tr>
            <tr>
                <td>Total Price</td>
                <td>{{ $totalPrice }} USD</td>
            </tr>
        </table>
        <h2>Passenger Details</h2>
        @foreach($formData['passengers'] as $index => $passenger)
            <h3>Passenger {{ $index + 1 }}</h3>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Surname</td>
                    <td>{{ $passenger['details']['surname'] }}</td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>{{ $passenger['details']['first_name'] }}</td>
                </tr>
                <tr>
                    <td>Sex</td>
                    <td>{{ $passenger['details']['sex'] }}</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>{{ $passenger['details']['date_of_birth'] }}</td>
                </tr>
                <tr>
                    <td>Current Nationality</td>
                    <td>{{ $passenger['details']['current_nationality'] }}</td>
                </tr>
                <tr>
                    <td>Place of Birth</td>
                    <td>{{ $passenger['details']['place_of_birth'] }}</td>
                </tr>
                <tr>
                    <td>Passport Number</td>
                    <td>{{ $passenger['details']['passport_number'] }}</td>
                </tr>
                <tr>
                    <td>Passport Expiry Date</td>
                    <td>{{ $passenger['details']['passport_expiry_date'] }}</td>
                </tr>
                <tr>
                    <td>Passport Type</td>
                    <td>{{ $passenger['details']['passport_type'] }}</td>
                </tr>
                
                <tr>
                    <td>Issued by Country</td>
                    <td>{{ $passenger['details']['issued_by_country'] }}</td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td>{{ $passenger['details']['email_address'] }}</td>
                </tr>
                <tr>
                    <td>Telephone Number</td>
                    <td>{{ $passenger['details']['telephone_number'] }}</td>
                </tr>
                <tr>
                    <td>Home Address</td>
                    <td>{{ $passenger['details']['home_address'] }}</td>
                </tr>
                <tr>
                    <td>Purpose of Journey</td>
                    <td>{{ $passenger['details']['purpose_of_journey'] }}</td>
                </tr>
                <tr>
                    <td>Intended Arrival Date</td>
                    <td>{{ $passenger['details']['intended_arrival_date'] }}</td>
                </tr>
                <tr>
                    <td>Intended Departure Date</td>
                    <td>{{ $passenger['details']['intended_departure_date'] }}</td>
                </tr>
               
            </table>
        @endforeach
    </div>
</body>

</html>