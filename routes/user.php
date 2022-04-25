<?php

use App\Http\Controllers\UserDashboardController;

Route::group(['middleware' => ['auth', 'role:user']], function () {
    //user dashboard route 
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});
