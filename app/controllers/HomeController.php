<?php

class HomeController extends BaseController {

	public function index()
	{
		return Response::view('home.index', [ 'page' => 'home' ]);
	}

	public function randomPlay()
	{
		$songs = Song::with('album.artist')->orderByRaw('rand()')->limit(15)->get();

		
		return Response::json(UtilsController::songInfo($songs));
	}

}
