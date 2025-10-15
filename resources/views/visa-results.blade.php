<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelwheel - Visa Application</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Flatpickr for Date Picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        /* Summary Edit Form */
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
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
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

        .visa-card .actions {
            margin-top: 12px;
            display: flex;
            gap: 10px;
        }

        .visa-card .actions button,
        .visa-card .actions a {
            font-size: 0.95rem;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s, transform 0.2s;
        }

        .visa-card .actions button {
            background: var(--primary);
            color: #fff;
            border: none;
        }

        .visa-card .actions a {
            background: var(--border);
            color: var(--primary);
        }

        .visa-card .actions button:hover,
        .visa-card .actions a:hover {
            transform: translateY(-2px);
        }

        .visa-card .actions button:hover {
            background: var(--primary-dark);
        }

        .visa-card .actions a:hover {
            background: var(--primary);
            color: #fff;
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

        .form-control:invalid[required]:not(:placeholder-shown) {
            border-color: var(--error);
        }

        .form-control.error {
            border-color: var(--error);
            animation: shake 0.3s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
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
            margin: 16px 0;
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

        /* Media Queries */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

           .step1-flex {
        grid-template-columns: 1fr; /* Stack on smaller screens */
    }
    .step1-right {
        margin-top: 24px; /* Add space when stacked */
    }

            .visa-options {
                grid-template-columns: 1fr;
            }
        }
        
        
        
        /* loader */
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

/* Alert Content for Disclaimer */
.alert-content {
    flex: 1;
}

.alert-content h5 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 12px;
}

.alert-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
    color: var(--muted);
    font-size: 0.95rem;
}

.alert-content li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 8px;
    line-height: 1.5;
}

.alert-content li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: var(--primary);
    font-size: 1.2rem;
}

.alert-content b {
    color: var(--text);
    font-weight: 600;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .alert-content h5 {
        font-size: 0.95rem;
    }

    .alert-content ul {
        font-size: 0.9rem;
    }

    .alert-content li {
        padding-left: 18px;
    }

    .alert-content li::before {
        font-size: 1rem;
        left: 0;
    }
}
.summary .flag {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    margin-right: 4px;
    vertical-align: middle;
}

    </style>
    <link href="https://unpkg.com/lucide@latest" rel="stylesheet">
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

    @if (session('success'))
        <script>
            window.paymentSuccess = true;
            window.applicationId = "{{ session('success') }}";
            @if (session('visa_id'))
                window.visaId = "{{ session('visa_id') }}";
            @endif
        </script>
    @endif
    @if (session('error'))
        <script>
            window.paymentError = "{{ session('error') }}";
        </script>
    @endif

    <div class="container">
       

        <!-- Summary Section -->
        

<div class="summary">
    <div class="summary-content" id="summaryView">
       <!-- SVG icon -->
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

<!-- Country display -->
<span style="font-weight:600;" id="fromCountryName">
  <img src="https://flagcdn.com/w20/{{ strtolower($fromCountry->code) }}.png" class="flag" alt="{{ $fromCountry->name }} flag">
  {{ $fromCountry->name }}
</span>

        <span style="color:var(--muted); font-size: 1.1rem;">→</span>
        <span style="font-weight:600;" id="toCountryName">
            <img src="https://flagcdn.com/w20/{{ strtolower($toCountry->code) }}.png" class="flag" alt="{{ $toCountry->name }} flag">
            {{ $toCountry->name }}
        </span>

        <span style="color: var(--muted); font-size: 0.95rem;" id="dateRangeText">
            {{ $dateRange }}
        </span>
    </div>

    <form id="summaryEditForm" class="summary-edit-form" action="{{ route('initial.search') }}" method="POST" autocomplete="off">
        @csrf
        <select id="editFromCountry" name="from_country" class="form-control" readonly>
            <option value="Nigeria">Nigeria</option>
        </select>
        <span style="color:var(--muted);">→</span>
        <select id="editToCountry" name="to_country" class="form-control">
            @foreach($countries->sortBy('name') as $country)
                @if(strtolower($country->name) !== 'nigeria')
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                @endif
            @endforeach
        </select>
        <input type="text" id="editDateRange" name="date_range" class="form-control" value="{{ $dateRange }}" required />
        <button type="submit" class="btn">Update</button>
        <button type="button" class="btn secondary" id="cancelEditSummary">Cancel</button>
    </form>

    <div class="actions" style="display: flex; gap: 8px;">
        <a href="#" id="editSummaryBtn" title="Change">
            <i class="lucide lucide-pencil" style="vertical-align: middle;"></i> Change
        </a>
           </div>
</div>


        <!-- Visa Requirements -->
        <div class="section">
            <h2>Visa Requirements</h2>
            <div style="color:var(--muted);margin-bottom:20px;">
                You need a visa for <b>{{ $toCountry->name }}</b> if you have a <b>{{ $fromCountry->name }}</b>
                passport.
            </div>
            <div class="visa-options">
    @forelse($visas as $visa)
        <div class="visa-card">
            <h3>{{$visa->visa_category}} Entry {{ $visa->visa_type }} Visa<span style="color:var(--muted);font-weight:400;">({{ $visa->processing_type }})</span></h3>
            <div style="color:var(--muted);font-size:0.95rem;">
                Processing: {{ $visa->processing_days }} days | Validity: {{ $visa->validity_days }} days
            </div>
            <div class="actions">
                <button class="start-application" data-visa-id="{{ $visa->id }}">Start Application</button>
            </div>
        </div>
    @empty
        <div class="no-visas" style="padding: 2rem; text-align: center; color: var(--muted);">
            <p>No visas available for the selected options right now.</p>
            <p>Please check back later or try a different filter.</p>
        </div>
    @endforelse
</div>

        </div>
        <!--note-->
       <div class="section">
    <h2>Note</h2>
    @php
        $visasWithNotes = $visas->filter(function($visa) {
            return !empty(trim($visa->note));
        });
    @endphp

    @if($visasWithNotes->isEmpty())
        <div style="color:var(--muted);margin-bottom:20px;">
            No additional notes provided.
        </div>
    @else
        @foreach($visasWithNotes as $visa)
            <div style="color:var(--muted);margin-bottom:20px;">
                {!! nl2br(e($visa->note)) !!}
            </div>
        @endforeach
    @endif
</div>


        <!-- Passport & Documents -->
        <div class="section">
            <h2>Passport & Documents</h2>
            <ul class="requirements-list">
                @php
                    $allDocuments = collect();
                    $allForms = collect();
                    
                    foreach ($visas as $visa) {
                        if ($visa->visa_documents) {
                            $allDocuments = $allDocuments->merge($visa->visa_documents);
                        }
                        if ($visa->visa_forms) {
                            $allForms = $allForms->merge($visa->visa_forms);
                        }
                    }
                    $groupedDocs = $allDocuments->groupBy('category');
                @endphp
                @if(isset($groupedDocs['visa']) || $allForms->isNotEmpty())
                    @if(isset($groupedDocs['visa']))
                        @foreach($groupedDocs['visa'] as $doc)
                            <li>
                                {{ $doc->document_name }}
                                @if($doc->description)
                                    <span style="color:var(--muted);"> - {{ $doc->description }}</span>
                                @endif
                            </li>
                        @endforeach
                    @endif
                    @foreach($allForms as $form)
                        <li>
                            {{ $form->form_name }}
                            <span style="color:var(--muted);"> - Download and fill the form </span>
                            <a href="{{ asset('public/'.$form->file_path) }}" download style="color:var(--primary);text-decoration:none;font-weight:500;">[Download]</a>
                        </li>
                    @endforeach
                @else
                    <li>No specific passport, document, or form requirements listed.</li>
                @endif
            </ul>
        </div>

        <!-- Health Requirements -->
        <div class="section">
            <h2>Health Risks & Requirements</h2>
            <ul class="requirements-list">
                @if(isset($groupedDocs['health']))
                    @foreach($groupedDocs['health'] as $doc)
                        <li>
                            {{ $doc->document_name }}
                            @if($doc->description)
                                <span style="color:var(--muted);"> - {{ $doc->description }}</span>
                            @endif
                        </li>
                    @endforeach
                @else
                    <li>No specific health requirements listed.</li>
                @endif
            </ul>
        </div>
        
        

