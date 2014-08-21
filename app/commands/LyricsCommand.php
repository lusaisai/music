<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LyricsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:lyrics';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Search and update song lyrics';

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
		$path = app_path();
		$jar = $path .'/LyricSearch/target/LyricSearch-1.0-SNAPSHOT-jar-with-dependencies.jar';
		system('chcp 65001');
		system( "java -Dfile.encoding=UTF-8 -jar $jar");
	}

}
