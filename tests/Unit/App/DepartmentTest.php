<?php

namespace Test\Unit\App;

use App\School;
use App\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_departments_are_filter_by_school() {
        $school   = create(School::class);
        $departments = create(Department::class, ['school_id' => $school->id], 2);

        $other_school      = create(School::class);
        $other_departments = create(Department::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Department::bySchool($school->id)->count(), $departments->count());
    }
}
