<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    public $label;
    public $name;
    public $id;
    public $custom;
    public $value;
    public $checked;

    public function __construct(

        $label = '',
        $id = '',
        $name = '',
        $custom = '',
        $value = '',
        $checked = ''

    ) {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->custom = $custom;
        $this->value = $value;
        $this->checked = $checked;
    }

    public function render(): View|Closure|string
    {
        return view('components.form.radio');
    }
}
