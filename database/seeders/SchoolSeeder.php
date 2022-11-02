<?php

namespace Database\Seeders;

use App\Models\Dashboard\School;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'id'            => Uuid::uuid(),
            'school_name'   => 'SMKN 1 Kepanjen',
            'email'         => 'kanesa@gmail.com',
            'contact'       => '082257181297',
            'address'       => 'Jl, Ngadiluwih, Kedungpedaringan, Kec. Kepanjen, Kabupaten Malang, Jawa Timur 65163'
        ]);
    }
}
