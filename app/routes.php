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

Route::resource('artists', 'ArtistsController');
Route::resource('albums', 'AlbumsController');
Route::resource('songs', 'SongsController');

Route::get('/utils/songmeta/{songids}', array('uses' => 'UtilsController@songMeta'));
Route::get('/utils/lyric/{songid}', array('uses' => 'UtilsController@lyric'));
Route::post('/utils/stats/{songid}', array('uses' => 'UtilsController@stats'));

