<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="icon" type="image/x-icon" href="{{ asset('assetsU/assets/img/favicon/twicon.png') }}" />
    <title>Travel Wheel </title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6/dist-font/css/font-awesome.min.css') }}">
    <script src="https://kit.fontawesome.com/b1c7dc27be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styleslide.css') }}">


</head> 

<body>
    <!-- Navbar -->
    <section>
        @include('layouts.topnav')
        @include('layouts.newnav')
    </section>
    <main id="main"> 

        @yield('content')
    </main>
 @include('layouts.footer')

 <!-- html -->
{{-- <script src="https://web.pressone.africa/pub-widget.js"></script>--}}
<div id="call-widget"></div>
<!-- script -->
<script>
   /* window.onload = function() {
        PressOne.init("pk_574736ebxCP65U9wcijrvQ0zfcJIe", { 
        minimal: true,
        display: false,
        bottom: "20px",
        right: "20px",
        element: "#call-widget",
        onCallInitiated: function (phone) {},
        onCallStarted: function (call) {},
        onCallEnded: function (call) {},
        })
    }
</script>

                    
 
                
            
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

  

</body>
</html>


