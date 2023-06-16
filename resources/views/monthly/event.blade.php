<div class="{{ $event['bg_color'] }} rounded-lg border py-2 px-3 shadow-md cursor-pointer"
    @if ($eventClickEnabled) wire:click.stop="onEventClick('{{ $event['id'] }}')" @endif>

    <p class="text-sm font-medium">
        {!! $event['title'] !!}
    </p>
    {{-- Adding icon support // need to be added to constructor --}}
    <div class="float-right" data-tooltip-target="tooltip-icon">
        {{-- <button data-tooltip-target="tooltip-default" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Default tooltip</button> --}}
        <div class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
            id="tooltip-icon" role="tooltip">
            {{-- {!! $event['authorization'] !!} --}}
            {{-- tooltip message --}}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        @svg($event['icons'])
    </div>
    {{-- end icon --}}
    <div class="text-xs">
        {{-- <p class="mt-2 text-xs"> --}}
        {!! $event['description'] ?? 'No description' !!}
        {{-- </p> --}}
    </div>
</div>
