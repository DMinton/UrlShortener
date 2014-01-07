@extends('layout')

@section('container')
	<h1>Here is your short url</h1>
	<p>{{ $shortened->url }}</p>
	<p>{{ HTML::link($shortened, "www.urlshortener.eu1.frbit.net/$shortened->shortened") }}</p>
	<p>Visitors - {{ $shortened->count }}</p>
@endsection