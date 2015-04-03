@extends('layouts.master')

@section('main')
    <div id="data" pagetype="{{{$page}}}">
    	<ul class="nav nav-tabs">
    		<?php $i = 0 ?>
    		@foreach ($playlists as $playlist)
    			<li class="{{{ $i++ == 0 ? 'active' : '' }}}"><a href="#playlist{{{ $playlist->id }}}" data-toggle="tab">{{{ $playlist->name }}}</a></li>
    		@endforeach
    	</ul>
    	<div class="tab-content">
    		<?php $i = 0 ?>
    		@foreach ($playlists as $playlist)
    			<div class="tab-pane fade {{{ $i++ == 0 ? 'in active' : '' }}}" id="playlist{{{ $playlist->id }}}">
    				<div class="songs">
    				    <table class="table table-bordered table-hover table-condensed table-striped">
    				        @foreach ($playlist->songs() as $song)
    				            <tr>
    				                <td>
    				                    <label class="checkbox"><input type="checkbox" checked="checked" songid="{{{$song->id}}}">
    				                        {{{ $song->name }}}
    				                    </label>
    				                </td>
    				                <td>{{{ $song->album->name }}}</td>
    				                <td>{{{ $song->album->artist->name }}}</td>
    				                <td style="text-align:center"><button class="btn btn-default btn-xs song-play" type="button" songid="{{{$song->id }}}"><span class="glyphicon glyphicon-headphones"></span></button></td>
    				                <td style="text-align:center"><button class="btn btn-default btn-xs song-add" type="button" songid="{{{$song->id }}}"><span class="glyphicon glyphicon-plus"></span></button></td>
    				            </tr>
    				        @endforeach
    				    </table>
    				    <div class="btn-group">
    				        <button class="btn btn-default reverse-check">Reverse Check</button>
    				        <button class="btn btn-default check-all">Check All</button>
    				        <button class="btn btn-default uncheck-all">Uncheck All</button>
    				    </div>
    				    <div class="btn-group">
    				        <button class="btn btn-primary album-play"><span class="glyphicon glyphicon-music"></span> Play</button>
    				    </div>
    				    <button playlist-id="{{{ $playlist->id }}}" class="playlist-delete btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    				</div>
    			</div>
    		@endforeach
    	  
    	</div>

        {{ $playlists->links() }}

        
    </div>
    <script type="text/javascript">
    	$('#data a').click(function (e) {
    	  e.preventDefault();
    	  $(this).tab('show');
    	});
    	$('.playlist-delete').click(function () {
    		$.ajax({
    				url: '/playlists/' + $(this).attr('playlist-id'),
    				type: 'delete',
    				success: function (data) {
    					$.get( location, function( html ) {
    						var result = $('<result>').append($.parseHTML(html, true));
    						$('#main').html( result.find('#main').html() );
    					});
    				}
    		});
    	});
    </script>
@stop