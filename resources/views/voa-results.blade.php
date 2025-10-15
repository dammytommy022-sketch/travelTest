<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelwheel - Nigerian Business Visa Results</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Flatpickr for Date Picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
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
            overflow-x: hidden;
        }

        .container {
            max-width: 900px;
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

        /* Summary Section */
        .summary {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .summary:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .summary-content {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .summary .flag {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            margin-right: 8px;
        }

        .summary .actions a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background 0.3s, color 0.3s;
        }

        .summary .actions a:hover {
            background: var(--primary);
            color: #fff;
        }

        .summary-edit-form {
            display: none;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            animation: slideIn 0.3s ease-out;
        }

        .summary-edit-form.active {
            display: flex;
        }

        /* Section Styles */
        .section {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 28px;
            margin-bottom: 32px;
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .section:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--primary);
        }

        /* Visa Options */
        .visa-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .visa-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .visa-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .visa-card::before {
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

        .visa-card:hover::before {
            transform: scaleX(1);
        }

        .visa-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .visa-card .actions button {
            font-size: 0.95rem;
            padding: 8px 16px;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            border: none;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .visa-card .actions button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background: var(--card-bg);
            color: var(--text);
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 10;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: var(--shadow);
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) translateY(-5px);
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 0;
            animation: zoomIn 0.4s ease-out;
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            padding: 8px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .modal-close:hover {
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 28px;
        }

        /* Stepper */
        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
            position: relative;
        }

        .step {
            flex: 1;
            text-align: center;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--muted);
            position: relative;
            padding: 12px 0;
            transition: color 0.3s;
        }

        .step.active {
            color: var(--primary);
        }

        .step::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -50%;
            width: 100%;
            height: 4px;
            background: var(--border);
            z-index: -1;
        }

        .step.active::before,
        .step.completed::before {
            background: var(--primary);
            transition: background 0.3s;
        }

        .step:first-child::before {
            display: none;
        }

        /* Wizard Steps */
        .wizard-step {
            display: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .wizard-step.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 0.95rem;
            background: var(--card-bg);
            color: var(--text);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .form-control:invalid[required]:not(:placeholder-shown),
        .form-control.error {
            border-color: var(--error);
            animation: shake 0.3s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .btn {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn.secondary {
            background: var(--border);
            color: var(--primary);
        }

        .btn.secondary:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn:disabled {
            background: var(--muted);
            cursor: not-allowed;
        }

        /* Step 1 Layout */
  .step1-flex {
    display: grid;
    grid-template-columns: 2fr 1fr; /* Maintain the 2:1 ratio */
    gap: 24px; /* Increase gap for better spacing */
    align-items: stretch; /* Ensure both sections stretch to the same height */
}

/* Style for step1-left and step1-right */
.step1-left, .step1-right {
    padding: 20px;
    background: var(--card-bg);
    border-radius: 12px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
}

/* Ensure price and buttons are well-spaced in step1-right */
.step1-right .price {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary);
    margin: 16px 0;
}

.step1-right .form-group {
    margin-bottom: 20px;
}

.step1-right .btn {
    width: 100%;
    margin-top: 10px;
}

        .price {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin: 8px 0;
            animation: fadeIn 0.3s;
        }

        /* Requirements List */
        .requirements-list {
            padding-left: 20px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .requirements-list li {
            margin-bottom: 8px;
            position: relative;
            padding-left: 12px;
        }

        .requirements-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: var(--primary);
        }

        /* Alert */
        .alert {
            background: var(--bg);
            border-radius: 12px;
            padding: 16px;
            color: var(--muted);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid var(--border);
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Sub-Step Navigation */
        .sub-step-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 20px 0;
        }

        .sub-step-dot {
            width: 10px;
            height: 10px;
            background: var(--border);
            border-radius: 50%;
            transition: background 0.3s;
        }

        .sub-step-dot.active {
            background: var(--primary);
        }

        /* File Input Styles */
        .file-input-container {
            position: relative;
        }

        .file-input-container input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: inline-block;
            padding: 12px 16px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            color: var(--text);
            cursor: pointer;
            transition: border-color 0.3s, background 0.3s;
            width: 100%;
            text-align: left;
        }

        .file-input-label:hover {
            border-color: var(--primary);
            background: var(--bg);
        }

        .file-input-label.error {
            border-color: var(--error);
            animation: shake 0.3s;
        }

        .file-selected {
            font-size: 0.9rem;
            color: var(--muted);
            margin-top: 8px;
            word-break: break-all;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .step1-flex {
                grid-template-columns: 1fr;
            }

            .step1-right {
                max-width: 100%;
            }

            .visa-options {
                grid-template-columns: 1fr;
            }

            .summary-edit-form {
                flex-direction: column;
                align-items: flex-start;
            }
        }
        
        .loader-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1001;
    backdrop-filter: blur(2px);
}

.loader {
    width: 60px;
    height: 60px;
    border: 6px solid var(--primary);
    border-top: 6px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    position: relative;
}

.loader::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    background: var(--secondary);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 1.5s ease-in-out infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.8; }
    50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.4; }
    100% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.8; }
}
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--border);
    transition: 0.3s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: var(--card-bg);
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

input:checked + .slider {
    background-color: var(--primary);
}

input:checked + .slider:before {
    transform: translateX(26px);
}
.date-warning {
    color: var(--error);
    font-size: 0.9rem;
    margin-top: 4px;
    display: block;
    animation: fadeIn 0.3s ease-in;
}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="header">
    <div class="banner-box">
        <img src="https://travelwheel.ng/public/assets/image/voa.jpg" alt="Visa Banner">
    </div>
</div>
    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
        <i data-feather="moon"></i>
    </button>

    <div class="container">


        <!-- Summary Section -->
        <div class="summary">
            <div class="summary-content" id="summaryView">
                <svg xmlns="http://www.w3.org/2000/svg" 
     width="1.2rem" height="2rem" 
     viewBox="0 0 24 24" fill="none" 
     stroke="var(--primary)" stroke-width="2" 
     stroke-linecap="round" stroke-linejoin="round" 
     class="lucide lucide-plane-takeoff-icon" 
     style="vertical-align: middle;">
  <path d="M2 22h20"/>
  <path d="M6.36 17.4 4 17l-2-4 1.1-.55a2 2 0 0 1 1.8 0l.17.1a2 2 0 0 0 1.8 0L8 12 5 6l.9-.45a2 2 0 0 1 2.09.2l4.02 3a2 2 0 0 0 2.1.2l4.19-2.06a2.41 2.41 0 0 1 1.73-.17L21 7a1.4 1.4 0 0 1 .87 1.99l-.38.76c-.23.46-.6.84-1.07 1.08L7.58 17.2a2 2 0 0 1-1.22.18Z"/>
