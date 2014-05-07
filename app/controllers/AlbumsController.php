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

	/**
	 * Show the form for creating a new album
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('albums.create');
	}

	/**
	 * Store a newly created album in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Album::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Album::create($data);

		return Redirect::route('albums.index');
	}

	/**
	 * Display the specified album.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$album = Album::findOrFail($id);

		return View::make('albums.show', compact('album'));
	}

	/**
	 * Show the form for editing the specified album.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$album = Album::find($id);

		return View::make('albums.edit', compact('album'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$album = Album::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Album::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$album->update($data);

		return Redirect::route('albums.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Album::destroy($id);

		return Redirect::route('albums.index');
	}

}