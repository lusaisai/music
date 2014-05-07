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

Route::resource('artists', 'ArtistsController');
Route::resource('albums', 'AlbumsController');
Route::resource('songs', 'SongsController');
Route::resource('users', 'UsersController');

Route::get('/utils/songmeta/{songids}', array('uses' => 'UtilsController@songMeta'));
Route::get('/utils/lyric/{songid}', array('uses' => 'UtilsController@lyric'));
Route::post('/utils/stats/{songid}', array('uses' => 'UtilsController@stats'));

Route::get( '/signin', array('uses' => 'UsersController@index') );
Route::post( '/signin', array('uses' => 'UsersController@signin') );
Route::get( '/signout', array('uses' => 'UsersController@signout') );