</svg>
                <span style="font-weight:600;" id="fromCountryName">
                    <img src="https://flagcdn.com/w20/{{ strtolower($fromCountry->code) }}.png" class="flag" alt="{{ $fromCountry->name }} flag">
                    {{ $fromCountry->name }}
                </span>
                <span style="color:var(--muted);">→</span>
                <span style="font-weight:600;" id="toCountryName">
                    <img src="https://flagcdn.com/w20/{{ strtolower($toCountry->code) }}.png" class="flag" alt="{{ $toCountry->name }} flag">
                    {{ $toCountry->name }}
                </span>
                <span style="color:var(--muted); font-size:0.95rem;" id="dateRangeText">({{ $dateRange }})</span>
            </div>
            <form id="searchForm" class="summary-edit-form" method="POST" action="{{ route('voa.search') }}">
                @csrf
               <select name="from_country" id="fromCountry" class="form-control" required>
    @foreach($countries->sortBy('name') as $country)
        @if(strtolower($country->name) !== 'nigeria')
            <option value="{{ $country->name }}" {{ $fromCountry->name === $country->name ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endif
    @endforeach
</select>

                <span style="color:var(--muted);">→</span>
                <select name="to_country" id="toCountry" class="form-control" required>
                   <option value="Nigeria" readonly>Nigeria</option>
                </select>
                <input type="text" name="date_range" id="dateRange" class="form-control" value="{{ $dateRange }}" required />
                <button type="submit" class="btn">Update</button>
                <button type="button" class="btn secondary" id="cancelEditSummary">Cancel</button>
            </form>
            <div class="actions">
                <a href="#" id="editSummaryBtn">Edit</a>
            </div>
        </div>
        @if($message)
    <div class="alert" style="background:var(--card-bg);color:var(--text);margin-bottom:20px;">
        <i data-feather="alert-circle"></i>
        {{ $message }}
    </div>
@endif
 @if($voa)
        <!-- Nigerian Business Visa Requirements -->
        <div class="section">
            <h2>Nigerian Business Visa Requirements</h2>
            @if( $voa->visa_fee == 0)
                            <div style="color:var(--muted);margin-bottom:20px;">
                You dont need a visa for <b>{{ $toCountry->name }}</b> if you have a <b>{{ $fromCountry->name }}</b>
                passport.
            </div>
                            @endif
            <div class="visa-options">
   
        <div class="visa-card">
    <h3>Nigerian Business Visa</h3>
    <div style="color:var(--muted);font-size:0.95rem;">
        <p>Visa Fee: {{ $voa->visa_fee ?? 0 }} USD</p>
        <p>Biometrics Fee: {{ $voa->country->is_african_country ? ($voaFees['biometrics']['amount_african'] ?? 0) : ($voaFees['biometrics']['amount_non_african'] ?? 0) }} USD</p>
        <p>Travelwheel Service Fee: {{ $voa->country->is_african_country ? ($voaFees['service']['amount_african'] ?? 0) : ($voaFees['service']['amount_non_african'] ?? 0) }} USD</p>
        <p>Payment Gateway Fee: {{ $voa->country->is_african_country ? ($voaFees['payment']['amount_african'] ?? 0) : ($voaFees['payment']['amount_non_african'] ?? 0) }} USD</p>
        <p>FG Processing Fee (Adult): {{ $voaFees['processing_adult']['amount_african'] ?? 0 }} USD</p>
        <p>FG Processing Fee (Minor, Foreign Parent): {{ $voaFees['processing_fp']['amount_african'] ?? 0 }} USD</p>
        <p>FG Processing Fee (Minor, Nigerian Parent): {{ $voaFees['processing_np']['amount_african'] ?? 0 }} USD</p>
    </div>
    <div class="actions">
        <button class="start-voa-application" data-voa-id="{{ $voa->id }}">Start Application</button>
    </div>
</div>
    @else
        <div class="alert" style="background:var(--card-bg);color:var(--text);">
            <i data-feather="alert-circle"></i>
            <div>
                <p>No Nigerian Business Visa is available for citizens of <b>{{ $fromCountry->name }}</b> at this time.</p>
                <p style="margin-top:8px;">Please explore other visa options or contact our support team for assistance.</p>
                <div style="margin-top:16px;">
                    <a href="/visa" class="btn secondary" style="margin-right:12px;">Explore Other Visas</a>
                    <a href="/contact" class="btn" style="background:var(--accent);">Contact Support</a>
                </div>
            </div>
        </div>
    @endif
</div>
        </div>

        <!-- Passport & Documents -->
        <div class="section">
            <h2>Passport & Documents</h2>
            <ul class="requirements-list">
                <li>Valid passport with at least 6 months validity (Data Page)</li>
                <li>Invitation/Application Letter on Letterhead</li>
                <li>Certificate of Incorporation (CAC)</li>
                <li>Flight Itinerary (or let Travelwheel handle it)</li>
                <li>Passport Photo</li>
            </ul>
        </div>

        <!-- Health Requirements -->
        <div class="section">
            <h2>Health Risks & Requirements</h2>
            <ul class="requirements-list">
                <li>Yellow Fever vaccination certificate (required for entry into Nigeria)</li>
                <li>Health insurance (recommended)</li>
            </ul>
        </div>

        <div class="alert">
            <i data-feather="info"></i>
            Information is provided as guidance only and accurate at the time of publishing. Always check government websites and airline materials before booking and traveling.
        </div>

        <div class="report-link" style="text-align:right;">
            <a href="#" style="color:var(--accent);text-decoration:none;font-size:0.95rem;">See an error? Report inaccuracy</a>
        </div>
    </div>

    <!-- VOA Application Modal -->
    <div class="modal" id="voaApplicationModal">
        <div class="modal-content">
            <div class="loader-overlay" id="modalLoader" style="display: none;">
            <div class="loader"></div>
        </div>
            <div class="modal-header">
                <h2>Nigerian Business Visa Application</h2>
                <button class="modal-close" id="closeModal" aria-label="Close modal"><i data-feather="x"></i></button>
            </div>
            <div class="modal-body">
                <div class="stepper">
                    <div class="step active" id="stepper1">Details</div>
                    <div class="step" id="stepper2">Client Details</div>
                    <div class="step" id="stepper3">Payment</div>
                    <div class="step" id="stepper4">Done</div>
                </div>
                <div class="wizard-step active" id="voaStep1">
                    <h3 style="margin-bottom:20px;">Nigerian Business Visa Details</h3>
                    <div class="step1-flex">
                        <div class="step1-left">
                            <div id="voaDetails" style="color:var(--muted);font-size:0.95rem;"></div>
                            <div class="form-group">
                                <label class="form-label">
                                    <input type="checkbox" id="travelwheelFlight" onchange="toggleFlightItinerary()"> Let Travelwheel handle flight itinerary
                                </label>
                            </div>
                        </div>
                       <div class="step1-right">
    <div class="currency-toggle" style="margin-bottom:16px;display:flex;align-items:center;gap:8px;">
        <span style="font-size:0.95rem;color:var(--muted);">Display in:</span>
        <label class="switch">
            <input type="checkbox" id="currencySwitch" onchange="toggleCurrency()">
            <span class="slider"></span>
        </label>
        <span id="currencyLabel" style="font-size:0.95rem;color:var(--primary);">NGN</span>
    </div>
    <div class="form-group">
        <label class="form-label passenger-type">
            <i data-feather="user"></i> Number of Adult Passengers
        </label>
        <input type="number" class="form-control" id="voaAdultCount" min="0" value="1" onchange="updateVoaPrice()">
    </div>
    <div class="form-group">
        <label class="form-label passenger-type">
            <i data-feather="user-minus"></i> Number of Minors (Foreign Parent)
        </label>
        <input type="number" class="form-control" id="voaMinorFPCount" min="0" value="0" onchange="updateVoaPrice()">
    </div>
    <div class="form-group">
        <label class="form-label passenger-type">
            <i data-feather="user-check"></i> Number of Minors (Nigerian Parent)
        </label>
        <input type="number" class="form-control" id="voaMinorNPCount" min="0" value="0" onchange="updateVoaPrice()">
    </div>
    <div class="price" id="voaTotalPrice">0 USD</div>
    <div id="voaPriceBreakdown" style="font-size:0.95rem;color:var(--muted);margin-bottom:20px;"></div>
    <button class="btn" id="startApplicationBtn" style="width:100%;">Start Application</button>
</div>
                    </div>
                </div>
                <div class="wizard-step" id="voaStep2">
                    <h3 style="margin-bottom:20px;">Client Info</h3>
                    <div id="passengerProgress" style="margin-bottom:16px;color:var(--muted);font-size:0.95rem;"></div>
                    <div class="sub-step-nav" id="subStepNav"></div>
                    <form id="voaKycForm" autocomplete="off" enctype="multipart/form-data">
                        <div id="passenger-sections"></div>
                        <div style="margin-top:24px;display:flex;gap:12px;">
                            <button class="btn" type="button" id="nextSubStep">Next</button>
                            <button class="btn secondary" type="button" id="prevSubStep" style="display:none;">Back</button>
                            <button class="btn secondary" type="button" id="copyPrevious" style="display:none;">Copy Previous</button>
                            <!--<button class="btn secondary" type="button" id="skipPassenger" style="display:none;">Skip Passenger</button>-->
                        </div>
                    </form>
                </div>
                <div class="wizard-step" id="voaStep3">
                    <h3 style="margin-bottom:20px;">Payment</h3>
                    <div class="price" id="voaPaymentTotal">0 USD</div>
                    <button class="btn" type="button" id="payWithSeerbit">Pay with Seerbit</button>
                    <div id="paymentStatus" style="color:var(--muted);margin:20px 0;"></div>
                    <button class="btn secondary" type="button" id="backToKYC">Back</button>
                </div>
                <div class="wizard-step" id="voaStep4">
                    <h3 style="margin-bottom:20px;">Confirmation</h3>
                    <div style="color:var(--success);font-size:0.95rem;margin-bottom:12px;">Payment successful!</div>
                    <div style="color:var(--muted);font-size:0.95rem;">Check your email for details.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="confirmCancelModal">
    <div class="modal-content" style="max-width:400px;">
        <div class="modal-header">
            <h2>Confirm Cancellation</h2>
            <button class="modal-close" id="closeConfirmModal" aria-label="Close modal"><i data-feather="x"></i></button>
        </div>
        <div class="modal-body">
            <p style="color:var(--muted);font-size:0.95rem;margin-bottom:20px;">Are you sure you want to discard this visa application? All entered data will be lost.</p>
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn secondary" id="cancelConfirm">Cancel</button>
                <button class="btn" id="confirmDiscard" style="background:var(--error);">Discard</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        feather.replace();

let currentVoaStep = 1;
let voaData = {};
let exchangeRate = {{ $exchange_rate ?? 1500 }};
let flightFee = {{ $flight ?? 30 }};
let passengers = [];
let voaPassengerCount = 1;
let voaAdultCount = 1;
let voaMinorFPCount = 0;
let voaMinorNPCount = 0;
let currentPassengerIndex = 0;
let currentSubStep = 1;
let subSteps = [];
let travelwheelHandlesFlight = false;
let countriesCache = null;

async function fetchCountries() {
    if (countriesCache) return countriesCache;
    try {
        const response = await fetch('https://restcountries.com/v3.1/all?fields=name');
        const data = await response.json();

        // Extract and sort country names
        countriesCache = data
            .map(c => ({ value: c.name.common, label: c.name.common }))
            .sort((a, b) => a.label.localeCompare(b.label));

        return countriesCache;
    } catch (error) {
        console.error('Error fetching countries:', error);
        alert('Failed to load countries. Please try again later.');
        return [];
    }
}



function getDateRangeFromURL() {
    const params = new URLSearchParams(window.location.search);
    const dateRange = params.get('date_range');
    if (dateRange) {
        const decoded = decodeURIComponent(dateRange);
        const [start, end] = decoded.split(' to ').map(date => date.trim());
        if (start && end && isValidDate(start) && isValidDate(end)) {
            return { startDate: start, endDate: end };
        }
    }
    const today = new Date();
    const nextWeek = new Date(today);
    nextWeek.setDate(today.getDate() + 7);
    const formatDate = (date) => `${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getDate().toString().padStart(2, '0')}/${date.getFullYear()}`;
    return {
        startDate: formatDate(today),
        endDate: formatDate(nextWeek)
    };
}

function isValidDate(dateStr) {
    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) {
        return false;
    }
    const [month, day, year] = dateStr.split('/').map(Number);
    const date = new Date(year, month - 1, day);
    return !isNaN(date.getTime()) && date.getFullYear() === year && date.getMonth() + 1 === month && date.getDate() === day;
}

    function isValidDate(dateStr) {
    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) {
        return false;
    }
    const [month, day, year] = dateStr.split('/').map(Number);
    const date = new Date(year, month - 1, day);
    return !isNaN(date.getTime()) && date.getFullYear() === year && date.getMonth() + 1 === month && date.getDate() === day;
}
// Theme Toggle
const themeToggle = document.getElementById('themeToggle');
themeToggle.addEventListener('click', () => {
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', newTheme);
    themeToggle.innerHTML = `<i data-feather="${newTheme === 'light' ? 'moon' : 'sun'}"></i>`;
    feather.replace();
});

