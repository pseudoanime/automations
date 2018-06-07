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
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://www.dorsetcereals.co.uk/collect-and-win/spin-to-win/')
                ->clickLink('login to play')
                ->type('user_login', env('DORSET_USERNAME'))
                ->click('#tokens-login-email-button')
                ->type('user_password', env('DORSET_PASS'))
                ->click('#tokens-login-password-button');
        });
    }
}
