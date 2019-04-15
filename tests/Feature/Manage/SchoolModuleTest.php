<?php

namespace Tests\Feature\Manage;

use App\School;
use App\Department;
use App\Myclass;
use App\Section;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
    }
    /** @test */
    public function it_shows_the_schools_list() {
        $schools = factory(School::class, 2)->create();
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('schools');
    }
    /** @test */
    public function it_shows_the_teachers_list() {
        $teachers = factory(User::class, 2)->states('teacher')->create();
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('teachers');
    }
    /** @test */
    public function it_shows_the_departments_list() {
        $departments = factory(Department::class, 1)->create();
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('departments');
    }
    /** @test */
    public function it_shows_the_classes_list() {
        $classes = factory(Myclass::class, 1)->create();
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('classes');
    }
    /** @test */
    public function it_shows_the_sections_list() {
        $sections = factory(Section::class, 1)->create();
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('sections');
    }
}
