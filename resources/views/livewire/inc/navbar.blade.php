<div class="fixed top-0 w-full isset-x-0"> <!-- main  -->

    <nav class="relative flex items-center justify-between w-full h-auto gap-3 py-2 border border-indigo-400 shadow-md bg-gradient-to-t from-indigo-400 to-indigo-50 sm:px-6">

        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}">
                {{-- icon hero home svg --}}
                <svg class="w-12 h-12 py-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </a>
            <div id="burger" class="hidden">
                <x-icon-burger width=30 height=30 onclick="toggle_this('sidebar'); toggle_this('burger');" class="hover:bg-indigo-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" />
            </div>

        </div>

        <div class="">


        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div  onclick="event.preventDefault(); this.closest('form').submit();"
             class="px-3 py-2 bg-blue-700 border border-gray-700 rounded-md shadow-sm cursor-pointer hover:bg-white ">
                Logout
            </div>
        </form>
    </nav>


    <div class="mt-3">
        @include('livewire.inc.error')
    </div>


</div>  <!-- end main  -->

<script>
    function toggle_this(id)
    {
        $('#'+id).toggleClass("hidden");
    }

    function show_this(id){
        // alert('12333');

        $('#'+id).removeClass('hidden');

    }

    function hide_this(id){

        $('#'+id).addClass('hidden');

    }

</script>
