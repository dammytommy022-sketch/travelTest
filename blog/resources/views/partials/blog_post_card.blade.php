<div class="col-sm-6">
    <div class="card">
        <!-- Card img -->
        <div class="position-relative">
            <img class="card-img" src="{{ asset( $post->image) }}" alt="Card image">
            <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                <!-- Card overlay bottom -->
                <div class="w-100 mt-auto">
                    <!-- Card category -->
                    <a href="#" class="badge text-bg-warning mb-2">
                        <i class="fas fa-circle me-2 small fw-bold"></i>{{ $post->category }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-3">
            <h4 class="card-title">
                <a href="post-single-2.html" class="btn-link text-reset fw-bold">{{ $post->title }}</a>
            </h4>
            <p class="card-text"></p>
            <!-- Card info -->
            <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                <li class="nav-item">
                    <div class="nav-link">
                        <div class="d-flex align-items-center position-relative">
                            <div class="avatar avatar-xs">
                                <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Author</a></span>
                        </div>
                    </div>
                </li>
                <li class="nav-item">{{ $post->created_at->format('M d, Y') }}</li>
            </ul>
        </div>
    </div>
</div>
