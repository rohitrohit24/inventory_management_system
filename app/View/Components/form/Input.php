<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $type;
    public $name;
    public $id;
    public $value;
    public $readonly;
    public $icon;
    public $placeholder;
    public $required;
    public $custom;
    public function __construct(string $label = '', string $readonly = '', string $type = 'text', string $name = '', string $id = '', string $value = '', string $icon = '', string $placeholder = '', string $required = '', string $custom = '')
    {
        $this->label = $label;
        $this->type = $type;
        $this->readonly = $readonly;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->custom = $custom;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
