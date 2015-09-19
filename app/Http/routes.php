<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Require authentication
Route::group(['middleware' => 'auth'], function () {

	Route::get('/', ['as' => 'dashboard', 'uses' =>'PagesController@dashboard']);

	Route::resource('clients', 'ClientsController');

    Route::resource('clients.websites', 'WebsitesController');

	Route::resource('users', 'UsersController');

    //Route::get('tickets/{ticket}/close', ['as' => 'tickets.close', 'uses' => 'TicketsController@close']);
    //Route::get('tickets/{ticket}/open', ['as' => 'tickets.open', 'uses' => 'TicketsController@open']);
	Route::resource('tickets', 'TicketsController');

	Route::resource('tickets.comments', 'TicketCommentsController');

    Route::resource('uploads', 'UploadsController', ['except' => ['create', 'show', 'edit', 'update']]);

});