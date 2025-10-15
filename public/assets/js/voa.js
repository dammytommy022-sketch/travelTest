
 
 function calculateDays() {
    const departureDate = document.getElementById('voa_departureDate').value;
    const returnDate = document.getElementById('voa_returnDate').value;

    if (departureDate && returnDate) {
      const departure = new Date(departureDate);
      const returnD = new Date(returnDate);
      const timeDiff = returnD - departure;
console.log("hello");
      if (timeDiff >= 0) {
        const days = timeDiff / (1000 * 60 * 60 * 24); // Convert milliseconds to days
        document.getElementById('voa_calculated_days').value = days;
        document.getElementById('voa_date_diff').innerText = `(${days} days)`;
      } else {
        alert("Return date cannot be before the departure date!");
        document.getElementById('voa_calculated_days').value = '';
        document.getElementById('voa_date_diff').innerText = '';
      }
    }
  }

  // Event listeners for date inputs
  document.getElementById('voa_departureDate').addEventListener('change', calculateDays);
  document.getElementById('voa_returnDate').addEventListener('change', calculateDays);
  
  function updatePeople() {
    const applicantSelect = document.getElementById('applicant');
    const selectedOption = applicantSelect.value;
    
    // Show the container only if a valid option is selected
    document.getElementById('people_container').style.display = selectedOption === '--Select Application Type--' ? 'none' : 'block';
  
    // Toggle visibility based on the "Who is Applying" selection
    var dropdownItems = document.querySelectorAll("#voa_people .dropdown-item");
    dropdownItems.forEach(function (item) {
      item.style.display = "none"; // Hide all items initially
    });

    if (selectedOption === "individual") {
      document.querySelector("#voa_people [data-item-type='Adult']").style.display = "block";
    } else if (selectedOption === "minor_NP" || selectedOption === "minor_FP") {
      document.querySelector("#voa_people [data-item-type='Infant']").style.display = "block";
      document.querySelector("#voa_people [data-item-type='Child']").style.display = "block";
    }
}
  
document.addEventListener("DOMContentLoaded", function () {
    var incrementButtons1 = document.querySelectorAll("#voa_people .increment-button");
    var decrementButtons1 = document.querySelectorAll("#voa_people .decrement-button");
    var applicantSelect = document.getElementById("applicant");
    var dropdownItems = document.querySelectorAll("#voa_people .dropdown-item");

    // Function to toggle visibility based on "Who is Applying" selection
    applicantSelect.addEventListener("change", function () {
        var selectedOption = applicantSelect.value;

        // Reset visibility of all dropdown items
        dropdownItems.forEach(function (item) {
            item.style.display = "none"; // Hide all items by default
        });

        // Show appropriate items based on the selected option
        if (selectedOption === "individual") {
            document.querySelector("#voa_people [data-item-type='Adult']").style.display = "block";
            resetValues(); // Reset the counts when switching to "individual"
        } else if (selectedOption === "minor_NP" || selectedOption === "minor_FP") {
            document.querySelector("#voa_people [data-item-type='Infant']").style.display = "none";
            document.querySelector("#voa_people [data-item-type='Child']").style.display = "block";
            resetValues(); // Reset the counts when switching to "minor"
        } else {
            // Hide all when no valid option is selected
            resetValues();
        }
    });

    // Increment button functionality
    incrementButtons1.forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var countSpan = button.parentElement.querySelector(".voa_item-count");
            var currentCount = parseInt(countSpan.textContent);
            countSpan.textContent = currentCount + 1;
            updateTotalValue();
        });
    });

    // Decrement button functionality
    decrementButtons1.forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var countSpan = button.parentElement.querySelector(".voa_item-count");
            var currentCount = parseInt(countSpan.textContent);
            if (currentCount > 0) {
                countSpan.textContent = currentCount - 1;
                updateTotalValue();
            }
        });
    });

    // Update total number of persons
    function updateTotalValue() {
        var adultCount1 = parseInt(document.querySelector("#voa_people [data-item-type='Adult'] .voa_item-count").textContent);
        var childCount1 = parseInt(document.querySelector("#voa_people [data-item-type='Child'] .voa_item-count").textContent);
        var infantCount1 = parseInt(document.querySelector("#voa_people [data-item-type='Infant'] .voa_item-count").textContent);

        document.getElementById("voa_adult_count_1").value = adultCount1;
        document.getElementById("voa_child_count_1").value = childCount1;
        document.getElementById("voa_infant_count_1").value = infantCount1;

        var totalValue = adultCount1 + childCount1 + infantCount1;
        var totalValueInput = document.getElementById("voa_totalValue");
        totalValueInput.value = totalValue;
        
        updateVoaDetails();
    }

    // Reset counts and total value
    function resetValues() {
        document.querySelector("#voa_people [data-item-type='Adult'] .voa_item-count").textContent = 0;
        document.querySelector("#voa_people [data-item-type='Child'] .voa_item-count").textContent = 0;
        document.querySelector("#voa_people [data-item-type='Infant'] .voa_item-count").textContent = 0;

        document.getElementById("voa_adult_count_1").value = 0;
        document.getElementById("voa_child_count_1").value = 0;
        document.getElementById("voa_infant_count_1").value = 0;

        document.getElementById("voa_totalValue").value = 0;
    }
    
    updatePeople();
});


