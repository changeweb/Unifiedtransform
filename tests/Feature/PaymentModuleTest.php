<?php

namespace Tests\Feature;

use App\User;
use Stripe\Stripe;
use Stripe\Token;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $student = factory(User::class)->states('student')->create();
        $this->actingAs($student);
        $this->withoutExceptionHandling();
        Stripe::setApiKey(env('STRIPE_KEY'));
    }
    /**
     * @test 
     * @return void
     */
    public function student_can_view_payment_page()
    {
        $this->get('stripe/charge')
            ->assertStatus(200)
            ->assertViewIs('stripe.payment')
            ->assertViewHas('fees_fields');
    }
    /**
     * @test 
     * @return void
     */
    // Uncomment after setting Stripe key in .env file
    // public function student_can_pay_amount(){
    //     $stripe_token = Token::create([
    //         'card' => [
    //             'number' => '4242424242424242',
    //             'exp_month' => 5,
    //             'exp_year' => date('Y', strtotime('+1 year')),
    //             'cvc' => '314'
    //         ]
    //     ]);
    //     $amount = 10.50;
    //     $request = [
    //         'stripeToken' => $stripe_token->id,
    //         'amount' => $amount,
    //         'charge_field' => 'Exam Fee',
    //     ];
    //     $this->followingRedirects()->post('stripe/charge', $request)
    //         ->assertStatus(200);
    //     $this->assertDatabaseHas('payments',[
    //         'amount' => $amount,
    //     ]);
    // }
    /**
     * @test 
     * @return void
     */
    public function student_can_view_receipts_page(){
        $this->get('stripe/receipts')
            ->assertStatus(200)
            ->assertViewIs('stripe.receipts')
            ->assertViewHas('receipts');
    }
}
