<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $name;
    public $type;
    public $url;
    public $logout;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $type = 'button', $url = null, $logout = "false")
    {
        $this->name = $name;
        $this->type = $type;
        $this->url = $url;
        $this->logout = $logout;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.actionbutton');
    }
}
