<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <!-- ASSETS -->
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/app/themes/default/assets/css/childstyle.css') }}">

    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery/jquery.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    
    <!-- Include jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- RTL -->

    <style>
        /* Optional: Style for autocomplete suggestions */
        .autocomplete-suggestions {
            border: 1px solid #ccc;
            max-height: 350px;
            overflow-y: auto;
            position: absolute;
            background: #fff;
            z-index: 1000;
        }
        .autocomplete-suggestion {
            padding: 10px;
            cursor: pointer;
        }
        .autocomplete-suggestion:hover {
            background: #ddd;
        }
        .widget_cover{
            padding: 100px;
            padding-top: 100px;  
        }

        @media only screen and (max-width: 985px) {
            .widget_cover {
                padding: 10px;
            }
        }
        @media only screen and (max-width: 885px) {
            .widget_cover {
                padding: 0px;
            }
        }

        #loading-screen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
            z-index: 9999; /* Ensure it's above other content */
            text-align: center;
        }

        #loading-screen img {
            margin-top: 15%; /* Adjust this value to center the image vertically */
            max-width: 40%;
            max-height: 40%;
        }

        @media (max-width: 768px) {
            #loading-screen img {
                margin-top: 20%; /* Adjust for smaller screens */
            }
        }        
        .datepicker table tr td.day.old,
        .datepicker table tr td.day.new {
            visibility: hidden;
        }

        .new-room-selection-dropdown {
            border: 1px solid #ccc;
            padding: 15px;
            background-color: white;
            display: none;
            position: absolute; /* Set to absolute to exceed parent width */
            right: 0; /* Align with the left of the parent */
            width: 250px; /* This exceeds the parent's width */
            z-index: 10; /* Ensure it appears on top if necessary */
        }

        

        .new-room-controls {
            display: block;
            justify-content: space-between;
        }

        .new-adults, .new-children {
            margin-right: 10px;
        }

        .new-input-group {
            display: flex;
            align-items: center;
        }

        .new-input-group button {
            width: 30px;
            height: 30px;
            background-color: #f1f1f1;
            border: none;
        }

        .new-input-group input {
            width: 40px;
            text-align: center;
        }

        .new-add-room-btn, .new-done-btn {
            margin-top: 10px;
            padding: 5px 20px;
            background-color: #0d1883;
            border: none;
            cursor: pointer;
            color: white;
        }

#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    flex-direction: column; /* Centers the image and text vertically */
}

.loader img {
    width: 500px; /* Adjust width as per your requirement */
    height: auto; /* Maintains aspect ratio */
}
/* Style for children's ages container */
.children-ages-container {
    margin-top: 10px;
    border-top: 1px solid #ddd; /* Optional: Adds a divider above children's age inputs */
    padding-top: 10px; /* Space between the divider and inputs */
}

/* Style for each age input field */
.children-age-input {
    display: flex;
    align-items: center;
    margin-bottom: 10px; /* Space between age input fields */
}

/* Style for labels */
.children-age-input label {
    flex: 0 0 30%; /* Adjust label width */
    margin-right: 10px; /* Space between label and input */
    font-weight: bold; /* Make the label bold */
    font-size: 14px; /* Adjust font size */
}

/* Style for input fields */
.children-age-input input {
    flex: 1; /* Allow input to take up remaining space */
    padding: 8px; /* Add padding for better touch area */
    border: 1px solid #ccc; /* Border color */
    border-radius: 4px; /* Rounded corners */
    font-size: 14px; /* Adjust font size */
    transition: border-color 0.3s; /* Smooth transition for border color */
}

/* Style for input focus state */
.children-age-input input:focus {
    border-color: #007bff; /* Change border color on focus */
    outline: none; /* Remove default outline */
}

/* Responsive design */
@media (max-width: 768px) {
    .children-age-input {
        flex-direction: column; /* Stack label and input vertically on smaller screens */
        align-items: flex-start; /* Align items to the start */
    }
    
    .children-age-input label {
        margin-bottom: 5px; /* Space below the label */
    }
}



    </style>
</head>

