<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uploaded Files</title>
</head>

<body>
  <h3>Dear {{ $mail }},</h3>

  <p>Below are the links to the uploaded images:</p>

  <ul>
    @foreach ($imageLinks as $imageLink)
      <li><a href="{{ $imageLink }}">{{ $imageLink }}</a></li>
    @endforeach
  </ul>
  <p>We will promptly notify you should there be a requirement to upload additional documents, ensuring a seamless
    continuation of the process.</p>
  <p>Thank you</p>
  <a href="support@travelwheel.ng">support@travelwheel.ng</a>
  <a href="travelwheel.ng">TravelWheel.ng</a>
</body>

</html>
