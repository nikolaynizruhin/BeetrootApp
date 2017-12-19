<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Utilities\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    /** @test */
    public function it_can_get_all_countries()
    {
        $countries = Country::all();

        $this->assertEquals(count($countries), 237);
        $this->assertEquals($countries[0], 'Afghanistan');
    }

    /** @test */
    public function it_can_get_a_csv_of_countries()
    {
        $countries = Country::csv();

        $this->assertEquals(strpos($countries, 'Afghanistan'), 0);
    }

    /** @test */
    public function it_can_get_a_random_country()
    {
        $country = Country::rand();

        $this->assertTrue(in_array($country, Country::all()));
    }
}
