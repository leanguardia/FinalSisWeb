<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Tweetter</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"/>

    {!! FA::css() !!}
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    <script src="js/jquery.js"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    <script src="js/bootstrap.js"></script>

	<![endif]-->

</head>
<body background="images/cloudback.jpg">
	<nav class="navbar navbar-default nav-tweet">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="color: #FFFFFF;" href="/">Final Project</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                    <li><a href="/home"  style="color: #FFFFFF;">Home</a></li>
                    <li><a href="/notifications"  style="color: #FFFFFF;">Notifications</a></li>
				</ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    @else
                        <li>
                            {!!Form::open(['url'=>'search','method'=>'get','class'=>'form-inline'])!!}
                            {!!Form::text('text',null,['class'=>'form-control marg'])!!}
                            <button typ="submit" class="btn btn-default">{!!FA::icon('search')!!}</button>
                            {!!Form::close()!!}
                        </li>
                        <li>&nbsp</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #FFFFFF;">{{ Auth::user()->username }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/{{Auth::user()->username}}">User Page</a></li>
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
		</div>
	</nav>

	@yield('content')

    <script src="js/scripts.js"></script>

</body>
</html>
