<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class product_cards extends Component
{
    /**
     * Create a new component instance.
     */
    public $iconColor;
    public $iconBg;
    public $icon;
    public $title;
    public $subtitle;
    public $value;
    public $stockvalue;
    public $card_button;
    public function __construct(
        string $iconColor = '',
        string $iconBg = '',
        string $icon = '',
        string $title = '',
        string $subtitle = '',
        string $value = '',
        string $stockvalue = '',
        string $card_button = '',
    ) {
        $this->iconColor = $iconColor;
        $this->iconBg = $iconBg;
        $this->icon = $icon;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->value = $value;
        $this->stockvalue = $stockvalue;
        $this->card_button = $card_button;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product_cards');
    }
}
