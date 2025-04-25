<section class="banner other-content">
    @if($image))
        <img src="{{ asset('storage/' . $image) }}" alt="banner">
    @endif
    <p>{{ $title }}</p>
</section>
