<?php

namespace Database\Seeders;

use App\Models\Dashboard\School;
use App\Models\Dashboard\Student;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = School::firstOrFail();
        $user = User::whereRelation('role', 'role_name', '=', 'siswa')->firstOrFail();

        Student::create([
            'id' => Uuid::uuid(),
            'rfid' => '000142222802145972',
            'student_name' => 'Yudas Malabi',
            'gender' => 'male',
            'school_id' => $school->id,
            'user_id' => $user->id
        ]);
    }
}
