@extends('layouts.master')

@section('main')
	@if ($errors->has())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
			      <div>{{ $error }}</div>
			@endforeach
		</div>
	@endif
	{{ Form::model(Auth::user(), [ 'url' => '/users/' . Auth::user()->id , 'method' => 'PUT', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off' ] ) }}
	<div class="form-group">
		{{ Form::label('username', 'Username', array('class' => 'col-sm-3 control-label')) }}
		<div class="col-sm-5">
			{{ Form::text('username', Auth::user()->username, ['class'=>'form-control']); }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			{{ Form::submit('Update', ['class'=>'btn btn-primary']); }}
		</div>
	</div>
	{{ Form::close() }}
@stop
