<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']  }}')"
    @endif
    class="{{ $event['bg_color'] }} rounded-lg border py-2 px-3 shadow-md cursor-pointer">

    <p class="text-sm font-medium">
        {!! $event['title'] !!}
    </p>
    {{-- Adding icon support // need to be added to constructor--}}
    <div class="float-right">
    {!! $event['icons'] ?? '' !!}
    </div>
    {{-- end icon --}}
    <div class="text-xs">
    {{-- <p class="mt-2 text-xs"> --}}
        {!! $event['description'] ?? 'No description' !!}
    {{-- </p> --}}
    </div>
</div>