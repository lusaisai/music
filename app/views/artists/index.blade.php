@extends('layouts.master')

@section('main')
<div id="searching">
        <form class="form-inline form-search" method="get" action="/artists" autocomplete="off">
            <input name="words" style="width:350px" type="text" class="form-control" placeholder="品冠">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
        </form>
    </div>
    <div id="data" pagetype="{{{ $page }}}">
        @foreach ($artists as $artist)
        	<div id="{{{ $artist->id }}}" class="album panel panel-primary">
        		<div class="panel-heading"><h3>{{{ $artist->name }}}</h3></div>
        		<div class="panel-body">
        			<div><img src="{{{ $artist->images()->first()->artistUrl() }}}" class="img-rounded album-image"></div>
        			<div id="accordion{{{ $artist->id }}}" class="panel-group slide">
        			<?php $i = 0 ?>
        			@foreach ($artist->albums as $album)
        				<div class="panel panel-default">
        					<div class="panel-heading">
        					    <a class="panel-title" data-toggle="collapse" data-parent="#accordion{{{ $artist->id }}}" href="#collapse{{{ $album->id }}}">{{{ $album->name }}}</a>
        					</div>
        					<div id="collapse{{{ $album->id }}}" class="panel-collapse collapse {{{ $i++ == 0 ? 'in' : '' }}}">
        						<div class="panel-body songs">
        							<table class="table table-condensed table-bordered table-hover table-striped">
        								@foreach ($album->songs as $song)
        									 <tr>
        									     <td>
        									         <label class="checkbox"><input type="checkbox" checked="checked" songid="{{ $song->id }}">
        									             {{ $song->name }}
        									         </label>
        									     </td>
        									     <td style="text-align:center"><button class="btn btn-default btn-xs song-play" type="button" songid="{{ $song->id }}"><span class="glyphicon glyphicon-headphones"></span></button></td>
        									     <td style="text-align:center"><button class="btn btn-default btn-xs song-add" type="button" songid="{{ $song->id }}"><span class="glyphicon glyphicon-plus"></span></button></td>
        									</tr>
        								@endforeach
        							</table>
        							<div class="btn-group">
        							    <button class="btn btn-default reverse-check">Reverse Check</button>
        							    <button class="btn btn-default check-all">Check All</button>
        							    <button class="btn btn-default uncheck-all">Uncheck All</button>
        							</div>
        						</div>
        					</div>
        				</div>
        			@endforeach
        			</div>
        			<div class="btn-group">
        			    <button class="btn btn-primary song-list"><span class="glyphicon glyphicon-list"></span></button>
                        <button artist_id="{{ $artist->id }}" class="btn btn-primary artist-add"><span class="glyphicon glyphicon-plus"></span> Add</button>
        			    <button artist_id="{{ $artist->id }}" class="btn btn-primary artist-play"><span class="glyphicon glyphicon-music"></span> Play</button>
        			</div>
        		</div>

        	</div>
        @endforeach

        @if ($words == '')
            {{ $artists->links() }}
        @else
            {{ $artists->appends(['words' => $words])->links() }}
        @endif
    </div>
@stop
