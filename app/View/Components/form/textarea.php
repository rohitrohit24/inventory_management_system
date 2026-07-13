<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $name;
    public $rows;
    public $custom;
    public $id;
    public function __construct(string $label = '', string $name = '', string $rows = '', string $custom = '', string $id = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->rows = $rows;
        $this->custom = $custom;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
