<?php

use App\Notifications\LessonPublished;
use App\Notifications\PaymentRecieved;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('slack', function () {
    $admin = App\User::find(1);
    $user = App\User::find(2);
    
    $admin->notify(new PaymentRecieved($user));
});

Route::get('email', function () {
    $user = App\User::find(2);
    
    $user->notify(new LessonPublished());   
});

Auth::routes();

Route::get('/home', 'HomeController@index');
