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
      <h1>Visa Application Confirmation</h1>
    </div>
    <p>Hello,</p>
    <p>We hope this email finds you well.</p>
    <p>We are delighted to inform you that your visa application with Travelwheel has been successfully submitted.</p>
    <h2>Visa Information</h2>
    <ul>
      <li><strong>Visa To:</strong> {{ $data['visa_to'] }}</li>
      <li><strong>Departure Date:</strong> {{ $data['departure_date'] }}</li>
      <li><strong>Return Date:</strong> {{ $data['return_date'] }}</li>
      <li><strong>Validity:</strong> {{ $data['visa_validity'] }}</li>
      <li><strong>Processing Period:</strong> {{ $data['processing_period'] }}</li>
      <li><strong>Visa Type:</strong> {{ $data['visa_type_name'] }}</li>
      @if ($data['visa_region'] === 'shengen')
        <li><strong>Visa Region:</strong> {{ $data['visa_region'] }}</li>
      @endif
      <li><strong>Entry:</strong> {{ $data['entry_type'] }}</li>
    </ul>
    <p>Please review the attached PDF file containing the comprehensive details of your application. If you have any
      questions or need further assistance, our dedicated support team is here to help.</p>
    <p>Attached are the files you uploaded:</p>

    <div class="row">
     @foreach ($imageLinks as $file)
            <div class="col-md-4 file-item">
              @php
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']);
                $fileName = basename($file);
              @endphp
              @if ($isImage)
                <img src="{{ $file }}" alt="Uploaded image: {{ $fileName }}" class="img-fluid">
              @else
                <a href="{{ $file }}" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-file-alt"></i> {{ $fileName }}
                </a>
              @endif
            </div>
          @endforeach
    </div>

    <p>We value your trust in Travelwheel and look forward to providing you with a seamless experience throughout your
      journey.</p>
    <p>Warm regards,</p>
    <p>The Travelwheel Team</p>
    <p><a href="mailto:support@travelwheel.ng">support@travelwheel.ng</a></p>
    <p><a href="https://www.travelwheel.ng">www.travelwheel.ng</a></p>
  </div>
</body>

</html>
