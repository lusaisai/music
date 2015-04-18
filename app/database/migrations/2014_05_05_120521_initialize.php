<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initialize extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlogs', function($table)
		{
			$table->integer('song_id');
			$table->integer('user_id');
			$table->timestamp('play_ts')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->index('song_id');
			$table->index('user_id');
			$table->index('play_ts');
		});

		Schema::create('pinyin_maps', function($table)
		{
			$table->increments('id');
			$table->string('chinese_word');
			$table->string('all_pinyin');
			$table->string('pinyin1');
			$table->string('pinyin2');
			$table->string('pinyin3');
			$table->string('pinyin4');
			$table->string('pinyin5');
			$table->string('pinyin6');
			$table->index('chinese_word');
		});

		Schema::create('playlists', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('user_id')->default(-1);
			$table->text('song_ids');
			$table->timestamps();
			$table->index('user_id');
		});

		Schema::create('poems', function($table)
		{
			$table->increments('id');
			$table->text('content');
			$table->string('poet');
		});

		Schema::create('artists', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('pinyin_name');
			$table->timestamps();
		});

		Schema::create('albums', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('pinyin_name');
			$table->integer('artist_id');
			$table->timestamps();
			$table->index('artist_id');
		});

		Schema::create('songs', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('file_name');
			$table->string('pinyin_name');
			$table->integer('album_id');
			$table->text('lrc_lyric')->nullable();
			$table->timestamps();
			$table->index('album_id');
		});

		Schema::create('images', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('artist_id')->default(0);
			$table->integer('album_id')->default(0);
			$table->timestamps();
			$table->index('artist_id');
			$table->index('album_id');
		});

		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->string('email');
			$table->string('remember_token')->nullable();
			$table->timestamps();
		});

		Schema::create('cache', function($table)
		{
		    $table->string('key')->unique();
		    $table->text('value');
		    $table->integer('expiration');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('playlogs');
		Schema::dropIfExists('pinyin_maps');
		Schema::dropIfExists('playlists');
		Schema::dropIfExists('poems');
		Schema::dropIfExists('artists');
		Schema::dropIfExists('albums');
		Schema::dropIfExists('songs');
		Schema::dropIfExists('images');
		Schema::dropIfExists('users');
		Schema::dropIfExists('cache');
	}

}
