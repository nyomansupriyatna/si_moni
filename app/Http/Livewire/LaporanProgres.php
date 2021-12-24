<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;

use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkOrder as ModelWorkOrder;
use App\Models\MappingRegu as ModelMappingRegu;
use App\Models\ProgresWorkOrder as ModelProgresWorkOrder;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

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



    public function render()
    {
        return view('livewire.laporan-progres.index', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig(),
            'mapping_regu' => $this->mappingRegu(),
        ]);
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
        return DB::table('progres_work_orders')
            ->join('work_orders', 'work_orders.id','progres_work_orders.wo_id')
            ->join('mapping_regus', 'work_orders.mapping_regu_id','mapping_regus.id')
            ->select('progres_work_orders.*', 'progres_work_orders.tanggal as tgl_update', 'work_orders.id as order_id', 'work_orders.user_psb', 'work_orders.datek','work_orders.created_at as tgl_wo', 'mapping_regus.nama_teknisi1', 'mapping_regus.nama_teknisi2','progres_work_orders.status')
            ->where('progres_work_orders.tanggal', 'like', '%'.$this->search.'%')
            ->orWhere('user_psb', 'like', '%'.$this->search.'%')
            ->orWhere('status', 'like', '%'.$this->search.'%')
            ->orWhere('datek', 'like', '%'.$this->search.'%')
            ->orWhere('jumlah_ap', 'like', '%'.$this->search.'%')
            ->orWhere('panjang_dc', 'like', '%'.$this->search.'%')
            ->orWhere('material_lain', 'like', '%'.$this->search.'%')
            ->orWhere('keterangan_tambahan', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);



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

