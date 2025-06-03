<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Youtube extends Component
{
    public string $link;
    public bool $autoplay;
    public bool $mute;
    public ?string $videoId;
    /**
     * Create a new component instance.
     */
    public function __construct($video)
    {
        $this->link = $video->youtube_url;
        $this->autoplay = $video->autoplay;
        $this->mute = $video->sound_control;
        preg_match('/[?&]v=([^?&]+)/', $this->link, $matches);
        $this->videoId = $matches[1] ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.youtube');
    }
}
