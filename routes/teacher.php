<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teachers\Dashboard\StudentsController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function(){

    Route::get('teacher/dashboard', [DashboardController::class, 'teacherDashboard']);

    Route::get('teacher-students', [StudentsController::class, 'index'])->name('teacher-students.index');
    Route::get('teacher-sections', [StudentsController::class, 'sections'])->name('teacher-sections');
    Route::post('attendance', [StudentsController::class, 'attendance'])->name('attendance');
    Route::get('attendance-report', [StudentsController::class, 'attendanceReport'])->name('attendance.report');
    Route::post('attendance-report', [StudentsController::class, 'attendanceSearch'])->name('attendance.search');

});

