@if ($videoId)
    <div class="aspect-w-16 aspect-h-9">
        <iframe
            width="100%"
            height="100%"
            src="https://www.youtube.com/embed/{{ $videoId }}?autoplay={{ $autoplay ? '1' : '0' }}&mute={{ $mute ? '1' : '0' }}&rel=0&modestbranding=1&controls=1"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>
    </div>
@endif
