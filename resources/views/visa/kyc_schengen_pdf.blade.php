<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schengen Visa Application Form</title>
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    $path = public_path('assets/image/twhead.jpg');
    $footerPath = public_path('assets/image/twfoot.jpg');
    ?>
    <img src="{{ 'data:image/jpeg;base64,' . base64_encode(file_get_contents($path)) }}" class="img-fluid"
        alt="protocol" style="width: 50%; margin-left:75%;">
   <h3>{{ strtoupper($request->input('surname') ?? '') }} {{ strtoupper($request->input('first_name') ?? '') }}'s SCHENGEN VISA
    APPLICATION FORM FOR {{ strtoupper($country) }}</h3>

    <?php $counter = 1; ?>

    <?php if (!empty($request->input('surname'))): ?>
        <p><?php echo $counter++; ?>. Surname (Family name): {{ $request->input('surname') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('surname_at_birth'))): ?>
        <p><?php echo $counter++; ?>. Surname at birth (Former family name(s)): {{ $request->input('surname_at_birth') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('first_name'))): ?>
        <p><?php echo $counter++; ?>. First name(s): {{ $request->input('first_name') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('middle_name'))): ?>
        <p><?php echo $counter++; ?>. Middle name(s): {{ $request->input('middle_name') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('date_of_birth'))): ?>
        <p><?php echo $counter++; ?>. Date of Birth (day-month-year): {{ $request->input('date_of_birth') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('place_of_birth'))): ?>
        <p><?php echo $counter++; ?>. Place of Birth: {{ $request->input('place_of_birth') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('country_of_birth'))): ?>
        <p><?php echo $counter++; ?>. Country of birth: {{ $request->input('country_of_birth') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('current_nationality'))): ?>
        <p><?php echo $counter++; ?>. Current nationality: {{ $request->input('current_nationality') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('nationality_at_birth'))): ?>
        <p><?php echo $counter++; ?>. Nationality at birth, if different: {{ $request->input('nationality_at_birth') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('other_nationalities'))): ?>
        <p><?php echo $counter++; ?>. Other nationalities: {{ $request->input('other_nationalities') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('sex'))): ?>
        <p><?php echo $counter++; ?>. Sex: {{ $request->input('sex') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('civil_status'))): ?>
        <p><?php echo $counter++; ?>. Civil Status: {{ $request->input('civil_status') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('parental_authority'))): ?>
        <p><?php echo $counter++; ?>. Parental authority (in case of minors) /legal guardian: {{ $request->input('parental_authority') }}</p>
    <?php endif; ?>
    
      <?php if (!empty($request->input('gnation'))): ?>
        <p><?php echo $counter++; ?>. Guardian Nation: {{ $request->input('gnation') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('national_identity_number'))): ?>
        <p><?php echo $counter++; ?>. National identity number, where applicable: {{ $request->input('national_identity_number') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('passport_type'))): ?>
        <p><?php echo $counter++; ?>. Type of International Passport: {{ $request->input('passport_type') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('passport_number'))): ?>
        <p><?php echo $counter++; ?>. Passport Number: {{ $request->input('passport_number') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('date_of_issue'))): ?>
        <p><?php echo $counter++; ?>. Date of issue: {{ $request->input('date_of_issue') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('passport_expiry_date'))): ?>
        <p><?php echo $counter++; ?>. Passport Expiry date: {{ $request->input('passport_expiry_date') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('issued_by_country'))): ?>
        <p><?php echo $counter++; ?>. Issued by (country): {{ $request->input('issued_by_country') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('home_address'))): ?>
        <p><?php echo $counter++; ?>. Applicant’s home address: {{ $request->input('home_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('email_address'))): ?>
        <p><?php echo $counter++; ?>. Applicant email address: {{ $request->input('email_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('telephone_number'))): ?>
        <p><?php echo $counter++; ?>. Applicant Telephone no.: {{ $request->input('telephone_number') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('other_country_radio'))): ?>
        <p><?php echo $counter++; ?>. Residence in a country other than country of nationality: {{ $request->input('other_country_radio') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('current_work_status'))): ?>
        <p><?php echo $counter++; ?>. Current Work Status: {{ $request->input('current_work_status') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('employer_name'))): ?>
        <p><?php echo $counter++; ?>. Employer name: {{ $request->input('employer_name') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('employer_address'))): ?>
        <p><?php echo $counter++; ?>. Employer’s address: {{ $request->input('employer_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('employer_telephone_number'))): ?>
        <p><?php echo $counter++; ?>. Telephone number: {{ $request->input('employer_telephone_number') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('school_name'))): ?>
        <p><?php echo $counter++; ?>. Name of school: {{ $request->input('school_name') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('school_address'))): ?>
        <p><?php echo $counter++; ?>. Address of educational establishment: {{ $request->input('school_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('purpose_of_journey'))): ?>
        <p><?php echo $counter++; ?>. Purpose(s) of the journey: {{ $request->input('purpose_of_journey') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('main_destination_member_state'))): ?>
        <p><?php echo $counter++; ?>. Member State of main destination: {{ $request->input('main_destination_member_state') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('first_entry_member_state'))): ?>
        <p><?php echo $counter++; ?>. Member State of first entry: {{ $request->input('first_entry_member_state') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('number_of_entries_requested'))): ?>
        <p><?php echo $counter++; ?>. Number of entries requested: {{ $request->input('number_of_entries_requested') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('intended_arrival_date'))): ?>
        <p><?php echo $counter++; ?>. Intended date of arrival in Schengen state: {{ $request->input('intended_arrival_date') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('intended_departure_date'))): ?>
        <p><?php echo $counter++; ?>. Intended date of departure in Schengen state: {{ $request->input('intended_departure_date') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('fingerprints_collected'))): ?>
        <p><?php echo $counter++; ?>. Fingerprints collected previously for the purpose of applying for a Schengen visa: {{ $request->input('fingerprints_collected') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('invitaion_means'))): ?>
        <p><?php echo $counter++; ?>. Means of Invitation: {{ $request->input('invitaion_means') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('inviting_person'))): ?>
        <p><?php echo $counter++; ?>. Surname and first name of the inviting person(s): {{ $request->input('inviting_person') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('inviting_person_address'))): ?>
        <p><?php echo $counter++; ?>. Address and e-mail of inviting person(s): {{ $request->input('inviting_person_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('inviting_person_telephone'))): ?>
        <p><?php echo $counter++; ?>. Telephone no.: {{ $request->input('inviting_person_telephone') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('inviting_mail'))): ?>
        <p><?php echo $counter++; ?>. inviting person mail: {{ $request->input('inviting_mail') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('inviting_company_or_organization_name_address'))): ?>
        <p><?php echo $counter++; ?>. Name and address of inviting company/organization: {{ $request->input('inviting_company_or_organization_name_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('contact_person_surname')) && !empty($request->input('contact_person_first_name')) && !empty($request->input('contact_person_address')) && !empty($request->input('contact_person_telephone')) && !empty($request->input('contact_person_email'))): ?>
        <p><?php echo $counter++; ?>. Surname, first name, address, telephone no., and e-mail address of contact person in company/organization: Surname: {{ $request->input('contact_person_surname') }}, First name: {{ $request->input('contact_person_first_name') }}, Address: {{ $request->input('contact_person_address') }}, Telephone no.: {{ $request->input('contact_person_telephone') }}, E-mail: {{ $request->input('contact_person_email') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('company_or_organization_telephone'))): ?>
        <p><?php echo $counter++; ?>. Telephone no. of company/organization: {{ $request->input('company_or_organization_telephone') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('company_or_organization_name'))): ?>
        <p><?php echo $counter++; ?>. Name of company/organization: {{ $request->input('company_or_organization_name') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('company_or_organization_address'))): ?>
        <p><?php echo $counter++; ?>. Address of company/organization: {{ $request->input('company_or_organization_address') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('company_or_organization_email'))): ?>
        <p><?php echo $counter++; ?>. Email address of company/organization: {{ $request->input('company_or_organization_email') }}</p>
    <?php endif; ?>

    <?php if (!empty($request->input('cost_coverage'))): ?>
        <p><?php echo $counter++; ?>. Cost of travelling and living during the applicant’s stay is covered by: {{ $request->input('cost_coverage') }}</p>
    <?php endif; ?>

      <?php if ($request->input('travelwheel_hotel') === null): ?>
  <p><?php echo $counter++; ?>. Hotel Name: {{ $request->input('hotel_adress') }}</p>
  <?php else: ?>
  <p><?php echo $counter++; ?>. Hotel: Hotel arrangements will be handled by Travelwheel</p>
  <?php endif; ?>

    <div class="footer">
        <img src="{{ 'data:image/jpeg;base64,' . base64_encode(file_get_contents($footerPath)) }}"
            class="img-fluid w-100" style="width: 100%;" alt="Footer">
    </div>
</body>
</html>
