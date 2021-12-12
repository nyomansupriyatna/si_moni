<?php

namespace App\View\Components;

use Illuminate\View\Component;

class iconChevDown extends Component
{
    public $width;
    public $height;

    public function __construct($width = 16, $height=16)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.icons.icon-chev-down');
    }
}
