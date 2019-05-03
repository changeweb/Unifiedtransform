<?php

namespace Tests\Feature;

use App\User;
use App\Account;
use App\AccountSector;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountingModuleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $accountant = factory(User::class)->states('accountant')->create();
        $this->actingAs($accountant);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function view_is(){
        $response = $this->get('accounts/sectors');
        $response->assertViewIs('accounts.sector');
    }
    /** @test */
    public function accountant_can_create_sector(){
        $account_sector = factory(AccountSector::class)->make();
        $response = $this->followingRedirects()->post('accounts/create-sector', $account_sector->toArray());
        $response->assertStatus(200);
    }
    /** @test */
    public function accountant_can_view_edit_sector_form(){
        $account_sector = factory(AccountSector::class)->create();
        $response = $this->get('accounts/edit-sector/'.$account_sector->id);
        $response->assertViewIs('accounts.edit_sector');
        $response->assertViewHas(['sector']);
    }
    /** @test */
    public function accountant_can_edit_sector(){
        $request = factory(AccountSector::class)->create();
        $response = $this->followingRedirects()->post('accounts/update-sector/', $request->toArray());
        $response->assertStatus(200);
    }
    /** @test */
    public function accountant_can_view_income_list(){
        $account = factory(Account::class, 10)->create();
        $response = $this->get('accounts/income');
        $response->assertViewIs('accounts.income');
        $response->assertViewHas([
            'sectors',
            //'sections','students'
            ]);
    }
    /** @test */
    public function accountant_can_add_income(){
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
    public function accountant_can_view_expense_list(){
        $account = factory(Account::class, 10)->create();
        $response = $this->get('accounts/expense');
        $response->assertViewIs('accounts.expense');
        $response->assertViewHas([
            'sectors',
            //'sections','students'
            ]);
    }
    /** @test */
    public function accountant_can_add_expense(){
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
