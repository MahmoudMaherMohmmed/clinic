<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('api', function (Request $request) {
//     Route::get('/register', 'PassportController@register');
// });

Route::middleware('localization')->group(function () {
    Route::post('login', 'Api\ClientController@login');
    Route::post('register', 'Api\ClientController@register');

    Route::get('specialties', 'Api\SpecialtyController@index');
    Route::get('specialty/{id}', 'Api\SpecialtyController@specialty');
    Route::get('news', 'Api\NewsController@index');
    Route::get('news/{id}/show', 'Api\NewsController@news');

    Route::get('about_clinic', 'Api\AppController@aboutClinic');
    Route::get('center', 'Api\AppController@center');
    Route::get('terms_and_conditions', 'Api\AppController@TermsAndConditions');
    Route::post('contact_email', 'Api\AppController@contactMail');
    Route::get('sliders', 'Api\AppController@sliders');
    Route::get('home_sliders', 'Api\AppController@homeSliders');
    Route::get('banks', 'Api\BankController@index');
    Route::get('application_status', 'Api\AppController@applicationStatus');

    Route::middleware('auth:api')->group(function () {
        Route::get('profile', 'Api\ClientController@profile');
        Route::post('profile/update', 'Api\ClientController@UpdateProfile');
        Route::post('profile/update/image', 'Api\ClientController@updateProfileImage');
        Route::post('profile/update_password', 'Api\ClientController@updatePassword');
        Route::get('appointments', 'Api\AppointmentController@appointments');
        Route::post('day_appointments', 'Api\AppointmentController@dayAppointments');
        route::post('appointment/reserve', 'Api\AppointmentController@reserveAppointment');
        route::post('client/reservations', 'Api\AppointmentController@clientReservations');
        route::get('client/reservations/current', 'Api\AppointmentController@clientCurrentReservation');
        route::get('client/reservations/finished', 'Api\AppointmentController@clientFinishedReservation');
        route::post('client/reservation/cancel', 'Api\AppointmentController@clientReservationCancel');
        route::get('client/reservation/{id}/show', 'Api\AppointmentController@clientReservationShow');
        Route::post('messages', 'Api\MessageController@index');
        Route::post('message/create', 'Api\MessageController@create');
        Route::get('notifications', 'Api\NotificationController@index');
        Route::post('notification/delete', 'Api\NotificationController@delete');

        Route::post('logout', 'Api\ClientController@logout');
    });
});
