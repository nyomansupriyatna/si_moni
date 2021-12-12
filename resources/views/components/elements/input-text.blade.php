<div {{$attributes}}>
    <div class="relative">
        <label for="{{$name}}">{{$label}}</label>
        <div>
            <input {{$status !== 'opn' ? 'disabled':''}} wire:model="{{$name}}" name="{{$name}}" class="w-full h-8 px-3 border rounded pl-7 " type="{{$type}}" placeholder="{{$label}}..." {{$readonly}}>
        </div>

        @if ($errors->has($name))
            <span class="text-xs text-red-500" role="alert">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>