// Modal Logic
const modal = document.getElementById('voaApplicationModal');
const closeModalBtn = document.getElementById('closeModal');
const confirmModal = document.getElementById('confirmCancelModal');
const closeConfirmModalBtn = document.getElementById('closeConfirmModal');
const cancelConfirmBtn = document.getElementById('cancelConfirm');
const confirmDiscardBtn = document.getElementById('confirmDiscard');

closeModalBtn.addEventListener('click', () => {
    confirmModal.classList.add('active');
});
closeConfirmModalBtn.addEventListener('click', () => confirmModal.classList.remove('active'));
cancelConfirmBtn.addEventListener('click', () => confirmModal.classList.remove('active'));
confirmDiscardBtn.addEventListener('click', () => {
    confirmModal.classList.remove('active');
    modal.classList.remove('active');
    passengers = [];
    currentPassengerIndex = 0;
    currentSubStep = 1;
    currentVoaStep = 1;
    updateStepper();
    document.getElementById('voaPassengerCount').value = 1;
    updateVoaPrice();
});
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        confirmModal.classList.add('active');
    }
    if (e.target === confirmModal) {
        confirmModal.classList.remove('active');
    }
});

// Stepper Logic
function updateStepper() {
    for (let i = 1; i <= 4; i++) {
        const step = document.getElementById(`stepper${i}`);
        step.classList.remove('active', 'completed');
        if (i < currentVoaStep) step.classList.add('completed');
        if (i === currentVoaStep) step.classList.add('active');
    }
}

function nextVoaStep(step) {
    voaAdultCount = parseInt(document.getElementById('voaAdultCount').value) || 0;
    voaMinorFPCount = parseInt(document.getElementById('voaMinorFPCount').value) || 0;
    voaMinorNPCount = parseInt(document.getElementById('voaMinorNPCount').value) || 0;
    voaPassengerCount = voaAdultCount + voaMinorFPCount + voaMinorNPCount;

    if (step === 2 && voaPassengerCount === 0) {
        alert('Please select at least one passenger.');
        return;
    }
    if (step === 3 && !validateForm()) {
        alert('Please complete all required fields and upload required documents for all passengers.');
        return;
    }
    document.getElementById(`voaStep${currentVoaStep}`).classList.remove('active');
    currentVoaStep = step;
    document.getElementById(`voaStep${currentVoaStep}`).classList.add('active');
    updateStepper();
    if (step === 2) initializeKycForm();
    if (step === 3) initializeVoaPayment();
}

function prevVoaStep(step) {
    document.getElementById(`voaStep${currentVoaStep}`).classList.remove('active');
    currentVoaStep = step;
    document.getElementById(`voaStep${currentVoaStep}`).classList.add('active');
    updateStepper();
    if (step === 2) initializeKycForm();
}

// Flight Itinerary Toggle
function toggleFlightItinerary() {
    travelwheelHandlesFlight = document.getElementById('travelwheelFlight').checked;
    updateVoaPrice();
    if (currentVoaStep === 2) renderPassengerForm();
}



// VOA Application Logic
document.querySelectorAll('.start-voa-application').forEach(button => {
    button.addEventListener('click', function () {
        const voaId = this.getAttribute('data-voa-id');
        const loader = document.getElementById('modalLoader');
        loader.style.display = 'flex';

        voaData = {
            id: voaId,
            visa_fee: {{ $voa->visa_fee ?? 0 }},
            is_african_country: {{ json_encode($voa?->country?->is_african_country) }},
            voa_fees: {
                biometrics_african: {{ $voaFees['biometrics']['amount_african'] ?? 0 }},
                biometrics_non_african: {{ $voaFees['biometrics']['amount_non_african'] ?? 0 }},
                service_african: {{ $voaFees['service']['amount_african'] ?? 0 }},
                service_non_african: {{ $voaFees['service']['amount_non_african'] ?? 0 }},
                payment_african: {{ $voaFees['payment']['amount_african'] ?? 0 }},
                payment_non_african: {{ $voaFees['payment']['amount_non_african'] ?? 0 }},
                processing_adult: {{ $voaFees['processing_adult']['amount_african'] ?? 0 }},
                processing_fp: {{ $voaFees['processing_fp']['amount_african'] ?? 0 }},
                processing_np: {{ $voaFees['processing_np']['amount_african'] ?? 0 }}
            }
        };
        updateVoaDetails();
        modal.classList.add('active');
        currentVoaStep = 1;
        for (let i = 1; i <= 4; i++) {
            document.getElementById(`voaStep${i}`).classList.remove('active');
        }
        document.getElementById('voaStep1').classList.add('active');
        updateStepper();
        travelwheelHandlesFlight = false;
        document.getElementById('travelwheelFlight').checked = false;

        setTimeout(() => {
            loader.style.display = 'none';
        }, 500);
    });
});

// Update updateVoaDetails to show conditional minor fees
function updateVoaDetails() {
    const details = document.getElementById('voaDetails');
    let html = `
        <div style="margin-bottom:10px;">Visa Fee: ${voaData.visa_fee} USD</div>
        <div style="margin-bottom:10px;">Biometrics Fee: ${voaData.is_african_country ? voaData.voa_fees.biometrics_african : voaData.voa_fees.biometrics_non_african} USD</div>
        <div style="margin-bottom:10px;">Travelwheel Service Fee: ${voaData.is_african_country ? voaData.voa_fees.service_african : voaData.voa_fees.service_non_african} USD</div>
        <div style="margin-bottom:10px;">Payment Gateway Fee: ${voaData.is_african_country ? voaData.voa_fees.payment_african : voaData.voa_fees.payment_non_african} USD</div>
        <div style="margin-bottom:10px;">FG Processing Fee (Adult): ${voaData.voa_fees.processing_adult} NGN</div>
    `;
    if (voaMinorFPCount > 0) {
        html += `<div style="margin-bottom:10px;">FG Processing Fee (Minor, Foreign Parent): ${voaData.voa_fees.processing_fp} NGN</div>`;
    }
    if (voaMinorNPCount > 0) {
        html += `<div style="margin-bottom:10px;">FG Processing Fee (Minor, Nigerian Parent): ${voaData.voa_fees.processing_np} NGN</div>`;
    }
    details.innerHTML = html;
    updateVoaPrice();
}


let isNaira = true;

function toggleCurrency() {
    isNaira = !isNaira;
    document.getElementById('currencyLabel').textContent = isNaira ? 'NGN' : 'USD';
    updateVoaPrice();
}

