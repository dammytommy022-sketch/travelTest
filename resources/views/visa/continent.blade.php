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
        }

        .continent-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 80px 0;
        }

        .search-container {
            margin: 0 auto 40px;
        }

        .search-box {
            background: white;
            padding: 15px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .search-box input {
            border: none;
            flex: 1;
            padding: 10px 20px;
            font-size: 1.1rem;
            outline: none;
        }

        .continent-card {
            background: white;
            border-radius: 20px;
            height: 280px;
            position: relative;
            overflow: hidden;
            perspective: 1000px;
            transform-style: preserve-3d;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .continent-card:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 20px 40px rgba(13, 24, 131, 0.2);
        }

        .card-content {
            padding: 30px;
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .continent-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: transform 0.3s ease;
        }

        .continent-card:hover .continent-icon {
            transform: scale(1.2);
        }

        .continent-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .country-count {
            color: var(--secondary);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .continent-stats {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .stat-item {
            background: rgba(13, 24, 131, 0.05);
            padding: 8px 15px;
            border-radius: 12px;
            font-size: 0.85rem;
            color: var(--primary);
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

        .animate-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .track-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 24, 131, 0.2);
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .track-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 24, 131, 0.3);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
        }

        .track-btn i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .continent-card {
                height: 220px;
            }

            .continent-icon {
                font-size: 2.5rem;
            }

            .continent-name {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
    @include('layouts.newnav')

    <main class="continent-section">
        <div class="container-fluid">
            <img src="{{ asset('public/assets/image/Visa.jpg') }}" class="image-fluid w-100" alt="">
        </div>
        <div class="container">
            <div class="text-end mb-4 mt-4">
                <a href="{{ route('visa.track') }}" class="track-btn">
                    <i class="fas fa-search-location" style="color:white;"></i>Track Your Visa
                </a>
            </div>
            <div class="row g-4" id="continentGrid">
                @foreach ($continents as $index => $continent)
                    <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: {{ $index * 0.1 }}s">
                        <a href="{{ route('country.selection', ['continent' => $continent['slug']]) }}"
                            class="text-decoration-none">
                            <div class="continent-card">
                                <div class="card-content">
                                    <div>
                                        <i class="fas {{ $continent['icon'] }} continent-icon"></i>
                                        <h3 class="continent-name">{{ $continent['name'] }}</h3>
                                        <p class="country-count">{{ $continent['countries'] }} countries</p>
                                    </div>
                                    <div class="continent-stats">
                                        <span class="stat-item">
                                            <i class="fas fa-passport me-2"></i>{{ $continent['visa'] }} Visa
                                        </span>
                                        <span class="stat-item">
                                            <i class="fas fa-plane me-2"></i>Popular
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b1c7dc27be.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/assets/js/jquery.flurry.js') }}"></script>
    <script src="https://web.pressone.africa/pub-widget.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('continentSearch');
            const cards = document.querySelectorAll('.animate-card');

            // Search functionality
            searchInput.addEventListener('input', function (e) {
                const searchText = e.target.value.toLowerCase();
                cards.forEach(card => {
                    const continentName = card.querySelector('.continent-name').textContent.toLowerCase();
                    if (continentName.includes(searchText)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>