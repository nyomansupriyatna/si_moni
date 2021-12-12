<?php

namespace App\View\Components;

use Illuminate\View\Component;

class btnView extends Component
{
    public $title;
    public $px;
    public $py;
    public $tooltiptext;

    public function __construct($title="View", $px="px-2", $py="py-1", $tooltiptext="View")
    {
        $this->title = $title;
        $this->px = $px;
        $this->py = $py;
        $this->tooltiptext = $tooltiptext;
    }


    public function render()
    {
        return view('components.buttons.btn-view');
    }
}
