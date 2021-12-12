<div {{$attributes}}>
    <div class="px-2 mb-1 text-indigo-700 border-r rounded-l">
        <label for="{{$name}}">{{$label}}</label>
    </div>
    <select wire:model="{{$name}}" name="{{$name}}" class="w-full text-sm border rounded h-9">
        @if($action_btn == 'edit')

            @foreach ($data as $item)
                @if($item->id == $field)
                    <option selected value="{{$item}}">{{$item}}</option>
                @else
                    <option value="{{$item}}">{{$item}}</option>
                @endif
            @endforeach

        @else

            <option class="flex items-center" value="" disabled selected hidden>Select {{$name}}</option>
            @foreach ($data as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach

        @endif
    </select>
    @if ($errors->has('{{$name}}'))
        <span class="text-xs text-red-500" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
