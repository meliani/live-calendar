<div>
    <h2 class="text-2xl font-bold mb-4">{{__('Weekly View')}}</h2>

    @if($pollMillis !== null && $pollAction !== null)
        <div wire:poll.{{ $pollMillis }}ms="{{ $pollAction }}"></div>
    @elseif($pollMillis !== null)
        <div wire:poll.{{ $pollMillis }}ms></div>
    @endif

    <div>
        @includeIf($beforeCalendarView)
    </div>

    <div class="flex">
        <div class="overflow-x-auto w-full">
            <div class="inline-block min-w-full overflow-hidden">
                <div class="w-full flex flex-row">
                    {{-- <div class="w-1/7">
                        @foreach($weekGrid as $day)
                            @include($dayOfWeekView, ['day' => $day])
                        @endforeach
                    </div> --}}
                    <div class="w-full flex flex-col">
                        @foreach($weekGrid as $day)
                            <div class="flex flex-row">
                                {{-- {{dd($startsAt)}} --}}
                                @include($dayView, [
                                    'componentId' => $componentId,
                                    'day' => $day,
                                    'dayInMonth' => $day->isSameMonth(Carbon\Carbon($startsAt)),
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
