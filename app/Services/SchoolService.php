<?php 

namespace App\Services;

use App\Http\Requests\School\CreateRequest;
use App\Repositories\SchoolRepository;

class SchoolService
{
    private SchoolRepository $repository;

    public function __construct(SchoolRepository $repository)
    {
        $this->repository = $repository;
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
}