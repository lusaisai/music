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

	public function artists()
	{
		// return Response::json( Artist::all( [ 'name', 'pinyin_name' ] ) );
		return Response::json( DB::table('artists')->select( 'name', 'pinyin_name' )->distinct()->get() );
	}

	public function albums()
	{
		return Response::json( DB::table('albums')->select( 'name', 'pinyin_name' )->distinct()->get() );
	}

	public function songs()
	{
		return Response::json( DB::table('songs')->select( 'name', 'pinyin_name' )->distinct()->get() );
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
	        if (ends_with( $song->file_name, 'mp3' )) {
	        	$tmp["mp3"] = "{$musicUrlPre}/{$song->album->artist->name}/{$song->album->name}/{$song->file_name}";
	        } else {
	        	$tmp["m4a"] = "{$musicUrlPre}/{$song->album->artist->name}/{$song->album->name}/{$song->file_name}";
	        }
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
		$log = Playlog::create([ 'user_id' => ( is_null(Auth::id()) ? -1 : Auth::id() ), 'song_id' => $id ]);
	}
}

