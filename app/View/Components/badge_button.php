<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class badge_button extends Component
{
    /**
     * Create a new component instance.
     */
    public $custom;
    public function __construct(string $custom = '')
    {
        $this->custom = $custom;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge_button');
    }
}
