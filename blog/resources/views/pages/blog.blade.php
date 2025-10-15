<!DOCTYPE html>
<html lang="en">


<head>
  <title>travelwheel - Blog</title>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Webestica.com">
  <meta name="description" content="Bootstrap based News, Magazine and Blog Theme">

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
  <style>
  .card {
  border-radius: 0;
  transition: transform 0.2s ease-in-out;
}

.card:hover {
  transform: translateY(-5px);
}

.card img {
  border-radius: 0;
}

.card-title a {
  font-size: 1.25rem;
  line-height: 1.2;
  color: #333;
  transition: color 0.2s;
}

.card-title a:hover {
  color: #007bff;
}

.card-text {
  color: #6c757d;
}

.nav-divider {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
}

.nav-item {
  margin-right: 1rem;
}

.nav-item:last-child {
  margin-right: 0;
}

.text-reset {
  color: inherit;
}

.badge {
  font-size: 0.75rem;
  vertical-align: middle;
}

.shadow-sm {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

  </style>

  <!-- Favicon -->
  <link rel="shortcut icon" href="https://www.travelwheel.ng/public/assetsU/assets/img/favicon/twicon.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/tiny-slider/tiny-slider.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/glightbox/css/glightbox.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/plyr/plyr.css">

  <!-- Theme CSS -->
  <!--<link rel="stylesheet" type="text/css" href="assets/css/style1.css">-->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">


  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
Latest news slider START -->



    <!-- =======================
Main content START -->
    <section class="position-relative">
      <div class="container" data-sticky-container>
        <div class="row mb-3">
          <!-- Main Post START -->
  <div class="container">
  <div class="row">
    <!-- Main Content Area -->
    <div class="col-lg-9">
      <div class="row gy-4">
        <div id="post-container" class="row" style="margin-top: 120px;">
          @include('partials.posts', ['mostReadPosts' => $mostReadPosts])
        </div>
      </div>
      <!-- Pagination START -->
      <section>
        <div class="container">
          <div class="row">
            <nav class="mt-5" aria-label="navigation">
              <ul class="pagination d-flex justify-content-between">
                <li class="page-item flex-fill text-center">
                  <a href="#" class="page-link" id="older-button" data-page="{{ $page - 1 }}">
                    <i class="fas fa-long-arrow-alt-left me-2 rtl-flip"></i> Older
                  </a>
                </li>
                <li class="page-item flex-fill text-center">
                  <a href="#" class="page-link" id="newer-button" data-page="{{ $page + 1 }}"
                    @if (!$hasMorePosts) style="pointer-events: none; color: gray;" @endif>
                    Newer <i class="fas fa-long-arrow-alt-right ms-2 rtl-flip"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </section>
      
              <a href="#" class="card-img-flash d-block mt-4 ">
                <img src="{{ asset( $footerAdverts->file_path) }}" alt="adv" width="100%" height="70px">
              </a>
            
          
      <!-- Pagination END -->
    </div>
    <div class="col-lg-3 mt-2 mt-lg-0">
  <div data-sticky data-margin-top="150" data-sticky-for="767">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach ($sideAdverts as $index => $advert)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }} rounded-0">
            <img class="d-block w-100" src="{{ asset($advert->file_path) }}" alt="Slide {{ $index + 1 }}">
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>


    <!-- Sidebar -->
 
  </div>
</div>


          <!-- Main Post END -->
          <!-- Sidebar START -->
          <!-- Sidebar END -->
        </div> <!-- Row end -->
      </div>
    </section>

            
          

   



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

  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/659c32ee8d261e1b5f50d732/1hjl2dtgn';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
  <!-- =======================
Footer END -->

  <!-- =======================
Cookies alert START -->
  <!--<div-->
  <!--  class="alert alert-dismissible fade show bg-dark text-white position-fixed start-0 bottom-0 z-index-99 shadow p-4 ms-3 mb-3 col-9 col-md-4 col-lg-3 col-xl-2"-->
  <!--  role="alert">-->
  <!--  This website stores cookies on your computer. To find out more about the cookies we use, see our <a-->
  <!--    class="text-white" href="#"> Privacy Policy</a>-->
  <!--  <div class="mt-4">-->
  <!--    <button type="button" class="btn btn-success-soft btn-sm mb-0" data-bs-dismiss="alert" aria-label="Close">-->
  <!--      <span aria-hidden="true">Accept</span>-->
  <!--    </button>-->
  <!--    <button type="button" class="btn btn-danger-soft btn-sm mb-0" data-bs-dismiss="alert" aria-label="Close">-->
  <!--      <span aria-hidden="true">Decline</span>-->
  <!--    </button>-->
  <!--  </div>-->
  <!--  <div class="position-absolute end-0 top-0 mt-n3 me-n3"><img class="w-100" src="assets/images/cookie.svg"-->
  <!--      alt="cookie"></div>-->
  <!--</div>-->
  <!-- =======================
Cookies alert END -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

  <!-- =======================
JS libraries, plugins and custom scripts -->

  <!-- Bootstrap JS -->
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Vendors -->
  <script src="assets/vendor/tiny-slider/tiny-slider.js"></script>
  <script src="assets/vendor/sticky-js/sticky.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.js"></script>
  <script src="assets/vendor/plyr/plyr.js"></script>

  <!-- Template Functions -->
  <script src="assets/js/functions.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      function loadPosts(page) {
        $.ajax({
          url: '{{ route('mostReadPosts') }}',
          type: 'GET',
          data: {
            page: page
          },
          success: function(response) {
            let html = '';
            $.each(response.posts, function(index, post) {
              html += `
                    <div class="col-12 col-md-6">
                        <div class="card mb-3">
                            <div class="row g-3">
                                <div class="col-4">
                                    <img class="rounded" src="${post.image}" alt="${post.title}">
                                </div>
                                <div class="col-8">
                                    <h5>
                                        <a href="" class="btn-link stretched-link text-reset">${post.title}</a>
                                    </h5>
                                    <ul class="nav nav-divider align-items-center mt-3 small">
                                        <li class="nav-item">
                                            <div class="nav-link">
                                                <div class="d-flex align-items-center position-relative">
                                                    <div class="avatar avatar-xs">
                                                        <img class="avatar-img rounded-circle"
                                                            src="assets/images/avatar/14.jpg" alt="avatar">
                                                    </div>
                                                    <span class="ms-2">by <a href="#" class="stretched-link text-reset btn-link">Dr mayor</a></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item">${new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });
            $('#post-container').html(html);
            $('#older-button').data('page', page - 1);
            $('#newer-button').data('page', page + 1);
            if (!response.hasMorePosts) {
              $('#newer-button').css('pointer-events', 'none').css('color', 'gray');
            } else {
              $('#newer-button').css('pointer-events', '').css('color', '');
            }
          },
          error: function(xhr) {
            console.log(xhr.responseText);
          }
        });
      }

      $('#older-button').click(function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        if (page > 0) {
          loadPosts(page);
        }
      });

      $('#newer-button').click(function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        loadPosts(page);
      });
    });
  </script>
</body>


</html>
