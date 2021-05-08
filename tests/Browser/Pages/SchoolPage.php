<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class SchoolPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/schools';
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
                ->assertSee('School List');
    }

    /**
     * Create a new school.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @return void
     */
    public function createSchool(Browser $browser, $name)
    {
        $browser->assertSee('Create School')
            ->type('name', $name)
            ->select('medium', 'Bangla')
            ->type('established', 'established')
            ->type('about', 'about')
            ->assertSelected('medium', 'Bangla')
            ->press('Save changes');
    }

    /**
     * Update a school.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  int  $id
     * @param  string  $name
     * @return void
     */
    public function updateSchool(Browser $browser, $id, $name)
    {
        $browser->assertPathIs("/schools/{$id}/edit")
            ->type('name', $name)
            ->type('about', 'about')
            ->press('Save');
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
