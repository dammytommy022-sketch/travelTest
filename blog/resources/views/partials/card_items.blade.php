@foreach($cards as $card)
    <div class="card border rounded-3 up-hover p-4 mb-4">
        <!-- Your card content here -->
        <div class="row g-3">
            <div class="col-lg-5">
                <!-- Categories -->
                <a href="#" class="badge text-bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{ $card->category }}</a>
                <!-- Title -->
                <h2 class="card-title">
                    <a href="" class="btn-link text-reset stretched-link">{{ $card->title }}</a>
                </h2>
                <!-- Author info -->
                <div class="d-flex align-items-center position-relative mt-3">
                    <div class="avatar me-2">
                        <img class="avatar-img rounded-circle" src="assets/images/avatar/07.jpg" alt="avatar">
                    </div>
                    <div>
                        <h5 class="mb-1"><a href="#" class="stretched-link text-reset btn-link">{{ $card->author }}</a></h5>
                        <ul class="nav align-items-center small">
                            <li class="nav-item me-3">{{ $card->created_at->format('M d, Y') }}</li>
                            <li class="nav-item"><i class="far fa-clock me-1"></i>5 min read</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Detail -->
            <div class="col-md-6 col-lg-4">
                <p>{{ Str::limit($card->content, 300) }}</p>
            </div>
            <!-- Image -->
            <div class="col-md-6 col-lg-3">
                <img class="rounded-3" src="{{ asset($card->picture) }}" alt="Card image">
            </div>
        </div>
    </div>
@endforeach



