<?php

namespace App\View\Components;

use Illuminate\View\Component;

class perPage extends Component
{
    public $data;
    // $data=[["5"=>"5"],["10"=>"10"],["25"=>"25"],["50"=>"50"],["100"=>"100"]

    public function __construct($data=[8,16,24,50,100])
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.elements.per-page',['data'=>$this->data]);
    }
}
