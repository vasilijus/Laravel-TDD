<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Concert;
use Carbon\Carbon;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConcertTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     */
    public function can_get_formatted_date()
    {
        // Create a concert with a know date

        $concert = factory(Concert::class)->create([
            'date' => Carbon::parse('2016-12-01 8:00pm'),
        ]);

        // REtrieve the formatted date
        

        // Verify the date if formatted
        $this->assertEquals('December 1, 2016', $concert->formatted_date);
    }

    /**
     * @test
     *
     */
    public function can_get_formatted_start_time()
    {
        $concert = factory(Concert::class)->create([
            'date' => Carbon::parse('2016-12-01 14:12:12'),
        ]);

        // Verify the time is formatted
        $this->assertEquals('2:12pm', $concert->formatted_start_time );
    }
}
