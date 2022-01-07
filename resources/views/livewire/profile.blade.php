<div class="mt-5 h-screen">
    <div class="relative  flex h-full w-full justify-center px-3">

        <div class="border h-56 shadow-sm rounded bg-white p-5 mb-3">
            <h1 class="text-bold text-xl underline py-3">Profile User</h1>
            <table>
                <tr>
                    <td>User Name</td><td class="px-3">:</td><td>{{Auth::user()->username}}</td>
                </tr>
                <tr>
                    <td>Display Name</td><td class="px-3">:</td><td>{{Auth::user()->nama}}</td>
                </tr>
                <tr>
                    <td>Hak Akses</td><td class="px-3">:</td><td>{{Auth::user()->hak_akses}}</td>
                </tr>
            </table>

            <x-btn-save wire:click="open_window" px="px-5" class="mt-5" title="Change Password" />
        </div>

        @if($open_chg_passw)
            <div class="absolute flex justify-center inset-0 bg-gray-50">
                {{-- {{bcrypt($new_password)}} --}}
                <div class="w-96 h-80 border border-gray-300 bg-white p-5 mx-3 rounded">
                    <h1 class="text-bold text-xl underline text-center mb-3">Change Password</h1>
                    <x-input-text class="mt-3" type="password" label="Current Password" name="current_password"/>
                    <x-input-text class="mt-3" type="password" label="New Password" name="new_password"/>
                    <x-input-text class="mt-3" type="password" label="Confirm Password" name="confirm_password"/>

                    <div class="flex gap-2 justify-center py-3">
                        <div wire:click="close_window" class="border bg-black text-white cursor-pointer px-3 py-1 rounded-md"><< Back</div>
                        <div wire:click="changePassword" class="border bg-blue-500 text-white cursor-pointer px-3 py-1 rounded-md">Save</div>
                    </div>

                </div>
            </div>
        @endif

    </div>


</div>