<div class="alert">
    
    <div class="alert-content">
       <h5 style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:1rem;margin-bottom:12px;color:var(--primary);">
  <i data-feather="info"></i> Disclaimer
</h5>

        <ul>
            <li>Information is provided as guidance only and accurate at the time of publishing. Always check government websites and airline materials before booking and traveling.</li>
            <li><b>TravelWheel</b> will process visas based on the information provided in the documentation.</li>
            <li>Please note that the processing time indicated above are from the time they are submitted to the respective visa decision making authority. Processing time may vary under exceptional circumstances beyond the control of <b>TravelWheel</b>.</li>
            <li>Please note that the document/documents list shown are subject to change without prior notice. Any additional documents/information required will be communicated after careful evaluation of the application.</li>
            <li><b>TravelWheel</b> hereby declares that it does not facilitate the sale of visas.</li>
            <li>Visa is at the discretion of the embassy visa officer, and <b>TravelWheel</b> does not influence or guarantee the outcome of visa applications.</li>
            <li>Should you become aware of any visa sale or purchase transactions, please report them to <b>TravelWheel</b> management immediately, as we strictly prohibit such activities.</li>
            <li>Visas for any form of trafficking are strictly prohibited by <b>TravelWheel</b>.</li>
        </ul>
    </div>
</div>
    </div>

    <!-- Application Modal -->
    <div class="modal" id="applicationModal">
        <div class="modal-content">
            <div class="loader-overlay" id="modalLoader" style="display: none;">
                <div class="loader"></div>
            </div>
            <div class="modal-header">
                <h2>Visa Application</h2>
                <button class="modal-close" id="closeModal" aria-label="Close modal"><i data-feather="x"></i></button>
            </div>
            <div class="modal-body">
                <div class="stepper">
                    <div class="step active" id="stepper1">Details</div>
                    <div class="step" id="stepper2">Client Details</div>
                    <div class="step" id="stepper3">Payment</div>
                    <div class="step" id="stepper4">Done</div>
                </div>
                <div class="wizard-step active" id="step1">
                    <h3 style="margin-bottom:20px;">Visa Details</h3>
                    <div class="step1-flex">
                        <div class="step1-left">
                            <div id="visaDetails"></div>
                            <div id="additionalRequirements"></div>
                             <div id="visaNote" style="margin-top:16px;"></div>
                        </div>
                        <div class="step1-right">
                            <div class="currency-toggle" style="margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                                <span style="font-size:0.95rem;color:var(--muted);">Display in:</span>
                                <label class="switch">
                                    <input type="checkbox" id="currencySwitch" onchange="toggleCurrency()">
                                    <span class="slider"></span>
                                </label>
                                <span id="currencyLabel" style="font-size:0.95rem;color:var(--primary);">USD</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Passengers</label>
                                <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                    <div>
                                        <label for="adultCount" style="font-size:0.95rem;">Adult</label>
                                        <input type="number" class="form-control" id="adultCount" min="0" value="1"
                                            style="width:70px;" onchange="updatePrice()">
                                    </div>
                                    <div>
                                        <label for="childCount" style="font-size:0.95rem;">Child</label>
                                        <input type="number" class="form-control" id="childCount" min="0" value="0"
                                            style="width:70px;" onchange="updatePrice()">
                                    </div>
                                    <div>
                                        <label for="infantCount" style="font-size:0.95rem;">Infant</label>
                                        <input type="number" class="form-control" id="infantCount" min="0" value="0"
                                            style="width:70px;" onchange="updatePrice()">
                                    </div>
                                </div>
                            </div>
                            <div class="price" id="totalPrice">0 USD</div>
                            <div id="priceBreakdown" style="font-size:0.95rem;color:var(--muted);margin-bottom:20px;">
                            </div>
                            <button class="btn" id="startApplicationBtn" style="width:100%;" disabled>Start
                                Application</button>
                        </div>
                    </div>
                </div>
                <div class="wizard-step" id="step2">
                    <div id="passengerProgress" style="margin-bottom:16px;color:var(--muted);font-size:0.95rem;"></div>
                    <div id="subStepProgress" style="margin-bottom:20px;">
                        <div style="display:flex;gap:8px;align-items:center;">
                            <div id="subStepDots" style="flex:1;"></div>
                        </div>
                    </div>
                    @if (!empty($allForms))
                        <ul id="formDownloadList">
                            @foreach($allForms as $form)
                                <li>
                                    {{ $form->form_name }}
                                    <span style="color:var(--muted);"> - Download and fill the form (ignore if you have) </span>
                                    <a href="{{ asset('public/'.$form->file_path) }}" download style="color:var(--primary);text-decoration:none;font-weight:500;">[Download]</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <form id="kycForm" autocomplete="off">
                        <div id="passengerFormContainer"></div>
                        <div id="documentUploads" style="margin-top:20px;"></div>
                        <div id="additionalUploads" style="margin-top:20px;"></div>
                        <div style="margin-top:24px;display:flex;gap:12px;">
                            <button class="btn" type="button" id="nextSubStep">Next</button>
                            <button class="btn secondary" type="button" id="prevSubStep"
                                style="display:none;">Back</button>
                            <button class="btn secondary" type="button" id="backToStep1" style="display:none;">Back to details</button>
                        </div>
                    </form>
                </div>
                <div class="wizard-step" id="step3">
                    <h3 style="margin-bottom:20px;">Payment</h3>
                    <div class="price" id="paymentTotal">0 USD</div>
                    <button class="btn" type="button" id="payWithSeerbit">Pay with Seerbit</button>
                    <div id="paymentStatus" style="color:var(--muted);margin:20px 0;"></div>
                    <button class="btn secondary" type="button" id="backToKYC">Back</button>
                </div>
                <div class="wizard-step" id="step4">
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
 <script type="module" >

      import { getCountries, getStatesByShort } from 'countrycitystatejson';
</script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        feather.replace();

        let currentStep = 1;
        let visaData = {};
        let passengerData = [];
        let currentPassenger = 0;
        let currentSubStep = 0;
        let subSteps = [];

        function getDateRangeFromURL() {
            const params = new URLSearchParams(window.location.search);
            const dateRange = params.get('date_range');
            if (dateRange) {
                const decoded = decodeURIComponent(dateRange);
                const [startDate, endDate] = decoded.split(' to ').map(date => date.trim());
                return { startDate, endDate };
            }
            return { startDate: null, endDate: null };
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
        const modal = document.getElementById('applicationModal');
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
            passengerData = [];
            currentPassenger = 0;
            currentSubStep = 0;
            currentStep = 1;
            updateStepper();
            document.getElementById('adultCount').value = 1;
            document.getElementById('childCount').value = 0;
            document.getElementById('infantCount').value = 0;
            updatePrice();
        });
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                confirmModal.classList.add('active');
            }
            if (e.target === confirmModal) {
                confirmModal.classList.remove('active');
            }
        });

        function updateStepper() {
            for (let i = 1; i <= 4; i++) {
                                document.getElementById('currencyLabel').textContent = visaData.currency;
            const step = document.getElementById(`stepper${i}`);
                step.classList.remove('active', 'completed');
                if (i < currentStep) step.classList.add('completed');
                if (i === currentStep) step.classList.add('active');
            }
        }

        function nextStep() {
            const currentStepElement = document.getElementById(`step${currentStep}`);
            currentStepElement.classList.remove('active');
            currentStep++;
            const nextStepElement = document.getElementById(`step${currentStep}`);
            nextStepElement.classList.add('active');
            updateStepper();
            if (currentStep === 2) updateKYCStep();
            if (currentStep === 3) initializePayment();
        }

        function prevStep() {
            const currentStepElement = document.getElementById(`step${currentStep}`);
            currentStepElement.classList.remove('active');
            currentStep--;
            const prevStepElement = document.getElementById(`step${currentStep}`);
            prevStepElement.classList.add('active');
            updateStepper();
        }

