@extends('layout')

@section('container')
	<h1>Here is your short url</h1>
	<p>{{ $shortened->url }}</p>
	<p>{{ link_to($shortened->shortened) }}</p>
	<p>Visitors - {{ $shortened->count }}</p>
@endsection