<?php

namespace Tests\Feature\Manage;

use App\User;
use App\School;
use App\Myclass;
use App\Section;
use App\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $master = factory(User::class)->states('master')->create();
        $this->actingAs($master);
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_shows_schools_list() {
        $this->get(route('schools.index'))
           ->assertStatus(200)
            ->assertViewIs('schools.index');
    }

    /** @test */
    public function it_creates_a_new_school() {
        $school = make(School::class);

        $this->post(route('schools.store'), $school->toArray())
            ->assertRedirect(route('schools.index'));
    }

    /** @test */
    public function it_shows_edit_school() {
        $school = create(School::class);

        $this->get(route('schools.edit', $school))
            ->assertStatus(200)
            ->assertViewIs('schools.edit');
    }

    /** @test */
    public function a_school_can_being_edited() {
        $school = create(School::class, ['name' => 'Benito Juárez']);

        $school->name = 'New name';

        $this->from(route('schools.edit', $school->id))
            ->put(route('schools.update', $school->id), $school->toArray())
            ->assertRedirect(route('schools.index'));
    }

}
