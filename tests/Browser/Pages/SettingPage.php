<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class SettingPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/settings';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
                ->assertSee('Academic Settings')
                ->assertSee('Create Department')
                ->assertSee('Manage Class, Section')
                ->assertSee('+ Add Student')
                ->assertSee('+ Add Teacher')
                ->assertSee('+ Add Accountant')
                ->assertSee('+ Add Librarian')
                ->assertSee('Upload Notice')
                ->assertSee('Upload Event');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
