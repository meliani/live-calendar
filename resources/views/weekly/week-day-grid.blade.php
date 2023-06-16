<div
    x-data="{ isDragging: false }"
    x-on:dragenter="isDragging = true"
    x-on:dragleave="isDragging = false"
    x-on:dragover="event.preventDefault()"
    x-on:drop="isDragging = false; $wire.onLiveCalendarEventDrop(event, '{{ $componentId }}', '{{ $day }}', {{ $day->year }}, {{ $day->month }}, {{ $day->day }}, '{{ $dragAndDropClasses }}');"
    class="flex-1 h-40 lg:h-48 border border-gray-200 -mt-px -ml-px"
    style="min-width: 10rem;"
    :class="{ 'bg-yellow-100': {{ $dayInMonth }} && {{ $isToday }}, 'bg-gray-100': !{{ $dayInMonth }} }"
    :style="{ 'background-color': isDragging ? '#f7fafc' : '' }">

    <!-- Wrapper for Drag and Drop -->
    <div
        class="w-full h-full"
        id="{{ $componentId }}-{{ $day }}">

        <div
            @if($dayClickEnabled)
                x-on:click="$wire.onDayClick({{ $day->year }}, {{ $day->month }}, {{ $day->day }})"
            @endif
            class="w-full h-full p-2 flex flex-col">

            <!-- Number of Day -->
            <div class="flex items-center">
                <p class="text-sm {{ $dayInMonth ? 'font-medium' : '' }}">
                    {{ $day->formatLocalized('%A') }} {{ $day->format('d') }}
                </p>
                <p class="text-xs text-gray-600 ml-4">
                    @if($events->isNotEmpty())
                        {{ $events->count() }} {{ Str::plural('event', $events->count()) }}
                    @endif
                </p>
            </div>

            <!-- Events -->
            <div class="p-2 my-2 flex-1 overflow-y-auto grid gap-4 lg:grid-cols-3 xl:grid-cols-3">
                @foreach($events as $event)
                    <div
                        @if($dragAndDropEnabled)
                            draggable="true"
                            x-on:dragstart="$wire.onLiveCalendarEventDragStart(event, '{{ $event['id'] }}')"
                        @endif
                        class="lg:w-full lg:w-1/2">
                        @include($eventView, [
                            'event' => $event,
                        ])
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
