<?php

namespace App\View\Components\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomText extends Component
{
    public $text;

    public $class;

    public $textClass;

    /**
     * Create a new component instance.
     * string $text: Text
     * string $class: div class
     * string $textClass: text class
     */
    public function __construct(string $text, string $class = "", string $textClass = "")
    {
        $this->text = $text;
        $this->class = $class;
        $this->textClass = $textClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text.custom-text');
    }
}
