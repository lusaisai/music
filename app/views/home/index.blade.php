@extends('layouts.master')

@section('main')
<div id="randoms">
	<h3>Random Playing</h3>
	<form role="form" class="form-inline form-search" method="get" autocomplete="off">
	    <input data-provide="typeahead" name="words" style="width:350px" type="text" class="typeahead form-control" placeholder="品冠">
	    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Random</button>
	    <select name="type" class="type form-control" style="width:135px">
	        <option value="artistname">Artist Name</option>
	        <option value="albumname">Album Name</option>
	        <option value="songname">Song Name</option>
	    </select>
	</form>
</div>

@stop