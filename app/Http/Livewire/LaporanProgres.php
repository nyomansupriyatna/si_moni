<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;

use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use App\Models\WorkOrder as ModelWorkOrder;
use App\Models\MappingRegu as ModelMappingRegu;
use App\Models\ProgresWorkOrder as ModelProgresWorkOrder;
use PDF;

class LaporanProgres extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $perPage = 5;
    public $search = '';
    public $sortDirection = 'desc';
    public $sortColumn = 'created_at';
    public $isOpen = 0;
    public $wo_id, $tanggal, $user_id, $datek;
    public $zn_modem, $jumlah_ap, $panjang_dc, $material_lain, $keterangan_tambahan, $tanggal_update, $foto_odp, $foto_rumah_pelanggan, $foto_modem, $foto_ap, $foto_kendala, $status;
    public $action_btn ='';
    public $nama_odp,
            $nama_rumah_pelanggan,
            $nama_modem,
            $nama_ap,
            $nama_kendala;
    public $param;

    public function mount()
    {
        $this->param = last(explode('/',Request::path()));
    }

    public function render()
    {
        return view('livewire.laporan-progres.index', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig(),
            'mapping_regu' => $this->mappingRegu(),
        ]);
    }

    public function createPDF()
    {
        $data = [
            'title' => 'First PDF for Coding Driver',
            'heading' => 'Hello from Coding Driver',
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged."
              ];

          $pdf = PDF::loadView('livewire.laporan-progres-pdf', $data);

          // return $pdf->download('codingdriver.pdf');
          return $pdf->stream('Laporan Progres Report.pdf');
    }


    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function mappingRegu()
    {
        return ModelMappingRegu::all();
    }

    private function headerConfig()
    {
         return [
             'tanggal' => 'Tgl Update',
             'user_psb' => 'User PSB',
             'status' => 'Status',
             'datek' => 'Datek',
             'sn_modem' => 'SN Modem',
             'jumlah_ap' => 'Jum. AP',
             'panjang_dc' => 'Panj. DC',
             'material_lain' => 'Mat. Lain',
             'keterangan_tambahan' => 'Ket. Tambahan',
             'foto' => 'Foto',
         ];
    }

    public function sort($column){
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function resultData()
    {
        if($this->param=='semua'){
            return ModelProgresWorkOrder::whereHas('work_orders')
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage);
        }elseif($this->param=='ok'){ //jika ok
            return ModelProgresWorkOrder::whereHas('work_orders')
            ->where('status','ok')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);
        }else{ //jika kendala
            return ModelProgresWorkOrder::whereHas('work_orders')
            ->where('status','kendala')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);
        }


    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function open_fotos($id)
    {
        $this->isOpen = true;
        $pwo = ModelProgresWorkOrder::find($id);

        $this->status = $pwo->status;
        $this->foto_odp = $pwo->foto_odp;
        $this->foto_rumah_pelanggan = $pwo->foto_rumah_pelanggan;
        $this->foto_modem = $pwo->foto_modem;
        $this->foto_ap = $pwo->foto_ap;
        $this->foto_kendala = $pwo->foto_kendala;

    }

    public function close_fotos()
    {
        $this->isOpen = false;
        $this->foto_odp = '';
        $this->foto_rumah_pelanggan = '';
        $this->foto_modem = '';
        $this->foto_ap = '';
        $this->foto_kendala = '';
    }

    public function hideModal()
    {
        $this->isOpen = false;
        $this->tanggal = '';
        $this->wo_id = '';
        Auth::user()->id = '';
        $this->tanggal = '';
        $this->zn_modem = '';
        $this->jumlah_ap = '';
        $this->panjang_dc = '';
    }

    public function add($id)
    {
        $work_order = ModelWorkOrder::find($id);

        $this->action_btn = 'Add';
        $this->tanggal = now()->format('Y-m-d');
        $this->wo_id = $id;
        $this->status = null;
        $this->user_psb = $work_order->user_psb;
        $this->datek = $work_order->datek;
        $this->user_id = '';
        $this->zn_modem = '';
        $this->jumlah_ap = 0;
        $this->panjang_dc = 0;
        $this->material_lain = null;
        $this->showModal();
    }

    public function store()
    {
        $this->validate(
            [
                'tanggal' => 'required',
                'status' => 'required',
            ]
        );

        $item = new ModelProgresWorkOrder();

        $item->wo_id = $this->wo_id;
        $item->user_id = Auth::user()->id;
        $item->tanggal = $this->tanggal;
        $item->zn_modem = $this->zn_modem;
        $item->jumlah_ap = $this->jumlah_ap;
        $item->panjang_dc = $this->panjang_dc;
        $item->material_lain = $this->material_lain;
        $item->keterangan_tambahan = $this->keterangan_tambahan;
        $item->status = $this->status;

        if($item->status=='ok')
        {
            $this->uploadFotoOdp($this->wo_id);
            $this->uploadFotoRumahPelanggan($this->wo_id);
            $this->uploadFotoModem($this->wo_id);
            $this->uploadFotoAp($this->wo_id);
            $item->foto_odp = $this->nama_odp;
            $item->foto_rumah_pelanggan = $this->nama_rumah_pelanggan;
            $item->foto_modem = $this->nama_modem;
            $item->foto_ap = $this->nama_ap;
        }elseif($item->status=='kendala'){
            $this->uploadFotoKendala($this->wo_id);
            $item->foto_kendala = $this->nama_kendala;
        }else{
        }

        $item->save();

        $this->hideModal();

    }



}

