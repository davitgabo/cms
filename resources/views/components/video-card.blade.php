<video
    id="video-{{ $id }}"
    class="video-js"
    controls
    preload="auto"
    width="500px"
    height="324px"
    poster="{{ asset('storage/' . $poster)  }}"
    data-setup='@json([
        'autoplay' => $autoplay,
        'muted' => $muted,
    ])'
>
    <source src="{{ asset('storage/' . $src)  }}" type="video/mp4" />
</video>
