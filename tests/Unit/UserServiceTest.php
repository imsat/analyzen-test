<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function test_it_can_list_users()
    {
        // Create some test users
        $users = User::factory()->count(2)->create();

        // Call the index method from the UserService
        $retrievedUsers = $this->userService->index();

        // Assert that the number of retrieved users matches the number of created users.
        $this->assertCount(2, $retrievedUsers);

        // Assert that each retrieved user exists in the collection
        foreach ($users as $user) {
            $this->assertNotNull($retrievedUsers->firstWhere('id', $user->id));
        }
    }

    /**
     * Create new user test.
     */
    public function test_it_can_create_new_user()
    {
        $userInfo = [
            'name' => 'Atif Aslam',
            'email' => 'atif@mail.com',
            'password' => '123456',
        ];

        $user = $this->userService->createOrUpdate($userInfo);

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Atif Aslam', $user->name);
        $this->assertEquals('atif@mail.com', $user->email);
    }

    /**
     * Update user test.
     */
    public function test_it_can_update_user()
    {
        // Create a test users
        $user = User::factory()->create();

        $updatedInfo = [
            'name' => 'Updated Name',
            'email' => 'updatedemail@mail.com',
        ];

        $updatedUser = $this->userService->createOrUpdate($updatedInfo, $user);
        $this->assertEquals('Updated Name', $updatedUser->fresh()->name);
        $this->assertEquals('updatedemail@mail.com', $updatedUser->fresh()->email);
    }

    /**
     * Test user has many relation eager load properly.
     */
    public function test_it_can_eager_load_user_addresses_by_providing_user_instance()
    {
        // Create a test users
        $user = User::factory()->create();
        // Create three test address for that user.
        Address::factory(3)->create(['user_id' => $user->id]);
        $this->assertNotTrue($user->relationLoaded('addresses'));
        $userWithRelationLoad = $this->userService->show($user);
        $this->assertTrue($userWithRelationLoad->relationLoaded('addresses'));
    }

    /**
     * Check soft delete of an user
     */
    public function test_it_can_soft_delete_user()
    {
        // Create a test users
        $user = User::factory()->create();
        $this->userService->delete($user);
        $this->assertSoftDeleted($user);
    }
}
