// tourist.js
$(document).ready(function () {
    // Initialize global variables
    const schengenCountries = [
        'Austria', 'Belgium', 'Czech Republic', 'Denmark', 'Estonia', 'Finland',
        'France', 'Germany', 'Greece', 'Hungary', 'Iceland', 'Italy', 'Latvia',
        'Liechtenstein', 'Lithuania', 'Luxembourg', 'Malta', 'Netherlands', 'Norway',
        'Poland', 'Portugal', 'Slovakia', 'Slovenia', 'Spain', 'Sweden', 'Switzerland'
    ];

    // Store original biometrics fees on page load
    $('.bio_fees').each(function () {
        $(this).data('original-bio-fee', $(this).val());
    });

    // Initialize modals and event listeners
    initializeFormValidation();
    initializeTravelerControls();
    initializeDatePickers();
    initializeVisaTypeHandling();
    initializeCountrySelection();
    calculateDateDifference(); // Run initial date calculation
    checkPendingFileUpload(); 
    function checkPendingFileUpload() {
        const token = localStorage.getItem('visaToken');
        if (token) {
            $.ajax({
                url: '/check-pending-upload',
                type: 'GET',
                data: { token: token },
                success: function (response) {
                    console.log(response);
                    if (response.hasPendingUpload) {
                       
                        showPendingUploadModal(token);
                    } else {
                        localStorage.removeItem('visaToken'); // Clear invalid or completed token
                    }
                },
                error: function (xhr) {
                    console.error('Error checking pending upload:', xhr.responseText);
                    localStorage.removeItem('visaToken'); // Clear token on error
                }
            });
        }
    }

    // Function to show modal for pending file upload
    function showPendingUploadModal(token) {
        const modalHtml = `
            <div class="modal fade" id="pendingUploadModal" tabindex="-1" role="dialog" aria-labelledby="pendingUploadModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pendingUploadModalLabel">Pending File Upload</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            We noticed you have a pending file upload for your visa application. Would you like to continue?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="continueUploadBtn">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('body').append(modalHtml);
        $('#pendingUploadModal').modal('show');

        $('#continueUploadBtn').click(function () {
            sessionStorage.setItem('visaToken', token); // Store token in session for file upload page
            window.location.href = '/file-upload';
            $('#pendingUploadModal').modal('hide');
        });

        $('#pendingUploadModal').on('hidden.bs.modal', function () {
            $(this).remove(); // Clean up modal after closing
        });
    }
    // Function to fetch and display visa details
    function fetchVisaDetails(visa, country, days) {
        if (!days) {
            $('#visa_details_container').hide();
            $('#warning_message').text('Please select valid travel dates.').css('color', 'red').prop('hidden', false);
            return;
        }

        const totalAdults = parseInt($('#adult_count_1').val() || 0) + parseInt($('#adult_count_2').val() || 0);
        const totalChildren = parseInt($('#child_count_1').val() || 0) + parseInt($('#child_count_2').val() || 0);
        const totalInfants = parseInt($('#infant_count_1').val() || 0) + parseInt($('#infant_count_2').val() || 0);
        const totalPassengers = totalAdults + totalChildren + totalInfants;

        $.ajax({
            url: '/get-visa-details',
            type: 'GET',
            data: { visa, country, date: days },
            success: function (response) {
                if (response.success) {
                    $('#warning_message').prop('hidden', true);
                    renderVisaCards(response.prices, totalAdults, totalChildren, totalInfants, totalPassengers, response.exchange_rate);
                    $('#visa_details_container').show();
                } else {
                    $('#visa_details_container').hide();
                    $('#warning_message').text(response.message).css('color', 'red').prop('hidden', false);
                }
            },
            error: function (xhr) {
                $('#visa_details_container').hide();
                let errorMessage = 'An error occurred while fetching visa details.';
                try {
                    const errorResponse = JSON.parse(xhr.responseText);
                    errorMessage = errorResponse.message || errorMessage;
                } catch (e) {
                    console.error('AJAX Error:', xhr.responseText);
                }
                $('#warning_message').text(errorMessage).css('color', 'red').prop('hidden', false);
            }
        });
    }

    // Function to render visa cards with quick look and details toggle
    function renderVisaCards(prices, totalAdults, totalChildren, totalInfants, totalPassengers, exchangeRate) {
        let html = '';
        prices.forEach((price, index) => {
            // Calculate admin charge
            const adminCharge = totalPassengers > 1 ? (totalPassengers - 0.2) * parseFloat(price.admin_charge) : parseFloat(price.admin_charge);
            let travelwheelTotal = adminCharge + parseFloat(price.vat);
            let embassyTotal = 0;

            // Calculate TravelWheel payments
            if (price.bio_payment_to === 'travelwheel') {
                if (totalAdults > 0) travelwheelTotal += price.biometrics_fee_ngn * totalAdults;
                if (totalChildren > 0) travelwheelTotal += price.biometrics_fee_ngn_child * totalChildren;
                if (totalInfants > 0) travelwheelTotal += price.biometrics_fee_ngn_infant * totalInfants;
            }
            if (price.visa_payment_to === 'travelwheel') {
                if (totalAdults > 0) travelwheelTotal += price.visa_fee_ngn * totalAdults;
                if (totalChildren > 0) travelwheelTotal += price.child_visa_fee_ngn * totalChildren;
                if (totalInfants > 0) travelwheelTotal += price.infant_visa_fee_ngn * totalInfants;
            }

            // Calculate Embassy payments
            if (price.bio_payment_to === 'embassy') {
                if (totalAdults > 0) embassyTotal += price.biometrics_fee_ngn * totalAdults;
                if (totalChildren > 0) embassyTotal += price.biometrics_fee_ngn_child * totalChildren;
                if (totalInfants > 0) embassyTotal += price.biometrics_fee_ngn_infant * totalInfants;
            }
            if (price.visa_payment_to === 'embassy') {
                if (totalAdults > 0) embassyTotal += price.visa_fee_ngn * totalAdults;
                if (totalChildren > 0) embassyTotal += price.child_visa_fee_ngn * totalChildren;
                if (totalInfants > 0) embassyTotal += price.infant_visa_fee_ngn * totalInfants;
            }

            // Calculate other charges
            let totalOtherCharges = 0;
            const otherChargesHtml = generateOtherChargesHtml(price, totalAdults, totalChildren, totalInfants, exchangeRate, travelwheelTotal, embassyTotal, totalOtherCharges);

            // Total amounts
            const totalAmount = travelwheelTotal + embassyTotal;

            // Generate card HTML
            html += `
                <div class="col-12 col-sm-4 card-container">
                    <div class="card shadow card-link" id="card-${index}">
                        <div class="card-body" style="line-height:0.2;">
                            <p class="summary hello text-center bold" style="font-size:16px;"><b>${price.entry} Entry</b></p>
                            <p class="summary" style="font-size:12px;"><b>Visa Type: ${price.visa_type_name}</b></p>
                            <p class="summary" style="font-size:12px;"><b>Total Amount: ₦${totalAmount.toLocaleString()}</b></p>
                            <button class="btn btn-link details-toggle" data-toggle="collapse" data-target="#details-${index}" style="font-size:12px;">Details</button>
                            <div id="details-${index}" class="collapse">
                                <p class="summary" style="font-size:12px;"><b>Visa Validity: ${price.visa_validity} Working Days</b></p>
                                <p class="summary" style="font-size:12px;"><b>Processing Period: ${price.processing_period} Working Days</b></p>
                                ${generateVisaFeesHtml(price, totalAdults, totalChildren, totalInfants)}
                                ${generateBiometricsFeesHtml(price, totalAdults, totalChildren, totalInfants)}
                                <p class="summary" style="font-size:12px;"><b>Admin Charges: ₦${parseInt(adminCharge).toLocaleString()}</b></p>
                                <p class="summary" style="font-size:12px;"><b>VAT: ₦${price.vat.toLocaleString()}</b></p>
                                ${otherChargesHtml.html}
                                <hr>
                                <p class="summary" style="font-size:12px;"><b>Total to TravelWheel: ₦${travelwheelTotal.toLocaleString()}</b></p>
                                <p class="summary" style="font-size:12px;"><b>Total to Embassy: ₦${embassyTotal.toLocaleString()}</b></p>
                            </div>
                            ${generateHiddenInputs(price, index, travelwheelTotal, embassyTotal, adminCharge, totalOtherCharges, totalAdults, totalChildren, totalInfants)}
                        </div>
                    </div>
                </div>
            `;
        });

        // Update DOM and bind card click events
        $('#visa_details_row').html(html);
        $('.card-link').click(function () {
            $('.card-link').removeClass('selected');
            $(this).addClass('selected');
        });
        $('.details-toggle').click(function (e) {
            e.preventDefault();
            const target = $(this).data('target');
            $(target).collapse('toggle');
        });
    }

    // Helper function to generate visa fees HTML
    function generateVisaFeesHtml(price, totalAdults, totalChildren, totalInfants) {
        let html = '';
        if (totalAdults > 0) {
            const adultVisaFeeTotal = price.visa_fee * totalAdults;
            const adultVisaFeeNgnTotal = price.visa_fee_ngn * totalAdults;
            html += `<p class="summary" style="font-size:12px;"><b${price.visa_payment_to === 'embassy' ? ' class="text-danger"' : ''}>Visa Fees(Adult, ${totalAdults}): $${adultVisaFeeTotal.toLocaleString()} (~₦${adultVisaFeeNgnTotal.toLocaleString()})</b></p>`;
        }
        if (totalChildren > 0) {
            const childVisaFeeTotal = price.child_visa_fee * totalChildren;
            const childVisaFeeNgnTotal = price.child_visa_fee_ngn * totalChildren;
            html += `<p class="summary" style="font-size:12px;"><b${price.visa_payment_to === 'embassy' ? ' class="text-danger"' : ''}>Visa Fees(Child, ${totalChildren}): $${childVisaFeeTotal.toLocaleString()} (~₦${childVisaFeeNgnTotal.toLocaleString()})</b></p>`;
        }
        if (totalInfants > 0) {
            const infantVisaFeeTotal = price.infant_visa_fee * totalInfants;
            const infantVisaFeeNgnTotal = price.infant_visa_fee_ngn * totalInfants;
            html += `<p class="summary" style="font-size:12px;"><b${price.visa_payment_to === 'embassy' ? ' class="text-danger"' : ''}>Visa Fees(Infant, ${totalInfants}): $${infantVisaFeeTotal.toLocaleString()} (~₦${infantVisaFeeNgnTotal.toLocaleString()})</b></p>`;
        }
        return html;
    }

    // Helper function to generate biometrics fees HTML
    function generateBiometricsFeesHtml(price, totalAdults, totalChildren, totalInfants) {
        let html = '';
        if (totalAdults > 0) {
            const adultBioFeeTotal = price.biometrics_fee_adult * totalAdults;
            const adultBioFeeNgnTotal = price.biometrics_fee_ngn * totalAdults;
            html += `<p class="summary biometrics-fee" style="font-size:12px;"><b${price.bio_payment_to === 'embassy' ? ' class="text-danger"' : ''}>Biometrics(Adult, ${totalAdults}): $${adultBioFeeTotal.toLocaleString()} (~₦${adultBioFeeNgnTotal.toLocaleString()})</b></p>`;
        }
        if (totalChildren > 0) {
            const childBioFeeTotal = price.biometrics_fee_child * totalChildren;
            const childBioFeeNgnTotal = price.biometrics_fee_ngn_child * totalChildren;
            html += `<p class="summary biometrics-fee" style="font-size:12px;"><b${price.bio_payment_to === 'embassy' ? ' class="text-danger"' : ''}>Biometrics(Child, ${totalChildren}): $${childBioFeeTotal.toLocaleString()} (~₦${childBioFeeNgnTotal.toLocaleString()})</b></p>`;
        }
        if (totalInfants > 0) {
            const infantBioFeeTotal = price.biometrics_fee_infant * totalInfants;
            const infantBioFeeNgnTotal = price.biometrics_fee_ngn_infant * totalInfants;
            html += `<p class="summary biometrics-fee" style="font-size:12px;"><b${price.bio_payment_to === 'embassy' ? ' class="text-danger"' : ''}>Biometrics(Infant, ${totalInfants}): $${infantBioFeeTotal.toLocaleString()} (~₦${infantBioFeeNgnTotal.toLocaleString()})</b></p>`;
        }
        return html;
    }

    // Helper function to generate other charges HTML
    function generateOtherChargesHtml(price, totalAdults, totalChildren, totalInfants, exchangeRate, travelwheelTotal, embassyTotal, totalOtherCharges) {
        let html = '';
        if (price.otherCharges1.length || price.otherCharges2.length || price.otherCharges3.length || price.otherCharges4.length) {
            html += '<p class="summary" style="font-size:12px;"><b>CHARGES:</b></p>';
        }

        // All travelers
       
            price.otherCharges1.forEach(charge => {
                const otherChargeInNaira = charge.other_charge_amount * exchangeRate * (totalAdults + totalChildren + totalInfants);
                totalOtherCharges += parseFloat(charge.other_charge_amount) * (totalAdults + totalChildren + totalInfants);
                const chargeAmount = (charge.other_charge_amount * (totalAdults + totalChildren + totalInfants)).toLocaleString();
                if (charge.payment_to === 'travelwheel') {
                    travelwheelTotal += otherChargeInNaira;
                    html += `<p class="summary" style="font-size:12px;"><b>${charge.other_charge_name}: $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                } else {
                    embassyTotal += otherChargeInNaira;
                    html += `<p class="summary" style="font-size:12px;"><b class="text-danger">${charge.other_charge_name}: $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                }
            });
        

        // Adults
        if (totalAdults > 0) {
            console.log(price.otherCharges2);
            
                price.otherCharges2.forEach(charge => {
                    const otherChargeInNaira = charge.other_charge_amount * exchangeRate * totalAdults;
                    totalOtherCharges += parseFloat(charge.other_charge_amount) * totalAdults;
                    const chargeAmount = (charge.other_charge_amount * totalAdults).toLocaleString();
                    if (charge.payment_to === 'travelwheel') {
                        travelwheelTotal += otherChargeInNaira;
                        html += `<p class="summary" style="font-size:12px;"><b>${charge.other_charge_name} (Adult, ${totalAdults}): $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                    } else {
                        embassyTotal += otherChargeInNaira;
                        html += `<p class="summary" style="font-size:12px;"><b class="text-danger">${charge.other_charge_name} (Adult, ${totalAdults}): $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                    }
                });
          
        }

        // Children
        if (totalChildren > 0) {
                price.otherCharges3.forEach(charge => {
                    const otherChargeInNaira = charge.other_charge_amount * exchangeRate * totalChildren;
                    totalOtherCharges += parseFloat(charge.other_charge_amount) * totalChildren;
                    const chargeAmount = (charge.other_charge_amount * totalChildren).toLocaleString();
                    if (charge.payment_to === 'travelwheel') {
                        travelwheelTotal += otherChargeInNaira;
                        html += `<p class="summary" style="font-size:12px;"><b>${charge.other_charge_name} (Child, ${totalChildren}): $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                    } else {
                        embassyTotal += otherChargeInNaira;
                        html += `<p class="summary" style="font-size:12px;"><b class="text-danger">${charge.other_charge_name} (Child, ${totalChildren}): $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                    }
                });
          
        }

        // Infants
        if (totalInfants > 0) {
                price.otherCharges4.forEach(charge => {
                    const otherChargeInNaira = charge.other_charge_amount * exchangeRate * totalInfants;
                    totalOtherCharges += parseFloat(charge.other_charge_amount) * totalInfants;
                    const chargeAmount = (charge.other_charge_amount * totalInfants).toLocaleString();
                    if (charge.payment_to === 'travelwheel') {
                        travelwheelTotal += otherChargeInNaira;
                        html += `<p class="summary" style="font-size:12px;"><b>${charge.other_charge_name} (Infant, ${totalInfants}): $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                    } else {
                        embassyTotal += otherChargeInNaira;
                        html += `<p class="summary" style="font-size:12px;"><b class="text-danger">${charge.other_charge_name} (Infant, ${totalInfants}): $${chargeAmount} (~₦${otherChargeInNaira.toLocaleString()})</b><br><span class="summary" style="font-size:12px;color:#e02200ac;font-weight:50;">${charge.note}</span></p>`;
                    }
                });
            
        }

        return { html, travelwheelTotal, embassyTotal, totalOtherCharges };
    }

    // Helper function to generate hidden inputs
    function generateHiddenInputs(price, index, travelwheelTotal, embassyTotal, adminCharge, totalOtherCharges, totalAdults, totalChildren, totalInfants) {
        let html = `
            <input type="hidden" name="travelwheel_pay_${index}" value="${travelwheelTotal}">
            <input type="hidden" name="embassy_pay_${index}" value="${embassyTotal}">
            <input type="hidden" name="entry_${index}" value="${price.entry}">
            <input type="hidden" name="visa_type_name_${index}" value="${price.visa_type_name}">
            <input type="hidden" name="visa_validity_${index}" value="${price.visa_validity}">
            <input type="hidden" name="processing_period_${index}" value="${price.processing_period}">
            <input type="hidden" name="visa_fee_${index}" value="${price.visa_fee * totalAdults}">
            <input type="hidden" name="child_visa_fee_${index}" value="${price.child_visa_fee * totalChildren}">
            <input type="hidden" name="infant_visa_fee_${index}" value="${price.infant_visa_fee * totalInfants}">
            <input type="hidden" class="bio_fees" name="biometrics_fee_${index}" value="${price.biometrics_fee_adult * totalAdults}">
            <input type="hidden" class="bio_fees" name="biometrics_fee_child_${index}" value="${price.biometrics_fee_child * totalChildren}">
            <input type="hidden" class="bio_fees" name="biometrics_fee_infant_${index}" value="${price.biometrics_fee_infant * totalInfants}">
            <input type="hidden" class="original-bio-fee" value="${price.biometrics_fee}">
            <input type="hidden" name="admin_charge_${index}" value="${adminCharge}">
        `;
        if (totalOtherCharges) {
            html += `
                <input type="hidden" name="other_charge_amount_all_${index}" value="${price.otherCharges1Total * (totalAdults + totalChildren + totalInfants)}">
                <input type="hidden" name="other_charge_amount_adult_${index}" value="${price.otherCharges2Total * totalAdults}">
                <input type="hidden" name="other_charge_amount_child_${index}" value="${price.otherCharges3Total * totalChildren}">
                <input type="hidden" name="other_charge_amount_infant_${index}" value="${price.otherCharges4Total * totalInfants}">
            `;
        }
        return html;
    }




    // Initialize form validation and submission
    function initializeFormValidation() {
        $('#proceed_button').click(event => {
            event.preventDefault();
            const totalValue = $('#totalValue').val();
            const warningParagraph = $('#warning_message');

            if (!totalValue) {
                warningParagraph.text('Please select the number of person(s).').css('color', 'red').prop('hidden', false);
                return;
            }
            warningParagraph.prop('hidden', true);

            if (validateForm()) {
                submitForm();
            }
        });
    }

    // Validate form inputs
    function validateForm() {
        $('input[required]').removeClass('is-invalid');
        let isValid = true;
        $('input[required]').each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
                $(this).siblings('.invalid-feedback').show();
            }
        });
        return isValid;
    }

    // Submit form via AJAX
    function submitForm() {
        let formData = $('form').serializeArray();
        const selectedCardData = $('.card-link.selected').closest('.card').find('input[type="hidden"]').serializeArray();
        formData = formData.concat(selectedCardData);

        $('.card-link').not('.selected').closest('.card').find('input[type="hidden"]').each(function () {
            const unselectedCardData = $(this).serializeArray();
            formData = formData.filter(item => !unselectedCardData.some(unselectedItem => item.name === unselectedItem.name));
        });

        $.ajax({
            url: '/submit-form-data',
            type: 'POST',
            data: formData,
            success: response => {
                 localStorage.setItem('visaToken', response.token);
                const selectedVisaTo = $('#visa_to').val();
                window.location.href = "/file-upload";
                console.log(response);
            },
            error: xhr => console.error(xhr.responseText)
        });
    }

    // Initialize traveler count controls
    function initializeTravelerControls() {
        const updateTravelerCounts = () => {
            const adultCount1 = parseInt($('#notschengen [data-item-type="Adult"] .item-count').text() || 0);
            const childCount1 = parseInt($('#notschengen [data-item-type="Child"] .item-count').text() || 0);
            const infantCount1 = parseInt($('#notschengen [data-item-type="Infant"] .item-count').text() || 0);
            const adultCount2 = parseInt($('#schengen [data-item-type="Adult"] .item-count2').text() || 0);
            const childCount2 = parseInt($('#schengen [data-item-type="Child"] .item-count2').text() || 0);
            const infantCount2 = parseInt($('#schengen [data-item-type="Infant"] .item-count2').text() || 0);

            $('#adult_count_1').val(adultCount1);
            $('#child_count_1').val(childCount1);
            $('#infant_count_1').val(infantCount1);
            $('#adult_count_2').val(adultCount2);
            $('#child_count_2').val(childCount2);
            $('#infant_count_2').val(infantCount2);

            const totalValue = adultCount1 + childCount1 + infantCount1 + adultCount2 + childCount2 + infantCount2;
            $('#totalValue').val(totalValue);
            $('#totalValue2').val(totalValue);

            updateVisaDetails();
        };

        $('#notschengen .increment-button').click(e => {
            e.preventDefault();
            const countSpan = $(e.target).parent().find('.item-count');
            countSpan.text(parseInt(countSpan.text() || 0) + 1);
            updateTravelerCounts();
        });

        $('#notschengen .decrement-button').click(e => {
            e.preventDefault();
            const countSpan = $(e.target).parent().find('.item-count');
            const currentCount = parseInt(countSpan.text() || 0);
            if (currentCount > 0) {
                countSpan.text(currentCount - 1);
                updateTravelerCounts();
            }
        });

        $('#schengen .increment-button2').click(e => {
            e.preventDefault();
            const countSpan = $(e.target).parent().find('.item-count2');
            countSpan.text(parseInt(countSpan.text() || 0) + 1);
            updateTravelerCounts();
        });

        $('#schengen .decrement-button2').click(e => {
            e.preventDefault();
            const countSpan = $(e.target).parent().find('.item-count2');
            const currentCount = parseInt(countSpan.text() || 0);
            if (currentCount > 0) {
                countSpan.text(currentCount - 1);
                updateTravelerCounts();
            }
        });
    }

    // Update visa details when traveler counts change
    function updateVisaDetails() {
        const visa = $('#visa_type').val();
        const country = $('#visa_to').val();
        const days = $('#calculated_days').val();
        if (visa && days) {
            $('#warning_message').prop('hidden', true);
            fetchVisaDetails(visa, country, days);
        } else {
            $('#visa_details_container').hide();
            if (!days) {
                $('#warning_message').text('Please select valid travel dates.').css('color', 'red').prop('hidden', false);
            }
        }
    }

    // Initialize date pickers and visa type disabling
    function initializeDatePickers() {
        const departureInput = $('#departureDate');
        const returnInput = $('#returnDate');
        const visaTypeSelect = $('#visa_type');

        const toggleVisaType = () => {
            visaTypeSelect.prop('disabled', !departureInput.val() || !returnInput.val());
        };

        departureInput.change(() => {
            calculateDateDifference();
            toggleVisaType();
            updateVisaDetails();
        });
        returnInput.change(() => {
            calculateDateDifference();
            toggleVisaType();
            updateVisaDetails();
        });
    }

    // Initialize visa type and biometrics handling
    function initializeVisaTypeHandling() {
        $('#visa_type').change(function () {
            const visa = $(this).val();
            const country = $('#visa_to').val();
            const days = $('#calculated_days').val();
            if (visa && days) {
                fetchVisaDetails(visa, country, days);
            } else {
                $('#visa_details_container').hide();
                if (!days) {
                    $('#warning_message').text('Please select valid travel dates.').css('color', 'red').prop('hidden', false);
                }
            }
        });

        $('#visa_to').change(function () {
            const country = $(this).val();
            if (country === 'Canada') {
                $('.form-check').slideDown('slow');
            } else {
                $('.form-check').slideUp('slow');
            }
        });

        // Initialize biometrics visibility based on initial country selection
        if ($('#visa_to').val() === 'Canada') {
            $('.form-check').show();
        } else {
            $('.form-check').hide();
        }

        $('#flexCheckDefault').change(function () {
            const isChecked = $(this).is(':checked');
            $('.biometrics-fee').toggle(!isChecked);
            $('.bio_fees').each(function () {
                if (isChecked) {
                    $(this).data('original-bio-fee', $(this).val());
                    $(this).val(0);
                } else {
                    const originalBioFee = $(this).next('.original-bio-fee').val();
                    if (originalBioFee !== undefined) {
                        $(this).val(originalBioFee);
                    }
                }
            });
            // Re-fetch visa details to update biometrics fees
            updateVisaDetails();
        });
    }

    // Initialize country selection for Schengen/non-Schengen traveler sections
    function initializeCountrySelection() {
        $('#visa_to').change(function () {
            const selectedCountry = $(this).val();
            $('#schengen').toggle(schengenCountries.includes(selectedCountry));
            $('#notschengen').toggle(!schengenCountries.includes(selectedCountry));
        });
    }

    // Calculate date difference between departure and return
    function calculateDateDifference() {
        const departureDateInput = $('#departureDate');
        const returnDateInput = $('#returnDate');
        const dateDiffSpan = $('#date_diff');
        const calculatedDaysInput = $('#calculated_days');

        if (!departureDateInput.val() || !returnDateInput.val()) {
            dateDiffSpan.text('');
            calculatedDaysInput.val('');
            return;
        }

        const departureDate = new Date(departureDateInput.val());
        const returnDate = new Date(returnDateInput.val());
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Normalize current date to midnight for comparison

        if (departureDate < currentDate || returnDate < currentDate) {
            dateDiffSpan.text('(Dates must be in the future)');
            calculatedDaysInput.val('');
            $('#warning_message').text('Please select valid travel dates.').css('color', 'red').prop('hidden', false);
            return;
        }

        if (returnDate < departureDate) {
            dateDiffSpan.text('(Return date must be after departure date)');
            calculatedDaysInput.val('');
            $('#warning_message').text('Please select valid travel dates.').css('color', 'red').prop('hidden', false);
            return;
        }

        const daysDifference = Math.ceil((returnDate - departureDate) / (1000 * 3600 * 24));
        dateDiffSpan.text(`(${daysDifference} days)`);
        calculatedDaysInput.val(daysDifference);
        $('#warning_message').prop('hidden', true);
    }
});