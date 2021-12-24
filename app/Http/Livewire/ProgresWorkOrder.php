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

class ProgresWorkOrder extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $perPage = 5;
    public $search = '';
    public $sortDirection = 'desc';
    public $sortColumn = 'created_at';
    public $isOpen = 0;
    public $wo_id, $tanggal, $user_id, $datek;
    public $sn_modem, $jumlah_ap, $panjang_dc, $material_lain, $keterangan_tambahan, $tanggal_update, $foto_odp, $foto_rumah_pelanggan, $foto_modem, $foto_ap, $foto_kendala, $status;
    public $action_btn ='';
    public $nama_odp,
            $nama_rumah_pelanggan,
            $nama_modem,
            $nama_ap,
            $nama_kendala;



    public function render()
    {
        return view('livewire.progres-work-order.index', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig(),
            'mapping_regu' => $this->mappingRegu(),
        ]);
    }

    public $all_status = [
        'ok',
        'kendala',
    ];

    public function uploadFotoOdp($id)
    {
        $this->validate([
            'foto_odp' => 'image|max:1024',
        ]);

        if($this->foto_odp){
            $this->nama_odp = 'foto_odp_'.$id.'.jpg';
            $this->foto_odp->storeAs('images', $this->nama_odp, 'public');
        }

    }

    public function uploadFotoRumahPelanggan($id)
    {
        $this->validate([
            'foto_rumah_pelanggan' => 'image|max:1024',
        ]);

        if($this->foto_rumah_pelanggan){
            $this->nama_rumah_pelanggan = 'foto_rumah_pelanggan_'.$id.'.jpg';
            $this->foto_rumah_pelanggan->storeAs('images', $this->nama_rumah_pelanggan, 'public');
        }

    }

    public function uploadFotoModem($id)
    {
        $this->validate([
            'foto_modem' => 'image|max:1024',
        ]);

        if($this->foto_modem){
            $this->nama_modem = 'foto_modem_'.$id.'.jpg';
            $this->foto_modem->storeAs('images', $this->nama_modem, 'public');
        }

    }

    public function uploadFotoAp($id)
    {
        $this->validate([
            'foto_ap' => 'image|max:1024',
        ]);

        if($this->foto_ap){
            $this->nama_ap = 'foto_ap_'.$id.'.jpg';
            $this->foto_ap->storeAs('images', $this->nama_ap, 'public');
        }

    }

    public function uploadFotoKendala($id)
    {
        $this->validate([
            'foto_kendala' => 'image|max:1024',
        ]);

        if($this->foto_kendala){
            $this->nama_kendala = 'foto_kendala_'.$id.'.jpg';
            $this->foto_kendala->storeAs('images', $this->nama_kendala, 'public');
        }
        // dd($this->nama_kendala);

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
             'tanggal' => 'Tanggal',
             'id' => 'ID Order',
             'nama_layanan' => 'Nama Layanan',
             'nama_pelanggan' => 'Nama Pelanggan',
             'datek' => 'Datek',
             'regu' => 'Regu',
            //  'status' => 'Status',
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
        return DB::table('work_orders')
            ->join('mapping_regus', 'work_orders.mapping_regu_id','mapping_regus.id')
            ->leftJoin('progres_work_orders', 'progres_work_orders.wo_id','work_orders.id')
            ->select('work_orders.*', 'work_orders.id as order_id', 'work_orders.created_at as tgl_wo', 'mapping_regus.nama_teknisi1', 'mapping_regus.nama_teknisi2','progres_work_orders.status')
            ->where('status',null) //menampilkan hanya yang belum di update oleh teknisi
            ->where(
                function($query) {
                    return $query
                    ->where('work_orders.created_at', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_layanan', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_pelanggan', 'like', '%'.$this->search.'%')
                    ->orWhere('datek', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_teknisi1', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_teknisi2', 'like', '%'.$this->search.'%');
                })
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

    public function hideModal()
    {
        $this->isOpen = false;
        $this->tanggal = '';
        $this->wo_id = '';
        Auth::user()->id = '';
        $this->tanggal = '';
        $this->sn_modem = '';
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
        $this->sn_modem = '';
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
        $item->sn_modem = $this->sn_modem;
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

