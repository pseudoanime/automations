<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class renewLibraryBooksTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit("https://capitadiscovery.co.uk/gloslibraries/login")
                    ->assertSee('Online Library')
                    ->type('barcode', '7704357833')
                    ->type('pin', env('GLO_LIB_PIN'))
                    ->press('Login');

            $browser->waitForText('Hello Lakshmi Balakrishnan')
                ->press("Renew all");
        });
    }
}
