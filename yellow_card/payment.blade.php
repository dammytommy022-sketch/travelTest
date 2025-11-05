<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yellow Card Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

    <div class="container text-center">
        <h2 class="text-primary mb-3">Proceed to Payment</h2>
        <p>You're about to pay <strong>₦{{ number_format($yellowCard->price) }}</strong> for your Yellow Card application.</p>

        <button id="payNow" class="btn btn-success btn-lg px-5">Pay with BudPay</button>
    </div>

    {{-- ✅ CRITICAL FIX: Ensure the BudPay script loads first --}}
    <script src="https://checkout.budpay.com/inline.js"></script>

    <script>
        document.getElementById('payNow').addEventListener('click', function () {
            
            // Check to ensure the BudPayPop object is ready before calling setup
            if (typeof BudPayPop === 'undefined') {
                 console.error('BudPay script failed to load. Cannot initialize payment.');
                 alert('Payment service unavailable. Please try refreshing the page.');
                 return;
            }

            let handler = BudPayPop.setup({
                // Ensure this key is resolving correctly in your .env file
                key: "{{ env('BUDPAY_PUBLIC_KEY') }}", 
                email: "{{ $yellowCard->email }}",
                amount: {{ $yellowCard->price * 100 }}, // amount must be in kobo
                currency: 'NGN',
                reference: "{{ $yellowCard->reference }}", // Using the stored unique reference
                callback: function (response) {
                    // Redirect to verify route
                    window.location.href = "{{ route('yellow_card.verify') }}?reference=" + response.reference;
                },
                onClose: function () {
                    alert('Payment cancelled.');
                }
            });
            handler.openIframe();
        });
    </script>

</body>
</html>

