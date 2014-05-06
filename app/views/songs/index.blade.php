@extends('layouts.master')

@section('main')
    <div id="searching">
        <form class="form-inline form-search" action="/songs" method="get" autocomplete="off">
            <input name="words" data-provide="typeahead" style="width:350px" type="text" class="typeahead form-control" placeholder="后来的我们">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
        </form>
    </div>
    <div id="data" pagetype="{{{$page}}}">
        @include('songs.data', array('songs' => $songs))
    </div>
@stop