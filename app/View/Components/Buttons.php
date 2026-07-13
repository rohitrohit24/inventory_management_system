<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Buttons extends Component
{
    /**
     * Create a new component instance.
     */
    public $variant;
    public $size;
    public $icon;
    public $type;
    public $modal;
    public $modalid;
    public $custom;
    public function __construct(string $variant = '', string $size = '', string $icon = '', string $modal = '', string $modalid = '', string $type = '', string $custom = '')
    {
        $this->variant = $variant;
        $this->size = $size;
        $this->modal = $modal;
        $this->modalid = $modalid;
        $this->icon = $icon;
        $this->type = $type;
        $this->custom = $custom;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons');
    }
}
