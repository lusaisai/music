<?php 

class Album extends Eloquent
{
	protected $guarded = array('id');

	public function songs()
	{
		return $this->hasMany('Song');
	}

	public function images()
	{
		return $this->hasMany('Image');
	}

	public function artist()
	{
		return $this->belongsTo('Artist');
	}
}


