<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $variant;
    public $custom;
    public $title;
    public $modal;
    public $modalid;

    public function __construct(string $type = '', string $variant = '', string $custom = '', string $title = '', string $modal = '', string $modalid = '',)
    {
        $this->type = $type;
        $this->variant = $variant;
        $this->custom = $custom;
        $this->title = $title;
        $this->modal = $modal;
        $this->modalid = $modalid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-buttons');
    }
}
