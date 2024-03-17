<?php

namespace Tests\Unit;

use App\Models\User;
use App\Service\TrashService;
use App\Service\UserService;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrashServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $trashService;
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->trashService = new TrashService(new Container());
        $this->userService = new UserService();
    }

    /**
     * Restore from trash.
     */
    public function test_it_can_restore_soft_deleted_a_user()
    {
        // Create a test user
        $user = User::factory()->create();
        $this->userService->delete($user);
        $this->trashService->restoreFromTrash(class_basename($user), $user->id);
        $this->assertFalse($user->fresh()->trashed());
    }

    /**
     * Check exception
     */
    public function test_it_throws_exception_when_restoring_nonexistent_user()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->trashService->restoreFromTrash('user', 111);
    }

    /**
     * Permanently delete of from trash.
     */
    public function test_it_can_permanently_delete_a_user()
    {
        // Create a test user
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        // Soft delete user
        $this->userService->delete($user);
        $this->trashService->deleteFromTrash(class_basename($user), $user->id);
        $this->assertNotInstanceOf(User::class, $user->fresh());
    }
}
