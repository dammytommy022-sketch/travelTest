<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Visa Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f7f9fc;
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #6b7280;
            font-size: 1rem;
        }

        .success-alert {
            background: #e6fffa;
            color: #2f855a;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #38a169;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-bar {
            position: relative;
            flex: 1;
            max-width: 350px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            color: #333;
            font-size: 0.9rem;
            transition: border-color 0.2s ease;
        }

        .search-input::placeholder {
            color: #a0aec0;
        }

        .search-input:focus {
            outline: none;
            border-color: #4299e1;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 0.9rem;
        }

        .create-btn {
            background: #4299e1;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s ease;
        }

        .create-btn:hover {
            background: #3182ce;
            text-decoration: none;
            color: white;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            background: #edf2f7;
            padding: 0.25rem;
            border-radius: 8px;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border: none;
            background: transparent;
            color: #4a5568;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .filter-tab.active {
            background: white;
            color: #1a202c;
        }

        .visa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .visa-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            transition: box-shadow 0.2s ease;
        }

        .visa-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .country-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .country-flag {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #edf2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a5568;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .country-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a202c;
        }

        .visa-type-badge {
            padding: 0.25rem 0.2rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .visa-type-tourist {
            background: #e6fffa;
            color: #38a169;
        }

        .visa-type {
            background: #ebf4ff;
            color: #4299e1;
        }

        .visa-type-transit {
            background: #fff8eb;
            color: #dd6b20;
        }

        .visa-type-work {
            background: #f5f3ff;
            color: #805ad5;
        }

        .card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 1rem 0;
        }

        .detail-item {
            text-align: center;
            padding: 0.75rem;
            background: #f7fafc;
            border-radius: 8px;
            transition: background 0.2s ease;
        }

        .detail-item:hover {
            background: #edf2f7;
        }

        .detail-label {
            font-size: 0.75rem;
            color: #718096;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a202c;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .action-btn {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .edit-btn {
            background: #4299e1;
            color: white;
        }

        .edit-btn:hover {
            background: #3182ce;
            color: white;
            text-decoration: none;
        }

        .delete-btn {
            background: #f56565;
            color: white;
        }

        .delete-btn:hover {
            background: #e53e3e;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.6;
        }

        .empty-title {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-item {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            text-align: center;
            color: #1a202c;
            border: 1px solid #e2e8f0;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #718096;
            text-transform: uppercase;
        }

        .loading-spinner {
            display: none;
            width: 30px;
            height: 30px;
            border: 3px solid #e2e8f0;
            border-top: 3px solid #4299e1;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 1.5rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .container { padding: 1rem; }
            .header h1 { font-size: 2rem; }
            .controls { flex-direction: column; align-items: stretch; }
            .search-bar { max-width: none; }
            .visa-grid { grid-template-columns: 1fr; }
            .stats-bar { gap: 1rem; }
            .stat-item { padding: 0.75rem 1rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-passport"></i> Visa Management</h1>
            <p>Manage and organize visa applications with ease</p>
        </div>

        @if (session('success'))
            <div class="success-alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="stats-bar">
            <div class="stat-item">
                <span class="stat-number" id="totalVisas">{{ count($visas) }}</span>
                <span class="stat-label">Total Visas</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" id="activeVisas">{{ count($visas) }}</span>
                <span class="stat-label">Active</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" id="countries">{{ $visas->unique('country.name')->count() }}</span>
                <span class="stat-label">Countries</span>
            </div>
        </div>

        <div class="controls">
            <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search visas by country or type..." id="searchInput">
            </div>
            
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">All</button>
                <button class="filter-tab" data-filter="tourist">Tourist</button>
                <button class="filter-tab" data-filter="business">Business</button>
                <button class="filter-tab" data-filter="transit">Transit</button>
                <button class="filter-tab" data-filter="work">Work</button>
            </div>

            <a href="{{ route('admin.visas.create') }}" class="create-btn">
                <i class="fas fa-plus"></i>
                Create New Visa
            </a>
            
             <a href="{{ route('admin.applications.index') }}" class="create-btn">
    <i class="fas fa-folder-open"></i>
    Applications
</a>

        </div>

        <div class="loading-spinner" id="loadingSpinner"></div>

        <div class="visa-grid" id="visaGrid">
            @forelse ($visas as $index => $visa)
                <div class="visa-card" data-country="{{ strtolower($visa->country->name) }}" data-type="{{ strtolower(str_replace(' ', '', $visa->visa_type)) }}">
                    <div class="card-header">
                        <div class="country-info">
                            <div class="country-flag">
                                {{ strtoupper(substr($visa->country->name, 0, 2)) }}
                            </div>
                            <div class="country-name">{{ $visa->country->name }}</div>
                        </div>
                        <div class="visa-type-badge visa-type-{{ strtolower(str_replace(' ', '', $visa->visa_type)) }}">
                            {{ $visa->visa_type }}
                        </div>
                    </div>

                    <div class="card-details">
                        <div class="detail-item">
                            <div class="detail-label">Processing</div>
                            <div class="detail-value">{{ $visa->processing_days }}<small>d</small></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Valid For</div>
                            <div class="detail-value">{{ $visa->validity_days }}<small>d</small></div>
                        </div>
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('admin.visas.edit', $visa->id) }}" class="action-btn edit-btn">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <form action="{{ route('admin.visas.destroy', $visa->id) }}" method="POST" style="flex: 1;" 
                              onsubmit="return confirmDelete('{{ $visa->country->name }}', '{{ $visa->visa_type }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" style="width: 100%;">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-passport"></i>
                    </div>
                    <div class="empty-title">No Visas Found</div>
                    <p>Start by creating your first visa entry</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const visaCards = document.querySelectorAll('.visa-card');
        const loadingSpinner = document.getElementById('loadingSpinner');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            loadingSpinner.style.display = 'block';
            
            setTimeout(() => {
                visaCards.forEach(card => {
                    const country = card.dataset.country;
                    const type = card.dataset.type;
                    
                    if (country.includes(searchTerm) || type.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                loadingSpinner.style.display = 'none';
                updateStats();
            }, 300);
        });

        // Filter functionality
        const filterTabs = document.querySelectorAll('.filter-tab');
        
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                filterTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                loadingSpinner.style.display = 'block';
                
                setTimeout(() => {
                    visaCards.forEach(card => {
                        if (filter === 'all' || card.dataset.type === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                    
                    loadingSpinner.style.display = 'none';
                    updateStats();
                }, 300);
            });
        });

        // Update statistics
        function updateStats() {
            const visibleCards = document.querySelectorAll('.visa-card[style*="display: block"], .visa-card:not([style*="display: none"])');
            const totalVisasElement = document.getElementById('totalVisas');
            const activeVisasElement = document.getElementById('activeVisas');
            
            animateCounter(totalVisasElement, visibleCards.length);
            animateCounter(activeVisasElement, visibleCards.length);
        }

        function animateCounter(element, target) {
            const start = parseInt(element.textContent) || 0;
            const increment = target > start ? 1 : -1;
            const timer = setInterval(() => {
                const current = parseInt(element.textContent);
                if (current === target) {
                    clearInterval(timer);
                } else {
                    element.textContent = current + increment;
                }
            }, 50);
        }

        // Delete confirmation
        function confirmDelete(country, visaType) {
            return confirm(`Are you sure you want to delete the ${visaType} visa for ${country}? This action cannot be undone.`);
        }
    </script>
</body>
</html>