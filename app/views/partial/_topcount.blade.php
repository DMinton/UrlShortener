@if($topcount->first())
	<div class="topcount">
	<h4>Most Visited</h4>
		<ul>
		@foreach($topcount as $site)
			<li>{{ HTML::link($site->url, "www.urlshortener.eu1.frbit.net/$site->shortened") . " - " . $site->count }}</li>
		@endforeach
		</ul>
	</div>
@endif