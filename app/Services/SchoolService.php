<?php 

namespace App\Services;

use App\Http\Requests\School\CreateRequest;
use App\Http\Requests\School\UpdateRequest;
use App\Repositories\SchoolRepository;
use App\Traits\YajraTable;

class SchoolService
{
    use YajraTable;
    private SchoolRepository $repository;

    public function __construct(SchoolRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get all schools
     * 
     * @return object
     */
    public function handleGetAll(): object
    {
        return $this->SchoolMockup($this->repository->getAll());
    }

    /**
     * handle store school
     * 
     * @param CreateRequest $request
     * 
     * @return void
     */
    public function handleStoreSchool(CreateRequest $request): void
    {
        $this->repository->store($request->validated());
    }

    /**
     * handle update school
     * 
     * @param UpdateRequest $request
     * @param string $id
     * 
     * @return void
     */
    public function handleUpdateSchool(UpdateRequest $request, string $id)
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * handle delete school
     * 
     * @param string id
     * @return bool
     */
    public function handleDeleteSchool(string $id): bool
    {
        return $this->repository->destroy($id);
    }
}