<?php

namespace App\View\Components;

use Illuminate\View\Component;

class labelTerbilang extends Component
{
    public $label;
    public $name;
    public $type;
    public $iconstart;
    public $iconend;
    public $rp;
    public $terbilang;
    public $value;

    public function __construct(
        $label="label",
        $name="name",
        $type="text",
        $iconstart="",
        $iconend="",
        $rp='Rp.',
        $terbilang="true",
        $value=0
        )
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->iconstart = $iconstart;
        $this->iconend = $iconend;
        $this->rp = $rp;
        $this->terbilang = $terbilang;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.elements.label-terbilang');
    }
}
