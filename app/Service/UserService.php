<?php

namespace App\Service;


use App\Interfaces\CrudInterface;
use App\Models\User;

class UserService extends Service implements CrudInterface
{
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
        return $user->load('address:id,name,user_id');
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
        if (blank($user)) {
            $user = new User();
        }
        $user->fill($data);
        $user->save();
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
        $user->delete();
        return true;
    }

}
