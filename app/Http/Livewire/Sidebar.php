<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $menuSetup=true;

    public function render()
    {
        return view('livewire.inc.sidebar');
    }

    public function menuSetup()
    {
        if($this->menuSetup==true){
            $this->menuSetup = false;
        }else{
            $this->menuSetup = true;
        }
    }
}
