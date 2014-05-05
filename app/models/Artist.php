<?php 

class Artist extends Eloquent
{
	protected $guarded = array('id');

	public function albums()
	{
		return $this->hasMany('Album');
	}

	public function images()
	{
		return $this->hasMany('Image');
	}
}


