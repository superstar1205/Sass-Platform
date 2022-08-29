<?php

use App\Install\Http\Controllers\DatabasesController;
use App\Install\Http\Controllers\FilesController;
use App\Install\Http\Controllers\InstallController;
use App\Install\Http\Controllers\MigrationsController;
use App\Install\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;





Route::get('/start', [InstallController::class, 'index'])->name('install.start');
Route::get('/done', [InstallController::class, 'done'])->name('install.done');


Route::name('install.')
    ->group(function () {
        Route::resource('files', FilesController::class);
        Route::resource('databases', DatabasesController::class);
        Route::resource('migrations', MigrationsController::class);
        Route::resource('users', UsersController::class);
    });
