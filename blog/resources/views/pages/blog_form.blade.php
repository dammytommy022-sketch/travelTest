<!DOCTYPE html>
<html lang="en">

<head>
  <title>TravelWheel - Post</title>

  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="#">
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
  <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/apexcharts/css/apexcharts.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/quill/css/quill.snow.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .img-thumbnail {
    width: 150px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Ensure the image covers the thumbnail area without distortion */
}

</style>

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
  <script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js"></script>


</head>

<body>

  <!-- =======================
Header START -->
  <header class="navbar-light navbar-sticky header-static border-bottom navbar-dashboard">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-xl">
      <div class="container">
        <!-- Logo START -->
        <a class="navbar-brand me-3" href="index-2.html">
          <img class="navbar-brand-item light-mode-item" src="assets/images/mainlogo.png" alt="logo">
        </a>
        <!-- Logo END -->



        <!-- Main navbar END -->

        <!-- Nav right START -->
        <!--<div class="nav flex-nowrap align-items-center">-->



          <!-- Profile dropdown START -->
        <!--  <div class="nav-item ms-2 ms-md-3 dropdown">-->
            <!-- Avatar -->
        <!--    <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"-->
        <!--      data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--      <img class="avatar-img rounded-circle"-->
        <!--        src="https://www.travelwheel.ng/public/assetsU/assets/img/favicon/twicon.png" alt="avatar">-->
        <!--    </a>-->

            <!-- Profile dropdown START -->
        <!--    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"-->
        <!--      aria-labelledby="profileDropdown">-->
              <!-- Profile info -->
        <!--      <li class="px-3">-->
        <!--        <div class="d-flex align-items-center">-->
                  <!-- Avatar -->
        <!--          <div class="avatar me-3">-->
        <!--            <img class="avatar-img rounded-circle shadow" src="assets/images/avatar/03.jpg" alt="avatar">-->
        <!--          </div>-->
        <!--          <div>-->
        <!--            <a class="h6 mt-2 mt-sm-0" href="#"> Louis Ferguson</a>-->
        <!--            <p class="small m-0">example@gmail.com</p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--        <hr>-->
        <!--      </li>-->
              <!-- Links -->
        <!--      <li><a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a>-->
        <!--      </li>-->
        <!--      <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Account Settings</a>-->
        <!--      </li>-->
        <!--      <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help</a></li>-->
        <!--      <li><a class="dropdown-item" href="#"><i class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>-->
        <!--      <li class="dropdown-divider mb-3"></li>-->
        <!--      <li>-->
        <!--        <div class="align-items-center text-center py-0">-->
        <!--          <span class="me-3">mode:</span>-->
        <!--          <div class="btn-group theme-icon-active" role="group" aria-label="Default button group">-->
        <!--            <button type="button" class="btn btn-light btn-sm mb-0" data-bs-theme-value="light">-->
        <!--              <svg width="16" height="16" fill="currentColor"-->
        <!--                class="bi bi-brightness-high-fill fa-fw mode-switch" viewBox="0 0 16 16">-->
        <!--                <path-->
        <!--                  d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />-->
        <!--                <use href="#"></use>-->
        <!--              </svg>-->
        <!--            </button>-->
        <!--            <button type="button" class="btn btn-light btn-sm mb-0" data-bs-theme-value="dark">-->
        <!--              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
        <!--                class="bi bi-moon-stars-fill fa-fw mode-switch" viewBox="0 0 16 16">-->
        <!--                <path-->
        <!--                  d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />-->
        <!--                <path-->
        <!--                  d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />-->
        <!--                <use href="#"></use>-->
        <!--              </svg>-->
        <!--            </button>-->
        <!--            <button type="button" class="btn btn-light btn-sm mb-0 active" data-bs-theme-value="auto">-->
        <!--              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
        <!--                class="bi bi-circle-half fa-fw mode-switch" viewBox="0 0 16 16">-->
        <!--                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />-->
        <!--                <use href="#"></use>-->
        <!--              </svg>-->
        <!--            </button>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </li>-->
        <!--    </ul>-->
            <!-- Profile dropdown END -->
        <!--  </div>-->
          <!-- Profile dropdown END -->

          <!-- Nav right END -->
        <!--</div>-->
      </div>
    </nav>
    <!-- Logo Nav END -->
  </header>
  <!-- =======================
Header END -->

  <!-- **************** MAIN CONTENT START **************** -->
  <main>

    <!-- =======================
