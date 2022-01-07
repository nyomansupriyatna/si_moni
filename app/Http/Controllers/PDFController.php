<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\ProgresWorkOrder as ModelProgresWorkOrder;

class PDFController extends Controller
{
    public $param;
    public $sortDirection = 'desc';
    public $sortColumn = 'created_at';

    public function laporanProgresPDF()
    {
        $par = last(explode('/', url()->previous()));
        $this->param = $par;

        $data = $this->resultData();

        $pdf = PDF::loadView('livewire.laporan-progres-pdf', [
            'param'=>$par,
            'data'=>$data,
        ])->setPaper('a4', 'landscape');;

        return $pdf->stream('Laporan Progres Report.pdf');
    }

    private function resultData()
    {
        if($this->param=='semua'){
            return ModelProgresWorkOrder::whereHas('work_orders')
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->get();
        }elseif($this->param=='ok'){ //jika ok
            return ModelProgresWorkOrder::whereHas('work_orders')
            ->where('status','ok')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();
        }else{ //jika kendala
            return ModelProgresWorkOrder::whereHas('work_orders')
            ->where('status','kendala')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();
        }


    }
}
