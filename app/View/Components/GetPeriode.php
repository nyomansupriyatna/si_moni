<?php

namespace App\View\Components;

use App\Models\SaldoAkhir;
use Illuminate\View\Component;
use Carbon\Carbon;

class GetPeriode extends Component
{

    public function mount()
    {
        $this->lastPeriode();
    }

    public function render()
    {
        return view('components.get-periode', [
            'tanggal' => $this->lastPeriode()
        ]);
    }

    public function lastPeriode()
    {
        $last = SaldoAkhir::latest()->first();

        if($last == null){
            return $tanggal = "0000-01-01";
        }else{
            $tanggal = Carbon::parse($last->tanggal)->locale('id');
            return $tanggal->settings(['formatFunction' => 'translatedFormat']);
        }
    }
}
