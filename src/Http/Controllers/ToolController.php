<?php

namespace AlexBowers\MultipleDashboard\Http\Controllers;

use Illuminate\Http\Request;
use AlexBowers\MultipleDashboard\File;
use Illuminate\Routing\Controller;
use AlexBowers\MultipleDashboard\Http\Requests\DashboardCardRequest;

class ToolController extends Controller
{
    /**
     * List the cards for the dashboard.
     *
     * @param  \Laravel\Nova\Http\Requests\DashboardCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(DashboardCardRequest $request, $dashboard)
    {
        return $request->availableCards($dashboard);
    }
}
