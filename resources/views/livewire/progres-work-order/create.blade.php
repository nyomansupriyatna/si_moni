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
                <input class="mb-2" wire:model="wo_id" class="w-full h-8 px-3 border border-gray-500 rounded" type="hidden" >

                <x-input-text class="mb-2" name="tanggal" label="User PSB" type="date" />
                <x-input-text class="mb-2" name="user_psb" label="User PSB" readonly="readonly" />

                <label for="status">Status</label>
                <select wire:model="status" name="status" class="w-full text-sm border rounded h-9">
                    <option class="flex items-center" value="null" disabled selected hidden>--select--</option>
                    @foreach ($all_status as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
                @if ($errors->has('status'))
                    <span class="mb-2 text-xs text-red-500 " role="alert">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif

                <x-input-text class="mb-2" name="datek" label="Date ODP" readonly="readonly"/>
                <x-input-text class="mb-2" name="sn_modem" label="SN Modem" />
                <x-input-text class="mb-2" name="jumlah_ap" label="Jumlah AP"  type="number"/>
                <x-input-text class="mb-2" name="panjang_dc" label="Panjang DC" type="number"/>
                <x-input-text class="mb-2" name="material_lain" label="Material Lain" />
                <x-input-text class="mb-2" name="keterangan_tambahan" label="Keterangan Tambahan" />
                @if($status == 'ok')
                    <x-input-text class="mb-2" name="foto_odp" label="Foto ODP" type="file" />
                    <x-input-text class="mb-2" name="foto_rumah_pelanggan" label="Foto Rumah Pelanggan" type="file" />
                    <x-input-text class="mb-2" name="foto_modem" label="Foto Modem" type="file" />
                    <x-input-text class="mb-2" name="foto_ap" label="Foto Ap" type="file" />
                @elseif($status == 'kendala')
                    <x-input-text class="mb-2" name="foto_kendala" label="Foto Kendala" type="file" />
                @else
                @endif

            </div>

        </div>
        {!! $action_btn =='Delete' ?  '<h3 class="text-center text-red-500">Delete this record ?</h3>' : '' !!}
      </div>
        <div class="px-4 py-3 bg-gray-100 sm:px-6 sm:flex sm:flex-row-reverse">
            @if($action_btn=='Delete')
                <x-btn-delete px="px-4" wire:click.prevent="confirmDelete({{$wo_id}})" />
            @else
                @if($action_btn=='Add')
                    <x-btn-save wire:click.prevent="store()"  px="px-4 mb-2"/>
                @else
                    <x-btn-save wire:click.prevent="update({{$wo_id}})" title="Update" class="px-4 mb-2"/>
                @endif
            @endif
            <x-btn-cancel wire:click="hideModal" px="px-4" class="mr-2" />
        </div>
    </form>
    </div>
  </div>
</div>
