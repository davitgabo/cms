<section class="banner other-content">
    @if($image && file_exists(public_path('storage/' . $image)))
        <img src="{{ asset('storage/' . $image) }}" alt="banner">
    @endif
    <p>{{ $title }}</p>
</section>
