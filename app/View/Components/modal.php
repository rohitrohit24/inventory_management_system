<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $size;
    public $action;
    public $method;
    public $formMethod;
    public $formid;
    public $enctype;
    public function __construct(
        $id = '',
        $title = '',
        $size = 'modal-lg',
        $action = '',
        $method = 'POST',
        $formMethod = 'POST',
        $enctype = '',
        $formid = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->action = $action;
        $this->formid = $formid;
        $this->method = strtoupper($method);
        $this->formMethod = $formMethod;
        $this->enctype = $enctype;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
