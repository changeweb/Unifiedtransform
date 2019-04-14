<?php

namespace Tests\Feature;

use App\User;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolModuleTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_shows_the_schools_list() {
        $school = factory(School::class)->create();
        $user   = factory(User::class)->states('admin')->create();

        $this->actingAs($user);

        $this->withoutExceptionHandling();
        $this->get('/schools')
            ->assertStatus(200)
            ->assertSee($school->name);
    }
}
