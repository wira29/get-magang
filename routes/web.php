<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
});

Auth::routes([
    'verify' => false,
    'register' => false,
    'reset' => false
]);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resources([
        'school'    => SchoolController::class,
        'student'   => StudentController::class
    ]);
    Route::name('attendance.')->prefix('attendance')->group(function () {
        Route::get('/', [StudentController::class, 'attendanceToday'])->name('today');
        Route::get('/{student}', [StudentController::class, 'attendanceDetail'])->name('detail');
        Route::post('/{attendance}', [AttendanceController::class, 'editStatus'])->name('editAttendance');
    });
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::post('journal/{journal}', [JournalController::class, 'update'])->name('updateJournal');
    Route::resources([
        'journal'   => JournalController::class
    ]);
});

Route::middleware('auth')->group(function () {
    Route::name('profile.')->group(function () {
        Route::get('profile', [UserController::class, 'index'])->name('index');
        Route::post('profile/{users}', [UserController::class, 'updateUser'])->name('update');
        Route::post('reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
