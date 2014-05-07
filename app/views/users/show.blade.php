@extends('layouts.master')

@section('main')
	Hi, {{ Auth::user()->username }}
@stop
