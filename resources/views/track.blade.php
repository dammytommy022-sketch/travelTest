<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Application Tracker</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0d1883;
            --primary-light: #1a2199;
            --primary-dark: #0a1470;
            --secondary: #f8fafc;
            --accent: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --white: #ffffff;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: 100vh;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease-out;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
            animation: slideIn 0.5s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-color: var(--success);
            color: #065f46;
        }

        .alert-error {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            border-color: var(--error);
            color: #991b1b;
        }

        .tracking-form {
            background: var(--white);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--accent);
            max-width: 500px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--accent);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 24, 131, 0.1);
            transform: translateY(-1px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-family: inherit;
            min-width: 140px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 24, 131, 0.3);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-1px);
        }

        .applications-grid {
            display: grid;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .application-card {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--accent);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        .application-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .application-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--secondary);
        }

        .application-id {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .status-under-review {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .status-awaiting-documents {
            background: linear-gradient(135deg, #fef3c7 0%, #fdd68a 100%);
            color: #92400e;
        }

        .status-approved {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .status-rejected {
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
            color: #991b1b;
        }

        .document-section {
            margin-top: 2rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .document-item {
            background: var(--secondary);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--accent);
        }

        .document-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .document-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .document-category {
            background: var(--primary);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .upload-area {
            border: 2px dashed var(--accent);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            margin-top: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: rgba(13, 24, 131, 0.02);
        }

        .upload-area.dragover {
            border-color: var(--primary);
            background: rgba(13, 24, 131, 0.05);
        }

        .file-input {
            display: none;
        }

        .download-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .download-link:hover {
            color: var(--primary-light);
            transform: translateX(2px);
        }

        .deadline {
            color: var(--warning);
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .clear-search {
            text-align: center;
            margin-top: 2rem;
        }

        .clear-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .clear-link:hover {
            color: var(--primary-light);
        }

        .icon {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .tracking-form {
                padding: 1.5rem;
            }

            .application-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .application-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header">
            <h1>Visa Application Tracker</h1>
            <p>Track your visa application status and manage document requests with ease</p>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success" id="successAlert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @else
            <div class="alert alert-success" id="successAlert" style="display: none;">
                <strong>Success!</strong> <span id="successMessage"></span>
            </div>
        @endif

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="alert alert-error" id="errorAlert">
                <strong>Error!</strong> {{ $errors->first() }}
            </div>
        @else
            <div class="alert alert-error" id="errorAlert" style="display: none;">
                <strong>Error!</strong> <span id="errorMessage"></span>
            </div>
        @endif

        <!-- Tracking Form -->
        <div class="tracking-form" id="trackingForm" @if($applications) style="display: none;" @endif>
            <form id="emailForm" action="{{ route('track.validate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email address" required>
                </div>
                <div class="form-group">
                    <label for="applicationId" class="form-label">Application ID (Optional)</label>
                    <input type="text" id="applicationId" name="application_id" class="form-input" placeholder="Enter your application ID">
                </div>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Track Applications
                </button>
            </form>
        </div>

        <!-- Applications Display -->
        <div class="applications-grid" id="applicationsGrid" @if(!$applications) style="display: none;" @endif>
            @if($applications)
                @foreach($applications as $application)
                    <div class="application-card">
                        <div class="application-header">
                            <div class="application-id">{{ $application->application_id }}</div>
                            <div class="status-badge status-{{ str_replace('_', '-', $application->status) }}">{{ ucfirst(str_replace('_', ' ', $application->status)) }}</div>
                        </div>
                        
                        @if($application->visa_document_path)
                            <div class="download-link" style="margin-bottom: 1rem;">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M12 15l-4-4h3V4h2v7h3l-4 4z"/>
                                    <path d="M2 17h20v2H2z"/>
                                </svg>
                                <a href="{{ asset('public/'.$application->visa_document_path) }}">Download Visa Document</a>
                            </div>
                        @endif

                        <div class="document-section">
                            <h3 class="section-title">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Document Requests
                            </h3>
                            
                            @if($application->document_requests->isEmpty())
                                <p>No pending document requests.</p>
                            @else
                                @foreach($application->document_requests as $request)
                                    <div class="document-item">
                                        <div class="document-header">
                                            <span class="document-name">{{ $request->document_name }}</span>
                                            <span class="document-category">{{ $request->category }}</span>
                                        </div>
                                        @if($request->description)
                                            <p>{{ $request->description }}</p>
                                        @endif
                                        @if($request->deadline)
                                            <div class="deadline">Deadline: {{ $request->deadline ? \Carbon\Carbon::parse($request->deadline)->format('M d, Y') : 'No deadline set' }}</div>
                                        @endif
                                        
                                        @if($request->status == 'requested')
                                            <div class="upload-area" onclick="triggerFileInput('file-{{ $request->id }}')">
                                                <input type="file" id="file-{{ $request->id }}" class="file-input" accept="application/pdf,image/jpeg,image/png" data-application-id="{{ $application->id }}" data-request-id="{{ $request->id }}">
                                                <svg class="icon" viewBox="0 0 24 24" style="width: 48px; height: 48px; margin-bottom: 1rem; color: var(--text-secondary);">
                                                    <path d="M7 14l5-5 5 5m-5-5v12"/>
                                                </svg>
                                                <p>Click to upload or drag and drop</p>
                                                <p style="font-size: 0.875rem; color: var(--text-secondary); margin-top: 0.5rem;">PDF, JPG, PNG up to 10MB</p>
                                            </div>
                                        @endif

                                        @if($request->uploaded_path)
                                            <div class="download-link" style="margin-top: 1rem;">
                                                <svg class="icon" viewBox="0 0 24 24">
                                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <a href="{{ asset('public/'.$request->uploaded_path) }}">View Uploaded Document</a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="clear-search" id="clearSearch" @if(!$applications) style="display: none;" @endif>
            <a href="{{ route('track.application', ['clear' => 'true']) }}" class="clear-link" onclick="clearSearch(event)">
                <svg class="icon" viewBox="0 0 24 24" style="display: inline-block; margin-right: 0.5rem;">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Clear Search & Start Over
            </a>
        </div>
    </div>
<script>
    const baseAssetUrl = "{{ asset('') }}";
</script>

    <script>
        // Form submission handler
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const applicationId = document.getElementById('applicationId').value;
           const csrfToken = document.querySelector('input[name="_token"]').value;
           console.log(csrfToken)


            fetch('{{ route('track.validate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    email: email,
                    application_id: applicationId,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                if (data.success) {
                    showApplications(data.applications);
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                showError('An error occurred. Please try again.');
                console.error(error);
            });
        });

        function showApplications(applications) {
            const applicationsGrid = document.getElementById('applicationsGrid');
            applicationsGrid.innerHTML = '';

            applications.forEach(app => {
                const card = document.createElement('div');
                card.className = 'application-card';
                card.style.animationDelay = `${applications.indexOf(app) * 0.1}s`;
                card.innerHTML = `
                    <div class="application-header">
                        <div class="application-id">${app.application_id}</div>
                        <div class="status-badge status-${app.status.toLowerCase().replace(' ', '-') || 'pending'}">${app.status}</div>
                    </div>
                    ${app.visa_document_path ? `
                        <div class="download-link" style="margin-bottom: 1rem;">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12 15l-4-4h3V4h2v7h3l-4 4z"/>
                                <path d="M2 17h20v2H2z"/>
                            </svg>
                           <a href="${baseAssetUrl}public/${app.visa_document_path}">Download Visa Document</a>

                        </div>
                    ` : ''}
                    <div class="document-section">
                        <h3 class="section-title">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Document Requests
                        </h3>
                        ${app.document_requests.length === 0 ? '<p>No pending document requests.</p>' : 
                            app.document_requests.map(req => `
                                <div class="document-item">
                                    <div class="document-header">
                                        <span class="document-name">${req.document_name}</span>
                                        <span class="document-category">${req.category}</span>
                                    </div>
                                    ${req.description ? `<p>${req.description}</p>` : ''}
                                    ${req.deadline ? `<div class="deadline">Deadline: ${req.deadline}</div>` : ''}
                                    ${req.status === 'Requested' ? `
                                        <div class="upload-area" onclick="triggerFileInput('file-${req.id}')">
                                            <input type="file" id="file-${req.id}" class="file-input" accept="application/pdf,image/jpeg,image/png" data-application-id="${app.id}" data-request-id="${req.id}">
                                            <svg class="icon" viewBox="0 0 24 24" style="width: 48px; height: 48px; margin-bottom: 1rem; color: var(--text-secondary);">
                                                <path d="M7 14l5-5 5 5m-5-5v12"/>
                                            </svg>
                                            <p>Click to upload or drag and drop</p>
                                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin-top: 0.5rem;">PDF, JPG, PNG up to 10MB</p>
                                        </div>
                                    ` : ''}
                                    ${req.uploaded_path ? `
                                        <div class="download-link" style="margin-top: 1rem;">
                                            <svg class="icon" viewBox="0 0 24 24">
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <a href="${baseAssetUrl}public/${req.uploaded_path}">View Uploaded Document</a>
                                        </div>
                                    ` : ''}
                                </div>
                            `).join('')}
                    </div>
                `;
                applicationsGrid.appendChild(card);
            });

            document.getElementById('trackingForm').style.display = 'none';
            applicationsGrid.style.display = 'block';
            document.getElementById('clearSearch').style.display = 'block';
        }

        function clearSearch(event) {
            event.preventDefault();
            fetch('{{ route('track.application', ['clear' => 'true']) }}', {
                method: 'GET',
            })
            .then(() => {
                document.getElementById('trackingForm').style.display = 'block';
                document.getElementById('applicationsGrid').style.display = 'none';
                document.getElementById('clearSearch').style.display = 'none';
                document.getElementById('emailForm').reset();
            })
            .catch(error => {
                console.error('Error clearing search:', error);
            });
        }

        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            document.getElementById('errorMessage').textContent = message;
            errorAlert.style.display = 'block';
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 5000);
        }

        function showSuccess(message) {
            const successAlert = document.getElementById('successAlert');
            document.getElementById('successMessage').textContent = message;
            successAlert.style.display = 'block';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000);
        }

        function triggerFileInput(inputId) {
            document.getElementById(inputId).click();
        }

        // File upload handling
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('file-input')) {
                const file = e.target.files[0];
                if (file) {
                    const applicationId = e.target.dataset.applicationId;
                    const requestId = e.target.dataset.requestId;
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    const formData = new FormData();
                    formData.append('document', file);
                    formData.append('document_request_id', requestId);
                    formData.append('_token', csrfToken);

                    fetch(`/track/upload/${applicationId}`, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccess(data.message);
                            const uploadArea = e.target.parentElement;
                            uploadArea.innerHTML = `
                                <div style="color: var(--success); font-weight: 500;">
                                    <svg class="icon" viewBox="0 0 24 24" style="width: 24px; height: 24px; margin-right: 0.5rem;">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    ${data.file_name} uploaded successfully
                                </div>
                            `;
                        } else {
                            showError(data.message);
                        }
                    })
                    .catch(error => {
                        showError('An error occurred during upload. Please try again.');
                        console.error(error);
                    });
                }
            }
        });

        // Drag and drop functionality
        document.querySelectorAll('.upload-area').forEach(area => {
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            area.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const fileInput = this.querySelector('.file-input');
                    fileInput.files = files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });
        });

        // Smooth scroll and animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.application-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>