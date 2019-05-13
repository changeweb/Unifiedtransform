<?php

namespace Test\Unit\App;

use App\School;
use App\Routine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_routines_are_filter_by_school() {
        $school   = create(School::class);
        $routines = create(Routine::class, ['school_id' => $school->id], 2);

        $other_school   = create(School::class);
        $other_routines = create(Routine::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Routine::bySchool($school->id)->count(), $routines->count());
    }
}
