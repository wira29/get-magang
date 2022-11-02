<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('dashboard.blank');
});

Auth::routes([
    'verify' => false,
    'register' => false,
    'reset' => false
]);

Route::middleware(['auth', 'admin'])->group(function() {
    Route::resources([
        'school'    => SchoolController::class,
        'student'   => StudentController::class
    ]);
    Route::get('/', function () {
        return view('dashboard.blank');
    });
});

Route::middleware(['auth', 'student'])->group(function() {
    Route::post('journal/{journal}', [JournalController::class, 'update'])->name('updateJournal');
    Route::resources([
        'journal'   => JournalController::class
    ]);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
