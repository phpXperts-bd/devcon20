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
    Route::crud('attendee', 'AttendeeCrudController');
    Route::crud('payment', 'PaymentCrudController');
    Route::crud('opening', 'OpeningCrudController');
    Route::get('/opening/attendee/{id}', 'OpeningCrudController@setAttendAt')->name('set.attend_at');
}); // this should be the absolute last line of this file
