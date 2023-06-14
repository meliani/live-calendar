<div
    @if ($pollMillis !== null && $pollAction !== null) wire:poll.{{ $pollMillis }}ms="{{ $pollAction }}"
    @elseif($pollMillis !== null)
        wire:poll.{{ $pollMillis }}ms @endif>

    <div>
        @includeIf($beforeCalendarView)
    </div>

    <div class="flex">
        <div class="overflow-x-auto w-full">
            <div class="inline-block min-w-full overflow-hidden">
                <div class="w-full flex flex-row">
                    <div class="w-full flex flex-col">
                        @foreach($weekGrid as $day)
                            <div class="flex flex-row">
                                @include($dayView, [
                                    'componentId' => $componentId,
                                    'day' => $day,
                                    'dayInMonth' => $day->isSameMonth($startsAt),
                                    'isToday' => $day->isToday(),
                                    'events' => $getEventsForDay($day
                                    , $events),
                                ])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        @includeIf($afterCalendarView)
    </div>
</div>