function updateVoaPrice() {
    voaAdultCount = parseInt(document.getElementById('voaAdultCount').value) || 0;
    voaMinorFPCount = parseInt(document.getElementById('voaMinorFPCount').value) || 0;
    voaMinorNPCount = parseInt(document.getElementById('voaMinorNPCount').value) || 0;
    voaPassengerCount = voaAdultCount + voaMinorFPCount + voaMinorNPCount;

    const visaFee = voaData.visa_fee * voaPassengerCount;
    const biometricFee = (voaData.is_african_country ? voaData.voa_fees.biometrics_african : voaData.voa_fees.biometrics_non_african) * voaPassengerCount;
    const serviceFee = (voaData.is_african_country ? voaData.voa_fees.service_african : voaData.voa_fees.service_non_african) * voaPassengerCount;
    const paymentFee = (voaData.is_african_country ? voaData.voa_fees.payment_african : voaData.voa_fees.payment_non_african) * voaPassengerCount;
    const processingFee = (voaData.voa_fees.processing_adult * voaAdultCount) +
                         (voaData.voa_fees.processing_fp * voaMinorFPCount) +
                         (voaData.voa_fees.processing_np * voaMinorNPCount);
    const flightCost = travelwheelHandlesFlight ? flightFee * voaPassengerCount : 0;

    const totalUSD = visaFee + biometricFee + serviceFee + paymentFee + flightCost;
    const totalNGN = totalUSD * exchangeRate + processingFee; // Processing fees already in NGN

    const convert = (amount, isProcessing = false) => isProcessing ? amount : isNaira ? amount * exchangeRate : amount;
    const currencySymbol = isNaira ? '₦' : '$';

    const breakdown = [
        `Visa Fee: ${currencySymbol}${(convert(voaData.visa_fee)).toFixed(2)} × ${voaPassengerCount} = ${currencySymbol}${(convert(visaFee)).toFixed(2)}`,
        `Biometrics: ${currencySymbol}${(convert(voaData.is_african_country ? voaData.voa_fees.biometrics_african : voaData.voa_fees.biometrics_non_african)).toFixed(2)} × ${voaPassengerCount} = ${currencySymbol}${(convert(biometricFee)).toFixed(2)}`,
        `Service: ${currencySymbol}${(convert(voaData.is_african_country ? voaData.voa_fees.service_african : voaData.voa_fees.service_non_african)).toFixed(2)} × ${voaPassengerCount} = ${currencySymbol}${(convert(serviceFee)).toFixed(2)}`,
        `Payment: ${currencySymbol}${(convert(voaData.is_african_country ? voaData.voa_fees.payment_african : voaData.voa_fees.payment_non_african)).toFixed(2)} × ${voaPassengerCount} = ${currencySymbol}${(convert(paymentFee)).toFixed(2)}`,
        `Processing (Adult): ₦${(voaData.voa_fees.processing_adult).toFixed(2)} × ${voaAdultCount} = ₦${(voaData.voa_fees.processing_adult * voaAdultCount).toFixed(2)}`
    ];

    if (voaMinorFPCount > 0) {
        breakdown.push(`Processing (Minor FP): ₦${(voaData.voa_fees.processing_fp).toFixed(2)} × ${voaMinorFPCount} = ₦${(voaData.voa_fees.processing_fp * voaMinorFPCount).toFixed(2)}`);
    }
    if (voaMinorNPCount > 0) {
        breakdown.push(`Processing (Minor NP): ₦${(voaData.voa_fees.processing_np).toFixed(2)} × ${voaMinorNPCount} = ₦${(voaData.voa_fees.processing_np * voaMinorNPCount).toFixed(2)}`);
    }
    if (travelwheelHandlesFlight) {
        breakdown.push(`Flight Fee: ${currencySymbol}${(convert(flightFee)).toFixed(2)} × ${voaPassengerCount} = ${currencySymbol}${(convert(flightCost)).toFixed(2)}`);
    }

    const convertedTotal = isNaira ? totalNGN : totalUSD;
    const altTotal = isNaira ? totalUSD : totalNGN;
    const altCurrencySymbol = isNaira ? '$' : '₦';

    document.getElementById('voaTotalPrice').textContent = `${currencySymbol}${convertedTotal.toFixed(2)} (${altCurrencySymbol}${altTotal.toFixed(2)})`;
    document.getElementById('voaPaymentTotal').textContent = `${currencySymbol}${convertedTotal.toFixed(2)} (${altCurrencySymbol}${altTotal.toFixed(2)})`;
    document.getElementById('voaPriceBreakdown').innerHTML = breakdown.map(item => `<div style="animation:fadeIn 0.3s;">${item}</div>`).join('');
    document.getElementById('startApplicationBtn').disabled = voaPassengerCount === 0;
}

