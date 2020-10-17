<?php

namespace Test\Unit\App;

use App\Exam;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_exams_are_filter_by_school() {
        $school = create(School::class);
        $exams  = create(Exam::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_exams  = create(Exam::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Exam::bySchool($school->id)->count(), $exams->count());
    }
}
