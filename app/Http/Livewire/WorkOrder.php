<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Str;

use Livewire\WithPagination;
use App\Models\WorkOrder as ModelWorkOrder;
use App\Models\MappingRegu as ModelMappingRegu;
use DB;

class WorkOrder extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $sortDirection = 'asc';
    public $sortColumn = 'user_psb';
    public $isOpen = 0;
    public $wo_id, $tanggal, $user_psb, $nama_pelanggan, $nama_layanan, $alamat, $mapping_regu_id;
    public $action_btn ='';


    public function render()
    {
        return view('livewire.work-order.index', [
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
             'id' => 'No',
             'user_psb' => 'User PSB',
             'nama_pelanggan' => 'Nama Pelanggan',
             'nama_layanan' => 'Layanan',
             'alamat' => 'Alamat',
             'pic' => 'PIC',
             'datek' => 'Datek',
             'keterangan' => 'Keterangan',
             'mapping_regu_id' => 'Nama Regu',
             'update' => 'Update',
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
            ->select('work_orders.*', 'work_orders.id as order_id', 'mapping_regus.nama_regu', 'progres_work_orders.status')
            // ->where('status',null) //menampilkan hanya yang belum di update oleh teknisi
            ->where(
                function($query) {
                    return $query
                    ->where('user_psb', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_pelanggan', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_layanan', 'like', '%'.$this->search.'%')
                    ->orWhere('alamat', 'like', '%'.$this->search.'%')
                    ->orWhere('pic', 'like', '%'.$this->search.'%')
                    ->orWhere('datek', 'like', '%'.$this->search.'%')
                    ->orWhere('keterangan', 'like', '%'.$this->search.'%')
                    ->orWhere('mapping_regus.nama_regu', 'like', '%'.$this->search.'%');
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
        $this->user_psb = '';
        $this->nama_pelanggan = '';
        $this->nama_layanan = '';
        $this->alamat = '';
        $this->pic = '';
        $this->datek = '';
        $this->keterangan = '';
    }

    public function add()
    {
        $this->action_btn = 'Add';
        $this->tanggal = '';
        $this->user_psb = '';
        $this->nama_pelanggan = '';
        $this->nama_layanan = '';
        $this->alamat = '';
        $this->pic = '';
        $this->datek = '';
        $this->keterangan = '';
        $this->mapping_regu_id = null;
        $this->showModal();
    }

    public function store()
    {
        $this->validate(
            [
                'user_psb' => 'required | unique:work_orders',
                'nama_pelanggan' => 'required',
                'nama_layanan' => 'required',
                'alamat' => 'required',
            ]
        );

        ModelWorkOrder::Create([
            'user_psb' => $this->user_psb,
            'nama_pelanggan' => $this->nama_pelanggan,
            'nama_layanan' => $this->nama_layanan,
            'alamat' => $this->alamat,
            'pic' => $this->pic,
            'datek' => $this->datek,
            'keterangan' => $this->keterangan,
            'mapping_regu_id' => $this->mapping_regu_id,
        ]);

        $this->hideModal();

    }

    public function edit($id)
    {
        $this->action_btn = 'Edit';

        $item = ModelWorkOrder::findOrFail($id);

        $this->wo_id = $item->id;
        $this->user_psb = $item->user_psb;
        $this->nama_pelanggan = $item->nama_pelanggan;
        $this->nama_layanan = $item->nama_layanan;
        $this->alamat = $item->alamat;
        $this->pic = $item->pic;
        $this->datek = $item->datek;
        $this->keterangan = $item->keterangan;
        $this->mapping_regu_id = $item->mapping_regu_id;
        $this->showModal();
    }

    public function update($id)
    {
        $this->validate(
            [
                'user_psb' => 'required | unique:work_orders,user_psb,'.$id,
                'nama_pelanggan' => 'required',
                'nama_layanan' => 'required',
                'alamat' => 'required',
            ]
        );

        $item = ModelWorkOrder::findOrFail($id);

        $item->user_psb = $this->user_psb;
        $item->nama_pelanggan = $this->nama_pelanggan;
        $item->nama_layanan = $this->nama_layanan;
        $item->alamat = $this->alamat;
        $item->pic = $this->pic;
        $item->datek = $this->datek;
        $item->keterangan = $this->keterangan;
        $item->mapping_regu_id = $this->mapping_regu_id;
        $item->save();

        $this->hideModal();

    }

    public function showDelete($id)
    {
        $this->action_btn = 'Delete';
        $item = ModelWorkOrder::findOrFail($id);

        $this->wo_id = $item->id;
        $this->user_psb = $item->user_psb;
        $this->nama_pelanggan = $item->nama_pelanggan;
        $this->nama_layanan = $item->nama_layanan;
        $this->alamat = $item->alamat;
        $this->pic = $item->pic;
        $this->datek = $item->datek;
        $this->keterangan = $item->keterangan;
        $this->mapping_regu_id = $item->mapping_regu_id;

        $this->showModal();
    }

    public function confirmDelete($id)
    {
        ModelWorkOrder::find($id)->delete();
        $this->hideModal();

    }
}

