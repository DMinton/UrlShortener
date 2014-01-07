@if($topcount->first())
	<div class="topcount">
	<h4>Most Visited</h4>
		<ul>
		@foreach($topcount as $site)
			<li>{{ HTML::link($site->url, $site->url) . " - " . $site->count }}</li>
		@endforeach
		</ul>
	</div>
@endif