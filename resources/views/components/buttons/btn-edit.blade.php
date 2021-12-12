<div {{ $attributes }} class="tooltip">
    @if($tooltiptext !== "")
        <span class="tooltiptext">{{$tooltiptext}}</span>
    @endif
    <button type="button" class="inline-flex justify-center w-full {{$px}} {{$py}} text-base font-medium text-white bg-indigo-500 border border-transparent rounded-full shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 sm:ml-0 sm:w-auto sm:text-sm">
        <div class="flex items-center justify-between">
            <x-icon-edit width=20 height=20 />
            <span class=" {{!$title == "" ? 'ml-2':''}} font-semibold"> {{ $title }}</span>
        </div>
    </button>
</div>
