<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Applications Dashboard</title>
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
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --background: #f9fafb;
            --surface: #ffffff;
            --border: #e5e7eb;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
            margin-bottom: 2rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            border: 1px solid;
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: currentColor;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: var(--success-color);
            border-color: #a7f3d0;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--surface);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--accent-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary-color);
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .search-container {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input, .status-filter {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .search-input:focus, .status-filter:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 24, 131, 0.1);
        }

        .status-filter {
            flex: 0 0 200px;
        }

        .applications-grid {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .application-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .application-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .application-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .application-id {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .id-badge {
            background: var(--accent-light);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 8px;
            font-size: 0.875rem;
            fontVPN: font-weight: 500;
        }

        .card-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .info-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .email-value {
            color: var(--primary-color);
        }

        .status-badge {
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

        .status-approved {
            background: #d1fae5;
            color: #059669;
        }

        .status-rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-under-review {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-awaiting-documents {
            background: #f3e8ff;
            color: #7c3aed;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        .card-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination-btn {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
            color: var(--text-primary);
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-btn:disabled {
            background: var(--background);
            color: var(--text-muted);
            cursor: not-allowed;
        }

        .table-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .table-toggle:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
        }

        .table-view {
            display: none;
            background: var(--surface);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-view.active {
            display: block;
        }

        .table-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: 1rem 1.5rem;
        }

        .table-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .data-table th {
            background: var(--background);
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .data-table tr:hover {
            background: var(--accent-light);
        }

        .view-toggle-btn {
            background: var(--accent-light);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 1rem;
        }

        .view-toggle-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .card-content {
                grid-template-columns: 1fr;
            }

            .table-toggle {
                bottom: 1rem;
                right: 1rem;
            }

            .search-container {
                flex-direction: column;
            }

            .status-filter {
                width: 100%;
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
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header fade-in">
            <h1>Visa Applications</h1>
            <p>Manage and track all visa applications efficiently</p>
        </div>

        <!-- Success Alert (Blade Template) -->
        @if (session('success'))
            <div class="alert alert-success slide-up">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search, Status Filter, and View Toggle -->
        <div class="search-container">
            <input type="text" class="search-input" id="search-input" placeholder="Search by Application ID or Email...">
            <select class="status-filter" id="status-filter">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="under-review">Under Review</option>
                <option value="awaiting-documents">Awaiting Documents</option>
            </select>
            <button class="view-toggle-btn" onclick="toggleView()">
                <span id="toggle-text">Switch to Table View</span>
            </button>
        </div>

        <!-- Applications Content -->
        @if ($applications->isEmpty())
            <div class="empty-state fade-in">
                <div class="empty-state-icon">📋</div>
                <h3>No Applications Found</h3>
                <p>There are currently no visa applications to display.</p>
            </div>
        @else
            <!-- Card View (Default) -->
            <div class="applications-grid" id="card-view">
                @foreach ($applications as $application)
                    <div class="application-card slide-up" 
                         data-application-id="{{ $application->application_id }}" 
                         data-email="{{ $application->email ?? json_decode($application->user_details)->email }}"
                         data-status="{{ str_replace('_', '-', strtolower($application->status)) }}">
                        <div class="card-header">
                            <div class="application-id">
                                <span class="id-badge">{{ $application->application_id }}</span>
                            </div>
                            <div class="status-badge status-{{ str_replace('_', '-', strtolower($application->status)) }}">
                                <span class="status-dot"></span>
                                {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="info-item">
                                <span class="info-label">Applicant Email</span>
                                <span class="info-value email-value">{{ $application->email ?? json_decode($application->user_details)->email }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Created At</span>
                                <span class="info-value">{{ $application->created_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <a href="{{ route('admin.applications.edit', $application->id) }}" class="btn btn-primary">
                                <span>✏️</span>
                                Edit Application
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Table View (Hidden by default) -->
            <div class="table-view" id="table-view">
                <div class="table-header">
                    <h3>Applications Overview</h3>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Application ID</th>
                                <th>Applicant Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($applications as $application)
                                <tr data-application-id="{{ $application->application_id }}" 
                                    data-email="{{ $application->email ?? json_decode($application->user_details)->email }}"
                                    data-status="{{ str_replace('_', '-', strtolower($application->status)) }}">
                                    <td>
                                        <span class="id-badge">{{ $application->application_id }}</span>
                                    </td>
                                    <td class="email-value">{{ $application->email ?? json_decode($application->user_details)->email }}</td>
                                    <td>
                                        <span class="status-badge status-{{ str_replace('_', '-', strtolower($application->status)) }}">
                                            <span class="status-dot"></span>
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.applications.edit', $application->id) }}" class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" id="pagination">
                <!-- Pagination buttons will be dynamically generated -->
            </div>
        @endif
    </div>

    <script>
        // Application data management
        const ITEMS_PER_PAGE = 5;
        let currentPage = 1;
        let allApplications = [];
        let filteredApplications = [];

        // Initialize application data
        function initializeApplications() {
            const cards = document.querySelectorAll('.application-card');
            allApplications = Array.from(cards).map(card => ({
                element: card,
                id: card.dataset.applicationId,
                email: card.dataset.email,
                status: card.dataset.status
            }));

            const rows = document.querySelectorAll('#table-body tr');
            rows.forEach((row, index) => {
                allApplications[index].tableRow = row;
            });

            filteredApplications = [...allApplications];
            updateDisplay();
        }

        // Update displayed applications
        function updateDisplay() {
            const start = (currentPage - 1) * ITEMS_PER_PAGE;
            const end = start + ITEMS_PER_PAGE;

            // Update card view
            allApplications.forEach(app => {
                app.element.style.display = 'none';
            });
            filteredApplications.slice(start, end).forEach(app => {
                app.element.style.display = 'block';
            });

            // Update table view
            allApplications.forEach(app => {
                if (app.tableRow) app.tableRow.style.display = 'none';
            });
            filteredApplications.slice(start, end).forEach(app => {
                if (app.tableRow) app.tableRow.style.display = 'table-row';
            });

            updatePagination();
        }

        // Update pagination controls
        function updatePagination() {
            const totalPages = Math.ceil(filteredApplications.length / ITEMS_PER_PAGE);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'pagination-btn';
            prevBtn.textContent = 'Previous';
            prevBtn.disabled = currentPage === 1;
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateDisplay();
                }
            });
            pagination.appendChild(prevBtn);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                btn.textContent = i;
                btn.addEventListener('click', () => {
                    currentPage = i;
                    updateDisplay();
                });
                pagination.appendChild(btn);
            }

            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = 'pagination-btn';
            nextBtn.textContent = 'Next';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateDisplay();
                }
            });
            pagination.appendChild(nextBtn);
        }

        // Filter functionality
        function handleFilter() {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const searchTerm = searchInput.value.toLowerCase().trim();
            const statusTerm = statusFilter.value;

            filteredApplications = allApplications.filter(app => {
                const matchesSearch = !searchTerm || 
                    app.id.toLowerCase().includes(searchTerm) || 
                    app.email.toLowerCase().includes(searchTerm);
                const matchesStatus = !statusTerm || app.status === statusTerm;
                return matchesSearch && matchesStatus;
            });

            currentPage = 1;
            updateDisplay();
        }

        // View toggle functionality
        function toggleView() {
            const cardView = document.getElementById('card-view');
            const tableView = document.getElementById('table-view');
            const toggleText = document.getElementById('toggle-text');
            
            if (cardView.style.display === 'none') {
                cardView.style.display = 'grid';
                tableView.classList.remove('active');
                toggleText.textContent = 'Switch to Table View';
            } else {
                cardView.style.display = 'none';
                tableView.classList.add('active');
                toggleText.textContent = 'Switch to Card View';
            }
            updateDisplay();
        }

        // Add entrance animations to cards
        function animateCards() {
            const cards = document.querySelectorAll('.application-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeApplications();
            animateCards();
            
            // Add event listeners for search and filter
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            searchInput.addEventListener('input', handleFilter);
            statusFilter.addEventListener('change', handleFilter);

            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>