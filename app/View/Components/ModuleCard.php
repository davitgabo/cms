<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleCard extends Component
{
    public $module;

    /**
     * Create a new component instance.
     */
    public function __construct($module)
    {
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.module-card');
    }
}
