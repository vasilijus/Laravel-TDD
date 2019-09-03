<?php

namespace Tests\Feature;
use App\Concert;
use Carbon\Carbon;

use Tests\TestCase;
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
    public function user_can_view_a_published_concert_listing()
    {
        
        // Arrange

        //Create a concert
        $concert = factory(Concert::class)->states('published')->create([

            'title' => 'The Red Chort',

            'subtitle' => 'with Animosity',

            'date' => Carbon::parse('December 13, 2019 8:00pm'),

            'ticket_price' => 3250,

            'venue' => 'The Mosh Pit',

            'venue_address' => '123 Oxford Road',

            'city' => 'Oxford',

            'state' => 'UK',

            'zip' => '1234',

            'additional_information' => 'for tickets call 0003',

        ]);

        // Act

        // View the concert listing

        $response = $this->get('/concerts/'  . $concert->id);
//dd($response);
        // Assert

        // See the concert details
            //$response->assertok();

        $response->assertSee('The Red Chort');

        $response->assertSee('with Animosity');

        $response->assertSee('December 13, 2019');

        $response->assertSee('32.50');

        $response->assertSee('The Mosh Pit');

        $response->assertSee('123 Oxford Road');

        $response->assertSee('Oxford, UK 1234');

        $response->assertSee('for tickets call 0003');
    }

    function user_cannot_view_unpublished_concert_listing()
    {
        $concert = factory(Concert::class)->state('unpublished')->create();

        $response = $this->get('/concerts/' . $concert->id);

        $response->assertStatus(404);
    }

}
