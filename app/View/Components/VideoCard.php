<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoCard extends Component
{
    public int $id;
    public string $poster;
    public bool $autoplay;
    public bool $muted;
    public string $src;
    /**
     * Create a new component instance.
     */
    public function __construct($video)
    {
        $this->id = $video->id;
        $this->poster = $video->thumbnail;
        $this->autoplay = $video->autoplay;
        $this->muted = $video->sound_control;
        $this->src = $video->video;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.video-card');
    }
}
