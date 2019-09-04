<?php

use App\Concert;
use Tests\TestCase;
use App\Billing\FakePaymentGateway;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewConcertListingTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function customer_can_purchase_concert_tickets()
    {
        $paymentGateway = new FakePaymentGateway;
        // Arrange

        //Create a concert
        $concert = factory(Concert::class)->create(['ticket_price' => 3250 ]);
        

        // Act

        // View the concert listing
        
        $response = $this->json('POST', "/concerts/{$concert->id}/orders", [
            'email' => 'john@example.com',
            'ticket_quantity' => 3,
            'payment_token' => $paymentGateway->getValidTestToken(),
        ] );


        $this->assertEquals( 9750 , $paymentGateway->totalCharges() );

        $order = $concert->orders()->where('email',)->first();

        $this->$this->assertNotNull($order);

        $this->assertEquals( 3, $order->tickets->count() );
    }


}