document.getElementById('voa_totalValue').addEventListener('input', () => {
    console.log(document.getElementById('voa_totalValue').value); // Logs the updated value
});



// Function to send an AJAX request when the total value changes
function updateVoaDetails() {
    
    const nationality = document.getElementById("voa_nationality").value;
    const totalPeople = document.getElementById("voa_totalValue").value;
    const applicant = document.getElementById("applicant").value;
    const departureDate = document.getElementById("voa_departureDate").value;
    const returnDate = document.getElementById("voa_returnDate").value;

    // Send an AJAX request
    $.ajax({
        url: '/get-voa-details',
        method: 'GET',
        data: {
            nationality: nationality,
            totalPeople: totalPeople,
            applicant: applicant,
            departureDate: departureDate,
            returnDate: returnDate
        },
        success: function(response) {
            if(response.success) {
                
                // Display the visa details dynamically in the #voa_details_container div
                const detailsContainer = $('#voa_details_container');
                detailsContainer.empty();

                // Create HTML to display the fees
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let htmlContent = `
     <div class="visa-details-card">
        <div class="visa-details-header">
            <div class="d-flex align-items-center mb-3 header-content">
                <div class="icon-container">
                    <i class="fas fa-passport"></i>
                </div>
                <h4 class="mb-0 text-light">Visa Application Details</h4>
            </div>
            <div class="h4 text-light">Number of applicants: ${response.total_people}</div>
        </div>
        
        <div class="visa-details-body">
            <div class="fee-item">
                <span class="fee-label">
                    <i class="fas fa-ticket-alt me-2"></i>
                    Single Entry Fee
                </span>
                <span class="fee-value">₦${(response.single_entry_fee_ngn).toLocaleString()} ≈ $${response.single_entry_fee.toLocaleString()}</span>
            </div>
            
            <div class="fee-item">
                <span class="fee-label">
                    <i class="fas fa-fingerprint me-2"></i>
                    Biometrics Fee
                </span>
                <span class="fee-value">₦${(response.biometrics_fee_ngn).toLocaleString()} ≈ $${response.biometrics_fee.toLocaleString()}</span>
            </div>
            
            <div class="fee-item">
                <span class="fee-label">
                    <i class="fas fa-concierge-bell me-2"></i>
                    Service Charge
                </span>
                <span class="fee-value">₦${(response.service_charge_ngn).toLocaleString()} ≈ $${response.service_charge.toLocaleString()}</span>
            </div>
            
            <div class="fee-item">
                <span class="fee-label">
                    <i class="fas fa-credit-card me-2"></i>
                    Online Visa Payment Charge
                </span>
                <span class="fee-value">₦${(response.payment_charge_ngn).toLocaleString()} ≈ $${response.payment_charge.toLocaleString()}</span>
            </div>
            
            <div class="fee-item">
                <span class="fee-label">
                    <i class="fas fa-cogs me-2"></i>
                    Admin Fee
                </span>
                <span class="fee-value">₦${(response.processing_charge).toLocaleString()}</span>
            </div>
            
            <div class="fee-item total-fee">
                <span class="fee-label">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    <strong>Total Charge</strong>
                </span>
                <span class="fee-value" style="color:#0d1883;">₦${(response.total_fee_ngn).toLocaleString()}</span>
            </div>
            
            <div class="travel-dates p-3 mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span>
                        <i class="fas fa-plane-departure text-success me-2"></i>
                        Departure: ${response.departure}
                    </span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>
                        <i class="fas fa-plane-arrival text-success me-2"></i>
                        Return: ${response.return}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <form id="voa_form" action="/submitvoa" method="POST" class="">
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="single_entry_fee" value="${response.single_entry_fee_ngn}">
        <input type="hidden" name="biometrics_fee" value="${response.biometrics_fee_ngn}">
        <input type="hidden" name="service_charge" value="${response.service_charge_ngn}">
        <input type="hidden" name="payment_charge" value="${response.payment_charge_ngn}">
        <input type="hidden" name="processing_charge" value="${response.processing_charge}">
        <input type="hidden" name="total_fee" value="${response.total_fee_ngn}">
        <input type="hidden" name="total_people" value="${response.total_people}">
        <input type="hidden" name="departure" value="${response.departure}">
        <input type="hidden" name="return" value="${response.return}">
        <input type="hidden" name="applicant" value="${response.applicant}">        
    </form>
`;

                detailsContainer.html(htmlContent);
                detailsContainer.show();
                console.log("Form available after content load:", document.getElementById("voa_form"));
                
            const voaForm = document.getElementById("voa_form");

        if (voaForm) {
            document.getElementById("voa_proceed_button").addEventListener("click", function () {
                // Get input values
                const phoneNumber = document.getElementById("voa_phone_number").value.trim();
                const email = document.getElementById("voa_email").value.trim();
                const nationality = document.getElementById("voa_nationality").value.trim();
                               // Validate input fields
                if (!phoneNumber) {
                    alert("Phone number cannot be empty.");
                    return;
                }
                if (!email) {
                    alert("Email cannot be empty.");
                    return;
                }

                // Append values as hidden inputs to the form
                const form = document.getElementById("voa_form");

                // Create and append phone number input
                const phoneInput = document.createElement("input");
                phoneInput.type = "hidden";
                phoneInput.name = "phone_number";
                phoneInput.value = phoneNumber;
                form.appendChild(phoneInput);

                // Create and append email input
                const emailInput = document.createElement("input");
                emailInput.type = "hidden";
                emailInput.name = "email";
                emailInput.value = email;
                form.appendChild(emailInput);
                
                const visa_to = document.createElement("input");
                visa_to.type = "hidden";
                visa_to.name = "visa_to";
                visa_to.value = nationality;
                form.appendChild(visa_to);
                // Submit the form
                form.submit();
            });
        } else {
            console.log("Form not found after content load.");
        }
                
            } else {
                alert('Error fetching visa details.');
            }
        },
        error: function(error) {
            console.error('Error:', error);
            alert('An error occurred while fetching visa details.');
        }
    });
}


    
//  document.getElementById("voa_proceed_button").addEventListener("click", function () {
//      //console.log("hello");
//         //Get input values
//         const phoneNumber = document.getElementById("voa_phone_number").value.trim();
//         const email = document.getElementById("voa_email").value.trim();

//         // Validate input fields
//         if (!phoneNumber) {
//             alert("Phone number cannot be empty.");
//             return;
//         }
//         if (!email) {
//             alert("Email cannot be empty.");
//             return;
//         }

//         // Append values as hidden inputs to the form
//         const form = document.getElementById("voa_form");

//         // Create and append phone number input
//         const phoneInput = document.createElement("input");
//         phoneInput.type = "hidden";
//         phoneInput.name = "phone_number";
//         phoneInput.value = phoneNumber;
//         form.appendChild(phoneInput);

//         // Create and append email input
//         const emailInput = document.createElement("input");
//         emailInput.type = "hidden";
//         emailInput.name = "email";
//         emailInput.value = email;
//         form.appendChild(emailInput);

//         // Submit the form
//         form.submit();
//     });