<body>
           
    <section class=" widget_cover"  style="background-image: url('{{ asset('public/assets/image/Hotel_banner.jpg') }}');"> 
        <div class="container-fluid" id="cover">
            <div class="card ">
                <div style="" id="fadein">
                    <form autocomplete="off" id="my-form" class="main_search" action="{{ route('hotels-list')}}" method="GET">
                        {{ csrf_field() }}
                        <div class="row contact-form-action g-1">
                            <div class="col-lg-4 col-md-12 ">
                                <div class="input-box input-items">
                                    <label class="label-text">Hotel</label>
                                    <div class="form-group">
                                        <span class="la la-hotel form-icon"></span>
                                        <input class="form-control" type="search" id="keyword" placeholder="Search Country, City, Hotel" name="location"  value="" multiple required>
                                        <input type="hidden" id="extraData" name="hotel_regionID" value="">
                                        <div id="suggestions" class="col-lg-12 autocomplete-suggestions"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="input-box">
                                    <label class="label-text">Check-In </label>
                                    <div class="form-group">
                                        <span class="la la-calendar form-icon"></span>
                                        <input class="depart form-control" id="departure" name="check-in"
                                            type="text" placeholder="mm/dd/yyyy" required>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="input-box">
                                    <label class="label-text">Check-Out</label>
                                    <div class="form-group">
                                        <span class="la la-calendar form-icon"></span>
                                        <input class="returning form-control dateright border-top-l0"
                                            name="check-out" type="text" id="return" placeholder="mm/dd/yyyy ">
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="input-box">
    <label class="label-text">Room & Guest </label>
    <div class="form-group">
        <div class="dropdown dropdown-contain">
            <span class="la la-bed form-icon"></span>
            <input type="hidden" name="room" id="no_room" value="1">
            <input type="hidden" name="guest" id="no_guest" value="1">
            <input type="hidden" name="adult" id="no_adult" value="1">
            <input type="hidden" name="child" id="no_child" value="0">

            <a class="dropdown-toggle dropdown-btn travellers-new ps-5" href="#" role="button"
            data-toggle="dropdown" aria-expanded="false">
                <p style="font-size:12px;">
                    <span class="new-rooms">1</span> Room,
                    <span class="new-guests">1</span> Guests
                </p> 
            </a>

            <div class="dropdown-menu new-room-selection-dropdown">
                <div id="rooms-container">
                    <div class="new-room" data-room="1">
                        <h6>Room 1</h6>
                        <div class="new-room-controls">
                            <div class="row">
                                <div class="col-6">
                                    <div class="new-adults">
                                        <label>Adults</label>
                                        <div class="new-input-group">
                                            <button class="new-minus-adult">-</button>
                                            <input type="number" value="1" min="1" class="new-adults-count">
                                            <button class="new-plus-adult">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="new-children">
                                        <label>Children (0 - 17)yrs</label>
                                        <div class="new-input-group ">
                                            <button class="new-minus-child">-</button>
                                            <input type="number" value="0" min="0" class="new-children-count">
                                            <button class="new-plus-child">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container for children's ages -->
                        <div class="children-ages-container"></div>
                        <div class="text-end">
                            <small>
                                <a href="#" class="remove-room" style="color: red; display: none;"> Remove Room</a>
                            </small>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 pt-2">
                        <small>
                            <a href="#" id="add-room-btn">+ Add a room</a>
                        </small>
                    </div>
                    <div class="col-6 text-end">
                        <button class="new-done-btn">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                            </div>

                            <div class="col-lg-12">
                                <div class="col-lg-2 col-md-3 mx-auto">
                                    <div class="btn-search text-center">
                                        <!-- <input type="submit" class=" w-100 btn-lg " value="Book Your Flight" data-style="zoom-in"> -->
                                        <button class="theme-btn w-100 mx-auto" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>

                            
                       </div> 
                            
                    
