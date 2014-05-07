@extends('layouts.master')

@section('main')
	@if ($errors->has())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
			      <div>{{ $error }}</div>
			@endforeach
		</div>
	@endif
	{{ Form::model(Auth::user(), [ 'url' => '/user/updatepassword' , 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off' ] ) }}
	<div class="form-group">
		{{ Form::label('old passowrd', 'Old Password', array('class' => 'col-sm-3 control-label')) }}
		<div class="col-sm-5">
			{{ Form::password('oldpassword', ['class'=>'form-control']); }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('new passowrd', 'New Password', array('class' => 'col-sm-3 control-label')) }}
		<div class="col-sm-5">
			{{ Form::password('newpassword', ['class'=>'form-control']); }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('new passowrd', 'Confirm New Password', array('class' => 'col-sm-3 control-label')) }}
		<div class="col-sm-5">
			{{ Form::password('newpassword_confirmation', ['class'=>'form-control']); }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			{{ Form::submit('Update', ['class'=>'btn btn-primary']); }}
		</div>
	</div>
	{{ Form::close() }}
@stop
