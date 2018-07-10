<?php

namespace Tests\Browser;

use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * Class TravelTrackerUpdateTest
 *
 * @package Tests\Browser
 */
class TravelTrackerUpdateTest extends DuskTestCase
{

    /**
     * testExample
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://travel-tracker.net')
                ->type("email", "lbalakrishnan@brightsource.co.uk")
                ->type("password", env("TRAVEL_TRACKER_PASSWORD"))
                ->press('Login')
                ->waitForText('Cycle')
                ->select('#selectedJourney', "2")
                ->press("Insert into every journey this week")
                ->waitForReload()
                ->waitForText('Cycle');

            if ((int) $browser->text('.badge') > 0) {

                $response = $browser->visit("https://travel-tracker.net/app/132/user/missingjourneys")
                    ->waitForText('Save');

                var_dump(count($response->elements('select')));

                for ($i = 1; $i <= $response->elements('select'); $i++) {
                    $dropdown = $browser->driver->findElement(WebDriverBy::xpath("(//select)[$i]"));
                    $action = $browser->driver->action();
                    $action->click($dropdown)
                        ->sendKeys($dropdown, "W")
                        ->perform();
                    if ($i == count($response->elements('select'))) {
                        break;
                    }
                }

                $browser->press("Save")
                    ->waitForReload();
            }
        });
    }
}
