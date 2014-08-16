<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminClean extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:clean';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'clean up the database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->musicDir = Config::get( "music.dir" );
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->cleanUp();
	}

	private function cleanUp()
	{
		$this->comment('cleaning up ...');
		$artists = Artist::all();
		foreach ($artists as $artist) {
			$artistDir = $this->musicDir . '/' . $artist->name;
			if ( ! is_dir(static::toSystemCode($artistDir)) ) {
				// clean his/her albums
				$this->cleanAlbums($artist->albums);

				// clean his/her images
				foreach ($artist->images as $image) {
					$this->info('cleaning up ' . static::toSystemCode($image->name));
					$image->delete();
				}

				// clean artist
				$this->info('cleaning up ' . static::toSystemCode($artist->name));
				$artist->delete();
			} else {
				foreach ($artist->albums as $album) {
					$albumDir = $artistDir . '/' . $album->name;
					if (! is_dir(static::toSystemCode($albumDir))) {
						$this->cleanAlbums(array($album));
					} else {
						foreach ($album->songs as $song) {
							$songFile = $albumDir . '/' . $song->file_name;
							if (! is_file(static::toSystemCode($songFile)) ) {
								$this->info('cleaning up ' . static::toSystemCode($song->name));
								$song->delete();
							}
						}
						foreach ($album->images as $image) {
							$imageFile = $albumDir . '/' . $image->name;
							if ( ! is_file(static::toSystemCode($imageFile) )) {
								$this->info('cleaning up ' . static::toSystemCode($image->name));
								$image->delete();
							}
						}
					}
				}

				foreach ($artist->images as $image) {
					$imageFile = $artistDir . '/' . $image->name;
					if ( ! is_file(static::toSystemCode($imageFile) )) {
						$this->info('cleaning up ' . static::toSystemCode($image->name));
						$image->delete();
					}
				}
			}
		}
	}

	private function cleanAlbums($albums)
	{
		foreach ($albums as $album) {
			// clean album's songs/images
			foreach ($album->songs as $song) {
				$this->info('cleaning up ' . static::toSystemCode($song->name));
				$song->delete();
			}
			foreach ($album->images as $image) {
				$this->info('cleaning up ' . static::toSystemCode($image->name));
				$image->delete();
			}
			$this->info('cleaning up ' . static::toSystemCode($album->name));
			$album->delete();
		}
	}

	private function toSystemCode($value)
    {
        $to = Config::get('music.encoding');
        if ( $to == 'utf-8' ) {
            return $value;
        } else {
            return mb_convert_encoding($value, $to, 'utf-8');
        }
    }



	// /**
	//  * Get the console command arguments.
	//  *
	//  * @return array
	//  */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	// /**
	//  * Get the console command options.
	//  *
	//  * @return array
	//  */
	// protected function getOptions()
	// {
	// 	return array(
	// 		array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
	// 	);
	// }

}
