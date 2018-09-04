<?php

namespace AlexBowers\MultipleDashboard;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use AlexBowers\MultipleDashboard\Http\Middleware\Authorize;
use AlexBowers\MultipleDashboard\Console\Commands\CreateDashboard;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/nova-overrides', 'nova');

        Nova::serving(function (ServingNova $event) {
            DashboardNova::dashboardsIn(app_path('Nova/Dashboards'));
            Nova::script('nova-multiple-dashboard', __DIR__ . '/../dist/js/MultipleDashboard.js');
        });

        $this->app->booted(function () {
            $this->routes();

            Nova::serving(function (ServingNova $event) {
                DashboardNova::copyDefaultDashboardCards();
                DashboardNova::cardsInDashboards();
            });
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDashboard::class,
            ]);
        }
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware('nova')
                ->prefix('nova-vendor/AlexBowers/nova-multiple-dashboard')
                ->group(__DIR__.'/../routes/api.php');
    }
}
