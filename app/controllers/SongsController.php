<?php

class SongsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$words = trim( Input::get('words', '') );
		$songs = [];

		if ($words == '') {
			$songs = DB::table('songs')
					->join( 'albums', 'songs.album_id', '=', 'albums.id' )
					->join( 'artists', 'albums.artist_id', '=', 'artists.id' )
					->select('songs.id', 'songs.name', 'artists.name as artist_name', 'albums.name as album_name' )
					->orderBy('id', 'desc')
					->paginate(50);
		} else {
			$songs = DB::table('songs')
					->join( 'albums', 'songs.album_id', '=', 'albums.id' )
					->join( 'artists', 'albums.artist_id', '=', 'artists.id' )
					->where( 'songs.pinyin_name', 'like', '%' . $words . '%' )
					->orWhere( 'albums.pinyin_name', 'like', '%' . $words . '%' )
					->orWhere( 'artists.pinyin_name', 'like', '%' . $words . '%' )
					->orWhere( 'songs.name', 'like', '%' . $words . '%' )
					->orWhere( 'albums.name', 'like', '%' . $words . '%' )
					->orWhere( 'artists.name', 'like', '%' . $words . '%' )
					->select('songs.id', 'songs.name', 'artists.name as artist_name', 'albums.name as album_name' )
					->paginate(50);
		}
		
		return View::make('songs.index', [ 'page' => 'songs', 'words' => $words, 'songs' => $songs ]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
