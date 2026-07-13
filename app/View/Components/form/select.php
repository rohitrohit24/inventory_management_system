<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class select extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $name;
    public $id;
    public $custom;
    public function __construct(string $label = '', string $name = '', string $custom = '', string $id = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->custom = $custom;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select');
    }
}
