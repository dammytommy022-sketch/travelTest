@foreach ($mostReadPosts as $index => $post)
  <div class="col-sm-6">
<div class="card border-0 shadow-sm mb-4">
  <!-- Card img -->
  <div class="position-relative overflow-hidden rounded">
    <a href="{{ route('post.show', $post->id) }}" class="d-block">
      <img class="card-img-top" src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="object-fit: cover; height: 200px; width: 100%;">
    </a>
  </div>

  <div class="card-body px-2 pt-3">
    <h4 class="card-title mb-2">
      <a href="{{ route('post.show', $post->id) }}" class="text-dark fw-bold text-decoration-none">{{ $post->title }}</a>
    </h4>
    <p class="card-text text-muted mb-3">{!! Str::limit($post->content, 150) !!}</p>
    <!-- Card info -->
    <ul class="nav nav-divider align-items-center">
      <li class="nav-item">
        <div class="nav-link p-0">
          <div class="d-flex align-items-center">
            <span class="ms-3">
              <a href="#" class="text-reset text-decoration-none">
                {{ ucfirst(strtolower($post->author)) }}
                @if(strtolower($post->author) === 'travelwheel')
                <span class="badge text-primary">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
                @endif
              </a>
            </span>
          </div>
        </div>
      </li>
      <li class="nav-item text-muted">{{ $post->created_at->format('M d, Y') }}</li>
    </ul>
  </div>
</div>
  </div>
@endforeach
