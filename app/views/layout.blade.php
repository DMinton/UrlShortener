<html>
	<head>
		{{ stylesheet_link_tag() }}
	    {{ javascript_include_tag() }}
		<title></title>
	</head>
	<body>

		<div class="random">
			@yield('random')
		</div>

		<div class="container">
			@yield('container')
		</div>

	</body>
</html>