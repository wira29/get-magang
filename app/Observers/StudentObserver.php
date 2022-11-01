<?php

namespace App\Observers;

use App\Models\Dashboard\Student;
use Faker\Provider\Uuid;

class StudentObserver
{
    /**
     * Handle the Student "creating" event.
     *
     * @param  \App\Models\Dashboard\Student  $student
     * @return void
     */
    public function creating(Student $student)
    {
        $student->id = Uuid::uuid();
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  \App\Models\Dashboard\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  \App\Models\Dashboard\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  \App\Models\Dashboard\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  \App\Models\Dashboard\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