function initStartApplicationHandlers() {
    document.querySelectorAll('.start-application').forEach(button => {
        button.addEventListener('click', function () {
            const visaId = this.getAttribute('data-visa-id');
            console.log(visaId);
            const loader = document.getElementById('modalLoader');
            loader.style.display = 'flex';
            modal.classList.add('active');
            fetch(`/visa/${visaId}/details`)
                .then(response => response.json())
                .then(data => {
                    visaData = data;
                    visaData.visa_forms = data.visa_forms || [];
                    // Set default input values
                    document.getElementById('adultCount').value = 1;
                    document.getElementById('childCount').value = 0;
                    document.getElementById('infantCount').value = 0;
                    // Update visa details and price
                    updateVisaDetails();
                    updatePrice(); // Call updatePrice to reflect default values
                    currentStep = 1;
                    for (let i = 1; i <= 4; i++) {
                        document.getElementById(`step${i}`).classList.remove('active');
                    }
                    document.getElementById('step1').classList.add('active');
                    updateStepper();
                    loader.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error fetching visa details:', error);
                    loader.style.display = 'none';
                    modal.classList.remove('active');
                    alert('Failed to load visa details. Please try again.');
                });
        });
    });
}
 
        let isNaira = false;

        function toggleCurrency() {
            isNaira = !isNaira;
            document.getElementById('currencyLabel').textContent = isNaira ? 'NGN' : visaData.currency;
            updatePrice();
        }
        // New function to update fee display in visaDetails
function updateFeeDisplay() {
    const currencySymbols = {
        'NGN': '₦',
        'USD': '$',
        'GBP': '£',
        'EURO': '€',
        'EUR': '€'
    };

    const currencySymbol = currencySymbols[visaData.currency?.toUpperCase()] || '';
    const details = document.getElementById('visaDetails');
    const adultCount = parseInt(document.getElementById('adultCount').value) || 0;
    const childCount = parseInt(document.getElementById('childCount').value) || 0;
    const infantCount = parseInt(document.getElementById('infantCount').value) || 0;
    const safeParse = (value, defaultValue = 0) => {
        const parsed = parseFloat(value);
        return isNaN(parsed) ? defaultValue : parsed;
    };

    // Reset fees section
    let feesHtml = '';

    // Populate other charges (non-embassy)
    if (visaData.charges && visaData.charges.length > 0) {
        const nonEmbassyCharges = visaData.charges.filter(charge => !charge.pay_to_embassy);
        if (nonEmbassyCharges.length > 0) {
            feesHtml += `<div style='margin-top:12px;'><b>Other Charges:</b><ul style='margin:8px 0 0 20px;padding:0;color:var(--muted);font-size:0.95rem;'>${nonEmbassyCharges.map(charge => {
                let amount = safeParse(charge.amount);
                if (charge.traveler_type === 'adult') amount *= adultCount;
                else if (charge.traveler_type === 'child') amount *= childCount;
                else if (charge.traveler_type === 'infant') amount *= infantCount;
                return `<li>${charge.charge_name}: ${isNaira ? '₦' : currencySymbol}${(isNaira ? amount * visaData.rate : amount).toFixed(2)}${charge.note ? ' <span class="tooltip"><i data-feather="info" style="width:14px;height:14px;"></i><span class="tooltip-text">${charge.note}</span></span>' : ''}</li>`;
            }).join('')}</ul></div>`;
        }
    }

    // Populate embassy fees
    const embassyCharges = visaData.charges ? visaData.charges.filter(charge => charge.pay_to_embassy) : [];
    const hasEmbassyFees = embassyCharges.length > 0 || visaData.pay_visa_to_embassy || visaData.pay_bio_to_embassy;

    if (hasEmbassyFees) {
        feesHtml += `<div style='margin-top:12px;'><b>Embassy Fees:</b><ul style='margin:8px 0 0 20px;padding:0;color:var(--muted);font-size:0.95rem;'>`;

        // Embassy charges
        if (embassyCharges.length > 0) {
            feesHtml += embassyCharges.map(charge => {
                let amount = safeParse(charge.amount);
                if (charge.traveler_type === 'adult') amount *= adultCount;
                else if (charge.traveler_type === 'child') amount *= childCount;
                else if (charge.traveler_type === 'infant') amount *= infantCount;
                return `<li>${charge.charge_name}: ${isNaira ? '₦' : currencySymbol}${(isNaira ? amount * visaData.rate : amount).toFixed(2)}${charge.note ? ' <span class="tooltip"><i data-feather="info" style="width:14px;height:14px;"></i><span class="tooltip-text">${charge.note}</span></span>' : ''}</li>`;
            }).join('');
        }

        // Visa fees to embassy
        if (visaData.pay_visa_to_embassy) {
            if (visaData.visa_fee_adult && adultCount > 0) {
                const fee = safeParse(visaData.visa_fee_adult) * adultCount;
                feesHtml += `<li>Adult Visa Fee (${adultCount}): ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)}</li>`;
            }
            if (visaData.visa_fee_child && childCount > 0) {
                const fee = safeParse(visaData.visa_fee_child) * childCount;
                feesHtml += `<li>Child Visa Fee (${childCount}): ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)}</li>`;
            }
            if (visaData.visa_fee_infant && infantCount > 0) {
                const fee = safeParse(visaData.visa_fee_infant) * infantCount;
                feesHtml += `<li>Infant Visa Fee (${infantCount}): ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)}</li>`;
            }
        }

        // Biometrics fees to embassy
        if (visaData.pay_bio_to_embassy) {
            if (visaData.biometrics_fee_adult && adultCount > 0) {
                const fee = safeParse(visaData.biometrics_fee_adult) * adultCount;
                feesHtml += `<li>Adult Biometrics Fee (${adultCount}): ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)}</li>`;
            }
            if (visaData.biometrics_fee_child && childCount > 0) {
                const fee = safeParse(visaData.biometrics_fee_child) * childCount;
                feesHtml += `<li>Child Biometrics Fee (${childCount}): ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)}</li>`;
            }
            if (visaData.biometrics_fee_infant && infantCount > 0) {
                const fee = safeParse(visaData.biometrics_fee_infant) * infantCount;
                feesHtml += `<li>Infant Biometrics Fee (${infantCount}): ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)}</li>`;
            }
        }

        feesHtml += `</ul></div>`;
    }

    // Update the fees section in visaDetails
    details.innerHTML = `
        <div style='color:var(--muted);margin-bottom:10px;'>Type: <b>${visaData.visa_type}</b> (${visaData.processing_type})</div>
        <div style='color:var(--muted);margin-bottom:10px;'>Processing: ${visaData.processing_days} days</div>
        <div style='color:var(--muted);margin-bottom:10px;'>Validity: ${visaData.validity_days} days</div>
        ${feesHtml}
    `;

    // Call feather.replace only for new icons
    feather.replace({ 'data-feather': 'info' });
}

