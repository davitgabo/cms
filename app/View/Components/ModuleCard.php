<?php

namespace App\View\Components;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleCard extends Component
{
    public $module;
    public $records;

    /**
     * Create a new component instance.
     */
    public function __construct($module)
    {
        $this->module = $module;
        if ($module == 'news'){
            $this->records = News::where('publish', true)->orderBy('order')->get();
        }
        if ($module == 'events'){
            $this->records = News::where('publish', true)->orderBy('order')->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.module-card');
    }
}
