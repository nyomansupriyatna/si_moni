<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputNumber extends Component
{
    public $label;
    public $name;
    public $type;
    public $iconstart;
    public $iconend;
    public $rp;
    public $terbilang;

    public function __construct(
        $label="label",
        $name="name",
        $type="text",
        $iconstart="",
        $iconend="",
        $rp='Rp.',
        $terbilang="true"
        )
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->iconstart = $iconstart;
        $this->iconend = $iconend;
        $this->rp = $rp;
        $this->terbilang = $terbilang;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.elements.input-number');
    }
}