<label for="residency">Residency</label>
<select name="residency" id="residency" class="form-control">
    <option value="ng" selected>Nigeria</option>
    <option value="ad">Andorra</option>
    <option value="ae">United Arab Emirates</option>
    <option value="af">Afghanistan</option>
    <option value="ag">Antigua and Barbuda</option>
    <option value="ai">Anguilla</option>
    <option value="al">Albania</option>
    <option value="am">Armenia</option>
    <option value="ao">Angola</option>
    <option value="aq">Antarctica</option>
    <option value="ar">Argentina</option>
    <option value="as">American Samoa</option>
    <option value="at">Austria</option>
    <option value="au">Australia</option>
    <option value="aw">Aruba</option>
    <option value="ax">Åland Islands</option>
    <option value="az">Azerbaijan</option>
    <option value="ba">Bosnia and Herzegovina</option>
    <option value="bb">Barbados</option>
    <option value="bd">Bangladesh</option>
    <option value="be">Belgium</option>
    <option value="bf">Burkina Faso</option>
    <option value="bg">Bulgaria</option>
    <option value="bh">Bahrain</option>
    <option value="bi">Burundi</option>
    <option value="bj">Benin</option>
    <option value="bl">Saint Barthélemy</option>
    <option value="bm">Bermuda</option>
    <option value="bn">Brunei Darussalam</option>
    <option value="bo">Bolivia</option>
    <option value="bq">Bonaire, Sint Eustatius and Saba</option>
    <option value="br">Brazil</option>
    <option value="bs">Bahamas</option>
    <option value="bt">Bhutan</option>
    <option value="bv">Bouvet Island</option>
    <option value="bw">Botswana</option>
    <option value="by">Belarus</option>
    <option value="bz">Belize</option>
    <option value="ca">Canada</option>
    <option value="cc">Cocos (Keeling) Islands</option>
    <option value="cd">Democratic Republic of the Congo</option>
    <option value="cf">Central African Republic</option>
    <option value="cg">Republic of the Congo</option>
    <option value="ch">Switzerland</option>
    <option value="ci">Côte d’Ivoire</option>
    <option value="ck">Cook Islands</option>
    <option value="cl">Chile</option>
    <option value="cm">Cameroon</option>
    <option value="cn">China</option>
    <option value="co">Colombia</option>
    <option value="cr">Costa Rica</option>
    <option value="cu">Cuba</option>
    <option value="cv">Cabo Verde</option>
    <option value="cw">Curaçao</option>
    <option value="cx">Christmas Island</option>
    <option value="cy">Cyprus</option>
    <option value="cz">Czechia</option>
    <option value="de">Germany</option>
    <option value="dj">Djibouti</option>
    <option value="dk">Denmark</option>
    <option value="dm">Dominica</option>
    <option value="do">Dominican Republic</option>
    <option value="dz">Algeria</option>
    <option value="ec">Ecuador</option>
    <option value="ee">Estonia</option>
    <option value="eg">Egypt</option>
    <option value="eh">Western Sahara</option>
    <option value="er">Eritrea</option>
    <option value="es">Spain</option>
    <option value="et">Ethiopia</option>
    <option value="fi">Finland</option>
    <option value="fj">Fiji</option>
    <option value="fk">Falkland Islands</option>
    <option value="fm">Micronesia</option>
    <option value="fo">Faroe Islands</option>
    <option value="fr">France</option>
    <option value="ga">Gabon</option>
    <option value="gb">United Kingdom</option>
    <option value="gd">Grenada</option>
    <option value="ge">Georgia</option>
    <option value="gf">French Guiana</option>
    <option value="gh">Ghana</option>
    <option value="gi">Gibraltar</option>
    <option value="gl">Greenland</option>
    <option value="gm">Gambia</option>
    <option value="gn">Guinea</option>
    <option value="gq">Equatorial Guinea</option>
    <option value="gr">Greece</option>
    <option value="gt">Guatemala</option>
    <option value="gu">Guam</option>
    <option value="gw">Guinea-Bissau</option>
    <option value="gy">Guyana</option>
    <option value="hk">Hong Kong</option>
    <option value="hn">Honduras</option>
    <option value="hr">Croatia</option>
    <option value="ht">Haiti</option>
    <option value="hu">Hungary</option>
    <option value="id">Indonesia</option>
    <option value="ie">Ireland</option>
    <option value="il">Israel</option>
    <option value="in">India</option>
    <option value="iq">Iraq</option>
    <option value="ir">Iran</option>
    <option value="is">Iceland</option>
    <option value="it">Italy</option>
    <option value="jm">Jamaica</option>
    <option value="jo">Jordan</option>
    <option value="jp">Japan</option>
    <option value="ke">Kenya</option>
    <option value="kg">Kyrgyzstan</option>
    <option value="kh">Cambodia</option>
    <option value="kp">North Korea</option>
    <option value="kr">South Korea</option>
    <option value="kw">Kuwait</option>
    <option value="kz">Kazakhstan</option>
    <option value="lb">Lebanon</option>
    <option value="lk">Sri Lanka</option>
    <option value="lt">Lithuania</option>
    <option value="lu">Luxembourg</option>
