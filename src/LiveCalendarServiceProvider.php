<?php

namespace Mel\LiveCalendar;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LiveCalendarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'live-calendar');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/live-calendar'),
            ], 'live-calendar');
        }

        Blade::directive('LiveCalendarScripts', function () {
            return <<<'HTML'
            <script>
                function onLiveCalendarEventDragStart(event, eventId) {
                    event.dataTransfer.setData('id', eventId);
                }

                function onLiveCalendarEventDragEnter(event, componentId, dateString, dragAndDropClasses) {
                    event.stopPropagation();
                    event.preventDefault();

                    let element = document.getElementById(`${componentId}-${dateString}`);
                    element.className = element.className + ` ${dragAndDropClasses} `;
                }

                function onLiveCalendarEventDragLeave(event, componentId, dateString, dragAndDropClasses) {
                    event.stopPropagation();
                    event.preventDefault();

                    let element = document.getElementById(`${componentId}-${dateString}`);
                    element.className = element.className.replace(dragAndDropClasses, '');
                }

                function onLiveCalendarEventDragOver(event) {
                    event.stopPropagation();
                    event.preventDefault();
                }

                function onLiveCalendarEventDrop(event, componentId, dateString, year, month, day, dragAndDropClasses) {
                    event.stopPropagation();
                    event.preventDefault();

                    let element = document.getElementById(`${componentId}-${dateString}`);
                    element.className = element.className.replace(dragAndDropClasses, '');

                    const eventId = event.dataTransfer.getData('id');

                    window.Livewire.find(componentId).call('onEventDropped', eventId, year, month, day);
                }
            </script>
HTML;
        });
    }

    public function register()
    {
        $this->app->bind('live-calendar', function ($app) {
            return new LiveCalendar();
        });

        $this->app->bind('live-calendar-monthly', function ($app) {
            return new LiveCalendarMonthly();
        });

        $this->app->bind('live-calendar-weekly', function ($app) {
            return new LiveCalendarWeekly();
        });
    }
}
