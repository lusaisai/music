@extends('layouts.master')

@section('main')
	@if ($errors->has())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
			      <div>{{ $error }}</div>
			@endforeach
		</div>
	@endif
	{{ Form::open(array('url' => '/users', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
		<div class="form-group">
			{{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
			<div class="col-sm-5">
				{{ Form::text('email', '', ['class'=>'form-control']); }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('username', 'Username', array('class' => 'col-sm-3 control-label')) }}
			<div class="col-sm-5">
				{{ Form::text('username', '', ['class'=>'form-control']); }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('passowrd', 'Password', array('class' => 'col-sm-3 control-label')) }}
			<div class="col-sm-5">
				{{ Form::password('password', ['class'=>'form-control']); }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('passowrd', 'Confirm Password', array('class' => 'col-sm-3 control-label')) }}
			<div class="col-sm-5">
				{{ Form::password('password_confirmation', ['class'=>'form-control']); }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				{{ Form::submit('Sign Up', ['class'=>'btn btn-primary']); }}
			</div>
		</div>
	{{ Form::close() }}
@stop
