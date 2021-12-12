<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputText extends Component
{
    public $label;
    public $name;
    public $type;
    public $iconstart;
    public $iconend;
    public $status;
    public $readonly;

    public function __construct(
        $label="label",
        $name="name",
        $type="text",
        $iconstart="",
        $iconend="",
        $status="opn",
        $readonly = ""

        )
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->iconstart = $iconstart;
        $this->iconend = $iconend;
        $this->status = $status;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.elements.input-text');
    }
}
