<?php

namespace App\Observers;

use App\Models\Attendance;
use Faker\Provider\Uuid;

class AttendanceObserver
{
    /**
     * Handle the Attendance "creating" event.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return void
     */
    public function creating(Attendance $attendance)
    {
        $attendance->id = Uuid::uuid();
    }
}
