<?php

namespace Tests\Browser;

use Nexmo\Laravel\Facade\Nexmo;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VisacheckTest extends DuskTestCase
{
    protected function setUp()
    {
        parent::setUp();
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    /**
     * A Dusk test example.
     *
     * @dataProvider locationProvider
     * @return void
     */
    public function testVisaAppointmentAvailability($location, $code)
    {
        $this->browse(function (Browser $browser) use ($location, $code) {
            $browser->visit(env('VISA_URL'))
                ->type('password', env('VISA_PASSWORD'))
                ->click('input[id="submit"]')
                ->clickLink("< Change Premium service centre")
                ->click('input[id="' . $code . '"]')
                ->click('input[id="submit"]')
                ->waitForText("Choose an appointment");

            $text = $browser->text("#AppointmentBooking");

            if (strpos($text, "We do not have any appointments in the next 45 business days at your selected location") === false) {

                Nexmo::message()->send([
                    'to'   => env('PHONE'),
                    'from' => env('PHONE'),
                    'text' => 'Spot open at ' . $location
                ]);
            }
        });

    }

    public function locationProvider()
    {
        return [
            ['Birmingham', "centreId_PEBI"],
            ['Croydon', "centreId_PCCR"],
            ['Cardiff', "centreId_PECA"],
            ['Sheffield', "centreId_PESH"]
        ];
    }
}
