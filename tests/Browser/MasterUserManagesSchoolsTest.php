<?php

namespace Tests\Browser;

use App\User;
use Tests\Browser\Pages\MasterPage;
use Tests\Browser\Pages\SchoolPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MasterUserManagesSchoolsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        $this->master = factory(User::class)->states('master')->create();
    }

    /** @test */
    public function master_user_can_see_list_schools() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->master)
                ->visit(new MasterPage)
                ->clickLink('Manage Schools')
                ->assertSee('School List');
        });
    }

    /** @test */
    public function master_user_creates_school() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->master)
                ->visit(new SchoolPage)
                ->pause(1000)
                ->click('@create-school-button')
                ->pause(1000)
                ->createSchool('Benito Juárez')
                ->assertSee('Benito Juárez');
        });
    }

    /** @test */
    public function master_user_updates_school() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->master)
                    ->visit(new SchoolPage)
                    ->pause(1000)
                    ->click('@edit-school-link')
                    ->pause(1000)
                    ->updateSchool($this->master->school_id, 'New name')
                    ->assertSee('New name');
        });
    }
}
