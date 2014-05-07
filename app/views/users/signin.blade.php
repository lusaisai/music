@extends('layouts.master')

@section('main')
	@if ( Session::has('error') )
		<div class="alert alert-danger">
			{{ Session::get('error') }}
		</div>
	@endif
	{{ Form::open(array('url' => '/signin', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
		<div class="form-group">
			{{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
			<div class="col-sm-5">
				{{ Form::text('email', '', ['class'=>'form-control']); }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('passowrd', 'Password', array('class' => 'col-sm-3 control-label')) }}
			<div class="col-sm-5">
				{{ Form::password('password', ['class'=>'form-control']); }}
			</div>
		</div>
		<div class="form-group">
		    <div class="col-sm-offset-3 col-sm-5">
		      <div class="checkbox">
		        <label>
		          {{ Form::checkbox('rememberme') }} Remember Me
		        </label>
		      </div>
		    </div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				{{ Form::submit('Sign In', ['class'=>'btn btn-primary']); }}
			</div>
		</div>
	{{ Form::close() }}
@stop
