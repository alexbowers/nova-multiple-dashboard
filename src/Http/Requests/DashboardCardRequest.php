<?php

namespace AlexBowers\MultipleDashboard\Http\Requests;

use AlexBowers\MultipleDashboard\DashboardNova;
use Laravel\Nova\Http\Requests\NovaRequest;

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
             *
             * Reason for Eval is because the namespace does not have to be App,
             * so hardcoding it to App will mean the system only works for some people.
             *
             * Do not like, but not sure of a better way to do it.
             */

            $namespace = app()->getNamespace();

            $cards = "\$class = new class(app()) extends \\{$namespace}Providers\NovaServiceProvider {
                public function getAroundProtectedMethod()
                {
                    return \$this->cards();
                }
            };
            
            return \$class->getAroundProtectedMethod();";

            return eval($cards);
        }

        return DashboardNova::availableDashboardCardsForDashboard($dashboard, $this);
    }
}
