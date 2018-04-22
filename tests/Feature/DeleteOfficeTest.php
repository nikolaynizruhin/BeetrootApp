<?php

namespace Tests\Feature;

use App\User;
use App\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteOfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_delete_an_office()
    {
        $office = factory(Office::class)->create();

        $this->delete(route('offices.destroy', $office))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_delete_an_office()
    {
        $office = factory(Office::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->delete(route('offices.destroy', $office))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_an_office()
    {
        $office = factory(Office::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->delete(route('offices.destroy', $office))
            ->assertSessionHas('status', 'The office was successfully deleted!');
    }
}