Main contain START -->
<section class="py-4">
      <div class="container">
        <div class="row pb-4">
          <div class="col-12">
            <h1 class="mb-0 h2">Create a post</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card border">
              <div class="card-body">
                <div id="alert-container"></div>
                <form id="postForm">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label">Post name</label>
                        <input required id="con-name" name="title" type="text" class="form-control"
                          placeholder="Post name">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label class="form-label">Post body</label>
                        <textarea id="editor" name="content"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <div class="position-relative">
                          <h6 class="my-2">Upload post image here, or <a href="#!"
                              class="text-primary">Browse</a></h6>
                          <label class="w-100" style="cursor:pointer;">
                            <span>
                              <input class="form-control stretched-link" type="file" name="image"
                                id="image" accept="image/gif, image/jpeg, image/png">
                            </span>
                          </label>
                        </div>
                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested dimensions are
                          600px * 450px. Larger image will be cropped to 4:3 to fit thumbnails/previews.</p>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="mb-3">
                        <label class="form-label" for="multiSelect">Category</label>
                        <select id="multiSelect" class="form-control" name="category[]" multiple="multiple">
                        </select>
                      </div>
                    </div>
                     <div class="col-lg-5">
                      <div class="mb-3">
                        <label class="form-label">Author Name</label>
                       <input required id="author-name" name="author" type="text" class="form-control"
                          placeholder="Author name">
                      </div>
                    </div>
                    <div class="col-md-12 text-start">
                      <button class="btn btn-primary w-100" type="submit">Create post</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
          <div class="row pb-4">
          <div class="col-12">
            <h1 class="mb-0 h2">Advert Images</h1>
          </div>
        </div>
<div class="row">
    <div class="col-12">
        <div class="card border">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <form action="{{ route('sideadvert.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="form-label">Side Advert</label>
                                <input required name="sideadvert" type="file" class="form-control">
                                <button type="submit" class="btn btn-primary mt-3">Upload Image</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <form action="{{ route('footeradvert.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="form-label">Footer Advert</label>
                                <input required name="footeradvert" type="file" class="form-control">
                                <button type="submit" class="btn btn-primary mt-3">Upload Image</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <h3>Side Adverts</h3>
                <div id="sideAdvertContainer">
                    @foreach($sideAdverts as $advert)
                        <div class="advert-item">
                           <img src="{{ $advert->file_path }}" alt="Side Advert" class="img-thumbnail">
                            <form action="{{ route('advert.delete', ['type' => 'side', 'id' => $advert->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <h3 class="mt-4">Footer Adverts</h3>
                <div id="footerAdvertContainer">
                    @foreach($footerAdverts as $advert)
                        <div class="advert-item">
                            <img src="{{ asset( $advert->file_path) }}" alt="Footer Advert" class="img-thumbnail">
                            <form action="{{ route('advert.delete', ['type' => 'footer', 'id' => $advert->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="card border">
            <div class="card-body">
                <h1>Blog Posts</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{!! \Illuminate\Support\Str::limit($post->content, 50) !!}</td>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset( $post->image) }}" alt="Post Image" style="width: 100px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $post->author }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" id="delete-form-{{ $post->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $post->id }}">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
            </div>
        </div>
        </div>
</div>
    </section>    <!-- =======================
Main contain END -->

  </main>
  <!-- **************** MAIN CONTENT END **************** -->

  <!-- =======================
Footer START -->
  <footer class="mb-3">
    <div class="container">
      <div class="card card-body bg-light">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-6">
            <!-- Copyright -->
            <div class="text-center text-lg-start">©{{ date('Y') }} <a href="#" class="text-reset btn-link"
                target="_blank">TravelWheel Blog</a>. All rights reserved
            </div>
          </div>
          <div class="col-lg-6 d-sm-flex align-items-center justify-content-center justify-content-lg-end">
            <!-- Language switcher -->
            <div class="dropup me-0 me-sm-3 mt-3 mt-md-0 text-center text-sm-end">
              <a class="dropdown-toggle text-body" href="#" role="button" id="languageSwitcher"
                data-bs-toggle="dropdown" aria-expanded="false">
                English Edition
              </a>
              <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                <li><a class="dropdown-item" href="#">English</a></li>
                <li><a class="dropdown-item" href="#">German </a></li>
                <li><a class="dropdown-item" href="#">French</a></li>
              </ul>
            </div>
            <!-- Links -->
            <ul class="nav text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
              <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
              <li class="nav-item"><a class="nav-link pe-0" href="#">Cookies</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- =======================
