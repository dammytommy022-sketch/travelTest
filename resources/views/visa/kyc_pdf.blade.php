<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Application Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .footer { position: fixed; bottom: 0; text-align: center; width: 100%; }
        .img-fluid { max-width: 100%; height: auto; }
        h3 { text-align: center; }
        h4 { margin-top: 20px; }
        p { margin: 5px 0; }
        hr { margin: 20px 0; }
        ul { margin-left: 20px; }
    </style>
</head>
<body>
    <?php
    $path = public_path('assets/image/twhead.jpg');
    $footerPath = public_path('assets/image/twfoot.jpg');
    ?>

    <img src="{{ 'data:image/jpeg;base64,' . base64_encode(file_get_contents($path)) }}" class="img-fluid" alt="protocol"
         style="width: 50%; margin-left: 25%;">
    <h3>VISA APPLICATION FORM FOR {{ strtoupper($country) }}</h3>

    @foreach ($passengers as $index => $passenger)
        <?php $counter = 1; ?>
        <h4>Passenger {{ $index + 1 }}: {{ strtoupper($passenger['surname'] ?? '') }} {{ strtoupper($passenger['first_name'] ?? '') }}</h4>

        @if (!empty($passenger['surname']))
            <p><?php echo $counter++; ?>. Surname (Family name): {{ $passenger['surname'] }}</p>
        @endif

        @if (!empty($passenger['surname_at_birth']))
            <p><?php echo $counter++; ?>. Surname at birth (Former family name(s)): {{ $passenger['surname_at_birth'] }}</p>
        @endif

        @if (!empty($passenger['first_name']))
            <p><?php echo $counter++; ?>. First name(s): {{ $passenger['first_name'] }}</p>
        @endif

        @if (!empty($passenger['middle_name']))
            <p><?php echo $counter++; ?>. Middle name(s): {{ $passenger['middle_name'] }}</p>
        @endif

        @if (!empty($passenger['date_of_birth']))
            <p><?php echo $counter++; ?>. Date of Birth (day-month-year): {{ $passenger['date_of_birth'] }}</p>
        @endif

        @if (!empty($passenger['place_of_birth']))
            <p><?php echo $counter++; ?>. Place of Birth: {{ $passenger['place_of_birth'] }}</p>
        @endif

        @if (!empty($passenger['country_of_birth']))
            <p><?php echo $counter++; ?>. Country of birth: {{ $passenger['country_of_birth'] }}</p>
        @endif

        @if (!empty($passenger['current_nationality']))
            <p><?php echo $counter++; ?>. Current nationality: {{ $passenger['current_nationality'] }}</p>
        @endif

        @if (!empty($passenger['nationality_at_birth']))
            <p><?php echo $counter++; ?>. Nationality at birth, if different: {{ $passenger['nationality_at_birth'] }}</p>
        @endif

        @if (!empty($passenger['sex']))
            <p><?php echo $counter++; ?>. Sex: {{ $passenger['sex'] }}</p>
        @endif

        @if (!empty($passenger['civil_status']))
            <p><?php echo $counter++; ?>. Civil Status: {{ $passenger['civil_status'] }}</p>
        @endif

        @if (!empty($passenger['guardian_surname']) || !empty($passenger['guardian_first_name']))
            <p><?php echo $counter++; ?>. Parental authority (in case of minors) / legal guardian:
                {{ $passenger['guardian_surname'] }} {{ $passenger['guardian_first_name'] }}</p>
        @endif

        @if (!empty($passenger['gnation']))
            <p><?php echo $counter++; ?>. Guardian Nation: {{ $passenger['gnation'] }}</p>
        @endif

        @if (!empty($passenger['national_identity_number']))
            <p><?php echo $counter++; ?>. National identity number, where applicable: {{ $passenger['national_identity_number'] }}</p>
        @endif

        @if (!empty($passenger['passport_type']))
            <p><?php echo $counter++; ?>. Type of International Passport: {{ $passenger['passport_type'] }}</p>
        @endif

        @if (!empty($passenger['passport_number']))
            <p><?php echo $counter++; ?>. Passport Number: {{ $passenger['passport_number'] }}</p>
        @endif

        @if (!empty($passenger['date_of_issue']))
            <p><?php echo $counter++; ?>. Date of issue: {{ $passenger['date_of_issue'] }}</p>
        @endif

        @if (!empty($passenger['passport_expiry_date']))
            <p><?php echo $counter++; ?>. Passport Expiry date: {{ $passenger['passport_expiry_date'] }}</p>
        @endif

        @if (!empty($passenger['issued_by_country']))
            <p><?php echo $counter++; ?>. Issued by (country): {{ $passenger['issued_by_country'] }}</p>
        @endif

        @if (!empty($passenger['home_address']))
            <p><?php echo $counter++; ?>. Applicant’s home address: {{ $passenger['home_address'] }}</p>
        @endif

        @if (!empty($passenger['email_address']))
            <p><?php echo $counter++; ?>. Applicant email address: {{ $passenger['email_address'] }}</p>
        @endif

        @if (!empty($passenger['telephone_number']))
            <p><?php echo $counter++; ?>. Applicant Telephone no.: {{ $passenger['telephone_number'] }}</p>
        @endif

        @if (!empty($passenger['other_country_radio']))
            <p><?php echo $counter++; ?>. Residence in a country other than country of nationality: {{ $passenger['other_country_radio'] }}</p>
        @endif

        @if (!empty($passenger['current_work_status']))
            <p><?php echo $counter++; ?>. Current Work Status: {{ $passenger['current_work_status'] }}</p>
        @endif

        @if (!empty($passenger['employer_name']))
            <p><?php echo $counter++; ?>. Employer name: {{ $passenger['employer_name'] }}</p>
        @endif

        @if (!empty($passenger['employer_address']))
            <p><?php echo $counter++; ?>. Employer’s address: {{ $passenger['employer_address'] }}</p>
        @endif

        @if (!empty($passenger['employer_telephone_number']))
            <p><?php echo $counter++; ?>. Telephone number: {{ $passenger['employer_telephone_number'] }}</p>
        @endif

        @if (!empty($passenger['school_name']))
            <p><?php echo $counter++; ?>. Name of school: {{ $passenger['school_name'] }}</p>
        @endif

        @if (!empty($passenger['school_address']))
            <p><?php echo $counter++; ?>. Address of educational establishment: {{ $passenger['school_address'] }}</p>
        @endif

        @if (!empty($passenger['purpose_of_journey']))
            <p><?php echo $counter++; ?>. Purpose(s) of the journey: {{ $passenger['purpose_of_journey'] }}</p>
        @endif

        @if (!empty($passenger['intended_arrival_date']))
            <p><?php echo $counter++; ?>. Intended date of arrival in Schengen state: {{ $passenger['intended_arrival_date'] }}</p>
        @endif

        @if (!empty($passenger['intended_departure_date']))
            <p><?php echo $counter++; ?>. Intended date of departure in Schengen state: {{ $passenger['intended_departure_date'] }}</p>
        @endif

        @if (!empty($passenger['invitaion_means']))
            <p><?php echo $counter++; ?>. Means of Invitation: {{ $passenger['invitaion_means'] }}</p>
        @endif

        @if (!empty($passenger['inviting_person']))
            <p><?php echo $counter++; ?>. Surname and first name of the inviting person(s): {{ $passenger['inviting_person'] }}</p>
        @endif

        @if (!empty($passenger['inviting_person_address']))
            <p><?php echo $counter++; ?>. Address and e-mail of inviting person(s): {{ $passenger['inviting_person_address'] }}</p>
        @endif

        @if (!empty($passenger['inviting_person_telephone']))
            <p><?php echo $counter++; ?>. Telephone no.: {{ $passenger['inviting_person_telephone'] }}</p>
        @endif

        @if (!empty($passenger['inviting_mail']))
            <p><?php echo $counter++; ?>. Inviting person mail: {{ $passenger['inviting_mail'] }}</p>
        @endif

        @if (!empty($passenger['company_or_organization_name']))
            <p><?php echo $counter++; ?>. Name of company/organization: {{ $passenger['company_or_organization_name'] }}</p>
        @endif

        @if (!empty($passenger['company_or_organization_address']))
            <p><?php echo $counter++; ?>. Address of company/organization: {{ $passenger['company_or_organization_address'] }}</p>
        @endif

        @if (!empty($passenger['company_or_organization_telephone']))
            <p><?php echo $counter++; ?>. Telephone no. of company/organization: {{ $passenger['company_or_organization_telephone'] }}</p>
        @endif

        @if (!empty($passenger['company_or_organization_email']))
            <p><?php echo $counter++; ?>. Email address of company/organization: {{ $passenger['company_or_organization_email'] }}</p>
        @endif

        @if (!empty($passenger['contact_person_surname']) && !empty($passenger['contact_person_first_name']))
            <p><?php echo $counter++; ?>. Surname, first name, address, telephone no., and e-mail address of contact person in company/organization:
                Surname: {{ $passenger['contact_person_surname'] }}, First name: {{ $passenger['contact_person_first_name'] }},
                Address: {{ $passenger['contact_person_address'] }}, Telephone no.: {{ $passenger['contact_person_telephone'] }},
                E-mail: {{ $passenger['contact_person_email'] }}</p>
        @endif

        @if (!empty($passenger['cost_coverage']))
            <p><?php echo $counter++; ?>. Cost of travelling and living during the applicant’s stay is covered by: {{ $passenger['cost_coverage'] }}</p>
        @endif

        @if (isset($passenger['travelwheel_hotel']) && $passenger['travelwheel_hotel'] !== null)
            <p><?php echo $counter++; ?>. Hotel: Hotel arrangements will be handled by Travelwheel</p>
        @elseif (!empty($passenger['hotel_adress']))
            <p><?php echo $counter++; ?>. Hotel Name: {{ $passenger['hotel_adress'] }}</p>
        @endif

        @if (isset($passenger['insurance']) && $passenger['insurance'] !== 'yes')
            <p><?php echo $counter++; ?>. Travel Insurance Coverage Days: {{ $passenger['selectedCoverageDays'] }}</p>
        @endif

        @if (isset($passenger['travelwheel_flight']) && $passenger['travelwheel_flight'] !== null)
            <p><?php echo $counter++; ?>. Flight Reservation: Flight Reservation will be handled by Travelwheel</p>
        @endif
    @endforeach

    <div class="mt-3">
        <hr>
        <h5><b>Disclaimer</b></h5>
        <ul>
            <li><p><b>TravelWheel</b> will process visas based on the information provided in the documentation.</p></li>
            <li><p>Please note that the processing time indicated above are from the time they are submitted to the respective visa decision making authority. Processing time may vary under exceptional circumstances beyond the control of <b>TravelWheel</b>.</p></li>
            <li><p>Please note that the document/documents list shown are subject to change without prior notice. Any additional documents/information required will be communicated after careful evaluation of the application.</p></li>
            <li><p><b>TravelWheel</b> hereby declares that it does not facilitate the sale of visas.</p></li>
            <li><p>Visa is at the discretion of the embassy visa officer, and <b>TravelWheel</b> does not influence or guarantee the outcome of visa applications.</p></li>
            <li><p>Should you become aware of any visa sale or purchase transactions, please report them to <b>TravelWheel</b> management immediately, as we strictly prohibit such activities.</p></li>
            <li><p>Visas for any form of trafficking are strictly prohibited by <b>TravelWheel</b>.</p></li>
        </ul>
    </div>

    <div class="footer">
        <img src="{{ 'data:image/jpeg;base64,' . base64_encode(file_get_contents($footerPath)) }}" class="img-fluid w-100" alt="Footer">
    </div>
</body>
</html>