function updateVisaDetails() {
    const visaNote = document.getElementById('visaNote');

    // Populate note if it exists
    if (visaData.note) {
        visaNote.innerHTML = `
            <h4 style="font-weight:600;font-size:0.95rem;">Important Note</h4>
            <div style="color:var(--muted);font-size:0.95rem;">${visaData.note.replace(/\n/g, '<br>')}</div>
        `;
    } else {
        visaNote.innerHTML = '';
    }

    // Update fees and other details
    updateFeeDisplay();
    updateAdditionalRequirements();
}

function updatePrice() {
    const currencySymbols = {
        'NGN': '₦',
        'USD': '$',
        'GBP': '£',
        'EURO': '€',
        'EUR': '€'
    };

    const currencySymbol = currencySymbols[visaData.currency?.toUpperCase()] || '$';
    const adultCount = parseInt(document.getElementById('adultCount').value) || 0;
    const childCount = parseInt(document.getElementById('childCount').value) || 0;
    const infantCount = parseInt(document.getElementById('infantCount').value) || 0;
    const totalPassengers = adultCount + childCount + infantCount;
    let totalUSD = 0;
    let breakdown = [];

    const safeParse = (value, defaultValue = 0) => {
        const parsed = parseFloat(value);
        return isNaN(parsed) ? defaultValue : parsed;
    };

    // Include visa fees only if pay_visa_to_embassy is false
    if (!visaData.pay_visa_to_embassy) {
        if (visaData.visa_fee_adult && adultCount > 0) {
            const fee = safeParse(visaData.visa_fee_adult);
            const total = fee * adultCount;
            breakdown.push(`${adultCount} Adult x ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)} = ${isNaira ? '₦' : currencySymbol}${(isNaira ? total * visaData.rate : total).toFixed(2)}`);
            totalUSD += total;
        }
        if (visaData.visa_fee_child && childCount > 0) {
            const fee = safeParse(visaData.visa_fee_child);
            const total = fee * childCount;
            breakdown.push(`${childCount} Child x ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)} = ${isNaira ? '₦' : currencySymbol}${(isNaira ? total * visaData.rate : total).toFixed(2)}`);
            totalUSD += total;
        }
        if (visaData.visa_fee_infant && infantCount > 0) {
            const fee = safeParse(visaData.visa_fee_infant);
            const total = fee * infantCount;
            breakdown.push(`${infantCount} Infant x ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)} = ${isNaira ? '₦' : currencySymbol}${(isNaira ? total * visaData.rate : total).toFixed(2)}`);
            totalUSD += total;
        }
    }

    // Include biometrics fees only if pay_bio_to_embassy is false
    if (!visaData.pay_bio_to_embassy) {
        if (visaData.biometrics_fee_adult && adultCount > 0) {
            const fee = safeParse(visaData.biometrics_fee_adult);
            const total = fee * adultCount;
            breakdown.push(`${adultCount} Adult Biometrics x ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)} = ${isNaira ? '₦' : currencySymbol}${(isNaira ? total * visaData.rate : total).toFixed(2)}`);
            totalUSD += total;
        }
        if (visaData.biometrics_fee_child && childCount > 0) {
            const fee = safeParse(visaData.biometrics_fee_child);
            const total = fee * childCount;
            breakdown.push(`${childCount} Child Biometrics x ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)} = ${isNaira ? '₦' : currencySymbol}${(isNaira ? total * visaData.rate : total).toFixed(2)}`);
            totalUSD += total;
        }
        if (visaData.biometrics_fee_infant && infantCount > 0) {
            const fee = safeParse(visaData.biometrics_fee_infant);
            const total = fee * infantCount;
            breakdown.push(`${infantCount} Infant Biometrics x ${isNaira ? '₦' : currencySymbol}${(isNaira ? fee * visaData.rate : fee).toFixed(2)} = ${isNaira ? '₦' : currencySymbol}${(isNaira ? total * visaData.rate : total).toFixed(2)}`);
            totalUSD += total;
        }
    }

    // Admin fee (scaled by totalPassengers)
    if (visaData.admin_fee && totalPassengers > 0) {
        const adminFee = safeParse(visaData.admin_fee);
        const totalAdminFee = adminFee * totalPassengers; // Scale by number of passengers
        breakdown.push(`Admin Fee (${totalPassengers} passengers): ${isNaira ? '₦' : currencySymbol}${(isNaira ? totalAdminFee * visaData.rate : totalAdminFee).toFixed(2)}`);
        totalUSD += totalAdminFee;
    }

    // Include only non-embassy charges
    if (visaData.charges && visaData.charges.length > 0) {
        visaData.charges.forEach(charge => {
            if (!charge.pay_to_embassy) {
                let chargeAmount = safeParse(charge.amount);
                let show = true;
                if (charge.traveler_type === 'adult' && adultCount > 0) {
                    chargeAmount *= adultCount;
                } else if (charge.traveler_type === 'child' && childCount > 0) {
                    chargeAmount *= childCount;
                } else if (charge.traveler_type === 'infant' && infantCount > 0) {
                    chargeAmount *= infantCount;
                } else if (charge.traveler_type && ((charge.traveler_type === 'adult' && adultCount === 0) || (charge.traveler_type === 'child' && childCount === 0) || (charge.traveler_type === 'infant' && infantCount === 0))) {
                    show = false;
                }
                if (show && chargeAmount > 0) {
                    breakdown.push(`${charge.charge_name}: ${isNaira ? '₦' : currencySymbol}${(isNaira ? chargeAmount * visaData.rate : chargeAmount).toFixed(2)}${charge.note ? ' (' + charge.note + ')' : ''}`);
                    totalUSD += chargeAmount;
                }
            }
        });
    }

    // Additional service fees
    if (document.getElementById('handleFlight')?.checked) {
        const flightFee = 50 * totalPassengers;
        breakdown.push(`Flight Service Fee: ${isNaira ? '₦' : currencySymbol}${(isNaira ? flightFee * visaData.rate : flightFee).toFixed(2)}`);
        totalUSD += flightFee;
    }
    if (document.getElementById('handleHotel')?.checked) {
        const hotelFee = 70 * totalPassengers;
        breakdown.push(`Hotel Service Fee: ${isNaira ? '₦' : currencySymbol}${(isNaira ? hotelFee * visaData.rate : hotelFee).toFixed(2)}`);
        totalUSD += hotelFee;
    }
    if (document.getElementById('handleInsurance')?.checked && visaData.requires_insurance) {
        const insurancePrice = safeParse(document.getElementById('insuranceOption')?.value);
        if (insurancePrice > 0) {
            const insuranceTotal = insurancePrice * totalPassengers;
            breakdown.push(`Insurance: ${isNaira ? '₦' : currencySymbol}${(isNaira ? insuranceTotal * visaData.rate : insuranceTotal).toFixed(2)}`);
            totalUSD += insuranceTotal;
        }
    }

    // Update total price and breakdown
    document.getElementById('totalPrice').textContent = `${isNaira ? '₦' : currencySymbol}${isNaira ? (totalUSD * visaData.rate).toFixed(2) : totalUSD.toFixed(2)}`;
    document.getElementById('paymentTotal').textContent = `${isNaira ? '₦' : currencySymbol}${isNaira ? (totalUSD * visaData.rate).toFixed(2) : totalUSD.toFixed(2)}`;
    document.getElementById('priceBreakdown').innerHTML = breakdown
        .filter(item => !item.startsWith('0 '))
        .map(item => `<div style="animation:fadeIn 0.3s;">${item}</div>`).join('');

    // Enable/disable Start Application button
    document.getElementById('startApplicationBtn').disabled = totalPassengers === 0;

    // Update visa details to reflect the new price breakdown
    updateFeeDisplay();
}

        function updateAdditionalRequirements() {
            const reqDiv = document.getElementById('additionalRequirements');
            reqDiv.innerHTML = '';
            if (visaData.requires_flight || visaData.requires_hotel || visaData.requires_insurance) {
                reqDiv.innerHTML += '<div style="margin-top:16px;font-weight:600;font-size:0.95rem;">Additional Requirements</div>';
                if (visaData.requires_flight) {
                    reqDiv.innerHTML += `
                        <div style="margin-top:10px;">
                            <input type="checkbox" id="handleFlight" onchange="updatePrice()">
                            <label for="handleFlight" style="font-size:0.95rem;">Let Travelwheel handle Flight Itinerary ($50 service fee per passenger)</label>
                        </div>
                    `;
                }
                if (visaData.requires_hotel) {
                    reqDiv.innerHTML += `
                        <div style="margin-top:10px;">
                            <input type="checkbox" id="handleHotel" onchange="updatePrice()">
                            <label for="handleHotel" style="font-size:0.95rem;">Let Travelwheel handle Hotel Reservation ($70 service fee per passenger)</label>
                        </div>
                    `;
                }
                if (visaData.requires_insurance) {
                    reqDiv.innerHTML += `
                        <div style="margin-top:10px;">
                            <input type="checkbox" id="handleInsurance" onchange="toggleInsuranceOption()">
                            <label for="handleInsurance" style="font-size:0.95rem;">Let Travelwheel handle Insurance</label>
                        </div>
                        <div id="insuranceOptionContainer" style="display:none;margin-top:10px;">
                            <label class="form-label">Select Insurance Plan:</label>
                            <select id="insuranceOption" class="form-select" onchange="updatePrice()">
                                ${visaData.insurance_options.map(opt => `<option value="${opt.price}">${opt.coverage_days} days - $${opt.price}</option>`).join('')}
                            </select>
                        </div>
                    `;
                }
            }
        }

        function toggleInsuranceOption() {
            const handleInsurance = document.getElementById('handleInsurance');
            const insuranceOptionContainer = document.getElementById('insuranceOptionContainer');
            insuranceOptionContainer.style.display = handleInsurance.checked ? 'block' : 'none';
            if (!handleInsurance.checked) {
                document.getElementById('insuranceOption').value = visaData.insurance_options[0].price;
            }
            updatePrice();
        }

        function updateKYCStep() {
            const adultCount = parseInt(document.getElementById('adultCount').value) || 0;
            const childCount = parseInt(document.getElementById('childCount').value) || 0;
            const infantCount = parseInt(document.getElementById('infantCount').value) || 0;
            const totalPassengers = adultCount + childCount + infantCount;

            if (totalPassengers === 0) {
                alert('Please select at least one passenger.');
                prevStep();
                return;
            }

            passengerData = Array(totalPassengers).fill().map((_, i) => ({
                type: i < adultCount ? 'Adult' : (i < adultCount + childCount ? 'Child' : 'Infant'),
                data: {}
            }));

            currentPassenger = 0;
            currentSubStep = 0;
            renderPassengerForm();
        }

        function populateCountrySelect(selectElement) {
    fetch('https://restcountries.com/v3.1/all?fields=name')
        .then(res => {
            if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
            return res.json();
        })
        .then(data => {
            selectElement.innerHTML = '<option value="">-- Select Country --</option>';
            data.sort((a, b) => a.name.common.localeCompare(b.name.common)).forEach(c => {
                const option = document.createElement('option');
                option.value = c.name.common;
                option.textContent = c.name.common;
                selectElement.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching countries:', error);
            selectElement.innerHTML = '<option value="">Failed to load countries</option>';
            alert('Unable to load country list. Please try again later.');
        });
}

const countries = getCountries(); // List of countries with short codes

function populateStateSelect(countrySelect, stateSelect) {
  countrySelect.addEventListener('change', async () => {
    stateSelect.innerHTML = '<option value="">-- Select State --</option>';
    const short = "NG"; // e.g.  for Nigeria
    if (!short) return;
    const states = getStatesByShort(short);
    states.forEach(s => {
      const opt = document.createElement('option');
      opt.value = s;
      opt.textContent = s;
      stateSelect.appendChild(opt);
    });
  });
}



        function defineSubSteps(passengerIndex) {
            const passengerType = passengerData[passengerIndex].type;
            const isMinor = passengerType === 'Child' || passengerType === 'Infant';
            const { startDate, endDate } = getDateRangeFromURL();

            if (visaData.visa_forms && visaData.visa_forms.length > 0) {
                // Simplified KYC for downloadable forms
                subSteps = [
                    [
                        { id: `full_name_${passengerIndex}`, label: 'Full Name', name: `full_name`, type: 'text', required: true },
                        { id: `email_${passengerIndex}`, label: 'Email Address', name: `email`, type: 'email', required: true }
                    ]
                ];
            } else {
                // Full KYC form
                subSteps = [
                    [
                        { id: `surname_${passengerIndex}`, label: 'Surname', name: `passengers[${passengerIndex}][surname]`, type: 'text', required: true },
                        { id: `first_name_${passengerIndex}`, label: 'First Name', name: `passengers[${passengerIndex}][first_name]`, type: 'text', required: true },
                        { id: `gender_${passengerIndex}`, label: 'Gender', name: `passengers[${passengerIndex}][sex]`, type: 'radio', options: [{ value: 'male', label: 'Male' }, { value: 'female', label: 'Female' }], required: true }
                    ],
                    [
                        { id: `dob_${passengerIndex}`, label: 'Date of Birth', name: `passengers[${passengerIndex}][date_of_birth]`, type: 'date', required: true },
                        { id: `nationality_${passengerIndex}`, label: 'Current Nationality', name: `passengers[${passengerIndex}][current_nationality]`, type: 'select', options: [], required: true },
                        { id: `pob_${passengerIndex}`, label: 'Place of Birth', name: `passengers[${passengerIndex}][place_of_birth]`, type: 'select', options: [], required: true }
                    ],
                    [
                        { id: `passport_no_${passengerIndex}`, label: 'Passport Number', name: `passengers[${passengerIndex}][passport_number]`, type: 'text', required: true },
                        { id: `passport_type_${passengerIndex}`, label: 'Passport Type', name: `passengers[${passengerIndex}][passport_type]`, type: 'select', options: [
                            { value: 'standard', label: 'Standard' },
                            { value: 'diplomatic', label: 'Diplomatic' },
                            { value: 'official', label: 'Official' },
                            { value: 'emergency', label: 'Emergency Travel Certificate' }
                        ], required: true },
                        { id: `passport_issuance_${passengerIndex}`, label: 'Passport Issuance Date', name: `passengers[${passengerIndex}][passport_issuance_date]`, type: 'date', required: true },
                        { id: `passport_expiry_${passengerIndex}`, label: 'Passport Expiry Date', name: `passengers[${passengerIndex}][passport_expiry_date]`, type: 'date', required: true },
                        { id: `issuing_country_${passengerIndex}`, label: 'Issuing Country', name: `passengers[${passengerIndex}][issued_by_country]`, type: 'select', options: [], required: true }
                    ],
                    [
                        { id: `email_${passengerIndex}`, label: 'Email Address', name: `passengers[${passengerIndex}][email_address]`, type: 'email', required: true },
                        { id: `phone_${passengerIndex}`, label: 'Phone Number', name: `passengers[${passengerIndex}][telephone_number]`, type: 'tel', required: true },
                        { id: `address_${passengerIndex}`, label: 'Home Address', name: `passengers[${passengerIndex}][home_address]`, type: 'text', required: true }
                    ],
                    [
                        { id: `travel_purpose_${passengerIndex}`, label: 'Purpose of Travel', name: `passengers[${passengerIndex}][purpose_of_journey]`, type: 'radio', options: [{ value: 'tourism', label: 'Tourism' }, { value: 'business', label: 'Business' }, { value: 'visiting', label: 'Visiting' }], required: true },
                        { id: `arrival_date_${passengerIndex}`, label: 'Intended Arrival Date', name: `passengers[${passengerIndex}][intended_arrival_date]`, type: 'date', required: true, defaultValue: startDate },
                        { id: `departure_date_${passengerIndex}`, label: 'Intended Departure Date', name: `passengers[${passengerIndex}][intended_departure_date]`, type: 'date', required: true, defaultValue: endDate }
                    ]
                ];

                if (isMinor) {
                    subSteps.push([
                        { id: `guardian_surname_${passengerIndex}`, label: 'Guardian Surname', name: `passengers[${passengerIndex}][guardian_surname]`, type: 'text', required: true },
                        { id: `guardian_first_name_${passengerIndex}`, label: 'Guardian First Name', name: `passengers[${passengerIndex}][guardian_first_name]`, type: 'text', required: true },
                        { id: `guardian_phone_${passengerIndex}`, label: 'Guardian Phone Number', name: `passengers[${passengerIndex}][guardian_number]`, type: 'tel', required: true }
                    ]);
                }
            }

            subSteps.push([]); // Document uploads
        }

        function renderPassengerForm() {
    const totalPassengers = passengerData.length;
    const passengerType = passengerData[currentPassenger].type;

    document.getElementById('passengerProgress').textContent = `Passenger ${currentPassenger + 1} of ${totalPassengers} (${passengerType})`;
    defineSubSteps(currentPassenger);

    const dotsContainer = document.getElementById('subStepDots');
    dotsContainer.innerHTML = subSteps.map((_, i) => `<span class="sub-step-dot ${i === currentSubStep ? 'active' : ''}"></span>`).join('');

    // Update visibility of buttons
    document.getElementById('prevSubStep').style.display = currentSubStep > 0 || currentPassenger > 0 ? 'inline-block' : 'none';
    document.getElementById('nextSubStep').textContent = (currentSubStep === subSteps.length - 1 && currentPassenger === passengerData.length - 1) ? 'Continue' : 'Next';
    // Show "Back to Step 1" button only on first sub-step of first passenger
    document.getElementById('backToStep1').style.display = (currentSubStep === 0 && currentPassenger === 0) ? 'inline-block' : 'none';

    const container = document.getElementById('passengerFormContainer');
    container.innerHTML = '';
    const docDiv = document.getElementById('documentUploads');
    const uploadDiv = document.getElementById('additionalUploads');
    const fields = subSteps[currentSubStep];

    if (fields.length > 0) {
        docDiv.innerHTML = '';
        uploadDiv.innerHTML = '';
    }

    if (fields.length === 0) {
        renderDocumentUploads();
    } else {
        fields.forEach(field => {
            let html = `<div class="form-group">
                <label class="form-label" for="${field.id}">${field.label}${field.required ? ' <span style="color:var(--error);">*</span>' : ''}</label>`;
            if (field.type === 'text' || field.type === 'email' || field.type === 'tel' || field.type === 'date') {
                html += `<input type="${field.type}" class="form-control" id="${field.id}" name="${field.name}" ${field.required ? 'required' : ''} value="${passengerData[currentPassenger].data[field.name] || ''}">`;
            } else if (field.type === 'select') {
                html += `<select class="form-select" id="${field.id}" name="${field.name}" ${field.required ? 'required' : ''}>
                    <option value="">-- Select ${field.label} --</option>`;
                if (field.options && field.options.length > 0) {
                    field.options.forEach(opt => {
                        html += `<option value="${opt.value}" ${passengerData[currentPassenger].data[field.name] === opt.value ? 'selected' : ''}>${opt.label}</option>`;
                    });
                }
                html += `</select>`;
            } else if (field.type === 'radio') {
                html += `<fieldset><legend style="display:none;">${field.label}</legend><div style="display:flex;gap:16px;flex-wrap:wrap;">${field.options.map(opt => `
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="${field.name}" id="${field.id}_${opt.value}" value="${opt.value}" ${passengerData[currentPassenger].data[field.name] === opt.value ? 'checked' : ''} ${field.required ? 'required' : ''}>
                        <label class="form-check-label" for="${field.id}_${opt.value}" style="font-size:0.95rem;">${opt.label}</label>
                    </div>`).join('')}</div></fieldset>`;
            }
            html += `</div>`;
            container.innerHTML += html;
        });

        // Populate country and state selects
        fields.forEach(field => {
            if (field.type === 'select' && (field.label.includes('Nationality') || field.label.includes('Issuing Country'))) {
                const select = document.getElementById(field.id);
                populateCountrySelect(select);
            } else if (field.type === 'select' && field.label.includes('Place of Birth')) {
                const nationalityFieldId = `nationality_${currentPassenger}`;
                const nationalitySelect = document.getElementById(nationalityFieldId);
                const stateSelect = document.getElementById(field.id);
                populateStateSelect(nationalitySelect, stateSelect);
            }
        });

        // Initialize Flatpickr for date fields
        document.querySelectorAll('input[type="date"]').forEach(input => {
            const passengerIndex = input.id.match(/\d+/)?.[0] || 0;
            const isDateOfBirth = input.id.includes('dob_');
            const isPassportIssuance = input.id.includes('passport_issuance_');
            const isPassportExpiry = input.id.includes('passport_expiry_');
            const isArrivalDate = input.id.includes('arrival_date_');
            const isDepartureDate = input.id.includes('departure_date_');
            const { startDate, endDate } = getDateRangeFromURL();
            const today = new Date();
            const maxPassportValidity = 10 * 365 * 24 * 60 * 60 * 1000;
            const maxAge = 100 * 365 * 24 * 60 * 60 * 1000;
            const maxPassportIssuance = 20 * 365 * 24 * 60 * 60 * 1000;

            let flatpickrConfig = {
                dateFormat: 'm/d/Y',
                animate: true,
                onChange: function(selectedDates, dateStr, instance) {
                    const issuanceInput = document.getElementById(`passport_issuance_${passengerIndex}`);
                    const expiryInput = document.getElementById(`passport_expiry_${passengerIndex}`);
                    const arrivalInput = document.getElementById(`arrival_date_${passengerIndex}`);
                    const departureInput = document.getElementById(`departure_date_${passengerIndex}`);

                    if ((isPassportIssuance || isPassportExpiry) && issuanceInput && expiryInput) {
                        validatePassportDates(issuanceInput, expiryInput);
                    }

                    if (isArrivalDate && departureInput) {
                        const arrivalDate = selectedDates[0];
                        if (arrivalDate) {
                            const maxDate = new Date(arrivalDate);
                            maxDate.setDate(arrivalDate.getDate() + (visaData.validity_days || 30));
                            flatpickr(departureInput, {
                                dateFormat: 'm/d/Y',
                                animate: true,
                                minDate: arrivalDate,
                                maxDate: maxDate,
                                defaultDate: departureInput.value || endDate
                            });
                        }
                    }
                }
            };

            if (isDateOfBirth) {
                flatpickrConfig.maxDate = 'today';
                flatpickrConfig.minDate = new Date(today.getTime() - maxAge);
                flatpickrConfig.defaultDate = input.value || '';
            } else if (isPassportIssuance) {
                flatpickrConfig.maxDate = 'today';
                flatpickrConfig.minDate = new Date(today.getTime() - maxPassportIssuance);
                flatpickrConfig.defaultDate = input.value || '';
            } else if (isPassportExpiry) {
                const issuanceInput = document.getElementById(`passport_issuance_${passengerIndex}`);
                const issuanceDate = issuanceInput && issuanceInput.value ? new Date(issuanceInput.value) : null;
                flatpickrConfig.minDate = issuanceDate && !isNaN(issuanceDate.getTime()) ? issuanceDate : new Date(today.getTime() - maxPassportIssuance);
                flatpickrConfig.maxDate = new Date(today.getTime() + maxPassportValidity);
                flatpickrConfig.defaultDate = input.value || '';
            } else if (isArrivalDate) {
                flatpickrConfig.minDate = 'today';
                flatpickrConfig.defaultDate = input.value || startDate;
            } else if (isDepartureDate) {
                const arrivalInput = document.getElementById(`arrival_date_${passengerIndex}`);
                const arrivalDate = arrivalInput && arrivalInput.value ? new Date(arrivalInput.value) : (startDate ? new Date(startDate) : today);
                if (arrivalDate && !isNaN(arrivalDate.getTime())) {
                    flatpickrConfig.minDate = arrivalDate;
                    flatpickrConfig.maxDate = new Date(arrivalDate.getTime());
                    flatpickrConfig.maxDate.setDate(arrivalDate.getDate() + (visaData.validity_days || 30));
                    flatpickrConfig.defaultDate = input.value || endDate;
                }
            }

            flatpickr(input, flatpickrConfig);
        });
    }
}

// Add event listener for the "Back to Step 1" button
document.getElementById('backToStep1').addEventListener('click', () => {
    // Clear any entered data for the current passenger
    passengerData[currentPassenger].data = {};
    prevStep();
});

        function validatePassportDates(issuanceInput, expiryInput) {
            const issuanceDate = new Date(issuanceInput.value);
            const expiryDate = new Date(expiryInput.value);
            const warningDiv = issuanceInput.parentElement.querySelector('.date-warning') || document.createElement('div');
            warningDiv.className = 'date-warning';
            warningDiv.style.color = 'var(--error)';
            warningDiv.style.fontSize = '0.9rem';
            warningDiv.style.marginTop = '4px';

            if (issuanceDate && expiryDate && issuanceDate < expiryDate) {
                const yearsDiff = (expiryDate - issuanceDate) / (1000 * 60 * 60 * 24 * 365);
                const isWholeYears = Math.abs(yearsDiff - Math.round(yearsDiff)) < 0.01;
                const sameDayMonth = issuanceDate.getDate() === expiryDate.getDate() && issuanceDate.getMonth() === expiryDate.getMonth();

                if (!isWholeYears || !sameDayMonth) {
                    warningDiv.textContent = 'Warning: Are you sure you entered the issue/expiry dates correctly? Most passports have an issue day the same day as the expiry day. For example: Jan 1, 2023 to Jan 1, 2033';
                    if (!issuanceInput.parentElement.contains(warningDiv)) {
                        issuanceInput.parentElement.appendChild(warningDiv);
                    }
                } else {
                    warningDiv.remove();
                }
            } else if (issuanceDate >= expiryDate) {
                warningDiv.textContent = 'Error: Issuance date must be before expiry date.';
                if (!issuanceInput.parentElement.contains(warningDiv)) {
                    issuanceInput.parentElement.appendChild(warningDiv);
                }
            } else {
                warningDiv.remove();
            }
        }

        function renderDocumentUploads() {
            const docDiv = document.getElementById('documentUploads');
            const uploadDiv = document.getElementById('additionalUploads');
            docDiv.innerHTML = '';
            uploadDiv.innerHTML = '';

            if (visaData.visa_documents && visaData.visa_documents.length > 0) {
                docDiv.innerHTML = visaData.visa_documents.map(doc => `
                    <div class="form-group">
                        <label class="form-label" for="doc_${doc.id}_${currentPassenger}">${doc.document_name}${doc.required ? ' <span style="color:var(--error);">*</span>' : ''}</label>
                        <input type="file" class="form-control" id="doc_${doc.id}_${currentPassenger}" name="documents[${currentPassenger}][${doc.id}]" ${doc.required ? 'required' : ''} accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                `).join('');
            }

            if (visaData.visa_forms && visaData.visa_forms.length > 0) {
                docDiv.innerHTML += visaData.visa_forms.map(form => `
                    <div class="form-group">
                        <label class="form-label" for="form_${form.id}_${currentPassenger}">${form.form_name} (Filled Form)<span style="color:var(--error);">*</span></label>
                        <input type="file" class="form-control" id="form_${form.id}_${currentPassenger}" name="forms[${currentPassenger}][${form.id}]" required accept=".pdf">
                    </div>
                `).join('');
            }

            if (visaData.requires_flight && !document.getElementById('handleFlight')?.checked) {
                uploadDiv.innerHTML += `
                    <div class="form-group">
                        <label class="form-label" for="flightFile_${currentPassenger}">Flight Itinerary${visaData.requires_flight ? ' <span style="color:var(--error);">*</span>' : ''}</label>
                        <input type="file" class="form-control" id="flightFile_${currentPassenger}" name="flight[${currentPassenger}]" ${visaData.requires_flight ? 'required' : ''} accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                `;
            }
            if (visaData.requires_hotel && !document.getElementById('handleHotel')?.checked) {
                uploadDiv.innerHTML += `
                    <div class="form-group">
                        <label class="form-label" for="hotelFile_${currentPassenger}">Hotel Reservation${visaData.requires_hotel ? ' <span style="color:var(--error);">*</span>' : ''}</label>
                        <input type="file" class="form-control" id="hotelFile_${currentPassenger}" name="hotel[${currentPassenger}]" ${visaData.requires_hotel ? 'required' : ''} accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                `;
            }
            if (visaData.requires_insurance && !document.getElementById('handleInsurance')?.checked) {
                uploadDiv.innerHTML += `
                    <div class="form-group">
                        <label class="form-label" for="insuranceFile_${currentPassenger}">Insurance Document${visaData.requires_insurance ? ' <span style="color:var(--error);">*</span>' : ''}</label>
                        <input type="file" class="form-control" id="insuranceFile_${currentPassenger}" name="insurance[${currentPassenger}]" ${visaData.requires_insurance ? 'required' : ''} accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                `;
            }
        }

        function nextSubStep() {
            const form = document.getElementById('kycForm');
            const fields = subSteps[currentSubStep];
            if (fields.length > 0 && !form.checkValidity()) {
                form.reportValidity();
                form.querySelectorAll(':invalid').forEach(input => {
                    input.classList.add('error');
                    setTimeout(() => input.classList.remove('error'), 1000);
                });
                return;
            }

            const formData = new FormData(form);
            for (let [name, value] of formData) {
                passengerData[currentPassenger].data[name] = value;
            }

            if (currentSubStep < subSteps.length - 1) {
                currentSubStep++;
                renderPassengerForm();
            } else if (currentPassenger < passengerData.length - 1) {
                currentPassenger++;
                currentSubStep = 0;
                renderPassengerForm();
            } else {
                nextStep();
            }
        }

        function prevSubStep() {
            if (currentSubStep > 0) {
                currentSubStep--;
                renderPassengerForm();
            } else if (currentPassenger > 0) {
                currentPassenger--;
                currentSubStep = subSteps.length - 1;
                renderPassengerForm();
            }
        }

        function initializePayment() {
    const currencySymbols = {
        'NGN': '₦',
        'USD': '$',
        'GBP': '£',
        'EURO': '€',
        'EUR': '€'
    };

    const formData = new FormData();
    formData.append('visa_id', visaData.id);

    // Get the total price from paymentTotal and remove currency symbol
    const paymentTotalText = document.getElementById('paymentTotal').textContent.trim();
    const currencySymbolRegex = /[₦$£€]/; // Include all possible currency symbols
    const totalUSD = parseFloat(paymentTotalText.replace(currencySymbolRegex, '').trim());

    if (isNaN(totalUSD)) {
        console.error('Error: Total price is NaN. paymentTotal text:', paymentTotalText);
        document.getElementById('paymentStatus').textContent = 'Error: Invalid total price. Please try again.';
        return;
    }

    // Validate visaData.rate
    const rate = parseFloat(visaData.rate);
    if (!isNaira && (isNaN(rate) || rate <= 0)) {
        console.error('Error: Invalid or missing visaData.rate:', visaData.rate);
        document.getElementById('paymentStatus').textContent = 'Error: Currency conversion rate is unavailable. Please try switching to NGN or contact support.';
        return;
    }

    // Calculate totalNGN
    const totalNGN = isNaira ? totalUSD : totalUSD * rate;
    if (isNaN(totalNGN)) {
        console.error('Error: totalNGN is NaN. totalUSD:', totalUSD, 'rate:', rate, 'isNaira:', isNaira);
        document.getElementById('paymentStatus').textContent = 'Error: Failed to calculate total price. Please try again.';
        return;
    }

    formData.append('total_price', totalNGN.toFixed(2));
    formData.append('passenger_count', passengerData.length);

    if (visaData.visa_forms && visaData.visa_forms.length > 0) {
        formData.append('email', passengerData[0].data['email'] || '');
        formData.append('full_name', passengerData[0].data['full_name'] || '');
    } else {
        formData.append('email', passengerData[0].data['passengers[0][email_address]'] || '');
        formData.append('full_name', (passengerData[0].data['passengers[0][surname]'] || '') + ' ' + (passengerData[0].data['passengers[0][first_name]'] || ''));
        passengerData.forEach((passenger, i) => {
            for (let [key, value] of Object.entries(passenger.data)) {
                formData.append(key, value);
            }
        });
    }

    // Add document uploads
    visaData.visa_documents.forEach(doc => {
        const fileInput = document.getElementById(`doc_${doc.id}_${currentPassenger}`);
        if (fileInput?.files[0]) formData.append(`documents[${currentPassenger}][${doc.id}]`, fileInput.files[0]);
    });

    if (visaData.visa_forms && visaData.visa_forms.length > 0) {
        visaData.visa_forms.forEach(form => {
            const fileInput = document.getElementById(`form_${form.id}_${currentPassenger}`);
            if (fileInput?.files[0]) formData.append(`forms[${currentPassenger}][${form.id}]`, fileInput.files[0]);
        });
    }

    if (visaData.requires_flight && !document.getElementById('handleFlight')?.checked) {
        const fileInput = document.getElementById(`flightFile_${currentPassenger}`);
        if (fileInput?.files[0]) formData.append(`flight[${currentPassenger}]`, fileInput.files[0]);
    }
    if (visaData.requires_hotel && !document.getElementById('handleHotel')?.checked) {
        const fileInput = document.getElementById(`hotelFile_${currentPassenger}`);
        if (fileInput?.files[0]) formData.append(`hotel[${currentPassenger}]`, fileInput.files[0]);
    }
    if (visaData.requires_insurance && !document.getElementById('handleInsurance')?.checked) {
        const fileInput = document.getElementById(`insuranceFile_${currentPassenger}`);
        if (fileInput?.files[0]) formData.append(`insurance[${currentPassenger}]`, fileInput.files[0]);
    }

    document.getElementById('payWithSeerbit').addEventListener('click', () => {
        document.getElementById('paymentStatus').textContent = 'Initializing payment...';
        fetch('/visa/process-payment-and-apply', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.error || 'Unknown error');
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
                console.error('Payment Error:', error.message);
            });
    }, { once: true });
}

        function initSummaryEditHandlers() {
            const editBtn = document.getElementById('editSummaryBtn');
            if (editBtn) {
                editBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.getElementById('summaryView').style.display = 'none';
                    document.getElementById('summaryEditForm').classList.add('active');
                    editBtn.style.display = 'none';

                });
            }

            const cancelBtn = document.getElementById('cancelEditSummary');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', () => {
                    document.getElementById('summaryView').style.display = 'flex';
                    document.getElementById('summaryEditForm').classList.remove('active');
                    document.getElementById('editSummaryBtn').style.display = 'inline-block';
                });
            }

            if (window.flatpickr) {
                flatpickr('#editDateRange', {
                    mode: 'range',
                    minDate: 'today',
                    dateFormat: 'm/d/Y',
                    animate: true
                });
            }

            const form = document.getElementById('summaryEditForm');
            if (form) {
               form.addEventListener('submit', (e) => {
    const dateRange = document.getElementById('editDateRange').value;

    if (!dateRange.match(/\d{2}\/\d{2}\/\d{4}\s+to\s+\d{2}\/\d{2}\/\d{4}/)) {
        e.preventDefault();
        alert('Please select a valid date range.');
    }
    // Otherwise, allow natural form submission
});

            }
        }

        // Event Listeners
        document.getElementById('startApplicationBtn').addEventListener('click', () => nextStep());
        document.getElementById('nextSubStep').addEventListener('click', nextSubStep);
        document.getElementById('prevSubStep').addEventListener('click', prevSubStep);
        document.getElementById('backToKYC').addEventListener('click', () => prevStep());

        // Initialize Handlers
        initSummaryEditHandlers();
        initStartApplicationHandlers();

        // Payment Success/Error Handling
        document.addEventListener('DOMContentLoaded', () => {
            if (window.paymentSuccess && window.applicationId) {
                const visaId = "{{ session('visa_id') }}";
                if (visaId) {
                    fetch(`/visa/${visaId}/details`)
                        .then(response => response.json())
                        .then(data => {
                            visaData = data;
                            updateVisaDetails();
                            currentStep = 4;
                            for (let i = 1; i <= 4; i++) {
                                document.getElementById(`step${i}`).classList.remove('active');
                            }
                            document.getElementById('step4').classList.add('active');
                            updateStepper();
                            document.getElementById('applicationModal').classList.add('active');
                            document.querySelector('#step4 div').textContent = `Application submitted successfully! Application ID: ${window.applicationId}. Check your email for details.`;
                            initStartApplicationHandlers();
                            initSummaryEditHandlers();
                            feather.replace();
                        })
                        .catch(error => {
                            console.error('Error fetching visa details:', error);
                            alert('Failed to load visa details. Please try again.');
                        });
                } else {
                    currentStep = 4;
                    for (let i = 1; i <= 4; i++) {
                        document.getElementById(`step${i}`).classList.remove('active');
                    }
                    document.getElementById('step4').classList.add('active');
                    updateStepper();
                    document.getElementById('applicationModal').classList.add('active');
                    document.querySelector('#step4 div').textContent = `Application submitted successfully! Application ID: ${window.applicationId}. Check your email for details.`;
                }
            } else if (window.paymentError) {
                currentStep = 3;
                for (let i = 1; i <= 4; i++) {
                    document.getElementById(`step${i}`).classList.remove('active');
                }
                document.getElementById('step3').classList.add('active');
                updateStepper();
                document.getElementById('applicationModal').classList.add('active');
                document.getElementById('paymentStatus').textContent = window.paymentError;
            }
        });
    </script>
</body>

</html>