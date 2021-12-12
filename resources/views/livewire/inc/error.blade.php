@if (count($errors) > 0)
<div id="msg_error" class="relative flex items-start py-2 mx-2 bg-red-300 rounded shadow-lg">
    <div onclick="close_msg('msg_error')"
        class="absolute top-0 right-0 px-3 font-bold text-white bg-red-400 rounded-tr cursor-pointer font-sm">
        x
    </div>
        <div class="px-2 font-bold">Errors: </div>
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

</div>
@endif

@if (Session:: has('success'))
    <div id="msg_success" class="flex items-center justify-between pl-3 mx-2 mt-3 bg-green-300 rounded shadow-lg">
        <label class="font-bold text-green-800 font-sm">Success: <span class="ml-2 text-green-600">{{ Session::get('success') }}</span> </label>
        <div onclick="close_msg('msg_success')" class="px-3 py-2 font-bold text-white bg-green-700 rounded-r cursor-pointer font-sm">x</div>
    </div>
@elseif (Session:: has('error'))
    <div id="msg_error" class="flex items-center justify-between pl-3 mx-2 mt-3 bg-red-300 rounded shadow-lg">
        <label class="font-bold text-red-800 font-sm">Error: <span class="ml-2 text-red-600">{{ Session::get('error') }}</span> </label>
        <div onclick="close_msg('msg_error')" class="px-3 py-2 font-bold text-white bg-red-700 rounded-r cursor-pointer font-sm">x</div>
    </div>
@elseif (Session:: has('warning'))
    <div id="msg_warning" class="flex items-center justify-between pl-3 mx-2 mt-3 bg-yellow-300 rounded shadow-lg">
        <label class="font-bold text-yellow-800 font-sm">Warning: <span class="ml-2 text-yellow-600">{{ Session::get('warning') }}</span> </label>
        <div onclick="close_msg('msg_warning')" class="px-3 py-2 font-bold text-white bg-yellow-700 rounded-r cursor-pointer font-sm">x</div>
    </div>
@endif


