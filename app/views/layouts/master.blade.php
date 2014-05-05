<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/ico" href="/assets/img/favicon.ico"/>
    
	<title>{{{ Poem::orderBy(DB::raw('rand()'))->pluck('content') }}}</title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<?= stylesheet_link_tag() ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
	<?= javascript_include_tag() ?>
</head>
<body>
<div class="container">
	<div id="top-header">
		<ul class="nav nav-pills">
            <li class="{{{ $page == 'home' ? 'active' : ''}}}"><a href="{{ route('home') }}">Home</a></li>
            <li class="{{{ $page == 'artist' ? 'active' : ''}}}"><a href="/artist">Artist</a></li>
            <li class="{{{ $page == 'album' ? 'active' : ''}}}"><a href="/album">Album</a></li>
            <li class="{{{ $page == 'song' ? 'active' : ''}}}"><a href="/song">Song</a></li>
            <li class="pull-right"><a href="">User To Implement</a></li>
        </ul>
	</div>
	<div class="row">
		<div class="col-xs-6 col-md-3">
		    <div id="player">
		    	@include('player')
		    </div>
		</div>
		<div class="col-xs-12 col-md-8">
		    <div id="main">
		    	@yield('content')
		    </div>
		</div>
	</div>
</div>
</body>
</html>

