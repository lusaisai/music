<?php 

/**
* Utils for various play functionalities
*/
class UtilsController extends \BaseController
{
	public function songMeta($songids = 0) {

	    $songs = Song::with('album.artist')->orderBy(DB::raw("field ( id, $songids )"))->findMany( explode(',', $songids) );
	    
	    return Response::json(static::songInfo($songs));
	}

	public static function songInfo($songs)
	{
		$musicUrlPre = Config::get( "music.url" );	    
	    $songArray = array();

	    foreach ($songs as $song) {
	    	$tmp = array();
	        $tmp["songid"] = $song->id;
	        $tmp["title"] = $song->name;
	        $tmp["song_info"] = "From: " . $song->album->artist->name . " - " . $song->album->name;
	        $tmp["mp3"] = "{$musicUrlPre}/{$song->album->artist->name}/{$song->album->name}/{$song->file_name}";
	        array_push($songArray, $tmp);
	    }

	    return $songArray;
	}

	public function lyric( $songid = 0 )
	{
	    $song = Song::find($songid);
	    if ($song) {
	    	return $song->lrc_lyric;
	    } else {
	    	return '';
	    }
	    
	}

	public function stats($id = 0)
	{
		if ($id) {
			$this->playlog($id);
		}
	}

	private function playlog($id)
	{
		$log = Playlog::create([ 'user_id' => Session::get("userid", -1), 'song_id' => $id ]);
	}
}
