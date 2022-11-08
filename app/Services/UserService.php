<?php

namespace App\Services;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\StudentRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;

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
     * handle get user by id
     * 
     * @param string $id
     * 
     * @return object
     */
    public function handleGetUserById(string $id): object
    {
        return $this->repository->show($id);
    }

    /**
     * handle update user by id
     * 
     * @param ProfileRequest $request
     * @param string $id
     * 
     * @return void
     */

    public function handleUpdateUserById(ProfileRequest $request, string $id): void
    {
        $show = $this->repository->show($id);

        $this->repository->update($id, $request->validated());

        if ($request->hasFile('photo')) {
            if (!is_null($show->photo)) {
                Storage::delete('public/' . $show->photo);
            }
            $show->update([
                'photo' => $request->file('photo')->store('user_photo', 'public')
            ]);
        }
    }

    /**
     * handle update password user by id
     * 
     * @param ProfileRequest $request
     * @param string $id
     * 
     * @return void
     */

    public function handleUpdatePasswordUserById(ProfileRequest $request, string $id): void
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $this->repository->update($id, $data);
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
     * handle update user
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

        if ($user) {
            $user->delete();
        }
    }
}