Footer END -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

  <!-- =======================
JS libraries, plugins and custom scripts -->

  <!-- Bootstrap JS -->
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Vendors -->
  <script src="assets/vendor/apexcharts/js/apexcharts.min.js"></script>
  <script src="assets/vendor/quill/js/quill.min.js"></script>

  <!-- Template Functions -->
  <script src="assets/js/functions.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.delete-btn', function() {
            var postId = $(this).data('id');
            var form = $('#delete-form-' + postId);

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
  <script>
    $(document).ready(function() {
      const selectElement = $('#multiSelect');

      // Initialize Select2
      selectElement.select2({
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: "Select or add options",
        closeOnSelect: false
      });

      // Load options from localStorage
      function loadOptions() {
        const storedOptions = JSON.parse(localStorage.getItem('selectOptions')) || [];
        storedOptions.forEach(option => {
          if (!selectElement.find(`option[value="${option}"]`).length) {
            const newOption = new Option(option, option, false, false); // Add option but not selected
            selectElement.append(newOption).trigger('change');
          }
        });
      }

      loadOptions();

      // Save options to localStorage when changed
      selectElement.on('change.select2', function() {
        const options = selectElement.find('option').map(function() {
          return $(this).val();
        }).get();
        localStorage.setItem('selectOptions', JSON.stringify(options));
      });

      // Keep the dropdown open until clicking outside
      selectElement.on('select2:open', function() {
        $(document).on('click.select2', function(e) {
          if ($(e.target).closest('.select2-container').length === 0) {
            selectElement.select2('close');
            $(document).off('click.select2');
          }
        });
      });
    });
  </script>

  <style>
    .select2-container .select2-selection--multiple {
      height: auto;
    }
  </style>
  <script>
 tinymce.init({
  selector: '#editor',
  plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak paste', // Added paste plugin
  toolbar_mode: 'floating',
  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image',

  // Enable the image title field in the Image dialog
  image_title: true,
  // Enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,

  // URL to the upload handler
  images_upload_url: '{{ route('posts.uploadImage') }}',

  // Handle image upload
  images_upload_handler: function(blobInfo, success, failure) {
    let formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    fetch('{{ route('posts.uploadImage') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.location) {
          // Remove the extra 'public/' from the URL if present
          let correctedUrl = data.location.replace('/public/', '/');
          success(correctedUrl);
          console.log(correctedUrl);
        } else {
          failure('Image upload failed');
        }
      })
      .catch(() => {
        failure('Image upload failed');
      });
  },

  // Additional configuration to support drag-and-drop
  paste_data_images: true, // Allows pasting images from the clipboard
  file_picker_types: 'image', // Enables image file picker
  images_file_types: 'jpeg,jpg,png,gif', // Specify the allowed image formats
});


document.getElementById('postForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const submitBtn = document.querySelector('button[type="submit"]');
  submitBtn.innerHTML = 'Posting...';

  document.getElementById('alert-container').innerHTML = '';

  let formData = new FormData(this);
  let content = tinymce.get('editor').getContent();

  content = content.replace(/src="\/storage\//g, 'src="' + '{{ asset('') }}' + 'storage/');

  formData.append('content', content);

  // Convert the selected categories to an array and append to formData
  let selectedCategories = $('#multiSelect').val();
  formData.append('category', JSON.stringify(selectedCategories));

  fetch('{{ route('posts.store') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: formData
    })
    .then(response => {
        console.log(response);
      // Check if the response is JSON
      const contentType = response.headers.get('content-type');
      if (contentType && contentType.indexOf('application/json') !== -1) {
        return response.json(); // parse response as JSON
      } else {
        throw new Error('Response was not JSON');
      }
    })
    .then(data => {
      if (data.success) {
        displayAlert('success', 'Post created successfully!');
        document.getElementById('postForm').reset();
        tinymce.get('editor').setContent('');
      } else {
        displayAlert('danger', 'An error occurred.');
      }
      submitBtn.innerHTML = 'Create post';
    })
    .catch(error => {
      console.error('Error:', error);
      displayAlert('danger', `An error occurred: ${error.message}`);
      submitBtn.innerHTML = 'Create post';
    });
});

function displayAlert(type, message) {
  const alertContainer = document.getElementById('alert-container');
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
  alertDiv.role = 'alert';
  alertDiv.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  alertContainer.appendChild(alertDiv);
}

  </script>


</body>

</html>
