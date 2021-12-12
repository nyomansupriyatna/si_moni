<div {{ $attributes }}>
    <button type="button" class="inline-flex justify-center w-full {{$px}} {{$py}} text-base font-medium text-white bg-green-500 border border-transparent rounded-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 sm:ml-0 sm:w-auto sm:text-sm">
        <div class="flex items-center justify-between">
            <x-icon-save width=20 height=20 />
            <span class=" {{!$title == "" ? 'ml-2':''}} font-semibold"> {{ $title }}</span>
        </div>
    </button>
</div>
