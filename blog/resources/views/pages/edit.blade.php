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
  <link rel="shortcut icon" href="https://www.travelwheel.ng/assetsU/assets/img/favicon/twicon.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Rubik:wght@400;500;700&amp;display=swap"
    rel="stylesheet">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/font-awesome/css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/apexcharts/css/apexcharts.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/quill/css/quill.snow.css')}}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .img-thumbnail {
    width: 150px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Ensure the image covers the thumbnail area without distortion */
}

</style>

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style1.css')}}">
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
          <img class="navbar-brand-item light-mode-item" src="{{asset('assets/images/mainlogo.png')}}" alt="logo">
        </a>
      
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
                <form id="postForm" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Post name</label>
                                <input required id="con-name" name="title" type="text" class="form-control" placeholder="Post name" value="{{ $post->title }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Post body</label>
                                <textarea id="editor" name="content">{{ $post->content }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="position-relative">
                                    <h6 class="my-2">Upload post image here, or <a href="#!" class="text-primary">Browse</a></h6>
                                    <label class="w-100" style="cursor:pointer;">
                                        <span>
                                            <input class="form-control stretched-link" type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png">
                                        </span>
                                    </label>
                                </div>
                                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested dimensions are 600px * 450px. Larger image will be cropped to 4:3 to fit thumbnails/previews.</p>
                                @if($post->image)
                                    <img src="{{ asset($post->image) }}" alt="Post Image" style="width: 100px; margin-top: 10px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5">
    <div class="mb-3">
        <label class="form-label" for="multiSelect">Category</label>
        <select id="multiSelect" class="form-control" name="category[]" multiple="multiple">
            @foreach($categories as $category)
                <option value="{{ $category }}" selected>{{ $category }}</option>
            @endforeach
        </select>
    </div>
</div>

                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label class="form-label">Author Name</label>
                                <input required id="author-name" name="author" type="text" class="form-control" placeholder="Author name" value="{{ $post->author }}">
                            </div>
                        </div>
                        <div class="col-md-12 text-start">
                            <button class="btn btn-primary w-100" type="submit">Update post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
  <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Vendors -->
  <script src="{{asset('assets/vendor/apexcharts/js/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/js/quill.min.js')}}"></script>

  <!-- Template Functions -->
  <script src="{{asset('assets/js/functions.js')}}"></script>
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
          // Remove the extra '' from the URL if present
          let correctedUrl = data.location.replace('/', '/');
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
  submitBtn.innerHTML = 'Updating...';

  document.getElementById('alert-container').innerHTML = '';

  let formData = new FormData(this);
  let content = tinymce.get('editor').getContent();

  content = content.replace(/src="\/storage\//g, 'src="' + '{{ asset('') }}' + 'storage/');

  formData.append('content', content);

  // Convert the selected categories to an array and append to formData
  let selectedCategories = $('#multiSelect').val();
  formData.append('category', JSON.stringify(selectedCategories));

  // Get the post ID from a hidden input or any other source (assuming you have a hidden input with the ID)
  const postId = '{{ $post->id }}'; // This is dynamically injected by Blade

  fetch('{{ url('posts') }}/' + postId, {
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
        displayAlert('success', 'Post updated successfully!');
      } else {
        displayAlert('danger', 'An error occurred.');
      }
      submitBtn.innerHTML = 'Update post';
    })
    .catch(error => {
      console.error('Error:', error);
      displayAlert('danger', `An error occurred: ${error.message}`);
      submitBtn.innerHTML = 'Update post';
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
