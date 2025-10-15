<!DOCTYPE html>
<html lang="en">


<head>
  <title>travelwheel - Blog</title>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Webestica.com">
  <meta name="description" content="TravelWheel Blog">

  <!-- Dark mode -->
  <script>
    const storedTheme = localStorage.getItem('theme')

    const getPreferredTheme = () => {
      if (storedTheme) {
        return storedTheme
      }
      return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
    }

    const setTheme = function(theme) {
      if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-bs-theme', 'dark')
      } else {
        document.documentElement.setAttribute('data-bs-theme', theme)
      }
    }

    setTheme(getPreferredTheme())

    window.addEventListener('DOMContentLoaded', () => {
      var el = document.querySelector('.theme-icon-active');
      if (el != 'undefined' && el != null) {
        const showActiveTheme = theme => {
          const activeThemeIcon = document.querySelector('.theme-icon-active use')
          const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
          const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

          document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active')
          })

          btnToActive.classList.add('active')
          activeThemeIcon.setAttribute('href', svgOfActiveBtn)
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
          if (storedTheme !== 'light' || storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
          }
        })

        showActiveTheme(getPreferredTheme())

        document.querySelectorAll('[data-bs-theme-value]')
          .forEach(toggle => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value')
              localStorage.setItem('theme', theme)
              setTheme(theme)
              showActiveTheme(theme)
            })
          })

      }
    })
  </script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="https://www.travelwheel.ng/public/assetsU/assets/img/favicon/twicon.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Rubik:wght@400;500;700&amp;display=swap"
    rel="stylesheet">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/plyr/plyr.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">


  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style1.css') }}">

</head>

<body>

  <!-- =======================
Header START -->
  <header>
    <!-- Navbar top -->
    <section>
      @include('layouts.newnav')
    </section>
    <!-- Navbar END -->
  </header>
  <!-- =======================
Header END -->

  <!-- **************** MAIN CONTENT START **************** -->
  <main>

    <!-- =======================
Inner intro START -->
    <section class="pt-2">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card bg-dark-overlay-5 overflow-hidden card-bg-scale h-400 text-center"
              style="background-image:url('{{ asset($post->image) }}'); background-position: center left; background-size: cover;">
              <!-- Card Image overlay -->
              <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                <div class="w-100 my-auto">
                  <!-- Card category -->
                  @php
                    $colors = ['danger', 'primary', 'success', 'info', 'warning'];
                    $randomColor = $colors[array_rand($colors)];
                  @endphp
                  <a href="#" class="badge text-bg-{{ $randomColor }} mb-2"><i
                      class="fas fa-circle me-2 small fw-bold"></i>{{ $post->category }}</a>
                  <!-- Card title -->
                  <h2 class="text-white display-5">{{ $post->title }}</h2>
                  <!-- Card info -->
                  <ul class="nav nav-divider text-white-force align-items-center justify-content-center">
                    <li class="nav-item">
                      <div class="nav-link">
                        <div class="d-flex align-items-center text-white position-relative">
                          <div class="avatar avatar-sm">
                            <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/14.jpg') }}"
                              alt="avatar">
                          </div>
                          <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Dr
                              Mayor</a></span>
                        </div>
                      </div>
                    </li>
                    <li class="nav-item">{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}</li>
                    <li class="nav-item">5 min read</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Inner intro END -->
    <!-- Main START -->
    <section class="pt-0">
      <div class="container position-relative" data-sticky-container>
        <div class="row">
          <!-- Main Content START -->
          <div class="col-lg-9 mb-5">
            {!! $post->content !!}

            
          </div>
          <!-- Main Content END -->

          <!-- Right sidebar START -->
          <div class="col-lg-3">
            <div data-sticky data-margin-top="200" data-sticky-for="767">
              <div class="row g-1">
                <div class="col-lg-12">
                  <div class="tiny-slider arrow-hover arrow-blur arrow-round rounded-3">
                    <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="0"
                      data-arrow="true" data-dots="false" data-items="1">
                      <!-- Slide 1 -->
                      <div class="card card-overlay-bottom card-bg-scale h-400 h-lg-560 rounded-0"
                        style="background-image:url(https://www.travelwheel.ng/public/assets/image/webad2.jpg); background-position: center left; background-size: cover;">
                      </div>
                      <!-- Slide 2 -->
                      <div class="card card-overlay-bottom card-bg-scale h-400 h-lg-560 rounded-0"
                        style="background-image:url(https://www.travelwheel.ng/public/assets/image/webad3.jpg); background-position: center left; background-size: cover;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Right sidebar END -->
        </div>
      </div>
    </section>
    <!-- =======================
