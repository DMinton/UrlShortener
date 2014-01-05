@extends('layout')

@section('container')
	<h1>Here is your short url</h1>
	{{ HTML::link($shortened, base_path() . "/$shortened") }}
@endsection