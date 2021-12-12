<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputCombo extends Component
{
    public $label;
    public $name;
    public $data;
    public $field;
    public $action_btn;

    public function __construct($label="label", $name="name", $data=null, $field=null, $action_btn=null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->data = $data;
        $this->field = $field;
        $this->action_btn = $action_btn;
    }


    public function render()
    {
        return view('components.elements.input-combo', [
            'data'=> $this->data,
            ]);
    }
}