</select>

</form>
                </div>
                @if(session('error'))
                    <span class="alert text-warning">
                        {{ session('error') }}
                    </span>
                @endif

            </div>
        </div>
    </section>
    <!--<div id="preloader" style="display: none;">-->
    <!--    <div class="loader"> <img src="{{ asset('/public/assets/loading.gif') }}" alt="Logo"></div>-->
    <!--    <p>Searching Hotels, please wait...</p>-->
    <!--</div>-->
    
    
   <script>
       // When the search button is clicked, show the preloader
document.getElementById('my-form').addEventListener('submit', function() {
    // Show the preloader
    document.getElementById('preloader').style.display = 'flex';
    
    // Simulate page load (Replace this with your AJAX call or form submission)
    setTimeout(function() {
        // Hide preloader when the search page is ready
        document.getElementById('preloader').style.display = 'none';
    }, 300000); // Replace with actual completion time or AJAX success event
});

   </script>
    <script>
        document.querySelector('.travellers-new').addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector('.new-room-selection-dropdown').classList.toggle('show');
        });

        document.querySelectorAll('.new-minus').forEach(function (button) {
            button.addEventListener('click', function () {
                let input = this.nextElementSibling;
                if (input.value > 1) {
                    input.value--;
                }
            });
        });

        document.querySelectorAll('.new-plus').forEach(function (button) {
            button.addEventListener('click', function () {
                let input = this.previousElementSibling;
                input.value++;
            });
        });

        document.querySelector('.new-add-room-btn').addEventListener('click', function () {
            // Logic to add more room selections
            alert('Add room functionality here');
        });

        document.querySelector('.new-done-btn').addEventListener('click', function () {
            // Logic when Done is clicked
            alert('Done clicked');
        });

    </script>
    <script>
        $(document).ready(function(){
            $('#departure', '#return').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true,
                todayHighlight: true,
                // Hide dates of previous and next months
                beforeShowDay: function(date) {
                    var currentDate = new Date();
                    var currentMonth = currentDate.getMonth();
                    var dateMonth = date.getMonth();
                    var isCurrentMonth = dateMonth === currentMonth;
                    return isCurrentMonth ? 'active' : 'disabled';
                }
            });
        });
        

    </script>
   
    <!-- Make sure you load your countrys.js file -->
    
    <!-- The hidden input field to store the extra data -->
    <script>
        // Function to find country name by its code
        function getCountryNameByCode(code) {
            const country = countries.find(c => c.code === code);
            return country ? country.name : code; // Return country name or fallback to code
        }

        document.getElementById('keyword').addEventListener('keyup', function() {
            const keyword = this.value;
            if (keyword.length < 3) {
                document.getElementById('suggestions').innerHTML = ''; // Clear suggestions
                return;
            }

            $.ajax({
                url: '/autocomplete', // Your Laravel route
                method: 'POST',
                data: {
                    query: keyword, // Send the keyword to the backend
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                    const suggestionsDiv = document.getElementById('suggestions');
                    suggestionsDiv.innerHTML = ''; // Clear previous suggestions

                    if (response.error) {
                        suggestionsDiv.innerHTML = `<div class="alert alert-danger">${response.error}</div>`;
                        return;
                    }

                    const hotels = response.data.hotels || [];
                    const regions = response.data.regions || [];

                    if (hotels.length === 0 && regions.length === 0) {
                        suggestionsDiv.innerHTML = '<div class="alert alert-warning">No suggestions found</div>';
                        return;
                    }

                    let regionHtml = '<small><b>Regions:</b></small><br>';
                    let hotelHtml = '<small><b>Hotels:</b></small><br>';

                    // Process regions
                    regions.forEach(region => {
                        const countryCode = region.country_code;
                        const countryName = getCountryNameByCode(countryCode); // Get the country name using the function
                        regionHtml += `<strong class="autocomplete-suggestion d-block" data-id="${region.id}" data-type="region" data-country-code="${countryCode}" data-name="${countryName}" data-value="${region.name}, ${countryName}"><i class="fa-solid fa-city"></i> ${region.name}, ${countryName}</strong>`;
                    });

                    // Process hotels
                    hotels.forEach(hotel => {
                        hotelHtml += `<strong class="autocomplete-suggestion d-block" data-id="${hotel.id}" data-type="hotel" data-value="${hotel.name}" data-name="${hotel.name}"><i class="fas fa-hotel"></i> ${hotel.name}</strong>`;
                    });

                    suggestionsDiv.innerHTML = `<div>${regionHtml} ${hotelHtml}</div>`;

                    // Add event listeners for selecting suggestions
                    suggestionsDiv.querySelectorAll('.autocomplete-suggestion').forEach(item => {
                        item.addEventListener('click', function() {
                            const name = this.getAttribute('data-name');
                            const id = this.getAttribute('data-id');
                            const type = this.getAttribute('data-type');
                            const datavalue = this.getAttribute('data-value');

                            
                            // Set the visible field (keyword) with the name
                            document.getElementById('keyword').value = datavalue;
                            
                            // Set the hidden input field with the extra data (id)
                            document.getElementById('extraData').value = `${id}, ${type}`;
                            
                            // Clear suggestions after selection
                            document.getElementById('suggestions').innerHTML = ''; 
                        });
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                    document.getElementById('suggestions').innerHTML = '<div class="alert alert-danger">An error occurred while fetching suggestions</div>';
                }
            });
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomsContainer = document.getElementById('rooms-container');
            let roomCount = 1; // Initial room count (since Room 1 is already there)
        
            // Function to update the total rooms and guests
            function updateTotal() {
                const rooms = document.querySelectorAll('.new-room');
                const totalRooms = rooms.length;
                let totalGuests = 0;
                let totalAdult = 0;
                let totalChildren = 0;
        
                rooms.forEach(room => {
                    const adults = parseInt(room.querySelector('.new-adults-count').value);
                    const children = parseInt(room.querySelector('.new-children-count').value);
                    totalGuests += adults + children; // Add adults and children
                    totalAdult += adults;
                    totalChildren += children;
                    updateChildrenAges(room, children); // Update children's ages for the current room
                });
        
                document.querySelector('.new-rooms').textContent = totalRooms;
                document.querySelector('.new-guests').textContent = totalGuests;
        
                document.getElementById('no_room').value = totalRooms;
                document.getElementById('no_guest').value = totalGuests;
                document.getElementById('no_adult').value = totalAdult;
                document.getElementById('no_child').value = totalChildren;
            }
        
            // Function to update the children's age inputs dynamically
function updateChildrenAges(room, childrenCount) {
    const agesContainer = room.querySelector('.children-ages-container');

    // Preserve the existing ages before clearing the inputs
    const existingAges = Array.from(agesContainer.querySelectorAll('.child-age')).map(input => parseInt(input.value) || "");

    agesContainer.innerHTML = ''; // Clear existing age inputs

    for (let i = 0; i < childrenCount; i++) {
        const ageInput = document.createElement('div');
        ageInput.classList.add('child-age-input');
        ageInput.innerHTML = `
            <label>Child ${i + 1} Age:</label>
            <input type="number" min="0" max="17" class="child-age" value="${existingAges[i] || ''}">
        `;
        agesContainer.appendChild(ageInput);
    }
}
        
            // Function to add a new room
            function addRoom() {
                roomCount += 1; // Increment room count
        
                const newRoom = document.querySelector('.new-room').cloneNode(true);
                newRoom.setAttribute('data-room', roomCount);
                newRoom.querySelector('h6').textContent = `Room ${roomCount}`;
                newRoom.querySelector('.new-adults-count').value = 1; // Reset adult count
                newRoom.querySelector('.new-children-count').value = 0; // Reset children count
                newRoom.querySelector('.children-ages-container').innerHTML = ''; // Clear children's ages
                newRoom.querySelector('.remove-room').style.display = 'inline'; 
        
                // Append the new room to the container
                roomsContainer.appendChild(newRoom);
        
                // Attach event listener to the remove button
                newRoom.querySelector('.remove-room').addEventListener('click', function (event) {
                    event.preventDefault();
                    removeRoom(newRoom);
                });
        
                // Attach event listeners to the new controls
                attachEventListeners(newRoom);
        
                // Update total rooms and guests
                updateTotal();
            }
        
            // Function to remove a room
            function removeRoom(roomElement) {
                if (roomsContainer.children.length > 1) { 
                    roomElement.remove();
                    updateTotal();
                } else {
                    alert("You must have at least one room.");
                }
            }
        
            // Attach event listeners to room controls
            function attachEventListeners(room) {
                const adultsInput = room.querySelector('.new-adults-count');
                const childrenInput = room.querySelector('.new-children-count');
        
                // Update total when adults input value changes
                adultsInput.addEventListener('change', updateTotal);
                
                // Update total and children's ages when children input value changes
                childrenInput.addEventListener('change', function() {
                    updateTotal();
                    const childrenCount = parseInt(childrenInput.value);
                    updateChildrenAges(room, childrenCount); // Update children's age inputs
                });
        
                // Handle minus and plus buttons for adults
                room.querySelector('.new-minus-adult').addEventListener('click', function (event) {
                    event.preventDefault();
                    let currentVal = parseInt(adultsInput.value);
                    if (currentVal > 1) {
                        adultsInput.value = currentVal - 1;
                        updateTotal();
                    }
                });
        
                room.querySelector('.new-plus-adult').addEventListener('click', function (event) {
                    event.preventDefault();
                    let currentVal = parseInt(adultsInput.value);
                    adultsInput.value = currentVal + 1;
                    updateTotal();
                });
        
                // Handle minus and plus buttons for children
                room.querySelector('.new-minus-child').addEventListener('click', function (event) {
                    event.preventDefault();
                    let currentVal = parseInt(childrenInput.value);
                    if (currentVal > 0) {
                        childrenInput.value = currentVal - 1;
                        updateTotal();
                    }
                });
        
                room.querySelector('.new-plus-child').addEventListener('click', function (event) {
                    event.preventDefault();
                    let currentVal = parseInt(childrenInput.value);
                    childrenInput.value = currentVal + 1;
                    updateTotal();
                });
            }
        
            // Attach event listener to the first room's remove button
            document.querySelector('.remove-room').addEventListener('click', function (event) {
                event.preventDefault();
                removeRoom(document.querySelector('.new-room'));
            });
        
            // Attach event listener to the "Add Room" button
            document.getElementById('add-room-btn').addEventListener('click', function(event) {
                event.preventDefault();
                addRoom();
            });
        
            // Attach event listener to the "Done" button to close the dropdown
            document.querySelector('.new-done-btn').addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelector('.dropdown-menu').classList.remove('show');
            });
        
            // Initialize event listeners for the first room
            attachEventListeners(document.querySelector('.new-room'));
        });
        
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
        
            const rooms = document.querySelectorAll('.new-room'); // Get all rooms
            let guests = []; // Initialize the guests array
        
            rooms.forEach(room => {
                const adults = parseInt(room.querySelector('.new-adults-count').value); // Get adults count
                const children = []; // Initialize an empty array for children
        
                // Collect all children ages for this room
                const childAgeInputs = room.querySelectorAll('.child-age');
                childAgeInputs.forEach(input => {
                    const age = parseInt(input.value);
                    if (!isNaN(age) && age >= 0 && age <= 17) {
                        children.push(age); // Add child's age to the children array
                    }
                });
        
                // Push the room data into guests array
                guests.push({
                    adults: adults,
                    children: children // Array of children's ages
                });
            });
        
            // Now, you have the guests array ready to send to the backend
            // Example: guests = [{adults: 2, children: [5, 7]}, {adults: 1, children: [3]}]
        
            // Add the guests array to a hidden input field, or handle the submission with an AJAX request
            const guestsInput = document.createElement('input');
            guestsInput.type = 'hidden';
            guestsInput.name = 'guestse'; // Name should match the backend requirement
            guestsInput.value = JSON.stringify(guests); // Convert guests array to JSON
            this.appendChild(guestsInput);
        
            // Submit the form or send the data via AJAX
            this.submit(); // Proceed with form submission
        });
    </script>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('public/assets/js/countrys.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery-ui.js') }}"></script>
    <!-- <script src="../app/themes/default/assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/jquery.countTo.min.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/quantity-input.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/select2.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/app/themes/default/assets/js/app.js') }}"></script>
    
    
    

</body>