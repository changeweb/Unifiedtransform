<?php

namespace Test\Unit\App;

use App\School;
use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_messages_are_filter_by_school() {
        $school   = create(School::class);
        $messages = create(Message::class, ['school_id' => $school->id], 2);

        $other_school   = create(School::class);
        $other_messages = create(Message::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Message::bySchool($school->id)->count(), $messages->count());
    }
}
