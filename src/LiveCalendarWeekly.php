<?php

namespace Mel\LiveCalendar;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class LiveCalendarWeekly extends Component
{
    public $startsAt;
    public $endsAt;
    public $gridStartsAt;
    public $gridEndsAt;
    public $weekStartsAt;
    public $weekEndsAt;
    public $calendarView;
    public $weeklyCalendarView;
    public $weekGrid;
    public $dayView;
    public $eventView;
    public $dayOfWeekView;
    public $dragAndDropClasses;
    public $beforeCalendarView;
    public $afterCalendarView;
    public $pollMillis;
    public $pollAction;
    public $dragAndDropEnabled;
    public $dayClickEnabled;
    public $eventClickEnabled;
    public $detailViewModal = null;
    protected $casts = [
        'startsAt' => 'date',
        'endsAt' => 'date',
        'gridStartsAt' => 'date',
        'gridEndsAt' => 'date',
    ];

    public $toggleMonthDisplay = false;

    public function toggleCalendarDisplay()
    {
        $this->toggleMonthDisplay = !$this->toggleMonthDisplay;
    }

    public function mount(
        $initialYear = null,
        $initialMonth = null,
        $weekStartsAt = null,
        $calendarView = null,
        $dayView = null,
        $eventView = null,
        $dayOfWeekView = null,
        $dragAndDropClasses = null,
        $beforeCalendarView = null,
        $afterCalendarView = null,
        $pollMillis = null,
        $pollAction = null,
        $dragAndDropEnabled = true,
        $dayClickEnabled = true,
        $eventClickEnabled = true,
        $weeklyCalendarView = null,
        $extras = []
    ) {
        $this->weekStartsAt = $weekStartsAt ?? Carbon::SUNDAY;
        $this->weekEndsAt = $this->weekStartsAt == Carbon::SUNDAY
            ? Carbon::SATURDAY
            : collect([0, 1, 2, 3, 4, 5, 6])->get($this->weekStartsAt + 6 - 7);

        $initialYear = $initialYear ?? Carbon::today()->year;
        $initialMonth = $initialMonth ?? Carbon::today()->month;
        $this->weekGrid = $this->generateWeekGrid();
        $this->startsAt = Carbon::createFromDate($initialYear, $initialMonth, 1)->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();
        $this->setupViews($calendarView, $dayView, $eventView, $dayOfWeekView, $beforeCalendarView, $afterCalendarView, $weeklyCalendarView);
        $this->setupPoll($pollMillis, $pollAction);
        $this->dragAndDropEnabled = $dragAndDropEnabled;
        $this->dragAndDropClasses = $dragAndDropClasses ?? 'border border-blue-400 border-4';
        $this->dayClickEnabled = $dayClickEnabled;
        $this->eventClickEnabled = $eventClickEnabled;
        $this->afterMount($extras);
    }

    public function afterMount($extras = [])
    {
        //
    }

    public function setupViews(
        $calendarView = null,
        $dayView = null,
        $eventView = null,
        $dayOfWeekView = null,
        $beforeCalendarView = null,
        $afterCalendarView = null,
        $weeklyCalendarView = null
    ) {
        $this->calendarView = $calendarView ?? 'live-calendar::week-calendar';
        $this->dayView = $dayView ?? 'live-calendar::weekly.week-day-grid';
        $this->eventView = $eventView ?? 'live-calendar::weekly.week-event';
        $this->dayOfWeekView = $dayOfWeekView ?? 'live-calendar::weekly.week-day-of-week';
        $this->beforeCalendarView = $beforeCalendarView ?? null;
        $this->afterCalendarView = $afterCalendarView ?? null;
        $this->weeklyCalendarView = $weeklyCalendarView ?? 'live-calendar::weekly.week-calendar';
    }

    public function setupPoll($pollMillis, $pollAction)
    {
        $this->pollMillis = $pollMillis;
        $this->pollAction = $pollAction;
    }

    public function goToPreviousWeek()
    {
        $this->startsAt->subWeek();
        $this->endsAt->subWeek();

        $this->calculateGridStartsEnds();
    }

    public function goToNextWeek()
    {
        $this->startsAt->addWeek();
        $this->endsAt->addWeek();

        $this->calculateGridStartsEnds();
    }

    public function goToCurrentWeek()
    {
        $this->startsAt = Carbon::today()->startOfWeek()->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfWeek()->startOfDay();

        $this->calculateGridStartsEnds();
    }

    public function calculateGridStartsEnds()
    {
        $this->gridStartsAt = $this->startsAt->clone()->startOfWeek($this->weekStartsAt);
        $this->gridEndsAt = $this->endsAt->clone()->endOfWeek($this->weekEndsAt);
    }

    public function generateWeekGrid()
    {
        $weekGrid = collect();
        $currentDay = Carbon::today()->startOfWeek();

        while (!$currentDay->greaterThan(Carbon::today()->endOfWeek())) {
            $weekGrid->push($currentDay->clone());
            $currentDay->addDay();
        }

        return $weekGrid;
    }

    public function events(): Collection
    {
        return collect();
    }

    public function getEventsForDay($day, Collection $events): Collection
    {
        return $events
            ->filter(function ($event) use ($day) {
                return Carbon::parse($event['date'])->isSameDay($day);
            });
    }

    public function onDayClick($year, $month, $day)
    {
        //
    }

    public function onEventClick($eventId)
    {
        //
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        //
    }

    /**
     * @return Factory|View
     * @throws Exception
     */
    public function render()
    {
        $events = $this->events();

/*         return view($this->weeklyCalendarView)
            ->with([
                'componentId' => $this->id,
                'weekGrid' => $this->weekGrid,
                'events' => $events,
                'getEventsForDay' => function ($day) use ($events) {
                    return $this->getEventsForDay($day, $events);
                }
            ]); */
            // $this->startsAt = Carbon::createFromDate()->startOfDay();
            return view($this->weeklyCalendarView)
    ->with([
        'componentId' => $this->id,
        'weekGrid' => $this->weekGrid,
        'events' => $events,
        'startsAt' => $this->startsAt, // Make sure to pass the correct Carbon instance here
        'getEventsForDay' => function ($day) use ($events) {
            return $this->getEventsForDay($day, $events);
        }
    ]);
    }
}
