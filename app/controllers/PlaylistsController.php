<?php

class PlaylistsController extends \BaseController {

	function __construct() {
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of playlists
	 *
	 * @return Response
	 */
	public function index()
	{
		$playlists = Playlist::where('user_id', '=', Auth::user()->id )->paginate(10);

		return View::make('playlists.index', [ 'page' => 'user', 'playlists' => $playlists ]);
	}

	/**
	 * Show the form for creating a new playlist
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('playlists.create');
	}

	/**
	 * Store a newly created playlist in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = [
			'name' => 'required|unique:playlists,name,NULL,user_id,user_id,' . Auth::user()->id,
			'song_ids' => 'required',
		];

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails())
		{
			$message =  implode('<br/>', $validator->errors()->all());

			return Response::make($message, 400);
		}

		$playlist = new Playlist($data);
		$playlist->user_id = Auth::user()->id;
		$playlist->save();

		return Response::make();
	}

	/**
	 * Display the specified playlist.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$playlist = Playlist::findOrFail($id);

		return View::make('playlists.show', compact('playlist'));
	}

	/**
	 * Show the form for editing the specified playlist.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$playlist = Playlist::find($id);

		return View::make('playlists.edit', compact('playlist'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$playlist = Playlist::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Playlist::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$playlist->update($data);

		return Redirect::route('playlists.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Playlist::destroy($id);

		return Response::make('');
	}

}