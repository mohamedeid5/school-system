<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\OnlineClasses\OnlineClassesController;
use App\Http\Controllers\Questions\QuestionsController;
use App\Http\Controllers\Quiz\QuizzesController;
use App\Http\Controllers\Fees\FeeInvoicesController;
use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Fees\FeesTypeController;
use App\Http\Controllers\Fees\PaymentsController;
use App\Http\Controllers\Fees\ProcessingFeesController;
use App\Http\Controllers\Fees\StudentReceiptController;
use App\Http\Controllers\Grades\GradesController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Graduates\GraduatesController;
use App\Http\Controllers\Promotions\PromotionsController;
use App\Http\Controllers\Sections\SectionsController;
use App\Http\Controllers\Parents\ParentsController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Subjects\SubjectsController;
use App\Http\Controllers\Teachers\TeachersController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function(){

    // guest route
   // Route::group(['middleware' => 'guest'], function(){
        //Auth::routes();
    //});


    Route::group(['middleware' => 'guest'], function (){
        Route::get('login/{type}', [LoginController::class, 'loginForm'])->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/', [HomeController::class, 'index'])->name('selection');
    });



    // auth routes
    Route::group(['middleware' => 'auth:student,parent'], function(){

        Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
        // dashboard route
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

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

        Route::resource('graduates', GraduatesController::class);

        Route::resource('fees', FeesController::class);

        Route::resource('fees-type', FeesTypeController::class);

        Route::resource('fee-invoices', FeeInvoicesController::class);

        Route::resource('student-receipts', StudentReceiptController::class);

        Route::resource('processing-fees', ProcessingFeesController::class);

        Route::resource('payments', PaymentsController::class);

        Route::resource('attendance', AttendanceController::class);

        Route::resource('subjects', SubjectsController::class);

        Route::resource('quizzes', QuizzesController::class);

        Route::resource('questions', QuestionsController::class);

        Route::resource('online-classes', OnlineClassesController::class);
        Route::get('indirect', [OnlineClassesController::class, 'indirectCreate'])->name('indirect.create');
        Route::post('indirect', [OnlineClassesController::class, 'indirectStore'])->name('indirect.store');

        Route::resource('library', LibraryController::class);

        Route::get('library/download-attachment/{fileName}', [LibraryController::class, 'downloadAttachment'])->name('library.download.attachment');

        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

    });

});


