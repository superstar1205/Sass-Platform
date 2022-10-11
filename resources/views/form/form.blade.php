<form method="post" action="{{ $action }}" class="space-y-8">
    <div class="space-y-8 sm:space-y-5">
        <div class="pt-6">
            {!! $logo->render() !!}
        </div>

        <div>
            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                <input type="hidden" name="current_page" value="{{$currentPage}}">
                @method($method)
                @csrf
                @foreach($blocks as $block)
                    {{$block->render()}}
                @endforeach
            </div>
        </div>

        <div class="py-6">
            <div class="flex justify-end">
                {!! $button->render() !!}
            </div>
        </div>

    </div>
</form>
