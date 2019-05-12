<?php

namespace Test\Unit\App;

use App\Fee;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_fees_are_filter_by_school() {
        $school = create(School::class);
        $fees   = create(Fee::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_fees   = create(Fee::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Fee::bySchool($school->id)->count(), $fees->count());
    }
}
