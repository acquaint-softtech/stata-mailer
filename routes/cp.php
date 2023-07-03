<?php

use Illuminate\Support\Facades\Route;
use AcquaintSofttech\StataMailer\Http\Controllers\SettingsController;


Route::name('stata-mailer.')->prefix('stata-mailer')->group(function () {
    Route::get('/settings', [SettingsController::class, 'edit'])->name('edit');
    Route::post('/settings', [SettingsController::class, 'update'])->name('update');
});
