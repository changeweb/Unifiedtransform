<?php

namespace Tests\Unit\App;

use App\School;
use App\Myclass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyclassTest extends TestCase
{
    use RefreshDatabase;

    protected $class;

    public function setUp() {
        parent::setUp();
        $this->class = create(Myclass::class);
    }

    /** @test */
    public function a_class_is_an_instance_of_Myclass() {
        $this->assertInstanceOf('App\Myclass', $this->class);
    }

    /** @test */
    public function a_class_belongs_to_school() {
        $this->assertInstanceOf('App\School', $this->class->school);
    }

    /** @test */
    public function a_class_has_sections() {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->class->sections
        );
    }

    /** @test */
    public function a_class_has_books() {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->class->books
        );
    }

    /** @test */
    public function my_class_are_filter_by_school() {
        $school = factory(School::class)->create();
        $klass  = factory(Myclass::class, 2)->create([
            'school_id' => $school->id
        ]);

        $other_school = factory(School::class)->create();
        $other_klass  = factory(Myclass::class, 4)->create([
            'school_id' => $other_school->id
        ]);

        $this->assertEquals(Myclass::bySchool($school->id)->count(), $klass->count());
    }
}
