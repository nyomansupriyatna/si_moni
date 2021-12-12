<?php

namespace App\View\Components;

use Illuminate\View\Component;

class btn extends Component
{
    public $title;
    public $px;
    public $py;
    public $color;
    public $icon;
    public $tipe;

    public function __construct(
        $title="...",
        $px="px-2",
        $py="py-1",
        $color="blue",
        $icon="",
        $tipe="button"
        )
    {
        $this->title = $title;
        $this->px = $px;
        $this->py = $py;
        $this->color = $color;
        $this->icon = $icon;
        $this->tipe = $tipe;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.btn');
    }
}
