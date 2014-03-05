@extends('layout')

@section('container')

	<h1>Here is your short url</h1>

	<p>{{ $shortened->url }}</p>
	<p>{{ link_to($shortened->shortened) }}</p>

	@if( $shortened->count )
		<p>Visitors - {{ $shortened->count }}</p>
	@else
		<p>No Visitors Yet!</p>
	@endif
@endsection