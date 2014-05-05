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

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

Route::resource('artist', 'ArtistController');
Route::resource('album', 'AlbumController');
Route::resource('song', 'SongController');

Route::get('/utils/songmeta/{songs}', array('uses' => 'UtilsController@songMeta'));
Route::get('/utils/lyric/{songid}', array('uses' => 'UtilsController@lyric'));
Route::post('/utils/stats/{songid}', array('uses' => 'UtilsController@stats'));

