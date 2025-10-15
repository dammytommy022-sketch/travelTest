<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelwheel - Application Successful</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Confetti.js for Celebration Effect -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        :root {
            /* Light Mode Colors */
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --bg: #f9fafb;
            --card-bg: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --success: #22c55e;
            --accent: #f59e0b;

            /* Dark Mode Colors */
            --dark-bg: #1f2937;
            --dark-card-bg: #374151;
            --dark-text: #f3f4f6;
            --dark-muted: #9ca3af;
            --dark-border: #4b5563;
        }

        [data-theme="dark"] {
            --bg: var(--dark-bg);
            --card-bg: var(--dark-card-bg);
            --text: var(--dark-text);
            --muted: var(--dark-muted);
            --border: var(--dark-border);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background 0.3s, color 0.3s;
            overflow-x: hidden;
            position: relative;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            color: var(--primary);
            position: relative;
            z-index: 2;
            animation: bounceIn 0.8s ease-out;
        }

        .header-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            opacity: 0.1;
            z-index: 1;
            animation: gradientShift 10s infinite alternate;
        }

        @keyframes gradientShift {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 1000;
        }

        .theme-toggle:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* Success Section */
        .section {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 32px;
            margin-bottom: 32px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        .section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .section:hover::before {
            transform: scaleX(1);
        }

        .section h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .confirmation-message {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--success);
            margin-bottom: 20px;
            animation: fadeIn 0.5s;
        }

        .details {
            font-size: 0.95rem;
            color: var(--muted);
            line-height: 1.6;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .details div {
            display: flex;
            flex-direction: column;
            padding: 12px;
            border-radius: 8px;
            background: var(--bg);
            transition: transform 0.3s, background 0.3s;
        }

        .details div:hover {
            transform: translateY(-4px);
            background: var(--card-bg);
        }

        .details strong {
            font-weight: 600;
            color: var(--text);
        }

        .btn {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50%;
            transition: transform 0.5s;
        }

        .btn:hover::after {
            transform: translate(-50%, -50%) scale(1);
        }

        .btn.pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .support-text {
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
            margin-top: 24px;
            animation: fadeIn 0.7s;
        }

        .support-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .support-text a:hover {
            text-decoration: underline;
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background: var(--card-bg);
            color: var(--text);
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 10;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: var(--shadow);
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) translateY(-5px);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .section {
                padding: 24px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
        <i data-feather="moon"></i>
    </button>

    <div class="container">
        <div class="header">
            <div class="header-bg"></div>
            <h1>Application Successful!</h1>
        </div>
        <div class="section">
            <h2>
                <i data-feather="check-circle" style="color: var(--success);"></i>
                Visa Application Confirmation
            </h2>
            <div class="confirmation-message">
                Your application has been submitted successfully!
            </div>
            <div class="details">
                <div>
                    <strong>Application ID</strong>
                    <span>{{ $applicationId }}</span>
                </div>
                <div>
                    <strong>Visa Type</strong>
                   <span>{{ $visa->visa_type ?? 'Nigerian Business Visa' }} ({{ $visa->processing_type ?? 'E-visa' }})</span>

                </div>
                <div>
                    <strong>Processing Time</strong>
                    <span>{{ $visa->processing_days }} days</span>
                </div>
                <div>
                    <strong>Validity</strong>
                    <span>{{ $visa->validity_days }} days</span>
                </div>
                <div>
                    <strong>Destination</strong>
                   <span>
    <img 
        src="https://flagcdn.com/w20/{{ isset($toCountry->code) ? strtolower($toCountry->code) : 'ng' }}.png" 
        style="width:20px;vertical-align:middle;margin-right:8px;" 
        alt="{{ $toCountry->name ?? 'Nigeria' }} flag"
    >
    {{ $toCountry->name ?? 'Nigeria' }}
</span>

                </div>
                <div>
                    <strong>Applicant Email</strong>
                    <span>{{ $userDetails['email'] }}</span>
                </div>
                <div>
                    <strong>Passenger Count</strong>
                    <span>{{ $passengerCount }}</span>
                </div>
                <div>
                    <strong>Total Paid</strong>
                    <span>{{ number_format($totalPrice, 2) }} NGN </span>
                </div>
            </div>
            <div style="margin-top: 24px; text-align: center;">
                <a href="{{ route('home') }}" class="btn pulse">Start New Application</a>
            </div>
        </div>
        <div class="support-text">
            Check your email for a detailed confirmation and attached documents. For support, contact us at
            <span class="tooltip">
                <a href="mailto:support@travelwheel.com">support@travelwheel.com</a>
                <span class="tooltip-text">Reach out to our support team for any assistance.</span>
            </span>
        </div>
    </div>

    <script>
        feather.replace();

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            themeToggle.innerHTML = `<i data-feather="${newTheme === 'light' ? 'moon' : 'sun'}"></i>`;
            feather.replace();
        });

        // Confetti Animation on Page Load
        function launchConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
                colors: ['#4f46e5', '#10b981', '#f59e0b'],
                zIndex: 999
            });
        }

        // Trigger confetti on load
        window.addEventListener('load', () => {
            launchConfetti();
            setTimeout(launchConfetti, 500); // Double burst for effect
        });

        // Add hover animation to details cards
        document.querySelectorAll('.details div').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
                card.style.background = 'var(--card-bg)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.background = 'var(--bg)';
            });
        });
    </script>
</body>
</html>