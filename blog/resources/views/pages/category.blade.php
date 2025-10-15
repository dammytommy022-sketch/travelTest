<!DOCTYPE html>
<html lang="en">


<head>
  <title>travelwheel - Blog </title>
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
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

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
    <section class="pt-4">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card bg-dark-overlay-4 overflow-hidden card-bg-scale h-300 text-center"
              style="background-image:url('{{ asset($firstpic) }}'); background-position: center left; background-size: cover;">
              <!-- Card Image overlay -->
              <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                <div class="w-100 my-auto">
                  <div class="text-white mb-3">Browsing category:</div>
                  @php
                    $backgroundClasses = [
                        'text-bg-primary',
                        'text-bg-secondary',
                        'text-bg-success',
                        'text-bg-danger',
                        'text-bg-warning',
                        'text-bg-info',
                        'text-bg-light',
                        'text-bg-dark',
                    ];
                    $randomBackgroundClass = $backgroundClasses[array_rand($backgroundClasses)];
                  @endphp

                  <h1 class="text-white h2">
                    <span class="badge {{ $randomBackgroundClass }} mb-2">
                      <i class="fas fa-circle me-2 small fw-bold"></i>{{ $category }}</span>
                  </h1>
                  <div class="text-center position-relative">
                    <span class="badge text-bg-info fs-6">{{ $count }} posts</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- =======================
Inner intro END -->

    <!-- =======================
Main content START -->

    <!-- =======================
Main content END -->
    <section class="position-relative pt-0">
      <div class="container" data-sticky-container>
        <div class="row">
          <!-- Main Post START -->
          <div class="col-lg-9">
            <div id="posts-container" class="row gy-4">
              @foreach ($categoryPosts as $post)
                @include('partials.blog_post_card', ['post' => $post])
              @endforeach
            </div>

            <!-- Pagination START -->
            <section>
              <div class="container">
                <div class="row">

                  <nav class="mt-5" aria-label="navigation">
                    <ul class="pagination d-flex justify-content-between">
                      <li id="older-btn"
                        class="page-item flex-fill text-center {{ !$categoryPosts->nextPageUrl() ? 'disabled' : '' }}">
                        <a href="#" class="page-link"> <i class="fas fa-long-arrow-alt-left me-2 rtl-flip"></i>
                          Older</a>
                      </li>
                      <li id="newer-btn"
                        class="page-item flex-fill text-center {{ !$categoryPosts->previousPageUrl() ? 'disabled' : '' }}">
                        <a href="#" class="page-link">Newer <i
                            class="fas fa-long-arrow-alt-right ms-2 rtl-flip"></i></a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </section>
            <!-- Pagination END -->
          </div>

          <!-- Main Post END -->

          <!-- Sidebar START -->
          <div class="col-lg-3 mt-5 mt-lg-0">
            <div data-sticky data-margin-top="80" data-sticky-for="767">
              <!-- Categories -->
              <div class="row g-2">
                <h5>Other Categories</h5>
                @foreach ($postsByCategory as $category => $count)
                  @php
                    $colors = ['warning', 'info', 'danger', 'primary', 'success'];
                    $randomColor = $colors[array_rand($colors)];
                  @endphp
                  <div
                    class="d-flex justify-content-between align-items-center bg-{{ $randomColor }} bg-opacity-15 rounded p-2 position-relative">
                    <h6 class="m-0 text-{{ $randomColor }}">{{ $category }}</h6>
                    <a href="{{ route('category', ['category' => $category]) }}"
                      class="badge bg-{{ $randomColor }} stretched-link">{{ $count }}</a>
                  </div>
                @endforeach
              </div>
              <!-- ADV widget START -->
              <div class="col-12 col-sm-6 col-lg-12 my-4">
                <a href="#" class="d-block card-img-flash">
                  <img src="{{ asset('assets/images/adv.png') }}" alt="">
                </a>
                <div class="smaller text-end mt-2">ads via <a href="#"
                    class="text-body-secondary"><u>Bootstrap</u></a></div>
              </div>
              <!-- ADV widget END -->
            </div>
          </div>
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
  <!-- =======================
Footer END -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

  <!-- =======================
JS libraries, plugins and custom scripts -->

  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Vendors -->
  <script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
  <script src="{{ asset('assets/vendor/sticky-js/sticky.min.js') }}"></script>

  <!-- Template Functions -->
  <script src="{{ asset('assets/js/functions.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      function loadPosts(url, direction) {
        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
            var $postsContainer = $('#posts-container');
            var $newPosts = $('<div class="row gy-4"></div>');

            $.each(response.posts, function(index, post) {
              var postHtml = `<div class="col-sm-6">
                                        <div class="card">
                                            <div class="position-relative">
                                                <img class="card-img" src="${post.image}" alt="Card image">
                                                <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                                    <div class="w-100 mt-auto">
                                                        <a href="#" class="badge text-bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>${post.category}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body px-0 pt-3">
                                                <h4 class="card-title"><a href="post-single-2.html" class="btn-link text-reset fw-bold">${post.title}</a></h4>
                                                <p class="card-text"></p>
                                                <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                                    <li class="nav-item">
                                                        <div class="nav-link">
                                                            <div class="d-flex align-items-center position-relative">
                                                                <div class="avatar avatar-xs">
                                                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="avatar">
                                                                </div>
                                                                <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Dr Mayor</a></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">${new Date(post.created_at).toLocaleDateString()}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>`;
              $newPosts.append(postHtml);
            });

            if (direction === 'older') {
              $postsContainer.append($newPosts.children()).hide().fadeIn(500);
            } else {
              $postsContainer.prepend($newPosts.children()).hide().fadeIn(500);
            }

            $('#older-btn').toggleClass('disabled', !response.nextPage);
            $('#newer-btn').toggleClass('disabled', !response.prevPage);
            $('#older-btn a').attr('href', response.nextPage || '#');
            $('#newer-btn a').attr('href', response.prevPage || '#');
          }
        });
      }

      $(document).on('click', '#older-btn a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        if (url !== '#') {
          loadPosts(url, 'older');
        }
      });

      $(document).on('click', '#newer-btn a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        if (url !== '#') {
          loadPosts(url, 'newer');
        }
      });
    });
  </script>
</body>

<!-- Mirrored from blogzine.webestica.com/categories.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 Jun 2024 12:55:17 GMT -->

</html>
