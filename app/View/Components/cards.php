<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cards extends Component
{
    /**
     * Create a new component instance.
     */
    public $iconColor;
    public $iconBg;
    public $icon;
    public $title;
    public $value;
    public $trendClass;
    public $trendIcon;
    public $treandText;
    public function __construct(
        string $iconColor = '',
        string $iconBg = '',
        string $icon = '',
        string $title = '',
        string $value = '',
        string $trendClass = '',
        string $trendIcon = '',
        string $treandText = '',
    ) {
        $this->iconColor = $iconColor;
        $this->iconBg = $iconBg;
        $this->icon = $icon;
        $this->title = $title;
        $this->value = $value;
        $this->trendClass = $trendClass;
        $this->trendIcon = $trendIcon;
        $this->treandText = $treandText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards');
    }
}
