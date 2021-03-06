<?php

namespace Tests\Unit\Queries;

use App\User;
use Tests\TestCase;
use App\Queries\GenderCountQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenderCountQueryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_gender_count()
    {
        $user = factory(User::class)->create();

        $collection = app(GenderCountQuery::class)();

        $this->assertEquals($collection->first()->gender, $user->gender);
        $this->assertEquals($collection->first()->count, 1);
    }
}
