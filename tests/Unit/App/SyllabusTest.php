<?php

namespace Test\Unit\App;

use App\School;
use App\Syllabus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyllabusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_syllabuses_are_filter_by_school() {
        $school     = create(School::class);
        $syllabuses = create(Syllabus::class, ['school_id' => $school->id], 2);

        $other_school     = create(School::class);
        $other_syllabuses = create(Syllabus::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Syllabus::bySchool($school->id)->count(), $syllabuses->count());
    }
}
