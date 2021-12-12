@if($close_me == true)
<div {{$attributes}} >
    <div  class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="w-auto p-3 overflow-hidden bg-white bg-opacity-100 border border-gray-500 rounded-lg shadow-xl">
            <h1 class="font-bold">Konfirmasi !</h1>
            <h4>{{$title1}}</h4>
            <h3>{{$title2}}</h3>
            <div class="flex justify-center gap-3">
                <x-btn title="Ya" wire:click="{{$ya}}" color="red"  px="px-6"/>
                <x-btn title="Tidak" wire:click="closeMsgBox()"  px="px-3"/>
            </div>
        </div>
    </div>
</div>
@endif
