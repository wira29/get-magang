<?php 

namespace App\Services;

use App\Repositories\DetailAttendanceRepository;

class DetailAttendanceService 
{
    private DetailAttendanceRepository $repository;

    public function __construct(DetailAttendanceRepository $repository)
    {
        $this->repository = $repository;
    }
}