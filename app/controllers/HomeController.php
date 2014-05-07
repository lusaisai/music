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

	public function popularSongs( $user = "all", $time = "all")
	{
		// if ($user == "user" && Session::get( "isLogin", false ) ) {
		// 	$userid = Session::get( "userid", 0 );
		// } else {
		// 	$userid = 0;
		// }

		return Response::json($this->topSongs( 0, $time ));

	}

	public function topSongs( $userid = 0, $time = "all" )
	{
		switch ($time) {
			case 'week':
				$backdays = 7;
				break;
			case 'month':
				$backdays = 30;
				break;
			default:
				$backdays = 365 * 100;
				break;
		}

		$query = "select l.song_id, s.name as song_name, count(*) as cnt
		from playlogs l
		join songs s
		on   l.song_id = s.id
		where date(l.play_ts) >= date_sub( CURRENT_DATE, interval $backdays day )
		";
		if ($userid) {
			$query .= " and l.user_id = $userid ";
		}
		$query .= " group by 1,2
		order by cnt desc
		limit 30
		";
		return DB::select($query);
	}

}
