<div class="relative">
    <fieldset class="mb-3">
        <legend class="text-lg font-semibold text-gray-600 leading-snug tracking-tight">{{ $label }} @if($required)<span class="inline-block w-1"></span><span class="text-gray-500">*</span>@endif</legend>
        <div class="mt-3 space-y-2">

            @foreach($options as $option)
                <div class="relative flex items-start p-4 border border-gray-200 rounded group hover:bg-gray-50 hover:border-gray-300">
                    <div class="min-w-0 flex-1 text-sm">
                        <label for="{{ $id }}-{{ $option['value'] }}"
                               class="font-medium text-gray-600 flex-1">
                            {{ $option['value'] }}
                        </label>
                    </div>
                    <div class="ml-3 flex items-center h-5">
                        <input
                            id = "{{$id}}-{{$option['value']}}"
                            name="{{$id}}[]"
                            type="checkbox"
                            value="{{ $option['value'] }}"
                            @if($required) required @endif
                            class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
                    </div>
                </div>


            @endforeach

        </div>
    </fieldset>
</div>
