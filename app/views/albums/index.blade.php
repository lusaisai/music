@extends('layouts.master')

@section('main')
<div id="searching">
	<form class="form-inline form-search" method="get" action="/albums" autocomplete="off">
		<input data-provide="typeahead" name="words" style="width:350px" type="text" class="typeahead form-control" placeholder="后来的我">
		<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
	</form>
</div>

<div id="data" pagetype="{{{ $page }}}">
	@foreach ($albums as $album)
		<div id="{{{ $album->id }}}" class="album panel panel-primary">
			<div class="panel-heading">
				<h3>{{{ $album->name }}}</h3>
				<h6>-- {{{ $album->artist_name }}}</h6>
			</div>
			<div class="panel-body">
				<div>
					<img src="{{{ $album->images()->first()->albumUrl() }}}" class="img-rounded album-image">
				</div>
				<div class="slide songs">
					<table class="table table-bordered table-hover table-condensed table-striped">
					@foreach ($album->songs as $song)
						<tr>
							<td><label class="checkbox"><input type="checkbox" checked="checked" songid="{{{ $song->id }}}"> {{{ $song->name }}} </label></td>
							<td style="text-align:center"><button class="btn btn-default btn-xs song-play" type="button" songid="{{{ $song->id }}}"><span class="glyphicon glyphicon-headphones"></span></button></td>
							<td style="text-align:center"><button class="btn btn-default btn-xs song-add" type="button" songid="{{{ $song->id }}}"><span class="glyphicon glyphicon-plus"></span></button></td>
						</tr>
					@endforeach

					</table>
					<div class="btn-group">
						<button class="btn btn-default reverse-check">Reverse Check</button>
						<button class="btn btn-default check-all">Check All</button>
						<button class="btn btn-default uncheck-all">Uncheck All</button>
					</div>
				</div>
				<div class="btn-group">
					<button class="btn btn-primary song-list"><span class="glyphicon glyphicon-list"></span></button>
					<button album_id="{{{ $album->id }}}" class="btn btn-primary album-play"><span class="glyphicon glyphicon-music"></span> Play</button>
				</div>
			</div>
		</div>
	@endforeach

	@if ($words == '')
	    {{ $albums->links() }}
	@else
	    {{ $albums->appends(['words' => $words])->links() }}
	@endif
</div>

@stop