const passengerFields = [
    { id: 'surname', label: 'Surname', type: 'text', required: true },
    { id: 'first_name', label: 'First Name', type: 'text', required: true },
    { id: 'sex', label: 'Sex', type: 'radio', options: [{ value: 'male', label: 'Male' }, { value: 'female', label: 'Female' }], required: true },
    { id: 'date_of_birth', label: 'Date of Birth', type: 'date', required: true },
    { id: 'current_nationality', class:'current_nationality', label: 'Current Nationality', type: 'select', options: [], required: true }, // Options will be populated dynamically
    { id: 'place_of_birth', class:'place_of_birth', label: 'Place of Birth', type: 'text',  required: true }, // Options populated based on current_nationality
    { id: 'passport_number', label: 'Passport Number', type: 'text', required: true },
    { id: 'passport_issuance_date', label: 'Passport Issuance Date', type: 'date', required: true },
    { id: 'passport_expiry_date', label: 'Passport Expiry Date', type: 'date', required: true },
    { id: 'passport_type', label: 'Passport Type', type: 'select', options: [
        { value: 'standard', label: 'Standard' },
        { value: 'diplomatic', label: 'Diplomatic' },
        { value: 'official', label: 'Official' },
        { value: 'emergency', label: 'Emergency' }
    ], required: true },
    { id: 'issued_by_country',class:'issued_by_country', label: 'Issued By Country', type: 'select', options: [], required: true }, // Options will be populated dynamically
    { id: 'email_address', label: 'Email Address', type: 'email', required: true },
    { id: 'telephone_number', label: 'Telephone Number', type: 'tel', required: true },
    { id: 'home_address', label: 'Home Address', type: 'text', required: true },
    { id: 'purpose_of_journey', label: 'Purpose of Journey', type: 'radio', options: [{ value: 'business', label: 'Business' }], required: true, default: 'business' },
    { id: 'intended_arrival_date', label: 'Intended Arrival Date', type: 'date', required: true },
    { id: 'intended_departure_date', label: 'Intended Departure Date', type: 'date', required: true },
    { id: 'data_page', label: 'Passport Data Page', type: 'file', required: true, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
    { id: 'invitation_letter', label: 'Invitation/Application Letter', type: 'file', required: true, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
    { id: 'cac', label: 'Certificate of Incorporation (CAC)', type: 'file', required: true, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
    { id: 'flight_itinerary', label: 'Flight Itinerary', type: 'file', required: false, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
    { id: 'passport_photo', label: 'Passport Photo', type: 'file', required: true, accept: 'image/jpeg,image/png', maxSize: 2048 }
];

async function initializeKycForm() {
    voaAdultCount = parseInt(document.getElementById('voaAdultCount').value) || 0;
    voaMinorFPCount = parseInt(document.getElementById('voaMinorFPCount').value) || 0;
    voaMinorNPCount = parseInt(document.getElementById('voaMinorNPCount').value) || 0;
    voaPassengerCount = voaAdultCount + voaMinorFPCount + voaMinorNPCount;

    passengers = [];
    // Assign passenger types
    for (let i = 0; i < voaAdultCount; i++) passengers.push({ passenger_type: 'adult' });
    for (let i = 0; i < voaMinorFPCount; i++) passengers.push({ passenger_type: 'minor_fp' });
    for (let i = 0; i < voaMinorNPCount; i++) passengers.push({ passenger_type: 'minor_np' });

    currentPassengerIndex = 0;
    currentSubStep = 1;

    const countries = await fetchCountries();
    passengerFields.forEach(field => {
        if (field.id === 'current_nationality' || field.id === 'issued_by_country') {
            field.options = countries;
        }
    });

    renderPassengerForm();
}


async function renderPassengerForm() {
    const passengerType = passengers[currentPassengerIndex].passenger_type === 'adult' ? 'Adult' : 
                          passengers[currentPassengerIndex].passenger_type === 'minor_fp' ? 'Minor (Foreign Parent)' : 
                          'Minor (Nigerian Parent)';
    document.getElementById('passengerProgress').textContent = `Passenger ${currentPassengerIndex + 1} of ${voaPassengerCount} (${passengerType})`;
    defineSubSteps();

    const { startDate, endDate } = getDateRangeFromURL();
    console.log('getDateRangeFromURL:', { startDate, endDate });

    const container = document.getElementById('passenger-sections');
    container.innerHTML = '';

    // Ensure countries are available - fetch again if needed
    let countries = [];
    const nationalityField = passengerFields.find(f => f.id === 'current_nationality');
    if (!nationalityField.options || nationalityField.options.length === 0) {
        console.log('Countries not found in passengerFields, fetching...');
        countries = await fetchCountries();
        // Update all country-related fields
        passengerFields.forEach(field => {
            if (field.id === 'current_nationality' || field.id === 'issued_by_country') {
                field.options = countries;
            }
        });
    } else {
        countries = nationalityField.options;
    }
    
    console.log('Countries available for rendering:', countries.length);

    const fields = subSteps[currentSubStep - 1];
    let html = `<div class="passenger-section" data-index="${currentPassengerIndex}">`;
    
    for (const field of fields) {
        if (field.id === 'flight_itinerary' && travelwheelHandlesFlight) continue;
        
        html += `<div class="form-group">
            <label class="form-label" for="voa_${field.id}_${currentPassengerIndex}">${field.label}${field.required && !(field.id === 'flight_itinerary' && travelwheelHandlesFlight) ? ' <span style="color:var(--error);">*</span>' : ''}</label>`;
            
        if (field.type === 'text' || field.type === 'email' || field.type === 'tel') {
            let value = passengers[currentPassengerIndex][field.id] || '';
            html += `<input type="${field.type}" class="form-control" id="voa_${field.id}_${currentPassengerIndex}" name="passengers[${currentPassengerIndex}][${field.id}]" ${field.required ? 'required' : ''} value="${value}">`;
        } else if (field.type === 'date') {
            let value = passengers[currentPassengerIndex][field.id] || '';
            if (field.id === 'intended_arrival_date' && !value) {
                value = startDate;
            } else if (field.id === 'intended_departure_date' && !value) {
                value = endDate;
            }
            html += `<input type="text" class="form-control date-input" id="voa_${field.id}_${currentPassengerIndex}" name="passengers[${currentPassengerIndex}][${field.id}]" ${field.required ? 'required' : ''} value="${value}">`;
        } else if (field.type === 'radio') {
            html += `<fieldset><legend style="display:none;">${field.label}</legend><div style="display:flex;gap:16px;flex-wrap:wrap;">${field.options.map(opt => `
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="passengers[${currentPassengerIndex}][${field.id}]" id="voa_${field.id}_${opt.value}_${currentPassengerIndex}" value="${opt.value}" ${passengers[currentPassengerIndex][field.id] === opt.value ? 'checked' : ''} ${field.required ? 'required' : ''}>
                    <label class="form-check-label" for="voa_${field.id}_${opt.value}_${currentPassengerIndex}" style="font-size:0.95rem;">${opt.label}</label>
                </div>`).join('')}</div></fieldset>`;
        } else if (field.type === 'select') {
            let options = field.options || [];
            
            // Special handling for place_of_birth
            if (field.id === 'place_of_birth') {
                options = passengers[currentPassengerIndex][`${field.id}_options`] || [{ value: '', label: '-- Select State/Province --' }];
            }
            
            console.log(`Rendering select for ${field.id}, options:`, options.length);
            
            html += `<select class="form-select" id="voa_${field.id}_${currentPassengerIndex}" name="passengers[${currentPassengerIndex}][${field.id}]" ${field.required ? 'required' : ''}>
                <option value="">-- Select ${field.label} --</option>
                ${options.map(opt => `<option value="${opt.value}" ${passengers[currentPassengerIndex][field.id] === opt.value ? 'selected' : ''}>${opt.label}</option>`).join('')}
            </select>`;
        } else if (field.type === 'file') {
            html += `
                <div class="file-input-container">
                    <input type="file" id="voa_${field.id}_${currentPassengerIndex}" name="${field.id}[${currentPassengerIndex}]" accept="${field.accept}" class="form-control" ${field.required && !(field.id === 'flight_itinerary' && travelwheelHandlesFlight) ? 'required' : ''}>
                    <label for="voa_${field.id}_${currentPassengerIndex}" class="file-input-label">Choose File</label>
                    <div class="file-selected" id="file-selected-${field.id}-${currentPassengerIndex}">${passengers[currentPassengerIndex][`${field.id}_file`] ? passengers[currentPassengerIndex][`${field.id}_file`].name : 'No file selected'}</div>
                </div>`;
        }
        html += `</div>`;
    }
    html += `</div>`;
    container.innerHTML = html;

    // Initialize flatpickr for date inputs
    document.querySelectorAll('input.date-input').forEach(input => {
        const passengerIndex = input.id.match(/\d+/)[0];
        const fieldName = input.id.replace(`voa_`, '').replace(`_${passengerIndex}`, '');
        const isDateOfBirth = input.id.includes('date_of_birth');
        const isPassportIssuance = input.id.includes('passport_issuance_date');
        const isPassportExpiry = input.id.includes('passport_expiry_date');
        const isArrivalDate = input.id.includes('intended_arrival_date');
        const isDepartureDate = input.id.includes('intended_departure_date');

        const today = new Date();
        const maxPassportValidity = 10 * 365 * 24 * 60 * 60 * 1000;
        const maxAge = 100 * 365 * 24 * 60 * 60 * 1000;
        const maxPassportIssuance = 20 * 365 * 24 * 60 * 60 * 1000;

        let defaultDate = passengers[currentPassengerIndex][fieldName] || null;
        if (isArrivalDate && !defaultDate) {
            defaultDate = startDate;
        } else if (isDepartureDate && !defaultDate) {
            defaultDate = endDate;
        }

        const parseDateForFlatpickr = (dateStr) => {
            if (!dateStr) return null;
            if (dateStr.includes('/')) {
                if (!isValidDate(dateStr)) {
                    console.warn(`Invalid date format for ${fieldName}: ${dateStr}`);
                    return null;
                }
                const [month, day, year] = dateStr.split('/').map(Number);
                return new Date(year, month - 1, day);
            }
            if (dateStr.includes('-')) {
                const [year, month, day] = dateStr.split('-').map(Number);
                return new Date(year, month - 1, day);
            }
            console.warn(`Unrecognized date format for ${fieldName}: ${dateStr}`);
            return null;
        };

        let flatpickrConfig = {
            dateFormat: 'm/d/Y',
            altInput: true,
            altFormat: 'm/d/Y',
            animate: true,
            allowInput: true,
            defaultDate: defaultDate ? parseDateForFlatpickr(defaultDate) : null,
            onChange: function(selectedDates, dateStr, instance) {
                console.log(`Date changed for ${input.id}:`, { selectedDates, dateStr, defaultDate });

                if (selectedDates.length > 0 && dateStr && isValidDate(dateStr)) {
                    passengers[currentPassengerIndex][fieldName] = dateStr;
                } else {
                    passengers[currentPassengerIndex][fieldName] = '';
                }

                const issuanceInput = document.getElementById(`voa_passport_issuance_date_${passengerIndex}`);
                const expiryInput = document.getElementById(`voa_passport_expiry_date_${passengerIndex}`);
                const arrivalInput = document.getElementById(`voa_intended_arrival_date_${passengerIndex}`);
                const departureInput = document.getElementById(`voa_intended_departure_date_${passengerIndex}`);

                if ((isPassportIssuance || isPassportExpiry) && issuanceInput && expiryInput) {
                    validatePassportDates(issuanceInput, expiryInput);
                }

                if (isArrivalDate && departureInput && selectedDates.length > 0) {
                    const arrivalDate = selectedDates[0];
                    if (arrivalDate) {
                        const maxDate = new Date(arrivalDate);
                        maxDate.setDate(arrivalDate.getDate() + (voaData.validity_days || 30));
                        const departureInstance = departureInput._flatpickr;
                        if (departureInstance) {
                            departureInstance.set('minDate', arrivalDate);
                            departureInstance.set('maxDate', maxDate);
                        }
                    }
                }
            },
            onClose: function(selectedDates, dateStr, instance) {
                if (dateStr && !isValidDate(dateStr)) {
                    instance.clear();
                    input.classList.add('error');
                    console.warn(`Invalid date entered for ${input.id}: ${dateStr}`);
                    setTimeout(() => input.classList.remove('error'), 1000);
                }
            }
        };

        if (isDateOfBirth) {
            flatpickrConfig.maxDate = 'today';
            flatpickrConfig.minDate = new Date(today.getTime() - maxAge);
        } else if (isPassportIssuance) {
            flatpickrConfig.maxDate = 'today';
            flatpickrConfig.minDate = new Date(today.getTime() - maxPassportIssuance);
        } else if (isPassportExpiry) {
            const issuanceInput = document.getElementById(`voa_passport_issuance_date_${passengerIndex}`);
            const issuanceDate = issuanceInput && issuanceInput.value ? parseDateForFlatpickr(issuanceInput.value) : null;
            flatpickrConfig.minDate = issuanceDate && !isNaN(issuanceDate.getTime()) ? issuanceDate : new Date(today.getTime() - maxPassportIssuance);
            flatpickrConfig.maxDate = new Date(today.getTime() + maxPassportValidity);
        } else if (isArrivalDate) {
            flatpickrConfig.minDate = 'today';
        } else if (isDepartureDate) {
            const arrivalInput = document.getElementById(`voa_intended_arrival_date_${passengerIndex}`);
            const arrivalDate = arrivalInput && arrivalInput.value ? parseDateForFlatpickr(arrivalInput.value) : parseDateForFlatpickr(startDate) || today;
            flatpickrConfig.minDate = arrivalDate;
            flatpickrConfig.maxDate = new Date(arrivalDate.getTime());
            flatpickrConfig.maxDate.setDate(arrivalDate.getDate() + (voaData.validity_days || 30));
        }

        const instance = flatpickr(input, flatpickrConfig);
        console.log(`Flatpickr initialized for ${input.id} with defaultDate:`, flatpickrConfig.defaultDate);
    });

    // File input handling
    passengerFields
        .filter(field => field.type === 'file')
        .forEach(field => {
            const input = document.getElementById(`voa_${field.id}_${currentPassengerIndex}`);
            const fileSelected = document.getElementById(`file-selected-${field.id}-${currentPassengerIndex}`);
            if (passengers[currentPassengerIndex][`${field.id}_file`]) {
                fileSelected.textContent = passengers[currentPassengerIndex][`${field.id}_file`].name;
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(passengers[currentPassengerIndex][`${field.id}_file`]);
                input.files = dataTransfer.files;
            }
        });

    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', (e) => {
            const fileLabel = e.target.nextElementSibling;
            const docType = input.name.split('[')[0];
            const index = input.name.match(/\[(\d+)\]/)[1];
            const fileSelected = document.getElementById(`file-selected-${docType}-${index}`);
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const maxSize = passengerFields.find(f => f.id === docType).maxSize * 1024;
                if (file.size > maxSize) {
                    alert(`File ${file.name} exceeds ${maxSize/1024}KB limit.`);
                    e.target.value = '';
                    fileSelected.textContent = 'No file selected';
                    fileLabel.classList.add('error');
                    setTimeout(() => fileLabel.classList.remove('error'), 1000);
                    return;
                }
                passengers[index][`${docType}_file`] = file;
                fileSelected.textContent = file.name;
            } else {
                passengers[index][`${docType}_file`] = null;
                fileSelected.textContent = 'No file selected';
            }
        });
    });

    // Only set up nationality and state interaction for sub-steps 2 and 3
    if (currentSubStep === 2 || currentSubStep === 3) {
        await setupNationalityStateInteraction();
    }

    const nav = document.getElementById('subStepNav');
    nav.innerHTML = subSteps.map((_, i) => `<span class="sub-step-dot ${i + 1 === currentSubStep ? 'active' : ''}"></span>`).join('');

    document.getElementById('copyPrevious').style.display = currentPassengerIndex > 0 ? 'inline-block' : 'none';
    // document.getElementById('skipPassenger').style.display = currentPassengerIndex < voaPassengerCount - 1 ? 'inline-block' : 'none';
    document.getElementById('prevSubStep').style.display = currentSubStep > 1 || currentPassengerIndex > 0 ? 'inline-block' : 'none';
    document.getElementById('nextSubStep').textContent = (currentSubStep === subSteps.length && currentPassengerIndex === voaPassengerCount - 1) ? 'Continue' : 'Next';
}

