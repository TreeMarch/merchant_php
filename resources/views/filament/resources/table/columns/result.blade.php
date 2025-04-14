    <div class="flex items-center space-x-3">
        @if ($getRecord()->image && is_array($getRecord()->image) && count($getRecord()->image) > 0)
            <div class="flex-shrink-0">
                <img class="h-8 w-8  object-cover" src="{{ asset('storage/' . $getRecord()->image[0]) }}"
                    alt="{{ $getRecord()->name }}" />
            </div>
        @elseif($getRecord()->image && is_string($getRecord()->image))
            <div class="flex-shrink-0">
                <img class="h-8 w-8  object-cover" src="{{ asset('storage/' . $getRecord()->image) }}"
                    alt="{{ $getRecord()->name }}" />
            </div>
        @endif
        <div>
            <div class="text-sm font-medium">
                {{ $getRecord()->name }}
            </div>
        </div>
    </div>
