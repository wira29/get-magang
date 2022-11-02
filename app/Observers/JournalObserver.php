<?php

namespace App\Observers;

use App\Models\Dashboard\Journal;
use Faker\Provider\Uuid;

class JournalObserver
{
    /**
     * Handle the Journal "creating" event.
     *
     * @param  \App\Models\Dashboard\Journal  $journal
     * @return void
     */
    public function creating(Journal $journal)
    {
        $journal->id = Uuid::uuid();
    }

    /**
     * Handle the Journal "updated" event.
     *
     * @param  \App\Models\Dashboard\Journal  $journal
     * @return void
     */
    public function updated(Journal $journal)
    {
        //
    }

    /**
     * Handle the Journal "deleted" event.
     *
     * @param  \App\Models\Dashboard\Journal  $journal
     * @return void
     */
    public function deleted(Journal $journal)
    {
        //
    }

    /**
     * Handle the Journal "restored" event.
     *
     * @param  \App\Models\Dashboard\Journal  $journal
     * @return void
     */
    public function restored(Journal $journal)
    {
        //
    }

    /**
     * Handle the Journal "force deleted" event.
     *
     * @param  \App\Models\Dashboard\Journal  $journal
     * @return void
     */
    public function forceDeleted(Journal $journal)
    {
        //
    }
}
