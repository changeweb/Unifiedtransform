<?php

namespace Tests\Feature;

use App\User;
use App\Account;
use function route;
use Tests\TestCase;
use App\AccountSector;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountingModuleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent ::setUp();
        $accountant = factory(User::class)->states('accountant')->create();
        $this->actingAs($accountant);
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function view_is()
    {
        $this->get(route('accounts.sectors.index'))
              ->assertViewIs('accounts.sector');
    }

    /** @test */
    public function accountant_can_create_sector()
    {
        $account_sector = factory(AccountSector::class)->raw();
        $this->followingRedirects()->post(route('accounts.sectors.create'), $account_sector)
              ->assertStatus(200);
    }

    /** @test */
    public function accountant_can_view_edit_sector_form()
    {
        $account_sector = factory(AccountSector::class)->create();
        $this->get(route('accounts.sectors.edit', $account_sector->id))
              ->assertViewIs('accounts.edit_sector')
              ->assertViewHas(['sector']);
    }

    /** @test */
    public function accountant_can_edit_sector()
    {
        $account_sector = factory(AccountSector::class)->create();
        $attributes = [
            'name' => $account_sector->name.'_change',
        ];
        $this->followingRedirects()
              ->patch(route('accounts.sectors.update', $account_sector->id), $attributes)
              ->assertStatus(200);
        $this->assertDatabaseHas('account_sectors', $attributes);
    }

    /** @test */
    public function accountant_can_view_income_list()
    {
        $account = factory(Account::class, 10)->create();
        $response = $this->get('accounts/income');
        $response->assertViewIs('accounts.income');
        $response->assertViewHas([
            'sectors',
            //'sections','students'
        ]);
    }

    /** @test */
    public function accountant_can_add_income()
    {
        $request = factory(Account::class)->make();
        $this->followingRedirects()
              ->post('accounts/create-income', $request->toArray())
              ->assertStatus(200);
        $this->assertDatabaseHas('accounts', [
            'name' => $request->name,
            'amount' => $request->amount,
        ]);
    }

    /** @test */
    public function accountant_can_view_expense_list()
    {
        $account = factory(Account::class, 10)->create();
        $response = $this->get('accounts/expense');
        $response->assertViewIs('accounts.expense');
        $response->assertViewHas([
            'sectors',
            //'sections','students'
        ]);
    }

    /** @test */
    public function accountant_can_add_expense()
    {
        $request = factory(Account::class)->make();
        $this->followingRedirects()
              ->post('accounts/create-expense', $request->toArray())
              ->assertStatus(200);
        $this->assertDatabaseHas('accounts', [
            'name' => $request->name,
            'amount' => $request->amount,
        ]);
    }
}