async function setupNationalityStateInteraction() {
    const nationalityInput = document.getElementById(`voa_current_nationality_${currentPassengerIndex}`);
    const placeOfBirthInput = document.getElementById(`voa_place_of_birth_${currentPassengerIndex}`);
    const issuedByCountryInput = document.getElementById(`voa_issued_by_country_${currentPassengerIndex}`);
    

    console.log('Setting up nationality and issued by country interaction:', {
        nationalityInput: !!nationalityInput,
        placeOfBirthInput: !!placeOfBirthInput,
        issuedByCountryInput: !!issuedByCountryInput,
        currentPassengerIndex
    });

    // Only proceed if the relevant inputs are present
    if (currentSubStep === 2 && nationalityInput && placeOfBirthInput) {
        const nationalityField = passengerFields.find(f => f.id === 'current_nationality');
        
        // Check if nationalityField options are empty and fetch if necessary
        if (!nationalityField.options.length) {
            placeOfBirthInput.disabled = true;
            placeOfBirthInput.innerHTML = `<option value="">Loading states...</option>`;
            const countries = await fetchCountries();
            nationalityField.options = countries;
            placeOfBirthInput.disabled = false;
        }
        const selectedCountry = passengers[currentPassengerIndex]['current_nationality'] || '';
        console.log('Selected country for nationality:', selectedCountry);
        

        // Load states for the currently selected country
        // if (selectedCountry) {
        //     console.log('Fetching states for:', selectedCountry);
        //     const states = await fetchStates(selectedCountry);
        //     console.log('States fetched:', states.length);

        //     passengers[currentPassengerIndex]['place_of_birth_options'] = states.length > 0 ? states : [{ value: '', label: 'No states available' }];

        //     // Update the place_of_birth select options
        //     const currentPlaceValue = passengers[currentPassengerIndex]['place_of_birth'] || '';
        //     placeOfBirthInput.innerHTML = `
        //         <option value="">-- Select State/Province --</option>
        //         ${passengers[currentPassengerIndex]['place_of_birth_options'].map(opt => 
        //             `<option value="${opt.value}" ${currentPlaceValue === opt.value ? 'selected' : ''}>${opt.label}</option>`
        //         ).join('')}
        //     `;
        // } else {
        //     // If no country is selected, set default options
        //     passengers[currentPassengerIndex]['place_of_birth_options'] = [{ value: '', label: '-- Select State/Province --' }];
        //     placeOfBirthInput.innerHTML = `
        //         <option value="">-- Select State/Province --</option>
        //     `;
        // }

        // Add change event listener for current_nationality
        // nationalityInput.addEventListener('change', async (e) => {
        //     const country = e.target.value;
        //     console.log('Nationality changed to:', country);

        //     passengers[currentPassengerIndex]['current_nationality'] = country;
        //     passengers[currentPassengerIndex]['place_of_birth'] = '';

        //     if (country) {
        //         console.log('Fetching states for changed country:', country);
        //         const states = await fetchStates(country);
        //         console.log('States fetched for changed country:', states.length);

        //         passengers[currentPassengerIndex]['place_of_birth_options'] = states.length > 0 ? states : [{ value: '', label: 'No states available' }];
        //     } else {
        //         passengers[currentPassengerIndex]['place_of_birth_options'] = [{ value: '', label: '-- Select State/Province --' }];
        //     }

        //     // Update place_of_birth options
        //     placeOfBirthInput.innerHTML = `
        //         <option value="">-- Select State/Province --</option>
        //         ${passengers[currentPassengerIndex]['place_of_birth_options'].map(opt => 
        //             `<option value="${opt.value}">${opt.label}</option>`
        //         ).join('')}
        //     `;
        // });

        // Add change event listener for place_of_birth
        placeOfBirthInput.addEventListener('change', (e) => {
            passengers[currentPassengerIndex]['place_of_birth'] = e.target.value;
            console.log('Place of birth changed to:', e.target.value);
        });
    }

    if (currentSubStep === 3 && issuedByCountryInput) {
        // Handle issued_by_country
        const selectedIssuedCountry = passengers[currentPassengerIndex]['issued_by_country'] || '';
        console.log('Selected issued by country:', selectedIssuedCountry);

        // Ensure issued_by_country options are populated
        const countryOptions = passengerFields.find(f => f.id === 'issued_by_country').options || [];
        issuedByCountryInput.innerHTML = `
            <option value="">-- Select Issued By Country --</option>
            ${countryOptions.map(opt => 
                `<option value="${opt.value}" ${selectedIssuedCountry === opt.value ? 'selected' : ''}>${opt.label}</option>`
            ).join('')}
        `;

        // Add change event listener for issued_by_country
        issuedByCountryInput.addEventListener('change', (e) => {
            passengers[currentPassengerIndex]['issued_by_country'] = e.target.value;
            console.log('Issued by country changed to:', e.target.value);
        });
    }
}


