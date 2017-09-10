<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Avatar file.
     *
     * @var object
     */
    private $file;

    /**
     * User utility.
     *
     * @var object
     */
    private $userUtility;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('avatar.jpg');
        $this->userUtility = resolve(\Tests\Utilities\User::class);
    }

    /**
     * Only user can edit own profile.
     *
     * @return void
     */
    public function testOnlyUserCanEditOwnProfile()
    {
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->put(route('users.update', $owner->id))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->put(route('users.update', $owner->id))
            ->assertStatus(403);
    }

    /**
     * Admin can edit user profile.
     *
     * @return void
     */
    public function testAdminCanEditUserProfile()
    {
        $owner = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes();

        $this->actingAs($admin)
            ->put(route('users.update', $owner->id), $inputAttributes)
            ->assertSessionHas('status', 'The user was successfully updated!');

        $this->assertDatabaseHas('users', $resultAttributes);

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }

    /**
     * User can edit own profile.
     *
     * @return void
     */
    public function testUserCanEditOwnProfile()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        Storage::fake('public');

        $inputAttributes = $this->getInputAttributes();
        $resultAttributes = $this->getResultAttributes();
        $resultAttributes['is_admin'] = false;

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id), $inputAttributes)
            ->assertSessionHas('status', 'The user was successfully updated!');

        $this->assertDatabaseHas('users', $resultAttributes);

        Storage::disk('public')->assertExists('avatars/' . $this->file->hashName());
    }

    /**
     * User fields are required.
     *
     * @return void
     */
    public function testUserFieldsAreRequired()
    {
        $owner = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($owner)
            ->put(route('users.update', $owner->id))
            ->assertSessionHasErrors(['name', 'email', 'position', 'birthday', 'slack', 'client_id', 'office_id']);
    }

    /**
     * Get input attributes.
     *
     * @return array
     */
    private function getInputAttributes()
    {
        $this->userUtility->setAttribute('avatar', $this->file);

        return $this->userUtility->getAttributes();
    }

    /**
     * Get result attributes.
     *
     * @return array
     */
    private function getResultAttributes()
    {
        $this->userUtility->setAttribute('avatar', 'avatars/' . $this->file->hashName());

        return $this->userUtility->getAttributes();
    }
}
