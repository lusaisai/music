<?php

class HomeController extends BaseController {

	public function index()
	{
		return Response::view('layouts.master', [ 'page' => 'home' ]);
	}

}