Main END -->

    <!-- =======================
Sticky post START -->
    <div class="sticky-post bg-light border p-4 mb-5 text-sm-end rounded d-none d-xxl-block">
      <div class="d-flex align-items-center">
        <!-- Title -->
        <div class="me-3">
          <span>Next post<i class="bi bi-arrow-right ms-3"></i></span>
          <h6 class="m-0"> <a href="javascript:void(0)" class="stretched-link btn-link text-reset">Bad habits that
              people in the industry need to quit</a></h6>
        </div>
        <!-- image -->
        <div class="col-4 d-none d-md-block">
          <img src="assets/images/blog/4by3/05.jpg" alt="Image">
        </div>
      </div>
    </div>
    <!-- =======================
Sticky post END -->

  </main>
  <!-- **************** MAIN CONTENT END **************** -->

  <!-- =======================
Footer START -->
  <footer style="background-color: #0d1883">
    <section class="container-fluid bg-pry">
      <div class="row p-3">
        <div class="col-6  col-sm-6 col-md-2 p-2 footter">
          <h3 class="text-white">Travel Wheel</h3>
        </div>
        <div class="col-6  col-sm-6 col-md-2 p-2 footter">
          <h4 class="text-white">Products</h4>
          <ul class="list-unstyled">
            <li> <a href="#" class="text-white">Air Transport</a></li>
            <li> <a href="#" class="text-white">Land Transport</a></li>
            <li> <a href="#" class="text-white">Rail Transport</a></li>
            <li> <a href="#" class="text-white">Water Transport</a></li>

          </ul>
        </div>
        <div class="col-6  col-sm-6 col-md-2 p-2 footter">
          <h4 class="text-white">Features</h4>
          <ul class="list-unstyled">
            <li> <a href="#" class="text-white">Ticket Bookings</a></li>
            <li> <a href="#" class="text-white">Visa Application</a></li>
            <li> <a href="#" class="text-white">Logistics</a></li>
            <li> <a href="#" class="text-white">Shipping / Cargo</a></li>

          </ul>
        </div>
        <div class="col-6  col-sm-6 col-md-2 p-2 footter">
          <h4 class="text-white">Company</h4>
          <ul class="list-unstyled">
            <li> <a href="#" class="text-white">About US</a></li>
            <li> <a href="#" class="text-white">Media</a></li>
            <li> <a href="#" class="text-white">Terms & Condition</a></li>

          </ul>
        </div>
        <div class="col-6  col-sm-6 col-md-2 p-2 footter ">
          <h4 class="text-white">Help</h4>
          <ul class="list-unstyled ">
            <li> <a class="text-white" href="#">FAQ</a></li>
            <li> <a class="text-white" href="#">Contact</a></li>

          </ul>
        </div>
        <div class="col-6  col-sm-6 col-md-2 p-2 footter ">
          <h4 class="text-white">Social Media</h4>
          <a href="#" class="twitter text-white"><i class="fab fa-twitter p-2"></i></a>
          <a href="#" class="facebook text-white"><i class="fab fa-facebook p-2"></i></a>
          <a href="#" class="instagram text-white"><i class="fab fa-instagram p-2"></i></a>
          <a href="#" class="google-plus text-white"><i class="fab fa-google p-2"></i></a>
        </div>
      </div>
    </section>
  </footer>
  <!-- =======================
Footer END -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

  <!-- =======================
JS libraries, plugins and custom scripts -->

  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Vendors -->
  <script src="{{ asset('assets/vendor/sticky-js/sticky.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
    <script src="{{ asset('assets/vendor/plyr/plyr.js') }}"></script>
  <script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>


  <!-- Template Functions -->
  <script src="{{ asset('assets/js/functions.js') }}"></script>

</body>


</html>
