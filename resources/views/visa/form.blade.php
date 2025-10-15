  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWheel | Air - Visa </title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="../assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome-6/dist-font/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
      .hidden {
        display: none;
      }

      .nav-tabs {
        border-bottom: 1px solid #fff;
      }

      .nav-tabs .nav-link {
        margin-bottom: -1px;
        background: none;
        border: 1px solid transparent;
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0.375rem;
      }

      .nav-tabs .nav-link:hover,
      .nav-tabs .nav-link:focus {
        border-color: rgba(67, 89, 113, 0.1);
        isolation: isolate;
      }

      .nav-tabs .nav-link.disabled {
        color: #c7cdd4;
        background-color: transparent;
        border-color: transparent;
      }

      .nav-tabs .nav-link.active,
      .nav-tabs .nav-item.show .nav-link {
        color: #697a8d;
        background-color: #fff;
        border-color: #fff;
      }

      .nav-tabs .dropdown-menu {
        margin-top: -1px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }

      .nav-tabs .nav-item .nav-link {
        color: #566a7f;
        border: 0;
        border-radius: 0;
      }

      .nav-tabs .nav-item .nav-link:hover,
      .nav-tabs .nav-item .nav-link:focus {
        color: #566a7f;
      }

      .nav-tabs .nav-item .nav-link:not(.active) {
        background-color: #eceef1;
      }

      .nav-tabs .nav-item .nav-link.disabled {
        color: #c7cdd4;
      }

      .nav-tabs:not(.nav-fill):not(.nav-justified) .nav-link,
      .nav-pills:not(.nav-fill):not(.nav-justified) .nav-link {
        width: 100%;
      }

      .nav-tabs .nav-link {
        background-clip: padding-box;
      }

      .nav-tabs .nav-link.active {
        border-bottom-color: #fff;
      }

      .nav-tabs .nav-link.active:hover,
      .nav-tabs .nav-link.active:focus {
        border-bottom-color: #fff;
      }

      .nav-tabs .nav-link:hover,
      .nav-tabs .nav-link:focus {
        border-bottom-color: transparent;
      }

      .nav-align-top .nav-tabs~.tab-content {
        z-index: 1;
        box-shadow: 0px 6px 7px -1px rgba(67, 89, 113, 0.12);
      }

      .nav-align-top .nav-tabs .nav-item:first-child .nav-link {
        border-top-left-radius: 0.375rem;
      }

      .nav-align-top .nav-tabs .nav-item:last-child .nav-link {
        border-top-right-radius: 0.375rem;
      }

      .nav-align-top .nav-tabs .nav-item:not(:first-child) .nav-link {
        border-left: 1px solid #fff;
      }

      .nav-align-top .nav-tabs .nav-link.active {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-right .nav-tabs~.tab-content {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-right .nav-tabs .nav-item:not(:first-child) .nav-link {
        border-top: 1px solid #fff;
      }

      .nav-align-right .nav-tabs .nav-item:first-child .nav-link {
        border-top-right-radius: 0.375rem;
      }

      .nav-align-right .nav-tabs .nav-item:last-child .nav-link {
        border-bottom-right-radius: 0.375rem;
      }

      .nav-align-right .nav-tabs .nav-link.active {
        box-shadow: 5px 4px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-bottom .nav-tabs~.tab-content {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-bottom .nav-tabs .nav-item:first-child .nav-link {
        border-bottom-left-radius: 0.375rem;
      }

      .nav-align-bottom .nav-tabs .nav-item:last-child .nav-link {
        border-bottom-right-radius: 0.375rem;
      }

      .nav-align-bottom .nav-tabs .nav-item:not(:first-child) .nav-link {
        border-left: 1px solid #fff;
      }

      .nav-align-bottom .nav-tabs .nav-link.active {
        box-shadow: 0 4px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-left .nav-tabs~.tab-content {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-left .nav-tabs .nav-item:not(:first-child) .nav-link {
        border-top: 1px solid #fff;
      }

      .nav-align-left .nav-tabs .nav-item:first-child .nav-link {
        border-top-left-radius: 0.375rem;
      }

      .nav-align-left .nav-tabs .nav-item:last-child .nav-link {
        border-bottom-left-radius: 0.375rem;
      }

      .nav-align-left .nav-tabs .nav-link.active {
        box-shadow: -5px 2px 6px 0 rgba(67, 89, 113, 0.12);
      }

      .nav-align-top .nav-tabs:not(.nav-fill)~.tab-content {
        border-top-right-radius: 0.375rem;
      }

      .tab-content>.tab-pane {
        display: none;
      }

      .tab-content>.active {
        display: block;
      }

      .tab-content {
        padding: 1.5rem;
        border-radius: 0.375rem;
      }

      .nav-align-right>.tab-content,
      .nav-align-left>.tab-content {
        flex-grow: 1;
      }

      .nav-align-top>.tab-content,
      .nav-align-right>.tab-content,
      .nav-align-bottom>.tab-content,
      .nav-align-left>.tab-content {
        flex-shrink: 1;
        border: 0 solid #d9dee3;
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        background-clip: padding-box;
        background: #fff;
      }

      .nav-align-top :not(.nav-pills)~.tab-content {
        border-radius: 0 0 0.375rem 0.375rem;
      }

      .nav-align-top .nav-tabs:not(.nav-fill)~.tab-content {
        border-top-right-radius: 0.375rem;
      }

      .nav-align-right :not(.nav-pills)~.tab-content {
        border-radius: 0.375rem 0 0 0.375rem;
      }

      .nav-align-bottom :not(.nav-pills)~.tab-content {
        border-radius: 0.375rem 0.375rem 0 0;
      }

      .nav-align-left :not(.nav-pills)~.tab-content {
        border-radius: 0 0.375rem 0.375rem 0;
      }

      .nav-align-left>.tab-content {
        border-radius: 0 0.375rem 0.375rem 0.375rem;
      }

      @media all and (-ms-high-contrast: none),
      (-ms-high-contrast: active) {

        .card,
        .card-body,
        .media,
        .flex-column,
        .tab-content {
          min-height: 1px;
        }

        img {
          min-height: 1px;
          height: auto;
        }
      }
    </style>

  </head>

  <body>
    <!-- Navbar -->
    <section>
      @include('layouts.newnav')
    </section>
    <main id="main" style="padding-top: 60px;">
      <div class="row1">
        <h5>Upload Required Document</h5>
        <div class="col-sm-4 mb-2">
          <label for="formFile" class="form-label"><b>Passport File</b></label>
          <input class="form-control" type="file" name="passport-file" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-2">
          <label for="formFile" class="form-label"><b>Bank Statement</b></label>
          <input class="form-control" type="file" name="bank-statement" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3">
          <label for="formFile" class="form-label"><b>Proof Of Resident</b></label>
          <input class="form-control" type="file" name="proof-of-resident" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="NIN" style="display: none">
          <label for="formFile" class="form-label"><b>National Identity Number (NIN)</b></label>
          <input class="form-control" type="file" name="national-identify-number" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="InvitationLetter" style="display: none">
          <label for="formFile" class="form-label"><b>Invitation Letter</b></label>
          <input class="form-control" type="file" name="invitation-letter" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="HotelReservation" style="display: none">
          <label for="formFile" class="form-label"><b>Hotel Reservation</b></label>
          <input class="form-control" type="file" name="hotel-reservation" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="FlightReservation" style="display: none">
          <label for="formFile" class="form-label"><b>Flight Reservation</b></label>
          <input class="form-control" type="file" name="flight-reservation" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="FlightReservation" style="display: none">
          <label for="formFile" class="form-label"><b>Marraige Certificate</b></label>
          <input class="form-control" type="file" name="marraige-certificate" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="LetterFromEmployer" style="display: none">
          <label for="formFile" class="form-label"><b>Letter from Employer</b></label>
          <input class="form-control" type="file" name="letter-from-employer" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="SelfIntroductoryLetter" style="display: none">
          <label for="formFile" class="form-label"><b>Self-introductory Letter</b></label>
          <input class="form-control" type="file" name="self-introductory-letter" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="ChildBirthCertificate" style="display: none">
          <label for="formFile" class="form-label"><b>Children Birth Certicate</b></label>
          <input class="form-control" type="file" name="children-birth-certificate" id="formFile" required>
        </div>
        <div class="col-sm-4 mb-3" id="ChildLetter" style="display: none">
          <label for="formFile" class="form-label"><b>Letter from Child(ren) School</b></label>
          <input class="form-control" type="file" name="letter-from-children" id="formFile" required>
        </div>
      </div>
      <div id="fileContainer" class="col-sm-4 ">
        <label for="formFile" class="form-label"><b>Other Documents</b></label>
      </div>
      <div>
        <button id="addButton" class="btn btn-success" onclick="addFileUploader()">Add More
          Files</button>
      </div>
    </main>
  </body>

  </html>
