<?php 

namespace App\Services;

use App\Traits\YajraTable;
use App\Http\Requests\StudentRequest;
use App\Repositories\StudentRepository;

class StudentService 
{
    use YajraTable;
    private StudentRepository $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get all student for yajra
     * 
     * @return object
     */
    public function handleGetAll(): object
    {
        return $this->StudentMockup($this->repository->getAll());
    }

    /**
     * handle get all school
     * 
     * @return object
     */
    public function handleGetAllStudent(): object
    {
        return $this->repository->getAll();
    }

    /**
     * handle store student
     * 
     * @param StudentRequest $request
     * 
     * @return void
     */
    public function handleStoreStudent(StudentRequest $request): void
    {
        $this->repository->store($request->validated());
    }

    /**
     * handle update student
     * 
     * @param StudentRequest $request
     * @param string $id
     * 
     * @return void
     */
    public function handleUpdateStudent(StudentRequest $request, string $id)
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * handle delete student
     * 
     * @param string id
     * @return bool
     */
    public function handleDeleteStudent(string $id): bool
    {
        return $this->repository->destroy($id);
    }
}