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
			$songs = Song::with('album.artist')->orderBy('id', 'desc')->paginate(50);
		} else {
			$songs = Song::with('album.artist')
					->where( 'pinyin_name', 'like', '%' . $words . '%' )
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
