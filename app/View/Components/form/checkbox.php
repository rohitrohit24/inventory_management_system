<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public $label;
    public $id;
    public $name;
    public $value;
    public $checked;
    public $custom;

    public function __construct(

        $label = '',
        $custom = '',
        $id = '',
        $name = '',
        $value = '',
        $checked = ''

    ) {
        $this->label = $label;
        $this->label = $id;
        $this->name = $name;
        $this->custom = $custom;
        $this->value = $value;
        $this->checked = $checked;
    }

    public function render(): View|Closure|string
    {
        return view('components.form.checkbox');
    }
}
