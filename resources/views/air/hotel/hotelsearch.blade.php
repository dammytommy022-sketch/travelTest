<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: Style for autocomplete suggestions */
        .autocomplete-suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background: #fff;
            z-index: 1000;
        }
        .autocomplete-suggestion {
            padding: 8px;
            cursor: pointer;
        }
        .autocomplete-suggestion:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Search Hotels 1</h1>
        
        <form id="searchForm">
            <div class="mb-3">
                <label for="keyword" class="form-label">Enter Keyword</label>
                <input type="text" class="form-control" id="keyword" placeholder="Enter country or hotel name">
                <div id="suggestions" class="autocomplete-suggestions"></div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        
        <div class="mt-5" id="results">
            <!-- Search results will be displayed here -->
        </div>
    </div>

    <script>
        document.getElementById('keyword').addEventListener('keyup', function() {
            const keyword = this.value;
            if (keyword.length < 2) {
                document.getElementById('suggestions').innerHTML = ''; // Clear suggestions
                return;
            }

            fetch('/search-jsonl', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ keyword: keyword })
            })
            .then(response => response.json())
            .then(data => {
                const suggestionsDiv = document.getElementById('suggestions');
                suggestionsDiv.innerHTML = ''; // Clear previous suggestions

                if (data.error) {
                    suggestionsDiv.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                    return;
                }

                if (data.length > 0) {
                    let html = '';
                    let regionHtml = '<small>Region:</small><br>';
                    let hotelHtml = '<small>Hotels:</small><br>';

                    // Loop through the results to build the regions and hotels separately
                    data.forEach(result => {
                        const countryName = result.country_name ? result.country_name : 'Unknown Country';
                        const stateName = result.name ? result.name : 'Unknown City';
                        const hotels = result.hotels && result.hotels.length > 0 ? result.hotels.join(', ') : 'No Hotels';

                        // Add each region to the regions list, including the data-value attribute for selection
                        regionHtml += `<strong class="autocomplete-suggestion" data-value="${countryName} - ${stateName}">${countryName} - ${stateName}</strong><br>`;

                        // Collect all hotels in a single string
                        hotelHtml += `<small class="autocomplete-suggestion" data-value="${countryName} - ${stateName} - ${hotels}">${hotels}</small><br>`;
                    });

                    // Combine both sections and display them
                    html = `<div>
                                ${regionHtml} <!-- Regions list -->
                                <br>
                                ${hotelHtml}  <!-- Hotels list -->
                            </div>`;

                    suggestionsDiv.innerHTML = html;

                    // Add click event to suggestions
                    suggestionsDiv.querySelectorAll('.autocomplete-suggestion').forEach(item => {
                        item.addEventListener('click', function() {
                            document.getElementById('keyword').value = this.getAttribute('data-value');
                            document.getElementById('suggestions').innerHTML = ''; // Clear suggestions after selection
                        });
                    });
                } else {
                    suggestionsDiv.innerHTML = '<div class="alert alert-warning">No suggestions found</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('suggestions').innerHTML = '<div class="alert alert-danger">An error occurred while fetching suggestions</div>';
            });
        });

    
</script>

</body>
</html>
