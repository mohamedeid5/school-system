<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function(){

        Route::get('student/dashboard', function (){
           return view('pages.students.dashboard');
        });
});
