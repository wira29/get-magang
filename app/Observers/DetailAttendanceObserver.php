<?php

namespace App\Observers;

use App\Models\DetailAttendance;
use Faker\Provider\Uuid;

class DetailAttendanceObserver
{
    /**
     * Handle the DetailAttendance "creating" event.
     *
     * @param  \App\Models\DetailAttendance  $detailAttendance
     * @return void
     */
    public function creating(DetailAttendance $detailAttendance)
    {
        $detailAttendance->id = Uuid::uuid();
    }

    /**
     * Handle the DetailAttendance "updated" event.
     *
     * @param  \App\Models\DetailAttendance  $detailAttendance
     * @return void
     */
    public function updated(DetailAttendance $detailAttendance)
    {
        //
    }

    /**
     * Handle the DetailAttendance "deleted" event.
     *
     * @param  \App\Models\DetailAttendance  $detailAttendance
     * @return void
     */
    public function deleted(DetailAttendance $detailAttendance)
    {
        //
    }

    /**
     * Handle the DetailAttendance "restored" event.
     *
     * @param  \App\Models\DetailAttendance  $detailAttendance
     * @return void
     */
    public function restored(DetailAttendance $detailAttendance)
    {
        //
    }

    /**
     * Handle the DetailAttendance "force deleted" event.
     *
     * @param  \App\Models\DetailAttendance  $detailAttendance
     * @return void
     */
    public function forceDeleted(DetailAttendance $detailAttendance)
    {
        //
    }
}
