<?php

namespace Test\Unit\App;

use App\School;
use App\Account;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_accounts_are_filter_by_school() {
        $school   = create(School::class);
        $accounts = create(Account::class, ['school_id' => $school->id], 2);

        $other_school   = create(School::class);
        $other_accounts = create(Account::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Account::bySchool($school->id)->count(), $accounts->count());
    }
}
