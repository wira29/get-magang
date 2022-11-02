<?php 

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * get role siswa
     * 
     * @return object
     */
    public function getRoleSiswa(): object
    {
        return $this->model->query()
            ->where('role_name', 'siswa')
            ->first();
    }
}