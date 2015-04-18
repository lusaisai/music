<?php

require 'aliyun-php-sdk/aliyun.php';
use \Aliyun\OSS\OSSClient;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminAliyun extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:aliyun';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'update song info from aliyun oss';

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
            $this->aliyunUpdates(true);
        } else {
            $this->aliyunUpdates();
        }
	}

    private function listAliyunFiles()
    {
        $files = [];

        $client = OSSClient::factory(array(
            'AccessKeyId' => Config::get('aliyun.AccessKeyId'),
            'AccessKeySecret' => Config::get('aliyun.AccessKeySecret'),
            'Endpoint' => 'http://oss-cn-shenzhen.aliyuncs.com/',
        ));

        $objectListing = $client->listObjects(array(
            'Bucket' => 'im633-resources',
        ));

        foreach ($objectListing->getObjectSummarys() as $objectSummary) {
            $name = $objectSummary->getKey();
            if (starts_with($name, 'music/')) {
                array_push($files, str_replace('music/', '', $name));
            }
        }

        natsort($files);
        return $files;
    }

    private function aliyunUpdates($fullRefresh = false)
    {
        $this->comment('This may take a while, please wait ...');
        $files = $this->listAliyunFiles();
        foreach ($files as $file) {
            $split = array_filter(explode('/', $file));

            // artists
            if (count($split) == 1) {
                $artistName = $split[0];
                $artist = Artist::firstOrNew( [ 'name' => $artistName ] );
                if ( !$artist->exists || $fullRefresh ) {
                    $artist->pinyin_name = AdminCommand::toPinyin($artistName);
                    $artist->save();
                    $this->info('Updated ' . $artistName);
                }
            }

            // insert albums and artist images
            if (count($split) == 2) {
                $artist = Artist::firstOrNew( [ 'name' => $split[0] ] );

                if (ends_with($split[1], '.jpg')) {
                    $artistImage = $split[1];
                    $image = Image::firstOrNew( [ 'name' => $artistImage, 'artist_id' => $artist->id ] );
                    if ( !$image->exists || $fullRefresh ) {
                        $image->save();
                        $this->info('Updated ' . $artistImage);
                    }
                } else {
                    $albumName = $split[1];
                    $album = Album::firstOrNew( [ 'name' => $albumName, 'artist_id' => $artist->id ] );
                    if ( !$album->exists || $fullRefresh ) {
                        $album->pinyin_name = AdminCommand::toPinyin($albumName);
                        $album->save();
                        $this->info('Updated ' . $albumName);
                    }
                }
            }

            // insert songs and album images
            if (count($split) == 3) {
                $artist = Artist::firstOrNew( [ 'name' => $split[0] ] );
                $album = Album::firstOrNew( [ 'name' => $split[1], 'artist_id' => $artist->id ] );

                if (ends_with($split[2], '.jpg')) {
                    $albumImage = $split[2];
                    $image = Image::firstOrNew( [ 'name' => $albumImage, 'album_id' => $album->id ] );
                    if ( !$image->exists || $fullRefresh ) {
                        $image->save();
                        $this->info('Updated ' . $albumImage);
                    }
                } else {
                    $songName = $split[2];
                    $song = Song::firstOrNew( [ 'file_name' => $songName, 'album_id' => $album->id ] );
                    if ( !$song->exists || $fullRefresh ) {
                        $song->name = AdminCommand::songClean($songName);
                        $song->pinyin_name = AdminCommand::toPinyin($song->name);
                        $song->lrc_lyric = null;
                        $song->save();
                        $this->info('Updated ' . $songName);
                    }
                }
                
            }
        }
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
