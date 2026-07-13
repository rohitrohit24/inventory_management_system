<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadcrumbItem extends Component
{
    public $href;
    public $active;
    public $custom;

    public function __construct($href = '#', $active = false, $custom = "")
    {
        $this->href = $href;
        $this->custom = $custom;
        $this->active = $active;
    }

    public function render(): View|Closure|string
    {
        return view('components.breadcrumb-item');
    }
}
