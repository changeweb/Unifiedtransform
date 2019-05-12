<?php

namespace Test\Unit\App;

use App\Notice;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoticeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_notices_are_filter_by_school() {
        $school  = create(School::class);
        $notices = create(Notice::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_notices = create(Notice::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Notice::bySchool($school->id)->count(), $notices->count());
    }
}
