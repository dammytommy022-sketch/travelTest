<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Country - TravelWheel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <style>
    :root {
        --primary: #0d1883;
        --secondary: #0d9c53;
        --background: #f5f8fa;
        --card-bg: #ffffff;
        --card-hover: rgba(13, 24, 131, 0.1);
        --text-main: #1f2d3d;
        --text-subtle: #6c757d;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: var(--background);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-main);
    }

    .country-section {
        padding: 80px 0;
        background: linear-gradient(to right, #eef2f3, #f9fbfd);
        min-height: 100vh;
    }

    .continent-title {
        font-size: 2.8rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 40px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .search-container {
        max-width: 600px;
        margin: 0 auto 50px;
        padding: 0 15px;
    }

    .search-box {
        display: flex;
        background-color: white;
        border-radius: 50px;
        padding: 12px 20px;
        box-shadow: var(--shadow-sm);
        transition: box-shadow 0.3s ease;
    }

    .search-box:focus-within {
        box-shadow: var(--shadow-md);
    }

    .search-box input {
        border: none;
        flex: 1;
        font-size: 1rem;
        outline: none;
        background: transparent;
    }

    .country-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 25px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        position: relative;
    }

    .country-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
    }

    .country-icon {
        width: 3rem;
        height: 2rem;
        background-size: cover;
        background-position: center;
        margin-bottom: 10px;
        border-radius: 4px;
        transition: transform 0.3s ease;
    }

    .country-card:hover .country-icon {
        transform: scale(1.15);
    }

    .country-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .visa-count {
        font-size: 0.95rem;
        color: var(--secondary);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 0.75rem;
    }

    .country-stats {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: auto;
        margin-bottom: 1rem;
    }

    .stat-item {
        background-color: #eef2f6;
        border-left: 4px solid var(--primary);
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 0.85rem;
        color: var(--text-main);
        font-weight: 500;
    }

    .btn {
        background-color: var(--primary);
        color: #fff;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        transition: background 0.3s ease;
    }

    .btn:hover {
        background-color: var(--secondary);
        color: #fff;
    }

    @media (max-width: 768px) {
        .continent-title {
            font-size: 2rem;
        }
        .country-name {
            font-size: 1.3rem;
        }
        .search-box input {
            font-size: 0.95rem;
        }
        .country-card {
            padding: 20px;
        }
    }
</style>

</head>
<body>
    @include('layouts.newnav')
    <main class="country-section">
        <div class="container-fluid">
            <img src="{{ asset('public/assets/image/Visa.jpg') }}" class="image-fluid w-100" alt="Visa Banner">
        </div>
        <div class="container">
            <h2 class="continent-title">{{ ucfirst($continent) }} Visa Options</h2>
            <div class="row g-4" id="countryGrid">
                @foreach ($countriesWithVisaCosts as $country)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="country-card shadow-sm">
                            <div class="card-content">
                                <span class="country-icon fi fi-{{ strtolower($country['name'] == 'Nigeria' ? 'ng' : str_replace(' ', '-', $country['name'])) }} fi-3x"></span>
                                <h5 class="country-name">{{ $country['name'] }}</h5>
                                <div class="visa-count">
                                    <i class="fas fa-passport"></i>
                                    {{ $country['visa_type_count'] }} Visa Type{{ $country['visa_type_count'] > 1 ? 's' : '' }}
                                </div>
                                <div class="country-stats">
                                    @if ($country['visa_types']->isEmpty())
                                        <span class="stat-item">No visa types available</span>
                                    @else
                                        @foreach ($country['visa_types'] as $visaType)
                                            <div class="stat-item">
                                                <strong>{{ $visaType['visa_type_name'] }}</strong><br>
                                                @if (isset($country['is_voa']) && $country['is_voa'])
                                                    Adult: ₦{{ $visaType['total_adult'] }}<br>
                                                    Minor (Nigerian Parent): ₦{{ $visaType['total_child'] }}<br>
                                                    Minor (Foreign Parent): ₦{{ $visaType['total_infant'] }}
                                                @else
                                                    Adult: ₦{{ $visaType['total_adult'] }}<br>
                                                    Child: ₦{{ $visaType['total_child'] }}<br>
                                                    Infant: ₦{{ $visaType['total_infant'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <a href="{{ isset($country['is_voa']) && $country['is_voa'] ? route('voa_form') : route('showVisaForm', ['continent' => $continent, 'country' => $country['name']]) }}"
                                   class="btn btn-primary mt-auto">Apply Now</a>
                            </div>
                        </div>
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
            const searchInput = document.getElementById('countrySearch');
            const cards = document.querySelectorAll('.country-card');

            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const searchText = e.target.value.toLowerCase();
                    cards.forEach(card => {
                        const countryName = card.querySelector('.country-name').textContent.toLowerCase();
                        const shouldShow = countryName.includes(searchText);
                        card.style.opacity = shouldShow ? '1' : '0';
                        card.style.transform = shouldShow ? 'scale(1)' : 'scale(0.8)';
                        setTimeout(() => {
                            card.style.display = shouldShow ? 'block' : 'none';
                        }, shouldShow ? 0 : 300);
                    });
                });
            }
        });
    </script>
</body>
</html>