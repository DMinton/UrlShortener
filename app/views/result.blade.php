@extends('layout')

@section('container')
	<h1>Here is your short url</h1>
	{{ HTML::link($shortened, "www.urlshortener.eu1.frbit.net/$shortened") }}
@endsection