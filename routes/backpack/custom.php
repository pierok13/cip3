<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index');

    // UCM Routes
    Route::get('ucm/{ucm}/sync', 'UcmCrudController@sync');
    Route::get('ucm/{ucm}/update-realtime', 'UcmCrudController@updateRealtime');
    CRUD::resource('ucm', 'UcmCrudController');

    // Phone Routes
    Route::get('/phone/{phone}/delete-itl', 'PhoneCrudController@deleteItl');
    Route::post('bulk-itl', 'PhoneCrudController@bulkDeleteItl');
    CRUD::resource('phone', 'PhoneCrudController')->with(function() {
        Route::get('/phone/export', 'PhoneCrudController@export');
    });

    // Report Routes
    CRUD::resource('report', 'ReportCrudController');

    CRUD::resource('eraser', 'EraserCrudController');
}); // this should be the absolute last line of this file