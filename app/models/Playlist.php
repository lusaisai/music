<?php

class Playlist extends \Eloquent {

	// Don't forget to fill this array
	protected $fillable = [ 'name', 'user_id', 'song_ids' ];

	public function user()
	{
		$this->belongsTo('User');
	}

	public function songs()
	{
		$song_ids = explode(',', $this->song_ids);
		return Song::with('album.artist')->findMany($song_ids)->all();
	}

}