<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description"
		content="From its beginnings as a traditional hardware store in 1976, CitiHardware is now one of the leading and fastest growing construction retail stores with more than 50 branches in the Philippines." />
	<!-- Fontawesome CDN -->
	{{-- <script src="https://use.fontawesome.com/31fc14d8c6.js"></script> --}}
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="icon" href="{{asset('assets/img/logo.png')}}">
	<title>Page not found</title>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">

	<link rel="stylesheet" href="assets/vendor/simple-line-icons/css/simple-line-icons.css">

	<!-- Custom stlylesheet -->
	<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" type="text/css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<div id="notfound">
		<div class="notfound">
			<img src="{{ asset('assets/img/logo.png') }}" style="width:50%; height: auto;" alt="Mass Display">
			<div class="notfound-404">
				<div></div>
				<h1>Oops!</h1>
				<h2>404 - The Page can't be found</h2>
			</div>
			{{-- <a href="{{route('main')}}">Go TO Homepage</a> --}}
			<a href="{{ URL::previous() }}"><i class="icon icon-arrow-left"></i>&nbsp;&nbsp;Go Back</a>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>