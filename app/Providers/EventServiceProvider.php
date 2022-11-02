<?php

namespace App\Providers;

use App\Models\Attendance;
use App\Models\Dashboard\Journal;
use App\Models\User;
use App\Models\Dashboard\School;
use App\Models\Dashboard\Student;
use App\Models\DetailAttendance;
use App\Observers\AttendanceObserver;
use App\Observers\DetailAttendanceObserver;
use App\Observers\JournalObserver;
use App\Observers\SchoolObserver;
use App\Observers\StudentObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        School::observe(SchoolObserver::class);
        Student::observe(StudentObserver::class);
        User::observe(UserObserver::class);
        Journal::observe(JournalObserver::class);
        Attendance::observe(AttendanceObserver::class);
        DetailAttendance::observe(DetailAttendanceObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
