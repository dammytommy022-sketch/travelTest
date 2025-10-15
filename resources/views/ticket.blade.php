<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        .w-50{
            width:90%;
        }
        .w-15{
            width:15%;
        }
        .smaller{
            font-size:12px; 
        }
        .smallerP{
            font-size:14px; 
        }
            .passenger-grid {
            display: flex;
            flex-wrap: wrap;
        }
        .passenger-card {
            width: 32%;
            margin: 1%;
            border: 1px solid #000;
            padding: 10px;
            box-sizing: border-box;
            font-size: 13px;
        }

        
    </style>
</head>
<body>
   
    <center>
        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents($path)) }}"class="img-fluid w-50" alt="protocol"><br>
        <small class="smaller"><b>NOTE: </b>This Boarding Pass expires after Departure / Arrival date.</small>
    </center> 
    
    <!-- Add other data fields as needed -->
    <br>
    
    <img style="float:right;" src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
   
    
    @if($nop == 1)
        <div class="passenger-grid">
            <div class="passenger-card">
                <small><b>PNR/Reservation Code: {{ $pnr ?? $pnr }}</b></small><br>
                <small><b>e-Ticket No.: {{ $ticket_no ?? $ticket_no }}</b></small><br>
                <small><b>No. of Bags: {{ $nobs ?? $nobs }} pcs</b></small><br>
            </div>
        </div>
    @elseif($nop > 1 && is_array($pnr))
        <table width="70%" cellspacing="10" cellpadding="5" style="border-collapse: collapse;">
            <tr>
                @foreach($pnr as $index => $code)
                    <td width="23%" style="border: 1px solid #000; vertical-align: top;">
                        <small class="smaller" style="color:black;"><b>Passenger {{ $index + 1 }}</b></small><br>
                        <small class="smaller" style="color:black;"><b>PNR:</b> {{ $code }}</small><br>
                        <small class="smaller" style="color:black;"><b>e-Ticket No.:</b> {{ $ticket_no[$index] ?? '' }}</small><br>
                        <small class="smaller" style="color:black;"><b>No. of Bags:</b> {{ $nobs[$index] ?? 0 }} pcs</small>
                    </td>

                    @if(($index + 1) % 3 == 0)
                        </tr><tr>
                    @endif
                @endforeach

                {{-- Fill in remaining cells if total is not a multiple of 3 --}}
                @php
                    $remaining = 3 - ($nop % 3);
                @endphp
                @if($remaining < 3)
                    @for($i = 0; $i < $remaining; $i++)
                        <td></td>
                    @endfor
                @endif
            </tr>
        </table>
    @endif
    <br><br>

    <hr>
   
   
    <small class="smallerP"><b>Expected Services</b></small><br>
    
    @if($plan == "Regular")
        <small class="smaller" style="color:black;">- Meet and Greet.</small><br>
        <small class="smaller" style="color:black;">- Exclusive Baggage Handling.</small><br>
        <small class="smaller" style="color:black;">- No Queuing. </small><br>
        <small class="smaller" style="color:black;">- Stress free Check-in Process.</small><br>
    @elseif($plan == "VIP")
        <small class="smaller" style="color:black;">- Meet and Greet.</small><br>
        <small class="smaller" style="color:black;">- Check-in Process.</small><br>
        <small class="smaller" style="color:black;">- Fast-tracking Check-in Process.</small><br>
        <small class="smaller" style="color:black;">- No Queuing. </small><br>
        <small class="smaller" style="color:black;">- Stress free Check-in Process. </small><br>
        <small class="smaller" style="color:black;">- Escort through Boarding Gate.</small><br> 
    @endif

    
    <small class="smaller" style="color:black;">- Other relevant Airport protocol saervice as case may be.</small><br>
    <small class="smaller" style="color:red;">- Payment is refundable at a 30% penalty before the departure/arrival date.</small><br>
    <small class="smaller" style="color:red;">- Payment is non-refundable after the departure/arrival date.</small><br><br>
    <hr>
    @if($optional_request != "None")
        <div>
            <small class="smallerP" style="color:black;"><b>Optional Request</b></small><br>
            <small class="smaller" style="color:black;">{{$optional_request}}: {{$optional_requestOption}}</small><br>
            <small class="smaller" style="color:black;">Address: {{$optional_requestAddress}}.</small><br>
        </div>
        <hr>
    @endif
    <small class="smallerP" style="color:black;">
        <b>Disclaimer:</b><br>
        This airport protocol service disclaimer specifies the terms and conditions that govern the use of the airport protocol service. 
        The service provider shall not be liable for any delays, cancellations, or changes in the airline's schedule. Users are advised 
        to check with the airline for any last-minute changes. The service provider shall not be responsible for any loss or damage to 
        personal belongings. Users are advised to keep their belongings secured at all times. The service provider reserves the right to 
        refuse service to any individual. By using the airport protocol service, users also agree to abide by all government agencies' 
        rules because they deserve the right to check and value items in any bag and apply due charges as the case may be. Any government 
        agency can nullify any terms and conditions set forth by the service provider.
    </small><br><br>
    <small class="smaller">Thanks for choosing Travelwheel...</small>
    <img style="float:right;" src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assetsU/assets/img/favicon/twlogo.png')))}}"
                    class="image-fluid w-15" alt="protocol">
</body>
</html>