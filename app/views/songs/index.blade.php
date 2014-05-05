@extends('layouts.master')

@section('content')
    <div id="searching">
        <form class="form-inline form-search" method="get" autocomplete="off">
            <input name="words" data-provide="typeahead" style="width:350px" type="text" class="typeahead form-control" placeholder="后来的我们">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
            <select class="type form-control" name="type" style="width:138px">
                <option value="artistname">Artist Name</option>
                <option value="albumname">Album Name</option>
                <option value="songname" selected="selected">Song Name</option>
            </select>
        </form>
    </div>
    <div id="data" pagetype="song">
        @include('songs.data', array('songs' => $songs))
    </div>
@stop