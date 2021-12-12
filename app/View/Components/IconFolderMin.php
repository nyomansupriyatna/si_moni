<?php

namespace App\View\Components;

use Illuminate\View\Component;

class iconFolderMin extends Component
{
    public $width;
    public $height;

    public function __construct($width = 20, $height=20)
    {
        $this->width = $width;
        $this->height = $height;
    }


    public function render()
    {
        return view('components.icons.icon-folder-min');
    }
}
