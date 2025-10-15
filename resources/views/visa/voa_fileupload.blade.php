<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>TravelWheel | Air - Visa </title>
 <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
  <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
 <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --background-color: #f8fafc;
            --card-background: #ffffff;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Inter', sans-serif;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            background: var(--card-background);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .upload-container {
            padding: 2rem;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .file-input-wrapper:hover {
            transform: translateY(-2px);
        }

        .custom-file-input {
            position: relative;
            padding: 1rem;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-file-input:hover {
            border-color: var(--primary-color);
        }

        .file-preview {
            display: none;
            margin-top: 0.5rem;
            padding: 0.5rem;
            background: #f1f5f9;
            border-radius: 8px;
        }

        .progress-bar-wrapper {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: var(--primary-color);
            width: 0;
            transition: width 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .payment-summary {
            padding: 2rem;
        }

        .price-paragraph {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .price {
            font-weight: 600;
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .modal-confirm {
            color: #636363;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-confirm .modal-header {
            border-bottom: none;   
            position: relative;
        }

        .modal-confirm .modal-title {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -15px;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            background: #82ce34;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .icon-box i {
            font-size: 58px;
            position: relative;
            top: 3px;
            color: #fff;
        }
    </style>
</head>
<body>
    <section>
        @include('layouts.newnav')
    </section>

    <main id="main" class="container" style="padding-top: 70px;">
        
        <div class="row justify-content-center">
        <div class="col-12 col-lg-8">     
        <div class="alert" id="alert" style="display: none;"></div>
        </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 files_send">
                <div class="card">
                    <div class="upload-container">
                        <h4 class="mb-4">Upload Required Documents</h4>
                        
                        <form action="{{ route('upload.voafiles') }}" id="filess" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                @foreach ($company as $document)
                                    <div class="col-12 col-md-6 file-input-wrapper">
                                        <label for="adult_{{ $document->id }}" class="form-label">
                                            <strong>{{ $document->requirement_name }}</strong>
                                        </label>
                                        <div class="custom-file-input">
                                            <input class="form-control" type="file" name="adult_{{ $document->id }}" 
                                                   id="adult_{{ $document->id }}" required accept=".pdf,.jpg,.jpeg,.png">
                                            <div class="file-preview" id="preview_adult_{{ $document->id }}"></div>
                                            <div class="progress-bar-wrapper">
                                                <div class="progress-bar" id="progress_adult_{{ $document->id }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($person as $document)
                                    <div class="col-12 col-md-6 file-input-wrapper">
                                        <label for="child_{{ $document->id }}" class="form-label">
                                            <strong>{{ $document->requirement_name }}</strong>
                                        </label>
                                        <div class="custom-file-input">
                                            <input class="form-control" type="file" name="child_{{ $document->id }}" 
                                                   id="child_{{ $document->id }}" required accept=".pdf,.jpg,.jpeg,.png">
                                            <div class="file-preview" id="preview_child_{{ $document->id }}"></div>
                                            <div class="progress-bar-wrapper">
                                                <div class="progress-bar" id="progress_child_{{ $document->id }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-4">
                                <button id="upload-btn" type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload me-2 text-light"></i>Upload Files
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 payment" style="display: none">
                <div class="card sticky-top">
                    <div class="payment-summary">
                        <h4 class="mb-4">Payment Summary</h4>

                        <div class="price-paragraph">
                            <span>Visa Fee</span>
                            <span class="price">₦<span id="visa_fee">{{ number_format($visaData['single_entry_fee']) }}</span></span>
                        </div>
                         <div class="price-paragraph">
                            <span>Biometrics Fee</span>
                            <span class="price">₦<span id="visa_fee">{{ number_format($visaData['biometrics_fee']) }}</span></span>
                        </div>
                         <div class="price-paragraph">
                            <span>Admin Fee</span>
                            <span class="price">₦<span id="visa_fee">{{ number_format($visaData['processing_charge']) }}</span></span>
                        </div>
                         <div class="price-paragraph">
                            <span>Service Charge</span>
                            <span class="price">₦<span id="visa_fee">{{ number_format($visaData['service_charge']) }}</span></span>
                        </div>
                         <div class="price-paragraph">
                            <span>Online Visa Payment Charge</span>
                            <span class="price">₦<span id="visa_fee">{{ number_format($visaData['payment_charge']) }}</span></span>
                        </div>
                        <hr>
                        <div class="price-paragraph">
                            <strong>Total</strong>
                            <span class="price">₦<span id="total">{{ number_format($visaData['total_fee']) }}</span></span>
                        </div>

                        <form id="paymentForm" action="{{ route('voa_checkout') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="amount" id="amount" value="{{ $visaData['total_fee'] }}">
                            <input type="hidden" name="email" id="email" value="{{ $email }}">
                            <input type="hidden" name="country" value="NG">
                            <input type="hidden" name="currency" value="NGN">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-credit-card me-2 text-white"></i>Pay now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Loading Screen -->
    <div id="loading-screen" style="display: none;">
        <div class="loading-spinner"></div>
        <p class="mt-3">Processing your request...</p>
    </div>

    <!-- Success Modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your visa is being processed. Please check your email for further details.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
<section>
    @include('layouts.footer')
</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://seerbitapi.com/api/v2/seerbit.js"></script>

    <script>
        $(document).ready(function() {
             const token = "{{$token}}";
    localStorage.setItem('voa_token', token);
            // File preview functionality
            $('input[type="file"]').change(function(e) {
                const file = e.target.files[0];
                const previewId = 'preview_' + $(this).attr('id');
                const progressId = 'progress_' + $(this).attr('id');
                
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(`#${previewId}`).html(`
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file me-2"></i>
                                <span>${file.name}</span>
                            </div>
                        `).show();
                        
                        // Simulate upload progress
                        let progress = 0;
                        const interval = setInterval(() => {
                            progress += 10;
                            $(`#${progressId}`).css('width', `${progress}%`);
                            if (progress >= 100) clearInterval(interval);
                        }, 200);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Form submission
            $('#filess').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $('#upload-btn').html('<i class="fas fa-spinner fa-spin me-2"></i>Uploading...').prop('disabled', true);

                $.ajax({
                    url: '{{ route('upload.voafiles') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#alert').removeClass('alert-danger').addClass('alert-success')
                            .html('<i class="fas fa-check-circle me-2"></i>Files uploaded successfully! You can proceed to payment.')
                            .fadeIn();
                        $('.files_send').fadeOut();
                        $('.payment').fadeIn();
                    },
                    error: function(xhr, status, error) {
                        $('#alert').removeClass('alert-success').addClass('alert-danger')
                            .html('<i class="fas fa-exclamation-circle me-2"></i>Error uploading files. Please try again.')
                            .fadeIn();
                        $('#upload-btn').html('<i class="fas fa-upload me-2"></i>Upload Files').prop('disabled', false);
                    }
                });
            });

            // Payment form handling
            $('#paymentForm').on('submit', function() {
                $('#loading-screen').fadeIn();
            });

            // Check URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('payment') === 'true') {
                $('.payment').show();
                $('.files_send').hide();
            }
        });
    </script>
</body>

</html>
