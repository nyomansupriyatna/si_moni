<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $open_chg_passw=0;
    public  $old_password, $current_password, $new_password, $confirm_password;

    public function mount()
    {
        $this->old_password = Auth::user()->password;
    }
    public function render()
    {
        return view('livewire.profile');
    }

    public function changePassword()
    {

        $this->validate(
            [
                'current_password' => 'required | password',
                'new_password' => 'required | min:3',
                'confirm_password' => 'required | same:new_password',
            ]
        );

        $item = User::find(Auth::user()->id);
        $item->password = bcrypt($this->new_password);
        $item->save();
        Auth::login($item);
        return redirect('/profile')->with('success','Password telah diganti..!');
    }

    public function open_window()
    {
        $this->open_chg_passw=1;
    }

    public function close_window()
    {
        $this->open_chg_passw=0;
    }
}
