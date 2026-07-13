<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimpleModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $size;
    public $footer;
    public function __construct(
        $id = '',
        $title = '',
        $size = 'modal-lg',
        $footer = '',
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->footer = $footer;
    }

    public function render(): View|Closure|string
    {
        return view('components.simple-modal');
    }
}
