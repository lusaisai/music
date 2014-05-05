<?php 

class Song extends Eloquent
{
	protected $guarded = array('id');
	
	public function album()
	{
		return $this->belongsTo('Album');
	}
}


