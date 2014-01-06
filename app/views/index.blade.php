@extends('layout')

@section('container')
	<h1>Url Shortener</h1>
	
	{{ Form::open() }}
		{{ Form::text('url') }}
		<div>{{ Form::submit('Shorten') }}</div>
	{{ Form::close() }}

	{{ $errors->first('url', '<p class=errors>:message</p>') }}
@endsection

@section('random')
	@if(is_object($randomurl))
	{{  HTML::link($randomurl->shortened, "Random Link") }}
	@endif
@endsection