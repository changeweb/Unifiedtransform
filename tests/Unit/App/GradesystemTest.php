<?php

namespace Tests\Unit\App;

use App\Gradesystem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\School;

class GradesystemTest extends TestCase
{
    use RefreshDatabase;

    protected $gradesystem;

    public function setUp() {
        parent::setUp();
        $this->gradesystem = create(Gradesystem::class);
    }

    /** @test */
    public function a_gradesystem_is_an_instance_of_Gradesystem() {
        $this->assertInstanceOf('App\Gradesystem', $this->gradesystem);
    }

    /** @test */
    public function a_gradesystem_belongs_to_school() {
        $this->assertInstanceOf('App\School', $this->gradesystem->school);
    }

    /** @test */
    public function the_gradesystems_are_filter_by_school() {
        $school       = create(School::class);
        $gradesystems = create(Gradesystem::class, ['school_id' => $school->id], 2);

        $other_school       = create(School::class);
        $other_gradesystems = create(Gradesystem::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Gradesystem::bySchool($school->id)->count(), $gradesystems->count());
    }
}
