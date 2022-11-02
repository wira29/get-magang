<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * find user by id
     * 
     * @param string $id
     * @return object|null
     */
    public function findUser(string $id): object|null
    {
        return $this->model->find($id);
    }
}