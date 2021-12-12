<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MsgBox extends Component
{
    public $title1;
    public $title2;
    public $ya;
    public $tidak;
    public $close_me;

    public function __construct(
        $title1="title1",
        $title2="title2",
        $ya="",
        $tidak="",
        $close_me=true
        )
    {
        $this->title1 = $title1;
        $this->title2 = $title2;
        $this->ya = $ya;
        $this->tidak = $tidak;
        $this->close_me = $close_me;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.elements.msg-box');
    }

    public function close()
    {
        $this->close_me = false;
    }
}
