<?php

class HomeController extends BaseController {

	public function index()
	{
		$songs = $this->topSongs( 0, 'all', 10 );
		$keywords = [];
		foreach ($songs as $song) {
			$keywords[] = $song->song_name;
		}
		return Response::view('home.index', [ 'page' => 'home', 'keywords' => implode(',', $keywords) ]);
	}

	public function randomPlay()
	{
		$words = trim( Input::get('words', '') );
		$words = preg_replace('!\s+!', ' ', $words);
		$type = trim( Input::get('type', 'artist-name') );
		$songCount = trim( Input::get('song-number', 15) );
		if ( ! is_numeric($songCount) || $songCount <= 0 ) {
			$songCount = 15;
		}

		$songs = DB::table('songs')
					->join( 'albums', 'songs.album_id', '=', 'albums.id' )
					->join( 'artists', 'albums.artist_id', '=', 'artists.id' )
					;

		if ( $words == '' ) {
		} elseif ( $type == 'artist-name' ) {
			foreach ( explode(' ', $words) as $word ) {
				$songs->orWhere( 'artists.pinyin_name', 'like', '%' . $word . '%' );
				$songs->orWhere( 'artists.name', 'like', '%' . $word . '%' );
			}
		} elseif ( $type == 'album-name' ) {
			$songs->orWhere( 'albums.pinyin_name', 'like', '%' . $words . '%' );
			$songs->orWhere( 'albums.name', 'like', '%' . $words . '%' );
		} elseif ( $type == 'song-name' ) {
			$songs->orWhere( 'songs.pinyin_name', 'like', '%' . $words . '%' );
			$songs->orWhere( 'songs.name', 'like', '%' . $words . '%' );
		}

		$songs = $songs->select('songs.id')->get();
		// $songs = $songs->select('songs.id')->orderByRaw('rand()')->limit(15)->get();

		$ids  = [];
		srand();
		foreach (array_rand( $songs, min($songCount, count($songs)) ) as $choice) {
			$ids[] = $songs[$choice]->id;
		}

		$songdata = UtilsController::songInfo(Song::with('album.artist')->findMany($ids));
		srand();
		shuffle($songdata);
		
		return Response::json( $songdata );
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

	public function topSongs( $userid = 0, $time = "all", $count = 50 )
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
		limit $count
		";
		return DB::select($query);
	}

}
