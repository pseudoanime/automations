<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class dorsetCrealsTokensTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_play_token()
    {
        for ($i = 0; $i < 3; $i++) {

            $this->browse(function (Browser $browser) {
                $browser->visit('https://www.dorsetcereals.co.uk/collect-and-win/spin-to-win/')
                    ->clickLink('login to play')
                    ->type('user_login', env('DORSET_USERNAME'))
                    ->click('#tokens-login-email-button')
                    ->pause(1000)
                    ->type('user_password', env('DORSET_PASS'))
                    ->click('#tokens-login-password-button')
                    ->waitForText('hi Lakshmi')
                    ->click('img[src="https://dn3p03babliv5.cloudfront.net/app/uploads/wideimage/90ef5c82e0babf2f261654c5bcd1b2fc.png"]')
                    ->pause(100000);
            });
        }

    }
}
