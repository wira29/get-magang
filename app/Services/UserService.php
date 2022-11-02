<?php 

namespace App\Services;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\StudentRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $repository;
    private RoleRepository $roleRepository;

    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * handle gegt user by id
     * 
     * @param string $id
     * 
     * @return object
     */
    public function handleGetUserById(string $id): object
    {
        return $this->repository->show($id);
    }

    public function handleUpdateUserById(ProfileRequest $request, string $id): void
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * handle create user
     * @param StudentRequest $request
     * 
     * @return object
     */
    public function handleCreateUser(StudentRequest $request): object
    {
        $data = $request->validated();
        $role = $this->roleRepository->getRoleSiswa();
        $user = [
            'name'  => $data['student_name'],
            'username' => str_replace(' ', '_', $data['student_name']),
            'password' => bcrypt('password'),
            'role_id'   => $role->id
        ];
        
        return $this->repository->store($user);
    }

    /**
     * handel update user
     * @param StudentRequest $request
     * @param string $id
     * 
     * @return void
     */
    public function handleUpdateUser(StudentRequest $request, string $id): void
    {
        $data = $request->validated();
        $user = [
            'name'  => $data['student_name'],
            'username' => str_replace(' ', '_', $data['student_name']),
        ];

        $this->repository->update($id, $user);
    }

    /**
     * handle delete user
     * 
     * @param string $id
     * @return void
     */
    public function handleDeleteUser(string $id): void
    {
        $user = $this->repository->findUser($id);

        if($user){
            $user->delete();
        }
    }
}