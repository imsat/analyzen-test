<?php

namespace App\Service;


use App\Events\UserSaved;
use App\Interfaces\CrudInterface;
use App\Models\User;

class UserService extends Service implements CrudInterface
{
    private $filePath = '/user';

    /**
     * Get all users.
     *
     * @param $onlyTrashed
     * @return mixed
     */
    public function index($onlyTrashed = null)
    {
        $query = User::latest();
        if ($onlyTrashed) {
            $query->select(['id', 'name', 'deleted_at'])->onlyTrashed();
        } else {
            $query->select(['id', 'name', 'email', 'avatar', 'created_at']);
        }
        return $query->paginate();
    }

    /**
     * Show user
     *
     * @param $user
     * @return void
     */
    public function show($user)
    {
        return $user->load('addresses:id,name,user_id');
    }

    /**
     * Create or update user.
     *
     * @param $data
     * @param $user
     * @return User|null
     */

    public function createOrUpdate($data, $user = null)
    {
        // Avatar upload
        if (data_get($data, 'avatar')) {
            if (!blank($user) && $user->getRawOriginal('avatar')) {
                UploadService::cleanFile($user->getRawOriginal('avatar'));
            }
            $data['avatar'] = UploadService::upload($data['avatar'], $this->filePath);
        }

        // Check exists user
        if (blank($user)) {
            $user = new User();
        }
        $user->fill($data);
        $user->save();
        // Trigger event
        event(new UserSaved($user, $data['addresses']));
        return $user->fresh();
    }

    /**
     * Trash user.
     *
     * @param $user
     * @return true
     */
    public function delete($user)
    {
        // Soft delete a user
        $user->delete();
        return true;
    }

}
