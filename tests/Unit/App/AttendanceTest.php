<?php

namespace Tests\Unit\App;

use App\Attendance;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    protected $attendance;

    public function setUp() {
        parent::setUp();
        $this->attendance = create(Attendance::class);
    }

    /** @test */
    public function an_attendance_is_an_instance_of_Attendance() {
        $this->assertInstanceOf('App\Attendance', $this->attendance);
    }

    /** @test */
    public function an_attendance_belongs_to_student() {
        $this->assertInstanceOf('App\User', $this->attendance->student);
    }

    /** @test */
    public function an_attendance_belongs_to_section() {
        $this->assertInstanceOf('App\Section', $this->attendance->section);
    }

    /** @test */
    public function an_attendance_belongs_to_exam() {
        $this->assertInstanceOf('App\Exam', $this->attendance->exam);
    }
}