function defineSubSteps() {
    subSteps = [
        [
            { id: 'surname', label: 'Surname', type: 'text', required: true },
            { id: 'first_name', label: 'First Name', type: 'text', required: true },
            { id: 'sex', label: 'Sex', type: 'radio', options: [{ value: 'male', label: 'Male' }, { value: 'female', label: 'Female' }], required: true }
        ],
        [
            { id: 'date_of_birth', label: 'Date of Birth', type: 'date', required: true },
            { id: 'current_nationality', class:'current_nationality', label: 'Current Nationality', type: 'select', options: [], required: true },
            { id: 'place_of_birth',class:'place_of_birth', label: 'Place of Birth', type: 'text', required: true }
        ],
        [
            { id: 'passport_number', label: 'Passport Number', type: 'text', required: true },
            { id: 'passport_issuance_date', label: 'Passport Issuance Date', type: 'date', required: true },
            { id: 'passport_expiry_date', label: 'Passport Expiry Date', type: 'date', required: true },
            { id: 'passport_type', label: 'Passport Type', type: 'select', options: [
                { value: 'standard', label: 'Standard' },
                { value: 'diplomatic', label: 'Diplomatic' },
                { value: 'official', label: 'Official' },
                { value: 'emergency', label: 'Emergency' }
            ], required: true },
            { id: 'issued_by_country',class:'issued_by_country', label: 'Issued By Country', type: 'select', options: [], required: true }
        ],
        [
            { id: 'email_address', label: 'Email Address', type: 'email', required: true },
            { id: 'telephone_number', label: 'Telephone Number', type: 'tel', required: true },
            { id: 'home_address', label: 'Home Address', type: 'text', required: true }
        ],
        [
            { id: 'purpose_of_journey', label: 'Purpose of Journey', type: 'radio', options: [{ value: 'business', label: 'Business' }], required: true, default: 'business' },
            { id: 'intended_arrival_date', label: 'Intended Arrival Date', type: 'date', required: true },
            { id: 'intended_departure_date', label: 'Intended Departure Date', type: 'date', required: true }
        ],
        [
            { id: 'data_page', label: 'Passport Data Page', type: 'file', required: true, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
            { id: 'invitation_letter', label: 'Invitation/Application Letter', type: 'file', required: true, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
            { id: 'cac', label: 'Certificate of Incorporation (CAC)', type: 'file', required: true, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
            { id: 'flight_itinerary', label: 'Flight Itinerary', type: 'file', required: false, accept: 'image/jpeg,image/png,application/pdf', maxSize: 2048 },
            { id: 'passport_photo', label: 'Passport Photo', type: 'file', required: true, accept: 'image/jpeg,image/png', maxSize: 2048 }
        ]
    ];
    
    // Ensure country options are set for each substep that needs them
    subSteps.forEach(step => {
        step.forEach(field => {
            if (field.id === 'current_nationality' || field.id === 'issued_by_country') {
                // These will be populated when the form is rendered
                field.options = passengerFields.find(f => f.id === field.id)?.options || [];
            }
        });
    });
}

function validateCurrentSubStep() {
    const form = document.getElementById('voaKycForm');
    const fields = subSteps[currentSubStep - 1];
    let valid = true;
    const errors = [];

    fields.forEach(field => {
        if (field.id === 'flight_itinerary' && travelwheelHandlesFlight) return;
        const input = document.getElementById(`voa_${field.id}_${currentPassengerIndex}`);
        if (field.required && input) {
            if (field.type === 'file') {
                if (!input.files.length) {
                    input.nextElementSibling.classList.add('error');
                    setTimeout(() => input.nextElementSibling.classList.remove('error'), 1000);
                    valid = false;
                    errors.push(`${field.label} is required.`);
                } else {
                    const file = input.files[0];
                    const maxSize = field.maxSize * 1024;
                    if (file.size > maxSize) {
                        input.nextElementSibling.classList.add('error');
                        setTimeout(() => input.nextElementSibling.classList.remove('error'), 1000);
                        valid = false;
                        errors.push(`${field.label} exceeds ${maxSize / 1024}KB limit.`);
                    }
                }
            } else if (field.type === 'radio') {
                const selected = form.querySelector(`input[name="passengers[${currentPassengerIndex}][${field.id}]"]:checked`);
                if (!selected) {
                    valid = false;
                    errors.push(`${field.label} is required.`);
                    const fieldset = input.closest('fieldset');
                    fieldset.classList.add('error');
                    setTimeout(() => fieldset.classList.remove('error'), 1000);
                }
            } else if (!input.value) {
                input.classList.add('error');
                setTimeout(() => input.classList.remove('error'), 1000);
                valid = false;
                errors.push(`${field.label} is required.`);
            } else if (field.id === 'email_address' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
                input.classList.add('error');
                setTimeout(() => input.classList.remove('error'), 1000);
                valid = false;
                errors.push(`${field.label} is invalid.`);
            } else if (field.type === 'date' && !isValidDate(input.value)) {
                input.classList.add('error');
                setTimeout(() => input.classList.remove('error'), 1000);
                valid = false;
                errors.push(`${field.label} is invalid. Please use MM/DD/YYYY and a valid date.`);
            } else if (field.id === 'place_of_birth' && passengers[currentPassengerIndex]['place_of_birth_options']?.length > 1 && !input.value) {
                input.classList.add('error');
                setTimeout(() => input.classList.remove('error'), 1000);
                valid = false;
                errors.push(`${field.label} is required when states are available.`);
            }
        }
    });

    if (!valid) {
        alert(`Please correct the following errors:\n- ${errors.join('\n- ')}`);
    }

    return valid;
}

function validateForm() {
    let valid = true;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errors = [];

    passengers.forEach((passenger, index) => {
        passengerFields.forEach(field => {
            if (field.required && field.id !== 'flight_itinerary' || (field.id === 'flight_itinerary' && !travelwheelHandlesFlight)) {
                const value = passenger[field.id];
                if (!value && field.type !== 'file') {
                    errors.push(`Passenger ${index + 1}: ${field.label} is required.`);
                    valid = false;
                } else if (field.type === 'file' && !passenger[`${field.id}_file`]) {
                    errors.push(`Passenger ${index + 1}: ${field.label} file is required.`);
                    valid = false;
                } else if (field.id === 'email_address' && value && !emailRegex.test(value)) {
                    errors.push(`Passenger ${index + 1}: ${field.label} is invalid.`);
                    valid = false;
                } else if (field.type === 'date' && value && !isValidDate(value)) {
                    errors.push(`Passenger ${index + 1}: ${field.label} is invalid (use MM/DD/YYYY and a valid date).`);
                    valid = false;
                } else if (field.id === 'place_of_birth' && passenger['place_of_birth_options']?.length > 1 && !value) {
                    errors.push(`Passenger ${index + 1}: ${field.label} is required when states are available.`);
                    valid = false;
                }
            }
        });

        if (passenger.passport_issuance_date && passenger.passport_expiry_date) {
            const issuanceDate = new Date(passenger.passport_issuance_date);
            const expiryDate = new Date(passenger.passport_expiry_date);
            if (issuanceDate >= expiryDate) {
                errors.push(`Passenger ${index + 1}: Passport issuance date must be before expiry date.`);
                valid = false;
            }
        }
    });

    if (!valid) {
        alert(`Please correct the following errors:\n- ${errors.join('\n- ')}`);
    }

    return valid;
}

function validatePassportDates(issuanceInput, expiryInput) {
    const existingWarning = issuanceInput.parentElement.querySelector('.date-warning');
    if (existingWarning) {
        existingWarning.remove();
    }

    // Only validate if both inputs have values
    if (!issuanceInput.value || !expiryInput.value) {
        return;
    }

    const warningDiv = document.createElement('div');
    warningDiv.className = 'date-warning';

    const parseDate = (dateStr) => {
        const [month, day, year] = dateStr.split('/').map(Number);
        return new Date(year, month - 1, day);
    };

    // Ensure both dates are valid before proceeding
    if (!isValidDate(issuanceInput.value) || !isValidDate(expiryInput.value)) {
        return;
    }

    const issuanceDate = parseDate(issuanceInput.value);
    const expiryDate = parseDate(expiryInput.value);

    if (issuanceDate >= expiryDate) {
        warningDiv.textContent = 'Error: Issuance date must be before expiry date.';
        issuanceInput.parentElement.appendChild(warningDiv);
        return;
    }

    const yearsDiff = (expiryDate - issuanceDate) / (1000 * 60 * 60 * 24 * 365);
    const isWholeYears = Math.abs(yearsDiff - Math.round(yearsDiff)) < 0.1;
    const sameDayMonth = issuanceDate.getDate() === expiryDate.getDate() && issuanceDate.getMonth() === expiryDate.getMonth();

    if (!isWholeYears || !sameDayMonth) {
        warningDiv.textContent = 'Warning: Are you sure you entered the issue/expiry dates correctly? Most passports have an issue day the same day as the expiry day. For example: Jan 1, 2023 to Jan 1, 2033.';
        issuanceInput.parentElement.appendChild(warningDiv);
    }
}

function nextSubStep() {
    if (!validateCurrentSubStep()) {
        return;
    }

    const form = document.getElementById('voaKycForm');
    const formData = new FormData(form);

    for (let [name, value] of formData) {
        if (name.startsWith('passengers[')) {
            const fieldName = name.split('[')[2].replace(/]/, '');
            passengers[currentPassengerIndex][fieldName] = value;
        }
    }

    passengerFields
        .filter(field => field.type === 'file')
        .forEach(field => {
            const input = document.getElementById(`voa_${field.id}_${currentPassengerIndex}`);
            if (input && input.files.length > 0) {
                passengers[currentPassengerIndex][`${field.id}_file`] = input.files[0];
            }
        });

    if (currentSubStep < subSteps.length) {
        currentSubStep++;
        renderPassengerForm();
    } else if (currentPassengerIndex < voaPassengerCount - 1) {
        currentPassengerIndex++;
        currentSubStep = 1;
        renderPassengerForm();
    } else {
        if (validateForm()) {
            nextVoaStep(3);
        } else {
            alert('Please complete all required fields and upload required documents for all passengers.');
        }
    }
}

function prevSubStep() {
    if (currentSubStep > 1) {
        currentSubStep--;
        renderPassengerForm();
    } else if (currentPassengerIndex > 0) {
        currentPassengerIndex--;
        currentSubStep = subSteps.length;
        renderPassengerForm();
    } else {
        prevVoaStep(1);
    }
}

function copyPrevious() {
    if (currentPassengerIndex > 0) {
        passengers[currentPassengerIndex] = { ...passengers[currentPassengerIndex - 1] };
        ['data_page', 'invitation_letter', 'cac', 'flight_itinerary', 'passport_photo'].forEach(field => {
            delete passengers[currentPassengerIndex][`${field}_file`];
        });
        renderPassengerForm();
    }
}

function skipPassenger() {
    if (currentPassengerIndex < voaPassengerCount - 1) {
        currentPassengerIndex++;
        currentSubStep = 1;
        renderPassengerForm();
    } else {
        alert('No more passengers to skip.');
    }
}

function resetKycForm() {
    passengers = [{}];
    voaPassengerCount = 1;
    currentPassengerIndex = 0;
    currentSubStep = 1;
    travelwheelHandlesFlight = false;
    document.getElementById('voaPassengerCount').value = '1';
    document.getElementById('travelwheelFlight').checked = false;
    updateVoaPrice();
    renderPassengerForm();
}

function initializeVoaPayment() {
    if (!validateForm()) {
        alert('Please complete all required fields and upload required documents for all passengers.');
        return;
    }

    const passengerData = passengers.map((passenger, index) => ({
        passenger_type: passenger.passenger_type,
        surname: passenger.surname || '',
        first_name: passenger.first_name || '',
        sex: passenger.sex || '',
        date_of_birth: passenger.date_of_birth || '',
        current_nationality: passenger.current_nationality || '',
        place_of_birth: passenger.place_of_birth || '',
        passport_number: passenger.passport_number || '',
        passport_issuance_date: passenger.passport_issuance_date || '',
        passport_expiry_date: passenger.passport_expiry_date || '',
        passport_type: passenger.passport_type || '',
        issued_by_country: passenger.issued_by_country || '',
        email_address: passenger.email_address || '',
        telephone_number: passenger.telephone_number || '',
        home_address: passenger.home_address || '',
        purpose_of_journey: passenger.purpose_of_journey || '',
        intended_arrival_date: passenger.intended_arrival_date || '',
        intended_departure_date: passenger.intended_departure_date || ''
    }));

    const formData = new FormData();
    formData.append('voa_id', voaData.id);

    const visaFee = voaData.visa_fee * voaPassengerCount;
    const biometricFee = (voaData.is_african_country ? voaData.voa_fees.biometrics_african : voaData.voa_fees.biometrics_non_african) * voaPassengerCount;
    const serviceFee = (voaData.is_african_country ? voaData.voa_fees.service_african : voaData.voa_fees.service_non_african) * voaPassengerCount;
    const paymentFee = (voaData.is_african_country ? voaData.voa_fees.payment_african : voaData.voa_fees.payment_non_african) * voaPassengerCount;
    const processingFee = (voaData.voa_fees.processing_adult * voaAdultCount) +
                         (voaData.voa_fees.processing_fp * voaMinorFPCount) +
                         (voaData.voa_fees.processing_np * voaMinorNPCount);
    const flightCost = travelwheelHandlesFlight ? flightFee * voaPassengerCount : 0;

    const totalUSD = visaFee + biometricFee + serviceFee + paymentFee + flightCost;
    const totalNGN = totalUSD * exchangeRate + processingFee;

    formData.append('total_price', totalNGN.toFixed(2));
    formData.append('email', passengers[0].email_address || '');
    formData.append('full_name', `${passengers[0].surname || ''} ${passengers[0].first_name || ''}`);
    formData.append('passenger_count', voaPassengerCount);
    formData.append('passengers', JSON.stringify(passengerData));
    formData.append('travelwheel_flight', travelwheelHandlesFlight ? '1' : '0');
    formData.append('flight_fee', travelwheelHandlesFlight ? (flightFee * voaPassengerCount).toFixed(2) : '0');

    passengers.forEach((passenger, index) => {
        ['data_page', 'invitation_letter', 'cac', 'flight_itinerary', 'passport_photo'].forEach(field => {
            if (passenger[`${field}_file`]) {
                formData.append(`${field}[${index}]`, passenger[`${field}_file`]);
            }
        });
    });

    document.getElementById('payWithSeerbit').addEventListener('click', () => {
        document.getElementById('paymentStatus').textContent = 'Initializing payment...';
        fetch('/voa/process-payment-and-apply', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(JSON.stringify(data));
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    localStorage.setItem('transaction_ref', data.transaction_ref);
                    window.location.href = data.redirect_url;
                } else {
                    document.getElementById('paymentStatus').textContent = data.error || 'Payment initialization failed.';
                }
            })
            .catch(error => {
                document.getElementById('paymentStatus').textContent = 'Payment initialization failed. Please try again.';
                try {
                    const errorData = JSON.parse(error.message);
                    if (errorData.details) {
                        alert(`Validation errors:\n${Object.values(errorData.details).flat().join('\n')}`);
                    }
                } catch (e) {}
            });
    }, { once: true });
}

