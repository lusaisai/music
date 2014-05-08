<div id="the_player">
	<div id="jquery_jplayer_1" class="jp-jplayer"></div>

	<div id="jp_container_1" class="jp-audio">
		<div class="jp-type-playlist">
			<div class="jp-gui jp-interface">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-previous btn btn-default btn-sm" tabindex="1"><span class="glyphicon glyphicon-backward"></span></a></li>
					<li><a href="javascript:;" class="jp-play btn btn-default btn-sm" tabindex="1"><span class="glyphicon glyphicon-play"></span></a></li>
					<li><a href="javascript:;" class="jp-pause btn btn-default btn-sm" tabindex="1"><span class="glyphicon glyphicon-pause"></span></a></li>
					<li><a href="javascript:;" class="jp-next btn btn-default btn-sm" tabindex="1"><span class="glyphicon glyphicon-forward"></span></a></li>
					<li><a href="javascript:;" class="jp-stop btn btn-default btn-sm" tabindex="1"><span class="glyphicon glyphicon-stop"></span></a></li>
					<li><a href="javascript:;" class="jp-shuffle btn btn-default btn-sm" tabindex="1" title="shuffle the playlist"><span class="glyphicon glyphicon-random"></span></a></li>
					<li><a href="javascript:;" class="jp-shuffle-off btn btn-default btn-sm" tabindex="1" title="shuffle the playlist"><span class=" glyphicon glyphicon-random"></span></a></li>
					<li><a href="javascript:;" class="jp-repeat btn btn-default btn-sm" tabindex="1" title="repeat"><span class="glyphicon glyphicon-arrow-down"></span></a></li>
					<li><a href="javascript:;" class="jp-repeat-off btn btn-default btn-sm" tabindex="1" title="repeat off"><span class="glyphicon glyphicon-repeat"></span></a></li>
					<br/>
					<li><a href="javascript:;" class="jp-mute btn btn-default btn-sm" tabindex="1" title="mute"><span class="glyphicon glyphicon-volume-off"></span></a></li>
					<li><a href="javascript:;" class="jp-unmute btn btn-default btn-sm" tabindex="1" title="unmute"><span class="glyphicon glyphicon-volume-down"></span></a></li>
					<li>
						<div class="jp-volume-bar progress">
							<div class="jp-volume-bar-value progress-bar progress-bar-success"></div>
						</div>
					</li>
					<li><a href="javascript:;" class="jp-volume-max btn btn-default btn-sm" tabindex="1" title="max volume"><span class="glyphicon glyphicon-volume-up"></span></a></li>
				</ul>
				<div class="jp-progress">
					<div class="jp-seek-bar progress">
						<div class="jp-play-bar progress-bar"></div>
						<div class="jp-buffer-bar progress-bar" style="width: 0%"></div>
					</div>
				</div>
				<div id="time">
					<div class="jp-current-time badge"></div>
					<div class="jp-duration badge"></div>
				</div>
			</div>
			<div class="jp-playlist">
				<ul>
					<li></li>
				</ul>
			</div>
			<div class="jp-no-solution">
				<span>Update Required</span>
				To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
			</div>
		</div>
	</div>
	<div id="userpanel">
		<a class="btn btn-default btn-sm {{{ Auth::check() ? '' : 'disabled' }}}" id="newplaylist" title="{{{ Auth::check() ? '' : 'login and' }}} save the current playlist"   >
			<span class="glyphicon glyphicon-list"></span>
		</a>
		<script>$("#userpanel a").tooltip("hide");</script>
	</div>
	<div id="lyricer"></div>
</div>
<script type="text/javascript">
(function(){
	var gatherList = function(){
		var songs = [];
		$(".jp-playlist li[songid]").each(function () {
		    songs.push($(this).attr('songid'));
		});
		return songs.join(",");
	};

	$('#newplaylist').click(function(event) {
		bootbox.prompt("Please enter the playlist name", function(playlistName) {                
			if (playlistName !== null && $.trim(playlistName) !== "" ) {
				$.post( "/playlists", { name: playlistName, song_ids: gatherList() })
				.done(function() {
					bootbox.alert('<div class="alert alert-success">Playlist saved</div>');
				})
				.fail(function(data) {
					bootbox.alert( '<div class="alert alert-danger">' + data.responseText + '</div>');
				});
			}
		});
	});
})();	

</script>