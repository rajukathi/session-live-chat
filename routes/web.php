<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [App\Http\Controllers\AttendanceController::class, 'index']);
    Route::get('/dashboard', [App\Http\Controllers\AttendanceController::class, 'index'])->name('dashboard');
    Route::get('/join-session/{eventId}/{sessionId}', [App\Http\Controllers\AttendanceController::class, 'joinSession'])->name('join-session');
    Route::group(['prefix'=>'events'], function(){
        Route::get('/', [App\Http\Controllers\EventController::class, 'index'])->name('event.index');
        Route::get('/create', [App\Http\Controllers\EventController::class, 'create'])->name('event.create');
        Route::post('/save', [App\Http\Controllers\EventController::class, 'save'])->name('event.save');
        Route::get('/get/{id}', [App\Http\Controllers\EventController::class, 'edit'])->name('event.get');
        Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'delete'])->name('event.delete');
    });

    Route::group(['prefix'=>'sessions'], function(){
        Route::get('/', [App\Http\Controllers\SessionController::class, 'index'])->name('session.index');
        Route::get('/create/{eventId?}', [App\Http\Controllers\SessionController::class, 'create'])->name('session.create');
        Route::post('/save', [App\Http\Controllers\SessionController::class, 'save'])->name('session.save');
        Route::get('/get/{id}', [App\Http\Controllers\SessionController::class, 'edit'])->name('session.get');
        Route::get('/delete/{id}', [App\Http\Controllers\SessionController::class, 'delete'])->name('session.delete');
    });
});


