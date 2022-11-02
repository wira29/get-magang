<?php 

namespace App\Repositories;

use App\Models\Dashboard\Journal;

class JournalRepository extends BaseRepository
{
    public function __construct(Journal $journal)
    {
        $this->model = $journal;
    }

    /**
     * get all journal by student
     * 
     * @param string $id
     * 
     * @return mixed
     */
    public function getAllJournal(string $id): mixed
    {
        return $this->model->query()
            ->where('student_id', $id);
    }
}