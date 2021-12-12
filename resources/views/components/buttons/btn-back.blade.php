<div {{ $attributes }}>
    <a href="{{url()->previous()}}">
        <button type="button" class="inline-flex justify-center w-full {{$px}} {{$py}} text-base font-medium text-white bg-gray-500 border border-transparent rounded-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 sm:ml-0 sm:w-auto sm:text-sm">
            <div class="flex items-center justify-between">
                <x-icon-chev-left width=20 height=20 />
                <span class=" {{!$title == "" ? 'ml-2':''}} font-semibold"> {{ $title }}</span>
            </div>
        </button>
    </a>
</div>
