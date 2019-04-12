<?php

namespace Tests\Unit\App;

use App\Grade;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GradeTest extends TestCase
{
    use RefreshDatabase;
    protected $grade;

    public function setUp() {
        parent::setUp();
        $this->grade = factory(Grade::class)->create();
    }

    /** @test */
    public function a_grade_is_an_instance_of_Grade() {
        $this->assertInstanceOf('App\Grade', $this->grade);
    }

    /** @test */
    public function a_grade_belongs_to_course() {
        $this->assertInstanceOf('App\Course', $this->grade->course);
    }
}
