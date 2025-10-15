<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application - {{ $application->application_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #0d1883;
            --primary-light: #1a2999;
            --primary-dark: #0a1470;
            --accent-light: #e8ebff;
            --accent-lighter: #f3f4ff;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --background: #f9fafb;
            --surface: #ffffff;
            --border: #e5e7eb;
            --border-light: #f3f4f6;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .application-id-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .content-grid {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1fr;
        }

        .card {
            background: var(--surface);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            background: var(--accent-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: var(--surface);
            color: var(--text-primary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 24, 131, 0.1);
        }

        .form-control:hover {
            border-color: var(--primary-light);
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-display {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            border: 2px dashed var(--border);
            border-radius: 8px;
            background: var(--accent-lighter);
            transition: all 0.2s ease;
        }

        .file-input-wrapper:hover .file-input-display {
            border-color: var(--primary-color);
            background: var(--accent-light);
        }

        .file-input-icon {
            width: 24px;
            height: 24px;
            color: var(--primary-color);
        }

        .file-input-text {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: var(--border-light);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--border);
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-under-review {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-awaiting-documents {
            background: #fef3c7;
            color: #d97706;
        }

        .status-approved {
            background: #d1fae5;
            color: #059669;
        }

        .status-rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        .document-requests {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .document-request {
            background: var(--accent-lighter);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .document-request:hover {
            background: var(--accent-light);
        }

        .document-request-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .document-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .document-category {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .document-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border: 1px solid;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .card {
                padding: 1.5rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
            margin: 1rem 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="header fade-in">
            <div class="header-content">
                <h1>Edit Application</h1>
                <p>Manage application status and document requests</p>
                <div class="application-id-badge">
                    Application ID: {{ $application->application_id }}
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Update Application Status -->
            <div class="card slide-up">
                <div class="card-header">
                    <div class="card-icon">⚙️</div>
                    <div class="card-title">Update Application Status</div>
                </div>
                
                <form action="{{ route('admin.applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="status" class="form-label">Application Status</label>
                        <select name="status" id="status" class="form-control" onchange="updateStatusPreview(this.value)">
                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="awaiting_documents" {{ $application->status == 'awaiting_documents' ? 'selected' : '' }}>Awaiting Documents</option>
                            <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <div id="status-preview" class="status-indicator status-{{ str_replace('_', '-', $application->status) }}" style="margin-top: 0.5rem;">
                            <span class="status-dot"></span>
                            <span>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="visa_document" class="form-label">Visa Document (PDF)</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="visa_document" id="visa_document" accept="application/pdf" onchange="updateFileName(this)">
                            <div class="file-input-display">
                                <div class="file-input-icon">📄</div>
                                <div class="file-input-text" id="file-text">Choose PDF file or drag and drop</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            💾 Update Application
                        </button>
                    </div>
                </form>
            </div>

            <!-- Request Additional Document -->
            <div class="card slide-up">
                <div class="card-header">
                    <div class="card-icon">📋</div>
                    <div class="card-title">Request Additional Document</div>
                </div>
                
                <form action="{{ route('admin.applications.request-document', $application->id) }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="document_name" class="form-label">Document Name</label>
                        <input type="text" name="document_name" id="document_name" class="form-control" required placeholder="e.g., Passport Copy, Bank Statement">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Provide detailed instructions for the document..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" id="category" class="form-control" required placeholder="e.g., Identity, Financial, Academic">
                    </div>

                    <div class="form-group">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            📤 Request Document
                        </button>
                    </div>
                </form>
            </div>

            <!-- Pending Document Requests -->
            <div class="card slide-up">
                <div class="card-header">
                    <div class="card-icon">📁</div>
                    <div class="card-title">Document Requests</div>
                </div>
                
                @if($application->document_requests->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">📂</div>
                        <p>No document requests yet</p>
                    </div>
                @else
                    <div class="document-requests">
                        @foreach($application->document_requests as $request)
                            <div class="document-request">
                                <div class="document-request-header">
                                    <div class="document-name">{{ $request->document_name }}</div>
                                    <div class="document-category">{{ $request->category }}</div>
                                </div>
                                
                                <div class="status-indicator status-{{ str_replace('_', '-', strtolower($request->status)) }}">
                                    <span class="status-dot"></span>
                                    <span>{{ ucfirst(str_replace('_', ' ', $request->status)) }}</span>
                                </div>
                                
                                @if($request->description)
                                    <p style="margin: 0.5rem 0; color: var(--text-secondary); font-size: 0.875rem;">{{ $request->description }}</p>
                                @endif
                                
                                @if($request->deadline)
                                    <p style="margin: 0.5rem 0; color: var(--text-muted); font-size: 0.875rem;">
                                        <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($request->deadline)->format('M d, Y') }}
                                    </p>
                                @endif
                                
                                @if($request->uploaded_path)
                                    <div class="document-actions">
                                        <a href="{{ url('public/' . $request->uploaded_path) }}" class="btn btn-secondary" target="_blank">
                                            👁️ View Document
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Update status preview
        function updateStatusPreview(status) {
            const preview = document.getElementById('status-preview');
            const statusText = status.replace('_', ' ');
            const statusClass = 'status-' + status.replace('_', '-');
            
            preview.className = 'status-indicator ' + statusClass;
            preview.querySelector('span:last-child').textContent = statusText.charAt(0).toUpperCase() + statusText.slice(1);
        }

        // Update file name display
        function updateFileName(input) {
            const fileText = document.getElementById('file-text');
            if (input.files && input.files[0]) {
                fileText.textContent = input.files[0].name;
            } else {
                fileText.textContent = 'Choose PDF file or drag and drop';
            }
        }

        // Add drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('visa_document');
            const fileDisplay = document.querySelector('.file-input-display');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileDisplay.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                fileDisplay.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileDisplay.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                fileDisplay.style.borderColor = 'var(--primary-color)';
                fileDisplay.style.background = 'var(--accent-light)';
            }

            function unhighlight(e) {
                fileDisplay.style.borderColor = 'var(--border)';
                fileDisplay.style.background = 'var(--accent-lighter)';
            }

            fileDisplay.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0 && files[0].type === 'application/pdf') {
                    fileInput.files = files;
                    updateFileName(fileInput);
                }
            }

            // Add entrance animations
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = 'var(--error-color)';
                    } else {
                        field.style.borderColor = 'var(--border)';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    // You could add a toast notification here
                }
            });
        });
    </script>
</body>
</html>