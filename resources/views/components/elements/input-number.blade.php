<div {{$attributes}}>
    <label for="{{$name}}">{{$label}}</label>
    <div class="relative">
        @if(!$rp == '')
            <div class="absolute inset-y-0 flex items-center text-gray-400 left-2">{{$rp}}</div>
        @endif
        <input wire:model="{{$name}}" id="{{$name}}"  onkeyup="formatCurrency('{{$name}}');"  class="w-full pl-10 pr-3 text-right border rounded" type="text" placeholder="{{$rp}} 000,000.00"/>
    </div>

    @if($terbilang=="true")
        <div>
            <textarea  readonly class="flex items-center w-full h-auto px-0 mt-1 text-sm font-semibold text-blue-700 bg-blue-300 readonly" id="output" type="text" value=""></textarea>
        </div>
    @endif

    @if ($errors->has($name))
        <span class="text-xs text-red-500" role="alert">
            <strong>{{$errors->first($name) }}</strong>
        </span>
    @endif


</div>


<script>
    $(["#"+"{{$name}}"].join(",")).keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and (. -> 110 and 190 ).
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
            // Allow: Ctrl+A,Ctrl+C,Ctrl+V, Command+A
            ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $("#"+"{{$name}}").on('keyup', function(){
        var n = $("#"+"{{$name}}").val().replace(/[^0-9]/gi, '');
        var hasil = terbilang(n);

        $("#output").val(terbilang(n));
        // $("#output").html(terbilang(n));
    });

    function tampil_terbilang(){
        var n = $("#"+"{{$name}}").val().replace(/[^0-9]/gi, '');
        var hasil = terbilang(n);

        $("#output").val(terbilang(n));
    }

    tampil_terbilang();
    formatCurrency('{{$name}}');

</script>


