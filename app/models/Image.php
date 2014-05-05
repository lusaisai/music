<?php 

class Image extends Eloquent
{
	protected $guarded = array('id');
	
	public function album()
	{
		return $this->belongsTo('Album');
	}

	public function artist()
	{
		return $this->belongsTo('Artist');
	}
}


