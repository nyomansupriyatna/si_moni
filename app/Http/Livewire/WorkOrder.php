<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Str;

use Livewire\WithPagination;
use App\Models\WorkOrder as ModelWorkOrder;

class WorkOrder extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $sortDirection = 'asc';
    public $sortColumn = 'user_psb';
    public $isOpen = 0;
    public $wo_id, $tanggal, $user_psb, $nama_pelanggan, $alamat;
    public $action_btn ='';


    public function render()
    {
        return view('livewire.work-order.index', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig(),
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

    private function headerConfig()
    {
         return [
             'id' => 'No',
             'user_psb' => 'User PSB',
             'nama_pelanggan' => 'Nama Pelanggan',
             'alamat' => 'Alamat',
             'pic' => 'PIC',
             'datek' => 'Datek',
             'keterangan' => 'Keterangan',
             'mapping_regu_id' => 'Nama Regu',
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
        // return DB::table('work_order')

        return ModelWorkOrder::where('user_psb', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_pelanggan', 'like', '%'.$this->search.'%')
                    ->orWhere('alamat', 'like', '%'.$this->search.'%')
                    ->orWhere('pic', 'like', '%'.$this->search.'%')
                    ->orWhere('datek', 'like', '%'.$this->search.'%')
                    ->orWhere('keterangan', 'like', '%'.$this->search.'%')
                    ->orWhere('mapping_regu_id', 'like', '%'.$this->search.'%')
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
        $this->alamat = '';
        $this->pic = '';
        $this->datek = '';
        $this->keterangan = '';
        $this->showModal();
    }

    public function store()
    {
        $this->validate(
            [
                'tanggal' => 'required',
                'user_psb' => 'required | unique:work_orders',
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
            ]
        );

        ModelWorkOrder::Create([
            'tanggal' => $this->tanggal,
            'user_psb' => $this->user_psb,
            'nama_pelanggan' => $this->nama_pelanggan,
            'alamat' => $this->alamat,
            'pic' => $this->pic,
            'datek' => $this->datek,
            'keterangan' => $this->keterangan,
        ]);

        $this->hideModal();

    }

    public function edit($id)
    {
        $this->action_btn = 'Edit';

        $item = ModelWorkOrder::findOrFail($id);

        $this->wo_id = $item->id;
        $this->tanggal = $item->tanggal;
        $this->user_psb = $item->user_psb;
        $this->nama_pelanggan = $item->nama_pelanggan;
        $this->alamat = $item->alamat;
        $this->pic = $item->pic;
        $this->datek = $item->datek;
        $this->keterangan = $item->keterangan;
        $this->showModal();
    }

    public function update($id)
    {
        $this->validate(
            [
                'tanggal' => 'required',
                'user_psb' => 'required | unique:mapping_regus,user_psb,'.$id,
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
            ]
        );

        $item = ModelWorkOrder::findOrFail($id);

        $item->tanggal = $this->tanggal;
        $item->user_psb = $this->user_psb;
        $item->nama_pelanggan = $this->nama_pelanggan;
        $item->alamat = $this->alamat;
        $item->pic = $this->pic;
        $item->datek = $this->datek;
        $item->keterangan = $this->keterangan;
        $item->save();

        $this->hideModal();

    }

    public function showDelete($id)
    {
        $this->action_btn = 'Delete';
        $item = ModelWorkOrder::findOrFail($id);

        $this->wo_id = $item->id;
        $this->tanggal = $item->tanggal;
        $this->user_psb = $item->user_psb;
        $this->nama_pelanggan = $item->nama_pelanggan;
        $this->alamat = $item->alamat;
        $this->pic = $item->pic;
        $this->datek = $item->datek;
        $this->keterangan = $item->keterangan;

        $this->showModal();
    }

    public function confirmDelete($id)
    {
        ModelWorkOrder::find($id)->delete();
        $this->hideModal();

    }
}

