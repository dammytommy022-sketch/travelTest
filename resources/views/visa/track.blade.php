<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Travel Wheel">
    <title>TravelWheel | Visa Tracking</title>
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
            --bg-gradient: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
        }

        .track-section {
            padding: 40px 0;
        }

        .track-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(13, 24, 131, 0.1);
            overflow: hidden;
            position: relative;
        }

        .track-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 2rem;
            color: white;
            text-align: center;
            position: relative;
        }

        .track-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            border: 20px solid transparent;
            border-top-color: var(--primary-light);
        }

        .track-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .track-form {
            padding: 3rem 2rem 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 1rem;
            height: 60px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(13, 24, 131, 0.1);
        }

        .track-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .track-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 24, 131, 0.2);
        }

        .track-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .track-btn:hover::before {
            left: 100%;
        }

        .status-indicator {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid var(--primary);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .track-container {
                margin: 1rem;
            }

            .track-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    @include('layouts.newnav')

    <main class="track-section">
        <div class="track-container">
            <div class="track-header">
                <h1><i class="fas fa-passport me-2"></i>Visa Application Tracker</h1>
                <p class="mb-0">Track your visa application status in real-time</p>
            </div>

            <div class="track-form">
                @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('visa.verify-email') }}" method="POST" id="trackForm">
                    @csrf
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email"
                            required>
                        <label for="email">Email address</label>
                    </div>
                    <button type="submit" class="track-btn">
                        <i class="fas fa-search me-2"></i>Track Application
                    </button>
                </form>
            </div>
        </div>

        <div class="loading-overlay">
            <div class="loader"></div>
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b1c7dc27be.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/assets/js/jquery.flurry.js') }}"></script>
    <script src="https://web.pressone.africa/pub-widget.js"></script>

    <script>
        document.getElementById('trackForm').addEventListener('submit', function (e) {
            document.querySelector('.loading-overlay').style.display = 'flex';
        });

        // Smooth appearance for alerts
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.display = 'none';
                setTimeout(() => {
                    alert.style.display = 'block';
                }, 100);
            });
        });
    </script>
</body>

</html>