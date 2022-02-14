<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| kannel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register kannel routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('get_kannel_details', 'KannelLogsController@sendKannelsLogs')->name('send.kannel.log');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('kannel', 'KannelController');
    Route::get('kannel/{id}/delete', 'KannelController@destroy');
    Route::get('kannel/logs/show', 'KannelLogsController@logs')->name('kannel.logs');
    Route::get('kannels/status', 'KannelLogsController@kannelsStatus')->name('kannels.status');
    Route::get('kannel/log/send_email/{id}', 'KannelLogsController@sendEmail')->name('kannel.log.send_email');
});
