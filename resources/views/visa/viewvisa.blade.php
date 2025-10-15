@include('admin.layouts.nav')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div id="alertContainer" class="mt-3"></div>
                <div class="text-start mb-3">
                  <a href="#" onclick="toggleDocumentForm()">+Add New Document</a>
                </div>
                <div class="mb-3" id="documentForm" style="display:none;">
                  {{-- <h5> Add Document</h5> --}}
                  <form id="myForm">
                    @csrf
                    <label for="Document">Document Name</label>
                    <div class="row">
                      <div class="col-3">
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-company2" class="input-group-text">
                            <i class='fa fa-file'></i>
                          </span>
                          <input type="text" name="document" id="basic-icon-default-company" class="form-control"
                            aria-describedby="basic-icon-default-company2" />
                        </div>
                      </div>
                      <div class="col-2">
                        <button type="button" id="submitBtn" class="btn btn-sm btn-primary"
                          onclick="submitForm()">Submit</button>
                      </div>
                      <div class="col-7"></div>
                    </div>
                  </form>
                </div>
                <h5> visas</h5>
                @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="text-end">
                  <a href="{{ route('add.visa') }}">+Add New visa</a>
                </div>

                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>S/N</th>
                        <th class="d-none">ID</th>
                        <th>Edit</th>
                        <th>Country</th>
                        <th>Brand Name</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>Location</th>
                        <th>Application Type</th>
                        <th>Entry</th>
                        <th>Process Time</th>
                        <th>Processing Period</th>
                        <th>Visa Validity</th>
                        <th>Adult Visa Fee</th>
                        <th>Child Visa Fee</th>
                        <th>Infant Visa Fee</th>
                        <th>Biometrics Fee</th>
                        <th>Date Created</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $serial = 1 @endphp
                      @foreach ($visas as $visa)
                        <tr>
                          <td scope="row">{{ $serial++ }}</td>
                          <td class="d-none">{{ $visa->id }}</td>
                          <td><a href="{{ route('edit-visa', ['country_id' => $visa->country_id]) }}"><button
                                class="btn btn-sm btn-primary">Edit</button></a></td>
                          <td>{{ $countries[$visa->country_id] }}</td>
                          <td>{{ $visa->brand }}</td>
                          <td>{{ $visa->email }}</td>
                          <td>{{ $visa->number }}</td>
                          <td>{{ $visa->location }}</td>
                          <td>{{ $visa->visa_type_name }}</td>
                          <td>{{ $visa->entry }}</td>
                          <td>{{ $visa->visa_type }}</td>
                          <td>{{ $visa->processing_period }}</td>
                          <td>{{ $visa->visa_validity }}</td>
                          <td>{{ $visa->visa_fee }}</td>
                          <td>{{ $visa->child_visa_fee }}</td>
                          <td>{{ $visa->infant_visa_fee }}</td>
                          <td>{{ $visa->biometrics_fee_adult }}</td>
                          <td>{{ $visa->created_at }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <script>
      $(document).ready(function() {
        $('#submitBtn').click(function() {
          var formData = $('#myForm').serialize();
          $.ajax({
            url: '{{ route('submit.document') }}',
            type: 'POST',
            data: formData,
            success: function(response) {
              // Handle success response
              $('#basic-icon-default-company').val('');
              $('#documentForm').hide();
              $('#alertContainer').html(
                '<div class="alert alert-success" role="alert">Document submitted successfully</div>');
            },
            error: function(xhr) {
              // Handle error response
              $('#alertContainer').html(
                '<div class="alert alert-danger" role="alert">Failed to submit document</div>');
            }
          });
        });
      });
    </script>


    <script>
      function toggleDocumentForm() {
        var documentForm = document.getElementById('documentForm');
        if (documentForm.style.display === 'none') {
          documentForm.style.display = 'block';
        } else {
          documentForm.style.display = 'none';
        }
      }
    </script>
    <!-- / Content -->
    @include('admin.layouts.footer')
