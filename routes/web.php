<?php

use App\Http\Controllers\Grades\GradesController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Promotions\PromotionsController;
use App\Http\Controllers\Sections\SectionsController;
use App\Http\Controllers\Parents\ParentsController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Teachers\TeachersController;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\Route;

Route::group(
    [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function(){

    // guest route
    Route::group(['middleware' => 'guest'], function(){
        Auth::routes();
    });

    // auth routes
    Route::group(['middleware' => 'auth'], function(){

        // home route
        Route::get('/', function () {
            return 'home';
        });

        // dashboard route
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        // grades routes
        Route::resource('grades', GradesController::class);

        // classroom routes
        Route::resource('classrooms', ClassroomController::class);

        Route::delete('deleteAll', [ClassroomController::class, 'deleteAll'])->name('classrooms.delete.all');

        Route::get('filter_classes', [ClassroomController::class, 'filterClasses'])->name('classrooms.filter.classes');

        // sections routes
        Route::resource('sections', SectionsController::class);

        Route::get('classes/{id}', [SectionsController::class, 'getClasses'])->name('get.classes');

        // parents route
        Route::resource('parents', ParentsController::class);

        Route::view('add-parent', 'livewire.show-form')->name('add.parent');

        Route::resource('teachers', TeachersController::class);

        Route::resource('students', StudentsController::class);

        Route::get('get-sections/{id}', [StudentsController::class, 'getSections']);

        Route::post('upload_attachments', [StudentsController::class, 'uploadAttachments'])->name('upload.attachments');

        Route::post('delete_attachment', [StudentsController::class, 'deleteAttachment'])->name('delete.attachment');

        Route::get('download_attachment/{id}/{name}', [StudentsController::class, 'downloadAttachment'])->name('download.attachment');

        Route::resource('promotions', PromotionsController::class);


    });

});


