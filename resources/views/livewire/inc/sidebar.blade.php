{{-- <div class="absolute inset-y-0 left-0 p-2 mb-2 transition duration-300 ease-in-out transform -translate-x-full bg-purple-500 shadow-sm sm:w-64"> --}}
<div id="sidebar" class="p-2 mb-2 text-white transition-all duration-1000 transform bg-purple-500 shadow-sm sm:w-64">
    <div class="right-0 flex justify-end text-white top-1">
        <span  onclick="toggle_this('sidebar'); show_this('burger')" class="px-2 font-bold bg-gray-500 cursor-pointer">X</span>
    </div>
    <div wire:click="menuSetup" class="flex items-center justify-center w-full px-2 mt-2 mb-2 text-lg font-bold text-gray-700 rounded">
        <a href="">{{Auth::user()->nama}}</a>
        <hr/>
    </div>
    <div>
        @if(Auth::user()->hak_akses =='Admin')
            <a href="/user" class="block mt-10 rounded cursor-pointer hover:bg-blue-600 @if(request()->routeIs('user')) bg-purple-600  @endif">
                <span class="py-2 ml-4 border-gray-500 rounded-lg">Data User</span>
            </a>
        @endif

        @if(Auth::user()->hak_akses =='Admin' | Auth::user()->hak_akses =='Operator')
            <a class="block mt-5 rounded cursor-pointer hover:bg-blue-600">
                <span class="py-2 ml-4 border-gray-500 rounded-lg">Data Work Order</span>
            </a>

            <a class="block mt-5 rounded cursor-pointer hover:bg-blue-600">
                <span class="py-2 ml-4 border-gray-500 rounded-lg">Data Mapping Regu</span>
            </a>

            <a class="block mt-5 rounded cursor-pointer hover:bg-blue-600">
                <span class="py-2 ml-4 border-gray-500 rounded-lg">Data Laporan Progress</span>
            </a>

        @endif

        @if(Auth::user()->hak_akses =='Teknisi')
        <a class="block mt-5 rounded cursor-pointer hover:bg-blue-600">
            <span class="py-2 ml-4 border-gray-500 rounded-lg">Order PSB</span>
        </a>
        @endif
    </div>


</div>
