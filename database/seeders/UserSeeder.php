<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        
        foreach($roles as $role){
            User::create([
                'id'    => Uuid::uuid(),
                'name'  => fake()->name(),
                'email' => fake()->safeEmail(),
                'password' => bcrypt('password'),
                'role_id'   => $role->id
            ]);
        }
    }
}
