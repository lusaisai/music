<div class="songs">
    <table class="table table-bordered table-hover table-condensed table-striped">
        @foreach ($songs as $song)
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
</div>

{{ $songs->links() }}
