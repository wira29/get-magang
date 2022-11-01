<?php 

namespace App\Services;

use App\Models\Role;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleCreateUser($data): object
    {
        $role = Role::where('role_name', 'siswa')->first();
        $user = [
            'name'  => $data->student_name,
            'username' => str_replace(' ', '_', $data->student_name),
            'password' => bcrypt('password'),
            'role_id'   => $role->id
        ];
        
        // dd($user);
        return $this->repository->store($user);
    }
}