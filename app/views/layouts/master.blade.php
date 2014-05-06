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
	<?= javascript_include_tag() ?>
</head>
<body>
<div class="container">
	<div id="top-header">
		<ul class="nav nav-pills">
            <li class="{{{ $page == 'home' ? 'active' : ''}}}"><a href="/home">Home</a></li>
            <li class="{{{ $page == 'artists' ? 'active' : ''}}}"><a href="/artists">Artists</a></li>
            <li class="{{{ $page == 'albums' ? 'active' : ''}}}"><a href="/albums">Albums</a></li>
            <li class="{{{ $page == 'songs' ? 'active' : ''}}}"><a href="/songs">Songs</a></li>
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
		    	@yield('main')
		    </div>
		</div>
	</div>
</div>
@include('top')
</body>
</html>

