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

	public function albumUrl()
	{
		return Config::get('music.url') . "/{$this->album->artist->name}/{$this->album->name}/{$this->name}";
	}

	public function artistUrl()
	{
		return Config::get('music.url') . "/{$this->artist->name}/{$this->name}";
	}
}


