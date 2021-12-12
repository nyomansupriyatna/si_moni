<div {{ $attributes }}>
    <button type="button" class="inline-flex justify-center w-full px-2 py-1 text-base font-medium text-white bg-red-500 border border-transparent rounded-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 sm:ml-0 sm:w-auto sm:text-sm">
        <div class="flex items-center justify-between">
            <x-icon-eye width=24 height=24 />
            <span class="{{!$title == "" ? 'ml-2':''}} font-semibold"> {{ $judul }}</span>
        </div>
    </button>
</div>
