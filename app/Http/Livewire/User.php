<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Str;

use Livewire\WithPagination;
use App\Models\User as ModelUser;

class User extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $sortDirection = 'asc';
    public $sortColumn = 'nama';
    public $isOpen = 0;
    public $user_id, $nik, $nama, $alamat, $jenis_kelamin, $no_tlp, $username, $hak_akses ;
    public $action_btn ='';

    public $accessData = ['Admin','Operator','Teknisi'];

    public function render()
    {
        return view('livewire.user.index', [
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
             'nik' => 'NIK',
             'nama' => 'Nama',
             'alamat' => 'Alamat',
             'jenis_kelamain' => 'Jenis Kelamin',
             'no_tlp' => 'No Tlp.',
             'username' => 'User Name',
             'hak_akses' => 'Hak Akses',
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
         return ModelUser::where('nik', 'like', '%'.$this->search.'%')
                    ->orWhere('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('alamat', 'like', '%'.$this->search.'%')
                    ->orWhere('jenis_kelamin', 'like', '%'.$this->search.'%')
                    ->orWhere('no_tlp', 'like', '%'.$this->search.'%')
                    ->orWhere('username', 'like', '%'.$this->search.'%')
                    ->orWhere('hak_akses', 'like', '%'.$this->search.'%')
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
        $this->nik = '';
        $this->nama = '';
        $this->alamat = '';
        $this->jenis_kelamin = '';
        $this->no_tlp = '';
        $this->username = '';
        $this->hak_akses = '';
    }

    public function add()
    {
        $this->action_btn = 'Add';
        $this->nik = '';
        $this->nama = '';
        $this->alamat = '';
        $this->jenis_kelamin = '';
        $this->no_tlp = '';
        $this->username = '';
        $this->hak_akses = '';
        $this->showModal();
    }

    public function store()
    {
        $this->validate(
            [
                'nik' => 'required | unique:users',
                'nama' => 'required',
                'username' => 'required | unique:users',
                'jenis_kelamin' => 'required',
                'hak_akses' => 'required',
            ]
        );

        ModelUser::Create([
            'nik' => $this->nik,
            'username' => $this->username,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_tlp' => $this->no_tlp,
            'hak_akses' => $this->hak_akses,
        ]);

        $this->hideModal();

    }

    public function edit($id)
    {
        $this->action_btn = 'Edit';

        $user = ModelUser::findOrFail($id);

        $this->user_id = $user->id;
        $this->nik = $user->nik;
        $this->nama = $user->nama;
        $this->alamat = $user->alamat;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->no_tlp = $user->no_tlp;
        $this->username = $user->username;
        $this->hak_akses = $user->hak_akses;
        $this->showModal();
    }

    public function update($id)
    {
        $this->validate(
            [
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'hak_akses' => 'required',
            ]
        );

        $user = ModelUser::findOrFail($id);

        $user->nik = $this->nik;
        $user->username = $this->username;
        $user->nama = $this->nama;
        $user->alamat = $this->alamat;
        $user->jenis_kelamin = $this->jenis_kelamin;
        $user->no_tlp = $this->no_tlp;
        $user->hak_akses = $this->hak_akses;
        $user->save();

        $this->hideModal();

    }

    public function showDelete($id)
    {
        $this->action_btn = 'Delete';
        $user = ModelUser::findOrFail($id);

        $this->user_id = $user->id;
        $this->nik = $user->nik;
        $this->nama = $user->nama;
        $this->alamat = $user->alamat;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->no_tlp = $user->no_tlp;
        $this->username = $user->username;
        $this->hak_akses = $user->hak_akses;

        $this->showModal();
    }

    public function confirmDelete($id)
    {
        ModelUser::find($id)->delete();
        $this->hideModal();

    }
}

