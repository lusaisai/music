@extends('layouts.master')

@section('main')
    <div id="searching">
        <form class="form-inline form-search" action="/songs" method="get" autocomplete="off">
            <input name="words" data-provide="typeahead" style="width:350px" type="text" class="typeahead form-control" placeholder="后来的我们">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
        </form>
    </div>
    <div id="data" pagetype="{{{$page}}}">
        <div class="songs">
            <table class="table table-bordered table-hover table-condensed table-striped">
                @foreach ($songs as $song)
                    <tr>
                        <td>
                            <label class="checkbox"><input type="checkbox" checked="checked" songid="{{{$song->id}}}">
                                {{{ $song->name }}}
                            </label>
                        </td>
                        <td>{{{ $song->album_name }}}</td>
                        <td>{{{ $song->artist_name }}}</td>
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
        </div>

        @if ($words == '')
            {{ $songs->links() }}
        @else
            {{ $songs->appends(['words' => $words])->links() }}
        @endif
    </div>
@stop