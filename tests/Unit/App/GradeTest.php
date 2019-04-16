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
        $this->grade = create(Grade::class);
    }

    /** @test */
    public function a_grade_is_an_instance_of_Grade() {
        $this->assertInstanceOf('App\Grade', $this->grade);
    }

    /** @test */
    public function a_grade_belongs_to_course() {
        $this->assertInstanceOf('App\Course', $this->grade->course);
    }

    /** @test */
    public function a_grade_belongs_to_student() {
        $this->assertInstanceOf('App\User', $this->grade->student);
    }

    /** @test */
    public function a_grade_belongs_to_teacher() {
        $this->assertInstanceOf('App\User', $this->grade->teacher);
    }

    /** @test */
    public function a_grade_belongs_to_exam() {
        $this->assertInstanceOf('App\Exam', $this->grade->exam);
    }
}
