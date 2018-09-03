<?php

namespace AlexBowers\MultipleDashboard;

use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class DashboardNova extends Nova
{
    /**
     * The registered dashboard names.
     */
    public static $dashboards = [];

    /**
     * Get the dashboards registered with Nova.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public static function availableDashboards(Request $request)
    {
        return collect(static::$dashboards)->all();
    }

    public static function dashboardsIn($directory)
    {
        $namespace = app()->getNamespace();

        $dashboards = [];

        foreach ((new Finder)->in($directory)->files() as $dashboard) {
            $dashboard = $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($dashboard->getPathname(), app_path().DIRECTORY_SEPARATOR)
            );

            if (is_subclass_of($dashboard, Dashboard::class) && !(new \ReflectionClass($dashboard))->isAbstract()) {
                $dashboards[] = $dashboard;
            }
        }

        static::dashboards(
            collect($dashboards)->sort()->transform(function ($dashboard) {
                if ($dashboard instanceof Dashboard) {
                    return $dashboard;
                }

                return app()->make($dashboard);
            })->all()
        );
    }

    /**
     * Register the given dashboards.
     *
     * @param  array  $dashboards
     * @return static
     */
    public static function dashboards(array $dashboards)
    {
        static::$dashboards = array_merge(static::$dashboards, $dashboards);

        return new static;
    }

    /**
     * Get the available dashboard cards for the given request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return \Illuminate\Support\Collection
     */
    public static function allAvailableDashboardCards(NovaRequest $request)
    {
        return collect(static::$dashboards)
            ->filter
            ->authorize($request)
            ->flatMap(function ($dashboard) {
                return $dashboard->cards();
            })->merge(static::$cards)
            ->unique()
            ->filter
            ->authorize($request)
            ->values();
    }

    /**
     * Get the available dashboard cards for the given request.
     *
     * @param string $dashboard
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return \Illuminate\Support\Collection
     */
    public static function availableDashboardCardsForDashboard($dashboard, NovaRequest $request)
    {
        return collect(static::$dashboards)->filter->authorize($request)->filter(function ($board) use ($dashboard) {
            return $board->uriKey() === $dashboard;
        })->flatMap(function ($dashboard) {
            return $dashboard->cards();
        })->filter->authorize($request)->values();
    }
}
