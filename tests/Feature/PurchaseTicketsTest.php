<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Concert;
use App\Billing\FakePaymentGateway; 

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class PurchaseTicketsTest extends TestCase 
{
    use DatabaseMigrations;
    
    /** @test */
    function customer_can_purchase_concert_tickets()
    {
        $paymentGateway = new FakePaymentGateway;

        // Arrange

        // Create Concxert
        $concert = factory(Concert::class)->create(['ticket_price' => 3250]);


        // Act

        // Purchase ticket
        $response = $this->json('POST', "/purchase-tickets/{$concert->id}/orders", [
            'email' => 'sergej@mail.com',
            'ticket_quantity' => 3, 
            'payment_token' => $paymentGateway->getValidTestToken(),
        ]);
            
        // Assert
        $response
            ->assertStatus(201);

        // Make sure the customer was charged the correct ammount
        $this->assertEquals(9750, $paymentGateway->totalCharges() ); // assertEquals($expected, $actual);

        // Make sure taht order exists for this customer
        $order = $concert->orders()->where('email', 'sergej@mail.com')->first();

        $response->assertNull($order); // assertNull($variable);
        
        $response->assertEquals(3, $order->tickets->count() );
    }

}
