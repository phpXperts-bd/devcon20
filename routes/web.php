<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::view('/', 'angularbd.app')->name('angularbd.index');

Route::get('get/ticket', 'TicketController@index')->name('buy.ticket');
Route::get('register/sponsor', 'TicketController@showOtherRegistration')->name('register.sponsor');
Route::get('register/guest', 'TicketController@showOtherRegistration')->name('register.guest');
Route::get('register/volunteer', 'TicketController@showOtherRegistration')->name('register.volunteer');

Route::post('get/ticket', 'TicketController@storeAttendee')->name('buy.ticket.post');

//Route::middleware('guest')->get('/attendee/login', 'TicketController@showLoginForm')->name('attendee.login.form');
//Route::middleware('guest')->post('/attendee/login', 'TicketController@attendeeSignIn')->name('attendee.login.post');
//Route::middleware('auth')->get('attendee/update', 'TicketController@showAttendeeForm')->name('attendee.update.form.show');
//Route::middleware('auth')->post('attendee/update', 'TicketController@updateAttendee')->name('attendee.update.form.post');
//Route::get('/attendee/logout', function() {
//    Auth::logout();
//    return redirect('/');
//})->name('attendee.logout');
Route::get('/send-profile-link', 'TicketController@sendProfileUpdateForm')->name('attendee.profile.update.form');
Route::post('/send-profile-link', 'TicketController@sendProfileLink')->name('attendee.send.profile.link');
Route::get('attendee/{code}/update', 'TicketController@showAttendeeForm')->name('attendee.update.form.show');
Route::post('attendee/{code}/update', 'TicketController@updateAttendee')->name('attendee.update.form.post');


Route::get('attendee/{uuid}/verify', 'TicketController@verifyAttendee')->name('attendee.verify');
Route::get('attendee/{uuid}/attend', 'TicketController@approveAttendance')->name('attendee.attend');
Route::get('attendee/search', 'TicketController@searchAttendee')->name('attendee.search');


Route::get('attendee/{email}', 'TicketController@getAttendeeByEmail')->name('attendee.search.email');

Route::get('ticket/payment/{attendee}', 'TicketController@ticketPayment')->name('ticket.payment');

Route::post('payment/success', 'TicketController@paymentSuccessOrFailed')->name('payment.success');
Route::post('payment/failed', 'TicketController@paymentSuccessOrFailed')->name('payment.failed');
Route::post('payment/cancel', 'TicketController@paymentSuccessOrFailed')->name('payment.cancel');


Route::get('qrcode/{attendee}', function (\App\Models\Attendee $attendee) {
    return view('emails.payment.qr_code', compact('attendee'));
});

Route::get('un-paid-sms', function () {
    $attendees = \App\Models\Attendee::where('is_paid', '<>', 1)->get();
    foreach ($attendees as $attendee) {
        \Shipu\MuthoFun\Facades\MuthoFun::message(env('CONFIRM_MESSAGE'), $attendee->mobile)->send();
    }
});

Route::get('/upload/attendees', function () {
    $attendee =  array_map('str_getcsv', file(storage_path('data/attendees.csv')));
    $sponsors =  array_map('str_getcsv', file(storage_path('data/sponsor.csv')));
    $guests = array_map('str_getcsv', file(storage_path('data/guest.csv')));
    unset($attendee[0]);
    unset($sponsors[0]);
    unset($guests[0]);

    $attendees = array_merge([], $attendee, $sponsors, $guests);

    foreach ($attendees as $attendee) {
        $model = new \App\Models\Attendee();
        $typeMap = [
            'Attendee' => 1,
            'Guest' => 2,
            'Sponsor' => 4
        ];

        $model->create([
            'type' => $typeMap[$attendee[0]],
            'name' => $attendee[1],
            'email' => $attendee[2],
            'mobile' => $attendee[3],
            'misc' => [
                'tshirt' => $attendee[4]
            ],
            'is_paid' => $typeMap[$attendee[0]] == 1 ? true: false
        ]);
    }

    echo "done";

});

Route::group([
    'prefix'     => 'devcon20-live',
    'namespace'  => 'Devcon20',
], function () { 
    Route::view('/', 'devcon20.app')->name('devcon20.index');
    Route::get('session/{name}', 'LiveController@index')->name('live.session.title');
    Route::get('speakers', 'LiveController@index')->name('live.session.title');

    Route::middleware('guest')->get('/user/login', 'LiveController@showLoginForm')->name('live.login.form');
    Route::middleware('guest')->post('/user/login', 'LiveController@attendeeSignIn')->name('live.login.post');
    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('live.logout');

});
