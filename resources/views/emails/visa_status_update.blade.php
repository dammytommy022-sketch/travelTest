<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visa Application Confirmation</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: auto;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo {
      max-width: 100px;
      height: auto;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      border: none;
      margin-top: 20px;
    }
    
    
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <img src="https://www.travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="Travelwheel Logo"
        class="logo">
      <h1>Visa Application Update</h1>
    </div>
<p>Dear Applicant,</p>
<p>Your {{ $application->type ?? 'Visa' }} application (Token: {{ $application->token }}) has been updated.</p>
<p><strong>Status:</strong> {{ $application->status }}</p>
<p><strong>Updated At:</strong> {{ $application->status_updated_at }}</p>
<p><strong>Destination/Type:</strong> {{ $application->visa_to }}</p>
@if ($application->status === 'Issued' && $application->visa_document_path)
    <p>Your visa document is ready. Please download it from the portal or find it attached.</p>
@endif
  

    <p>We value your trust in Travelwheel and look forward to providing you with a seamless experience throughout your
      journey.</p>
    <p>Warm regards,</p>
    <p>The Travelwheel Team</p>
    <p><a href="mailto:support@travelwheel.ng">support@travelwheel.ng</a></p>
    <p><a href="https://www.travelwheel.ng">www.travelwheel.ng</a></p>
  </div>
</body>

</html>
