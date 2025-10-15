
<!DOCTYPE html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <!-- Site Title -->
  <title>Hotel Booking Invoice</title>
  <link rel="stylesheet" href="{{asset('public/assets/css/hotelstyle.css')}}">
  <style>
      #logo{
        width:200px;
        height:30px;
      }
  </style>
</head>

<body>
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">
            <p class="cs-invoice_number cs-primary_color cs-mb0 cs-f16">
              <b class="cs-primary_color">Invoice No:</b> {{$reference}}
            </p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="https://www.travelwheel.ng/public/assets/img/Travelwheel.png" alt="Logo" id="logo"></div>
          </div>
        </div>

        <div class="cs-invoice_head cs-mb10">
          <div class="cs-invoice_left">
               @php
              $bookingData = json_decode($bookingDetails['bookingData'], true);
              $roomDetails = $bookingData[0]['rates'][0];
            @endphp
            <p>
              <b class="cs-primary_color cs-f22">Confirmed: {{ count($roomDetails['daily_prices']) }} nights</b> <br>
              <b class="cs-primary_color">Booked By {{ $bookingDetails['email'] }}</b> <br>
              {{ date('l, F d, Y') }}
            </p>
          </div>
           @php
          $hotel_id = $bookingDetails['hotel_id'];
          $formatted_hotel_id = ucwords(str_replace('_', ' ', $hotel_id));
        @endphp
          <div class="cs-invoice_right cs-text_right">
            <b class="cs-primary_color">{{ $formatted_hotel_id }}</b>
            <p>
               {{ $hotel['data']['address']}}<br>
                           {{ $hotel['data']['email']}}
            </p>
          </div>
        </div>

        <div class="cs-invoice_head cs-50_col cs-mb25">
          <div class="cs-invoice_left">
            <b class="cs-primary_color">{{ ($details['guest']) }} Traveler(s) on this trip</b> <br>
           
          </div>
          <div class="cs-invoice_right">
            <ul class="cs-bar_list">
              <li><b class="cs-primary_color">Check In:</b> {{ $bookingDetails['checkin'] }}</li>
              <li><b class="cs-primary_color">Check Out:</b> {{ $bookingDetails['checkout'] }}</li>
            </ul>
          </div>
        </div>

        <ul class="cs-list cs-style2">
          <li>
            <div class="cs-list_left">
              <b class="cs-primary_color">Hosted By</b> <br>
              <p class="cs-mb0">{{ $formatted_hotel_id }}<br>Phone:  {{ $hotel['data']['phone']}}</p>
            </div>
            <div class="cs-list_right">
              <b class="cs-primary_color">Room Details:</b> <br>
              <p class="cs-mb5">{{ $roomDetails['room_name'] }}</p>
              <p class="cs-mb0">{{ $formatted_hotel_id }}</p>
            </div>
          </li>
        </ul>

        <div class="cs-table cs-style1">
          <div class="cs-round_border">
            <div class="cs-table_responsive">
              <table class="cs-border_less">
                <tbody>
                  <tr>
                    <td class="cs-primary_color cs-semi_bold cs-f18" colspan="3">Charges</td>
                  </tr>
                  <tr>
                    <td>{{ count($roomDetails['daily_prices']) }} Night(s) - {{ $roomDetails['room_data_trans']['main_name'] }}</td>
                    <td class="cs-primary_color">{{ count($roomDetails['daily_prices']) }} X ₦{{ number_format($roomDetails['daily_prices'][0], 0) }}</td>
                    <td class="cs-bold cs-primary_color cs-text_right">₦{{ number_format($roomDetails['payment_options']['payment_types'][0]['show_amount']) }}</td>
                  </tr>
                                  </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="cs-table cs-style1 cs-mb20">
          <div class="cs-table_responsive">
            <table class="cs-border_less">
              <tbody>
                <tr>
                  <td>
                       @php
        $meal =  ucfirst($roomDetails['meal']);
    @endphp

    @if ($meal === 'Full-board')
        <i class="las la-utensils" style="color: green;"></i> Full-board
    @elseif ($meal === 'Nomeal')
        <i class="las la-times-circle" style="color: red;"></i> No Meal
    @elseif ($meal === 'Breakfast')
        <i class="las la-coffee" style="color: orange;"></i> Breakfast
    @elseif ($meal === 'Breakfast-for-1')
        <i class="las la-user" style="color: blue;"></i> Breakfast for 1
    @elseif ($meal === 'Breakfast-for-2')
        <i class="las la-users" style="color: purple;"></i> Breakfast for 2
    @else
        <i class="las la-question-circle" style="color: grey;"></i> {{ $meal }}
    @endif
                  </td>
                  <td class="cs-bold cs-primary_color cs-f18">Total Amount:</td>
                  <td class="cs-bold cs-primary_color cs-f18 cs-text_right">₦{{ number_format($roomDetails['payment_options']['payment_types'][0]['show_amount']) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="cs-table cs-style1 cs-type1 cs-focus_bg">
          <div class="cs-table_responsive">
            <table>
              <tbody>
                <tr>
                  <td class="cs-primary_color cs-bold cs-f18">Payment Details</td>
                  <td class="cs-text_center cs-semi_bold">Date</td>
                  <td class="cs-text_center cs-semi_bold">Transaction ID</td>
                  <td class="cs-text_right cs-semi_bold">Amount</td>
                </tr>
                <tr>
                  <td class="cs-primary_color">Paid to TravelWheel</td>
                  <td class="cs-primary_color cs-text_center">{{ date('l, F d, Y h:i A') }}</td>
                  <td class="cs-primary_color cs-text_center">{{$reference}}</td>
                  <td class="cs-primary_color cs-text_right">₦{{ number_format($roomDetails['payment_options']['payment_types'][0]['show_amount']) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="cs-table cs-style1 cs-type1">
          <div class="cs-table_responsive">
            <table>
              <tbody>
                <tr class="cs-table_baseline">
                  <td>
                    <b class="cs-primary_color">Cost Per Night</b> <br>
                  {{$roomDetails['daily_prices'][0]}} per night.
                  </td>
                  <td>
                    <p class="cs-mb5 cs-primary_color cs-semi_bold">Paid:</p>
                    <p class="cs-m0 cs-primary_color cs-semi_bold">Balance Due:</p>
                  </td>
                  <td>
                    <p class="cs-mb5 cs-text_right cs-primary_color cs-semi_bold">₦{{ number_format($roomDetails['payment_options']['payment_types'][0]['show_amount']) }}</p>
                    <p class="cs-m0 cs-text_right cs-primary_color cs-semi_bold">₦0</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="cs-note">
          <div class="cs-note_left">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
              <path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
              <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
          </div>
          <div class="cs-note_right">
            <p class="cs-mb0" ><b class="cs-primary_color cs-bold">Note:</b></p>
             @if ($roomDetails['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'] == null)
              <p style="color: red;" class="cs-m0">No free cancellation</p>
            @else
              <p style="color: green;"  class="cs-m0">Free cancellation before
                {{ \Carbon\Carbon::parse($roomDetails['payment_options']['payment_types'][0]['cancellation_penalties']['free_cancellation_before'])->format('F j, Y, H:i') }}
              </p>
            @endif
          </div>
        </div>

      </div>
      <div class="cs-invoice_btns cs-hide_print">
        <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
            <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
            <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
            <circle cx="392" cy="184" r="24"/>
          </svg>
          <span>Print</span>
        </a>
        <a href="#" class="cs-invoice_btn cs-color2">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path d="M440 16H72a56.06 56.06 0 00-56 56v368a56.06 56.06 0 0056 56h368a56.06 56.06 0 0056-56V72a56.06 56.06 0 00-56-56z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
            <rect x="144" y="144" width="224" height="160" rx="20" ry="20" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
            <path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" d="M336 224l40 40 40-40M336 288l40 40 40-40"/>
          </svg>
          <span>Download</span>
        </a>
      </div>
    </div>
  </div>
  <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/assets/js/jspdf.min.js')}}"></script>
  <script src="{{asset('public/assets/js/html2canvas.min.js')}}"></script>
  <script src="{{asset('public/assets/js/hotelmain.js')}}"></script>
</body>


</html>



