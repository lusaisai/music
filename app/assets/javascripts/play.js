$(document).ready(function(){
    var myPlaylist;
    var base = "/";
    // var playerY = $("#the_player").position().top;
    var playerY = 40;
    var lrc = new Lyricer();

    var setBufferWidth = function(width) {
            $('.jp-buffer-bar').attr('style',  'width: ' + width + '%' );
        };

    var buffer = function (event) {
        var audio = document.getElementById('jp_audio_0');

        if (!audio.buffered.length) { 
            setBufferWidth(0);
        } else {
            var duration = event.jPlayer.status.duration;
            var playtime = event.jPlayer.status.currentTime;
            var buffertime = audio.buffered.end(audio.buffered.length-1);

            if ( Math.floor(duration) == Math.floor(buffertime) ) {
                setBufferWidth(100 - event.jPlayer.status.currentPercentRelative);
                $('.jp-seek-bar').css('width', '225px'); // tmp fix of bootstrap stack gap
            } else {
                setBufferWidth( (buffertime - playtime) * 100 / duration);
            }
        }

        
    };

    var doWhenTimeUpdates = function(event) {
        buffer(event);

        var songs = [];
        var currentSong = 0;
        var currentSongId = 0;
        $(".jp-playlist li[songid]").each(function () {
            songs.push($(this).attr('songid'));
        });

        $('.jp-playlist li').each( function (index) {
            if ($(this).hasClass('jp-playlist-current')) { 
                currentSong = index; 
                currentSongId = $(this).attr("songid");
                return false;
            };
        } );

        var currentTime = event.jPlayer.status.currentTime;

        if ( currentSongId != 0 && currentSongId !== localStorage.getItem('currentsongid') ) {
            $.get('/utils/lyric/' + currentSongId, function(data) {
                lrc.setLrc(data);
                lrc.move(currentTime);
            });
        } else {
            lrc.move(currentTime);
        };

        localStorage.setItem('playlist', songs.join(","));
        localStorage.setItem('currentsong', currentSong);
        localStorage.setItem('currentsongid', currentSongId);
        localStorage.setItem('currenttime', currentTime);


    };

    var storePlayStatus = function (status) {
        return function (argument) {
            localStorage.setItem('isplay', status);
        };
    };

    var playlistTooltip = function () {
        setTimeout(function () {
            $('#the_player li').tooltip('hide');
        }, 2000);
    };

    var play = function(data) {
        myPlaylist.setPlaylist(data);
        myPlaylist.option("autoPlay", true);
        playlistTooltip();       
    };


    var readyPlayStatus = function () {
        var playerID = "#jquery_jplayer_1";
        var playlist = localStorage.getItem('playlist');
        if (playlist) {
            $.getJSON( '/utils/songmeta/' + playlist, function (data) {
                play(data);
                $(playerID).bind( $.jPlayer.event.play, storePlayStatus(1));
                $(playerID).bind( $.jPlayer.event.pause, storePlayStatus(0));
                var index = localStorage.getItem('currentsong');
                var time = localStorage.getItem('currenttime');
                var isPlay = localStorage.getItem('isplay');
                var currentSongId = localStorage.getItem('currentsongid');
                if ( typeof index != "undefined" ) { myPlaylist.select( parseInt(index) ) };
                if ( typeof time != "undefined" ) {
                    if ( isPlay == 1 ) {
                        $(playerID).jPlayer( 'play', parseFloat(time) );
                    } else {
                        $(playerID).jPlayer( 'pause', parseFloat(time) );
                    }
                    
                };
                if (  typeof currentSongId != "undefined" ) {
                    $.get('/utils/lyric/' + currentSongId, function(data) {
                        lrc.setLrc(data);
                    });
                };
                
                $(playerID).bind( $.jPlayer.event.timeupdate, doWhenTimeUpdates );
                
            } );
        } else {
            play([]);
            $(playerID).bind( $.jPlayer.event.play, storePlayStatus(1));
            $(playerID).bind( $.jPlayer.event.pause, storePlayStatus(0));
            $(playerID).bind( $.jPlayer.event.timeupdate, doWhenTimeUpdates );
        }
        window.mPlayList = myPlaylist; // exposed to window object for other javascripts to use
    };

    var errorReplay = function (event) {
        var time = localStorage.getItem('currenttime');
        $('#jquery_jplayer_1').jPlayer( 'play', parseFloat(time) );
    };

    var waitingReload = function (event) {
        var playtime = event.jPlayer.status.currentTime;
        if ( playtime < 10 ) { return; }
        setTimeout( function () {
            var audio = document.getElementById('jp_audio_0');
            var buffertime = audio.buffered.end(audio.buffered.length-1);
            if ( buffertime - playtime < 10 ) { // reconnect to website, it might be faster
                myPlaylist.select(myPlaylist.current);
                $('#jquery_jplayer_1').jPlayer( 'play', event.jPlayer.status.currentTime );
            }
        }, 3600 );
        
    };

    myPlaylist = new jPlayerPlaylist(
            {
                jPlayer: "#jquery_jplayer_1",
                cssSelectorAncestor: "#jp_container_1"
            }, [],
            {
                supplied: "m4a, mp3",
                swfPath: "/assets/jplayer/js",
                solution: 'html, flash',
                smoothPlayBar: false,
                keyEnabled: true,
                volume: 0.88,
                preload: "auto",
                playlistOptions: {
                    autoPlay: false,
                    enableRemoveControls: true
                },
                ready: readyPlayStatus,
                progress: buffer,
                error: errorReplay,
                waiting: waitingReload
            }
    );

    var add = function(data) {
        myPlaylist.add(data[0]);
        playlistTooltip();
    };

    var reloadGif = function(){
        $("#data").empty();
        $("#data").append('<img src="/assets/ajax.gif">');
    };

    var songListToggle = function () {
        $(".slide").slideToggle('slow');
        $(".song-list").click(function(){
            $(this).parent().prev().slideToggle('slow');
        });
    };


    var playSongs = function (selector) {
        return  function() {
            var songs = [];

            $(this).parent().parent().find(selector).each(function(){
                if ( this.checked ){
                    songs.push($(this).attr('songid'));
                }
            });
            $.getJSON( '/utils/songmeta/' + songs.join(","), play );
        };
    };

    function plays(){
        $("#main").on( 'click','.album-play', playSongs("input"));

        $("#main").on( 'click','.artist-play', playSongs(".in input"));

        $("#main").on( 'click','.song-play', function(){
            var songID = $(this).attr('songid');
            $.getJSON( '/utils/songmeta/' + songID, play );
        });

        $("#main").on( 'click','#top-song-cloud text', function(){
            var songID = $(this).attr('song-id');
            $.getJSON( '/utils/songmeta/' + songID, play );
        });

        $("#main").on( 'click','.song-add', function(){
            var songID = $(this).attr('songid');
            $.getJSON( '/utils/songmeta/' + songID, add);
        });

        $("#main").on( 'click','.reverse-check', function(){
            $(this).closest("div.songs").find("input[type='checkbox']").each(function(){
                $(this).prop( "checked", !$(this).prop("checked") );
            });
        });

        $("#main").on( 'click','.check-all', function(){
            $(this).closest("div.songs").find("input[type='checkbox']").prop("checked", true);
        });


        $("#main").on( 'click','.uncheck-all', function(){
            $(this).closest("div.songs").find("input[type='checkbox']").prop("checked", false);
        });

        $("#main").on( 'click', '.playlist-play', function () {
            var songs = $(this).attr("songids");
            $.getJSON( '/utils/songmeta/' + songs, play );
        } );

        $("#main").on( 'submit', "#randoms form", function(e){
            e.preventDefault();
            $.getJSON( '/home/randomplay', $("#randoms form").serialize(), play );
        });

        $(window).scroll(function() {
            if ( $(window).scrollTop() >= playerY && $(window).height() > $("#the_player").height() ) {
                $("#the_player").css({ "position": "fixed", "top": "0px" });
            } else {
                $("#the_player").css({ "position": "relative" });
            }
        });

        $('.jp-shuffle').click(playlistTooltip);

        $(document).on( 'ajaxized', function () {
            songListToggle();
            $("html, body").animate({ scrollTop: 0 });
        } );
    }

    // connect to site every interval seconds
    var heartBeat = function(interval) {
        setInterval( function() {
            $.get('/playutils/heartbeat/');
        }, interval * 1000);
    };

    var run= function () {
        songListToggle();
        plays();
        // heartBeat(30);
    };

    run();
});
