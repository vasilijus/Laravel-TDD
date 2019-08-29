<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewConcertListingTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function user_can_view_a_concert_listing()
    {
        
        // Arrange

        //Create a concert

        $concert = Concert::create([

            'title' => 'The Red Chort',

            'subtitle' => 'with Animosity',

            'date' => Carbon::parse('December 13, 2019 8:00pm'),

            'ticket_price' => 3250,

            'venue' => 'The Mosh Pit',

            'venue_address' => '123 Oxford Road',

            'city' => 'Oxford',

            'state' => 'UK',

            'zip' => '1234',

            'additional_information' => 'for tickets call 0003'

        ]);

        // Act

        // View the concert listing

        $this->bisit('/concerts/' . $concert->id);

        // Assert

        // See the concert details


        $this->see('The Red Chort');

        $this->see('with Animosity');

        $this->see('December 13, 2019');

        $this->see('32.50');

        $this->see('The Mosh Pit');

        $this->see('123 Oxford Road');

        $this->see('Oxford, UK 1234');

        $this->see('for tickets call 0003');
    }
}
