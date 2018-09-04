<?php

namespace AlexBowers\MultipleDashboard\Http\Requests;

use AlexBowers\MultipleDashboard\DashboardNova;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Providers\NovaServiceProvider;

class DashboardCardRequest extends NovaRequest
{
    /**
     * Get all of the possible cards for the request.
     *
     * @return \Illuminate\Support\Collection
     */
    public function availableCards($dashboard)
    {
        if ($dashboard == 'main') {
            /**
             * This is a huge hack, and will not work for anybody not using
             * the `App` default namespace.
             */
            return (new class(app()) extends NovaServiceProvider {
                public function getAroundProtectedMethod()
                {
                    return $this->cards();
                }
            })->getAroundProtectedMethod();
        }

        return DashboardNova::availableDashboardCardsForDashboard($dashboard, $this);
    }
}
