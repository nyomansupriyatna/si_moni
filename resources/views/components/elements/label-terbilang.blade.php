<div {{$attributes}}>

    <input type="hidden"  id="{{$name}}" value="{{$value}}"/>

    <div>
        <label readonly class="flex items-center justify-center w-full h-auto px-2 mt-1 text-sm font-semibold text-center text-blue-700 readonly" id="output" type="text"></label>
    </div>

    @if ($errors->has($name))
        <span class="text-xs text-red-500" role="alert">
            <strong>{{$errors->first($name) }}</strong>
        </span>
    @endif


</div>


<script>

    function tampil_terbilang(){
        var n = $("#"+"{{$name}}").val();
        var hasil = "( "+terbilang(n)+" )";

        $("#output").html(hasil);
    }

    tampil_terbilang();

</script>


