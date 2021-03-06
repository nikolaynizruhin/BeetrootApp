<?php

namespace Tests\Feature\Office;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateOfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_create_an_office()
    {
        $this->post(route('offices.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_that_not_accept_privacy_can_not_create_an_office()
    {
        $user = factory(User::class)->states('unacceptable')->create();

        $this->actingAs($user)
            ->post(route('offices.store'))
            ->assertRedirect(route('accept.create'));
    }

    /** @test */
    public function employee_can_not_create_an_office()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->post(route('offices.store'))
            ->assertForbidden();
    }

    /** @test */
    public function guest_can_not_visit_create_office_page()
    {
        $this->get(route('offices.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function employee_can_not_visit_create_office_page()
    {
        $user = factory(User::class)->states('employee')->create();

        $this->actingAs($user)
            ->get(route('offices.create'))
            ->assertForbidden();
    }

    /** @test */
    public function admin_can_visit_create_office_page()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('offices.create'))
            ->assertSuccessful()
            ->assertViewIs('offices.create');
    }

    /** @test */
    public function admin_can_create_an_office()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->raw();

        $this->actingAs($admin)
            ->post(route('offices.store'), $office)
            ->assertSessionHas('status', 'The location was successfully created!');

        $this->assertDatabaseHas('offices', $office);
    }

    /** @test */
    public function office_city_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->raw(['city' => null]);

        $this->actingAs($admin)
            ->from(route('offices.create'))
            ->post(route('offices.store'), $office)
            ->assertRedirect(route('offices.create'))
            ->assertSessionHasErrors('city');
    }

    /** @test */
    public function office_country_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->raw(['country' => null]);

        $this->actingAs($admin)
            ->from(route('offices.create'))
            ->post(route('offices.store'), $office)
            ->assertRedirect(route('offices.create'))
            ->assertSessionHasErrors('country');
    }

    /** @test */
    public function office_address_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->raw(['address' => null]);

        $this->actingAs($admin)
            ->from(route('offices.create'))
            ->post(route('offices.store'), $office)
            ->assertRedirect(route('offices.create'))
            ->assertSessionHasErrors('address');
    }

    /** @test */
    public function country_should_be_a_valid_country_code()
    {
        $admin = factory(User::class)->states('admin')->create();
        $office = factory(Office::class)->raw(['country' => 'wrong']);

        $this->actingAs($admin)
            ->post(route('offices.store'), $office)
            ->assertSessionHasErrors('country');
    }
}
