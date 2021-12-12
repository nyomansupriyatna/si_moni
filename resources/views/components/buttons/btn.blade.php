<div {{ $attributes }}>
    <button type="{{$tipe}}" class="inline-flex justify-center w-full {{$px}} {{$py}} text-base font-medium text-white bg-{{$color}}-500 border border-transparent rounded-full shadow-sm hover:bg-{{$color}}-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{$color}}-400 sm:ml-0 sm:w-auto sm:text-sm">
        <div class="flex items-center justify-center gap-2">
            @if(!$icon=="")
                <x-dynamic-component :component="$icon" width=20 height=20 />
            @endif
            @if(!$title=="")
                <span class="{{!$title == "" ? 'ml-1':''}} font-semibold"> {{ $title }}</span>
            @endif
        </div>
    </button>
</div>
