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
     * get all student for yajra table
     * 
     * @return object
     */
    public function handleGetAll(): object
    {
        return $this->StudentMockup($this->repository->getAllStudent());
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
     * @string $userId
     * 
     * @return void
     */
    public function handleStoreStudent(StudentRequest $request, string $userId): void
    {
        $data = $request->validated();
        $data['user_id'] = $userId;

        $this->repository->store($data);
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

    /**
     * handle get student attendances using yajra
     * 
     * @return object
     */

    public function handleGetAttendances()
    {
        return $this->AttendanceMockup($this->repository->getAllAttendances());
    }

    /**
     * handle get student by id
     * 
     * @param string $id
     * 
     * @return object|null
     */

    public function handleGetAttendanceByStudentId(string $id): object|null
    {
        $date = now()->format('Y-m-d');
        return $this->repository->getAttendanceByStudentId($id, $date);
    }

    /**
     * handle get student by id
     * 
     * @param string $id
     * 
     * @return object|null
     */

    public function handleStudentAttendanceToday(string $id): object|null
    {
        $date = now()->format('Y-m-d');
        return $this->repository->getStudentAttendanceToday($id, $date);
    }
}
