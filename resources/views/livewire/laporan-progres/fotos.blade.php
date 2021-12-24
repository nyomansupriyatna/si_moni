<div class="fixed inset-0 flex items-center justify-center pr-10 bg-gray-500 bg-opacity-75">

    <div class="w-auto p-3 bg-white bg-opacity-100 rounded shadow-sm">
        <h1 class="block py-2 mb-2 text-center bg-gray-200 font-2xl">FOTO (STATUS : {{strtoupper($status)}})</h1>

        <div class="flex items-center justify-center gap-2">
            @if($status=='ok')
                <div class="flex-1">
                    <img  class="overflow-hidden w-80 " src="/storage/images/{{$foto_odp}}">
                    <span class="block text-center text-white bg-gray-700">Foto ODP</span>

                </div>
                <div class="flex-1">
                    <img  class="overflow-hidden w-80 " src="/storage/images/{{$foto_rumah_pelanggan}}">
                    <span class="block text-center text-white bg-gray-700">Rumah Pelanggan</span>
                </div>
                <div class="flex-1">
                    <img  class="overflow-hidden w-80 " src="/storage/images/{{$foto_modem}}">
                    <span class="block text-center text-white bg-gray-700">Foto Modem</span>
                </div>
                <div class="flex-1">
                    <img  class="overflow-hidden w-80 " src="/storage/images/{{$foto_ap}}">
                    <span class="block text-center text-white bg-gray-700">Foto AP</span>
                </div>
            @elseif($status=='kendala')
                <div class="flex-1">
                    <img  class="overflow-hidden w-80 " src="/storage/images/{{$foto_kendala}}">
                    <span class="block text-center text-white bg-gray-700">Foto Kendala</span>
                </div>
            @else
            @endif

        </div>
        <div class="block p-3 text-center">
            <x-btn-cancel wire:click="close_fotos()" title="Close Foto"/>
        </div>
    </div>
</div>
