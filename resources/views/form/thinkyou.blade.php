<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg  px-5 px-2 bg-white">
    <div class="mt-8 max-w-7xl min-h-full mx-auto px-4 py-16 text-center  sm:px-6 sm:py-24 lg:px-8 lg:py-48 space-y-4">
        @foreach($blocks as $block)
            {{$block->render()}}
        @endforeach
    </div>
</div>

