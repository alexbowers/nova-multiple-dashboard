<?php

namespace AlexBowers\MultipleDashboard\Tests;

use AlexBowers\MultipleDashboard\Http\Controllers\ToolController;
use AlexBowers\MultipleDashboard\MultipleDashboard;
use Symfony\Component\HttpFoundation\Response;

class ToolControllerTest extends TestCase
{
    /** @test */
    public function it_can_can_return_a_response()
    {
        $this
            ->get('nova-vendor/AlexBowers/nova-multiple-dashboard/endpoint')
            ->assertSuccessful();
    }
}
