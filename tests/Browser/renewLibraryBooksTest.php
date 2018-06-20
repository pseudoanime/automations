<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class renewLibraryBooksTest
 *
 * @package Tests\Browser
 */
class renewLibraryBooksTest extends DuskTestCase
{

    /**
     * testRenew
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testRenew()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("https://capitadiscovery.co.uk/gloslibraries/login")
                    ->assertSee('Online Library');

            if ($browser->element('#prefix-overlay-header > button')) {
                $browser->press("No thanks");
            }

            $browser->type('barcode', '7704357833')
                    ->type('pin', env('GLO_LIB_PIN'))
                    ->press('Login');

            $browser->waitForText('Hello Lakshmi Balakrishnan')
                ->press("Renew all");
        });
    }
}
