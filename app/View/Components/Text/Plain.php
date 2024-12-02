<?php

namespace App\View\Components\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Plain extends Component
{
    public $text;

    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($text, $size = "sm")
    {
        $this->text = $text;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text.plain');
    }
}
