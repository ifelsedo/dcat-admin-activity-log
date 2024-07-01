<?php

use Ifelsedo\ActivityLog\Http\Controllers;
use Illuminate\Support\Facades\Route;

// Route::get('auth/activity-logs', Controllers\ActivityLogController::class.'@index');

Route::get('auth/activity-logs', Controllers\ActivityLogController::class.'@index')->name('ifelsedo.activity-log.index');
Route::delete('auth/activity-logs/{id}', Controllers\ActivityLogController::class.'@destroy')->name('ifelsedo.activity-log.destroy');
