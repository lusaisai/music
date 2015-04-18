<?php

require 'aliyun-php-sdk/aliyun.php';

use \Aliyun\OSS\OSSClient;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class AdminCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:refresh';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh music database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $value = $this->option('full-refresh');
        if ($value) {
            $this->update(true);
        } else {
            $this->update();
        }
        
	}


	/**
	 * Go thru the file system and update the database 
	 *
	 * @return mixed
	 */
	private function update($fullRefresh = false)
	{
		$this->comment('This may take a while, please wait ...');
		$musicDir = Config::get( "music.dir" );

        DB::beginTransaction();

		chdir($musicDir);
        $artists = scandir('.');
        natsort($artists);
        foreach ($artists as $artistName) {
			// artists
        	if ( $artistName == "." || $artistName == ".." || ! is_dir($artistName) ) continue;
        	$artist = Artist::firstOrNew( [ 'name' => static::toUTF8($artistName) ] );
        	if ( !$artist->exists || $fullRefresh ) {
        		$artist->pinyin_name = static::toPinyin(static::toUTF8($artistName));
        		$artist->save();
        		$this->info('Updated ' . $artistName);
        	}
        	

        	// insert albums and artist images
            chdir($artistName); 
        	$albums = scandir('.');
            natsort($albums);
        	
        	foreach ( $albums as $albumName ) {
        		if ( $albumName == "." || $albumName == ".." ) continue;

        		if (is_dir($albumName)) {
        			$album = Album::firstOrNew( [ 'name' => static::toUTF8($albumName), 'artist_id' => $artist->id ] );
        			if ( !$album->exists || $fullRefresh ) {
        				$album->pinyin_name = static::toPinyin(static::toUTF8($albumName));
        				$album->save();
        				$this->info('Updated ' . $albumName);
        			}
        			

        			// insert songs and album images
                    chdir($albumName); 
        			$songs = scandir('.');
                    natsort($songs);
        			foreach ( $songs as $songName ) {
        				if ( $songName == "." || $songName == ".." ) continue;

        				if ( static::isSong(static::toUTF8($songName)) ) {
        					$song = Song::firstOrNew( [ 'file_name' => static::toUTF8($songName), 'album_id' => $album->id ] );
        					if ( !$song->exists || $fullRefresh ) {
        						$song->name = static::songClean(static::toUTF8($songName));
        						$song->pinyin_name = static::toPinyin($song->name);
        						$song->lrc_lyric = null;
        						$song->save();
        						$this->info('Updated ' . $songName);
        					}
        					
        				} elseif (static::isImage(static::toUTF8($songName))) {
        					$albumImage = $songName;
        					$image = Image::firstOrNew( [ 'name' => static::toUTF8($albumImage), 'album_id' => $album->id ] );
        					if ( !$image->exists || $fullRefresh ) {
        						$image->save();
        						$this->info('Updated ' . $albumImage);
        					}
                            // static::createThumbs($albumImage);
        				}
        			}
                    chdir("..");

        		} elseif( static::isImage(static::toUTF8($albumName)) ) {
        			$artistImage = $albumName;
                    $image = Image::firstOrNew( [ 'name' => static::toUTF8($artistImage), 'artist_id' => $artist->id ] );
                    if ( !$image->exists || $fullRefresh ) {
                    	$image->save();
                    	$this->info('Updated ' . $artistImage);
                    }

                    // static::createThumbs($artistImage);
        		}
        	}
            chdir("..");
    	}
    	DB::commit();
	}

	public static function toPinyin($word='')
    {
        $pinyin = [ '' ];

        foreach (static::mbSplit($word) as $char) {
            $map = DB::table('pinyin_maps')
            				->where('chinese_word', $char)
                            ->first()
            				;
            if (! $map) {

                $pinyin = static::pinyinConcat($pinyin, [$char]);
                continue;
            }

            $possiable_pinyins = [];

            if ($map->pinyin1) {
                $possiable_pinyins[] = $map->pinyin1;
            }
            if ($map->pinyin2) {
                $possiable_pinyins[] = $map->pinyin2;
            }
            if ($map->pinyin3) {
                $possiable_pinyins[] = $map->pinyin3;
            }

            $pinyin = static::pinyinConcat($pinyin, $possiable_pinyins);
        }

        return substr( implode(',', $pinyin), 0, 255 );
    }

    private static function pinyinConcat($data, $append)
    {
        $newData = [];
        foreach ($data as $value) {
            foreach ($append as $addedPinyin) {
                $newData[] = $value . $addedPinyin;
            }
        }
        return $newData;
    }

    private static function mbSplit($word)
    {
        return preg_split('/(?<!^)(?!$)/u', $word );
    }

    public static function songClean($value)
    {
        $value = trim( preg_replace('/\.[^.]*$/', '', $value) ); // remove file extension
        $value = trim( preg_replace('/^.*-/', '', $value) );
        $value = trim( preg_replace('/[0-9]+[. ]/', '', $value) );
        $value = trim( preg_replace('/\[.*\]/', '', $value) );
        $value = trim( preg_replace('/【.*】/', '', $value) );
        $value = trim( preg_replace('/\(.*\)/', '', $value) );
        $value = trim( preg_replace('/（.*）/', '', $value) );
        $value = trim( preg_replace('/\.[^.]*$/', '', $value) );

        return $value;
    }

	private static function isImage($name)
	{
		return $name != "AlbumArtSmall.jpg" && $name != "Folder.jpg" && preg_match('/(jpg|jpeg|png)$/', $name); // tmp solution to skip winodws thumbnail
	}

	private static function isSong($name)
	{
		return preg_match('/(mp3|m4a)$/i', $name);
	}

    private function toUTF8($value)
    {
        $from = Config::get('music.encoding');
        if ( $from == 'utf-8' ) {
            return $value;
        } else {
            return mb_convert_encoding($value, 'utf-8', $from);
        }
    }

    private static function createThumbs($name, $overwrite = false)
    {
        $newImgName = $name . ".tm.gif";
        if( file_exists($newImgName) && ! $overwrite ) return;

        $img = imagecreatefromjpeg($name);
        $width = imagesx( $img );
        $height = imagesy( $img );

        $size = 120;
        if ($width > $height) {
            $new_width = $size;
            $new_height = floor( $height * ( $size / $width ) );
        } else {
            $new_height = $size;
            $new_width = floor( $width * ( $size / $height ) );
        }
        $tmp_img = imagecreatetruecolor( $new_width, $new_height );
        imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
        imagejpeg( $tmp_img, $newImgName, 100 );
    }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('full-refresh', null, InputOption::VALUE_NONE, 'Refresh the whole database', null),
		);
	}

}
