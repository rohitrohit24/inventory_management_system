<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class file extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $id;
    public $accept;
    public $label;
    public $custom;
    public function __construct(string $name = '', string $id = '', string $accept = '', string $label = '', string $custom = '')
    {
        $this->name = $name;
        $this->custom = $custom;
        $this->id = $id;
        $this->accept = $accept;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.file');
    }
}
