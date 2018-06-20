<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * Class dorsetCrealsTokensTest
 *
 * @package Tests\Browser
 */
class dorsetCrealsTokensTest extends DuskTestCase
{
    /**
     * test_play_token
     *
     * @dataProvider callProvider
     * @throws \Throwable
     */
    public function test_play_token()
    {
        try {
            $this->browse(function (Browser $browser) {
                $browser->visit('https://www.dorsetcereals.co.uk/collect-and-win/spin-to-win/')
                    ->clickLink('login to play')
                    ->type('user_login', env('DORSET_USERNAME'))
                    ->click('#tokens-login-email-button')
                    ->waitForText('Password')
                    ->type('user_password', env('DORSET_PASS'))
                    ->click('#tokens-login-password-button')
                    ->waitForText('hi Lakshmi')
                    ->click('img[alt="play spin"]')
                    ->pause(100);
            });
        } catch (\Exception $e) {
            
        }

    }

    /**
     * callProvider
     *
     * @return array
     */
    public function callProvider()
    {
        return [
            [],
            [],
            []
        ];
    }
}
