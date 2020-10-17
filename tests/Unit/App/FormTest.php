<?php

namespace Test\Unit\App;

use App\Form;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_forms_are_filter_by_school() {
        $school = create(School::class);
        $forms  = create(Form::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_forms  = create(Form::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Form::bySchool($school->id)->count(), $forms->count());
    }
}
