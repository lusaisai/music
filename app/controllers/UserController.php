<?php

class UserController extends \BaseController {

	/**
	 * The sign in page
	 * @return Response
	 */
	public function index()
	{
		return View::make('user.signin', [ 'page' => 'user' ] );
	}

	/**
	 * The sign in action 
	 * @return Response
	 */
	public function signin()
	{
		if (Auth::attempt(array('email' => Input::get('email', ''), 'password' => Input::get('password', '')), Input::get('rememberme', false))){
		    return Redirect::to('/user');
		} else {
			return Redirect::back()->withInput()->with('error', 'Wrong username/password');
		}
	}

	/**
	 * signout action
	 * @return Response
	 */
	public function signout()
	{
		if (Auth::check()) {
			Auth::logout();
		}

		return Redirect::to('/signin');

	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create', [ 'page' => 'user' ] );
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		DB::beginTransaction();

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = new User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Hash::make( Input::get('password') );
		$user->save();

		DB::commit();

		Auth::login($user);

		return Redirect::to('/user');
	}

	/**
	 * Display the user.
	 * @return Response
	 */
	public function show()
	{
		return View::make('user.show', [ 'page' => 'user' ] );
	}

	/**
	 * Show the form for editing the specified user.
	 * @return Response
	 */
	public function editusername()
	{
		return View::make('user.editusername', [ 'page' => 'user' ] );
	}

	/**
	 * Update the specified resource in storage.
	 * @return Response
	 */
	public function updateusername()
	{
		$user = Auth::user();

		$rules = [ 
			'username' => 'required|unique:users,username,' . $user->id
		];

		DB::beginTransaction();

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		DB::commit();

		return Redirect::to('/user');
	}

	public function editpassword()
	{
		return View::make('user.editpassword', [ 'page' => 'user' ] );
	}

	public function updatepassword()
	{
		$user = Auth::user();

		$rules = [ 
			'oldpassword' => 'required',
			'newpassword' => 'required|min:8|confirmed',
		];

		DB::beginTransaction();

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		} else {
			if ( ! Hash::check(Input::get('oldpassword'), $user->password) ) {
				return Redirect::back()->withErrors( 'The old password is wrong' )->withInput();
			}
		}

		$user->password = Hash::make(Input::get('newpassword'));
		$user->save();

		DB::commit();

		Auth::logout();

		return Redirect::to('/signin');
	}


}