function initSummaryEditHandlers() {
    document.removeEventListener('click', handleSummaryEditClick);
    document.addEventListener('click', handleSummaryEditClick);

    const dateRangeInput = document.getElementById('dateRange');
    if (dateRangeInput) {
        flatpickr('#dateRange', {
            mode: 'range',
            minDate: 'today',
            dateFormat: 'm/d/Y',
            animate: true
        });
    }

    const form = document.getElementById('searchForm');
    if (form) {
        form.removeEventListener('submit', handleSearchFormSubmit);
        form.addEventListener('submit', handleSearchFormSubmit);
    }

    const toCountry = document.getElementById('toCountry');
    if (toCountry) {
        toCountry.removeEventListener('change', handleToCountryChange);
        toCountry.addEventListener('change', handleToCountryChange);
    }
}

function handleSummaryEditClick(e) {
    if (e.target.id === 'editSummaryBtn') {
        e.preventDefault();
        const summaryView = document.getElementById('summaryView');
        const searchForm = document.getElementById('searchForm');
        const editBtn = document.getElementById('editSummaryBtn');
        if (summaryView && searchForm && editBtn) {
            summaryView.style.display = 'none';
            searchForm.classList.add('active');
            editBtn.style.display = 'none';
        }
    } else if (e.target.id === 'cancelEditSummary') {
        const summaryView = document.getElementById('summaryView');
        const searchForm = document.getElementById('searchForm');
        const editBtn = document.getElementById('editSummaryBtn');
        if (summaryView && searchForm && editBtn) {
            summaryView.style.display = 'flex';
            searchForm.classList.remove('active');
            editBtn;
            style.display = 'inline-block';
        }
    }
}

function handleSearchFormSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const from = document.getElementById('fromCountry').value;
    const to = document.getElementById('toCountry').value;
    const dateRange = document.getElementById('dateRange').value;
    const token = document.querySelector('meta[name="csrf-token"]').content;

    if (!dateRange.match(/\d{2}\/\d{2}\/\d{4}\s+to\s+\d{2}\/\d{2}\/\d{4}/)) {
        alert('Please select a valid date range.');
        return;
    }

    const action = to === 'Nigeria' ? '{{ route('voa.search') }}' : '{{ route('initial.search') }}';
    fetch(action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'text/html',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            from_country: from,
            to_country: to,
            date_range: dateRange
        })
    })
        .then(resp => resp.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContainer = doc.querySelector('.container');
            document.querySelector('.container').replaceWith(newContainer);
            initSummaryEditHandlers();
            document.querySelectorAll('.start-voa-application').forEach(button => {
                button.addEventListener('click', function() {
                    const voaId = this.getAttribute('data-voa-id');
                    voaData = {
                        id: voaId,
                        visa_fee: {{ $voa->visa_fee ?? 0 }},
                       is_african_country: {{ json_encode($voa?->country?->is_african_country) }},
                        voa_fees: {
                            amount_african: {{ $voaFees->amount_african ?? 0 }},
                            amount_non_african: {{ $voaFees->amount_non_african ?? 0 }}
                        }
                    };
                    updateVoaDetails();
                    modal.classList.add('active');
                    currentVoaStep = 1;
                    for (let i = 1; i <= 4; i++) {
                        document.getElementById(`voaStep${i}`).classList.remove('active');
                    }
                    document.getElementById('voaStep1').classList.add('active');
                    updateStepper();
                    travelwheelHandlesFlight = false;
                    document.getElementById('travelwheelFlight').checked = false;
                });
            });
            feather.replace();
        })
        .catch(() => {
            alert('Failed to update search. Please try again.');
        });
}

function handleToCountryChange() {
    const form = document.getElementById('searchForm');
    const toCountry = this.value;
    if (form) {
        form.action = toCountry === 'Nigeria' ? '{{ route('voa.search') }}' : '{{ route('initial.search') }}';
    }
}

// Event Listeners
document.getElementById('startApplicationBtn').addEventListener('click', () => nextVoaStep(2));
document.getElementById('nextSubStep').addEventListener('click', nextSubStep);
document.getElementById('prevSubStep').addEventListener('click', prevSubStep);
document.getElementById('copyPrevious').addEventListener('click', copyPrevious);
// document.getElementById('skipPassenger').addEventListener('click', skipPassenger);
document.getElementById('backToKYC').addEventListener('click', () => prevVoaStep(2));

// Initialize Handlers
initSummaryEditHandlers();
    </script>
</body>
</html>