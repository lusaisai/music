<?php

class Playlist extends \Eloquent {

	// Don't forget to fill this array
	protected $fillable = [ 'name', 'user_id', 'song_ids' ];

	public function user()
	{
		$this->belongsTo('User');
	}

}