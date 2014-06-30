<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@index'));
Route::get('/home', array('uses' => 'HomeController@index'));
Route::get('/home/randomplay', array('uses' => 'HomeController@randomPlay'));
Route::get('/home/popularsongs/{user}/{timeline}', array('uses' => 'HomeController@popularSongs'));

Route::resource('artists', 'ArtistsController', [ 'only' => ['index'] ]);
Route::resource('albums', 'AlbumsController', [ 'only' => ['index'] ]);
Route::resource('songs', 'SongsController', [ 'only' => ['index'] ]);
Route::resource('playlists', 'PlaylistsController');

Route::get('/utils/artists', array('uses' => 'UtilsController@artists'));
Route::get('/utils/albums', array('uses' => 'UtilsController@albums'));
Route::get('/utils/songs', array('uses' => 'UtilsController@songs'));
Route::get('/utils/songmeta/{songids}', array('uses' => 'UtilsController@songMeta'));
Route::get('/utils/lyric/{songid}', array('uses' => 'UtilsController@lyric'));
Route::post('/utils/stats/{songid}', array('uses' => 'UtilsController@stats'));

// User
Route::get( '/signup', array('uses' => 'UserController@create') );
Route::post( '/signup', array('uses' => 'UserController@store') );

Route::get( '/signin', array('uses' => 'UserController@index') );
Route::post( '/signin', array('uses' => 'UserController@signin') );
Route::get('/signout', array('before' => 'auth', 'uses' => 'UserController@signout'));

Route::get('/user', array('before' => 'auth', 'uses' => 'UserController@show'));

Route::get('/user/editusername', array('before' => 'auth', 'uses' => 'UserController@editusername'));
Route::post('/user/updateusername', array('before' => 'auth', 'uses' => 'UserController@updateusername'));

Route::get('/user/editpassword', array('before' => 'auth', 'uses' => 'UserController@editpassword'));
Route::post('/user/updatepassword', array('before' => 'auth', 'uses' => 'UserController@updatepassword'));

