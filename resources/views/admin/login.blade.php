
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login · TravelWheel</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, #efeff5 0%, #1a2db8 50%, #cdcdd4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            padding: 44px 40px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.25);
        }
        .logo-wrap { text-align: center; margin-bottom: 28px; }
        .logo-wrap img { height: 36px; }
        .logo-icon {
            width: 56px; height: 56px;
            background: #eef1ff;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 24px;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: #0d1883;
            text-align: center;
            margin-bottom: 6px;
        }
        .sub {
            font-size: 13px;
            color: #888;
            text-align: center;
            margin-bottom: 28px;
        }
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #dde0ee;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #1a1a1a;
            background: #fafbff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-group input:focus {
            border-color: #0d1883;
            box-shadow: 0 0 0 3px rgba(13,24,131,.08);
            background: #fff;
        }
        .error-msg {
            background: #fff0f0;
            border: 1px solid #ffc5c5;
            color: #c0392b;
            border-radius: 9px;
            padding: 10px 14px;
            font-size: 12.5px;
            margin-bottom: 16px;
        }
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #0d1883, #2d39b6);
            color: white;
            border: none;
            border-radius: 11px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all .2s;
            margin-top: 4px;
        }
        .btn-login:hover { background: linear-gradient(135deg, #0b1570, #1e2d9e); transform: translateY(-1px); }
        .footer-note {
            text-align: center;
            font-size: 11.5px;
            color: #bbb;
            margin-top: 22px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-wrap">
            <div class="logo-icon">
                <img src="https://travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="TravelWheel Logo">
            </div>
            <h1>Admin Panel</h1>
            <p class="sub">TravelWheel Ground Transport · Staff only</p>
        </div>

        @if($errors->has('credentials'))
            <div class="error-msg">{{ $errors->first('credentials') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter username" autocomplete="username" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" autocomplete="current-password" required>
            </div>
            <button type="submit" class="btn-login">Sign In →</button>
        </form>

        <p class="footer-note">© {{ date('Y') }} TravelWheel · Secure admin access</p>
    </div>
</body>

