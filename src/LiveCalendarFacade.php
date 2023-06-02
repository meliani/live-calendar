<?php

namespace Mel\LiveCalendar;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mel\LiveCalendar\Skeleton\SkeletonClass
 */
class LiveCalendarFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'live-calendar';
    }
}
