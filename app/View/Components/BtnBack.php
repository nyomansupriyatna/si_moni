<?php

namespace App\View\Components;

use Illuminate\View\Component;

class btnBack extends Component
{
    public $title;
    public $px;
    public $py;

    public function __construct($title="Back", $px="px-2", $py="py-1")
    {
        $this->title = $title;
        $this->px = $px;
        $this->py = $py;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.btn-back');
    }
}
