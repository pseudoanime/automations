<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TravelTrackerUpdateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://travel-tracker.net')
                ->type("email", "lbalakrishnan@brightsource.co.uk")
                ->type("password", env("TRAVEL_TRACKER_PASSWORD"))
                ->press('Login')
                ->waitForText('My Journeys')
                ->select('#selectedJourney', "1")
                ->press("Insert into every journey this week");
        });
    }
}
