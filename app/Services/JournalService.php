<?php 

namespace App\Services;

use App\Http\Requests\JournalRequest;
use App\Repositories\JournalRepository;
use App\Traits\YajraTable;

class JournalService 
{
    use YajraTable;

    private JournalRepository $repository;

    public function __construct(JournalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get all journal for yajra
     * 
     * @param string $id
     * 
     * @return object
     */
    public function handleGetAll(string $id): object
    {
        return $this->JournalMockup($this->repository->getAllJournal($id));
    }

    /**
     * handle get all journal
     * 
     * @return object
     */
    public function handleGetAllJournal(): object
    {
        return $this->repository->getAll();
    }

    /**
     * handle store journal
     * 
     * @param JournalRequest $request
     * @param string $id
     * 
     * @return void
     */
    public function handleStoreJournal(JournalRequest $request, string $id): void
    {
        $data = $request->validated();
        $data['student_id'] = $id;

        $this->repository->store($data);
    }

    /**
     * handle update journal
     * 
     * @param JournalRequest $request
     * @param string $id
     * 
     * @return void
     */
    public function handleUpdateJournal(JournalRequest $request, string $id)
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * handle delete journal
     * 
     * @param string id
     * @return bool
     */
    public function handleDeleteJournal(string $id): bool
    {
        return $this->repository->destroy($id);
    }
}