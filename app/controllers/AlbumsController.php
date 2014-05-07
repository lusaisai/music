<?php

class AlbumsController extends \BaseController {

	/**
	 * Display a listing of albums
	 *
	 * @return Response
	 */
	public function index()
	{
		$words = trim( Input::get('words', '') );
		$albums = [];

		if ($words == '') {
			$albums = Album::with('songs', 'images')
					->join( 'artists', 'albums.artist_id', '=', 'artists.id' )
					->select('albums.id', 'albums.name', 'artists.name as artist_name' )
					->orderBy('id', 'desc')
					->paginate(5);
		} else {
			$albums = Album::with('songs', 'images')
					->join( 'artists', 'albums.artist_id', '=', 'artists.id' )
					->where( 'albums.pinyin_name', 'like', '%' . $words . '%' )
					->orWhere( 'artists.pinyin_name', 'like', '%' . $words . '%' )
					->orWhere( 'albums.name', 'like', '%' . $words . '%' )
					->orWhere( 'artists.name', 'like', '%' . $words . '%' )
					->select('albums.id', 'albums.name', 'artists.name as artist_name' )
					->paginate(5);
		}
		
		return View::make('albums.index', [ 'page' => 'albums', 'words' => $words, 'albums' => $albums ]);
	}

}