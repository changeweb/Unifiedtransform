<?php

namespace Test\Unit\App;

use App\Event;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_events_are_filter_by_school() {
        $school = create(School::class);
        $events = create(Event::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_events = create(Event::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Event::bySchool($school->id)->count(), $events->count());
    }
}
