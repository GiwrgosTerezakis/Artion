<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSystemCalendarController;
use App\Http\Controllers\User\UserSystemCalendarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
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

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/getapidata',[\App\Http\Controllers\TestApi::class,'index'])->name('getapidata');



Auth::routes();

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
    Route::redirect('/', 'user/system-calendar');
    //Route::get('/',[UserController::class,'index'])->name('user');

    Route::get('system-calendar',[UserSystemCalendarController::class,'index'])->name('systemCalendar');
    Route::resource('appointments', '\App\Http\Controllers\User\AppointmentsController');
//    Route::get('calendar',[UserSystemCalendarController::class,'index'])->name('calendar');

   // Route::get('/calendar', 'SystemCalendarController@index')->name('home');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::redirect('/', 'admin/system-calendar');

    //Calendar
    Route::get('system-calendar',[AdminSystemCalendarController::class,'index'])->name('systemCalendar');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Appointments
    Route::delete('appointments/destroy', [AdminSystemCalendarController::class,'destroy'])->name('appointments.destroy');
    Route::resource('appointments', '\App\Http\Controllers\Admin\AppointmentsController');


});
