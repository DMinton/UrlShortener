@if($getTopSites->first())
	<div class="topcount">
		<h4>Most Visited</h4>
		<ul>
			@foreach($getTopSites as $site)
				<li>{{ HTML::link($site->shortened, $site->url) . " - " . $site->count }}</li>
			@endforeach
		</ul>
	</div>
@endif