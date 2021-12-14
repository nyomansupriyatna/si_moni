<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Str;

use Livewire\WithPagination;
use App\Models\MappingRegu as ModelMappingRegu;

class MappingRegu extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $sortDirection = 'asc';
    public $sortColumn = 'nama_regu';
    public $isOpen = 0;
    public $mapping_id, $tanggal, $nama_regu, $nama_teknisi1, $nama_teknisi2;
    public $action_btn ='';


    public function render()
    {
        return view('livewire.mapping-regu.index', [
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
             'tanggal' => 'tanggal',
             'nama_regu' => 'nama_regu',
             'nama_teknisi1' => 'nama_teknisi1',
             'nama_teknisi2' => 'nama_teknisi2',
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
         return ModelMappingRegu::where('nama_regu', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_teknisi1', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_teknisi2', 'like', '%'.$this->search.'%')
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
        $this->nama_regu = '';
        $this->nama_teknisi1 = '';
        $this->nama_teknisi2 = '';
    }

    public function add()
    {
        $this->action_btn = 'Add';
        $this->tanggal = '';
        $this->nama_regu = '';
        $this->nama_teknisi1 = '';
        $this->nama_teknisi2 = '';
        $this->showModal();
    }

    public function store()
    {
        $this->validate(
            [
                'tanggal' => 'required',
                'nama_regu' => 'required | unique:mapping_regus',
                'nama_teknisi1' => 'required',
                'nama_teknisi2' => 'required',
            ]
        );

        ModelMappingRegu::Create([
            'tanggal' => $this->tanggal,
            'nama_regu' => $this->nama_regu,
            'nama_teknisi1' => $this->nama_teknisi1,
            'nama_teknisi2' => $this->nama_teknisi2,
        ]);

        $this->hideModal();

    }

    public function edit($id)
    {
        $this->action_btn = 'Edit';

        $item = ModelMappingRegu::findOrFail($id);

        $this->mapping_id = $item->id;
        $this->tanggal = $item->tanggal;
        $this->nama_regu = $item->nama_regu;
        $this->nama_teknisi1 = $item->nama_teknisi1;
        $this->nama_teknisi2 = $item->nama_teknisi2;
        $this->showModal();
    }

    public function update($id)
    {
        $this->validate(
            [
                'tanggal' => 'required',
                'nama_regu' => 'required | unique:mapping_regus,nama_regu,'.$id,
                'nama_teknisi1' => 'required',
                'nama_teknisi2' => 'required',
            ]
        );

        $item = ModelMappingRegu::findOrFail($id);

        $item->tanggal = $this->tanggal;
        $item->nama_regu = $this->nama_regu;
        $item->nama_teknisi1 = $this->nama_teknisi1;
        $item->nama_teknisi2 = $this->nama_teknisi2;
        $item->save();

        $this->hideModal();

    }

    public function showDelete($id)
    {
        $this->action_btn = 'Delete';
        $item = ModelMappingRegu::findOrFail($id);

        $this->mapping_id = $item->id;
        $this->tanggal = $item->tanggal;
        $this->nama_regu = $item->nama_regu;
        $this->nama_teknisi1 = $item->nama_teknisi1;
        $this->nama_teknisi2 = $item->nama_teknisi2;

        $this->showModal();
    }

    public function confirmDelete($id)
    {
        ModelMappingRegu::find($id)->delete();
        $this->hideModal();

    }
}

