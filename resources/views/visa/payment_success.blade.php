@extends('layouts.header')
@section('content')

<!-- Content Start -->
<table cellpadding="0" cellspacing="0" cols="1" bgcolor="#ffffff" align="center" style="max-width: 600px; width: 100%;">
  <tr bgcolor="#ffffff">
    <td height="50"
      style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
    </td>
  </tr>

  <!-- This encapsulation is required to ensure correct rendering on Windows 10 Mail app. -->
  <tr bgcolor="#ffffff">
    <td
      style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
      <!-- Separator Start -->
      <table cellpadding="0" cellspacing="0" cols="1" bgcolor="#ffffff" align="center"
        style="max-width: 600px; width: 100%;">
        <tr bgcolor="#ffffff">
          <td height="30"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
      </table>
      <!-- Separator End -->

      <!-- Payment Details Card Start -->
      <table align="center" cellpadding="0" cellspacing="0" cols="3" bgcolor="white"
        style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%;">
        <tr height="50">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr align="center">
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td class="text-primary"
            style="color: #0d1883; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
            <img src="{{ asset('public/assets/img/success.gif') }}" alt="Success" width="80px" height="80px"
              style="border: 0; margin: 0; max-width: 100%; padding: 0;">
          </td>
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr height="17">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr align="center">
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td class="text-primary"
            style="color: #0d1883; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
            <h1
              style="color: #0d1883; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 30px; font-weight: 700; line-height: 34px; margin-bottom: 0; margin-top: 0;">
              Payment received</h1>
          </td>
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr height="30">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr align="left">
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
           
          </td>
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr height="10">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr align="left">
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
            <p
              style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
              Thank you for choosing TravelWheel for your visa processing needs. We are dedicated to providing you with the best
  service and ensuring a smooth and efficient process. If you have any questions or need further assistance, please do
  not hesitate to contact us.</p>
            <br>
            <p
              style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
              <strong>Payment Details:</strong><br />
              Amount: ₦{{ $amount }} <br />
              Company: TravelWheel</p>
            <br>
            <p
              style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
              We advise keeping this transaction ID for future reference.&nbsp;&nbsp;&nbsp;&nbsp;<br /></p>
          </td>
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr height="30">
          <td
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td
            style="border-bottom: 1px solid #D3D1D1; color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr height="30">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <tr align="center">
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
            <p
              style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
              <strong>Transaction reference: {{ $transactionID }}</strong>
            </p>
            <p
              style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
              Order date: {{ $date }}</p>
            <p
              style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
            </p>
          </td>
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>

        <tr height="30">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>

        <!-- Button Row Start -->
        <tr align="center">
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
          <td
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
            <a href="{{ url('/') }}"
              style="background-color: #0d1883; border: none; border-radius: 4px; color: white; display: inline-block; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: bold; line-height: 22px; padding: 10px 20px; text-align: center; text-decoration: none;">
              Back to Homepage
            </a>
          </td>
          <td width="36"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
        <!-- Button Row End -->

        <tr height="50">
          <td colspan="3"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
      </table>
      <!-- Payment Details Card End -->

      <!-- Separator Start -->
      <table cellpadding="0" cellspacing="0" cols="1" bgcolor="#ffffff" align="center"
        style="max-width: 600px; width: 100%;">
        <tr bgcolor="#ffffff">
          <td height="50"
            style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
          </td>
        </tr>
      </table>
      <!-- Separator End -->
    </td>
  </tr>
</table>
<!-- Content End -->

@endsection
<!-- jQery -->
<script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
