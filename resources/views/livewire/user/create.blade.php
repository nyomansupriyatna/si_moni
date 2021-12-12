<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed inset-0 z-10 overflow-y-auto">
  <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
        <div class="mb-2 sm:flex sm:items-start">
          <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-indigo-200 rounded-full sm:mx-0 sm:h-10 sm:w-10">
            <!-- Heroicon name: exclamation -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="pt-2 text-lg font-bold leading-6 text-indigo-500" id="modal-headline">
             {{$action_btn}} Record
            </h3>
            <div class="mt-2">
            </div>
          </div>
        </div>
        <hr/>
        <form action="">

        {{-- main content --}}

        <div>
            <div class="my-2">

                <input class="mb-2" wire:model="user_id" class="w-full h-8 px-3 border border-gray-500 rounded" type="hidden" >
                @if($action_btn=='Edit')
                    <x-input-text class="mb-2" name="nik" label="NIK" readonly="readonly"/>
                    <x-input-text class="mb-2" name="username" label="User Name" readonly="readonly" />
                @else
                    <x-input-text class="mb-2" name="nik" label="NIK" />
                    <x-input-text class="mb-2" name="username" label="User Name" />
                @endif
                <x-input-text class="mb-2" name="nama" label="Nama" />
                <x-input-text class="mb-2" name="alamat" label="Alamat" />

                <select wire:model="jenis_kelamin" name="jenis_kelamin" class="block w-full px-3 border rounded text-md h-9">
                    @if($action_btn == 'Edit')
                        <option {{$jenis_kelamin == 'L' ? 'selected' : ''}} value="L">Laki-laki</option>
                        <option {{$jenis_kelamin == 'P' ? 'selected' : ''}} value="P">Perempuan</option>
                    @else
                        <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    @endif
                </select>

                <x-input-text class="mb-2" name="no_tlp" label="No Telepon" />
                <x-input-combo name="hak_akses" label="Hak Akses" :data="$accessData" :field="$hak_akses" />

            </div>
            <div class="text-xs text-center text-red-400 ">
                default password adalah 123, password bisa diubah di user profile
            </div>
        </div>
        {!! $action_btn =='Delete' ?  '<h3 class="text-center text-red-500">Delete this record ?</h3>' : '' !!}
      </div>
        <div class="px-4 py-3 bg-gray-100 sm:px-6 sm:flex sm:flex-row-reverse">
            @if($action_btn=='Delete')
                <x-btn-delete px="px-4" wire:click.prevent="confirmDelete({{$user_id}})" />
            @else
                @if($action_btn=='Add')
                    <x-btn-save wire:click.prevent="store()"  px="px-4 mb-2"/>
                @else
                    <x-btn-save wire:click.prevent="update({{$user_id}})" title="Update" class="px-4 mb-2"/>
                @endif
            @endif
            <x-btn-cancel wire:click="hideModal" px="px-4" class="mr-2" />
        </div>
    </form>
    </div>
  </div>
</div>
