<?php

namespace App\View\Components\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    public $text;

    public $class;

    public $color;

    /**
     * top: t
     * bottom: b
     * left: l
     * right: r
     * none: n
     */
    public $border;

    /**
     * Create a new component instance.
     */
    public function __construct($text, $class = "", $color = "black", $border = 'n')
    {
        $this->text = $text;
        $this->class = $class;
        $this->color = $color;
        $this->border = $border;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text.main');
    }
}
