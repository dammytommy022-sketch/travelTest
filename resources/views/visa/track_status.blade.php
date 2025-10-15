<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Travel Wheel">
    <title>TravelWheel | Air -visa</title>
    <meta name="twitter:url" content="https://www.travelwheel.ng/air/visa">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/assetsU/assets/img/favicon/twicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('public/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha384-y+56Fn5EXOTmb3TzC2oWyKxu2O7p3pEbxkbeUGtJkZttp6Cgjb99E3Z2kd4Rfiiy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary: #0d1883;
            --secondary: #0d9c53;
            --primary-light: #1a27b3;
            --secondary-light: #10c666;
            --bg-light: #f8f9fa;
            --transition: all 0.3s ease;
        }

        .tracking-section {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--bg-light) 0%, #e9ecef 100%);
            padding: 40px 0;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .page-header h1 {
            color: var(--primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .application-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .application-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(13, 24, 131, 0.15);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .token-badge {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-issued {
            background: #d4edda;
            color: #155724;
        }

        .card-body {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-group {
            padding: 1rem;
            background: var(--bg-light);
            border-radius: 10px;
            transition: var(--transition);
        }

        .info-group:hover {
            background: #e9ecef;
        }

        .info-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .action-button {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
        }

        .action-button:hover {
            background: var(--secondary-light);
            transform: translateY(-2px);
        }

        .back-button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
            margin-top: 2rem;
            display: inline-block;
        }

        .back-button:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .card-body {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    @include('layouts.newnav')

    <main class="tracking-section mt-5">
        <div class="container">
            <div class="page-header">
                <h1>Track Your Applications</h1>
                <p>View and manage your visa and VOA applications</p>
            </div>

            @if ($applications->isEmpty())
                <div class="text-center">
                    <i class="fas fa-folder-open fa-3x mb-3" style="color: var(--primary);"></i>
                    <p>No applications found.</p>
                </div>
            @else
                @foreach ($applications as $app)
                    <div class="application-card">
                        <div class="card-header">
                            <span class="token-badge">{{ $app->token }}</span>
                            <span class="status-badge {{ $app->status === 'Issued' ? 'status-issued' : 'status-pending' }}">
                                {{ $app->status }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="info-group">
                                <div class="info-label">Destination</div>
                                <div class="info-value">{{ $app->visa_to }}</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Application Type</div>
                                <div class="info-value">{{ $app->type }}</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Last Updated</div>
                                <div class="info-value">
                                    {{ $app->status_updated_at ? $app->status_updated_at->format('Y-m-d H:i') : 'N/A' }}
                                </div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Action</div>
                                <div class="info-value">
                                    @if ($app->status === 'Issued' && $app->visa_document_path)
                                        <a href="{{ route('visa.download', $app->token) }}" class="action-button">
                                            <i class="fas fa-download me-2"></i>Download Visa
                                        </a>
                                    @else
                                        <span class="text-muted">No document available</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <a href="{{ route('visa.track') }}" class="back-button">
                <i class="fas fa-arrow-left me-2 text-white" ></i>Back
            </a>
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b1c7dc27be.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/assets/js/jquery.flurry.js') }}"></script>
    <script src="https://web.pressone.africa/pub-widget.js"></script>



</body>

</html>