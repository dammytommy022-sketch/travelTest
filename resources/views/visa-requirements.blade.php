<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelwheel - Check Visa Requirements</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Flatpickr for Date Picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 for Country Select -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            /* Light Mode Colors */
            --primary: #0d1883;
            --primary-dark: #0d1883;
            --secondary: #0d9c53;
            --bg: #f9fafb;
            --card-bg: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --error: #ef4444;
            --success: #22c55e;
            --accent: #f59e0b;

            /* Dark Mode Colors */
            --dark-bg: #1f2937;
            --dark-card-bg: #374151;
            --dark-text: #f3f4f6;
            --dark-muted: #9ca3af;
            --dark-border: #4b5563;
        }

        [data-theme="dark"] {
            --bg: var(--dark-bg);
            --card-bg: var(--dark-card-bg);
            --text: var(--dark-text);
            --muted: var(--dark-muted);
            --border: var(--dark-border);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background 0.3s, color 0.3s;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            max-width: 950px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Header Section */
.header {
    text-align: center;
    margin-bottom: 40px;
    padding: 0 20px;
    position: relative;
}

.banner-box {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    animation: fadeInUp 0.6s ease-out;
    background-color: #fff;
}

.banner-box img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.banner-box:hover img {
    transform: scale(1.02);
}

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .theme-toggle:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* Search Filters */
        .visa-search-filters {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .chip {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 8px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text);
            cursor: pointer;
            transition: background 0.3s, color 0.3s, border-color 0.3s;
        }

        .chip.selected {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .chip:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* Search Form */
        .visa-search-form {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-end;
            border: 1px solid var(--border);
            margin-bottom: 32px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .visa-search-form:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .visa-search-form .form-group {
            flex: 1 1 180px;
            min-width: 160px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .visa-search-form label {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text);
        }

        .visa-search-form .input-icon-wrap {
            display: flex;
            align-items: center;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0 12px;
            height: 44px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .visa-search-form .input-icon-wrap:hover,
        .visa-search-form .input-icon-wrap:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .visa-search-form .input-icon-wrap i {
            color: var(--muted);
            margin-right: 8px;
        }

        .visa-search-form select,
        .visa-search-form input[type="text"] {
            border: none;
            background: transparent;
            font-size: 0.95rem;
            width: 100%;
            outline: none;
            color: var(--text);
        }

        .visa-search-form select {
            padding-right: 12px;
        }

        .visa-search-form input[type="text"] {
            height: 40px;
        }

        .visa-search-form button {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            height: 44px;
        }

        .visa-search-form button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Results Section */
        .results-section {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 24px;
            margin-bottom: 32px;
            border: 1px solid var(--border);
        }

        .results-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .results-section p {
            font-size: 0.95rem;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .visa-result {
            border-bottom: 1px solid var(--border);
            padding: 16px 0;
        }

        .visa-result:last-child {
            border-bottom: none;
        }

        .visa-result h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }

        .visa-result p,
        .visa-result ul {
            font-size: 0.95rem;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .visa-result ul {
            list-style: disc;
            padding-left: 20px;
        }

        .visa-result a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .visa-result a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Features Section */
        .features-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card .icon {
            font-size: 2rem;
            margin-bottom: 12px;
            color: var(--primary);
        }

        .feature-card h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        .feature-card p {
            font-size: 0.95rem;
            color: var(--muted);
            margin: 0;
        }

        /* Popular Destinations */
        .popular-destinations {
            margin: 40px 0;
        }

        .popular-destinations h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary);
        }

        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .destination-card {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            cursor: pointer;
        }

        .destination-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border-color: var(--primary);
        }

        .destination-card img {
            width: 80px;
            height: 70px;
            object-fit: cover;
            margin-right: 12px;
        }

        .destination-card .card-body {
            padding: 12px;
            flex: 1;
        }

        .destination-card .visa-type {
            display: inline-block;
            background: var(--secondary);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            padding: 4px 8px;
            margin-bottom: 6px;
        }

        .destination-card .card-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 4px;
        }

        .destination-card .card-links a {
            color: var(--primary);
            font-size: 0.95rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .destination-card .card-links a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Form Validation */
        .visa-search-form .input-icon-wrap.error {
            border-color: var(--error);
            animation: shake 0.3s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--single {
            border: none;
            background: transparent;
            height: 40px;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--text);
            font-size: 0.95rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .select2-container--default .select2-dropdown {
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: var(--primary);
            color: #fff;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .visa-search-form {
                flex-direction: column;
            }

            .visa-search-form .form-group {
                flex: 1 1 100%;
            }

            .features-section {
                grid-template-columns: 1fr;
            }

            .destinations-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
   <div class="header">
    <div class="banner-box">
        <img src="http://travelwheel.ng/public/assets/image/Visa.jpg" alt="Visa Banner">
    </div>
</div>
    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
        <i data-feather="moon"></i>
    </button>

    <div class="container">
        <!-- Header Section -->
        

        <!-- Search Filters -->
        <div class="visa-search-filters" style="display:none;">
            <div class="chip selected" data-filter="tourism">Tourism</div>
            <div class="chip" data-filter="business">Business</div>
        </div>

        <!-- Search Form -->
        <form action="{{ route('visa.requirements.search') }}" method="POST" class="visa-search-form" id="visaSearchForm">
            @csrf
            <div class="form-group">
                <label for="from_country">Nationality</label>
                <div class="input-icon-wrap">
                    <i data-feather="user"></i>
                    <select name="from_country" id="from_country" class="form-control country-select" required>
                        <option value="">Select country</option>
                        @foreach($countries->sortBy('name') as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('from_country')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="to_country">Visa to?</label>
                <div class="input-icon-wrap">
                    <i data-feather="search"></i>
                    <select name="to_country" id="to_country" class="form-control country-select" required>
                        <option value="">Select country</option>
                        @foreach($countries->sortBy('name') as $country)
                            @if(strtolower($country->name) !== 'nigeria')
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error('to_country')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="date_range">Expected travel date</label>
                <div class="input-icon-wrap">
                    <i data-feather="calendar"></i>
                    <input type="text" name="date_range" id="date_range" class="form-control" placeholder="Select dates" required autocomplete="off">
                </div>
                @error('date_range')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit">Check Requirements</button>
            </div>
        </form>

        <!-- Results Section -->
        @if(isset($visas) && $visas->isNotEmpty())
            <div class="results-section">
                <h2>Visa Requirements for {{ $toCountry->name }}</h2>
                <p>Below are the visa requirements for citizens of {{ $fromCountry->name }} traveling to {{ $toCountry->name }}.</p>
                @foreach($visas as $visa)
                    <div class="visa-result">
                        <h3>{{ $visa->visa_type }} ({{ $visa->visa_category }})</h3>
                        <p><strong>Processing Type:</strong> {{ $visa->processing_type }}</p>
                        <p><strong>Processing Days:</strong> {{ $visa->processing_days }} days</p>
                        <p><strong>Validity:</strong> {{ $visa->validity_days }} days</p>
                        <p><strong>Fees:</strong></p>
                        <ul>
                            <li>Adult: {{ $visa->visa_fee_adult }} {{ $visa->currency }} @if($visa->pay_visa_to_embassy) (Payable to Embassy) @endif</li>
                            <li>Child: {{ $visa->visa_fee_child }} {{ $visa->currency }} @if($visa->pay_visa_to_embassy) (Payable to Embassy) @endif</li>
                            <li>Infant: {{ $visa->visa_fee_infant }} {{ $visa->currency }} @if($visa->pay_visa_to_embassy) (Payable to Embassy) @endif</li>
                            @if($visa->biometrics_fee_adult > 0)
                                <li>Biometrics (Adult): {{ $visa->biometrics_fee_adult }} {{ $visa->currency }} @if($visa->pay_bio_to_embassy) (Payable to Embassy) @endif</li>
                            @endif
                            @if($visa->biometrics_fee_child > 0)
                                <li>Biometrics (Child): {{ $visa->biometrics_fee_child }} {{ $visa->currency }} @if($visa->pay_bio_to_embassy) (Payable to Embassy) @endif</li>
                            @endif
                            @if($visa->biometrics_fee_infant > 0)
                                <li>Biometrics (Infant): {{ $visa->biometrics_fee_infant }} {{ $visa->currency }} @if($visa->pay_bio_to_embassy) (Payable to Embassy) @endif</li>
                            @endif
                            <li>Admin Fee: {{ $visa->admin_fee }} {{ $visa->currency }}</li>
                        </ul>
                        @if($visa->other_charges->isNotEmpty())
                            <p><strong>Additional Charges:</strong></p>
                            <ul>
                                @foreach($visa->other_charges as $charge)
                                    <li>{{ $charge->charge_name }} ({{ $charge->traveler_type }}): {{ $charge->amount }} {{ $visa->currency }} @if($charge->pay_to_embassy) (Payable to Embassy) @endif</li>
                                @endforeach
                            </ul>
                        @endif
                        @if($visa->visa_documents->isNotEmpty())
                            <p><strong>Required Documents:</strong></p>
                            <ul>
                                @foreach($visa->visa_documents as $document)
                                    <li>{{ $document->document_name }} ({{ $document->category }}) @if($document->description) - {{ $document->description }} @endif</li>
                                @endforeach
                            </ul>
                        @endif
                        @if($visa->visa_forms->isNotEmpty())
                            <p><strong>Required Forms:</strong></p>
                            <ul>
                                @foreach($visa->visa_forms as $form)
                                    <li>{{ $form->form_name }} ({{ $form->form_type }})</li>
                                @endforeach
                            </ul>
                        @endif
                        <p><strong>Additional Requirements:</strong></p>
                        <ul>
                            <li>Flight Reservation: {{ $visa->requires_flight ? 'Required' : 'Not Required' }}</li>
                            <li>Hotel Booking: {{ $visa->requires_hotel ? 'Required' : 'Not Required' }}</li>
                            <li>Travel Insurance: {{ $visa->requires_insurance ? 'Required' : 'Not Required' }}</li>
                        </ul>
                        @if($visa->note)
                            <p><strong>Note:</strong> {{ $visa->note }}</p>
                        @endif
                        <a href="{{ route('visa.search', ['from_country' => $fromCountry->name, 'to_country' => $toCountry->name, 'date_range' => $dateRange]) }}">Apply for this Visa</a>
                    </div>
                @endforeach
            </div>
        @elseif(isset($visas) && $visas->isEmpty())
            <div class="results-section">
                <h2>No Visa Requirements Found</h2>
                <p>No visa requirements are available for citizens of {{ $fromCountry->name }} traveling to {{ $toCountry->name }}. Please check back later or contact support.</p>
            </div>
        @endif

        <!-- Features Section -->
        <!--<div class="features-section">-->
        <!--    <div class="feature-card">-->
        <!--        <div class="icon"><i class="fa-solid fa-plane-departure"></i></div>-->
        <!--        <h4>Check Visa Requirements</h4>-->
        <!--        <p>Discover the documents and vaccinations needed for over 200 destinations.</p>-->
        <!--    </div>-->
        <!--    <div class="feature-card">-->
        <!--        <div class="icon"><i class="fa-solid fa-passport"></i></div>-->
        <!--        <h4>Visa Services</h4>-->
        <!--        <p>Understand visa requirements and apply in minutes with our streamlined process.</p>-->
        <!--    </div>-->
        <!--    <div class="feature-card">-->
        <!--        <div class="icon"><i class="fa-regular fa-clock"></i></div>-->
        <!--        <h4>Track Application</h4>-->
        <!--        <p>Stay updated on your visa application status in real-time.</p>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- Popular Destinations -->
        <div class="popular-destinations">
            <h2>Popular Destinations</h2>
            <div class="destinations-grid" id="destinationsGrid"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        feather.replace();

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            themeToggle.innerHTML = `<i data-feather="${newTheme === 'light' ? 'moon' : 'sun'}"></i>`;
            feather.replace();
        });

        // Animate Header on Load
        $(function () {
            $('.header').css({
                opacity: 0,
                transform: 'translateY(-40px)'
            }).animate({
                opacity: 1,
                transform: 'translateY(0)'
            }, 700, 'swing');
        });

        // Initialize Select2 for Country Selects
        $('.country-select').select2({
            placeholder: "Select country",
            allowClear: true,
            width: '100%',
            dropdownCssClass: 'select2-dropdown-custom'
        });

        // Initialize Flatpickr for Date Range
        flatpickr('#date_range', {
            mode: 'range',
            minDate: 'today',
            dateFormat: 'm/d/Y',
            animate: true
        });

        // Store original nationality options
        const $fromCountry = $('#from_country');
        const originalFromOptions = $fromCountry.html();

        // Load Popular Destinations
        function loadPopularDestinations() {
            $.get('/api/popular-visas', function (data) {
                const grid = $('#destinationsGrid');
                grid.empty();
                data.forEach(function (visa) {
                    const card = `
                        <div class="destination-card">
                            <img src="https://flagcdn.com/w80/${visa.country_code.toLowerCase()}.png" class="flag" alt="${visa.country_name} flag">
                            <div class="card-body">
                                <div class="visa-type">${visa.visa_type}</div>
                                <div class="card-title">${visa.country_name}</div>
                                <div class="card-links">
                                    <a href="#" class="requirements-link" data-country="${visa.country_name}">View Requirements</a>
                                </div>
                            </div>
                        </div>`;
                    grid.append(card);
                });
            }).fail(function () {
                console.error('Failed to load popular destinations');
                // Fallback static data
                const fallbackDestinations = [
                    { country_name: 'United States', country_code: 'US', visa_type: 'Tourist' },
                    { country_name: 'United Kingdom', country_code: 'GB', visa_type: 'Tourist' },
                    { country_name: 'Canada', country_code: 'CA', visa_type: 'Tourist' },
                    { country_name: 'Australia', country_code: 'AU', visa_type: 'Tourist' },
                    { country_name: 'France', country_code: 'FR', visa_type: 'Tourist' }
                ];
                const grid = $('#destinationsGrid');
                grid.empty();
                fallbackDestinations.forEach(function (visa) {
                    const card = `
                        <div class="destination-card">
                            <img src="https://flagcdn.com/w80/${visa.country_code.toLowerCase()}.png" class="flag" alt="${visa.country_name} flag">
                            <div class="card-body">
                                <div class="visa-type">${visa.visa_type}</div>
                                <div class="card-title">${visa.country_name}</div>
                                <div class="card-links">
                                    <a href="#" class="requirements-link" data-country="${visa.country_name}">View Requirements</a>
                                </div>
                            </div>
                        </div>`;
                    grid.append(card);
                });
            });
        }
        loadPopularDestinations();

        // Filter Chips Interaction
        $(document).ready(function () {
            $('.chip').on('click', function () {
                $('.chip').removeClass('selected');
                $(this).addClass('selected');
                const filter = $(this).data('filter');
                const $fromCountry = $('#from_country');
                const $toCountry = $('#to_country');
                if (filter === 'tourism') {
                    $fromCountry.html(originalFromOptions);
                    $fromCountry.val('Nigeria').trigger('change');
                    $fromCountry.prop('disabled', true);
                    $fromCountry.closest('.input-icon-wrap').css('background', '#f3f4f6');
                    $toCountry.html(originalFromOptions).find('option[value="Nigeria"]').remove();
                    $toCountry.val('').trigger('change');
                    $toCountry.prop('disabled', false);
                    $toCountry.closest('.input-icon-wrap').css('background', 'var(--card-bg)');
                } else if (filter === 'business') {
                    $fromCountry.html(originalFromOptions).find('option[value="Nigeria"]').remove();
                    $fromCountry.val('').trigger('change');
                    $fromCountry.prop('disabled', false);
                    $fromCountry.closest('.input-icon-wrap').css('background', 'var(--card-bg)');
                    if ($toCountry.find('option[value="Nigeria"]').length === 0) {
                        $toCountry.prepend('<option value="Nigeria">Nigeria</option>');
                    }
                    $toCountry.val('Nigeria').trigger('change');
                    $toCountry.prop('disabled', true);
                    $toCountry.closest('.input-icon-wrap').css('background', '#f3f4f6');
                }
            });
            $('.chip[data-filter="tourism"]').trigger('click');
        });

        // Form Validation and Submission
        $('#visaSearchForm').on('submit', function (e) {
            const form = this;
            $('#from_country').prop('disabled', false);
            $('#to_country').prop('disabled', false);
            if (!form.checkValidity()) {
                e.preventDefault();
                $(form).find(':invalid').each(function () {
                    const inputWrap = $(this).closest('.input-icon-wrap');
                    inputWrap.addClass('error');
                    setTimeout(() => inputWrap.removeClass('error'), 1000);
                });
            }
        });

        // Handle Requirements link click
        $(document).on('click', '.requirements-link', function (e) {
            e.preventDefault();
            const toCountry = $(this).data('country');
            const fromCountry = 'Nigeria';
            const today = new Date();
            const nextWeek = new Date();
            nextWeek.setDate(today.getDate() + 7);

            function formatDate(date) {
                const mm = String(date.getMonth() + 1).padStart(2, '0');
                const dd = String(date.getDate()).padStart(2, '0');
                const yyyy = date.getFullYear();
                return mm + '/' + dd + '/' + yyyy;
            }

            const dateRange = formatDate(today) + ' to ' + formatDate(nextWeek);
            const form = $('<form>', {
                method: 'POST',
                action: "{{ route('visa.requirements.search') }}"
            });
            form.append($('<input>', { type: 'hidden', name: '_token', value: $('meta[name="csrf-token"]').attr('content') }));
            form.append($('<input>', { type: 'hidden', name: 'from_country', value: fromCountry }));
            form.append($('<input>', { type: 'hidden', name: 'to_country', value: toCountry }));
            form.append($('<input>', { type: 'hidden', name: 'date_range', value: dateRange }));
            $('body').append(form);
            form.submit();
        });
    </script>
</body>
</html>