<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alert_popup extends Component
{
    /**
     * Create a new component instance.
     */
    public $popupid;
    public $title;
    public $iconColor;
    public $iconBg;
    public $icon;
    public $popup_button;
    public function __construct(
        string $popupid = '',
        string $title = '',
        string $iconColor = '',
        string $iconBg = '',
        string $icon = '',
        string $popup_button = '',
    ) {
        $this->popupid = $popupid;
        $this->title = $title;
        $this->iconColor = $iconColor;
        $this->iconBg = $iconBg;
        $this->icon = $icon;
        $this->popup_button = $popup_button;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert_popup');
    }
}
