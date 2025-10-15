<head>

<style>
         @media (max-width: 850px) {
            .mynavbar {
                display: block;
            }
        }
    </style>

</head>
    <nav class="navbar navbar-expand-lg  navbar-light bg-light shadow-sm fixed-top">
        <div class="container" id="div-nav">
            <a class="navbar-brand" href="{{ route('welcome')}}" id="a-nav"><img src="../assetsU/assets/img/favicon/twlogo.png" width="150px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link a-nav text-muted" href="air">Air</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link a-nav" href="faq">
                            <div class="row">
                                <div class="col-9">
                                    <p class="product-nav">Flight Bookings </p>
                                    <small class="product-nav-small">Book a flight ticket with ease</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link a-nav" href="faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link a-nav" href="help">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>