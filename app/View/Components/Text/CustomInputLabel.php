<?php

namespace App\View\Components\Text;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomInputLabel extends Component
{
    public $text;

    public $class;

    public $option;

    /**
     * Create a new component instance.
     * string $text: Text
     * string $class: div class
     * string $option: 必須・任意
     */
    public function __construct(string $text, string $class = "", string $option = "")
    {
        $this->text = $text;
        $this->class = $class;
        $this->option = $option;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text.custom-input-label');
    }
}
