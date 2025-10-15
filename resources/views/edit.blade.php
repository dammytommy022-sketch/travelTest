<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Visa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6769f9;
            --primary-dark: #5658c9;
            --primary-light: #8b8dff;
            --accent: #00d4aa;
            --accent-light: #66e6d0;
            --surface: #ffffff;
            --surface-elevated: #f8fafc;
            --surface-hover: #f1f5f9;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: white;
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            animation: slideInDown 0.8s ease-out;
        }

        .header p {
            color: var(--text-primary);
            font-size: 1.2rem;
            font-weight: 300;
        }

        .form-wrapper {
            background: var(--surface);
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            position: relative;
            animation: slideInUp 0.8s ease-out 0.2s both;
        }

        .form-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .progress-bar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--surface);
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--border-light);
            backdrop-filter: blur(10px);
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .progress-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border-light);
            transform: translateY(-50%);
            z-index: 1;
        }

        .progress-fill {
            height: 100%;
            background: var(--gradient-primary);
            width: 0%;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 1px;
        }

        .step {
            display: flex;
            align-items: center;
            background: var(--surface);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            box-shadow: var(--shadow-sm);
            border: 2px solid var(--border);
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .step.active {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .step.completed {
            background: var(--success);
            color: white;
            border-color: var(--success);
        }

        .step-icon {
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .form-content {
            padding: 2rem;
        }

        .section {
            display: none;
            animation: fadeInSlide 0.5s ease-out;
        }

        .section.active {
            display: block;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-light);
        }

        .section-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--surface);
            position: relative;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(103, 105, 249, 0.1);
            transform: translateY(-1px);
        }

        .form-control:hover {
            border-color: var(--primary-light);
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin: 1rem 0;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-wrapper {
            position: relative;
            margin-right: 0.75rem;
        }

        .checkbox-input {
            opacity: 0;
            position: absolute;
        }

        .checkbox-custom {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            background: var(--surface);
        }

        .checkbox-input:checked + .checkbox-custom {
            background: var(--gradient-primary);
            border-color: var(--primary);
            transform: scale(1.1);
        }

        .checkbox-custom::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 0.7rem;
            opacity: 0;
            transform: scale(0);
            transition: all 0.2s ease;
        }

        .checkbox-input:checked + .checkbox-custom::after {
            opacity: 1;
            transform: scale(1);
        }

        .fee-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .fee-card {
            background: var(--surface-elevated);
            border: 2px solid var(--border-light);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .fee-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .fee-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .fee-card:hover::before {
            transform: scaleX(1);
        }

        .fee-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
        }

        .fee-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .charges-container {
            background: var(--surface-elevated);
            border-radius: 16px;
            padding: 1.5rem;
            margin: 2rem 0;
            border: 1px solid var(--border-light);
        }

        .charge-item {
            background: var(--surface);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--border);
            position: relative;
            animation: slideInLeft 0.3s ease-out;
        }

        .charge-item:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        .charge-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .charge-number {
            background: var(--gradient-primary);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .remove-charge {
            background: var(--error);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .remove-charge:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .btn {
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: var(--surface);
            color: var(--text-primary);
            border: 2px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--surface-hover);
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .btn-accent {
            background: var(--gradient-accent);
            color: white;
        }

        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-icon {
            margin-right: 0.5rem;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            padding: 2rem;
            border-top: 1px solid var(--border-light);
            background: var(--surface-elevated);
        }

        .total-summary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .total-summary::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        .total-amount {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .document-selector {
            background: var(--surface-elevated);
            border-radius: 16px;
            padding: 1.5rem;
            margin: 1rem 0;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .document-card {
            background: var(--surface);
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .document-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .document-card.selected {
            border-color: var(--primary);
            background: rgba(103, 105, 249, 0.05);
        }

        .document-card.selected::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            color: var(--primary);
            background: var(--surface);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        .preview-panel {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background: var(--surface);
            box-shadow: var(--shadow-xl);
            transition: right 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .preview-panel.open {
            right: 0;
        }

        .preview-header {
            background: var(--gradient-primary);
            color: white;
            padding: 1.5rem;
            position: sticky;
            top: 0;
        }

        .preview-content {
            padding: 1.5rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            animation: slideInDown 0.5s ease-out;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--success);
            color: var(--success);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: var(--error);
            color: var(--error);
        }

        .floating-save {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 999;
        }

        .save-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: white;
            border: none;
            box-shadow: var(--shadow-lg);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .save-btn:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-xl);
        }

        .form-file-upload {
            border: 2px dashed var(--border);
            padding: 1.5rem;
            text-align: center;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-file-upload.dragover {
            background: var(--surface-hover);
            border-color: var(--primary);
        }

        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInSlide {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .container { padding: 1rem; }
            .header h1 { font-size: 2rem; }
            .form-grid { grid-template-columns: 1fr; }
            .fee-grid { grid-template-columns: 1fr; }
            .navigation-buttons { flex-direction: column; gap: 1rem; }
            .preview-panel { width: 100%; right: -100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-passport"></i> Edit Visa</h1>
        </div>

        <div class="form-wrapper">
            <div class="progress-bar">
                <div class="progress-steps">
                    <div class="progress-line">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <div class="step active" data-step="1">
                        <i class="fas fa-info-circle step-icon"></i>
                        <span>Basic Info</span>
                    </div>
                    <div class="step" data-step="2">
                        <i class="fas fa-dollar-sign step-icon"></i>
                        <span>Fees</span>
                    </div>
                    <div class="step" data-step="3">
                        <i class="fas fa-file-alt step-icon"></i>
                        <span>Documents</span>
                    </div>
                    <div class="step" data-step="4">
                        <i class="fas fa-check-circle step-icon"></i>
                        <span>Review</span>
                    </div>
                </div>
            </div>

            <form id="visaForm" class="form-content" action="{{ route('admin.visas.update', $visa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Step 1: Basic Information -->
                <div class="section active" data-section="1">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="section-title">Basic Information</div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <div class="select-wrapper">
                                <select class="form-control" id="country_id" name="country_id" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $visa->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Visa Type</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="visa_type" required>
                                    <option value="">Select Type</option>
                                    <option value="eVisa" {{ $visa->visa_type == 'eVisa' ? 'selected' : '' }}>eVisa</option>
                                    <option value="Tourist" {{ $visa->visa_type == 'Tourist' ? 'selected' : '' }}>Tourist</option>
                                    <option value="Business" {{ $visa->visa_type == 'Business' ? 'selected' : '' }}>Business</option>
                                    <option value="Student" {{ $visa->visa_type == 'Student' ? 'selected' : '' }}>Student</option>
                                    <option value="Work" {{ $visa->visa_type == 'Work' ? 'selected' : '' }}>Work</option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="form-label">Visa Category</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="visa_category" required>
                                    <option value="">Select Category</option>
                                    <option value="Single" {{ $visa->visa_category == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Double" {{ $visa->visa_category == 'Double' ? 'selected' : '' }}>Double</option>
                                     <option value="Multiple" {{ $visa->visa_category == 'Multiple' ? 'selected' : '' }}>Multiple</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Processing Type</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="processing_type" required>
                                    <option value="">Select Processing</option>
                                    <option value="Standard" {{ $visa->processing_type == 'Standard' ? 'selected' : '' }}>Standard</option>
                                    <option value="Express" {{ $visa->processing_type == 'Express' ? 'selected' : '' }}>Express</option>
                                    <option value="Super Express" {{ $visa->processing_type == 'Super Express' ? 'selected' : '' }}>Super Express</option>
                                     <option value="Premium" {{ $visa->processing_type == 'Premium' ? 'selected' : '' }}>Premium</option>
                                      <option value="Prime time" {{ $visa->processing_type == 'Prime time' ? 'selected' : '' }}>Prime time</option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="form-label">Currency</label>
                            <div class="select-wrapper">
                               <select class="form-control" name="currency" id="currency" required>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency }}" {{ $visa->currency == $currency ? 'selected' : '' }}>{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Processing Days</label>
                            <input type="number" class="form-control" name="processing_days" min="1" max="90" value="{{ $visa->processing_days }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Validity Days</label>
                            <input type="number" class="form-control" name="validity_days" min="1" max="365" value="{{ $visa->validity_days }}" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="checkbox-group">
                            <input type="hidden" name="requires_flight" value="0">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" class="checkbox-input" name="requires_flight" id="requires_flight" value="1" {{ $visa->requires_flight ? 'checked' : '' }}>
                                <div class="checkbox-custom"></div>
                            </div>
                            <label for="requires_flight">Requires Flight Booking</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="hidden" name="requires_hotel" value="0">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" class="checkbox-input" name="requires_hotel" id="requires_hotel" value="1" {{ $visa->requires_hotel ? 'checked' : '' }}>
                                <div class="checkbox-custom"></div>
                            </div>
                            <label for="requires_hotel">Requires Hotel Reservation</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="hidden" name="requires_insurance" value="0">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" class="checkbox-input" name="requires_insurance" id="requires_insurance" value="1" {{ $visa->requires_insurance ? 'checked' : '' }}>
                                <div class="checkbox-custom"></div>
                            </div>
                            <label for="requires_insurance">Requires Travel Insurance</label>
                        </div>
                    </div>
         

                    <!-- Fillable Form Section -->
                    <div class="form-group">
                        <label class="form-label">Upload Form (PDF)</label>
                        <div class="form-file-upload" id="fileUpload" ondragover="handleDragOver(event)" ondrop="handleDrop(event)">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--text-muted);"></i>
                            <p id="uploadText">Drag and drop a PDF file or click to upload</p>
                            <div id="fileInfo" style="display:block; margin-top: 1rem;">
                                <p style="color: var(--text-primary); margin: 0; display: flex; align-items: center;">
                                    <i class="fas fa-file-pdf" style="margin-right: 0.5rem; color: var(--primary);"></i>
                                    <span id="fileName">{{ $visa->forms->first()?->form_name ?? '' }}</span>
                                    <button type="button" class="btn btn-secondary" id="clearFile" style="margin-left: 1rem; padding: 0.5rem;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </p>
                            </div>
                            <input type="file" class="form-control" name="form_file" accept="application/pdf" style="display: none;" onchange="handleFileSelect(event)">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" name="note" rows="4" cols="50">{{ $visa->note }}</textarea>
                    </div>
                </div>

                <!-- Step 2: Fees -->
                <div class="section" data-section="2">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="section-title">Fee Configuration</div>
                    </div>

                    <div class="fee-grid">
                        <div class="fee-card">
                            <div class="fee-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="fee-label">Adult Visa Fee</div>
                            <input type="number" class="form-control" name="visa_fee_adult" min="0" step="0.01" value="{{ $visa->visa_fee_adult }}" required>
                        </div>
                        <div class="fee-card">
                            <div class="fee-icon">
                                <i class="fas fa-child"></i>
                            </div>
                            <div class="fee-label">Child Visa Fee</div>
                            <input type="number" class="form-control" name="visa_fee_child" min="0" step="0.01" value="{{ $visa->visa_fee_child }}" required>
                        </div>
                        <div class="fee-card">
                            <div class="fee-icon">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div class="fee-label">Infant Visa Fee</div>
                            <input type="number" class="form-control" name="visa_fee_infant" min="0" step="0.01" value="{{ $visa->visa_fee_infant }}" required>
                        </div>
                    </div>

                    <div class="fee-grid">
                        <div class="fee-card">
                            <div class="fee-icon">
                                <i class="fas fa-fingerprint"></i>
                            </div>
                            <div class="fee-label">Adult Biometrics</div>
                            <input type="number" class="form-control" name="biometrics_fee_adult" min="0" step="0.01" value="{{ $visa->biometrics_fee_adult }}" required>
                        </div>
                        <div class="fee-card">
                            <div class="fee-icon">
                                <i class="fas fa-fingerprint"></i>
                            </div>
                            <div class="fee-label">Child Biometrics</div>
                            <input type="number" class="form-control" name="biometrics_fee_child" min="0" step="0.01" value="{{ $visa->biometrics_fee_child }}" required>
                        </div>
                        <div class="fee-card">
                            <div class="fee-icon">
                                <i class="fas fa-fingerprint"></i>
                            </div>
                            <div class="fee-label">Infant Biometrics</div>
                            <input type="number" class="form-control" name="biometrics_fee_infant" min="0" step="0.01" value="{{ $visa->biometrics_fee_infant }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Administrative Fee (USD)</label>
                        <input type="number" class="form-control" name="admin_fee" min="0" step="0.01" value="{{ $visa->admin_fee }}" required>
                    </div>

                    <div class="checkbox-group">
                        <input type="hidden" name="pay_fees" value="0">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" name="pay_fees" id="embassy_pay" value="1" {{ $visa->pay_visa_to_embassy ? 'checked' : '' }}>
                            <div class="checkbox-custom"></div>
                        </div>
                        <label for="embassy_pay">Pay visa to Embassy</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="hidden" name="pay_bio_fees" value="0">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" name="pay_bio_fees" id="embassy_bio_pay" value="1" {{ $visa->pay_bio_to_embassy ? 'checked' : '' }}>
                            <div class="checkbox-custom"></div>
                        </div>
                        <label for="embassy_bio_pay">Pay biometrics to Embassy</label>
                    </div
                    <div class="charges-container">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                            <h3 style="margin: 0; color: var(--text-primary);">
                                <i class="fas fa-plus-circle" style="margin-right: 0.5rem; color: var(--primary);"></i>
                                Additional Charges
                            </h3>
                            <button type="button" class="btn btn-secondary" id="addCharge">
                                <i class="fas fa-plus btn-icon"></i>
                                Add Charge
                            </button>
                        </div>

                        <div id="chargesContainer">
                            @foreach($visa->other_charges as $index => $charge)
                                <div class="charge-item" data-index="{{ $index }}">
                                    <div class="charge-header">
                                        <div class="charge-number">{{ $index + 1 }}</div>
                                        <button type="button" class="remove-charge" {{ $loop->count > 1 ? '' : 'style="display: none;"' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label class="form-label">Charge Name</label>
                                            <input type="text" class="form-control" name="other_charges[{{ $index }}][charge_name]" value="{{ $charge->charge_name }}" required>
                                            <input type="hidden" name="other_charges[{{ $index }}][id]" value="{{ $charge->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Amount (USD)</label>
                                            <input type="number" class="form-control charge-amount" name="other_charges[{{ $index }}][amount]" min="0" step="0.01" value="{{ $charge->amount }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Traveler Type</label>
                                            <div class="select-wrapper">
                                                <select class="form-control" name="other_charges[{{ $index }}][traveler_type]" required>
                                                    <option value="Adult" {{ $charge->traveler_type == 'Adult' ? 'selected' : '' }}>Adult</option>
                                                    <option value="Child" {{ $charge->traveler_type == 'Child' ? 'selected' : '' }}>Child</option>
                                                    <option value="Infant" {{ $charge->traveler_type == 'Infant' ? 'selected' : '' }}>Infant</option>
                                                    <option value="All" {{ $charge->traveler_type == 'All' ? 'selected' : '' }}>All</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Notes</label>
                                            <textarea class="form-control" name="other_charges[{{ $index }}][note]" rows="2">{{ $charge->note }}</textarea>
                                        </div>
                                        <div class="checkbox-group">
                                            <input type="hidden" name="other_charges[{{ $index }}][pay_to_embassy]" value="0">
                                            <div class="checkbox-wrapper">
                                                <input type="checkbox" class="checkbox-input" name="other_charges[{{ $index }}][pay_to_embassy]" id="embassy_{{ $index }}" value="1" {{ $charge->pay_to_embassy ? 'checked' : '' }}>
                                                <div class="checkbox-custom"></div>
                                            </div>
                                            <label for="embassy_{{ $index }}">Pay to Embassy</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="total-summary">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-size: 1.1rem; opacity: 0.9;">Total Additional Charges</div>
                                    <div class="total-amount" id="totalCharges">${{ $visa->other_charges->sum('amount') }}</div>
                                </div>
                                <div style="font-size: 3rem; opacity: 0.3;">
                                    <i class="fas fa-calculator"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Documents -->
                <div class="section" data-section="3">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="section-title">Required Documents</div>
                    </div>

                    <div class="document-selector">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4 style="margin: 0;">Select Required Documents</h4>
                            <button type="button" class="btn btn-accent" id="addNewDocument">
                                <i class="fas fa-plus btn-icon"></i>
                                Add New Document
                            </button>
                        </div>

                        <div class="document-grid" id="documentsGrid">
                            @foreach($visa->visa_documents as $document)
                                <div class="document-card {{ in_array($document->id, $visa->visa_documents->pluck('id')->toArray()) ? 'selected' : '' }}" data-doc-id="{{ $document->id }}">
                                    <h5 style="margin-bottom: 0.5rem;">
                                        <i class="fas fa-passport" style="margin-right: 0.5rem; color: var(--primary);"></i>
                                        {{ $document->document_name }}
                                    </h5>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">{{ $document->description ?? 'No description' }}</p>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">Category: {{ $document->category }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div id="newDocumentForm" style="display: none; margin-top: 2rem; padding: 1.5rem; background: var(--surface); border-radius: 12px; border: 2px dashed var(--border);">
                            <h5 style="margin-bottom: 1rem;">Add New Document Type</h5>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Document Name</label>
                                    <input type="text" class="form-control" id="newDocName" placeholder="Enter document name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="newDocDescription" placeholder="Enter document description" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control" id="newDocCategory" required>
                                        <option value="Visa">Visa</option>
                                        <option value="Health">Health</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                                <button type="button" class="btn btn-primary" id="saveNewDocument">
                                    <i class="fas fa-save btn-icon"></i>
                                    Save Document
                                </button>
                                <button type="button" class="btn btn-secondary" id="cancelNewDocument">
                                    <i class="fas fa-times btn-icon"></i>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Review -->
                <div class="section" data-section="4">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="section-title">Review & Submit</div>
                    </div>

                    <div id="reviewContent">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
            </form>

            <div class="navigation-buttons">
                <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                    <i class="fas fa-arrow-left btn-icon"></i>
                    Previous
                </button>
                <div style="flex: 1;"></div>
                <button type="button" class="btn btn-accent" id="previewBtn">
                    <i class="fas fa-eye btn-icon"></i>
                    Preview
                </button>
                <button type="button" class="btn btn-primary" id="nextBtn">
                    Next
                    <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                </button>
                <button type="submit" class="btn btn-primary" id="submitBtn" form="visaForm" style="display: none;">
                    <i class="fas fa-save btn-icon"></i>
                    Update Visa
                </button>
            </div>
        </div>
    </div>

    <!-- Preview Panel -->
    <div class="preview-panel" id="previewPanel">
        <div class="preview-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0;">
                    <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>
                    Visa Preview
                </h3>
                <button type="button" class="btn" id="closePreview" style="background: rgba(255,255,255,0.2); color: white; padding: 0.5rem;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="preview-content" id="previewContent">
            <!-- Preview content will be populated here -->
        </div>
    </div>

    <script>
        // Global variables
        let currentStep = 1;
        let chargeIndex = {{ count($visa->other_charges) - 1 }};
        let selectedDocuments = [
            @foreach($visa->visa_documents as $document)
                {
                    id: '{{ $document->id }}',
                    name: '{{ $document->document_name }}',
                    description: '{{ $document->description ?? '' }}',
                    category: '{{ $document->category }}'
                },
            @endforeach
        ];
        const totalSteps = 4;

        // Handle form submission
        document.getElementById('visaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Handle top-level checkboxes
            const checkboxes = ['requires_flight', 'requires_hotel', 'requires_insurance', 'pay_fees'];
            checkboxes.forEach(name => {
                const checkbox = document.querySelector(`input[name="${name}"]`);
                if (!checkbox.checked) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = name;
                    hiddenInput.value = '0';
                    this.appendChild(hiddenInput);
                } else {
                    checkbox.value = '1';
                }
            });

            // Handle pay_to_embassy checkboxes for other_charges
            document.querySelectorAll('input[name*="other_charges"][name*="pay_to_embassy"]').forEach(checkbox => {
                if (checkbox.checked) {
                    checkbox.value = '1';
                }
            });

            submitForm();
        });

        // Initialize application
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            updateProgressBar();
            updateChargeTotal();
            updateRemoveButtons();
        });

        function initializeEventListeners() {
            // Navigation
            document.getElementById('nextBtn').addEventListener('click', nextStep);
            document.getElementById('prevBtn').addEventListener('click', prevStep);
            document.getElementById('submitBtn').addEventListener('click', submitForm);

            // Charges
            document.getElementById('addCharge').addEventListener('click', addCharge);
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-charge') || e.target.closest('.remove-charge')) {
                    removeCharge(e.target.closest('.charge-item'));
                }
            });

            // Document management
            document.getElementById('addNewDocument').addEventListener('click', showNewDocumentForm);
            document.getElementById('saveNewDocument').addEventListener('click', saveNewDocument);
            document.getElementById('cancelNewDocument').addEventListener('click', hideNewDocumentForm);

            // Document selection
            document.addEventListener('click', function(e) {
                if (e.target.closest('.document-card')) {
                    toggleDocumentSelection(e.target.closest('.document-card'));
                }
            });

            // Preview
            document.getElementById('previewBtn').addEventListener('click', showPreview);
            document.getElementById('closePreview').addEventListener('click', hidePreview);

            // Form file handling
            const fileInput = document.querySelector('input[name="form_file"]');
            fileInput.addEventListener('change', handleFileSelect);
            const fileUpload = document.getElementById('fileUpload');
            fileUpload.addEventListener('click', () => fileInput.click());
            fileUpload.addEventListener('dragover', handleDragOver);
            fileUpload.addEventListener('drop', handleDrop);
            document.getElementById('clearFile').addEventListener('click', clearFile);

            // Real-time updates
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('charge-amount')) {
                    updateChargeTotal();
                }
            });
        }

        function nextStep() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                    updateProgressBar();
                    updateNavigationButtons();
                    if (currentStep === 4) {
                        generateReview();
                    }
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                updateProgressBar();
                updateNavigationButtons();
            }
        }

        function showStep(step) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.querySelector(`[data-section="${step}"]`).classList.add('active');
            document.querySelectorAll('.step').forEach((stepEl, index) => {
                stepEl.classList.remove('active', 'completed');
                if (index + 1 < step) {
                    stepEl.classList.add('completed');
                } else if (index + 1 === step) {
                    stepEl.classList.add('active');
                }
            });
        }

        function updateProgressBar() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            prevBtn.style.display = currentStep > 1 ? 'block' : 'none';
            if (currentStep === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'block';
            } else {
                nextBtn.style.display = 'block';
                submitBtn.style.display = 'none';
            }
        }

        function validateCurrentStep() {
            const currentSection = document.querySelector(`[data-section="${currentStep}"]`);
            const requiredFields = currentSection.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = 'var(--error)';
                    field.addEventListener('input', function() {
                        this.style.borderColor = '';
                    }, { once: true });
                    isValid = false;
                } else {
                    field.style.borderColor = '';
                }
            });

            if (!isValid) {
                showAlert('Please fill in all required fields', 'error');
            }

            return isValid;
        }

        function addCharge() {
            chargeIndex++;
            const chargeHTML = `
                <div class="charge-item" data-index="${chargeIndex}">
                    <div class="charge-header">
                        <div class="charge-number">${chargeIndex + 1}</div>
                        <button type="button" class="remove-charge">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Charge Name</label>
                            <input type="text" class="form-control" name="other_charges[${chargeIndex}][charge_name]" placeholder="Enter charge name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Amount (USD)</label>
                            <input type="number" class="form-control charge-amount" name="other_charges[${chargeIndex}][amount]" min="0" step="0.01" placeholder="0.00" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Traveler Type</label>
                            <div class="select-wrapper">
                                <select class="form-control" name="other_charges[${chargeIndex}][traveler_type]" required>
                                    <option value="Adult">Adult</option>
                                    <option value="Child">Child</option>
                                    <option value="Infant">Infant</option>
                                    <option value="All">All</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="other_charges[${chargeIndex}][note]" placeholder="Optional notes" rows="2"></textarea>
                        </div>
                        <div class="checkbox-group">
                            <input type="hidden" name="other_charges[${chargeIndex}][pay_to_embassy]" value="0">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" class="checkbox-input" name="other_charges[${chargeIndex}][pay_to_embassy]" id="embassy_${chargeIndex}" value="1">
                                <div class="checkbox-custom"></div>
                            </div>
                            <label for="embassy_${chargeIndex}">Pay to Embassy</label>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('chargesContainer').insertAdjacentHTML('beforeend', chargeHTML);
            updateRemoveButtons();
            const newCharge = document.querySelector(`.charge-item[data-index="${chargeIndex}"]`);
            newCharge.style.opacity = '0';
            newCharge.style.transform = 'translateY(20px)';
            setTimeout(() => {
                newCharge.style.transition = 'all 0.3s ease';
                newCharge.style.opacity = '1';
                newCharge.style.transform = 'translateY(0)';
            }, 10);
        }

        function removeCharge(chargeItem) {
            if (document.querySelectorAll('.charge-item').length > 1) {
                chargeItem.style.animation = 'slideInLeft 0.3s ease-out reverse';
                setTimeout(() => {
                    chargeItem.remove();
                    updateChargeNumbers();
                    updateRemoveButtons();
                    updateChargeTotal();
                }, 300);
            }
        }

        function updateRemoveButtons() {
            const charges = document.querySelectorAll('.charge-item');
            charges.forEach((charge, index) => {
                const removeBtn = charge.querySelector('.remove-charge');
                removeBtn.style.display = charges.length > 1 ? 'block' : 'none';
            });
        }

        function updateChargeNumbers() {
            const charges = document.querySelectorAll('.charge-item');
            charges.forEach((charge, index) => {
                const numberEl = charge.querySelector('.charge-number');
                numberEl.textContent = index + 1;
            });
        }

        function updateChargeTotal() {
            const amounts = document.querySelectorAll('.charge-amount');
            let total = 0;
            amounts.forEach(amount => {
                total += parseFloat(amount.value) || 0;
            });
            document.getElementById('totalCharges').textContent = `$${total.toFixed(2)}`;
        }

        function showNewDocumentForm() {
            document.getElementById('newDocumentForm').style.display = 'block';
            document.getElementById('newDocName').focus();
        }

        function hideNewDocumentForm() {
            document.getElementById('newDocumentForm').style.display = 'none';
            document.getElementById('newDocName').value = '';
            document.getElementById('newDocDescription').value = '';
            document.getElementById('newDocCategory').value = 'Visa';
        }

        function saveNewDocument() {
            const name = document.getElementById('newDocName').value.trim();
            const description = document.getElementById('newDocDescription').value.trim();
            const category = document.getElementById('newDocCategory').value.trim();
            if (!name || !category) {
                showAlert('Please enter document name and category', 'error');
                return;
            }
            const docId = 'new_' + Date.now();
            const docHTML = `
                <div class="document-card selected" data-doc-id="${docId}">
                    <h5 style="margin-bottom: 0.5rem;">
                        <i class="fas fa-file" style="margin-right: 0.5rem; color: var(--primary);"></i>
                        ${name}
                    </h5>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">${description || 'Custom document'}</p>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">Category: ${category}</p>
                </div>
            `;
            document.getElementById('documentsGrid').insertAdjacentHTML('beforeend', docHTML);
            selectedDocuments.push({ id: docId, name, description, category });
            hideNewDocumentForm();
            showAlert('Document added successfully', 'success');
        }

        function toggleDocumentSelection(docCard) {
            const docId = docCard.getAttribute('data-doc-id');
            const name = docCard.querySelector('h5').textContent.trim();
            const description = docCard.querySelector('p:nth-child(2)').textContent.trim();
            const category = docCard.querySelector('p:nth-child(3)')?.textContent.replace('Category: ', '').trim() || 'Uncategorized';
            if (docCard.classList.contains('selected')) {
                docCard.classList.remove('selected');
                selectedDocuments = selectedDocuments.filter(doc => doc.id !== docId);
            } else {
                docCard.classList.add('selected');
                selectedDocuments.push({ id: docId, name, description, category });
            }
        }

        function generateReview() {
            const formData = new FormData(document.getElementById('visaForm'));
            let reviewHTML = '<div class="review-sections">';

            // Basic Information
            reviewHTML += `
                <div class="review-section">
                    <h4><i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>Basic Information</h4>
                    <div class="review-grid">
                        <div><strong>Country:</strong> ${getSelectText('country_id')}</div>
                        <div><strong>Visa Type:</strong> ${formData.get('visa_type') || 'Not selected'}</div>
                        <div><strong>Processing Type:</strong> ${formData.get('processing_type') || 'Not selected'}</div>
                        <div><strong>Processing Days:</strong> ${formData.get('processing_days') || '0'} days</div>
                        <div><strong>Validity:</strong> ${formData.get('validity_days') || '0'} days</div>
                        <div><strong>Form Uploaded:</strong> ${formData.get('form_file') || document.getElementById('fileInfo').style.display === 'block' ? 'Yes' : 'No'}</div>
                    </div>
                </div>
            `;

            // Fees
            const adultVisa = parseFloat(formData.get('visa_fee_adult')) || 0;
            const childVisa = parseFloat(formData.get('visa_fee_child')) || 0;
            const infantVisa = parseFloat(formData.get('visa_fee_infant')) || 0;
            const adultBiometrics = parseFloat(formData.get('biometrics_fee_adult')) || 0;
            const childBiometrics = parseFloat(formData.get('biometrics_fee_child')) || 0;
            const infantBiometrics = parseFloat(formData.get('biometrics_fee_infant')) || 0;
            const adminFee = parseFloat(formData.get('admin_fee')) || 0;

            reviewHTML += `
                <div class="review-section">
                    <h4><i class="fas fa-dollar-sign" style="margin-right: 0.5rem;"></i>Fee Structure</h4>
                    <div class="fee-summary">
                        <div class="fee-row">
                            <span>Adult Visa Fee:</span>
                            <span>$${adultVisa.toFixed(2)}</span>
                        </div>
                        <div class="fee-row">
                            <span>Child Visa Fee:</span>
                            <span>$${childVisa.toFixed(2)}</span>
                        </div>
                        <div class="fee-row">
                            <span>Infant Visa Fee:</span>
                            <span>$${infantVisa.toFixed(2)}</span>
                        </div>
                        <div class="fee-row">
                            <span>Adult Biometrics Fee:</span>
                            <span>$${adultBiometrics.toFixed(2)}</span>
                        </div>
                        <div class="fee-row">
                            <span>Child Biometrics Fee:</span>
                            <span>$${childBiometrics.toFixed(2)}</span>
                        </div>
                        <div class="fee-row">
                            <span>Infant Biometrics Fee:</span>
                            <span>$${infantBiometrics.toFixed(2)}</span>
                        </div>
                        <div class="fee-row">
                            <span>Administrative Fee:</span>
                            <span>$${adminFee.toFixed(2)}</span>
                        </div>
                    </div>
                </div>
            `;

            // Documents
            reviewHTML += `
                <div class="review-section">
                    <h4><i class="fas fa-file-alt" style="margin-right: 0.5rem;"></i>Required Documents (${selectedDocuments.length})</h4>
                    <div class="doc-list">
            `;
            selectedDocuments.forEach(doc => {
                reviewHTML += `<div class="doc-item"><i class="fas fa-check-circle" style="color: var(--success); margin-right: 0.5rem;"></i>${doc.name}</div>`;
            });
            reviewHTML += '</div></div>';
            reviewHTML += '</div>';
            document.getElementById('reviewContent').innerHTML = reviewHTML;
        }

        function getSelectText(selectName) {
            const select = document.querySelector(`[name="${selectName}"]`);
            return select.selectedOptions[0]?.textContent || 'Not selected';
        }

        function showPreview() {
            generatePreviewContent();
            document.getElementById('previewPanel').classList.add('open');
        }

        function hidePreview() {
            document.getElementById('previewPanel').classList.remove('open');
        }

        function generatePreviewContent() {
            const formData = new FormData(document.getElementById('visaForm'));
            let previewHTML = `
                <div class="preview-card">
                    <h4>Visa Application Preview</h4>
                    <div class="preview-details">
                        <p><strong>Country:</strong> ${getSelectText('country_id')}</p>
                        <p><strong>Type:</strong> ${formData.get('visa_type') || 'Not specified'}</p>
                        <p><strong>Processing:</strong> ${formData.get('processing_type') || 'Not specified'} (${formData.get('processing_days') || '0'} days)</p>
                        <p><strong>Validity:</strong> ${formData.get('validity_days') || '0'} days</p>
                        <p><strong>Form Uploaded:</strong> ${formData.get('form_file') || document.getElementById('fileInfo').style.display === 'block' ? 'Yes' : 'No'}</p>
                    </div>
                </div>
            `;
            document.getElementById('previewContent').innerHTML = previewHTML;
        }

        function submitForm() {
            if (validateCurrentStep()) {
                const form = document.getElementById('visaForm');
                const formData = new FormData(form);

                // Append selected documents to FormData
                selectedDocuments.forEach((doc, index) => {
                    formData.append(`documents[${index}][id]`, doc.id);
                    formData.append(`documents[${index}][name]`, doc.name);
                    formData.append(`documents[${index}][description]`, doc.description || '');
                    formData.append(`documents[${index}][category]`, doc.category);
                });

                const submitBtn = document.getElementById('submitBtn');
                const originalText = submitBtn.innerHTML;

                submitBtn.innerHTML = '<div class="loading"></div>Saving...';
                submitBtn.disabled = true;

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert(data.message, 'success');
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000);
                    } else {
                        showAlert(data.message || 'An error occurred.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while saving.', 'error');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            }
        }

        function showAlert(message, type) {
            const alertHTML = `
                <div class="alert alert-${type}" style="position: fixed; top: 2rem; right: 2rem; z-index: 1001; max-width: 300px;">
                    ${message}
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', alertHTML);
            const alert = document.body.lastElementChild;
            setTimeout(() => {
                alert.style.animation = 'slideInDown 0.3s ease-out reverse';
                setTimeout(() => alert.remove(), 300);
            }, 3000);
        }

        function handleDragOver(event) {
            event.preventDefault();
            document.getElementById('fileUpload').classList.add('dragover');
        }

        function handleFileSelect(event) {
            const file = event.target.files[0];
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const uploadText = document.getElementById('uploadText');

            if (file && file.type === 'application/pdf') {
                fileName.textContent = file.name;
                fileInfo.style.display = 'block';
                uploadText.style.display = 'none';
                showAlert(`File "${file.name}" selected`, 'success');
            } else {
                showAlert('Please upload a PDF file', 'error');
                event.target.value = '';
                fileInfo.style.display = 'none';
                uploadText.style.display = 'block';
            }
        }

        function handleDrop(event) {
            event.preventDefault();
            document.getElementById('fileUpload').classList.remove('dragover');
            const file = event.dataTransfer.files[0];
            const fileInput = document.querySelector('input[name="form_file"]');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const uploadText = document.getElementById('uploadText');

            if (file && file.type === 'application/pdf') {
                fileInput.files = event.dataTransfer.files;
                fileName.textContent = file.name;
                fileInfo.style.display = 'block';
                uploadText.style.display = 'none';
                showAlert(`File "${file.name}" selected`, 'success');
            } else {
                showAlert('Please upload a PDF file', 'error');
                fileInput.value = '';
                fileInfo.style.display = 'none';
                uploadText.style.display = 'block';
            }
        }

        function clearFile() {
            const fileInput = document.querySelector('input[name="form_file"]');
            const fileInfo = document.getElementById('fileInfo');
            const uploadText = document.getElementById('uploadText');

            fileInput.value = '';
            fileInfo.style.display = 'none';
            uploadText.style.display = 'block';
            showAlert('File cleared', 'success');
        }

        const reviewStyles = `
            <style>
                .review-sections { space-y: 2rem; }
                .review-section { 
                    background: var(--surface-elevated); 
                    padding: 1.5rem; 
                    border-radius: 12px; 
                    margin-bottom: 1.5rem;
                    border: 1px solid var(--border-light);
                }
                .review-section h4 { 
                    margin-bottom: 1rem; 
                    color: var(--text-primary);
                    display: flex;
                    align-items: center;
                }
                .review-grid { 
                    display: grid; 
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
                    gap: 1rem; 
                }
                .fee-summary { background: var(--surface); padding: 1rem; border-radius: 8px; }
                .fee-row { 
                    display: flex; 
                    justify-content: space-between; 
                    padding: 0.5rem 0; 
                    border-bottom: 1px solid var(--border-light);
                }
                .fee-row:last-child { border-bottom: none; font-weight: bold; }
                .doc-list { display: grid; gap: 0.5rem; }
                .doc-item { 
                    display: flex; 
                    align-items: center; 
                    padding: 0.5rem; 
                    background: var(--surface); 
                    border-radius: 6px; 
                }
                .preview-card { 
                    background: var(--surface-elevated); 
                    padding: 1.5rem; 
                    border-radius: 12px; 
                    margin-bottom: 1rem; 
                }
            </style>
        `;
        document.head.insertAdjacentHTML('beforeend', reviewStyles);
    </script>
</body>
</html>