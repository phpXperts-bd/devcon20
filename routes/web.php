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

