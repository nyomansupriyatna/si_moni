<?php

namespace App\View\Components;

use Illuminate\View\Component;

class btnDelete extends Component
{
    public $title;
    public $px;
    public $py;
    public $tooltiptext;

    public function __construct($title="Delete", $px="px-2", $py="py-1", $tooltiptext="Delete")
    {
        $this->title = $title;
        $this->px = $px;
        $this->py = $py;
        $this->tooltiptext = $tooltiptext;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.btn-delete');
    }
}
