<?php

namespace Tests\Unit;

use App\User;
use App\Client;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_client()
    {
        $user = factory(User::class)->create();
        $client = Client::first();

        $this->assertInstanceOf(Client::class, $user->client);
        $this->assertEquals($user->client->id, $client->id);
    }

    /** @test */
    public function a_user_has_an_office()
    {
        $user = factory(User::class)->create();
        $office = Office::first();

        $this->assertInstanceOf(Office::class, $user->office);
        $this->assertEquals($user->office->id, $office->id);
    }

    /** @test */
    public function a_user_can_be_an_admin()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->assertTrue($user->is_admin);
    }

    /** @test */
    public function a_user_can_determine_an_avatar()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('avatars/default.png', $user->avatar);

        $user->avatar = 'avatars/me.jpg';

        $this->assertEquals('avatars/me.jpg', $user->avatar);
    }

    /** @test */
    public function a_user_has_a_month_of_birth_attribute()
    {
        $user = factory(User::class)->create(['birthday' => '2000-01-01']);

        $this->assertEquals($user->month_of_birth, 'January');
    }
}
