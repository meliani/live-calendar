<div class="flex-1 h-40 lg:h-48 border border-gray-200 -mt-px -ml-px" style="min-width: 10rem;"
    ondragenter="onLiveCalendarEventDragEnter(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragleave="onLiveCalendarEventDragLeave(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragover="onLiveCalendarEventDragOver(event);"
    ondrop="onLiveCalendarEventDrop(event, '{{ $componentId }}', '{{ $day }}', {{ $day->year }}, {{ $day->month }}, {{ $day->day }}, '{{ $dragAndDropClasses }}');">

    {{-- Wrapper for Drag and Drop --}}
    <div class="w-full h-full" id="{{ $componentId }}-{{ $day }}">

        <div class="w-full h-full p-2 {{ $dayInMonth ? ($isToday ? 'bg-yellow-100' : ' bg-white ') : 'bg-gray-100' }} flex flex-col"
            @if ($dayClickEnabled) wire:click="onDayClick({{ $day->year }}, {{ $day->month }}, {{ $day->day }})" @endif>

            {{-- Number of Day --}}
            <div class="flex items-center">
                <p class="text-sm {{ $dayInMonth ? ' font-medium ' : '' }}">
                    {{ $day->formatLocalized('%A') }} {{ $day->format('d') }}
                </p>
                <p class="text-xs text-gray-600 ml-4">
                    @if ($events->isNotEmpty())
                        {{ $events->count() }} {{ Str::plural('event', $events->count()) }}
                    @endif
                </p>
            </div>

            {{-- Events --}}
            <div class="p-2 my-2 flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-2">
                    @foreach ($events as $event)
                        <div @if ($dragAndDropEnabled) draggable="true" @endif
                            ondragstart="onLiveCalendarEventDragStart(event, '{{ $event['id'] }}')">
                            @include($eventView, [
                                'event' => $event,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
