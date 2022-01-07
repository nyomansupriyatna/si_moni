<div class="flex-1">


    <div class="w-full px-2 overflow-x-scroll">
        <table class="w-full table-auto">
            <thead>
                <td colspan="{{ count($headers)+1 }}">
                    <div class="block mb-1 bg-indigo-700 sm:flex">
                        <div class="p-2 w-42">
                            <select name="perPage" id="perPage"
                                class="flex border rounded cursor-pointer h-9 focus:outline-none focus:border-blue-500 focus:bg-white "
                                >
                                    <option value="3" class="flex items-center">5</option>
                                    <option value="10" class="flex items-center">10</option>
                                    <option value="25" class="flex items-center">25</option>
                                    <option value="50" class="flex items-center">50</option>
                                    <option value="100" class="flex items-center">100</option>
                            </select>
                        </div>
                        <div class="flex w-full px-3 py-2" >
                            <h2 class="items-center justify-start h-full font-bold text-white">Laporan Progress</h2>
                        </div>
                        <div class="flex w-full p-2 lg:justify-end lg:w-7/12">
                            <div class="relative">
                                <div class="absolute flex items-center h-full left-1">
                                    <x-icon-search width=20 height=20 class="text-gray-400"/>
                                </div>
                                <div wire:click="clearSearch" class="absolute flex items-center h-full cursor-pointer right-1">
                                    <x-icon-cancel width=24 height=24 class="text-gray-400"/>
                                </div>

                                <input wire:model.debounce.500ms="search"  type="text" placeholder="Search..."
                                    class="w-full pl-10 border border-gray-400 rounded h-9 pr-7 focus:outline-none focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                </td>
            </thead>
            <thead class="px-3 font-bold text-indigo-700 bg-indigo-200">
                @foreach($headers as $key => $value)

                    <th wire:click="sort('{{ $key }}')" class="py-2 border border-gray-400 cursor-pointer w-min hover:bg-indigo-300 hover:text-indigo-900">
                        <div class="flex items-center justify-center gap-2">
                            @if($sortColumn == $key)
                                    @if($sortDirection == 'asc')
                                        <x-icon-chev-up class="text-indigo-500" />
                                    @else
                                        <x-icon-chev-down class="text-indigo-500" />
                                    @endif
                            @endif
                            {{ is_array($value) ? $value['label'] : $value}}
                        </div>
                    </th>
                @endforeach

            </thead>
            <tbody>
                @if(count($data))
                    @foreach ($data as $item)
                        <tr class="hover:bg-gray-200">
                            <td class="px-2 border border-gray-300">
                                {{ $item->tanggal }}
                            </td>
                            <td class="px-2 border border-gray-300 w-max-content">
                                {{ $item->work_orders->user_psb }}
                            </td>
                            <td class="px-2 border border-gray-300 w-max-content">
                                {{ $item->status }}
                            </td>
                            <td class="px-2 border border-gray-300 w-max-content">
                                {{ $item->work_orders->datek }}
                            </td>
                            <td class="px-2 text-center border border-gray-300 w-max-content">
                                {{ $item->sn_modem }}
                            </td>
                            <td class="px-2 text-center border border-gray-300 w-max-content">
                                {{ $item->jumlah_ap }}
                            </td>
                            <td class="px-2 text-center border border-gray-300 w-max-content">
                                {{ $item->panjang_dc }}
                            </td>
                            <td class="px-2 text-center border border-gray-300 w-max-content">
                                {{ $item->material_lain }}
                            </td>
                            <td class="px-2 text-center border border-gray-300 w-max-content">
                                {{ $item->keterangan_tambahan }}
                            </td>
                            <td class="px-2 py-1 text-center border border-gray-300 w-max-content">
                                <x-btn-save wire:click="open_fotos({{$item->id}})" title="FOTO"/>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($headers)+1 }}" class="text-center border border-gray-300" ><h2> No Result found...</h2></td>
                    </tr>
                @endif
            </tbody>

        </table>
    </div>
    <div class="justify-end mt-1">
            {{$data->links()}}
    </div>

    @if($isOpen)
        @include('livewire.laporan-progres.fotos')
    @endif
</div>

