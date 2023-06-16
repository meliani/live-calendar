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
                        @foreach ($weekGrid as $day)
                        <div class="flex flex-row">
                            {{-- Convert the day string to a Carbon instance --}}
                            @php
                                $dayCarbon = Carbon\Carbon::parse($day);
                            @endphp
                    
                            @include($dayView, [
                                'componentId' => $componentId,
                                'day' => $dayCarbon, // Pass the Carbon instance
                                'dayInWeek' => $dayCarbon->isSameWeek($startsAt),
                                'isToday' => $dayCarbon->isToday(),
                                'week_events' => $getEventsForDay($dayCarbon, $week_events),
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
