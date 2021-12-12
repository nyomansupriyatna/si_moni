<?php

namespace App\View\Components;

use Illuminate\View\Component;

class iconBox extends Component
{
    public $width;
    public $height;

    public function __construct(
        $width=16,
        $height=16
        )
    {
        $this->width = $width;
        $this->height = $height;
    }


    public function render()
    {
        return view('components.icons.icon-box');
    }
}
