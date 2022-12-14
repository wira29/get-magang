<?php

namespace Database\Seeders;

use App\Models\Role;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array('admin', 'siswa');
        
        foreach($roles as $role){
            Role::create([
                'id'    => Uuid::uuid(),
                'role_name' => $role  
            ]);
        }
    }
}
