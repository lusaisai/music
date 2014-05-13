<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/ico" href="/assets/img/favicon.ico"/>
    <meta name="description" content="lusaisai music collection 陆赛赛 音乐收藏">
    <meta name="keywords" content="{{{ $keywords or '音乐收藏'  }}}">
    
	<title>{{{ Poem::orderBy(DB::raw('rand()'))->pluck('content') }}}</title>

	<?= stylesheet_link_tag() ?>

	<?= javascript_include_tag() ?>
</head>
<body>
<div class="container">
	<div id="top-header">
		<ul class="nav nav-pills">
            <li class="{{{ $page == 'home' ? 'active' : ''}}}"><a data-remote="true" href="/home">Home</a></li>
            <li class="{{{ $page == 'artists' ? 'active' : ''}}}"><a data-remote="true" href="/artists">Artists</a></li>
            <li class="{{{ $page == 'albums' ? 'active' : ''}}}"><a data-remote="true" href="/albums">Albums</a></li>
            <li class="{{{ $page == 'songs' ? 'active' : ''}}}"><a data-remote="true" href="/songs">Songs</a></li>

            @if ( !Auth::check() )
            	<li class="pull-right {{{ $page == 'users' ? 'active' : ''}}}"><a data-remote="true" href="/signin">Sign In</a></li>
            @else
            	<li class="pull-right dropdown {{{ $page == 'user' ? 'active' : ''}}}">
	            	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	            	    {{{ Auth::user()->username }}} <span class="caret"></span>
	            	</a>
	            	<ul class="dropdown-menu">
	            		<li><a data-remote="true" href="/playlists">Playlists</a></li>
	            		<li class="divider"></li>
	            		<li><a data-remote="true" href="/user/editusername">Change Username</a></li>
	            		<li><a data-remote="true" href="/user/editpassword">Change Password</a></li>
	            		<li><a data-remote="true" href="/signout">Sign Out</a></li>
	            	</ul>
            	</li>
            @endif

            
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

